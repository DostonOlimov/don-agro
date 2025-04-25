@extends('layouts.front')
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


        #invoice-cheque {
            position: relative;
            width: 100%;

        }
        .background_image {
            position: absolute;
            top: 50%;
            left: 22%;
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
        /* .defavu_font{
            font-family: DejaVuSans;
            font-size: 13px;
        } */

        .analysis-section .full-width {
            width: 100%;
        }

        .analysis-section .bold {
            font-weight: bold;
        }


    </style>
@endsection
@section('content')
    @can('viewAny', \App\Models\Application::class)
        <div class=" content-area ">
            <div class="page-header">
                <h4 class="page-title mb-0" style="color:white">Sig'im xulosasi</h4>
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
                        <li class="btn-success">
                            <a class="text-light sa-warning" url="{{ url('/storage-conclusion/accept', $test) }}">
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

                        @include('storage_conclusion._cheque')

                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="section" role="main">
            <div class="card">
                <div class="card-body text-center">
                    <span class="titleup text-danger"><i class="fa fa-exclamation-circle" aria-hidden="true"></i>&nbsp
                        {{ trans('app.You Are Not Authorize This page.') }}</span>
                </div>
            </div>
        </div>
    @endcan
@endsection

@section('scripts')
    <script>
        $('body').on('click', '.sa-warning', function() {

            var url = $(this).attr('url');


            @if(auth()->user()->id == $test->director_id  or auth()->user()->id == 1)
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
            @else
            swal({
                type: "error",
                title: "Xatolik...",
                text: "Sizda tasdiqlash huquqi mavjud emas!",
            });
            @endif
        });
    </script>
@endsection
