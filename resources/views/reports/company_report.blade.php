@extends('layouts.app')
@section('styles')
    <style>
        tr th {
            text-align: center;
        }
    </style>
@endsection
@section('content')
    <!-- page content -->
    <?php $userid = Auth::user()->id; ?>
    @can('viewAny', \App\Models\Application::class)
        <div class="section">
            <!-- PAGE-HEADER -->
            <div class="page-header">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <i class="fe fe-life-buoy mr-1"></i>&nbsp {{trans('message."Qishloq xo\'jaligi mahsulotlari sifatini baholash markazi" DM 2023 yil hosilidan jamg\'arilgan :name mahsulotlarini sertifikatlanishi bo\'yicha ma\'lumot', ['name'=>$name])}}
                    </li>
                </ol>
            </div>
            <!-- filter component -->
            <div class="row pb-2">
                <div class="col-sm-4">
                    <select class="w-100 form-control state_of_country custom-select" style="background-color: #c5ccd0" name="crop" id="crop">

                        @if(!empty($crop_names))

                            @foreach($crop_names as $state)

                                <option value="{{ $state->id }}" @if( ($crop && $crop == $state->id))  selected="selected" @endif> {{$state->name}} </option>

                            @endforeach

                        @endif

                    </select>
                </div>
                <div class="col-sm-4">
                    <!--filter component -->
                    <select class="w-100 form-control state_of_country custom-select" style="background-color: #c5ccd0" name="year" id="year">

                        @if(!empty($years))
                            <option value="">{{trans('app.Hammasi')}}</option>
                            @foreach($years as $key=>$name)

                                <option value="{{ $key }}" @if( ($year && $year == $key ))  selected="selected" @endif> {{$name}} </option>

                            @endforeach

                        @endif

                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div id="invoice-cheque">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <h4 style="text-align: right">{{trans('app.date', ['date' => date('d.m.Y')])}}</h4>
                                <table  class="table table-striped table-bordered " style="margin-top:20px;" >
                                    <thead>
                                    <tr>
                                        <th>№</th>
                                        <th>{{trans('app.Name')}}</th>
                                        <th>{{trans('app.Laboratoriya tahlillari uchun kelgan mahsulot miqdori', ['measure_type' => $measure_type])}}</th>
                                        <th>{{trans('app.Sertifikatlashtirilgan mahsulot miqdori', ['measure_type' => $measure_type])}}</th>
                                        <th>{{trans('app.Sifat bo\'yicha nomuvofiq deb topilgan mahsulot miqdori', ['measure_type' => $measure_type])}}</th>
                                        <th>{{trans('app.Tahlilda turgan mahsulot miqdori', ['measure_type' => $measure_type]) }}</th>
                                        @if($year)
                                        <th>{{trans('app.Ishlab chiqarilgan sana')}}</th>
                                        @endif
                                    </tr>

                                    </thead>
                                    <tbody>
                                    @foreach($states as $state)
                                        <tr>
                                          <td colspan="7" style="text-align: center;font-size: 22px;"><b>{{ $state->name }}</b></td>
                                        </tr>
                                        @php $i = 1; @endphp
                                        @foreach($state->areas as $city)
                                            @foreach($city->companies as $company)
                                                <tr>
                                                    <td>{{$i}}</td>
                                                    <td><a href="{!! url('/full-report?organization='.$company->id) !!}">{{ $company->name }}</a></td>
                                                    <td>{{ $company->total_amount }}</td>
                                                    <td>{{ $company->certificat_amount }}</td>
                                                    <td>{{ $company->defected_amount }}</td>
                                                    <td>{{ $company->progress_amount }}</td>
                                                    @if($year)
                                                        <td>{{$year}}</td>
                                                    @endif
                                                </tr>
                                                @php $i= $i+1; @endphp
                                            @endforeach
                                        @endforeach
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
        <div class="py-3">
            <a href="{{url()->previous()}}" class="btn btn-primary">{{trans('app.Ortga')}}</a>
            <button class="btn btn-primary" id="print-invoice-btn">{{trans('app.Chop etish')}}</button>
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
    <!-- /page content -->
    <script src="{{ URL::asset('vendors/jquery/dist/jquery.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            function fillCheque() {
            }
            function printCheque() {
                $('#invoice-cheque').print({
                    NoPrintSelector: '.no-print',
                    title: '',
                })
            }
            fillCheque()
            $('#print-invoice-btn').click(function (ev) {
                printCheque()
            })
        });
    </script>
@endsection
