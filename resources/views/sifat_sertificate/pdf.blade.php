@extends('layouts.pdf')
@section('styles')
<style>
    /* html,
    body {
        margin: 0;
        padding: 0;
        height: 100%;
        overflow: hidden;
    } */

    .border-image {
        position: fixed;
        top: 0;
        left: 0;
        min-width: 100vw;
        min-height: 100vh;
        /* background: url('img/dashboard/don_bg.png') 30 round; */
        /* background-size: cover; */
        z-index: -1;
    }


    .invoice-cheque {
        width: 100% !important;
        margin: 0;
        font-size: 16px;
        overflow: hidden;
        /* Prevent content from spilling over */
        position: relative;
        height: 100%;

        box-sizing: border-box;
    }

    .header__title {
        font-size: 16px;
        text-align: center;
        margin-top: 1px;
        text-transform: uppercase;
    }

    .header__intro {
        display: flex;
        justify-content: center;
        margin: 0 auto;
        text-align: center;
        font-size: 16px;
        max-width: 90%;
        line-height: 1.3;
    }

    .main__intro {
        display: flex;
        justify-content: center;
        margin: 0 auto;
        text-align: left;
        font-size: 16px;
        max-width: 100%;
        line-height: 1.6;
    }

    h1 {
        line-height: 1.6;
        text-align: center;
        font-size: 16px;
        font-weight: bold;
    }

    h2 {
        font-weight: normal;
        flex: 1;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin: 5px 0;
    }

    table th,
    table td {
        border: 1px solid black;
        padding: 3px;
        text-align: center;
    }

    table th {
        font-weight: bold;
    }

    table td {
        font-size: 14px;
    }

    .container {
        display: flex;
        justify-content: center;
        /* Horizontal centering */
        align-items: center;
        /* Vertical centering */
        height: 100vh;
        /* Full viewport height or adjust accordingly */
    }

    /*img {*/
    /*    max-width: 100%;*/
    /*    !* Optional: To make sure the image is responsive *!*/
    /*    height: 150px;*/
    /*    padding-left: 125px;*/
    /*}*/

    .text-center img {
        max-width: 100px;
        /* Restrict QR code width */
        margin-top: auto;
        /* Push the QR code to the bottom of the div */
    }

    @media (max-width: 768px) {
        .col-md-6 {
            flex: 0 0 100%;
            max-width: 100%;
            text-align: center;
            /* Align text to center on small screens */
        }
    }

    #invoice-cheque {
        position: relative;
        width: 100%;
        height: 100vh;
    }

    .content {
        position: relative;
        z-index: 1;
        /* Keeps content on top of the background image */
    }

    @media print {
        .invoice-cheque {
            width: 100%;
            border: none;
            margin: 0;
            padding: 0;
        }

        .header__tasdiqlayman,
        .header__title {
            margin: 0;
        }

        table th,
        table td {
            padding: 5px;
        }
    }
</style>
@endsection
@section('content')
@php
use SimpleSoftwareIO\QrCode\Facades\QrCode;
@endphp

<div class="border-image">
    <img src="{{ asset('/img/dashboard/don_bg.png') }}" alt="">
</div>
<div id="invoice-cheque" class="py-4 col-12 invoice-cheque ">
    <div class="content">
        @if($quality)
        {{-- <div class="container head_image" >--}}
        {{-- <img src="{{ asset('/img/dashboard/gerb.png') }}" alt="image" >--}}
        {{-- </div>--}}
        @endif

        <h2 class="header__title">Agrosanoat majmui ustidan nazorat qilish
            Inspeksiyasi qoshidagi <br> “Qishloq xo‘jaligi mahsulotlari sifatini baholash markazi” <br> davlat muassasasi</h2>

        @if($quality)
        <h1 style="font-weight: bold; color:#0a52de; font-size: 24px; margin:0">SIFAT SERTIFIKATI</h1>
        <h2 class="header__intro" style="font-weight: bold;">Reestr raqami: {{ $test->prepared->region->series }}{{ $sert_number }}</h2>
        @else
        <h1 class="header__intro text-center" style="color:#f3775b; font-size: 24px"><b>Nomuvofiqlik bayonnomasi</b></h1>
        @endif
        <h2 class="main__intro"><b>Sertifikatlanuvchi mahsulot nomi :</b> {{$test->crops->name->name}} </h2>
        <h2 class="main__intro"><b>KOD TN VED :</b> {{$test->crops->name->kodtnved}}</h2>


        <h2 class="main__intro"><b>Berilgan sana :</b> {{ $formattedDate }} - yil</h2>

        <h2 class="main__intro text-left"><b>Ishlab chiqaruvchi (yetkazib beruvchi) nomi : </b>{{ $test->organization->name }}</h2>
        <h2 class="main__intro text-left"><b>Ishlab chiqaruvchi (yetkazib beruvchi) manzili : </b>{{ $test->organization->full_address }}</h2>

        <h2 class="header__intro" style="display: inline;"><b>Texnik chigit to'da raqami : </b> {{$test->crops->party_number}}</h2>


        <h2 class="main__intro text-left"> <b>Xaridor (yog‘-moy korxonasi) nomi:&nbsp;</b>&nbsp; {{ optional(optional($test->client_data)->client)->name}} &nbsp; </h2>
        <div style="display: flex !important;  justify-content: space-between !important;">
            <h2 class="header__intro" style="display: inline;"><b>Avtotransport/ vagon raqami: </b> {{ optional($test->client_data)->vagon_number}}</h2>
            <h2 class="header__intro" style="display: inline;"><b> Yuk xati raqami : </b>{{optional($test->client_data)->yuk_xati }}</h2>
        </div>

        <h1 class="header__intro" style="margin-top: 10px;"> ISHLAB CHIQARUVCHI (ETKAZIB BERUVCHI) NING MA’LUMOTLARI</h1>

        <h1 class="header__intro" style="margin-top: 10px;"> IJROCHINING MA’LUMOTLARI</h1>
        <h2 class="main__intro"><b>Berilgan sana :</b> {{ $formattedDate }} - yil</h2>

        <h2 class="main__intro text-left"><b>Ishlab chiqaruvchi (yetkazib beruvchi) nomi : </b>{{ $test->organization->name }}</h2>
        <h2 class="main__intro text-left"><b>Ishlab chiqaruvchi (yetkazib beruvchi) manzili : </b>{{ $test->organization->full_address }}</h2>

        <h2 class="header__intro" style="display: inline;"><b>Texnik chigit to'da raqami : </b> {{$test->crops->party_number}}</h2>


        <h2 class="main__intro text-left"> <b>Xaridor (yog‘-moy korxonasi) nomi:&nbsp;</b>&nbsp; {{ optional(optional($test->client_data)->client)->name}} &nbsp; </h2>
        <div style="display: flex !important;  justify-content: space-between !important;">
            <h2 class="header__intro" style="display: inline;"><b>Avtotransport/ vagon raqami: </b> {{ optional($test->client_data)->vagon_number}}</h2>
            <h2 class="header__intro" style="display: inline;"><b> Yuk xati raqami : </b>{{optional($test->client_data)->yuk_xati }}</h2>
        </div>

        <h1 class="header__intro" style="margin-top: 10px;"> ISHLAB CHIQARUVCHI (ETKAZIB BERUVCHI) NING MA’LUMOTLARI</h1>

        <h1 class="header__intro" style="margin-top: 10px;"> IJROCHINING MA’LUMOTLARI</h1>
        <h2 class="main__intro"><b>Berilgan sana :</b> {{ $formattedDate }} - yil</h2>

        <h2 class="main__intro text-left"><b>Ishlab chiqaruvchi (yetkazib beruvchi) nomi : </b>{{ $test->organization->name }}</h2>
        <h2 class="main__intro text-left"><b>Ishlab chiqaruvchi (yetkazib beruvchi) manzili : </b>{{ $test->organization->full_address }}</h2>

        <h2 class="header__intro" style="display: inline;"><b>Texnik chigit to'da raqami : </b> {{$test->crops->party_number}}</h2>


        <h2 class="main__intro text-left"> <b>Xaridor (yog‘-moy korxonasi) nomi:&nbsp;</b>&nbsp; {{ optional(optional($test->client_data)->client)->name}} &nbsp; </h2>
        <div style="display: flex !important;  justify-content: space-between !important;">
            <h2 class="header__intro" style="display: inline;"><b>Avtotransport/ vagon raqami: </b> {{ optional($test->client_data)->vagon_number}}</h2>
            <h2 class="header__intro" style="display: inline;"><b> Yuk xati raqami : </b>{{optional($test->client_data)->yuk_xati }}</h2>
        </div>

        <h1 class="header__intro" style="margin-top: 10px;"> ISHLAB CHIQARUVCHI (ETKAZIB BERUVCHI) NING MA’LUMOTLARI</h1>

        <h1 class="header__intro" style="margin-top: 10px;"> IJROCHINING MA’LUMOTLARI</h1>

        @if($quality)
        <h3 class="main__intro" style="margin:0;padding: 0;line-height:1.2;color:#0a52de;"> To‘da yuqoridagi ko‘rsatkichlari bo‘yicha O‘z DSt 596 standartining 4.1, 4.2 va 4.3 bandlariga muvofiq.</h3>
        @else
        <h3 class="main__intro" style="color:#f3775b"> To‘da yuqoridagi ko‘rsatkichlari bo‘yicha O’z DSt 596 standartining bandlariga nomuvofiq.</h3>
        @endif
        <h4 style="margin-top: 0; padding-top: 2px">Alohida yozuvlar: Shartnoma raqami - {{ optional($test->client_data)->contract_number }} </h4>
        <div style="width: 100%; display: flex; justify-content: space-between;">
            <div style="width: 60%; display: inline-block; padding-bottom: 30px;">
                <b>Ijrochi :</b>
                {{ $test->user->lastname . ' ' . ($test->user->name) }}
            </div>

            <div style="width: 30%; @if($quality) padding-top:0; @else padding-top:60px; @endif text-align: center; display: inline-block;">
                <img src="data:image/png;base64,{{ $qrCode }}" style="height: 100px;" alt="QR Code"><br>

                <span style="display: block; margin-top: 5px;margin-left: 120px;">{{ substr($sert_number, 2) }}</span>

            </div>
        </div>
    </div>
</div>
@endsection