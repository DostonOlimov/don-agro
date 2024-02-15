@extends('layouts.app')
@section('styles')
    <style>
        .crop-container {
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin: 10px;
            padding: 20px;
            text-align: center;
            cursor: pointer;
            transition: transform 0.3s ease-in-out;

        }
        .crop-container:hover {
            transform: scale(1.05);
        }

        .crop-container img {
            max-width: 100%;
            height: 300px;
            border-radius: 8px;
            margin-bottom: 10px;
        }

        .crop-container p {
            background-color: lime;
            font-size: 20px;
            color: #150d0d;
            font-weight: bold;
            padding: 5px;
            border-radius: 2px;
        }
    </style>
@endsection
@section('content')
<!-- page content -->
<?php $userid = Auth::user()->id; ?>
	 @if(getActiveCustomer($userid)=='yes' || getActiveEmployee($userid)=='yes')

    <div class="section">
			<!-- PAGE-HEADER -->
		<div class="page-header">
			<ol class="breadcrumb">
				<li class="breadcrumb-item">
					<i class="fe fe-life-buoy mr-1"></i>&nbsp {{trans('app.Laboratoriya natijalarini kiritish oynasi')}}
				</li>
			</ol>
		</div>
		@if(session('message'))
            <div class="row massage">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="alert @php echo (session('message')=='Cannot Deleted') ? 'alert-danger' : 'alert-success' @endphp text-center">
                        @if(session('message') == 'Successfully Submitted')
                            <label for="checkbox-10 colo_success"> {{trans('app.Successfully Submitted')}}  </label>
                        @elseif(session('message')=='Successfully Updated')
                            <label for="checkbox-10 colo_success"> {{ trans('app.Successfully Updated')}}  </label>
                        @elseif(session('message')=='Successfully Deleted')
                            <label for="checkbox-10 colo_success"> {{ trans('app.Successfully Deleted')}}  </label>
                        @elseif(session('message')=='Cannot Deleted')
                            <label for="checkbox-10 "> {{ trans('app.Cannot Deleted')}}  </label>
                        @endif
                    </div>
                </div>
            </div>
		@endif
        <div class="row">
            @foreach($crops as $crop)
                <div class="col-md-4">
                <a href="{!! url ('/laboratory-results/indicator/'.$crop->id) !!}">
                    <div class="crop-container">
                        <img src={{ URL::asset('crops/' . $crop->img) }} alt="{{ $crop->name }}" >
                        <p>{{ $crop->name }}</p>
                    </div>
                </a>
                </div>
            @endforeach
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
	@endif

<script src="{{ URL::asset('vendors/jquery/dist/jquery.min.js') }}"></script>
<!-- delete vehicalbrand -->


@endsection
