@extends('layouts.front')
@section('content')
<style>
    .btn-success {
        transform: scale(1);
    }

    body {
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        background-color: #f4f6f9;
    }

    .first-table td {
        width: 20%;
        text-align: center;
        padding: 5px;
        border: 1px solid #ddd;
    }

    table,
    th,
    td {
        border: 1px solid black;
        font-size: 20px !important;
    }

    td {
        font-weight: normal;
    }

    .nav-bg {
        border: 0px !important;
        background: var(--main-font-color) !important;
    }

    #invoice-cheque {
        position: relative;
        width: 100%;
        height: 100vh;
        z-index: 1;
    }

    #invoice-cheque::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image: url('/img/dashboard/dm_logo.jpg');
        background-position: center;
        background-repeat: no-repeat;
        background-size: auto;
        opacity: 0.3;
        z-index: -1;
        pointer-events: none;
    }

    .border-image {
        position: absolute;
        z-index: 1;
        min-width: -webkit-fill-available;
        object-fit: contain;
        max-height: 100%;
    }

    .border-image img {
        width: 100%;
        height: 1967px;
    }

    .head_image {
        display: flex;
        justify-content: center;
    }

    .head_image img {
        max-width: 180px;
    }

    .content {
        padding: 115px 120px 0 120px;
    }

    .header__title {
        text-align: center;
        margin-bottom: 20px;
        font-weight: bold;
        line-height: 1.8;
    }

    .header__title div {
        font-family: serif !important;
        padding: 0 !important;
        font-size: 15px !important;
    }

    .main__title {
        text-align: center;
        font-size: 16px;
        font-weight: bold;
        margin: 20px 0;
        text-transform: uppercase;
    }

    .main__section {
        margin-top: 20px;
    }

    .row__section {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0;
        border-bottom: 1px solid #ddd;
    }

    .row__items,
    .row__notes {
        flex: 1;
        padding: 5px 10px;
    }

    .row__labels {
        font-weight: bold;
        font-size: 13px;
        text-align: left;
    }

    .small__row__items {
        flex: 0.5;
        padding: 5px;
        text-align: center;
    }

    img[alt="QR Code"] {
        display: block;
        margin: 0 auto;
        border: 1px solid #ddd;
    }

    .row__notes span {
        display: block;
        font-size: 12px;
        text-align: left;
    }

    .p-4 {
        margin-bottom: 190px;
    padding: 0 !important;
}
</style>
<div class="section" style="margin-top: 140px;">
    <div class=" content-area ">
        <div class="page-header">
            <h4 class="page-title mb-0" style="color:white">Sifat sertifikati</h4>
        </div>

        <div class="panel panel-primary">
            <div class="tab_wrapper page-tab">
                <ul class="tab_list">
                    <li class="btn-warning">
                        <a class="text-light" href="{{  url()->previous() }}">
                            <span class="visible-xs"></span>
                            <i class="fa fa-arrow-left">&nbsp;</i> {{trans('app.Orqaga')}}
                        </a>
                    </li>
                    <li class="btn-primary">
                        <a class="text-light" href="{!! url('/sifat-sertificates/edit/'.$test->id)!!}">
                            <span class="visible-xs"></span>
                            <i class="fa fa-edit fa-lg">&nbsp;</i> {{ trans('app.Edit')}}
                        </a>
                    </li>
                    <li class="btn-success">
                        <a class="text-light sa-warning" url="{!! url('/sifat-sertificates/accept/'.$test->id)!!}">
                            <span class="visible-xs"></span>
                            <i class="fa fa-check fa-lg">&nbsp;</i> Tasdiqlash
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card p-4">

                    @include('sifat_sertificate._cheque')

                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script src="{{ URL::asset('vendors/jquery/dist/jquery.min.js') }}"></script>
<script>
    $('body').on('click', '.sa-warning', function() {

        var url = $(this).attr('url');


        swal({
            title: "Haqiqatdan ham tasdiqlashni xohlaysizmi?",
            text: "Tasdiqlangandan so'ng ma'lumotlarni o'zgartirib bo'lmaydi!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#297FCA",
            confirmButtonText: "Tasdiqlash!",
            cancelButtonText: "Bekor qilish",
            closeOnConfirm: false
        }).then((result) => {
            window.location.href = url;

        });
    });
</script>
<script>
    $(document).ready(function() {
        function fillCheque() {
            $('#application-date').text(moment(currenttest.date).format('DD.MM.YYYY'))
        }

        function printCheque() {
            $('#invoice-cheque').print({
                NoPrintSelector: '.no-print',
                title: '',
            })
        }

        let currenttest = @json($test);


        fillCheque()

        $('#print-invoice-btn').click(function(ev) {
            printCheque()
        })
    });
</script>
@endsection