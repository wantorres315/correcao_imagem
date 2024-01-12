<h3 class="mt-4 text-xl font-semibold leading-none text-tp-midnight">Listagem</h3>
<br>
<div class="flex flex-col md:w-[325px]">
  <a
    href=#
    class="block transition-opacity hover:opacity-50"
  >
    <img
      src=https://escolas.turismodeportugal.pt/images/noticias/o-melhor-jovem-chef-mundial-e-portugues-e-foi-aluno-das-nossas-escolas/1_listagem.webp
      alt="{{ $getRecord()->title }}"
      width="325"
      height="205"
      class="w-full"
    />
  </a>
  <div class="mt-4 flex basis-full flex-col items-start">
    <div class="mb-2 flex flex-row items-start gap-4">
      <div
        class="flex flex-col rounded bg-tp-gainsboro text-center text-2xl font-semibold text-tp-midnight"
      >
        <div class="px-3 py-2">{{ \Carbon\Carbon::parse($getRecord()->date)->format('d') }}</div>
        <div class="rounded-b bg-tp-aqua-island px-3 py-1 text-base">
        {{ mb_strtoupper(\Carbon\Carbon::parse($getRecord()->date)->format('M')) }}
        </div>
      </div>
      <h3 class="mb-2 text-2xl font-semibold leading-none text-tp-midnight">
        {{$getRecord()->title}}
      </h3>
    </div>
    @if(!empty($getRecord()->dateEnd))
        <div class="mb-2 flex flex-row items-start gap-4">
          <div class="flex flex-col rounded bg-tp-gainsboro text-center text-2xl font-semibold text-tp-midnight">
            <div class="px-3 py-2">{{ \Carbon\Carbon::parse($getRecord()->dateEnd)->format('d') }}</div>
            <div class="rounded-b bg-tp-aqua-island px-3 py-1 text-base">
            {{ mb_strtoupper(\Carbon\Carbon::parse($getRecord()->dateEnd)->format('M')) }}
            </div>
          </div>
          <div class="mb-2 leading-none text-tp-midnight">
          {{$getRecord()->intro}}
          </div>
        </div>
      @else
        <div class="mb-2 flex flex-row items-start gap-4">
          <div class="mb-2 leading-none text-tp-midnight">
          {{$getRecord()->intro}}
          </div>
        </div>
      @endif
    

    <div class="mt-auto text-base font-semibold leading-tight text-es-{{$getRecord()->school->slug}} transition-colors hover:text-tp-midnight">
        {{ $getRecord()->school->name }}
    </div>
  </div>
</div>
