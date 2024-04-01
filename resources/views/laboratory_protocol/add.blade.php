@extends('layouts.app')
@section('content')
    <!-- page content -->
    <?php $userid = Auth::user()->id; ?>
    @can('add_number', \App\Models\LaboratoryResult::class)
        <div class="section">
            <div class="page-header">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <i class="fe fe-life-buoy mr-1"></i>&nbsp Sinov bayonnomasi qo'shish
                    </li>
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
                                            <a href="{!! url()->previous() !!}">
                                                <span class="visible-xs"></span>
                                                <i class="fa fa-list fa-lg">&nbsp;</i> {{ trans('app.Orqaga') }}
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
                            <form id="invoice-form" method="post" action="{!! url('laboratory-protocol/store') !!}"
                                enctype="multipart/form-data" data-parsley-validate class="form-horizontal form-label-left">
                                @csrf
                                <div class="row">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="test_id" value="{{ $test->id }}">
                                    <input type="hidden" name="type" value="{{ $test->laboratory_results->quality ?? '' }}">

                                    <div
                                        class="col-md-6 form-group has-feedback {{ $errors->has('number') ? ' has-error' : '' }}">
                                        @if (isset($test->laboratory_results->quality) && $test->laboratory_results->quality == 1)
                                            <label for="number" class="form-label certificate"
                                                style="display: inline-block">Sinov bayonnoma raqami <label
                                                    class="text-danger">*</label></label>
                                            {{-- @if ($errors->has('number')) --}}
                                                <span style="color:black">
                                                    <strong> (Oxirgi ro'yxatga olingan raqami :
                                                        <span style="color:red">{{ $max_number ?? null }}</span>)
                                                    </strong>
                                                </span>
                                            {{-- @endif --}}
                                        @else
                                            <label for="number" class="form-label nocertificate">Taxlil natija raqami <label
                                                    class="text-danger">*</label></label>
                                        @endif
                                        <input type="number" class="form-control" maxlength="10" value="{{ old('number') }}"
                                            name="number" required>
                                        @if ($errors->has('number'))
                                            <span class="help-block" style="color:red">
                                                <strong>Bunday sinov bayonnoma raqami oldindan ro'yxatdan o'tgan</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col-md-5 form-group {{ $errors->has('date') ? ' has-error' : '' }}">
                                        @if (isset($test->laboratory_results->quality) && $test->laboratory_results->quality == 1)
                                            <label class="form-label certificate">Bayonnoma sanasi <label
                                                    class="text-danger">*</label></label>
                                        @else
                                            <label class="form-label nocertificate"> Tahlil natija sanasi<label
                                                    class="text-danger">*</label></label>
                                        @endif
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                                </div>
                                            </div>
                                            <input type="text" id="date_of_birth" class="form-control date"
                                                placeholder="<?php echo getDatepicker(); ?>" name="date" value="{{ old('date') }}"
                                                onkeypress="return false;" required />
                                        </div>
                                        @if ($errors->has('start_date'))
                                            <span class="help-block">
                                                <strong style="color:red;">Sana noto'g'ti shaklda kiritilgan</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <a class="btn btn-primary" href="{{ URL::previous() }}">{{ trans('app.Cancel') }}</a>
                                    <button type="submit" onclick="disableButton()" id="submitter"
                                        class="btn btn-success">{{ trans('app.Submit') }}</button>
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
        $("input.date").datetimepicker({
            format: "dd-mm-yyyy",
            autoclose: 1,
            minView: 2,
            startView: 'decade',
            endDate: new Date(),
        });
    </script>
    <script>
        function disableButton() {
            var button = document.getElementById('submitter');
            button.disabled = true;
            button.innerText = 'Yuklanmoqda...'; // Optionally, change the text to indicate processing
            setTimeout(function() {
                button.disabled = false;
                button.innerText = 'Saqlash'; // Restore the button text
            }, 3000);
        }
    </script>
@endsection
