@extends('layouts.app')
@section('content')
    <!-- page content -->
    <?php $userid = Auth::user()->id; ?>
    @can('viewAny',\App\Models\User::class)
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
                                            <a href="{!! url('/tests-laboratory/report')!!}">
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
                            <form id="invoice-form" method="post" action="{!! url('tests-laboratory/store') !!}" enctype="multipart/form-data"
                                  data-parsley-validate class="form-label-left form-horizontal upperform">
                                @csrf
                                <div class="row" >

                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <input type="hidden"  name="app_id" value="{{ $test->id}}" >
                                    <div class="col-md-4 form-group has-feedback {{ $errors->has('number') ? ' has-error' : '' }}">
                                        <label for="number" class="form-label certificate">Sinov bayonnoma raqami <label class="text-danger">*</label></label>
                                        <label for="number" style="display: none" class="form-label nocertificate">Taxlil natija raqami <label class="text-danger">*</label></label>
                                        <input type="number" class="form-control" maxlength="10" value="{{ old('number')}}"  name="number" required>
                                        @if ($errors->has('number'))
                                            <span class="help-block">
											 <strong>Natija raqami noto'g'ri shaklda kiritilgan</strong>
										   </span>
                                        @endif
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group overflow-hidden">
                                            <label class="form-label">Rahbar<label class="text-danger">*</label></label>
                                            <select class="w-100 form-control" name="director_id" required title="Rahbar tanlanishi kerak">
{{--                                                @if(count($directors))--}}
{{--                                                    <option value="">Rahbarni tanlang</option>--}}
{{--                                                @endif--}}
{{--                                                @foreach($directors as $director)--}}
{{--                                                    <option value="{{$director->id}}" @if($director->id == old('director_id')) selected @endif--}}
{{--                                                    > {{$director->name.' '.$director->lastname}} </option>--}}
{{--                                                @endforeach--}}
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4 form-group has-feedback {{ $errors->has('count') ? ' has-error' : '' }}">
                                        <label for="middle-name" class="form-label">Sinov na'munalarning soni <label class="text-danger">*</label></label>
                                        <input type="number" class="form-control" maxlength="25"  name="count" value="{{ old('count')}}" required>
                                        @if ($errors->has('count'))
                                            <span class="help-block">
											 <strong>Na'munalar soni noto'g'ri shaklda kiritilgan</strong>
										   </span>
                                        @endif
                                    </div>

                            <div class="table-responsive">
                                <table id="examples1" class="table table-striped table-bordered nowrap" style="margin-top:20px;" >
                                    <thead style="text-align: center">
                                    <tr>
                                        <th>T\r</th>
                                        <th>Sifat ko'rsatkichlari</th>
                                        <th>Me'yoriy hujjat nomi</th>
                                        <th>MH bo'yicha me'yorlar</th>
                                        <th>Sinov natijasi</th>
                                        <th>Ko'rsatkichlarga muvofiqligi</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php $t = 1; @endphp
                                    @foreach($test->indicators as $k => $indicator)
                                        @php $sum = 0; @endphp
                                        <tr>
                                            <td>@if(!$indicator->indicator->parent_id) {{$t}} @endif</td>
                                            <td><a href="{!! url('/laboratory-results/indicator-view/'.$indicator->indicator_id.'/'.$crop_id.'?test_id='.$test->id) !!}">{{$indicator->indicator->name}}</a></td>
                                            <td>{!! nl2br($indicator->indicator->nd_name) !!}</td>
                                            <td>{!! $indicator->indicator->default_value !!}</td>

                                            @foreach($test->laboratory_numbers as $number)
                                                @php
                                                    $indicator_id = optional($indicator->indicator)->id;
                                                    $result = $number->results()->whereHas('indicator', function ($query) use($indicator_id) {
                                                            $query->where('status', 3)
                                                                ->where('indicator_id', $indicator_id);

                                                        })->first();
                                                    if(!$result){
                                                         $result = $number->results()->whereHas('indicator', function ($query) use($indicator_id) {
                                                            $query->where('status', 2)
                                                                ->where('indicator_id', $indicator_id);

                                                        })->first();
                                                    }
                                                    $sum += optional($result)->value;
                                                    $k = $loop->count;
                                                @endphp
                                            @endforeach
                                            <td>{{$sum/$k}}</td>
                                            <td></td>
                                        </tr>
                                        @if(!$indicator->indicator->parent_id) @php $t=$t+1; @endphp @endif
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                                    <div class="form-group col-md-12 col-sm-12">
                                        <div class="col-md-12 col-sm-12 text-center">
                                            <a class="btn btn-primary" href="{{ URL::previous() }}">{{ trans('app.Cancel')}}</a>
                                            <button type="submit" onclick="disableButton()" id="invoice-form-submitter" class="btn btn-success">{{ trans('app.Submit')}}</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
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

