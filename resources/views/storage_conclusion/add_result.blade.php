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
                <span class="progress-label">Asosiy ma'lumotlar</span>
            </li>
            <li class="step-wizard-item current-item">
                <span class="progress-count">3</span>
                <span class="progress-label">Yakuniy xulosalar</span>
            </li>
        </ul>

        <div class="section">

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">

                            <form method="post" action="{!! url('storage-conclusion/add_files_store') !!}" enctype="multipart/form-data"
                                class="form-horizontal upperform">
                                <div class="row" style="column-gap: 0;">

                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="id" value="{{ $id }}">

                                    <div
                                        class="col-md-6 form-group has-feedback {{ $errors->has('amount') ? ' has-error' : '' }}">
                                        <label for="middle-name" class="form-label">Sig'im hajmi<label
                                                class="text-danger">*</label></label>
                                        <input type="number" step="0.01" class="form-control" maxlength="25"
                                            value="{{ old('amount') }}" name="amount" required>
                                        @if ($errors->has('amount'))
                                            <span class="help-block">
                                                <strong class="hf-warning">{{ $errors->first('amount') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col-md-6 form-group {{ $errors->has('dob') ? ' has-error' : '' }}">
                                        <label class="form-label">Berilgan sanasi <label class="text-danger">*</label></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                                </div>
                                            </div>
                                            <input type="text" id="date_of_birth" class="form-control dob" placeholder="<?php echo getDatepicker();?>" name="dob" value="{{ old('dob') }}" onkeypress="return false;" required />
                                        </div>
                                        @if ($errors->has('dob'))
                                            <span class="help-block">
                                            <strong style="margin-left:27%;">Berilgan sanasi noto'g'ti shaklda kiritilgan</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="col-md-6 form-group {{ $errors->has('dob') ? ' has-error' : '' }}">
                                        <label class="form-label">Amal qilish muddati <label class="text-danger">*</label></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                                </div>
                                            </div>
                                            <input type="text" id="date_of_birth2" class="form-control dob" placeholder="<?php echo getDatepicker();?>" name="dob2" value="{{ old('dob2') }}" onkeypress="return false;" required />
                                        </div>
                                        @if ($errors->has('dob2'))
                                            <span class="help-block">
                                            <strong style="margin-left:27%;">Ariza sanasi noto'g'ti shaklda kiritilgan</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label d-block">
                                            Saqlash sharoitining muvofiqligi <span class="text-danger">*</span>
                                        </label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="result" id="result_yes" value="1" checked>
                                            <label class="form-check-label" for="result_yes">Muvofiq</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="result" id="result_no" value="0">
                                            <label class="form-check-label" for="result_no">Nomuvofiq</label>
                                        </div>
                                    </div>
                                    <div class="col-md-8 mb-3">
                                        <label class="form-label d-block">
                                            Alohida yozuvlar <span class="text-danger">*</span>
                                        </label>
                                        <div class="">
                                            <textarea id="data" name="data" class="form-control" maxlength="400">{{ old('data') }}</textarea>
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
        $("input.dob2").datetimepicker({
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
