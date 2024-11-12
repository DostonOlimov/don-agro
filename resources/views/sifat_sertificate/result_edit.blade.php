@extends('layouts.front')
@section('content')
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
        <link href="{{ asset('assets/css/formApplications.css') }}" rel="stylesheet">
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

            <div class="row" >
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form id="invoice-form" method="post" action="{!! url('sifat-sertificates/result-update') !!}"
                                  enctype="multipart/form-data" data-parsley-validate class="form-horizontal form-label-left">
                                @csrf
                                <div class="row" style="column-gap:0">
                                    <input type="hidden" name="id" value="{{ $data->id }}">
                                    <div class="col-md-4 form-group has-feedback certificate">
                                        <label for="number" class="form-label ">Sinf<label
                                                class="text-danger">*</label> </label>
                                        <select class="form-control" name="class" required>
                                            <option value="3" @if(optional($data->laboratory_result)->class == 3) selected @endif>3</option>
                                            <option value="4" @if(optional($data->laboratory_result)->class == 4) selected @endif>4</option>
                                            <option value="5" @if(optional($data->laboratory_result)->class == 5) selected @endif>5</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 form-group has-feedback certificate">
                                        <label for="number" class="form-label ">Turi<label
                                                class="text-danger">*</label> </label>
                                        <select class="form-control" name="type" required>
                                            <option value="1" @if(optional($data->laboratory_result)->type == 1) selected @endif>I</option>
                                            <option value="2" @if(optional($data->laboratory_result)->type == 2) selected @endif>II</option>
                                            <option value="3" @if(optional($data->laboratory_result)->type == 3) selected @endif>III</option>
                                            <option value="4" @if(optional($data->laboratory_result)->type == 4) selected @endif>IV</option>
                                            <option value="5" @if(optional($data->laboratory_result)->type == 5) selected @endif>V</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 form-group has-feedback certificate">
                                        <label for="number" class="form-label ">Kichik turi<label
                                                class="text-danger">*</label> </label>
                                        <select class="form-control" name="subtype" required>
                                            <option value="1" @if(optional($data->laboratory_result)->subtype == 1) selected @endif>1</option>
                                            <option value="2" @if(optional($data->laboratory_result)->subtype == 2) selected @endif>2</option>
                                            <option value="3" @if(optional($data->laboratory_result)->subtype == 3) selected @endif>3</option>
                                            <option value="4" @if(optional($data->laboratory_result)->subtype == 4) selected @endif>4</option>
                                            <option value="5" @if(optional($data->laboratory_result)->subtype == 5) selected @endif>5</option>
                                        </select>
                                    </div>
                                    <div
                                        class="col-md-4 form-group has-feedback certificate">
                                        <label for="middle-name"
                                               class="form-label">Hajmiy og'irligi <label
                                                class="text-danger">*</label></label>
                                        <input type="number" step="0.01" class="form-control" name="nature" required
                                               value="{{ optional($data->laboratory_result)->nature }}">
                                    </div>
                                    <div
                                        class="col-md-4 form-group has-feedback certificate">
                                        <label for="middle-name"
                                               class="form-label">Namligi <label
                                                class="text-danger">*</label></label>
                                        <input type="number" step="0.01" class="form-control" name="humidity" required
                                               value="{{ optional($data->laboratory_result)->humidity }}">
                                    </div>
                                    <div
                                        class="col-md-4 form-group has-feedback certificate">
                                        <label for="middle-name"
                                               class="form-label">Tushish soni <label
                                                class="text-danger">*</label></label>
                                        <input type="number" class="form-control" name="falls_number" required
                                               value="{{ optional($data->laboratory_result)->falls_number }}">
                                    </div>
                                    <div
                                        class="col-md-6 form-group has-feedback certificate">
                                        <label for="middle-name" class="form-label">Kleykovinaning vazn ulushi
                                            <label class="text-danger">*</label></label>
                                        <input type="number" step="0.01"  class="form-control" name="kleykovina" required
                                               value="{{ optional($data->laboratory_result)->kleykovina }}">
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
                                        <input type="number"  class="form-control" name="quality"
                                               value="{{ optional($data->laboratory_result)->quality }}">
                                        @if ($errors->has('quality'))
                                            <span class="help-block">
                                                <strong>Sifati noto'g'ri shaklda kiritilgan</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col-md-6 form-group has-feedback">
                                        <label for="middle-name" class="form-label">Elak raqami
                                            <label class="text-danger">*</label></label>
                                        <input type="text"  class="form-control" name="elak_number" required
                                               value="{{ optional($data->laboratory_result)->elak_number }}">
                                        @if ($errors->has('elak_number'))
                                            <span class="help-block">
                                                <strong>Elak raqami noto'g'ri shaklda kiritilgan</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col-md-6 form-group has-feedback">
                                        <label for="middle-name" class="form-label">Elakdan o'tish foizi
                                            <label class="text-danger">*</label></label>
                                        <input type="number" step="0.01"  class="form-control" name="elak_result" required
                                               value="{{ optional($data->laboratory_result)->elak_result }}">
                                        @if ($errors->has('elak_result'))
                                            <span class="help-block">
                                                <strong>Elakdan o'tish foizi noto'g'ri shaklda kiritilgan</strong>
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
