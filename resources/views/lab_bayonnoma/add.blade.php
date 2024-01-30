@extends('layouts.app')
@section('content')
    <!-- page content -->
    <?php $userid = Auth::user()->id; ?>
    @can('create', \App\Models\User::class)
        <div class="section">
            <div class="page-header">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><i class="fe fe-life-buoy mr-1"></i>&nbsp {{ trans('app.Qo\'shish') }}</li>
                </ol>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="panel panel-primary">
                                <div class="tab_wrapper page-tab">
                                    <ul class="tab_list">
                                        <li>
                                            <a href="{!! url('/akt/list') !!}">
                                                <span class="visible-xs"></span>
                                                <i class="fa fa-list fa-lg">&nbsp;</i> {{ trans('app.Ro\'yxat') }}
                                            </a>
                                        </li>
                                        <li class="active">
                                            <span class="visible-xs"></span>
                                            <i class="fa fa-plus-circle fa-lg">&nbsp;</i>
                                            <b>{{ trans('app.Qo\'shish') }}</b>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <form method="post" action="{!! url('/lab_bayonnoma/store') !!}" enctype="multipart/form-data"
                                class="form-horizontal upperform">
                                <div class="row">

                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="number" hidden value="{{ $data->id }}" name="akt_id">

                                    <div class="col-md-4 form-group has-feedback">
                                        <label class="form-label">{{ trans('app.Laboratoriya') }}
                                            <label class="text-danger">*</label></label>
                                        <input type="text" readonly
                                            value="{{ $data->test->application->decision->laboratory->certificate }}"
                                            class="form-control">
                                    </div>
                                    <div class="col-md-4 form-group has-feedback">
                                        <label class="form-label">{{ trans('app.Me\'yoriy hujjat') }}
                                            <label class="text-danger">*</label></label>
                                        <input type="text" readonly
                                            value="{{ \App\Models\Nds::getType()[$data->test->application->crops->name->nds->type_id] . '.' . $data->test->application->crops->name->nds->number . ' ' . $data->test->application->crops->name->nds->name }}"
                                            class="form-control">
                                    </div>

                                    <div class="col-md-4 form-group {{ $errors->has('lab_start_date') ? ' has-error' : '' }}">
                                        <label class="form-label">{{ trans('app.Mahsulotni laboratoriyaga berish sanasi') }}
                                            <label class="text-danger">*</label></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                                </div>
                                            </div>
                                            <input type="text" class="form-control" placeholder="dd.mm.yyyy"
                                                name="lab_start_date" data-mask="00.00.0000"
                                                value="{{ old('lab_start_date') }}" required />

                                        </div>
                                        @if ($errors->has('lab_start_date'))
                                            <span class="help-block">
                                                <strong class="text-danger">{{trans("app.Laboratoriya bayonnoma sanasi noto'g'ri shaklda kiritilgan")}}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col-md-4 form-group {{ $errors->has('date') ? ' has-error' : '' }}">
                                        <label class="form-label">{{ trans('app.Sinov Bayonnoma to\'ldirish sanasi') }} <label
                                                class="text-danger">*</label></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                                </div>
                                            </div>
                                            <input type="text" class="form-control" placeholder="dd.mm.yyyy" name="date"
                                                data-mask="00.00.0000" value="{{ old('date') }}" required />

                                        </div>
                                        @if ($errors->has('date'))
                                            <span class="help-block">
                                                <strong class="text-danger">{{trans("app.Laboratoriya bayonnoma sanasi noto'g'ri shaklda kiritilgan")}}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div id="tin-container" class="col-md-4 legal-fields">
                                        <div class="form-group">
                                            <label class="form-label">{{ trans('app.Sinov Bayonnoma raqami') }}<label
                                                    class="text-danger">*</label></label>
                                            <input class="form-control" type="text" name="number"
                                                value="{{ old('number') }}" />
                                        </div>
                                    </div>

                                    <div class="col-md-6 form-group has-feedback">
                                        <label class="form-label">{{ trans('app.Laboratoriya sinov natijasi') }}<label
                                                class="text-danger">*</label></label>
                                        <select class="w-100 form-control" name="test_result" required>
                                            <option value="">{{ trans('app.Laboratoriya sinov natijasini tanlang') }}</option>
                                            <option value="Muvofiq">Muvofiq</option>
                                            <option value="Nomuvofiq">Nomuvofiq</option>
                                        </select>
                                    </div>

                                    <div id="tin-container" class="col-md-4 legal-fields">
                                        <div class="form-group">
                                            <label class="form-label">{{ trans('app.Sinov o\'tkazgan mutaxassis') }}<label
                                                    class="text-danger">*</label></label>
                                            <input class="form-control" type="text" name="test_employee"
                                                value="{{ old('test_employee') }}" />
                                        </div>
                                    </div>

                                    <div class="col-md-8 form-group has-feedback">
                                        <label class="form-label"
                                            for="description">{{ trans('app.Qo\'shimcha ma\'lumotlar') }}<label
                                                class="text-danger">*</label></label>
                                        <div class="">
                                            <textarea id="description" name="description" class="form-control" maxlength="100">{{ old('description') }}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12 col-sm-12">
                                        <div class="col-md-12 col-sm-12 text-center">
                                            <a class="btn btn-primary"
                                                href="{{ URL::previous() }}">{{ trans('app.Cancel') }}</a>
                                            <button type="submit" class="btn btn-success" onclick="disableButton()"
                                                id="submitter">{{ trans('app.Submit') }}</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="{{ URL::asset('vendors/moment/min/moment.min.js') }}"></script>
    <script src="{{ URL::asset('vendors/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ URL::asset('vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js') }}"></script>
    <script type="text/javascript">
        function disableButton() {
            var button = document.getElementById('submitter');
            button.disabled = true;
            button.innerText = '{{ trans('app.Yuklanmoqda...') }}'; // Optionally, change the text to indicate processing
            setTimeout(function() {
                button.disabled = false;
                button.innerText = '{{ trans('app.Saqlash') }}'; // Restore the button text
            }, 1000);
        }
    </script>

@endsection
