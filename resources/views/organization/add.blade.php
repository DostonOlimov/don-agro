@extends('layouts.app')
@section('content')
    <style>
     
        .checkbox-success {
            background-color: #cad0cc !important;
            color: red;
        }
    </style>
    <?php $userid = Auth::user()->id; ?>
    @can('create', \App\Models\User::class)

            <div class="section">
                <div class="page-header">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <i class="fe fe-life-buoy mr-1"></i>&nbsp {{trans('app.Qo\'shish')}}
                        </li>
                    </ol>
                </div>
                <div class="clearfix"></div>
                @if(session('message'))
                    <div class="row massage">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="alert alert-success danger text-center">

                                <label for="checkbox-10 colo_success"> {{ trans('app.Duplicate Data')}} </label>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="panel panel-primary">
                                    <div class="tab_wrapper page-tab">
                                        <ul class="tab_list">
                                            <li>
                                                <a href="{!! url('/organization/list')!!}">
                                                    <span class="visible-xs"></span>
                                                    <i class="fa fa-list fa-lg">&nbsp;</i>
                                                    {{ trans('app.Ro\'yxat')}}
                                                </a>
                                            </li>
                                            <li class="active">
                                                <a href="{!! url('/organization/add/1')!!}">
                                                    <span class="visible-xs"></span>
                                                    <i class="fa fa-plus-circle fa-lg">&nbsp;</i> <b>
                                                        {{ trans('app.Qo\'shish')}}</b>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <form action="{{ url('/organization/store') }}" method="post"
                                              enctype="multipart/form-data"
                                              class="form-horizontal form-label-left">
                                            <input type="hidden" value="{{$redirect_id}}" name="redirect_id">
                                            <div class="row">
                                                <div class="col-12 col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label"
                                                               for="first-name">{{trans('app.Korxona nomi')}} <label
                                                                class="text-danger">*</label>
                                                        </label>
                                                        <input type="text" required="required" name="name"
                                                               class="form-control" value="{{ old('name') }}">
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label"
                                                               for="owner_name">{{trans('app.Raxbarning ismi-sharifi')}} <label
                                                                class="text-danger">*</label>
                                                        </label>
                                                        <input type="text" required="required" name="owner_name"
                                                               class="form-control" value="{{ old('owner_name') }}">
                                                    </div>
                                                </div>
                                                <div id="tin-container" class="col-md-6 legal-fields">
                                                    <div class="form-group">
                                                        <label class="form-label">{{trans('app.STIR')}}<label class="text-danger">*</label></label>
                                                        <input class="form-control" type="text" name="inn" data-field-name="tin" data-field-length="9"
                                                               placeholder="STIR ni kiriting" minlength="9"
                                                               data-mask="000000000" maxlength="9" required="required"
                                                               title="9ta raqam kiriting!" data-pattern-mismatch="Noto'g'ri shakl"
                                                               value="{{ old('inn') }}"
                                                        />
                                                    </div>
                                                </div>

                                                <div class="col-md-6 has-feedback {{ $errors->has('mobile') ? ' has-error' : '' }}">
                                                    <div class="form-group">
                                                        <label class="form-label">{{ trans('app.Mobile No') }}</label>
                                                        <input type="text" name="mobile" placeholder="+998 (xx) xxx-xx-xx"
                                                               class="form-control" maxlength="15"
                                                               data-mask="+998 (00) 000-00-00"
                                                               data-pattern-mismatch="Telefon raqamni kiriting"
                                                               required="required"
                                                               @if(!empty($customer)) value="{{$customer->mobile}}" @endif
                                                        />

                                                        @if ($errors->has('mobile'))
                                                            <span class="help-block">
                                                    <strong>{{ $errors->first('mobile') }}</strong>
                                                </span>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="col-md-6">

                                                    <div class="form-group overflow-hidden">

                                                        <label class="form-label">{{ trans('app.Region') }}<label
                                                                class="text-danger">*</label></label>

                                                        <select class="w-100 form-control state_of_country custom-select" name="state_id"
                                                                url="{!! url('/getcityfromstate') !!}">
                                                            @if(count($states))
                                                                <option value="">{{trans('app.Viloyat tanlang')}}</option>
                                                            @endif

                                                            @if(!empty($states))

                                                                @foreach($states as $state)

                                                                    <option value="{{ $state->id }}"

                                                                            @if( (!empty($customer_city) && $customer_city->state_id==$state->id) || count($states)==1)

                                                                            selected="selected"

                                                                        @endif

                                                                    > {{$state->name}} </option>

                                                                @endforeach

                                                            @endif

                                                        </select>

                                                    </div>

                                                </div>

                                                <div class="col-md-6 form-group overflow-hidden">
                                                    <label class="form-label">{{trans('app.Tuman nomi')}}<label class="text-danger">*</label>

                                                    </label>
                                                    <div class="row">

                                                        <div class="col-12">
                                                            <select class="form-control w-100 city_of_state custom-select" name="city"
                                                                    required=""
                                                                    @if(!empty($customer_city))
                                                                    val="{{$customer_city->id}}"
                                                                @endif
                                                            >
                                                                @if($cities && count($cities))
                                                                    <option value="">{{trans('app.Tumanni tanlang')}}</option>
                                                                @endif

                                                                @if(!empty($cities))
                                                                    @foreach($cities as $city)
                                                                        <option value="{{ $city->id }}"
                                                                                @if((!empty($customer_city) && $customer_city->id==$city->id) || count($cities)==1)
                                                                                selected="selected"
                                                                            @endif
                                                                        > {{$city->name}} </option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="col-md-12">
                                                    <label class="form-label">{{ trans('app.Address') }}</label>
                                                    <textarea class="form-control" id="address" name="address" maxlength="100" required="required"
                                                              rows="3"
                                                              placeholder="{{ trans('app.Enter Address') }}">{{(!empty($customer))?$customer->address:''}}</textarea>
                                                </div>

                                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                                <div class="col-12 col-md-6">
                                                    <label class="form-label" style="visibility: hidden;">label</label>
                                                    <div class="form-group">
                                                        <a class="btn btn-primary"
                                                           href="{{ URL::previous() }}">{{ trans('app.Cancel')}}</a>
                                                        <button type="submit"
                                                                class="btn btn-success">{{ trans('app.Submit')}}</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
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
    <script src="{{ URL::asset('vendors/jquery/dist/jquery.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.states').select2({
                minimumResultsForSearch: Infinity
            });
        })
        function getCitiesOfState(th) {
            stateid = th.val();
            var url = th.attr('url');
            $.ajax({
                type: 'GET',
                url: url,
                data: {
                    stateid: stateid,
                },
                success: function (response) {
                    var citiesMenu = $('select.city_of_state')
                    var customerCity = citiesMenu.attr('val');
                    citiesMenu.html(response);
                    if (customerCity) {
                        citiesMenu.find('option[value="' + customerCity + '"]').attr('selected', 'selected');
                    }
                }
            });
        }
        $('select.state_of_country').on('change', function () {
            getCitiesOfState($(this));
        });

        if ($('select.city_of_state').attr('val')) {
            getCitiesOfState($('select.state_of_country'));
        }

    </script>
@endsection
