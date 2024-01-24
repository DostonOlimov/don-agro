@extends('layouts.app')
@section('content')
    <!-- page content -->
    <?php $userid = Auth::user()->id; ?>
    @if (getAccessStatusUser('Vehicles', $userid) == 'yes')
        @if (getActiveCustomer($userid) == 'yes' || getActiveEmployee($userid) == 'yes')

            <div class="section">
                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <i class="fe fe-life-buoy mr-1"></i>&nbsp {{ trans('app.Laboratory bayonnomasi') }}
                        </li>
                    </ol>
                </div>
                @if (session('message'))
                    <div class="row massage">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="alert alert-success text-center">
                                @if (session('message') == 'Successfully Submitted')
                                    <label for="checkbox-10 colo_success"> {{ trans('app.Successfully Submitted') }} </label>
                                @elseif(session('message') == 'Successfully Updated')
                                    <label for="checkbox-10 colo_success"> {{ trans('app.Successfully Updated') }} </label>
                                @elseif(session('message') == 'Successfully Deleted')
                                    <label for="checkbox-10 colo_success"> {{ trans('app.Successfully Deleted') }} </label>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                {{-- <div class="panel panel-primary">
								<div class="tab_wrapper page-tab">
									<ul class="tab_list">
											<li class="active">
												<a href="{!! url('/lab_bayonnoma/list')!!}">
													<span class="visible-xs"></span>
													<i class="fa fa-list fa-lg">&nbsp;</i>
													 {{ trans('app.Ro\'yxat')}}
												</a>
											</li>
											<li>
												<a href="{!! url('/lab_bayonnoma/add')!!}">
													<span class="visible-xs"></span>
													<i class="fa fa-plus-circle fa-lg">&nbsp;</i> <b>
													{{ trans('app.Qo\'shish')}}</b>
												</a>
											</li>
										</ul>
								</div>
							</div> --}}
                                <div class="table-responsive">
                                    <table id="datatable" class="table table-striped table-bordered nowrap"
                                        style="margin-top:20px; width:100%;">
                                        <thead>
                                            <tr>
                                                <th>№</th>
                                                <th>{{ trans('app.Laboratoriya') }}</th>
                                                <th>{{ trans('app.Davlat standarti') }}</th>
                                                <th>{{ trans('app.Mahsulotni laboratoriyaga berish sanasi') }}</th>
                                                <th>{{ trans('app.Sinov Bayonnoma to\'ldirish sanasi') }}
                                                <th>{{ trans('app.Sinov Bayonnoma raqami') }}</th>
                                                <th>{{ trans('app.Sinov natijasi') }}</th>
                                                <th>{{ trans('app.Sinov o\'tkazgan mutaxassis') }}</th>
                                                <th>{{ trans('app.Qo\'shimcha ma\'lumotlar') }}</th>
                                                <th>{{ trans('app.Action') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                // dd($data);
                                            @endphp
                                            @foreach ($data as $key => $item)
                                                <tr>
                                                    <td>{{ ++$key }}</td>
                                                    <td>{{ $item->test->application->decision->laboratory->certificate }}</td>
                                                    <td>{{ \App\Models\Nds::getType()[$item->test->application->crops->name->nds->type_id] . '.' . $item->test->application->crops->name->nds->number . ' ' . $item->test->application->crops->name->nds->name }}
                                                    </td>
                                                    @if (!empty($item->lab_bayonnoma[0]))
                                                        <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d', $item->lab_bayonnoma[0]->lab_start_date)->format('d.m.Y') }}
                                                        </td>
                                                        <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d', $item->lab_bayonnoma[0]->date)->format('d.m.Y') }}
                                                        </td>
                                                        <td>{{ $item->lab_bayonnoma[0]->number }}</td>
                                                        <td>{{ $item->lab_bayonnoma[0]->test_result }}</td>
                                                        <td>{{ $item->lab_bayonnoma[0]->test_employee }}</td>
                                                        <td>{{ $item->lab_bayonnoma[0]->description }}</td>
                                                    @else
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                    @endif
                                                    <td>
                                                        @if (!empty($item->lab_bayonnoma[0]))
                                                            <a href="{!! url('/lab_bayonnoma/edit/' . $item->lab_bayonnoma[0]->id) !!}"><button type="button"
                                                                    class="btn btn-round btn-info">{{ trans('app.Edit') }}</button></a>
                                                            <a url="{!! url('/lab_bayonnoma/delete/' . $item->lab_bayonnoma[0]->id) !!}" class="sa-warning"> <button
                                                                    type="button"
                                                                    class="btn btn-round btn-danger dgr">{{ trans('app.Delete') }}</button></a>
                                                        @else
                                                            <a href="{!! url('/lab_bayonnoma/add/' . $item->id) !!}"><button type="button"
                                                                    class="btn btn-round btn-success">&nbsp;
                                                                    {{ trans('app.Laboratory bayonnomasi yaratish') }}
                                                                    &nbsp;</button></a>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
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
                        <span class="titleup text-danger"><i class="fa fa-exclamation-circle" aria-hidden="true"></i>&nbsp
                            {{ trans('app.You Are Not Authorize This page.') }}</span>
                    </div>
                </div>
            </div>
        @endif
    @else
        <div class="section" role="main">
            <div class="card">
                <div class="card-body text-center">
                    <span class="titleup text-danger"><i class="fa fa-exclamation-circle" aria-hidden="true"></i>&nbsp
                        {{ trans('app.You Are Not Authorize This page.') }}</span>
                </div>
            </div>
        </div>

    @endif
    <script src="{{ URL::asset('vendors/jquery/dist/jquery.min.js') }}"></script>
    <!-- delete vehicalbrand -->
    <script>
        $('body').on('click', '.sa-warning', function() {

            var url = $(this).attr('url');


            swal({
                title: "O'chirishni istaysizmi?",
                text: "O'chirilgan ma'lumotlar qayta tiklanmaydi!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#297FCA",
                confirmButtonText: "Ha, o'chirish!",
                cancelButtonText: "O'chirishni bekor qilish",
                closeOnConfirm: false
            }).then((result) => {
                window.location.href = url;

            });
        });
    </script>

@endsection
