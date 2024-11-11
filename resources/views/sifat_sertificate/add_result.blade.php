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
                            <form id="invoice-form" method="post" action="{!! url('sifat-sertificates/result_store') !!}"
                                enctype="multipart/form-data" data-parsley-validate class="form-horizontal form-label-left">
                                @csrf
                                <div class="row" style="column-gap:0">
                                    <input type="hidden" name="id" value="{{ $id }}">

                                    <div class="col-md-4 form-group has-feedback certificate">
                                        <label for="number" class="form-label ">Sinf<label
                                                class="text-danger">*</label> </label>
                                        <select class="form-control" name="class" required>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 form-group has-feedback certificate">
                                        <label for="number" class="form-label ">Turi<label
                                                class="text-danger">*</label> </label>
                                        <select class="form-control" name="type" required>
                                            <option value="1">I</option>
                                            <option value="2">II</option>
                                            <option value="3">III</option>
                                            <option value="4">IV</option>
                                            <option value="5">V</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 form-group has-feedback certificate">
                                        <label for="number" class="form-label ">Kichik turi<label
                                                class="text-danger">*</label> </label>
                                        <select class="form-control" name="subtype" required>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                    </div>
                                    <div
                                        class="col-md-4 form-group has-feedback certificate">
                                        <label for="middle-name"
                                               class="form-label">Hajmiy og'irligi <label
                                                class="text-danger">*</label></label>
                                        <input type="number" step="0.01" class="form-control" name="nature" required
                                               value="{{ old('nature') }}">
                                    </div>
                                    <div
                                        class="col-md-4 form-group has-feedback certificate">
                                        <label for="middle-name"
                                               class="form-label">Namligi <label
                                                class="text-danger">*</label></label>
                                        <input type="number" step="0.01" class="form-control" name="humidity" required
                                               value="{{ old('nature') }}">
                                    </div>
                                    <div
                                        class="col-md-4 form-group has-feedback certificate">
                                        <label for="middle-name"
                                               class="form-label">Tushish soni <label
                                                class="text-danger">*</label></label>
                                        <input type="number" class="form-control" name="falls_number" required
                                               value="{{ old('nature') }}">
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
                                        <input type="number"  class="form-control" name="quality"
                                               value="{{ old('quality') }}">
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
                                               value="{{ old('elak_number') }}">
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
                                               value="{{ old('elak_result') }}">
                                        @if ($errors->has('elak_result'))
                                            <span class="help-block">
                                                <strong>Elakdan o'tish foizi noto'g'ri shaklda kiritilgan</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row" style="column-gap:0">
                                    <div class="col-md-6 form-group has-feedback">
                                        <div class="m-3">
                                            <label for="middle-name" class="form-label">Donni ifloslantiruvchi aralashmalar</label>
                                            <button type="button" id="addButton" class="btn btn-primary"><span class="fa fa-plus"></span> </button>
                                            <button type="button" id="removeButton" class="btn btn-danger" style="color:white"><span class="fa fa-minus"></span></button>
                                        </div>
                                        <div class="row" style="column-gap:0" id="dynamicForm">
                                            <div class="col-md-6 form-group has-feedback">
                                                <input type="text"   class="form-control" name="jamwqei1" readonly value="JAMI">
                                            </div>
                                            <div class="col-md-6 form-group has-feedback">
                                                <input type="number" step="0.01"  class="form-control" name="jami1" required
                                                       value="{{ old('JAMI') }}">
                                            </div>
                                            <div class="col-md-6 form-group has-feedback">
                                                <input type="text"   class="form-control" name="asdf" readonly value="MA'DANLI">
                                            </div>
                                            <div class="col-md-6 form-group has-feedback">
                                                <input type="number" step="0.01"  class="form-control" name="madan" required
                                                       value="{{ old('MA\'DANLI') }}">
                                            </div>
                                            <div class="col-md-6 form-group has-feedback">
                                                <input type="text"   class="form-control" name="jasdfmi1" readonly value="ZARARLI">
                                            </div>
                                            <div class="col-md-6 form-group has-feedback">
                                                <input type="number" step="0.01"  class="form-control" name="zarar" required
                                                       value="{{ old('ZARARLI') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 form-group has-feedback">
                                        <div class="m-3">
                                            <label for="middle-name" class="form-label">Donli aralashmalar</label>
                                            <button type="button" id="addButton2" class="btn btn-primary"><span class="fa fa-plus"></span> </button>
                                            <button type="button" id="removeButton2" class="btn btn-danger" style="color:white"><span class="fa fa-minus"></span></button>
                                        </div>
                                        <div class="row" style="column-gap:0" id="dynamicForm2">
                                            <div class="col-md-6 form-group has-feedback">
                                                <input type="text"   class="form-control" name="jamierwe2" readonly value="JAMI">
                                            </div>
                                            <div class="col-md-6 form-group has-feedback">
                                                <input type="number" step="0.01"  class="form-control" name="jami2" required
                                                       value="{{ old('JAMI') }}">
                                            </div>
                                        </div>
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
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const addButton = document.getElementById('addButton');
            const removeButton = document.getElementById('removeButton');
            const dynamicForm = document.getElementById('dynamicForm');
            let inputCounter = 1; // Counter to keep track of input naming
            const maxInputs = 2; // Maximum number of input pairs

            addButton.addEventListener('click', function () {
                if (inputCounter >= maxInputs) {
                    alert(`${maxInputs-1} tadan ortiq element qo'shib bo'lmaydi.`);
                    return; // Prevent adding more inputs
                }

                // Create the text input wrapper and input element
                const textDiv = document.createElement('div');
                textDiv.classList.add('col-md-6', 'form-group', 'has-feedback');
                const textInput = document.createElement('input');
                textInput.type = 'text';
                textInput.classList.add('form-control');
                textInput.name = `name${inputCounter}`;
                textDiv.appendChild(textInput);

                // Create the number input wrapper and input element
                const numberDiv = document.createElement('div');
                numberDiv.classList.add('col-md-6', 'form-group', 'has-feedback');
                const numberInput = document.createElement('input');
                numberInput.type = 'number';
                numberInput.step = '0.01';
                numberInput.classList.add('form-control');
                numberInput.name = `value${inputCounter}`;
                numberInput.required = true;
                numberDiv.appendChild(numberInput);

                inputCounter++; // Increment counter for new input names

                // Append inputs to the form
                dynamicForm.appendChild(textDiv);
                dynamicForm.appendChild(numberDiv);
            });

            removeButton.addEventListener('click', function () {
                const elements = dynamicForm.querySelectorAll('.col-md-6.form-group.has-feedback');
                if (elements.length > 6) { // Only remove if more than one pair exists
                    dynamicForm.removeChild(elements[elements.length - 1]); // Remove last number input's wrapper
                    dynamicForm.removeChild(elements[elements.length - 2]); // Remove last text input's wrapper
                    inputCounter--; // Decrement counter when removing inputs
                }
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const addButton = document.getElementById('addButton2');
            const removeButton = document.getElementById('removeButton2');
            const dynamicForm = document.getElementById('dynamicForm2');
            let inputCounter = 1; // Counter to keep track of input naming
            const maxInputs = 4; // Maximum number of input pairs

            addButton.addEventListener('click', function () {
                if (inputCounter >= maxInputs) {
                    alert(`${maxInputs-1} tadan ortiq element qo'shib bo'lmaydi.`);
                    return; // Prevent adding more inputs
                }

                // Create the text input wrapper and input element
                const textDiv = document.createElement('div');
                textDiv.classList.add('col-md-6', 'form-group', 'has-feedback');
                const textInput = document.createElement('input');
                textInput.type = 'text';
                textInput.classList.add('form-control');
                textInput.name = `z_name${inputCounter}`;
                textDiv.appendChild(textInput);

                // Create the number input wrapper and input element
                const numberDiv = document.createElement('div');
                numberDiv.classList.add('col-md-6', 'form-group', 'has-feedback');
                const numberInput = document.createElement('input');
                numberInput.type = 'number';
                numberInput.step = '0.01';
                numberInput.classList.add('form-control');
                numberInput.name = `z_value${inputCounter}`;
                numberInput.required = true;
                numberDiv.appendChild(numberInput);

                inputCounter++; // Increment counter for new input names

                // Append inputs to the form
                dynamicForm.appendChild(textDiv);
                dynamicForm.appendChild(numberDiv);
            });

            removeButton.addEventListener('click', function () {
                const elements = dynamicForm.querySelectorAll('.col-md-6.form-group.has-feedback');
                if (elements.length > 2) { // Only remove if more than one pair exists
                    dynamicForm.removeChild(elements[elements.length - 1]); // Remove last number input's wrapper
                    dynamicForm.removeChild(elements[elements.length - 2]); // Remove last text input's wrapper
                    inputCounter--; // Decrement counter when removing inputs
                }
            });
        });
    </script>
@endsection
