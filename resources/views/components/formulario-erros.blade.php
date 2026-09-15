@if ($errors->any())
    <div class="mt-4 rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-700" role="alert">
        <p class="font-semibold">Revise os campos abaixo:</p>
        <ul class="mt-2 list-disc pl-5 space-y-1">
            @foreach ($errors->all() as $erro)
                <li>{{ $erro }}</li>
            @endforeach
        </ul>
    </div>
@endif
