@extends('layouts.pdf')
@section('styles')
    <style>
        .invoice-cheque {
            width: 100% !important;
            font-size: 16px;
            overflow: hidden; /* Prevent content from spilling over */
        }

        .header__title {
            font-size: 14px;
            text-align: center;
            text-transform: uppercase;
            padding:0;
        }

        .header__intro {
            display: flex;
            justify-content: center;
            margin: 0;
            padding:0;
            text-align: center;
            font-size: 14px;
            max-width: 100%;

        }
        .head__title{
            font-weight: bold;
            color:#0a52de;
            font-size: 20px;
            margin:0;
            text-align: center;
            padding-bottom:5px;
        }

        .main__intro {
            display: flex;
            justify-content: center;
            margin: 0;
            padding:0;
            text-align: left;
            font-size: 16px;
            max-width: 100%;
            font-weight: normal;
            flex: 1;

        }

        h1 {
            text-align: center;
            font-size: 16px;
            font-weight: bold;
        }

        .actual_table table {
            width: 100%;
            border-collapse: collapse;
            margin: 3px 0;
        }

        .actual_table table th,
        table td {
            border: 1px solid black;
            padding: 1px;
            text-align: center;
        }

        .actual_table table th {
            font-weight: bold;
            font-size: 14px;
        }

        .actual_table table td {
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

        img {
            max-width: 100%;
            padding:0;
            margin:0;
            /* Optional: To make sure the image is responsive */
            height: 100px;
            padding-left: 215px;
        }

        #invoice-cheque {
            position: relative;
            width: 100%;

        }
        .background_image {
            position: absolute;
            top: 42%;
            left: 20%;
            transform: translate(-50%, -50%); /* Center the image */
            width: 500px;
            height: auto;
            opacity: 0.1; /* Adjust the opacity as needed */
            z-index: -1;
        }
        .content {
            position: relative;
            z-index: 1; /* Keeps content above the image */
        }

        .analysis-section table {
            width: 100%;
            border-collapse: collapse;
            font-size: 16px;
        }

        .analysis-section td {
            padding: 2px 2px;
            vertical-align: top;
            text-align: left;
            border: none; /* no borders */
        }
        .analysis-section .sm__column {
            width: 15%;
        }

        .section-title {
            text-align: center;
            font-weight: bold;
            font-size: 18px;
            color: #0a52de;
            margin-bottom: 2px;
            padding-top:0;
            margin-top:1px;
        }
        .defavu_font{
            font-family: DejaVuSans;
            font-size: 13px;
        }

        .analysis-section .full-width {
            width: 100%;
        }

        .analysis-section .bold {
            font-weight: bold;
        }


    </style>
@endsection
@section('content')
    @php
        use SimpleSoftwareIO\QrCode\Facades\QrCode;
    @endphp

    @include('storage_conclusion._cheque')

@endsection
