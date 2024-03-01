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
                            <i class="fe fe-life-buoy mr-1"></i>&nbsp {{ trans('app.Namuna  olish dalolatnomasi') }}
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
												<a href="{!! url('/akt/list')!!}">
													<span class="visible-xs"></span>
													<i class="fa fa-list fa-lg">&nbsp;</i>
													 {{ trans('app.Ro\'yxat')}}
												</a>
											</li>
											<li>
												<a href="{!! url('/akt/add')!!}">
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
                                                <th>{{ trans('app.Ishlab chiqargan davlat') }}</th>
                                                <th>{{ trans('app.Me\'yoriy hujjatlar') }}</th>
                                                <th>{{ trans('app.Mahsulot nomi') }}</th>
                                                <th>{{ trans('app.Ishlab chiqarilgan sana') }}
                                                <th>{{ trans('app.Yaroqliylik sanasi') }}</th>
                                                <th>{{ trans('app.Namuna  olish miqdori') }}</th>
                                                <th>{{ trans('app.Mahsulot birligi') }}</th>
                                                <th>{{ trans('app.Qo\'shimcha ma\'lumotlar') }}</th>
                                                <th>{{ trans('app.Action') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $offset = (request()->get('page', 1) - 1) * 50;
                                            @endphp
                                            @foreach ($data as $key => $item)
                                                <tr>
                                                    <td>{{ $offset + $loop->iteration}}</td>
                                                    <td>{{ optional($item->application->crops->country)->name }}</td>
                                                    <td>
                                                        @php
                                                            foreach ($item->application->crops->name->nds as $value) {
                                                                echo \App\Models\Nds::getType()[$value->type_id] . '.' . $value->number . ' ' . $value->name . '<br>';
                                                            }
                                                        @endphp
                                                    </td>
                                                    <td>{{ optional($item->application->crops->name)->name }}</td>
                                                    @if (!empty($item->akt[0]))
                                                        <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d', $item->akt[0]->make_date)->format('d.m.Y') }}
                                                        </td>
                                                        <td>{{ $item->akt[0]->expiry_date ? \Carbon\Carbon::createFromFormat('Y-m-d', $item->akt[0]->expiry_date)->format('d.m.Y') : '' }}
                                                        </td>
                                                        <td>{{ $item->akt[0]->simple_size }}</td>
                                                        <td>{{ $amount[$item->akt[0]->measure_type] }}</td>
                                                        <td>{{ $item->akt[0]->description }}</td>
                                                    @else
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                    @endif
                                                    {{-- <td>
                                                        @if (!empty($item->akt[0]))
                                                            @if (empty($item->final_result))
                                                                <a href="{!! url('/akt/edit/' . $item->akt[0]->id) !!}"><button type="button"
                                                                        class="btn btn-round btn-info">{{ trans('app.Edit') }}</button></a>
                                                                <a url="{!! url('/akt/delete/' . $item->akt[0]->id) !!}" class="sa-warning"> <button
                                                                        type="button"
                                                                        class="btn btn-round btn-danger dgr">{{ trans('app.Delete') }}</button></a>
                                                            @endif
                                                        @else
                                                            <a href="{!! url('/akt/add/' . $item->id) !!}"><button type="button"
                                                                    class="btn btn-round btn-success">&nbsp;
                                                                    {{ trans('app.Namuna olish dalolatnomasi yaratish') }}
                                                                    &nbsp;</button></a>
                                                        @endif
                                                    </td> --}}

                                                    <td>
                                                        <?php $appid=Auth::User()->id; ?>
                                                            @if(!empty($item->akt[0]))
                                                                @if(!empty($item->akt[0]))
                                                                    {{-- <a href="{!! url('/tests/view/'.$app->tests->id) !!}"><button type="button" class="btn btn-round btn-info">{{trans('app.Sinov dasturi fayli')}}</button></a> --}}
                                                                        <a href="{!!  url('/akt/edit/' . $item->akt[0]->id) !!} !!}"><button type="button" class="btn btn-round btn-warning">{{ trans('app.Edit')}}</button></a>
                                                                        {{-- <a url="{!! url('/tests/send/'.$item->id) !!}" class="sa-warning"> <button type="button" class="btn btn-round btn-success ">{{ trans('app.Yubor')}}</button></a>

                                                                        <button type="button" class="btn btn-round btn-danger ">{{ trans('app.Yuborilgan')}}</button></a> --}}

                                                                @else
                                                                    <a href="{!! url('/tests/add/'.$item->id) !!}"><button type="button" class="btn btn-round btn-success">&nbsp; {{trans('app.Sinov dasturini shakllantirish')}} &nbsp;</button></a>
                                                                @endif
                                                           @else
                                                                <a href="{!! url('/akt/add/' . $item->id) !!}"><button type="button"
                                                                    class="btn btn-round btn-success">&nbsp;
                                                                    {{ trans('app.Namuna olish dalolatnomasi yaratish') }}
                                                                    &nbsp;</button></a>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                    {{ $data->links() }}
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
                title: "{{ trans('app.O\'chirishni istaysizmi?') }}",
                text: "{{ trans('app.O\'chirilgan ma\'lumotlar qayta tiklanmaydi!') }}",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#297FCA",
                confirmButtonText: "{{ trans('app.Ha, o\'chirish!') }}",
                cancelButtonText: "{{ trans('app.O\'chirishni bekor qilish') }}",
                closeOnConfirm: false
            }).then((result) => {
                window.location.href = url;

            });
        });
    </script>

@endsection
