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

                            <form method="post" action="{!! url('sifat-sertificates/client-update') !!}" enctype="multipart/form-data"
                                  class="form-horizontal upperform">
                                <div class="row" style="column-gap: 0;">

                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="id" value="{{ $data->id }}">
                                    <div class="col-md-4 mb-3">
                                        <label for="transport_type" class="form-label">
                                            Transport turini tanlang <span class="text-danger">*</span>
                                        </label>
                                        <select id="transport_type" class="form-control" name="transport_type" required>
                                            @foreach($transportType as $key => $type)
                                                <option value="{{ $key }}" @if( $key == $data->transport_type) selected @endif>{{ $type }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-8 mb-3">
                                        <label for="number" class="form-label">
                                            {{ trans('app.Avtotransport/vagon raqami') }} <span class="text-danger">*</span>
                                        </label>
                                        <textarea id="number" name="number" class="form-control" maxlength="200" rows="3">{{ $data->vagon_number }}</textarea>
                                    </div>

                                    <div
                                        class="col-md-6 form-group has-feedback certificate">
                                        <label for="middle-name" class="form-label">{{ trans('app.Yuk xati raqami') }}
                                            <label class="text-danger">*</label></label>
                                        <input type="text" id="yuk_xati" class="form-control" maxlength="10" name="yuk_xati" required
                                               value="{{ $data->yuk_xati }}">
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
                                               value="{{ $data->sender_name }}">
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
                                               value="{{ $data->sender_station }}">
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
                                               value="{{ $data->reciever_station }}">
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
                                               value="{{ $data->sender_address }}">
                                        @if ($errors->has('sender_address'))
                                            <span class="help-block">
                                                <strong>Jo'natuvchi manzili noto'g'ri shaklda kiritilgan</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div
                                        class="col-md-6 form-group has-feedback">
                                        <label for="middle-name" class="form-label">Korxona tamg'asi</label>
                                        <input type="text" class="form-control" maxlength="50" name="company_marker"
                                               value="{{ $data->company_marker }}">
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="{{ asset('vendors/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('vendors/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js') }}"></script>
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
    <script>
        document.getElementById('car_number').addEventListener('input', function(e) {
            let value = e.target.value.toUpperCase();

            // Remove non-alphanumeric characters except spaces
            value = value.replace(/[^A-Z0-9\s]/g, '');

            // Format: either "01 A123AA" or "01 123AAA"
            if (value.length <= 2) {
                // First two characters are region code
                value = value.replace(/(\d{0,2})/, '$1');
            } else if (value.length === 3) {
                // After region code, ensure a space
                value = value.replace(/(\d{2})([A-Z0-9])/, '$1 $2');
            } else if (value.length <= 6) {
                // After the space, 3 digits or letter + 3 digits
                if (/^[A-Z]/.test(value[3])) {
                    // Format: "01 A123"
                    value = value.replace(/(\d{2})\s([A-Z])(\d{0,3})/, '$1 $2$3');
                } else {
                    // Format: "01 123"
                    value = value.replace(/(\d{2})\s(\d{0,3})/, '$1 $2');
                }
            } else {
                // Final formatting for either "01 A123AA" or "01 123AAA"
                if (/^[A-Z]/.test(value[3])) {
                    // Format: "01 A123AA"
                    value = value.replace(/(\d{2})\s([A-Z])(\d{3})([A-Z]{0,2})/, '$1 $2$3$4');
                } else {
                    // Format: "01 123AAA"
                    value = value.replace(/(\d{2})\s(\d{3})([A-Z]{0,3})/, '$1 $2$3');
                }
            }

            // Enforce length limit of 8 characters
            value = value.slice(0, 9);

            e.target.value = value;
        });
    </script>
    <script>
        $(document).ready(function() {
            $('select.owner_search').select2({
                ajax: {
                    url: '/clients/search_by_name',
                    delay: 300,
                    dataType: 'json',
                    data: function(params) {
                        return {
                            search: params.term
                        }
                    },
                    processResults: function(data) {
                        data = data.map((name, index) => {
                            return {
                                id: name.id,
                                text: capitalize(name.name + (name.name ? ' - Kod:' + name.kod :
                                    ''))
                            }
                        });
                        return {
                            results: data
                        }
                    }
                },
                language: {
                    inputTooShort: function() {
                        return 'Xaridor nomini kiritib izlang..';
                    },
                    searching: function() {
                        return 'Izlanmoqda...';
                    },
                    noResults: function() {
                        return "Natija topilmadi"
                    },
                    errorLoading: function() {
                        return "Natija topilmadi"
                    }
                },
                placeholder: 'Seleksion navini kiriting',
                minimumInputLength: 1
            })

            function capitalize(text) {
                var words = text.split(' ');
                for (var i = 0; i < words.length; i++) {
                    if (words[i][0] == null) {
                        continue;
                    } else {
                        words[i] = words[i][0].toUpperCase() + words[i].substring(1).toLowerCase();
                    }

                }
                return words.join(' ');
            }
        });
    </script>

@endsection
