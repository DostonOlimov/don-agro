@extends('layouts.app')
@section('content')
<!-- page content -->
<?php $userid = Auth::user()->id;?>
@can('create', \App\Models\Application::class)
   <div class="section">
		<div class="page-header">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><i class="fe fe-life-buoy mr-1"></i>&nbsp {{trans('app.Ariza qo\'shish')}}</li>
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
										<a href="{!! url('/application/list')!!}">
											<span class="visible-xs"></span>
											<i class="fa fa-list fa-lg">&nbsp;</i> {{ trans('app.Ro\'yxat')}}
										</a>
									</li>
									<li class="active">
										<span class="visible-xs"></span>
										<i class="fa fa-plus-circle fa-lg">&nbsp;</i>
										<b>{{ trans('app.Qo\'shish')}}</b>
									</li>
								</ul>
							</div>
						</div>
						<form method="post" action="{!! url('application/store') !!}" enctype="multipart/form-data"  class="form-horizontal upperform">
							<div class="row" >

								<input type="hidden" name="_token" value="{{csrf_token()}}">
                                <div class="col-md-4 form-group has-feedback {{ $errors->has('app_number') ? ' has-error' : '' }}">
                                    <label class="form-label" for="app_number">{{trans('app.Ariza raqami')}} <label class="text-danger">*</label></label>
                                    <div class="">
                                        <input type="number" id="app_number" name="app_number" value="{{ old('app_number')}}" class="form-control" maxlength="20" required>
                                        @if ($errors->has('app_number'))
                                            <span class="help-block" style="color:red">
											<strong>Ariza raqami noto'g'ti shaklda kiritilgan yoki oldindan mavjud</strong>
										</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4 form-group {{ $errors->has('dob') ? ' has-error' : '' }}">
                                    <label class="form-label">{{trans('app.Ariza sanasi')}} <label class="text-danger">*</label></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" placeholder="dd.mm.yyyy" name="dob"  data-mask="00.00.0000" value="{{ old('dob') }}" required />
                                    </div>
                                    @if ($errors->has('dob'))
                                        <span class="help-block">
                                                    <strong class="text-danger">Ariza sanasi noto'g'ri shaklda kiritilgan</strong>
                                            </span>
                                    @endif
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group overflow-hidden">
                                        <label class="form-label">{{trans('app.Ariza turi')}}<label class="text-danger">*</label></label>
                                        <select class="w-100 form-control" name="app_type" required>
                                            @if(count($type))
                                                <option value="">{{trans('app.Ariza turini tanlang')}}</option>
                                            @endif
                                            @foreach($type as $key=>$name)
                                                <option value="{{ $key }}" @if($key == old('app_type')) selected @endif
                                                > {{$name}} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group" >
                                        <label class="form-label" for="organization">
                                            {{trans('app.Buyurtmachi korxona yoki tashkilot nomi')}} <span class="text-danger">*</span>
                                        </label>
                                        <select id="organization"
                                                class="form-control owner_search" name="organization" required>
                                            @if(!empty($organization))
                                                <option selected
                                                        value="{{ $organization->id }}"
                                                >{{$organization->name}}</option>
                                            @endif
                                        </select>
                                        <div>
                                        <a class="btn btn-primary" href="{!! url('/organization/add/2')!!}">{{ trans('app.Qo\'shish')}}</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 row">
                                    <div class="form-group" >
                                            <label class="form-label" for="prepared">
                                                {{trans('app.Mahsulot tayorlangan shaxobcha yoki sexning nomi')}} <span class="text-danger">*</span>
                                            </label>
                                            <select id="prepared" required
                                                    class="form-control owner_search2" name="prepared">
                                                @if(!empty($prepared))
                                                    <option selected
                                                            value="{{ $prepared->id }}"
                                                    >{{$prepared->name}}</option>
                                                @endif
                                            </select>
                                        <div>
                                            <a class="btn btn-primary" href="{!! url('/prepared/add/2')!!}">{{ trans('app.Qo\'shish')}}</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group overflow-hidden">
                                        <label class="form-label">{{trans('app.Mahsulot turi')}}<label
                                                class="text-danger">*</label></label>
                                        <select class="w-100 form-control name_of_corn custom-select" name="name" id="crops_name"
                                                url="{!! url('/gettypefromname') !!}">
                                            @if(count($names))
                                                <option value="">{{trans('app.Mahsulot turini tanlang')}}</option>
                                            @endif
                                            @if(!empty($names))
                                                @foreach($names as $name)
                                                    <option value="{{ $name->id }}"> {{$name->name}} </option>
                                                @endforeach

                                            @endif
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4 form-group overflow-hidden">
                                    <label class="form-label">{{trans('app.Mahsulot navi')}}
                                        <label class="text-danger">*</label></label>
                                    <div class="row">
                                        <div class="col-12">
                                            <select class="form-control w-100 type_of_corn custom-select" name="type"
                                                    required="">
                                            </select>
                                        </div>
                                    </div>

                                </div>
                                {{-- <div class="col-md-4 form-group overflow-hidden">
                                    <label class="form-label">{{trans('app.Urug\' avlodi')}}
                                        <label class="text-danger">*</label></label>
                                    <div class="row">
                                        <div class="col-12">
                                            <select class="form-control w-100 type_of_corn2 custom-select2" name="generation" required="">
                                            </select>
                                        </div>
                                    </div>
                                </div> --}}
                                <div id="tin-container" class="col-md-4 legal-fields">
                                    <div class="form-group">
                                        <label class="form-label">{{trans('app.Kod TN VED')}}<label class="text-danger">*</label></label>
                                        <input class="form-control" id="kodtnved" type="text" name="tnved" data-field-name="tin" data-field-length="10"
                                               minlength="10"
                                               data-mask="0000000000" maxlength="10" required="required"
                                               title="10ta raqam kiriting!" data-pattern-mismatch="Noto'g'ri shakl" value="{{ old('tnved')}}"
                                        />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group overflow-hidden">
                                        <label class="form-label">{{trans('app.Ishlab chiqargan davlat')}}<label
                                                class="text-danger">*</label></label>
                                        <select class="w-100 form-control" name="country" required>
                                            @if(count($countries))
                                                <option value="">{{trans('app.Mamlakat nomini tanlang')}}</option>
                                            @endif
                                            @if(!empty($countries))
                                                @foreach($countries as $name)
                                                    <option value="{{ $name->id }}"  @if($name->id == old('country') or $name->id == 234) selected @endif
                                                    > {{$name->name}} </option>
                                                @endforeach

                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4 form-group has-feedback {{ $errors->has('party_number') ? ' has-error' : '' }}">
                                    <label for="middle-name" class="form-label">{{trans('app.Toʼda (partiya) raqami')}} <label class="text-danger">*</label></label>
                                    <input type="text" class="form-control" maxlength="25"  name="party_number" value="{{ old('party_number')}}" required>

                                </div>
                                <div class="col-md-4">
                                    <div class="form-group overflow-hidden">
                                        <label class="form-label">{{trans('app.O\'lchov turi')}} <label class="text-danger">*</label></label>
                                        <select class="w-100 form-control" name="measure_type" required>
                                            @if(count($measure_types))
                                                <option value="">{{trans('app.O\'lchov turini tanlang')}}</option>
                                            @endif
                                            @foreach($measure_types as $key=>$name)
                                                <option value="{{ $key }}"   @if($key == old('measure_type')) selected @endif
                                                > {{$name}} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4 form-group has-feedback {{ $errors->has('amount') ? ' has-error' : '' }}">
                                    <label for="middle-name" class="form-label">{{trans('app.Mahsulot miqdori')}} <label class="text-danger">*</label></label>
                                    <input type="number" step="0.01" class="form-control" maxlength="25" value="{{ old('amount')}}"  name="amount" required>
                                    @if ($errors->has('amount'))
                                        <span class="help-block">
											 <strong></strong>
										   </span>
                                    @endif
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group overflow-hidden">
                                        <label class="form-label">{{trans('app.Hosil yili')}}<label class="text-danger">*</label></label>
                                        <select class="w-100 form-control" name="year" required>
                                            @if(count($year))
                                                <option value="">{{trans('app.Hosil yilini tanlang')}}</option>
                                            @endif
                                            @foreach($year as $key=>$name)
                                                <option value="{{ $key }}"
                                                    @if($key == old('year')) selected @endif
                                                    >{{$name}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 form-group has-feedback">
                                    <label class="form-label">{{trans('message.Ishlab chiqarish turi')}}</label>
                                    <div class="">
                                        <select required class="form-control crop_production" name="state[]" multiple="multiple" >
                                            @if(!empty($production_type))
                                                @foreach($production_type as $state)
                                                    <option value="{{$state->id}}">{{$state->name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 form-group has-feedback">
                                    <label class="form-label">{{trans('app.Arizaga ilova qilinadi')}}</label>
                                    <div class="">
                                        <select required class="form-control requirements" name="requirements[]" multiple="multiple" >
                                            @if(!empty($requirements))
                                                @foreach($requirements as $state)
                                                    <option value="{{$state->id}}">{{$state->name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4 form-group has-feedback" style="display: none" id="pre_name">
                                    <label class="form-label">{{trans('app.Chigit turi')}} <label class="text-danger">*</label></label>
                                    <div class=" gender">
                                        <label class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input"  name="pre_name" value="tukli" checked required checked>
                                            <span class="custom-control-label">{{trans('app.Tukli')}}</span>
                                        </label>
                                        <label class="custom-control custom-radio">
                                            <input type="radio"  class="custom-control-input" name="pre_name" value="tuksiz" required>
                                            <span class="custom-control-label">{{trans('app.Tuksiz')}} </span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-8 form-group has-feedback">
                                    <label class="form-label" for="data">{{trans('app.Qo\'shimcha ma\'lumotlar')}}<label class="text-danger">*</label></label>
                                    <div class="">
                                        <textarea id="data" name="data" class="form-control" maxlength="100" >{{ old('data')}}</textarea>
                                    </div>
                                </div>
								<div class="form-group col-md-12 col-sm-12">
									<div class="col-md-12 col-sm-12 text-center">
										<a class="btn btn-primary" href="{{ URL::previous() }}">{{ trans('app.Cancel')}}</a>
										<button type="submit" class="btn btn-success"  onclick="disableButton()" id="submitter">{{ trans('app.Submit')}}</button>
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
				<span class="titleup text-danger"><i class="fa fa-exclamation-circle" aria-hidden="true"></i>&nbsp {{ trans('app.You Are Not Authorize This page.')}}</span>
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
            button.innerText = '{{trans("app.Yuklanmoqda...")}}'; // Optionally, change the text to indicate processing
            setTimeout(function() {
                button.disabled = false;
                button.innerText = '{{trans("app.Saqlash")}}'; // Restore the button text
            }, 1000);
        }

	</script>
<script>
    $(document).ready(function () {
        $('select.owner_search').select2({
            ajax: {
                url: '/organization/search_by_name',
                delay: 300,
                dataType: 'json',
                data: function (params) {
                    return {
                        search: params.term
                    }
                },
                processResults: function (data) {
                    data = data.map((name, index) => {
                        return {
                            id: name.id,
                            text: capitalize(name.name + (name.name ? ' - STiR:' + name.inn : ''))
                        }
                    });
                    return {
                        results: data
                    }
                }
            },
            language: {
                inputTooShort: function () {
                    return '{{trans("app.Korxona (nomi), STIR ini kiritib izlang")}}';
                },
                searching: function () {
                    return '{{trans("app.Izlanmoqda...")}}';
                },
                noResults: function () {
                    return '{{trans("app.Natija topilmadi")}}'
                },
                errorLoading: function () {
                    return '{{trans("app.Natija topilmadi")}}'
                }
            },
            placeholder: '{{trans("app.Korxona nomini kiriting")}}',
            minimumInputLength: 2
        })
        $('select.owner_search2').select2({
            ajax: {
                url: '/prepared/search_by_name',
                delay: 300,
                dataType: 'json',
                data: function (params) {
                    return {
                        search: params.term
                    }
                },
                processResults: function (data) {
                    data = data.map((name, index) => {
                        return {
                            id: name.id,
                            text: capitalize(name.name )
                        }
                    });
                    return {
                        results: data
                    }
                }
            },
            language: {
                inputTooShort: function () {
                    return '{{trans("app.Korxona nomini kiritib izlang")}}';
                },
                searching: function () {
                    return '{{trans("app.Izlanmoqda...")}}';
                },
                noResults: function () {
                    return '{{trans("app.Natija topilmadi")}}'
                },
                errorLoading: function () {
                    return '{{trans("app.Natija topilmadi")}}'
                }
            },
            placeholder: '{{trans("app.Korxona nomini kiriting")}}',
            minimumInputLength: 2
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
<script >
    $(document).ready(function () {
        $('.states').select2({
            minimumResultsForSearch: Infinity
        });
    })
    function getTypeOfCorn(th) {

        corn_id = th.val();

        var url = th.attr('url');

        // get array of types from corn's id
        $.ajax({
            type: 'GET',
            url: url,
            data: {
                name_id: corn_id,
            },
            success: function (response) {
                var typeMenu = $('select.type_of_corn')
                var customerType = typeMenu.attr('val');
                typeMenu.html(response);

                if (customerType) {
                    typeMenu.find('option[value="' + customerType + '"]').attr('selected', 'selected');
                }

            }

        });

        // get array of generation from corn's id
        $.ajax({
            type: 'GET',
            url: "{!! url('/getgenerationfromname') !!}",
            data: {
                name_id: corn_id,
            },
            success: function (response) {
                var typeMenu = $('select.type_of_corn2')
                var customerType = typeMenu.attr('val');
                typeMenu.html(response);

                if (customerType) {
                    typeMenu.find('option[value="' + customerType + '"]').attr('selected', 'selected');
                }

            }

        });
    }
    // get kod tn ved from corn's id crops_name
    const kodtnved = document.getElementById('kodtnved');
    const stateDropdown = document.getElementById('crops_name');

    stateDropdown.addEventListener('change', () => {
        const stateId = stateDropdown.value;
        fetch(`/getkodtnved/${stateId}`)
            .then(response => response.json())
            .then(data => kodtnved.value = data.code);
    });


    //chigit uchun radio button qo'shish
    function getPreName(th) {

        corn_id = th.val();
        if (corn_id == 21) {
            document.getElementById("pre_name").style.display = "block";
        }
        else{
            document.getElementById("pre_name").style.display = "none";
        }

    }

    $('select.name_of_corn').on('change', function () {
        getPreName($(this));
    });

    $('select.name_of_corn').on('change', function () {
        getTypeOfCorn($(this));
    });

    if ($('select.type_of_corn').attr('val')) {
        getTypeOfCorn($('select.name_of_corn'));
    }
    if ($('select.type_of_corn2').attr('val')) {
        getTypeOfCorn($('select.name_of_corn'));
    }

</script>
<script>
    $(document).ready(function(){
        $('select.crop_production').select2({
            placeholder: '{{trans("message.Ishlab chiqarish turini tanlang")}}',
            minimumResultsForSearch: Infinity,
            language:{
                inputTooShort:function(){
                    return 'Ma\'lumot kiritib izlang';
                },
                searching:function(){
                    return '{{trans("app.Izlanmoqda...")}}';
                },
                noResults:function(){
                    return '{{trans("app.Natija topilmadi")}}'
                }
            }
        });
        $('body').on('change','.crop_production',function(){
            corn_id = $(this).val();
            var url = $(this).attr('stateurl');
        });
        $('select.requirements').select2({
            placeholder: '{{trans("app.Ilovani tanlang")}}',
            minimumResultsForSearch: Infinity,
            language:{
                inputTooShort:function(){
                    return '{{trans("app.Ma\'lumot kiritib izlang")}}';
                },
                searching:function(){
                    return '{{trans("app.Izlanmoqda...")}}';
                },
                noResults:function(){
                    return '{{trans("app.Natija topilmadi")}}'
                }
            }
        });
    });
</script>

  @endsection
