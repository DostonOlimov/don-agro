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
                                            <a href="{{ URL::previous() }}">
                                                <span class="visible-xs"></span>
                                                <i class="fa fa-arrow-left fa-lg">&nbsp;</i> <b>
                                                    {{ trans('app.Orqaga')}}</b>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="table-responsive">
                                @php $t = 1; @endphp
                                <table class="table table-bordered nowrap p-5">
                                    @foreach($indicators as $k => $indicator)
                                        <tr style="height: 40px; text-align: center; font-weight: bold; font-size: 22px;">
                                            <td>@if(!$indicator->parent_id) {{$t}} @endif</td>
                                            <td width="50%" > {{$indicator->name}}</td>
                                            <td width="30%">{!! nl2br($indicator->nd_name) !!}</td>
                                            <td width="30%">{!! \App\Models\Nds::getType(optional($indicator->nds)->type_id).nl2br($indicator->nds->number) !!}</td>
                                            <td width="15%">
                                                @if($indicator->nd_name)
                                                    <a href="{!! url('/laboratory-results/indicator-view/'.$indicator->id.'/'.$id) !!}"><button type="button" class="btn btn-round btn-primary" style="width: 200px;height:30px;">{{trans('app.View')}}</button></a>
                                                @endif
                                            </td>
                                        </tr>
                                        @if(!$indicator->parent_id) @php $t=$t+1; @endphp @endif
                                    @endforeach
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
    <!-- /page content -->
    <script src="{{ URL::asset('vendors/jquery/dist/jquery.min.js') }}"></script>

@endsection
