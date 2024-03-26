@extends('layouts.app')
@section('content')
    <style>
        .checkbox-success {
            background-color: #cad0cc !important;
            color: red;
        }
    </style>
    <?php $userid = Auth::user()->id; ?>
    @can('add_number', \App\Models\LaboratoryResult::class)
        <div class="section">
            <div class="page-header">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="/" style="color:white"><i class="fe fe-life-buoy mr-1"></i>&nbsp {{ trans('app.Tahrirlash') }}
                        </a>
                    </li>
                </ol>
            </div>
            <div class="clearfix"></div>
            @if (session('message'))
                <div class="row massage">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="alert alert-success text-center">
                            <label for="checkbox-10 colo_success"> {{ trans('app.Duplicate Data') }} </label>
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
                                        <li>
                                            <a {{--- href="{!! url('/crops_type/list') !!}"---}} href="#">
                                                <span class="visible-xs"></span>
                                                <i class="fa fa-list fa-lg">&nbsp;</i>
                                                {{ trans('app.Ro\'yxat') }}
                                            </a>
                                        </li>
                                        <li class="active">
                                            <a {{--- href="{!! url('/crops_type/list/edit/' . $editid) !!}" ---}} href="#">
                                                <span class="visible-xs"></span>
                                                <i class="fa fa-plus-circle fa-lg">&nbsp;</i> <b>
                                                    {{ trans('app.Tahrirlash') }}</b>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <form action="{{ "/indicator_norm/list/modify/update/".$type->id }}" method="POST" enctype="multipart/form-data"
                                        data-parsley-validate class="form-horizontal form-label-left">
                                        <div class="row">
                                            @method('PUT')
                                            @csrf

                                            {{-- start no'rma --}}
                                            <div class="col-md-3 form-group has-feedback">
                                                <label class="form-label" for="name">{{ trans("app.Me’yor") }} <label
                                                        class="text-danger">*</label></label>
                                                <div class="">
                                                    <input type="text" name="value" class="form-control"
                                                        value="{{ $type->value }}">
                                                </div>
                                            </div>
                                            <div class="col-md-4 form-group has-feedback">
                                                <label class="form-label"
                                                    for="nd_name">{{ trans("app.Me’yordan ko'pi bilan(kamida)") }}
                                                    <label class="text-danger">*</label></label>
                                                <div class="">
                                                    <select name="measure_type" class="w-100 form-control custom-select">
                                                        <option value=""></option>
                                                        <option value="1"
                                                            @if ($type->measure_type == 1) selected @endif>
                                                            {{ trans('app.Kamida, %') }}</option>
                                                        <option value="2"
                                                            @if ($type->measure_type == 2) selected @endif>
                                                            {{ trans("app.Ko'pi bilan, %") }}</option>
                                                        <option value="4"
                                                            @if ($type->measure_type == 4) selected @endif>
                                                            %
                                                            {{-- {{ trans("app.bo'sh") }} --}}
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4 form-group has-feedback">
                                                <label class="form-label" for="nd_name">{{ trans('app.Me’yor izohi') }}
                                                    <label class="text-danger">*</label></label>
                                                <div class="">
                                                    <textarea id="data" name="comment" class="form-control" maxlength="500">{{ $type->value }}</textarea>
                                                </div>
                                            </div>
                                            {{-- end no'rma --}}
                                            <div class="col-12 col-md-6">
                                                <label class="form-label" style="visibility: hidden;">label</label>
                                                {{-- <input type="hidden" name="_token" value="{{ csrf_token() }}"> --}}
                                                <a class="btn btn-primary"
                                                    href="{{ URL::previous() }}">{{ trans('app.Cancel') }}</a>
                                                <button type="submit"
                                                    class="btn btn-success">{{ trans('app.Tahrirlash') }}</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
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

    <script src="{{ URL::asset('vendors/jquery/dist/jquery.min.js') }}"></script>
    {{-- <script type="text/javascript">
            $(document).ready(function() {
                $('.crop').select2({
                    minimumResultsForSearch: Infinity
                });
            })
        </script>

        <script type="text/javascript">
            $(document).ready(function() {
                $('.states').select2({
                    minimumResultsForSearch: Infinity
                });

                $('select.name_of_crop').on('change', function() {
                    getCitiesOfState($(this));
                });

                if ($('select.nds_of_cropName').attr('val')) {
                    getCitiesOfState($('select.name_of_crop'));
                }
            });

            function getCitiesOfState(th) {
                var stateid = th.val();
                var url = th.data('url');
                var citiesMenu = $('select.nds_of_cropName');

                $.ajax({
                    type: 'GET',
                    url: url,
                    data: {
                        crop_id: stateid,
                    },
                    success: function(response) {
                        citiesMenu.html(response);
                    }
                });
            }
        </script> --}}
@endsection
