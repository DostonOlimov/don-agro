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
                            <form method="post" action="{!! url('akt/store') !!}" enctype="multipart/form-data"
                                class="form-horizontal upperform">
                                <div class="row">

                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                    <div class="col-md-4 form-group {{ $errors->has('akt_date') ? ' has-error' : '' }}">
                                        <label class="form-label">{{ trans('app.Namuna  olish dalolatnoma sanasi') }} <label
                                                class="text-danger">*</label></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                                </div>
                                            </div>
                                            <input type="text" class="form-control" placeholder="dd.mm.yyyy" name="akt_date"
                                                data-mask="00.00.0000" value="{{ old('akt_date') }}" required />
                                            <input type="number" hidden value="{{ $data->id }}" name="test_program_id">
                                        </div>
                                        @if ($errors->has('akt_date'))
                                            <span class="help-block">
                                                <strong class="text-danger">Namuna olish dalolatnoma sanasi noto'g'ri shaklda
                                                    kiritilgan</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col-md-4 form-group has-feedback">
                                        <label
                                            class="form-label">{{ trans('app.Namuna olingan tashkilotning nomi va manzili') }}
                                            <label class="text-danger">*</label></label>
                                        <input type="text" readonly
                                            value="{{ $data->application->organization->name . ' ' . $data->application->organization->city->region->name . ' ' . $data->application->organization->city->name . ' ' . $data->application->organization->address }}"
                                            class="form-control">
                                    </div>

                                    <div class="col-md-8 form-group has-feedback">
                                        <label class="form-label"
                                            for="out_check">{{ trans('app.Partiyani tashqi tekshirish natijasi') }}<label
                                                class="text-danger">*</label></label>
                                        <div class="">
                                            <textarea id="out_check" name="out_check" class="form-control" maxlength="100">{{ old('out_check') }}</textarea>
                                        </div>
                                    </div>


                                    <div id="tin-container" class="col-md-4 legal-fields">
                                        <div class="form-group">
                                            <label
                                                class="form-label">{{ trans('app.Qadoqlash va etiketkalash haqida ma\'lumot') }}<label
                                                    class="text-danger">*</label></label>
                                            <input class="form-control" type="text" name="marker"
                                                value="{{ old('marker') }}" />
                                        </div>
                                    </div>
                                    <div id="tin-container" class="col-md-4 legal-fields">
                                        <div class="form-group">
                                            <label class="form-label">{{ trans('app.Foydalanish maqsadi') }}<label
                                                    class="text-danger">*</label></label>
                                            <input class="form-control" type="text" name="use_goal"
                                                value="{{ old('use_goal') }}" />
                                        </div>
                                    </div>

                                    <div class="col-md-4 form-group has-feedback">
                                        <label class="form-label">{{ trans('app.Asosiy xususiyatlar') }} <label
                                                class="text-danger">*</label></label>
                                        <input type="text" readonly
                                            value="{{ \App\Models\Nds::getType()[$data->application->crops->name->nds->type_id] . '.' . $data->application->crops->name->nds->number . ' ' . $data->application->crops->name->nds->name }}"
                                            class="form-control">
                                    </div>
                                    <div class="col-md-4 form-group has-feedback">
                                        <label class="form-label">{{ trans('app.Saqlash shartlari') }} <label
                                                class="text-danger">*</label></label>
                                        <input type="text" readonly
                                            value="{{ \App\Models\Nds::getType()[$data->application->crops->name->nds->type_id] . '.' . $data->application->crops->name->nds->number . ' ' . $data->application->crops->name->nds->name }}"
                                            class="form-control">
                                    </div>

                                    <div id="tin-container" class="col-md-4 legal-fields">
                                        <div class="form-group">
                                            <label class="form-label">{{ trans('app.Ishlab chiqaruvchi (Buyurtmachi)') }}<label
                                                    class="text-danger">*</label></label>
                                            <input class="form-control" type="text" name="customer"
                                                value="{{ $data->application->organization->owner_name }}" />
                                        </div>
                                    </div>
                                    <div id="tin-container" class="col-md-4 legal-fields">
                                        <div class="form-group">
                                            <label
                                                class="form-label">{{ trans('app.Sertifikatlashtirish organi xodimi') }}<label
                                                    class="text-danger">*</label></label>
                                            <input class="form-control" type="text" name="employee"
                                                value="{{ old('employee') }}" />
                                        </div>
                                    </div>
                                    <div class="col-md-4 form-group has-feedback">
                                        <label class="form-label">{{ trans('app.Kod TN VED') }} <label
                                                class="text-danger">*</label></label>
                                        <input type="text" readonly value="{{ $data->application->crops->kodtnved }}"
                                            class="form-control">
                                    </div>
                                    <div class="col-md-4 form-group has-feedback">
                                        <label class="form-label">{{ trans('app.Mahsulot nomi') }} <label
                                                class="text-danger">*</label></label>
                                        <input type="text" readonly value="{{ $data->application->crops->name->name }}"
                                            class="form-control">
                                    </div>
                                    <div class="col-md-4 form-group has-feedback">
                                        <label class="form-label">{{ trans('app.Ishlab chiqargan davlat') }} <label
                                                class="text-danger">*</label></label>
                                        <input type="text" readonly value="{{ $data->application->crops->country->name }}"
                                            class="form-control">
                                    </div>
                                    <div class="col-md-4 form-group has-feedback">
                                        <label class="form-label">{{ trans('app.Umumiy miqdor') }} <label
                                                class="text-danger">*</label></label>
                                        <input type="text" readonly value="{{ $data->application->crops->amount }}"
                                            class="form-control">
                                    </div>
                                    <div class="col-md-4 form-group has-feedback">
                                        <label class="form-label">{{ trans('app.Mahsulot birligi') }} <label
                                                class="text-danger">*</label></label>
                                        <input type="text" readonly
                                            value="{{ $amount[$data->application->crops->measure_type] }}"
                                            class="form-control">
                                    </div>

                                    <div class="col-md-4 form-group {{ $errors->has('make_date') ? ' has-error' : '' }}">
                                        <label class="form-label">{{ trans('app.Ishlab chiqarilgan sana') }} <label
                                                class="text-danger">*</label></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                                </div>
                                            </div>
                                            <input type="text" class="form-control" placeholder="dd.mm.yyyy"
                                                name="make_date" data-mask="00.00.0000" value="{{ old('make_date') }}"
                                                required />
                                        </div>
                                        @if ($errors->has('make_date'))
                                            <span class="help-block">
                                                <strong class="text-danger">Ishlab chiqarilgan sanasi noto'g'ri shaklda
                                                    kiritilgan</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col-md-4 form-group {{ $errors->has('expiry_date') ? ' has-error' : '' }}">
                                        <label class="form-label">{{ trans('app.Yaroqliylik sanasi') }} <label
                                                class="text-danger">*</label></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                                </div>
                                            </div>
                                            <input type="text" class="form-control" placeholder="dd.mm.yyyy"
                                                name="expiry_date" data-mask="00.00.0000"
                                                value="{{ old('expiry_date') }}" />
                                        </div>
                                        @if ($errors->has('expiry_date'))
                                            <span class="help-block">
                                                <strong class="text-danger">Ishlab chiqarilgan sanasi noto'g'ri shaklda
                                                    kiritilgan</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div id="tin-container" class="col-md-4 legal-fields">
                                        <div class="form-group">
                                            <label class="form-label">{{ trans('app.Olingan namunalar miqdori') }}<label
                                                    class="text-danger">*</label></label>
                                            <input class="form-control" type="number" name="simple_size"
                                                value="{{ old('simple_size') }}" />
                                        </div>
                                    </div>

                                    {{-- Labaratoriya uchun start --}}
                                    {{-- <div id="tin-container" class="col-md-4 legal-fields">
                                        <div class="form-group">
                                            <label
                                                class="form-label">{{ trans('app.Nazorat namunalari uchun') }}<label
                                                    class="text-danger">*</label></label>
                                            <input class="form-control" type="number" name="lab_size"
                                                value="{{ old('lab_size') }}" />
                                        </div>
                                    </div> --}}
                                    {{-- Labaratoriya uchun end --}}

                                    {{--  --}}
                                    <div
                                        class="col-md-4 form-group has-feedback {{ $errors->has('party_number') ? ' has-error' : '' }}">
                                        <label for="middle-name" class="form-label">{{ trans('app.Toʼda (partiya) soni') }}
                                            <label class="text-danger">*</label></label>
                                        <input type="number" class="form-control" maxlength="25" name="party_number"
                                            value="{{ old('party_number') }}" required id="middle-name">

                                    </div>
                                    <div class="col-md-6 form-group has-feedback">
                                        <label class="form-label">{{ trans('app.O\'lchov birliklari') }}<label
                                                class="text-danger">*</label></label>
                                        <select class="w-100 form-control" name="measure_type" required>
                                            <option value="">{{ trans('app.O\'lchov birliklarni tanlang') }}</option>
                                            @foreach ($amount as $key => $item)
                                                <option value="{{ $key }}">{{ $item }}</option>
                                            @endforeach
                                        </select>
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
