@extends('layouts.app')
@section('styles')
    <style>
        .first-table td {
            width: 20%;
            text-align: center;
            padding: 5px;
            border: 1px solid #ddd;
        }
    </style>
@endsection
@section('content')
    @can('view', \App\Models\User::class)
        <div class=" content-area ">
            <div class="page-header">
                <h4 class="page-title mb-0" style="color:white">Sinov dasturi</h4>
            </div>
            <div class="panel panel-primary">
                <div class="tab_wrapper page-tab">
                    <ul class="tab_list">
                        @if($decision->status == \App\Models\TestPrograms::STATUS_NEW or $decision->status == \App\Models\TestPrograms::STATUS_SEEN)
                            <li class="btn-success">
                                <a class="text-light" onclick="Accept()">
                                    <span class="visible-xs"></span>
                                    <i class="fa fa-check fa-lg">&nbsp;</i> Qabul qilish
                                </a>
                            </li>
                            <li class="btn-danger">
                                <a class="text-light" id="cancelButton" onclick="Reject()">
                                    <span class="visible-xs"></span>
                                    <i class="fa fa-times fa-lg">&nbsp;</i> Rad etish
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
            @if($decision->status == \App\Models\TestPrograms::STATUS_REJECTED)
                <div class="row massage">
                    <div class="col-md-12 col-sm-12">
                        <div class="alert alert-danger text-center">
                            <label for="checkbox-10 colo_danger">Arizani rad etilish sababi : {{optional($decision->status_change)->comment}}</label>
                        </div>
                    </div>
                </div>
            @endif
            <form id="cancelForm" action="{{ route('tests.rejectstore') }}" method="post">
            @csrf
                <div id="cancelSection" style="display: none">
                <div class="col-md-12 form-group has-feedback">
                    <input type="hidden" name="id" value="{{$decision->id}}">
                    <label class="form-label" for="data">Sinov dasturini rad etish sababi:<label class="text-danger">*</label></label>
                    <div class="">
                        <textarea id="comment" name="comment" class="form-control" maxlength="100" >{{ old('comment')}}</textarea>
                    </div>
                </div>

                <div class="form-group col-md-12 col-sm-12">
                    <div class="col-md-12 col-sm-12 text-center">
                        <a class="btn btn-primary" onclick="CancelReject()">{{ trans('app.Cancel')}}</a>
                        <button type="submit" class="btn btn-success">{{ trans('app.Submit')}}</button>
                    </div>
                </div>
                </div>
            </form>
            <form id="acceptForm" action="{{ route('tests.acceptstore') }}" method="post">
                @csrf
                <div id="acceptSection" @if(!old('number')) style="display: none" @endif>
                    <input type="hidden" name="id" value="{{$decision->id}}">
                    <div class="col-md-4 form-group has-feedback {{ $errors->has('number') ? ' has-error' : '' }}">
                        <label for="middle-name" class="form-label">Sinov na'munalarning ro'yxatga olingan raqami <label class="text-danger">*</label>(Oxirgi ro'yxatga olingan raqam : {{$max_number}})</label>
                        <input type="number" class="form-control" maxlength="25"  name="number" value="{{ old('number')}}" required>
                        @if ($errors->has('number'))
                            <span class="help-block" style="color:red">
                                <strong>Bunday raqamlar oldindan ro'yxatdan o'tgan</strong>
							</span>
                        @endif
                    </div>
                    <div class="form-group col-md-12 col-sm-12">
                        <div class="col-md-12 col-sm-12 text-center">
                            <a class="btn btn-primary" onclick="CancelAccept()">{{ trans('app.Cancel')}}</a>
                            <button type="submit" class="btn btn-success">{{ trans('app.Submit')}}</button>
                        </div>
                    </div>
                </div>
            </form>
            <div class="row">
                <div class="col-12">
                    <div class="card p-4">
                        <div class="row">
                            @include('tests._cheque')

                        </div>
                        <div class="py-3">
                            <a href="{{url()->previous()}}" class="btn btn-primary">ortga</a>
                            <button class="btn btn-primary" id="print-invoice-btn">Chop etish</button>
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
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            function fillCheque() {
                $('#director-name').text((currentdecision.director.name.charAt(0)).concat(".",currentdecision.director.display_name.charAt(0),".",currentdecision.director.lastname))
                $('#application-date').text(moment(currentdecision.application.date).format('DD.MM.YYYY'))
            }
            function printCheque() {
                $('#invoice-cheque').print({
                    NoPrintSelector: '.no-print',
                    title: '',
                })
            }

            let currentdecision = @json($decision);
            let measure_type = @json($measure_type);
            let nds_type = @json($nds_type);
            let qrCode = @json($qrCode);


            fillCheque()

            $('#print-invoice-btn').click(function (ev) {
                printCheque()
            })
        });
    </script>
    <script>
        function Reject(){
            document.getElementById('cancelSection').style.display = 'block';
            document.getElementById('acceptSection').style.display = 'none';
        }
        function CancelReject(){
            document.getElementById('cancelSection').style.display = 'none';
        }
        function Accept(){
            document.getElementById('acceptSection').style.display = 'block';
            document.getElementById('cancelSection').style.display = 'none';

        }
        function CancelAccept(){
            document.getElementById('acceptSection').style.display = 'none';
        }

    </script>
@endsection
