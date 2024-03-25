@extends('layouts.app')
@section('styles')
    <style>
        .input-container {
            position: relative;
            display: inline-block;
            width: 100%;
        }

        .input-container input[type="number"] {
            padding-right: 30px; /* Adjust this value as needed to make space for the icon */

        }

        .input-container i.fa-pencil {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
        }
        tr th {
            text-align: center;
        }
        .table-responsive_total td {
            padding: 15px 3px;
            font-size: 18px;
            text-align: center
        }
        table {
            width: 100%;
            border-collapse: separate;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
        .sticky-header {
            position: sticky;
            top: 62px;
            z-index: 100;
            background-color: #d2d2d2;
        }
    </style>
@endsection
@section('content')
    <!-- page content -->
    <?php $userid = Auth::user()->id; ?>
    @can('viewAny',\App\Models\LaboratoryResult::class)
        <div class="section">
            <!-- PAGE-HEADER -->
            <div class="page-header">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <i class="fe fe-life-buoy mr-1"></i>&nbsp {{trans('app.Sertifikatlashtirish bo\'yicha sinov ko\'rsatkichlar ro\'yxati')}}
                    </li>
                </ol>
            </div>
            @if(session('message'))
                <div class="row massage">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="alert alert-success text-center">
                            @if(session('message') == 'Successfully Submitted')
                                <label for="checkbox-10 colo_success"> {{trans('app.Successfully Submitted')}}</label>
                            @elseif(session('message')=='Successfully Updated')
                                <label for="checkbox-10 colo_success"> {{ trans('app.Successfully Updated')}}  </label>
                            @elseif(session('message')=='Successfully Deleted')
                                <label for="checkbox-10 colo_success"> {{ trans('app.Successfully Deleted')}}  </label>
                            @endif
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
                                        <li class="active">
                                            <a href="{!! url('/laboratory-results/indicator/'.$number_id)!!}">
                                                <span class="visible-xs"></span>
                                                <i class="fa fa-list fa-lg">&nbsp;</i>
                                                {{ trans('app.Ro\'yxat')}}
                                            </a>
                                        </li>
                                        <li>
                                            <a  href="{{ URL::previous() }}">
                                                <span class="visible-xs"></span>
                                                <i class="fa fa-arrow-left fa-lg">&nbsp;</i> <b>
                                                    {{ trans('app.Orqaga')}}</b>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="table-container">
                                <table class="table table-striped table-bordered nowrap " id="myTable" >
                                    <thead class="sticky-header" style="text-align: center">
                                    <tr>
                                        <th rowspan="4" style="width: 3%;" >№</th>
                                        @foreach($indicators as $indicator)
                                            @if(!$indicator->parent_id)
                                                <th @if(!$indicator->childs->count() != 0) rowspan="4" @endif
                                                        colspan="{{$indicator->childs->count()}}"
                                                >{{$indicator->name}}</th>
                                            @endif
                                        @endforeach
                                    </tr>
                                    <tr>
                                        @foreach($indicators as $indicator)
                                            @if($indicator->parent_id and !optional($indicator->parent)->parent_id)
                                                <th @if($indicator->childs->count() == 0) rowspan="3" @endif
                                                @if(countColspan($indicator->childs) !=0 )colspan="{{countColspan($indicator->childs)}}"@endif
                                                    >{{$indicator->name}} </th>

                                            @endif
                                        @endforeach
                                    </tr>
                                    <tr>
                                        @foreach($indicators as $indicator)
                                            @if(!optional(optional($indicator->parent)->parent)->parent_id  and optional($indicator->parent)->parent_id and $indicator->parent_id)
                                                <th @if(!$indicator->childs->count() != 0) rowspan="2" @endif
                                                    @if(countColspan($indicator->childs) !=0 ) colspan="{{countColspan($indicator->childs)}}"@endif
                                                >{{$indicator->name}}</th>
                                            @endif
                                        @endforeach
                                    </tr>
                                    <tr>
                                        @foreach($indicators as $indicator)
                                            @if(optional(optional($indicator->parent)->parent)->parent_id  and optional($indicator->parent)->parent_id and $indicator->parent_id)
                                                <th>{{$indicator->name}}</th>
                                            @endif
                                        @endforeach
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @foreach($numbers as $number)
                                        <tr>
                                            <td>{{$number->number}}</td>
                                            @foreach($value_indicators as $in_value)
                                                @php
                                                  ($result = $number->results->where('laboratory_indicator_id', $in_value->id)->first()) ? $value=$result->value : $value = null;
                                                @endphp

                                                <td style="min-width: 70px">
                                                    <div class="input-container">
                                                        <input @if($in_value->status == 4 ) type="text" @else type="number" step="0.01" @endif class="form-control" name="amount"  id="amount{{$in_value->id.'id'.$number->id}}"
                                                               onchange="saveAnswer({{$in_value->id}},{{$number->id}} , this)"
                                                               @if(!is_null($value)) value="{{ $value }}" {{'disabled'}} >
                                                        <i class="fa fa-pencil" onclick="changeDisplay(this,{{$in_value->id}},{{$number->id}})"></i> @endif
                                                    </div>
                                                </td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <div style="padding: 10px;">
                                    {{ $numbers->links() }}
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
        <!-- /page content -->
            <script>
                function changeDisplay(elm,id,number) {
                    document.getElementById('amount'+id+'id'+number).removeAttribute('disabled');
                    elm.remove();
                }
            </script>
            <script>
                function saveAnswer(indicator_id,number_id,elm) {
                    if (elm.value >= 0 || typeof elm.value == "string"){
                        $.ajax({
                            type: 'POST',
                            url: '{{ route('save.laboratory_result') }}',
                            data: {
                                _token: '{{ csrf_token() }}',
                                indicator_id : indicator_id,
                                number_id : number_id,
                                value: elm.value
                            },
                            success: function(response) {
                                location.reload();
                            }
                        });
                    }
                }
            </script>

@endsection
