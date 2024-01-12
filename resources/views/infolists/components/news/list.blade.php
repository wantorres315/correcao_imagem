<h3 class="mt-4 text-xl font-semibold leading-none text-tp-midnight">Listagem</h3>

<div class="flex flex-col md:w-[325px] mt-10"> 
    <a href="/noticias/o-melhor-jovem-chef-mundial-e-portugues-e-foi-aluno-das-nossas-escolas" class="block transition-opacity hover:opacity-50"> 
        <img src="https://escolas.turismodeportugal.pt/images/noticias/o-melhor-jovem-chef-mundial-e-portugues-e-foi-aluno-das-nossas-escolas/1_listagem.webp" alt="O Melhor Jovem Chef Mundial é português e foi aluno da(s) nossa(s) escola(s)!" width="325" height="205" class="w-full"> 
    </a> 
    <div class="mt-4 flex basis-full flex-col items-start"> 
        <h3 class="mb-2 text-2xl font-semibold leading-none text-tp-midnight"> 
        {{ $getRecord()->title }}
        </h3> 
        <p class="mb-4 line-clamp-3 text-lg text-tp-midnight">{{ $getRecord()->intro }}</p> 
        <div class="mt-auto flex w-full flex-row items-center justify-center"> 
            <a href="/escola/coimbra" class="text-base font-semibold leading-tight text-es-{{$getRecord()->school->slug}} transition-colors hover:text-tp-midnight"> 
            {{ $getRecord()->school->name }}
            </a> 
            <div class="ml-auto text-right text-sm text-tp-midnight">
            {{ \Carbon\Carbon::parse($getRecord()->date)->format('d/m/Y') }}
            </div> 
        </div> 
    </div> 
</div>