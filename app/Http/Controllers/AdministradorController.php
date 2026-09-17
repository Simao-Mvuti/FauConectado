<?php

namespace App\Http\Controllers;

use App\Models\Avaliacao;
use App\Models\AvaliacaoMaterial;
use App\Models\CandidaturaTutor;
use App\Models\Conteudo;
use App\Models\Eventos;
use App\Models\Materias;
use App\Models\SolicitacaoTutoria;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class AdministradorController extends Controller
{
    public function acesso(): View
    {
        return view('administracao.acesso');
    }

    public function autenticarAcesso(Request $request)
    {
        $request->validate([
            'chave' => ['required', 'string'],
        ]);

        $chaveConfigurada = (string) config('app.admin_access_key');

        abort_if($chaveConfigurada === '', 503, 'O acesso administrativo não está configurado.');

        if (! hash_equals($chaveConfigurada, (string) $request->input('chave'))) {
            return back()->withInput()->withErrors(['chave' => 'Chave administrativa inválida.']);
        }

        $administrador = User::query()
            ->where('role', 'admin')
            ->first();

        if (! $administrador) {
            return back()->withErrors(['chave' => 'Nenhum administrador foi configurado. Execute o seeder antes de acessar esta área.']);
        }

        Auth::login($administrador);
        $request->session()->regenerate();

        return redirect()->route('administracao.painel');
    }

    public function index(): View
    {
        return view('administracao.painel', [
            'conteudos' => Conteudo::select(['id', 'titulo', 'conteudo', 'categoria', 'status', 'user_id'])->with('autor:id,name')->latest()->paginate(6, ['*'], 'conteudos_page'),
            'materiais' => Materias::select(['id', 'titulo', 'descricao', 'arquivo', 'categoria', 'status', 'user_id'])->with('autor:id,name')->latest()->paginate(6, ['*'], 'materiais_page'),
            'eventos' => Eventos::select(['id', 'titulo', 'descricao', 'data', 'categoria', 'user_id'])->with('user:id,name')->latest()->paginate(6, ['*'], 'eventos_page'),
            'usuarios' => User::select(['id', 'name', 'email', 'role'])->latest()->paginate(8, ['*'], 'usuarios_page'),
            'candidaturasPendentes' => CandidaturaTutor::with('candidato:id,name,email')->where('status', 'pendente')->latest()->get(),
            'solicitacoes' => SolicitacaoTutoria::with(['solicitante:id,name', 'mentor:id,name'])->latest()->paginate(6, ['*'], 'solicitacoes_page'),
            'avaliacoes' => Avaliacao::with(['avaliador:id,name', 'avaliado:id,name'])->latest()->paginate(6, ['*'], 'avaliacoes_page'),
            'avaliacoesMateriais' => AvaliacaoMaterial::with(['avaliador:id,name', 'material:id,titulo'])->latest()->paginate(6, ['*'], 'avaliacoes_materiais_page'),
            'totalConteudos' => Conteudo::count(),
            'totalMateriais' => Materias::count(),
            'totalEventos' => Eventos::count(),
            'totalUsuarios' => User::count(),
            'totalCandidaturasPendentes' => CandidaturaTutor::where('status', 'pendente')->count(),
            'totalPendentes' => Conteudo::where('status', 'pendente')->count() + Materias::where('status', 'pendente')->count(),
            'totalSolicitacoes' => SolicitacaoTutoria::count(),
            'totalAvaliacoes' => Avaliacao::count() + AvaliacaoMaterial::count(),
        ]);
    }

    public function aprovarConteudo(Conteudo $conteudo)
    {
        $conteudo->update([
            'status' => 'aprovado',
            'moderado_por' => request()->user()->id,
            'moderado_em' => now(),
            'motivo_rejeicao' => null,
        ]);

        return back()->with('sucesso', 'Conteúdo aprovado e publicado.');
    }

    public function rejeitarConteudo(Request $request, Conteudo $conteudo)
    {
        $dados = $request->validate([
            'motivo_rejeicao' => ['required', 'string', 'max:1000'],
        ]);

        $conteudo->update([
            'status' => 'rejeitado',
            'moderado_por' => $request->user()->id,
            'moderado_em' => now(),
            'motivo_rejeicao' => $dados['motivo_rejeicao'],
        ]);

        return back()->with('sucesso', 'Conteúdo rejeitado com justificativa.');
    }

    public function aprovarMaterial(Materias $materia)
    {
        $materia->update([
            'status' => 'aprovado',
            'moderado_por' => request()->user()->id,
            'moderado_em' => now(),
            'motivo_rejeicao' => null,
        ]);

        return back()->with('sucesso', 'Material aprovado e publicado.');
    }

    public function rejeitarMaterial(Request $request, Materias $materia)
    {
        $dados = $request->validate([
            'motivo_rejeicao' => ['required', 'string', 'max:1000'],
        ]);

        $materia->update([
            'status' => 'rejeitado',
            'moderado_por' => $request->user()->id,
            'moderado_em' => now(),
            'motivo_rejeicao' => $dados['motivo_rejeicao'],
        ]);

        return back()->with('sucesso', 'Material rejeitado com justificativa.');
    }

    public function aprovarCandidatura(CandidaturaTutor $candidatura)
    {
        abort_unless($candidatura->status === 'pendente', 422, 'Esta candidatura já foi analisada.');
        abort_unless($candidatura->candidato, 404);

        DB::transaction(function () use ($candidatura): void {
            $candidatura->update(['status' => 'aprovada']);
            $candidatura->candidato->update(['role' => 'mentor']);
        });

        return back()->with('sucesso', 'Candidatura aprovada. O usuário agora é mentor.');
    }

    public function rejeitarCandidatura(CandidaturaTutor $candidatura)
    {
        abort_unless($candidatura->status === 'pendente', 422, 'Esta candidatura já foi analisada.');

        $candidatura->update(['status' => 'rejeitada']);

        return back()->with('sucesso', 'Candidatura rejeitada.');
    }

    public function excluirConteudo(Conteudo $conteudo)
    {
        $conteudo->delete();

        return back()->with('sucesso', 'Conteúdo excluído.');
    }

    public function excluirMateria(Materias $materia)
    {
        if ($materia->arquivo) {
            Storage::disk('public')->delete($materia->arquivo);
        }

        $materia->delete();

        return back()->with('sucesso', 'Material excluído.');
    }

    public function excluirEvento(Eventos $evento)
    {
        $evento->delete();

        return back()->with('sucesso', 'Evento excluído.');
    }

    public function excluirUsuario(User $usuario)
    {
        if (request()->user()->is($usuario)) {
            return back()->withErrors(['usuario' => 'Você não pode excluir a própria conta durante esta sessão.']);
        }

        $usuario->delete();

        return back()->with('sucesso', 'Usuário excluído.');
    }

    public function atualizarPapel(Request $request, User $usuario)
    {
        abort_if($request->user()->is($usuario), 422, 'Você não pode alterar o próprio papel durante esta sessão.');

        $dados = $request->validate([
            'role' => ['required', Rule::in(['mentee', 'mentor'])],
        ]);

        $usuario->update(['role' => $dados['role']]);

        return back()->with('sucesso', 'Papel do usuário atualizado.');
    }

    public function excluirSolicitacao(SolicitacaoTutoria $solicitacao)
    {
        $solicitacao->delete();

        return back()->with('sucesso', 'Solicitação de tutoria excluída.');
    }

    public function excluirAvaliacao(Avaliacao $avaliacao)
    {
        $avaliacao->delete();

        return back()->with('sucesso', 'Avaliação de tutor excluída.');
    }

    public function excluirAvaliacaoMaterial(AvaliacaoMaterial $avaliacao)
    {
        $avaliacao->delete();

        return back()->with('sucesso', 'Avaliação de material excluída.');
    }
}
