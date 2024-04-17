@extends('layouts.app')

@section('content')
    @can('accept', $user)

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

                .txt_color a:visited {
                    color: blue !important;
                }
            </style>
            <div class="section">
                <div class="page-header">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <i class="fa fa-file mr-1"></i>&nbsp {{ trans("app.Ariza ma'lumotlari") }}
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
                @if ($user->comment)
                    <div class="row massage">
                        <div class="col-md-12 col-sm-12">
                            <div class="alert alert-danger text-center">
                                <label for="checkbox-10 colo_danger">Arizani rad etilish sababi :
                                    {{ optional($user->comment)->comment }}</label>
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
                                            @if ($user->status < \App\Models\Application::STATUS_FINISHED)
                                            <li class="btn-warning">
                                                <a class="text-light" href="{{ URL::previous() }}">
                                                    <span class="visible-xs"></span>
                                                    <i class="fa fa-arrow-left">&nbsp;</i> {{ trans('app.Orqaga') }}
                                                </a>
                                            </li>
                                            <li class="btn-primary">
                                                <a class="text-light" href="{!! url('/application/edit/' . $user->id) !!}">
                                                    <span class="visible-xs"></span>
                                                    <i class="fa fa-edit fa-lg">&nbsp;</i> {{ trans('app.Edit') }}
                                                </a>
                                            </li>
                                            @endif
                                            @if ($user->status == \App\Models\Application::STATUS_NEW)
                                                <li class="btn-success">
                                                    <a class="text-light sa-warning" url="{!! url('/application/accept/' . $user->id) !!}">
                                                        <span class="visible-xs"></span>
                                                        <i class="fa fa-check fa-lg">&nbsp;</i> {{ trans('app.Qabul qilish') }}
                                                    </a>
                                                </li>
                                                <li class="btn-danger">
                                                    <a class="text-light" href="{!! url('/application/reject/' . $user->id) !!}">
                                                        <span class="visible-xs"></span>
                                                        <i class="fa fa-times fa-lg">&nbsp;</i> {{ trans('app.Rad etish') }}
                                                    </a>
                                                </li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12 right_side">
                                                @if ($user->status != \App\Models\Application::STATUS_NEW)
                                                    <h4><b>{{ trans("app.Arizachi ma'lumotlari") }}</b></h4>
                                                    @if ($user->is_online==1)
                                                        <div class="table_row row">
                                                            <div class="col-md-5 col-sm-12 table_td">
                                                                <b>{{ trans('app.Ariza beruvchi') }}</b>
                                                            </div>
                                                            <div class="col-md-7 col-sm-12 table_td">
                                                                <span class="txt_color">
                                                                    {{ optional($user->user)->role == \App\Models\User::ROLE_CUSTOMER ? 'Fuqaro' : 'Xodim' }}
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="table_row row">
                                                            <div class="col-md-5 col-sm-12 table_td">
                                                                <b>{{ trans('app.Arizachi ismi-sharifi') }}</b>
                                                            </div>
                                                            <div class="col-md-7 col-sm-12 table_td">
                                                                <span class="txt_color">
                                                                    {{ optional($user->user)->name . ' ' . optional($user->user)->lastname }}
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="table_row row">
                                                            <div class="col-md-5 col-sm-12 table_td">
                                                                <b>{{ trans('app.Arizachi elektron pochta manzili') }}</b>
                                                            </div>
                                                            <div class="col-md-7 col-sm-12 table_td">
                                                                <span class="txt_color">
                                                                    {{ optional($user->user)->email }}
                                                                </span>
                                                            </div>
                                                        </div>
                                                    @endif
                                                    <div class="table_row row">
                                                        <div class="col-md-5 col-sm-12 table_td">
                                                            <b>{{ trans('app.Ariza berilgan sanasi') }}</b>
                                                        </div>
                                                        <div class="col-md-7 col-sm-12 table_td">
                                                            <span class="txt_color">
                                                                {{ \Carbon\Carbon::parse($user->date)->format('d.m.Y') }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                @endif
                                                <div class="table_row row"
                                                    @if ($user->status != \App\Models\Application::STATUS_NEW) style="margin-top: 5%" @endif>
                                                    <h4><b>{{ trans("app.Ariza ma'lumotlari") }}</b></h4>
                                                </div>
                                                <div class="table_row row">
                                                    <div class="col-md-5 col-sm-12 table_td">
                                                        <b>{{ trans('app.Ariza raqami') }}</b>
                                                    </div>
                                                    <div class="col-md-7 col-sm-12 table_td">
                                                        <span class="txt_color">
                                                            {{ $user->app_number == 0 ? '-' : $user->app_number }}
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="table_row row">
                                                    <div class="col-md-5 col-sm-12 table_td">
                                                        <b>{{ trans('app.Ariza qabul qilingan sana') }}</b>
                                                    </div>
                                                    <div class="col-md-7 col-sm-12 table_td">
                                                        <span class="txt_color">
                                                            {{ $user->status == \App\Models\Application::STATUS_FINISHED ? \Carbon\Carbon::parse($user->date)->format('d.m.Y') : '-' }}
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="table_row row">
                                                    <div class="col-md-5 col-sm-12 table_td">
                                                        <b>{{ trans('app.Ishlab chiqargan davlat') }}</b>
                                                    </div>
                                                    <div class="col-md-7 col-sm-12 table_td">
                                                        <span class="txt_color">
                                                            {{ $country ?? '' }}
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="table_row row">
                                                    <div class="col-md-5 col-sm-12 table_td">
                                                        <b>{{ trans('app.Mahsulot tayorlangan shaxobcha yoki sexning nomi') }}</b>
                                                    </div>
                                                    <div class="col-md-7 col-sm-12 table_td">
                                                        <span class="txt_color">
                                                            {{ optional($user->prepared)->name }}
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="table_row row">
                                                    <div class="col-md-5 col-sm-12 table_td">
                                                        <b>{{ trans('app.Mahsulot turi') }}</b>
                                                    </div>
                                                    <div class="col-md-7 col-sm-12 table_td">
                                                        <span class="txt_color">
                                                            {{ optional($user->crops->name)->name }}
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="table_row row">
                                                    <div class="col-md-5 col-sm-12 table_td">
                                                        <b>{{ trans('app.Mahsulot navi') }}</b>
                                                    </div>
                                                    <div class="col-md-7 col-sm-12 table_td">
                                                        <span class="txt_color">
                                                            {{ optional($user->crops->type)->name }}
                                                        </span>
                                                    </div>
                                                </div>
                                                {{-- <div class="table_row row">
                                                <div class="col-md-5 col-sm-12 table_td">
                                                    <b>Eki n avlodi</b>
                                                </div>
                                                <div class="col-md-7 col-sm-12 table_td">
                                            <span class="txt_color">
                                                {{ optional($user->crops->generation)->name  }}
                                            </span>
                                                </div>
                                            </div> --}}
                                                <div class="table_row row">
                                                    <div class="col-md-5 col-sm-12 table_td">
                                                        <b>{{ trans('app.Kod TN VED') }}</b>
                                                    </div>
                                                    <div class="col-md-7 col-sm-12 table_td">
                                                        <span class="txt_color">
                                                            {{ optional($user->crops)->kodtnved }}
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="table_row row">
                                                    <div class="col-md-5 col-sm-12 table_td">
                                                        <b>{{ trans('app.Partiya raqami') }}</b>
                                                    </div>
                                                    <div class="col-md-7 col-sm-12 table_td">
                                                        <span class="txt_color">
                                                            {{ optional($user->tests)->akt[0]->party_number ?? '' }}
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="table_row row">
                                                    <div class="col-md-5 col-sm-12 table_td">
                                                        <b>{{ trans('message.Miqdori') }}</b>
                                                    </div>
                                                    <div class="col-md-7 col-sm-12 table_td">
                                                        <span class="txt_color">
                                                            {{ optional($user->crops)->amount_name }}
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="table_row row">
                                                    <div class="col-md-5 col-sm-12 table_td">
                                                        <b>{{ trans('app.Hosil yili') }}</b>
                                                    </div>
                                                    <div class="col-md-7 col-sm-12 table_td">
                                                        <span class="txt_color">{{ optional($user->crops)->year }}</span>
                                                    </div>
                                                    <div class="table_row row">
                                                        <div class="col-md-5 col-sm-12 table_td">
                                                            <b>{{ trans('app.Ishlab chiqarilgan sana') }}</b>
                                                        </div>
                                                        <div class="col-md-7 col-sm-12 table_td">
                                                            <span class="txt_color">
                                                                {{ \Carbon\Carbon::parse(optional($user->tests)->akt[0]->make_date ?? '')->format('d.m.Y') }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="panel panel-primary">
                                                    <div class="tab_wrapper page-tab">
                                                        <ul class="tab_list">
                                                            <h5><b>{{ trans("app.Buyurtmachi korxona yoki tashkilot ma'lumotlari") }}</b>
                                                            </h5>
                                                            @if ($user->status < \App\Models\Application::STATUS_FINISHED)
                                                            <li class="btn-primary">
                                                                <a class="text-light" href="{!! url('/organization/list/edit/' . $company->id) !!}">
                                                                    <span class="visible-xs"></span>
                                                                    <i class="fa fa-edit">&nbsp;</i>
                                                                    <b>{{ trans('app.Update') }}</b>
                                                                </a>
                                                            </li>
                                                            @endif
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12 col-sm-12">
                                                        <div class="row">
                                                            <div class="col-md-8 col-sm-12 right_side">
                                                                <div class="table_row row">
                                                                    <div class="col-md-5 col-sm-12 table_td">
                                                                        <b>{{ trans('app.Tashkilot STIRi') }}</b>
                                                                    </div>
                                                                    <div class="col-md-7 col-sm-12 table_td">
                                                                        <span class="txt_color">
                                                                            {{ $company->inn }}
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <div class="table_row row">
                                                                    <div class="col-md-5 col-sm-12 table_td">
                                                                        <b>{{ trans('app.Tashkilot nomi') }}</b>
                                                                    </div>
                                                                    <div class="col-md-7 col-sm-12 table_td">
                                                                        <span class="txt_color">
                                                                            {{ $company->name }}
                                                                        </span>
                                                                    </div>
                                                                </div>

                                                                <div class="table_row row">
                                                                    <div class="col-md-5 col-sm-12 table_td">
                                                                        <b>{{ trans('app.Tashkilot manzili') }}</b>
                                                                    </div>
                                                                    <div class="col-md-7 col-sm-12 table_td">
                                                                        <span class="txt_color">
                                                                            {{ optional($company->city)->region->name . ' ' . optional($company->city)->name . ' ' . $company->address }}
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <div class="table_row row">
                                                                    <div class="col-md-5 col-sm-12 table_td">
                                                                        <b>{{ trans('app.Tashkilot rahbari') }}</b>
                                                                    </div>
                                                                    <div class="col-md-7 col-sm-12 table_td">
                                                                        <span class="txt_color">
                                                                            {{ $company->owner_name }}
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <div class="table_row row">
                                                                    <div class="col-md-5 col-sm-12 table_td">
                                                                        <b>{{ trans('app.Tashkilot telefon raqami') }}</b>
                                                                    </div>
                                                                    <div class="col-md-7 col-sm-12 table_td">
                                                                        <span class="txt_color">
                                                                            {{ $company->phone_number }}
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @if ($user->is_online==1)
                                                    <div class="panel panel-primary" style="margin-top: 3%">
                                                        <div class="tab_wrapper page-tab">
                                                            <h5><b>Talab etilgan hujjatlar</b></h5>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-12 col-sm-12">
                                                            <div class="table_row row">
                                                                <div class="col-md-5 col-sm-12 table_td">
                                                                    <b>Sanitariya-epidemiologik osoyishtalik va jamoat salomatligi
                                                                        qo'mita xulosasi va bayonnomalari</b>
                                                                </div>
                                                                <div class="col-md-7 col-sm-12 table_td">
                                                                    <span class="txt_color">
                                                                        @if (optional($user->foreign_file)->sess_file)
                                                                            <a target="_blank"
                                                                                href="{{ 'https://agrosert.uz' . \Illuminate\Support\Facades\Storage::url('app/public/don_file/' . optional($user->foreign_file)->sess_file) }}"><i
                                                                                    class="fa fa-download"></i> Ruxsatnoma
                                                                                fayli</a>
                                                                        @else
                                                                            Fayl yuklanmagan
                                                                        @endif
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                                {{-- @if ($user->type == 1)
                                                <div class="panel panel-primary">
                                                    <div class="tab_wrapper page-tab">
                                                        <ul class="tab_list">
                                                            <h5><b>Talab etilgan hujjatlar</b></h5>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12 col-sm-12">
                                                        <div class="table_row row">
                                                            <div class="col-md-5 col-sm-12 table_td">
                                                                <b>Aprobatsiya dalolatnomasi</b>
                                                            </div>
                                                            <div class="col-md-7 col-sm-12 table_td">
                                                                <span class="txt_color">
                                                                    @if (optional($user->local_file)->a_dalolatnoma)
                                                                        <a target="_blank"
                                                                            href="{{ \Illuminate\Support\Facades\Storage::url(optional($user->local_file)->a_dalolatnoma_file) }}"><i
                                                                                class="fa fa-download"></i> Dalolatnoma
                                                                            fayli</a>
                                                                    @else
                                                                        Fayl yuklanmagan
                                                                    @endif
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="table_row row">
                                                            <div class="col-md-5 col-sm-12 table_td">
                                                                <b>Aprobatsiya xulosasi</b>
                                                            </div>
                                                            <div class="col-md-7 col-sm-12 table_td">
                                                                <span class="txt_color">
                                                                    @if (optional($user->local_file)->a_xulosa)
                                                                        <a target="_blank"
                                                                            href="{{ \Illuminate\Support\Facades\Storage::url(optional($user->local_file)->a_xulosa_file) }}"><i
                                                                                class="fa fa-download"></i> Xulosa fayli</a>
                                                                    @else
                                                                        Fayl yuklanmagan
                                                                    @endif
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="table_row row">
                                                            <div class="col-md-5 col-sm-12 table_td">
                                                                <b>Dorilash xulosasi </b>
                                                            </div>
                                                            <div class="col-md-7 col-sm-12 table_td">
                                                                <span class="txt_color">
                                                                    @if (optional($user->local_file)->d_xulosa)
                                                                        <a target="_blank"
                                                                            href="{{ \Illuminate\Support\Facades\Storage::url(optional($user->local_file)->d_xulosa_file) }}"><i
                                                                                class="fa fa-download"></i> Xulosa fayli</a>
                                                                    @else
                                                                        Fayl yuklanmagan
                                                                    @endif
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="table_row row">
                                                            <div class="col-md-5 col-sm-12 table_td">
                                                                <b>Markirovka</b>
                                                            </div>
                                                            <div class="col-md-7 col-sm-12 table_td">
                                                                <span class="txt_color">
                                                                    @if (optional($user->local_file)->markirovka)
                                                                        <a target="_blank"
                                                                            href="{{ \Illuminate\Support\Facades\Storage::url(optional($user->local_file)->markirovka_file) }}"><i
                                                                                class="fa fa-download"></i> Markirovka
                                                                            fayli</a>
                                                                    @else
                                                                        Fayl yuklanmagan
                                                                    @endif
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @elseif($user->type == 2)
                                                <div class="panel panel-primary">
                                                    <div class="tab_wrapper page-tab">
                                                        <ul class="tab_list">
                                                            <h5><b>Talab etilgan hujjatlar</b></h5>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12 col-sm-12">
                                                        <div class="table_row row">
                                                            <div class="col-md-5 col-sm-12 table_td">
                                                                <b>Karantin ruxsatnomasi(IKR)</b>
                                                            </div>
                                                            <div class="col-md-7 col-sm-12 table_td">
                                                                <span class="txt_color">
                                                                    @if (optional($user->foreign_file)->karantin)
                                                                        <a target="_blank"
                                                                            href="{{ \Illuminate\Support\Facades\Storage::url(optional($user->foreign_file)->karantin_file) }}"><i
                                                                                class="fa fa-download"></i> Ruxsatnoma
                                                                            fayli</a>
                                                                    @else
                                                                        Fayl yuklanmagan
                                                                    @endif
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="table_row row">
                                                            <div class="col-md-5 col-sm-12 table_td">
                                                                <b>Fitosanitar xulosasi</b>
                                                            </div>
                                                            <div class="col-md-7 col-sm-12 table_td">
                                                                <span class="txt_color">
                                                                    @if (optional($user->foreign_file)->fitosanitar)
                                                                        <a target="_blank"
                                                                            href="{{ \Illuminate\Support\Facades\Storage::url(optional($user->foreign_file)->fitosanitar_file) }}"><i
                                                                                class="fa fa-download"></i> Xulosa fayli</a>
                                                                    @else
                                                                        Fayl yuklanmagan
                                                                    @endif
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="table_row row">
                                                            <div class="col-md-5 col-sm-12 table_td">
                                                                <b>Muvofiqlik sertifikati </b>
                                                            </div>
                                                            <div class="col-md-7 col-sm-12 table_td">
                                                                <span class="txt_color">
                                                                    @if (optional($user->foreign_file)->sertifikat)
                                                                        <a target="_blank"
                                                                            href="{{ \Illuminate\Support\Facades\Storage::url(optional($user->foreign_file)->sertificat_file) }}"><i
                                                                                class="fa fa-download"></i> Sertifikat
                                                                            fayli</a>
                                                                    @else
                                                                        Fayl yuklanmagan
                                                                    @endif
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="table_row row">
                                                            <div class="col-md-5 col-sm-12 table_td">
                                                                <b>Markirovka</b>
                                                            </div>
                                                            <div class="col-md-7 col-sm-12 table_td">
                                                                <span class="txt_color">
                                                                    @if (optional($user->foreign_file)->markirovka)
                                                                        <a target="_blank"
                                                                            href="{{ \Illuminate\Support\Facades\Storage::url(optional($user->foreign_file)->markirovka_file) }}"><i
                                                                                class="fa fa-download"></i> Markirovka
                                                                            fayli</a>
                                                                    @else
                                                                        Fayl yuklanmagan
                                                                    @endif
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="table_row row">
                                                    <div class="col-md-5 col-sm-12 table_td">
                                                        <b>Invoys</b>
                                                    </div>
                                                    <div class="col-md-7 col-sm-12 table_td">
                                                        <span class="txt_color">
                                                            @if (optional($user->foreign_file)->invoys)
                                                                <a target="_blank"
                                                                    href="{{ \Illuminate\Support\Facades\Storage::url(optional($user->foreign_file)->invoys_file) }}"><i
                                                                        class="fa fa-download"></i> Invoys fayli</a>
                                                            @else
                                                                Fayl yuklanmagan
                                                            @endif
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="table_row row">
                                                    <div class="col-md-5 col-sm-12 table_td">
                                                        <b>Yuk xati</b>
                                                    </div>
                                                    <div class="col-md-7 col-sm-12 table_td">
                                                        <span class="txt_color">
                                                            @if (optional($user->foreign_file)->yuk_xati)
                                                                <a target="_blank"
                                                                    href="{{ \Illuminate\Support\Facades\Storage::url(optional($user->foreign_file)->yuk_xati_file) }}"><i
                                                                        class="fa fa-download"></i> Yuk xati fayli</a>
                                                            @else
                                                                Fayl yuklanmagan
                                                            @endif
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="table_row row">
                                                    <div class="col-md-5 col-sm-12 table_td">
                                                        <b>SMR</b>
                                                    </div>
                                                    <div class="col-md-7 col-sm-12 table_td">
                                                        <span class="txt_color">
                                                            @if (optional($user->foreign_file)->smr)
                                                                <a target="_blank"
                                                                    href="{{ \Illuminate\Support\Facades\Storage::url(optional($user->foreign_file)->smr_file) }}"><i
                                                                        class="fa fa-download"></i> SMR fayli</a>
                                                            @else
                                                                Fayl yuklanmagan
                                                            @endif
                                                        </span>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="panel panel-primary">
                                                    <div class="tab_wrapper page-tab">
                                                        <ul class="tab_list">
                                                            <h5><b>Talab etilgan hujjatlar</b></h5>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="table_row row">
                                                        <div class="col-md-5 col-sm-12 table_td">
                                                            <b>Avvalda rasmiylashtirilgan Muvofiqlik sertifikati</b>
                                                        </div>
                                                        <div class="col-md-7 col-sm-12 table_td">
                                                            <span class="txt_color">
                                                                @if (optional($user->local_file)->certificate)
                                                                    <a target="_blank"
                                                                        href="{{ \Illuminate\Support\Facades\Storage::url(optional($user->local_file)->old_certificate_file) }}"><i
                                                                            class="fa fa-download"></i> Sertifikat fayli</a>
                                                                @else
                                                                    Fayl yuklanmagan
                                                                @endif
                                                            </span>
                                                        </div>
                                                    </div>
                                            @endif --}}
                                            </div>

                                            @can('edit', $user)
                                                <div class="col-12 text-right m-2">
                                                    <a href="/application/edit/{{ $user->id }}">
                                                        <button class="btn btn-primary">{{ trans('app.Update') }}</button>
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
            <script>
                $('body').on('click', '.sa-warning', function() {

                    var url = $(this).attr('url');


                    swal({
                        title: "Haqiqatdan ham tasdiqlashni istaysizmi?",
                        text: "Tasdiqlash uchun barcha ma'lumotlar to'g'riligiga ishonchiz komilmi!",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#297FCA",
                        confirmButtonText: "Tasdiqlash!",
                        cancelButtonText: "Tasdiqlashni bekor qilish",
                        closeOnConfirm: false
                    }).then((result) => {
                        window.location.href = url;

                    });
                });
            </script>
        @endsection
