@extends('layouts.front')
@section('content')
    <link href="{{ asset('assets/css/formApplications.css') }}" rel="stylesheet">
    <style>
        @media screen and (max-width: 768px) {
            main {
                margin: 135px 0 !important;
            }

            .my_header .navbar {
                padding: 10px 0;
                align-items: center;
            }

            .my_header .nav-logo {
                margin-right: 0px;
            }

            .right-side-header {
                column-gap: 13px;
            }

            h4 {
                max-width: 155px;
                font-size: 14px;
            }
        }
    </style>
    <ul class="step-wizard-list">
        <li class="step-wizard-item">
            <span class="progress-count first-progress-bar">1</span>
            <span class="progress-label">{{ trans('app.Buyurtmachi korxonani qo\'shish') }}</span>
        </li>
        <li class="step-wizard-item">
            <span class="progress-count">2</span>
            <span class="progress-label">{{ trans('app.Mahsulot ma\'lumotlari') }}</span>
        </li>
        <li class="step-wizard-item">
            <span class="progress-count">3</span>
            <span class="progress-label">{{ trans('app.Yuk ma\'lumotlari') }}</span>
        </li>
        <li class="step-wizard-item current-item">
            <span class="progress-count last-progress-bar">4</span>
            <span class="progress-label">{{ trans('app.Sifat ko\'rsatkichlari') }}</span>
        </li>
    </ul>


    <div class="section">

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form id="invoice-form" method="post" action="{!! url('sifat-sertificates/result_store',$app) !!}"
                              enctype="multipart/form-data" data-parsley-validate class="form-horizontal form-label-left">
                            @csrf
                            <div class="row" style="column-gap:0">
                                <div class="col-md-4 form-group has-feedback certificate">
                                    <label for="number" class="form-label ">Rangi<label
                                            class="text-danger">*</label> </label>
                                   <input type="text" name="colour" class="form-control" maxlength="100">
                                </div>
                                <div class="col-md-4 form-group has-feedback certificate">
                                    <label for="number" class="form-label ">Ta'mi<label
                                            class="text-danger">*</label> </label>
                                    <select class="form-control" name="flavour" required>
                                        @foreach($flavour_types as $key => $type)
                                            <option value="{{ $key }}">{{ $type }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4 form-group has-feedback certificate">
                                    <label for="number" class="form-label ">Hidi<label
                                            class="text-danger">*</label> </label>
                                    <select class="form-select form-control" name="smell" required>
                                        @foreach($flavour_types as $key => $type)
                                            <option value="{{ $key }}">{{ $type }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div
                                    class="col-md-4 form-group has-feedback certificate">
                                    <label for="middle-name"
                                           class="form-label">Kulligi <label
                                            class="text-danger">*</label></label>
                                    <input type="number" step="0.01" class="form-control" name="kulligi" required
                                           value="{{ old('kulligi') }}">
                                </div>
                                <div
                                    class="col-md-4 form-group has-feedback certificate">
                                    <label for="middle-name"
                                           class="form-label">Namligi <label
                                            class="text-danger">*</label></label>
                                    <input type="number" step="0.01" class="form-control" name="humidity" required
                                           value="{{ old('humidity') }}">
                                </div>
                                <div
                                    class="col-md-4 form-group has-feedback certificate">
                                    <label for="middle-name"
                                           class="form-label">Oqligi <label
                                            class="text-danger">*</label></label>
                                    <input type="number" step="0.01" class="form-control" name="oqlik" required
                                           value="{{ old('oqlik') }}">
                                </div>

                                <div class="col-md-3 form-group has-feedback">
                                    <label for="middle-name" class="form-label">Elak(qoldiq) raqami
                                        <label class="text-danger">*</label></label>
                                    <input type="text"  class="form-control" name="qoldiq_number" required
                                           value="{{ old('qoldiq_number') }}">
                                    @if ($errors->has('qoldiq_number'))
                                        <span class="help-block">
                                                <strong>Elakdagi qoldiq raqami noto'g'ri shaklda kiritilgan</strong>
                                            </span>
                                    @endif
                                </div>
                                <div class="col-md-3 form-group has-feedback">
                                    <label for="middle-name" class="form-label">Elakdandagi qoldiq foizi
                                        <label class="text-danger">*</label></label>
                                    <input type="number" step="0.01"  class="form-control" name="qoldiq_result" required
                                           value="{{ old('qoldiq_result') }}">
                                    @if ($errors->has('qoldiq_result'))
                                        <span class="help-block">
                                                <strong>Elakdan o'tish foizi noto'g'ri shaklda kiritilgan</strong>
                                            </span>
                                    @endif
                                </div>
                                <div class="col-md-3 form-group has-feedback">
                                    <label for="middle-name" class="form-label">Elak raqami
                                        <label class="text-danger">*</label></label>
                                    <input type="text"  class="form-control" name="elak_number" required
                                           value="{{ old('elak_number') }}">
                                    @if ($errors->has('elak_number'))
                                        <span class="help-block">
                                                    <strong>Elak raqami noto'g'ri shaklda kiritilgan</strong>
                                                </span>
                                    @endif
                                </div>
                                <div class="col-md-3 form-group has-feedback">
                                    <label for="middle-name" class="form-label">Elakdan o'tish foizi
                                        <label class="text-danger">*</label></label>
                                    <input type="number" step="0.01"  class="form-control" name="elak_result" required
                                           value="{{ old('elak_result') }}">
                                    @if ($errors->has('elak_result'))
                                        <span class="help-block">
                                                    <strong>Elakdan o'tish foizi noto'g'ri shaklda kiritilgan</strong>
                                                </span>
                                    @endif
                                </div>

                                <div
                                    class="col-md-6 form-group has-feedback certificate">
                                    <label for="middle-name" class="form-label">Kleykovinaning vazn ulushi
                                        <label class="text-danger">*</label></label>
                                    <input type="number" step="0.01"  class="form-control" name="kleykovina" required
                                           value="{{ old('kleykovina') }}">
                                    @if ($errors->has('kleykovina'))
                                        <span class="help-block">
                                                <strong>Kleykovinaning vazn ulushi noto'g'ri shaklda kiritilgan</strong>
                                            </span>
                                    @endif
                                </div>
                                <div
                                    class="col-md-6 form-group has-feedback certificate">
                                    <label for="middle-name" class="form-label">Sifati
                                        <label class="text-danger">*</label></label>
                                    <input type="number"  class="form-control" name="quality" max="40" min="1"
                                           value="{{ old('quality') }}">
                                    @if ($errors->has('quality'))
                                        <span class="help-block">
                                                <strong>Sifati noto'g'ri shaklda kiritilgan</strong>
                                            </span>
                                    @endif
                                </div>
                                <div
                                    class="col-md-6 form-group has-feedback certificate">
                                    <label for="middle-name" class="form-label">Sifatli mag'iz foizi
                                        <label class="text-danger">*</label></label>
                                    <input type="number" step="0.01" class="form-control" name="quality_magiz"
                                           value="{{ old('quality_magiz') }}">
                                    @if ($errors->has('quality_magiz'))
                                        <span class="help-block">
                                                <strong>Sifatli mag'iz foizi noto'g'ri shaklda kiritilgan</strong>
                                            </span>
                                    @endif
                                </div>
                                <div
                                    class="col-md-6 form-group has-feedback certificate">
                                    <label for="middle-name" class="form-label">Guruh
                                        <label class="text-danger">*</label></label>
                                    <select class="form-select form-control" name="group" required>
                                        @foreach($group as $key => $type)
                                            <option value="{{ $key }}">{{ $type }}</option>
                                        @endforeach
                                    </select>
                                </div>
                    </div>
                            <div class="m-3">
                                <label for="middle-name" class="form-label">IFLOSLANTIRUVCHI ARALASHMALAR</label>
                            </div>
                            <div class="row" style="column-gap:0">
                                <div class="col-md-4 form-group has-feedback">
                                    <label for="middle-name" class="form-label">Jami
                                        <label class="text-danger">*</label></label>
                                    <input type="number" step="0.01" class="form-control" name="jami1" required
                                           value="{{ old('jami1') }}">
                                </div>
                                <div class="col-md-4 form-group has-feedback">
                                    <label for="middle-name" class="form-label">Ma'danli
                                        <label class="text-danger">*</label></label>
                                    <input type="number" step="0.01" class="form-control" name="madan" required
                                           value="{{ old('madan') }}">
                                </div>
                                <div class="col-md-4 form-group has-feedback">
                                    <label for="middle-name" class="form-label">Zararli
                                        <label class="text-danger">*</label></label>
                                    <input type="number" step="0.01" class="form-control" name="zarar" required
                                           value="{{ old('zarar') }}">
                                </div>
                                <div class="col-md-3 form-group has-feedback">
                                    <label for="middle-name" class="form-label">Buzilgan
                                        <label class="text-danger">*</label></label>
                                    <input type="number" step="0.01" class="form-control" name="buzilgan" required
                                           value="{{ old('buzilgan') }}">
                                </div>
                                <div class="col-md-3 form-group has-feedback">
                                    <label for="middle-name" class="form-label">Siniq
                                        <label class="text-danger">*</label></label>
                                    <input type="number" step="0.01" class="form-control" name="siniq" required
                                           value="{{ old('siniq') }}">
                                </div>
                                <div class="col-md-3 form-group has-feedback">
                                    <label for="middle-name" class="form-label">Po'sti archilmagan
                                        <label class="text-danger">*</label></label>
                                    <input type="number" step="0.01" class="form-control" name="archilmagan" required
                                           value="{{ old('archilmagan') }}">
                                </div>
                                <div class="col-md-3 form-group has-feedback">
                                    <label for="middle-name" class="form-label">Unsimon
                                        <label class="text-danger">*</label></label>
                                    <input type="number" step="0.01" class="form-control" name="unsimon" required
                                           value="{{ old('unsimon') }}">
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="{{ URL::asset('vendors/moment/min/moment.min.js') }}"></script>
    <script src="{{ URL::asset('vendors/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ URL::asset('vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js') }}"></script>
    <script>
        $("input.date").datetimepicker({
            format: "dd-mm-yyyy",
            autoclose: 1,
            minView: 2,
            startView: 'decade',
            endDate: new Date(),
        });

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
