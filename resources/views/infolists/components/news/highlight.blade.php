<div class="block ml-5"> 
    <a href="/noticias/a-nossa-escola-e-uma-andquotescola-gandhiandquot" class=""> 
        <img src="https://escolas.turismodeportugal.pt/images/noticias/a-nossa-escola-e-uma-andquotescola-gandhiandquot/1_listagem.webp" alt="A Escola de Hotelaria e Turismo do Estoril, está entre os 30 projetos vencedores do Prémio Gandhi." width="325" height="205"> 
    </a> 
    <h3 class="mt-4 text-xl font-semibold leading-none text-tp-midnight"> 
    {{ $getRecord()->title }}
    </h3> 
    <a href="/escola/estoril" class="mt-auto text-sm font-semibold leading-tight text-es-{{$getRecord()->school->slug}} transition-colors hover:text-tp-midnight"> 
    {{ $getRecord()->school->name }}
    </a> 
    <div class="my-8 border-b-2 border-dotted border-tp-ghost"></div>
</div>