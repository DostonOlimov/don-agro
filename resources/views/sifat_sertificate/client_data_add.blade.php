@extends('layouts.front')
@section('content')

        <style>
            @media screen and (max-width: 768px) {
                main {
                    margin: 100px 0 !important;
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
                    max-width: 220px;
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
            <li class="step-wizard-item current-item">
                <span class="progress-count">3</span>
                <span class="progress-label">{{ trans('app.Yuk ma\'lumotlari') }}</span>
            </li>
            <li class="step-wizard-item">
                <span class="progress-count last-progress-bar">4</span>
                <span class="progress-label">{{ trans('app.Sifat ko\'rsatkichlari') }}</span>
            </li>
        </ul>

        <div class="section">

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">

                            <form method="post" action="{!! url('sifat-sertificates/client_store', $app) !!}" enctype="multipart/form-data"
                                class="form-horizontal upperform">
                                <div class="row" style="column-gap: 0;">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                        <div class="col-md-4 mb-3">
                                            <label for="transport_type" class="form-label">
                                                Transport turini tanlang <span class="text-danger">*</span>
                                            </label>
                                            <select id="transport_type" class="form-control" name="transport_type" required>
                                                @foreach($transportType as $key => $type)
                                                    <option value="{{ $key }}">{{ $type }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-8 mb-3">
                                            <label for="number" class="form-label">
                                                {{ trans('app.Avtotransport/vagon raqami') }} <span class="text-danger">*</span>
                                            </label>
                                            <textarea id="number" name="number" class="form-control" maxlength="200" rows="3">{{ old('number') }}</textarea>
                                        </div>

                                    <div
                                        class="col-md-6 form-group has-feedback certificate">
                                        <label for="middle-name" class="form-label">{{ trans('app.Yuk xati raqami') }}
                                            <label class="text-danger">*</label></label>
                                        <input type="text" id="yuk_xati" class="form-control" maxlength="10" name="yuk_xati" required
                                            value="{{ old('yuk_xati') }}">
                                        @if ($errors->has('yuk_xati'))
                                            <span class="help-block">
                                                <strong>Yuk xati raqami noto'g'ri shaklda kiritilgan</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div
                                        class="col-md-6 form-group has-feedback">
                                        <label for="middle-name" class="form-label">Jo'natuvchi nomi
                                            <label class="text-danger">*</label></label>
                                        <input type="text" class="form-control" maxlength="50" name="sender_name" required
                                               value="{{ old('sender_name') }}">
                                        @if ($errors->has('sender_name'))
                                            <span class="help-block">
                                                <strong>Jo'natuvchi nomi noto'g'ri shaklda kiritilgan</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div
                                        class="col-md-6 form-group has-feedback">
                                        <label for="middle-name" class="form-label">Jo'natuvchi stansiyasi
                                            <label class="text-danger">*</label></label>
                                        <input type="text" class="form-control" maxlength="50" name="sender_station" required
                                               value="{{ old('sender_station') }}">
                                        @if ($errors->has('sender_station'))
                                            <span class="help-block">
                                                <strong>Jo'natuvchi stansiyasi noto'g'ri shaklda kiritilgan</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div
                                        class="col-md-6 form-group has-feedback">
                                        <label for="middle-name" class="form-label">Oluvchi stansiyasi
                                            <label class="text-danger">*</label></label>
                                        <input type="text" class="form-control" maxlength="50" name="reciever_station" required
                                               value="{{ old('reciever_station') }}">
                                        @if ($errors->has('reciever_station'))
                                            <span class="help-block">
                                                <strong>Oluvchi stansiyasi noto'g'ri shaklda kiritilgan</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div
                                        class="col-md-6 form-group has-feedback">
                                        <label for="middle-name" class="form-label">Jo'natuvchi manzili
                                            <label class="text-danger">*</label></label>
                                        <input type="text" class="form-control" maxlength="150" name="sender_address" required
                                               value="{{ old('sender_address') }}">
                                        @if ($errors->has('sender_address'))
                                            <span class="help-block">
                                                <strong>Jo'natuvchi manzili noto'g'ri shaklda kiritilgan</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div
                                        class="col-md-6 form-group has-feedback">
                                        <label for="middle-name" class="form-label">Korxona tamg'asi</label>
                                        <select id="transport_type" class="form-control" name="company_marker" required>
                                            @foreach($companyMarker as $key => $type)
                                                <option value="{{ $key }}">{{ $type }}</option>
                                            @endforeach
                                        </select>

                                        @if ($errors->has('company_marker'))
                                            <span class="help-block">
                                                <strong>Korxona tamg'asi noto'g'ri shaklda kiritilgan</strong>
                                            </span>
                                        @endif
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
    <script type="text/javascript">
        function disableButton() {
            var button = document.getElementById('submitter');
            button.disabled = true;
            button.innerText = 'Yuklanmoqda...'; // Optionally, change the text to indicate processing
            setTimeout(function() {
                button.disabled = false;
                button.innerText = 'Saqlash'; // Restore the button text
            }, 1000);
        }
    </script>
@endsection
