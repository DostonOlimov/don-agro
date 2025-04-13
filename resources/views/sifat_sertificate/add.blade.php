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
            <li class="step-wizard-item current-item">
                <span class="progress-count">2</span>
                <span class="progress-label">{{ trans('app.Mahsulot ma\'lumotlari') }}</span>
            </li>
            <li class="step-wizard-item">
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

                            <form method="post" action="{!! url('sifat-sertificates/store') !!}" enctype="multipart/form-data"
                                class="form-horizontal upperform">
                                <div class="row" style="column-gap: 0;">

                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="organization" value="{{ $organization }}">

                                    <div class="col-md-6">
                                        <div class="form-group overflow-hidden">
                                            <label class="form-label">{{ trans('app.Sertifikatlanuvchi mahsulot') }}<label
                                                    class="text-danger">*</label></label>
                                            <select class="w-100 form-control name_of_corn custom-select" name="name" required
                                                id="crops_name" url="{!! url('/gettypefromname') !!}">
                                                @if (count($names))
                                                    <option value="">
                                                        {{ trans('app.Sertifikatlanuvchi mahsulot turini tanlang') }}
                                                    </option>
                                                @endif
                                                @if (!empty($names))
                                                    @foreach ($names as $name)
                                                        <option value="{{ $name->id }}"> {{ $name->name }} </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            @if ($errors->has('name'))
                                                <span class="help-block">
                                                <strong class="hf-warning">{{ $errors->first('name') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div id="tin-container" class="col-md-6 legal-fields">
                                        <div class="form-group">
                                            <label class="form-label">{{ trans('app.Kod TN VED') }}<label
                                                    class="text-danger">*</label></label>
                                            <input class="form-control" id="kodtnved" type="text" name="tnved"
                                                data-field-name="tin" data-field-length="10" minlength="10"
                                                data-mask="0000000000" maxlength="10" required="required"
                                                title="10ta raqam kiriting!" data-pattern-mismatch="Noto'g'ri shakl"
                                                value="{{ old('tnved') }}" />
                                            @if ($errors->has('tnved'))
                                                <span class="help-block">
                                                <strong class="hf-warning">{{ $errors->first('tnved') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6 form-group overflow-hidden">
                                        <label class="form-label">{{ trans('app.Mahsulot navi') }}
                                            <label class="text-danger">*</label></label>
                                        <div class="row">
                                            <div class="col-12">
                                                <select class="form-control w-100 type_of_corn custom-select" name="type">
                                                </select>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group overflow-hidden">
                                            <label class="form-label">{{ trans('app.Ishlab chiqargan davlat') }}<label
                                                    class="text-danger">*</label></label>
                                            <select class="w-100 form-control" name="country" required>
                                                @if (count($countries))
                                                    <option value="">{{ trans('app.Mamlakat nomini tanlang') }}</option>
                                                @endif
                                                @if (!empty($countries))
                                                    @foreach ($countries as $name)
                                                        <option value="{{ $name->id }}"
                                                                @if ($name->id == old('country') or $name->id == 234) selected @endif>
                                                            {{ $name->name }} </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div
                                        class="col-md-6 form-group has-feedback {{ $errors->has('party_number') ? ' has-error' : '' }}">
                                        <label class="form-label class-to-show">{{ trans('app.Toʼda (partiya) raqami') }}  <label class="text-danger">*</label></label>
                                        <label class="form-label class-to-hide" style="display: none">Yorma raqami <label class="text-danger">*</label></label>

                                        <input type="text" class="form-control" maxlength="25" name="party_number" required
                                            value="{{ old('party_number') }}">
                                        @if ($errors->has('party_number'))
                                            <span class="help-block">
                                                <strong class="hf-warning">{{ $errors->first('party_number') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col-md-6 class-to-show">
                                        <div class="form-group overflow-hidden">
                                            <label class="form-label">{{ trans('app.Hosil yili') }}<label
                                                    class="text-danger">*</label></label>
                                            <select class="w-100 form-control" name="year">
                                                @if (count($years))
                                                    <option value="">{{ trans('app.Hosil yilini tanlang') }}</option>
                                                @endif
                                                @foreach ($years as $key => $name)
                                                    <option value="{{ $key }}"
                                                            @if ($key == old('year') or $key == 2024) selected @endif>{{ $name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 class-to-hide" style="display: none">
                                        <div class="form-group overflow-hidden">
                                            <label class="form-label">Ishlab chiqarish sanasi<label
                                                    class="text-danger">*</label></label>
                                            <input type="text" class="form-control" maxlength="100"
                                                   value="{{ old('made_date') }}" name="made_date">
                                        </div>
                                    </div>
                                    <div
                                        class="col-md-6 form-group has-feedback {{ $errors->has('amount') ? ' has-error' : '' }}">
                                        <label for="middle-name" class="form-label">{{ trans('app.amount2') }} <label
                                                class="text-danger">*</label></label>
                                        <input type="number" step="0.01" class="form-control" maxlength="25"
                                            value="{{ old('amount') }}" name="amount" required>
                                        @if ($errors->has('amount'))
                                            <span class="help-block">
                                                <strong class="hf-warning">{{ $errors->first('amount') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div
                                        class="col-md-6 form-group has-feedback">
                                        <label for="middle-name" class="form-label">{{ trans('app.joylar soni') }} <label
                                                class="text-danger">*</label></label>
                                        <input type="number" class="form-control" max="10000000" min="0"
                                               value="{{ old('joy_soni') }}" name="joy_soni">
                                        @if ($errors->has('joy_soni'))
                                            <span class="help-block">
                                                <strong class="hf-warning">{{ $errors->first('joy_soni') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <input name="measure_type" type="hidden" value="2">


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
        $("input.dob").datetimepicker({
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
            }, 1000);
        }
    </script>
        <script>
            $(document).ready(function () {
                // Initialize Select2 with no search feature for elements with the 'states' class
                $('.states').select2({
                    minimumResultsForSearch: Infinity
                });

                // Function to get the type of corn based on corn ID
                function getTypeOfCorn($element) {
                    const cornId = $element.val();
                    const url = $element.attr('url');

                    // Fetch array of types using the corn's ID
                    $.ajax({
                        type: 'GET',
                        url: url,
                        data: { name_id: cornId },
                        success: function (response) {
                            const $typeMenu = $('select.type_of_corn');
                            const customerType = $typeMenu.attr('val');

                            // Populate the type menu with the response
                            $typeMenu.html(response);

                            // Set the selected option if a value is present
                            if (customerType) {
                                $typeMenu.find(`option[value="${customerType}"]`).prop('selected', true);
                            }
                        },
                        error: function () {
                            console.error('Failed to fetch corn types.');
                        }
                    });
                }

                // Event listener for changes in the 'crops_name' dropdown
                const kodtnved = document.getElementById('kodtnved');
                const stateDropdown = document.getElementById('crops_name');

                stateDropdown.addEventListener('change', () => {
                    const stateId = stateDropdown.value;
                    fetch(`/getkodtnved/${stateId}`)
                        .then(response => response.json())
                        .then(data => {
                            if (data && data.code) {
                                // Set kodtnved value
                                kodtnved.value = data.code;

                            }

                            if (data && data.sertificate_type) {
                                // Toggle display based on sertificate_type
                                toggleDisplayBasedOnSertificateType(data.sertificate_type);
                            }
                        })
                        .catch(error => console.error('Failed to fetch kodtnved:', error));
                });

                // Function to toggle classes based on 'sertificate_type' value
                function toggleDisplayBasedOnSertificateType(type) {

                    if (type == '1') {
                        console.log('sdf');
                        $('.class-to-hide').css('display', 'none');
                        $('.class-to-show').css('display', 'block');
                    } else if (type == '2') {
                        console.log('sdf');
                        $('.class-to-hide').css('display', 'block');
                        $('.class-to-show').css('display', 'none');
                    }
                }

                // Trigger the function when the 'name_of_corn' dropdown changes
                $('select.name_of_corn').on('change', function () {
                    getTypeOfCorn($(this));
                });

                // Initial load: trigger getTypeOfCorn if a value is already set
                const $initialCorn = $('select.name_of_corn');
                if ($('select.type_of_corn').attr('val')) {
                    getTypeOfCorn($initialCorn);
                }
            });
        </script>

@endsection
