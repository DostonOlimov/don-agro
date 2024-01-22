@extends('layouts.app')
@section('styles')
    <style>
        .first-table td {
            width: 20%;
            text-align: center;
            padding: 5px;
            border: 1px solid #ddd;
        }
    </style>
@endsection
@section('content')
    @can('view', \App\Models\User::class)
    <div class=" content-area ">
        <div class="page-header">
            <h4 class="page-title mb-0" style="color:white">Sinov dasturi</h4>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card p-4">
                    <div class="row">
                            @include('tests._cheque')

                    </div>
                    <div class="py-3">
                        <a href="{{url()->previous()}}" class="btn btn-primary">ortga</a>
                        <button class="btn btn-primary" id="print-invoice-btn">Chop etish</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @else
        <div class="section" role="main">
            <div class="card">
                <div class="card-body text-center">
                    <span class="titleup text-danger"><i class="fa fa-exclamation-circle" aria-hidden="true"></i>&nbsp {{ trans('app.You Are Not Authorize This page.')}}</span>
                </div>
            </div>
        </div>
    @endcan
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            function fillCheque() {
                $('#director-name').text((currentdecision.director.name.charAt(0)).concat(".",currentdecision.director.display_name.charAt(0),".",currentdecision.director.lastname))
                $('#application-date').text(moment(currentdecision.application.date).format('DD.MM.YYYY'))
            }
            function printCheque() {
                $('#invoice-cheque').print({
                    NoPrintSelector: '.no-print',
                    title: '',
                })
            }

            let currentdecision = @json($decision);
            let measure_type = @json($measure_type);
            let nds_type = @json($nds_type);
            let qrCode = @json($qrCode);


            fillCheque()

            $('#print-invoice-btn').click(function (ev) {
                printCheque()
            })
        });
    </script>
@endsection
