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
        font-size: 10px;
        overflow: hidden; /* Prevent content from spilling over */
        position: relative;
        height: 100%;

        box-sizing: border-box;
    }

    .header__title {
        font-size: 11px;
        text-align: center;
        margin-top: 1px;
    }

    .header__intro {
        display: flex;
        justify-content: center;
        margin: 0 auto;
        text-align: center;
        font-size: 11px;
        max-width: 90%;
        line-height: 1;
    }

    .main__intro {
        display: flex;
        justify-content: center;
        margin: 0 auto;
        text-align: left;
        font-size: 10px;
        max-width: 100%;
        line-height: 1;
    }

    h1 {
        line-height: 1;
        text-align: center;
        font-size: 10px;
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

    .head_image img {
        max-width: 100%;
        /* Optional: To make sure the image is responsive */
        height: 100px;
        padding-left: 290px;
        padding-top: 40px;
    }

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
            <div class="container head_image" >
                <img src="{{ asset('/img/dashboard/gerb_bg.png') }}" alt="image" >
            </div>
        @endif

        <h2 class="header__title">
            O‘zbekiston Respublikasi Vazirlar Mahkamasi huzuridagi Agrosanoat majmui ustidan nazorat qilish Inspeksiyasi<br>
            qoshidagi “Qishloq xo'jaligi mahsulotlari sifatini baholash markazi” davlat muassasasi<br>
            Государственное учреждение «Центр оценки качества сельскохозяйственной продукции» при Инспекции по<br>
            контролю за агропромышленным комплексом при Кабинете Министров Республики Узбекистан<br>
            State company “Сenter for evaluation of the quality of agricultural products” under the Inspectionon the control of<br>
            agro-industrial complex under the Cabinet of Ministers of the Republic of Uzbekistan


        </h2>

        <h1 style="font-weight: bold; font-size: 16px; margin:0;line-height: normal;">SIFAT SERTIFIKATI <br>СЕРТИФИКАТ КАЧЕСТВА <br>CERTIFICATE OF QUALITY
        </h1>
{{--        <h2 class="header__intro" style="font-weight: bold;">Reestr raqami: {{ $test->prepared->region->series }}{{ $sert_number }}</h2>--}}
{{--        @else--}}
{{--            <h1 class="header__intro text-center" style="color:#f3775b; font-size: 24px"><b>Nomuvofiqlik bayonnomasi</b></h1>--}}
{{--        @endif--}}
            <div style="width: 100%; display: flex; justify-content: space-between;">
                <div style="width: 20%; display: inline-block;">
                    <span>Berildi<br> Выдан<br> Issued </span>
                </div>
                <div style="width: 30%;text-align: center; display: inline-block;">
                    <span>{{$formattedDate}} </span>
                </div>
            </div>

            <div style="width: 100%; display: flex; justify-content: space-between;">
                <div style="width: 20%; display: inline-block;">
                    <span>DON TURI<br> Род зерна<br> Type of grain</span>
                </div>
                <div style="width: 30%;text-align: center; display: inline-block;">
                    <span>{{$test->crops->name->name}}  </span>
                </div>
            </div>
{{--    <h2 class="main__intro"><b>KOD TN VED :</b> {{$test->crops->name->kodtnved}}</h2>--}}
            <div style="width: 100%; display: flex; justify-content: space-between;">
                <div style="width: 20%; display: inline-block;">
                    <span>KELIB CHIQISHI<br> Происхождение<br> Origin &nbsp; </span>
                </div>
                <div style="width: 30%;text-align: center; display: inline-block;">
                    <span>{{$test->crops->country->name}}</span>
                </div>
                <div style="width: 20%; display: inline-block;">
                    <span>HOSIL<br> Урожай <br> Harvest</span>
                </div>
                <div style="width: 20%;text-align: center; display: inline-block;">
                    <span>{{$test->crops->year }}</span>
                </div>
            </div>
{{--            line 3 data about transport--}}
            <div style="width: 100%; display: flex; justify-content: space-between;">
                <div style="width: 20%; display: inline-block;">
                    <span>TRANSPORT TURI <br> Вид транспорта <br> Type of transport </span>
                </div>
                <div style="width: 20%;text-align: center; display: inline-block;">
                    <span>{{ optional($test->client_data)->transport_type }}</span>
                </div>
                <div style="width: 20%; display: inline-block;">
                    <span>№ №</span>
                </div>
                <div style="width: 20%;text-align: center; display: inline-block;">
                    <span>{{ optional($test->client_data)->vagon_number }}</span>
                </div>
            </div>
{{--        4 line data about yuk--}}
            <div style="width: 100%; display: flex; justify-content: space-between;">
                <div style="width: 20%; display: inline-block;">
                    <span>YUK XATI №№ <br> Накладная <br>Invoice</span>
                </div>
                <div style="width: 15%;text-align: center; display: inline-block;">
                    <span>{{ optional($test->client_data)->yuk_xati }}</span>
                </div>
                <div style="width: 15%; display: inline-block;">
                    <span>JOYLAR SONI <br> Количество мест <br> Number of seats</span>
                </div>
                <div style="width: 15%;text-align: center; display: inline-block;">
                    <span>{{ optional($test->crops)->joy_soni }}</span>
                </div>
                <div style="width: 15%; display: inline-block;">
                    <span>VAZNI <br> Вес <br> Weight</span>
                </div>
                <div style="width: 15%;text-align: center; display: inline-block;">
                    <span>{{ optional($test->crops)->amount }} kg</span>
                </div>
            </div>
{{--            5- line data about sender--}}
            <div style="width: 100%; display: flex; justify-content: space-between;">
                <div style="width: 20%; display: inline-block;">
                    <span>JO‘NATUVCHI <br> Отправитель <br> Sender </span>
                </div>
                <div style="width: 25%;text-align: center; display: inline-block;">
                    <span>{{ optional($test->client_data)->sender_name }}</span>
                </div>
                <div style="width: 20%; display: inline-block;">
                    <span>OLUVCHI <br> Получатель <br> Recipient</span>
                </div>
                <div style="width: 25%;text-align: center; display: inline-block;">
                    <span>{{ optional($test->organization)->name }}</span>
                </div>
            </div>
{{--            6- line data about address--}}
            <div style="width: 100%; display: flex; justify-content: space-between;">
                <div style="width: 20%; display: inline-block;">
                    <span>MANZILI  <br> Местонахождение предприятия  <br> Location of the company</span>
                </div>
                <div style="width: 25%;text-align: center; display: inline-block;">
                    <span>{{ optional($test->client_data)->sender_address }}</span>
                </div>
                <div style="width: 20%; display: inline-block;">
                    <span>MANZILI  <br> Адрес получателя  <br> Recipient's address			</span>
                </div>
                <div style="width: 25%;text-align: center; display: inline-block;">
                    <span>{{ optional($test->organization)->full_address }}</span>
                </div>
            </div>
{{--            7- line data about stations--}}
            <div style="width: 100%; display: flex; justify-content: space-between;">
                <div style="width: 20%; display: inline-block;">
                    <span>JO‘NATISH STANSIYASI <br>Станция отправителя <br>Sender's station  </span>
                </div>
                <div style="width: 25%;text-align: center; display: inline-block;">
                    <span>{{ optional($test->client_data)->sender_station }}</span>
                </div>
                <div style="width: 20%; display: inline-block;">
                    <span>OLUVCHINING STANSIYASI (porti) <br>Станция назначения<br> Destination station </span>
                </div>
                <div style="width: 25%;text-align: center; display: inline-block;">
                    <span>{{ optional($test->organization)->reciever_station }}</span>
                </div>
            </div>
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
