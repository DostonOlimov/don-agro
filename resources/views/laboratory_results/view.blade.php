@extends('layouts.app')
@section('content')
    <!-- page content -->
    <?php $userid = Auth::user()->id; ?>
    @can('viewAny',\App\Models\LaboratoryResult::class)
        <div class="section">
            <!-- PAGE-HEADER -->
            <div class="page-header">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <i class="fe fe-life-buoy mr-1"></i>&nbsp {{trans('app.Sertifikatlashtirish bo\'yicha sinov ko\'rsatkichlar ro\'yxati')}}
                    </li>
                </ol>
            </div>
            @if(session('message'))
                <div class="row massage">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="alert alert-success text-center">
                            @if(session('message') == 'Successfully Submitted')
                                <label for="checkbox-10 colo_success"> {{trans('app.Successfully Submitted')}}</label>
                            @elseif(session('message')=='Successfully Updated')
                                <label for="checkbox-10 colo_success"> {{ trans('app.Successfully Updated')}}  </label>
                            @elseif(session('message')=='Successfully Deleted')
                                <label for="checkbox-10 colo_success"> {{ trans('app.Successfully Deleted')}}  </label>
                            @endif
                        </div>
                    </div>
                </div>
            @endif
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="panel panel-primary">
                                <div class="tab_wrapper page-tab">
                                    <ul class="tab_list">
                                        <li class="active">
                                            <a href="{!! url('/laboratory-results/list')!!}">
                                                <span class="visible-xs"></span>
                                                <i class="fa fa-list fa-lg">&nbsp;</i>
                                                {{ trans('app.Ro\'yxat')}}
                                            </a>
                                        </li>
                                        <li>
                                            <a  href="{{ URL::previous() }}">
                                                <span class="visible-xs"></span>
                                                <i class="fa fa-arrow-left fa-lg">&nbsp;</i> <b>
                                                    {{ trans('app.Orqaga')}}</b>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                                <div class="table-responsive">
                                    <table id="examples1" class="table table-striped table-bordered nowrap" style="margin-top:20px;" >
                                        <thead style="text-align: center">
                                        <tr>
                                            <th colspan="2">Normativ hujjat ko'rsatkichalari</th>
                                            <th >Normativ qiymati</th>
                                            <th >Natijalar</th>
                                            <th >Muvofiqligi</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php $tr = 1; @endphp
                                        @foreach($test->indicators as $k => $indicator)
                                            @php $sum = 0; @endphp
                                            <tr>
                                                <td>@if(!$indicator->indicator->parent_id) {{$tr}} @endif</td>
                                                <td>
                                                        {{$indicator->indicator->name}}
                                                        <span style="text-transform: lowercase;">
                                                @if ($indicator->indicator->measure_type == 1)
                                                                , {{trans("app.Kamida, %")}}
                                                            @elseif ($indicator->indicator->measure_type == 2)
                                                                , {{trans("app.Ko'pi bilan, %")}}
                                                            @elseif ($indicator->indicator->measure_type == 4)
                                                                , %
                                                            @endif
                                                </span>

                                                    {{(isset($indicator->indicator->nds->type_id)) ? '('.\App\Models\Nds::getType($indicator->indicator->nds->type_id).'.'.$indicator->indicator->nds->number/*.' '.$indicator->indicator->nds->name*/.')':""}}
                                                </td>
                                                <td>
                                                    @if($indicator->indicator->comment)
                                                        {{ $indicator->indicator->comment }}
                                                    @else
                                                        @if($indicator->indicator->value != 0)
                                                            {{ $indicator->indicator->value }}
                                                        @else
                                                            ruxsat etilmaydi
                                                        @endif
                                                    @endif
                                                </td>

                                                <td>
                                                    @if($indicator->indicator->nd_name)
                                                        @if($indicator->result != 0 || $indicator->indicator->value != 0)
                                                            {{ $indicator->result }}
                                                        @else
                                                            aniqlanmadi
                                                        @endif
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($indicator->indicator->nd_name)
                                                        @if( $indicator->type == 1 )  Muvofiq @else Nomuvofiq @endif
                                                    @endif
                                                </td>

                                            </tr>
                                            @if(!$indicator->indicator->parent_id) @php $tr=$tr+1; @endphp @endif
                                        @endforeach
                                        </tbody>
                                    </table>
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
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
            <script src="{{ URL::asset('vendors/moment/min/moment.min.js') }}"></script>
            <script src="{{ URL::asset('vendors/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
            <script src="{{ URL::asset('vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js') }}"></script>
            <script type="text/javascript">
                $("input.start_date").datetimepicker({
                    format: "dd-mm-yyyy",
                    autoclose: 1,
                    minView: 2,
                    startView:'decade',
                    endDate: new Date(),
                });
                $("input.end_date").datetimepicker({
                    format: "dd-mm-yyyy",
                    autoclose: 1,
                    minView: 2,
                    startView:'decade',
                    endDate: new Date(),
                });
                function disableButton() {
                    var button = document.getElementById('submitter');
                    button.disabled = true;
                    button.innerText = 'Yuklanmoqda...'; // Optionally, change the text to indicate processing
                    setTimeout(function() {
                        button.disabled = false;
                        button.innerText = 'Saqlash'; // Restore the button text
                    }, 1000);
                }
            </script>

@endsection


