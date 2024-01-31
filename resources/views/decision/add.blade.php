@extends('layouts.app')
@section('content')
<!-- page content -->
<?php $userid = Auth::user()->id; ?>
@can('create', \App\Models\Application::class)
   <div class="section">
		<div class="page-header">
			<ol class="breadcrumb">
				<li class="breadcrumb-item">
					<i class="fe fe-life-buoy mr-1"></i>&nbsp {{trans('app.Ariza qo\'shish')}}
				</li>
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
										<a href="{!! url('/decision/search')!!}">
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
						<form id="invoice-form" method="post" action="{!! url('decision/store') !!}" enctype="multipart/form-data"
                              data-parsley-validate class="form-horizontal form-label-left">
                            @csrf
							<div class="row" >

								<input type="hidden" name="_token" value="{{csrf_token()}}">
                                <input type="hidden"  name="app_id" value="{{ $app->id}}" >
                                <div class="col-md-4 form-group has-feedback">
                                    <label class="form-label" for="app_number">{{trans('app.Ariza raqami')}} <label class="text-danger">*</label></label>
                                    <input type="number" readonly name="app_number" value="{{ $app->app_number}}" class="form-control">
                                </div>
                                <div class="col-md-4 form-group has-feedback">
                                    <label class="form-label" for="app_number">{{trans('app.Arizachi nomi')}} <label class="text-danger">*</label></label>
                                    <input type="text" readonly name="app_number" value="{{ optional($app->organization)->name }}" class="form-control">
                                </div>
                                <div class="col-md-4 form-group has-feedback">
                                    <label class="form-label" for="app_number">{{trans('app.Mahsulot nomi')}} <label class="text-danger">*</label></label>
                                    <input type="text" readonly name="app_number" value="{{ optional($app->crops)->name->name}}" class="form-control">
                                </div>
                                <div class="col-md-4 form-group has-feedback">
                                    <label class="form-label" for="app_number">{{ trans('app.Sertifikatlashtirish sxemasi') }}<label class="text-danger">*</label></label>
                                    <input type="text" readonly name="app_number" value="{{ optional($app->crops)->sxeme_number}}" class="form-control">
                                </div>
                                {{-- <div class="col-md-4 form-group has-feedback">
                                    <label class="form-label" for="app_number">{{trans('app.Buyruq sanasi')}} <label class="text-danger">*</label></label>
                                    <input type="text" readonly name="app_number" value="{{ $app->date}}" class="form-control">
                                </div> --}}
                                <div class="col-md-4 form-group has-feedback">
                                    <label class="form-label" for="app_number">{{trans('app.Qaror sanasi')}} <label class="text-danger">*</label></label>
                                    <input type="date" name="date" value="{{ old('date') }}" class="form-control" required>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group overflow-hidden">
                                        <label class="form-label">{{trans('app.Rahbar')}}<label class="text-danger">*</label></label>
                                        <select class="w-100 form-control" name="director_id" required>
                                            @if(count($directors))
                                                <option value="">{{trans('app.Rahbarni tanlang')}}</option>
                                            @endif
                                            @foreach($directors as $director)
                                                <option value="{{$director->id}}" @if($director->id == old('director_id')) selected @endif
                                                > {{$director->name.' '.$director->lastname}} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group overflow-hidden">
                                        <label class="form-label">{{trans('app.Laboratoriya')}}<label class="text-danger">*</label></label>
                                        <select class="w-100 form-control" name="laboratory_id" required>
                                            @if(count($directors))
                                                <option value="">{{trans('app.Laboratoriyani tanlang')}}</option>
                                            @endif
                                            @foreach($laboratories as $laboratory)
                                                <option value="{{$laboratory->id}}" @if($laboratory->id == old('laboratory_id')) selected @endif
                                                > {{$laboratory->name}} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
								<div class="form-group col-md-12 col-sm-12">
									<div class="col-md-12 col-sm-12 text-center">
										<a class="btn btn-primary" href="{{ URL::previous() }}">{{trans('app.Cancel')}}</a>
										<button type="submit" id="invoice-form-submitter" class="btn btn-success">{{ trans('app.Submit')}}</button>
                                        <a class="btn btn-success disabled d-none" id="test_program" href="{!! url('/tests/add/'.$app->id) !!}">{{trans("app.Sinov dasturi qo'shish")}}</a>
                                    </div>
								</div>
							</div>
						</form>
                        <div class="row">
                            @if ($app->crops->type && $app->crops->amount)
                                    @include('decision._cheque', ['classes' => 'd-none'])
                                @elseif ($app->crops->amount && !$app->crops->type)
                                    @include('decision._cheque2', ['classes' => 'd-none'])
                                @elseif (!$app->crops->amount && $app->crops->type)
                                    @include('decision._cheque3', ['classes' => 'd-none'])
                                @else
                                    @include('decision._cheque4', ['classes' => 'd-none'])
                                @endif
                            <div class="col-12 mt-4 form-actions d-none" id="success-actions">
                                <button class="btn btn-primary" id="print-invoice-btn">{{trans("app.Chop etish")}}</button>
                                <a id="payment-button" href="{{route('decision.payments.create')}}" class="btn btn-primary d-none">{{trans("app.To'lov qo'shish")}}</a>
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
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="{{ URL::asset('vendors/moment/min/moment.min.js') }}"></script>
	<script src="{{ URL::asset('vendors/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
	<script src="{{ URL::asset('vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js') }}"></script>

@endsection
@section('scripts')
    <script>
        function createCookie(name, value, days) {
            var expires;

            if (days) {
                var date = new Date();
                date.setTime(date.getTime() + (10));
                expires = "; expires=" + date.toGMTString();
            }
            else {
                expires = "";
            }

            document.cookie = escape(name) + "=" +
                escape(value) + expires + "; path=/";
        }

        $('#invoice-form').one('submit', function (ev) {
            ev.preventDefault();
            let form = $(this);
            var button = document.getElementById('invoice-form-submitter');
            button.disabled = true;
            button.innerText = 'Yuklanmoqda...';

            var test_program_btn = document.getElementById('test_program');

            let submitButton = form.find('button[type="submit"]');
            submitButton.addClass('btn-loading');
            submitButton.attr('disabled', 'disabled')

            let data = form.serializeArray();
            $.ajax({
                url: '{{route('decision.store')}}',
                type: 'post',
                data,
                success: function (data) {
                    currentInvoice = data['decision']
                    measure_type = data['measure_type']
                    nds_type = data['nds_type']

                    test_program_btn.classList.remove('disabled');
                    test_program_btn.classList.remove('d-none');

                    submitButton.removeClass('btn-loading');
                    submitButton.attr('disabled', false)
                    swal('{{trans("app.Successfully Submitted")}}', '', 'success');

                    $('#invoice-form-submitter').hide()
                    $('#success-actions').removeClass('d-none')

                    fillCheque()
                    $('#invoice-cheque').removeClass('d-none')
                },

                error: function (err) {
                    currentInvoice = null
                    submitButton.removeClass('btn-loading');
                    submitButton.attr('disabled', false)
                    swal('Xatolik', '', 'error');
                }
            });
        })

        $('#print-invoice-btn').click(function (ev) {
            printCheque()
        })

        $('#serve-invoice').click(function (ev) {
            window.location.href = decodeURIComponent($(this).data('href'))
                .replace(':invoice_id', (currentInvoice || {}).id)

        })
    </script>
@endsection
