@extends('layouts.pdf')
@section('styles')
<style>
    html,
    body {
        margin: 0;
        padding: 0;
        height: 100%;
        overflow: hidden;
    }

    .border-image {
        position: fixed;
        top: 0;
        left: 0;
        min-width: 100vw;
        min-height: 100vh;
        z-index: -1;
    }

    .invoice-cheque {
        width: 100% !important;
        font-size: 10px;
        overflow: hidden;
        position: relative;
        height: 100%;
        box-sizing: border-box;
    }

    .header__title {
        font-size: 13px;
        text-align: center;
        font-weight: bold;
        margin-top: 0;
        padding-top: 0;
        line-height: normal;
    }

    .container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .head_image img {
        max-width: 100%;
        height: 90px;
        padding-left: 340px;
        padding-top: 60px;
        padding-bottom: 0;
        margin-bottom: 0;
    }

    .text-center img {
        max-width: 100px;
        margin-top: auto;
    }

    .content {
        position: relative;
        z-index: 1;
    }

    .main__title {
        font-weight: bold;
        font-size: 13px;
        line-height: 0.8;
        padding-bottom: 2px;
        margin-top: 0;
        padding-top: 0;
        text-align: center;
    }

    .main__section {
        margin: 0 80px 40px 80px;

    }

    .row__labels {
        line-height: 0.9;
    }

    .row__section {
        width: 100%;
        display: flex;
        justify-content: space-between;
        padding: 3px;

    }

    .row__items {
        display: inline-block;
        width: 20%;
    }

    .small__row__items {
        display: inline-block;
        width: 12%;
    }

    .row__notes {
        display: inline-block;
        width: 29%;
    }
</style>
@endsection
@section('content')
    @if(optional(optional($app->crops)->name)->sertificate_type == 2)
        @include('sifat_sertificate._cheque2')
    @else
        @include('sifat_sertificate._cheque')
    @endif
@endsection
