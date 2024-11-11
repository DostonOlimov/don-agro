@php
    use SimpleSoftwareIO\QrCode\Facades\QrCode;
@endphp

<div id="invoice-cheque" class="py-4 col-12 background-image">
    @if($quality)
        <div class="text-center">
            <img  height="300" src="{{ asset('/img/dashboard/gerb.png') }}">
        </div>
    @endif
        <h2 style="text-align: center">O’zbekiston Respublikasi Qishloq xo’jaligi vazirligi huzuridagi <br> Agrosanoat majmui ustidan nazorat qilish
            Inspeksiyasi  qoshidagi <br> “Qishloq xo‘jaligi mahsulotlari sifatini baholash markazi” <br> davlat muassasasi</h2>

    @if($quality)
        <h1 class="text-center" ><b>SIFAT SERTIFIKATI</b></h1>
            <h2 class="text-center">Reestr raqami: </h2>
    @else
        <h1 class="text-center " style="color:#f3775b"><b>Nomuvofiqlik bayonnomasi</b></h1>
    @endif

    <h2 class="text-left"><b>Sertifikatlanuvchi mahsulot nomi :</b> {{$test->crops->name->name}} </h2>
    <h2 class="text-left"><b>KOD TN VED :</b> {{$test->crops->name->kodtnved}}</h2>

    <h2 class="text-left"><b>Berilgan sana :</b> {{ $formattedDate }} - yil</h2>

    <h2 class="text-left"><b>Ishlab chiqaruvchi (yetkazib beruvchi)  nomi : </b> {{ $test->organization->name }}</h2>
    <h2 class="text-left"><b>Ishlab chiqaruvchi (yetkazib beruvchi) manzili : </b>  {{ $test->organization->full_address }}</h2>

    <h2 class="text-left" style="display: inline;"><b>Texnik chigit to'da raqami : </b> {{$test->crops->party_number}}</h2>


    <h2 class="text-left"> <b>Xaridor (yog‘-moy korxonasi) nomi:&nbsp;</b>&nbsp;  {{ optional(optional($test->client_data)->client)->name}} &nbsp;  </h2>
    <div class="row">
        <div class="col-md-6" style="font-size: 28px"><b>Avtotransport/ vagon raqami: </b> {{ optional($test->client_data)->vagon_number}}</div>
        <div class="col-md-6" style="font-size: 28px"><b>Yuk xati:</b> {{ optional($test->client_data)->yuk_xati }}</div>
    </div>

    <h3 class="text-center"> ISHLAB CHIQARUVCHI (ETKAZIB BERUVCHI) NING MA’LUMOTLARI</h3>

    <h3 class="text-center"> IJROCHINING MA’LUMOTLARI</h3>

        @if($quality)
            <h3 class="main__intro"> To‘da yuqoridagi ko‘rsatkichlari bo‘yicha O’z DSt 596 standartining 4.1, 4.2 bandlariga muvofiq.</h3>
        @else
            <h3 class="main__intro" style="color:#f3775b"> To‘da yuqoridagi ko‘rsatkichlari bo‘yicha O’z DSt 596 standartining bandlariga nomuvofiq.</h3>
        @endif
            <h4>Alohida yozuvlar: Shartnoma raqami - {{ optional($test->client_data)->contract_number }} </h4>
            <div class="row">
        <div class="col-sm-6">
            <span style="padding: 5px; display: block;"><b>Ijrochi :</b>
            {{ $test->user->lastname . ' ' . ($test->user->name) }}

        </span>
        </div>
        <div class="col-sm-2"></div>
<!-- {{--        <div class="col-sm-4" style="display: flex; flex-direction: column; justify-content: end;">--}}
{{--            <div class="text-center"> {!! $qrCode !!}</div>--}}
{{--        </div>--}} -->
    </div>
    </div>

<script>
    function printCheque() {
        $('#invoice-cheque').print({
            NoPrintSelector: '.no-print',
            title: '',
        })
    }
</script>
