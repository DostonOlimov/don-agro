@extends('layouts.app')

@section('content')
    @can('view', \App\Models\Application::class)
            <style>              
                .right_side .table_row,
                .member_right .table_row {
                    border-bottom: 1px solid #dedede;
                    float: left;
                    width: 100%;
                    padding: 1px 0px 4px 2px;
                }

                .table_row .table_td {
                    padding: 8px 8px !important;
                }
                
            </style>
            <div class="section">
                <div class="page-header">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <i class="fe fe-life-buoy mr-1"></i>&nbsp {{ trans('app.Kompaniya') }}
                        </li>
                    </ol>
                </div>
                @if (session('message'))
                    <div class="row massage">
                        <div class="col-md-12 col-sm-12">
                            <div class="alert alert-success text-center">
                                <input id="checkbox-10" type="checkbox" checked="">
                                <label for="checkbox-10 colo_success"> {{ session('message') }} </label>
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
                                            <li class="btn-warning">
                                                <a class="text-light" href="{{ URL::previous() }}">
                                                    <span class="visible-xs"></span>
                                                    <i class="fa fa-arrow-left">&nbsp;</i> {{ trans('app.Orqaga') }}
                                                </a>
                                            </li>
                                            <li class="active">
                                                <span class="visible-xs"></span>
                                                <i class="fa fa-eye fa-lg">&nbsp;</i>
                                                <b>{{ trans('app.Kompaniyani ko\'rish') }}</b>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <div class="row">
                                            <div class="col-md-8 col-sm-12 right_side">
                                                <div class="table_row row">
                                                    <div class="col-md-7 col-sm-12 table_td">
                                                        <i class="fa fa-building"></i>&nbsp;
                                                        <b>{{ trans('app.Buyurtmachi korxona yoki tashkilot  STIRi') }}</b>
                                                    </div>
                                                    <div class="col-md-5 col-sm-12 table_td">
                                                        <span class="txt_color">
                                                            {{ $company->inn }}
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="table_row row">
                                                    <div class="col-md-7 col-sm-12 table_td">
                                                        <i class="fa fa-building"></i>&nbsp;
                                                        <b>{{ trans('app.Buyurtmachi korxona yoki tashkilot nomi') }}</b>
                                                    </div>
                                                    <div class="col-md-5 col-sm-12 table_td">
                                                        <span class="txt_color">
                                                            {{ $company->name }}
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="table_row row">
                                                    <div class="col-md-7 col-sm-12 table_td">
                                                        <i class="fa fa-globe"></i>&nbsp;
                                                        <b>Buyurtmachi korxona yoki tashkilot viloyat</b>
                                                    </div>
                                                    <div class="col-md-5 col-sm-12 table_td">
                                                        <span class="txt_color">
                                                            {{ optional($company->city)->region->name }}
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="table_row row">
                                                    <div class="col-md-7 col-sm-12 table_td">
                                                        <i class="fa fa-globe"></i>&nbsp;
                                                        <b>Buyurtmachi korxona yoki tashkilot shahri</b>
                                                    </div>
                                                    <div class="col-md-5 col-sm-12 table_td">
                                                        <span class="txt_color">
                                                            {{ optional($company->city)->name }}
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="table_row row">
                                                    <div class="col-md-7 col-sm-12 table_td">
                                                        <i class="fa fa-address-book"></i>&nbsp;
                                                        <b>Buyurtmachi korxona yoki tashkilot manzili</b>
                                                    </div>
                                                    <div class="col-md-5 col-sm-12 table_td">
                                                        <span class="txt_color">
                                                            {{ $company->address }}
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="table_row row">
                                                    <div class="col-md-7 col-sm-12 table_td">
                                                        <i class="fa fa-user"></i>&nbsp;
                                                        <b>Buyurtmachi korxona yoki tashkilot rahbari</b>
                                                    </div>
                                                    <div class="col-md-5 col-sm-12 table_td">
                                                        <span class="txt_color">
                                                            {{ $company->owner_name }}
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="table_row row">
                                                    <div class="col-md-7 col-sm-12 table_td">
                                                        <i class="fa fa-phone"></i>&nbsp;
                                                        <b>Buyurtmachi korxona yoki tashkilot telefon raqami</b>
                                                    </div>
                                                    <div class="col-md-5 col-sm-12 table_td">
                                                        <span class="txt_color">
                                                            {{ $company->phone_number }}
                                                        </span>
                                                    </div>
                                                </div>

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
        @endsection
