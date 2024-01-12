<h3 class="mt-4 text-xl font-semibold leading-none text-tp-midnight">Conteudo</h3>

<div class = "flex flex-row w-9  mx-auto py-8">
    <div class="lg:grid-sidebar mt-4 items-end gap-8 lg:grid">
        @if(!empty($getRecord()->school))
            <a
            href='#'
            class='text-xl font-semibold leading-tight text-es-{{$getRecord()->school->slug}} transition-colors hover:text-tp-midnight'
            >
            {{$getRecord()->school->fullname}}
            </a>
        @endif
        <div class="flex flex-row gap-2">
            <div
            class="flex flex-col rounded bg-tp-gainsboro text-center text-2xl font-semibold text-tp-midnight"
            >
            <div class="px-3 py-2">{{ \Carbon\Carbon::parse($getRecord()->date)->format('d') }}</div>
            <div class="rounded-b bg-tp-aqua-island px-3 py-1 text-base">
            {{ mb_strtoupper(\Carbon\Carbon::parse($getRecord()->date)->format('M')) }}
            </div>
            </div>
            @if(!empty($getRecord()->dateEnd))
                <div class="flex flex-col rounded bg-tp-gainsboro text-center text-2xl font-semibold text-tp-midnight">
                <div class="px-3 py-2">{{ \Carbon\Carbon::parse($getRecord()->dateEnd)->format('d') }}</div>
                <div class="rounded-b bg-tp-aqua-island px-3 py-1 text-base">
                {{ mb_strtoupper(\Carbon\Carbon::parse($getRecord()->dateEnd)->format('M')) }}
                </div>
                </div>
            @endif
            <div class="mt-2 flex flex-col items-start gap-2 lg:flex-row">
                <div>
                    <h1
                    class="text-2xl font-bold text-tp-midnight md:text-3xl lg:text-4xl"
                    >
                    {{$getRecord()->title}}
                    </h1>
                    @if(!empty($getRecord()->location))
                        <a
                        class="text-2xl font-extrabold text-tp-verdigris hover:text-tp-midnight"
                        href="{{$getRecord()->location_link}}"
                        target="_blank"
                        >
                        {{$getRecord()->location}}
                        </a>
                    @endif
                </div>
            </div>
        </div>
        <div class="lg:grid-sidebar mt-4 gap-8 lg:grid">
            <div class="swiper gallery-swiper swiper-initialized swiper-horizontal swiper-autoheight swiper-backface-hidden"> 
                <div class="swiper-wrapper"> 
                    <div class="swiper-slide border border-black swiper-slide-active" data-title="Escola de Hotelaria e Turismo do Algarve arranca ano letivo com mais de 260 alunos inscritos" style="width: 800px;"> 
                        <img src="https://escolas.turismodeportugal.pt/images/noticias/escola-de-hotelaria-e-turismo-do-algarve-arranca-ano-letivo-com-mais-de-260-alunos-inscritos/1_galeria.webp" alt="Escola de Hotelaria e Turismo do Algarve arranca ano letivo com mais de 260 alunos inscritos" width="1200" height="800"> 
                    </div> 
                </div> 
                <div class="mt-2 flex flex-row items-center gap-4">
                    <div class="swiper-credits text-base text-tp-midnight">
                        Aqui no futuro vai a label da iamgem
                    </div> 
                </div>  
            </div>  
            <div class="prose prose-lg mt-8 max-w-none">
                {!!$getRecord()->content!!}
            </div> 
        </div>
        
    </div>
    
   
</div>
