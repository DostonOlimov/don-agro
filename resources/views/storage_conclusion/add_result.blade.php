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

                                    <h3>Xulosalar</h3>
                                    <div class="form-group col-md-12 col-sm-12">
                                    @foreach($types as $key => $value)
                                        <div class="row"  style="column-gap: 0;">
                                            <div class="col-md-3 form-group has-feedback">
                                                <label for="middle-name" class="form-label">Nomi<label
                                                        class="text-danger">*</label></label>
                                                <input type="text" class="form-control" maxlength="250" value="{{ $value }}" name="name{{$key}}" required>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group overflow-hidden">
                                                    <label class="form-label">Berilgan viloyat<label class="text-danger">*</label></label>
                                                    <select class="w-100 form-control name_of_corn custom-select" name="type" required>
                                                            <option value="">Viloyatni tanlang</option>
                                                        @if (!empty($states))
                                                            @foreach ($states as  $state)
                                                                <option value="{{ $state->id }}"> {{ $state->name }} </option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-3 form-group has-feedback">
                                                <label for="middle-name" class="form-label">Berilgan sanasi<label
                                                        class="text-danger">*</label></label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                                        </div>
                                                    </div>
                                                    <input type="text" id="date_of_birth{{$key}}" class="form-control dob" placeholder="<?php echo getDatepicker();?>" name="dob{{$key}}" value="{{ old('dob'.$key) }}" onkeypress="return false;" required />
                                                </div>
                                            </div>
                                            <div class="col-md-3 form-group has-feedback">
                                                <label for="middle-name" class="form-label">Xulosa raqami<label
                                                        class="text-danger">*</label></label>
                                                <input type="text" class="form-control" maxlength="30" value="{{ old('number'.$key) }}" name="number{{$key}}" required>
                                            </div>
                                        </div>
                                    @endforeach
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
        @foreach($types as $key => $item)
            $("#date_of_birth{{$key}}").datetimepicker({
                format: "dd-mm-yyyy",
                autoclose: 1,
                minView: 2,
                startView: 'decade',
                endDate: new Date(),
            });
        @endforeach

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
