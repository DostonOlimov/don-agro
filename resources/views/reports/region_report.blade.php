@extends('layouts.app')
@section('styles')
    <style>
        .right_side .table_row, .member_right .table_row {
            border-bottom: 1px solid #dedede;
            float: left;
            width: 100%;
            padding: 1px 0px 4px 2px;
        }

        .table_row .table_td {
            padding: 8px 8px !important;
        }
        .input-container {
            position: relative;
            display: inline-block;
        }

        .input-container input[type="number"] {
            padding-right: 30px; /* Adjust this value as needed to make space for the icon */
        }

        .input-container i.fa-pencil {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
        }
        tr th {
            text-align: center;
        }
        .table-responsive_total td {
            padding: 15px 3px;
            font-size: 18px;
            text-align: center
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
                        <i class="fe fe-life-buoy mr-1"></i>&nbsp {{trans('message."Qishloq xo\'jaligi mahsulotlari sifatini baholash markazi" DM 2023 yil hosilidan jamg\'arilgan :name mahsulotlarini sertifikatlanishi bo\'yicha ma\'lumot', ['name' => $name])}}
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
                            <option value="">Ishlab chiqarilgan sana</option>
                            @foreach($years as $key=>$name)

                                <option value="{{ $key }}" @if( ($year && $year == $key ))  selected="selected" @endif> {{$name}} </option>

                            @endforeach

                        @endif

                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3 pb-2" >
                    <a class="btn btn-success" href="{{ route('excel.city',['crop'=>$crop,]) }}">
                        <i class="fa fa-file-excel-o"></i> Excel fayl</a>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <h4 style="text-align: right">{{trans('app.date', ['date' => date('d.m.Y')])}}</h4>
                                <table  class="table table-striped table-bordered " style="margin-top:20px;" >
                                    <thead>
                                    <tr>
                                        <th rowspan="2">№</th>
                                        <th rowspan="2">{{trans('app.Hudud nomi')}}</th>
                                        <th rowspan="2">{{ trans('app.Ekishga talab etiladigan mahsulot miqdori', ['measure_type' => $measure_type])}}</th>
                                        <th colspan="2">{{ trans('app.Laboratoriya tahlillari uchun kelgan mahsulot miqdori', ['measure_type' => $measure_type])}}</th>
                                        <th rowspan="2">{{ trans('app.Sertifikatlashtirilgan mahsulot miqdori', ['measure_type' => $measure_type])}}</th>
                                        <th rowspan="2">{{ trans('app.Sertifikatlangan mahsulot miqdori', ['measure_type' => $measure_type])}}</th>
                                        <th rowspan="2">%</th>
                                        <th rowspan="2">{{ trans('app.Sifat bo\'yicha nomuvofiq deb topilgan mahsulot miqdori', ['measure_type' => $measure_type])}}</th>
                                        <th rowspan="2">%</th>
                                        <th rowspan="2">{{ trans('app.Tahlilda turgan mahsulot miqdori', ['measure_type' => $measure_type]) }}</th>
                                        <th rowspan="2">%</th>
                                    </tr>
                                    <tr>
                                        <th>{{ trans('app.Miqdor', ['measure_type' => $measure_type]) }}</th>
                                        <th>%</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $offset = (request()->get('page', 1) - 1) * 50;
                                        $total_required = 0;
                                        $total_amount = 0;
                                        $total_amount2 = 0;
                                        $total_amount3 = 0;
                                        $total_amount4 = 0;
                                    @endphp
                                    @foreach($app_states as $app)
                                        <tr>
                                            @php
                                                $total_required += $app->required_amount;
                                                $total_amount += $app->total_amount;
                                                $total_amount2 += $app->total_amount_type_2;
                                                $total_amount3 += $app->total_amount_type_3;
                                                $total_amount4 += $app->total_amount_type_4;
                                            @endphp
                                            <td>{{$offset + $loop->iteration}}</td>
                                            <td><a href="{!! url('/full-report?city='.$app->state_id) !!}">{{$app->state_name }}</a></td>
                                            <td style="width: 150px">
                                                <div class="input-container">
                                                    <input type="number" step="0.01" class="form-control" name="amount" id="amount{{$app->state_id}}"
                                                           onchange="saveAnswer({{$app->state_id}} , this)"  value="{{$app->required_amount}}" @if($app->required_amount) {{'disabled'}} >
                                                         <i class="fa fa-pencil" onclick="changeDisplay(this,{{$app->state_id}})"></i> @endif
                                                </div>
                                            </td>
                                            <td>{{round($app->total_amount ?? 0,2)}}</td>
                                            <td>{{ $app->required_amount ? round(100 * $app->total_amount / $app->required_amount) : '100' }}%</td>
                                            <td>{{round((($app->total_amount ?? 0) - $app->total_amount_type_3),2) }}</td>
                                            <td>{{round($app->total_amount_type_2,2)}}</td>
                                            <td>{{$app->required_amount ? round(100 * $app->total_amount_type_2 / $app->required_amount) : '100'}}%</td>
                                            <td>{{round($app->total_amount_type_4,2)}}</td>
                                            <td>{{$app->required_amount ? round(100 * $app->total_amount_type_4 / $app->required_amount) : '100'}}%</td>
                                            <td>{{round($app->total_amount_type_3 ?? 0,2)}}</td>
                                            <td>{{$app->required_amount ? round(100 * $app->total_amount_type_3 / $app->required_amount) : '100'}}%</td>

                                        </tr>
                                    @endforeach
                                    <tr class="table-responsive_total">
                                        <td colspan="2" class="text-center">{{trans('app.Jami:')}}</td>
                                        <td>{{$total_required}}</td>
                                        <td>{{round($total_amount,2)}}</td>
                                        <td>{{ $total_required ? round(100 * $total_amount / $total_required) : '100' }}%</td>
                                        <td>{{round((($total_amount ?? 0) - $total_amount3),2) }}</td>
                                        <td>{{round($total_amount2,2)}}</td>
                                        <td>{{$total_required ? round(100 * $total_amount2 / $total_required) : '100'}}%</td>
                                        <td>{{round($total_amount4,2)}}</td>
                                        <td>{{$total_required ? round(100 * $total_amount4 / $total_required) : '100'}}%</td>
                                        <td>{{round($total_amount3,2)}}</td>
                                        <td>{{$total_required ? round(100 * $total_amount3 / $total_required) : '100'}}%</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div style="display: none">
            <div id="invoice-cheque" class="py-4 col-12" >
                <h2>{{trans('message."Qishloq xo\'jaligi mahsulotlari sifatini baholash markazi" DM 2023 yil hosilidan jamg\'arilgan :name mahsulotlarini sertifikatlanishi bo\'yicha ma\'lumot', ['name' => $name])}}</h2>
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <h4 style="text-align: right">{{trans('app.date', ['date' => date('d.m.Y')])}}</h4>
                            <table  class="table table-striped table-bordered " style="margin-top:20px;" >
                                <thead>
                                <tr>
                                    <th rowspan="2">№</th>
                                    <th rowspan="2">{{trans('app.Hudud nomi')}}</th>
                                    <th rowspan="2">{{ trans('app.Ekishga talab etiladigan mahsulot miqdori', ['measure_type' => $measure_type])}}</th>
                                    <th colspan="2">{{ trans('app.Laboratoriya tahlillari uchun kelgan mahsulot miqdori', ['measure_type' => $measure_type])}}</th>
                                    <th rowspan="2">{{ trans('app.Sertifikatlashtirilgan mahsulot miqdori', ['measure_type' => $measure_type])}}</th>
                                    <th rowspan="2">{{ trans('app.Sertifikatlangan mahsulot miqdori', ['measure_type' => $measure_type])}}</th>
                                    <th rowspan="2">%</th>
                                    <th rowspan="2">{{ trans('app.Sifat bo\'yicha nomuvofiq deb topilgan mahsulot miqdori', ['measure_type' => $measure_type])}}</th>
                                    <th rowspan="2">%</th>
                                    <th rowspan="2">{{ trans('app.Tahlilda turgan mahsulot miqdori', ['measure_type' => $measure_type]) }}</th>
                                    <th rowspan="2">%</th>
                                </tr>
                                <tr>
                                    <th>{{ trans('app.Miqdor', ['measure_type' => $measure_type]) }}</th>
                                    <th>%</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $offset = (request()->get('page', 1) - 1) * 50;
                                    $total_required = 0;
                                    $total_amount = 0;
                                    $total_amount2 = 0;
                                    $total_amount3 = 0;
                                    $total_amount4 = 0;
                                @endphp
                                @foreach($app_states as $app)
                                    <tr>
                                        @php
                                            $total_required += $app->required_amount;
                                            $total_amount += $app->total_amount;
                                            $total_amount2 += $app->total_amount_type_2;
                                            $total_amount3 += $app->total_amount_type_3;
                                            $total_amount4 += $app->total_amount_type_4;
                                        @endphp
                                        <td>{{$offset + $loop->iteration}}</td>
                                        <td>{{$app->state_name }}</td>
                                        <td style="width: 150px">
                                            {{ $app->required_amount ?  $app->required_amount : '0' }}
                                        </td>
                                        <td>{{round($app->total_amount ?? 0,2)}}</td>
                                        <td>{{ $app->required_amount ? round(100 * $app->total_amount / $app->required_amount) : '100' }}%</td>
                                        <td>{{round((($app->total_amount ?? 0) - $app->total_amount_type_3),2) }}</td>
                                        <td>{{round($app->total_amount_type_2,2)}}</td>
                                        <td>{{$app->required_amount ? round(100 * $app->total_amount_type_2 / $app->required_amount) : '100'}}%</td>
                                        <td>{{round($app->total_amount_type_4,2)}}</td>
                                        <td>{{$app->required_amount ? round(100 * $app->total_amount_type_4 / $app->required_amount) : '100'}}%</td>
                                        <td>{{round($app->total_amount_type_3 ?? 0,2)}}</td>
                                        <td>{{$app->required_amount ? round(100 * $app->total_amount_type_3 / $app->required_amount) : '100'}}%</td>

                                    </tr>
                                @endforeach
                                <tr class="table-responsive_total">
                                    <td colspan="2" class="text-center">{{trans('app.Jami:')}}</td>
                                    <td>{{$total_required}}</td>
                                    <td>{{round($total_amount,2)}}</td>
                                    <td>{{ $total_required ? round(100 * $total_amount / $total_required) : '100' }}%</td>
                                    <td>{{round((($total_amount ?? 0) - $total_amount3),2) }}</td>
                                    <td>{{round($total_amount2,2)}}</td>
                                    <td>{{$total_required ? round(100 * $total_amount2 / $total_required) : '100'}}%</td>
                                    <td>{{round($total_amount4,2)}}</td>
                                    <td>{{$total_required ? round(100 * $total_amount4 / $total_required) : '100'}}%</td>
                                    <td>{{round($total_amount3,2)}}</td>
                                    <td>{{$total_required ? round(100 * $total_amount3 / $total_required) : '100'}}%</td>
                                </tr>
                                </tbody>
                            </table>
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
        function changeDisplay(elm,id) {
            document.getElementById('amount'+id).removeAttribute('disabled');
            elm.remove();
        }
    </script>
    <script>
        function saveAnswer(id,elm) {
            if (elm.value > 0){
                $.ajax({
                    type: 'POST',
                    url: '{{ route('save.required_amount') }}',
                    data: {
                        _token: '{{ csrf_token() }}',
                        city_id : id,
                        crop_id : {{$crop}},
                        year : 2023,
                        amount: elm.value
                    },
                    success: function(response) {
                        location.reload();
                    }
                });
            }
        }
    </script>
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
