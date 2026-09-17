<section>
    <div class="mb-4">
        <x-dashboard.cabecalho-secao title="Visão geral" :link="null" />
    </div>

    <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        @foreach ($stats as $stat)
            <x-dashboard.cartao-estatistica
                :icon="$stat['icon']"
                :value="$stat['value']"
                :label="$stat['label']"
                :url="$stat['url'] ?? '#'"
                :card-class="$stat['card_class']"
                :icon-class="$stat['icon_class']"
            />
        @endforeach
    </div>
</section>
