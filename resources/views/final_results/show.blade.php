@extends('layouts.app')

@section('content')
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
                    <i class="fe fe-life-buoy mr-1"></i>&nbsp Yakuniy natija
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
                                    <li>
                                        <a href="{!! url('/final_results/search') !!}">
                                            <span class="visible-xs"></span>
                                            <i class="fa fa-list fa-lg">&nbsp;</i> {{ trans('app.Ro\'yxat') }}
                                        </a>
                                    </li>
                                    <li class="active">
                                        <span class="visible-xs"></span>
                                        <i class="fa fa-edit fa-lg">&nbsp;</i>
                                        <b>Yakuniy natijani ko'rish</b>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="row">
                                    <div class="col-md-8 col-sm-12 right_side">
                                        <div class="table_row row">
                                            <div class="col-md-5 col-sm-12 table_td">
                                                <b>Ariza raqami</b>
                                            </div>
                                            <div class="col-md-7 col-sm-12 table_td">
                                                <span class="txt_color">
                                                    {{ $result->test_program->application->app_number }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="table_row row">
                                            <div class="col-md-5 col-sm-12 table_td">
                                                <b>Ariza sanasi</b>
                                            </div>
                                            <div class="col-md-7 col-sm-12 table_td">
                                                <span class="txt_color">
                                                    {{ \Carbon\Carbon::createFromFormat('Y-m-d',  $result->test_program->application->date)->format('d.m.Y') }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="table_row row">
                                            <div class="col-md-5 col-sm-12 table_td">
                                                <b>Mahsulot nomi</b>
                                            </div>
                                            <div class="col-md-7 col-sm-12 table_td">
                                                <span class="txt_color">
                                                    {{ $result->test_program->application->crops->name->name }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="table_row row">
                                            <div class="col-md-5 col-sm-12 table_td">
                                                <b>Buyurtmachi korxona yoki tashkilot nomi</b>
                                            </div>
                                            <div class="col-md-7 col-sm-12 table_td">
                                                <span class="txt_color">
                                                    {{ optional($result->test_program)->application->organization->name }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="table_row row">
                                            <div class="col-md-5 col-sm-12 table_td">
                                                <b>
                                                    @if ($result->type == 2)
                                                        Sinov bayonnoma raqami
                                                    @else
                                                        Tahlil natija raqami
                                                    @endif
                                                </b>
                                            </div>
                                            <div class="col-md-7 col-sm-12 table_td">
                                                <span class="txt_color">
                                                    {{ $result->test_program->akt[0]->lab_bayonnoma[0]->number }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="table_row row">
                                            <div class="col-md-5 col-sm-12 table_td">
                                                <b>
                                                    @if ($result->type == 2)
                                                        Sinov bayonnoma sanasi
                                                    @else
                                                        Tahlil natija sanasi
                                                    @endif
                                                </b>
                                            </div>
                                            <div class="col-md-7 col-sm-12 table_td">
                                                <span class="txt_color">
                                                    {{ \Carbon\Carbon::createFromFormat('Y-m-d',  $result->test_program->akt[0]->lab_bayonnoma[0]->date)->format('d.m.Y')  }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="table_row row">
                                            <div class="col-md-5 col-sm-12 table_td">
                                                <b>
                                                    @if ($result->type == 2)
                                                        Sinov bayonnoma fayli
                                                    @else
                                                        Tahlil natija fayli
                                                    @endif
                                                </b>
                                            </div>
                                            <div class="col-md-7 col-sm-12 table_td">
                                                <span class="txt_color">
                                                    @if (optional($result)->attachment)
                                                        <a href="{{ route('attachment.download', ['id' => $result->attachment->id]) }}"
                                                            class="text-azure">
                                                            <i class="fa fa-download"></i> Asos fayli
                                                        </a>
                                                    @endif
                                                </span>
                                            </div>
                                        </div>
                                        @if ($result->type != 2)
                                            <div class="table_row row">
                                                <div class="col-md-5 col-sm-12 table_td">
                                                    <b>Tikilgan papka raqami</b>
                                                </div>
                                                <div class="col-md-7 col-sm-12 table_td">
                                                    <span class="txt_color">
                                                        {{ $result->folder_number }}
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="table_row row">
                                                <div class="col-md-5 col-sm-12 table_td">
                                                    <b>Izoh</b>
                                                </div>
                                                <div class="col-md-7 col-sm-12 table_td">
                                                    <span class="txt_color">
                                                        {{ $result->comment }}
                                                    </span>
                                                </div>
                                            </div>

                                        @endif

                                        @can('edit', $result)
                                            <div class="col-12 text-right m-2">
                                                <a href="/final_results/edit/{{ $result->id }}">
                                                    <button class="btn btn-primary">O'zgartirish</button>
                                                </a>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endsection
