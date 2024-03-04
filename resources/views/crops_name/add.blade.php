@extends('layouts.app')
@section('content')
    <style>
        .checkbox-success {
            background-color: #cad0cc !important;
            color: red;
        }
    </style>
    <?php $userid = Auth::user()->id; ?>
    @can('create', \App\Models\Application::class)
        <div class="section">
            <div class="page-header">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <i class="fe fe-life-buoy mr-1"></i>&nbsp {{ trans('app.Yangi qo\'shish') }}
                    </li>
                </ol>
            </div>
            <div class="clearfix"></div>
            @if (session('message'))
                <div class="row massage">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="alert alert-success danger text-center">

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
                                            <a href="{!! url('/crops_name/list') !!}">
                                                <span class="visible-xs"></span>
                                                <i class="fa fa-list fa-lg">&nbsp;</i>
                                                {{ trans('app.Ro\'yxat') }}
                                            </a>
                                        </li>
                                        <li class="active">
                                            <a href="{!! url('/crops_name/add') !!}">
                                                <span class="visible-xs"></span>
                                                <i class="fa fa-plus-circle fa-lg">&nbsp;</i> <b>
                                                    {{ trans('app.Qo\'shish') }}</b>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <form action="{{ url('/crops_name/store') }}" method="post" enctype="multipart/form-data"
                                        data-parsley-validate class="form-horizontal form-label-left">
                                        <div class="row">
                                            <div class="col-12 col-md-5">
                                                <div class="form-group">
                                                    <label class="form-label">{{ trans('app.Mahsulot nomi') }}
                                                        <label class="text-danger">*</label>
                                                    </label>
                                                    <input type="text" required="required" name="name"
                                                        class="form-control" value="{{ old('name') }}">
                                                </div>
                                            </div>
                                            <div id="tin-container" class="col-md-5 legal-fields">
                                                <div class="form-group">
                                                    <label class="form-label">{{ trans('app.Kod TN VED') }}<label
                                                            class="text-danger">*</label></label>
                                                    <input class="form-control" type="text" name="tnved"
                                                        data-field-name="tin" data-field-length="10" minlength="10"
                                                        data-mask="0000000000" maxlength="10" required="required"
                                                        title="10ta raqam kiriting!" data-pattern-mismatch="Noto'g'ri shakl"
                                                        value="{{ old('tnved') }}" />
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-2">
                                                <div class="form-group">
                                                    <label class="form-label"
                                                           for="first-name">{{trans('app.Mahsulot toifalar')}} <label
                                                            class="text-danger">*</label>
                                                    </label>
                                                    <select name="parent_id" class="region">
                                                        <option value=""></option>
                                                        @if(!empty($cropnames))
                                                            @foreach($cropnames as $cropname)
                                                                <option
                                                                    value="{{ $cropname->id }}">{{ $cropname->name }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-6 col-md-4 {{ $errors->has('image') ? ' has-error' : '' }}">
                                                <div class="row"
                                                    style="display: flex; justify-content: center; align-items: center; margin-top: 6.6%">
                                                    <label class="btn btn-primary" style="width: 30%;">
                                                        <input type="file" name="image" style="display: none;" />
                                                        {{ trans('app.Rasmni yuklang') }}
                                                    </label>
                                                </div>
                                                @if ($errors->has('image'))
                                                    <span class="help-block">
                                                        <strong>Xatolik</strong>
                                                    </span>
                                                @endif
                                            </div>


                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <div class="col-12 col-md-6">
                                                <label class="form-label" style="visibility: hidden;">label</label>
                                                <div class="form-group">
                                                    <a class="btn btn-primary"
                                                        href="{{ URL::previous() }}">{{ trans('app.Cancel') }}</a>
                                                    <button type="submit"
                                                        class="btn btn-success">{{ trans('app.Submit') }}</button>
                                                </div>
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
    <script type="text/javascript">
        $(document).ready(function() {
            $('.region').select2({
                minimumResultsForSearch: Infinity
            });
        })
    </script>
@endsection
