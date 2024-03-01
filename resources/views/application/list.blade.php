@extends('layouts.app')
@section('content')
    <!-- page content -->
    <?php $userid = Auth::user()->id; ?>
    @can('viewAny', \App\Models\Application::class)
        <div class="section">
            <!-- PAGE-HEADER -->
            <div class="page-header">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><i class="fe fe-life-buoy mr-1"></i>&nbsp {{ trans('app.Arizalar ro\'yxati') }}
                    </li>
                </ol>
            </div>
            @if (session('message'))
                <div class="row massage">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="alert alert-success text-center">
                            @if (session('message') == 'Successfully Submitted')
                                <label for="checkbox-10 colo_success"> {{ trans('app.Successfully Submitted') }}</label>
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
                            <div class="panel panel-primary">
                                <div class="tab_wrapper page-tab">
                                    <ul class="tab_list">
                                        <li class="active">
                                            <a href="{!! url('/application/list') !!}">
                                                <span class="visible-xs"></span>
                                                <i class="fa fa-list fa-lg">&nbsp;</i>
                                                {{ trans('app.Ro\'yxat') }}
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{!! url('/application/add') !!}">
                                                <span class="visible-xs"></span>
                                                <i class="fa fa-plus-circle fa-lg">&nbsp;</i> <b>
                                                    {{ trans('app.Qo\'shish') }}</b>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            {{--                        <!-- filter component --> --}}
                            <x-filter :crop="$crop" :city="$city" :from="$from" :till="$till" />
                            {{--                        <!--filter component --> --}}

                            {{-- ariza turi start --}}


                            <div class="row">
                                <div class="col-sm-4">
                                    <form class="input-filter">
                                        <select class="form-control fc-datepicker from input-filter" name="ariza_turi"
                                            autocomplete="off" required="required">
                                            <option value="">{{ trans("app.Ariza turi bo'yicha") }}</option>
                                            <option value="1" {{ $ariza_turi == 1 ? 'selected' : '' }}>Maxalliy ishlab
                                                chiqarish uchun</option>
                                            <option value="2" {{ $ariza_turi == 2 ? 'selected' : '' }}>Import qilingan
                                                mahsulotlar uchun</option>
                                            <option value="3" {{ $ariza_turi == 3 ? 'selected' : '' }}>Eski hosil uchun
                                            </option>
                                        </select>
                                        <button type='submit'
                                            class="btn btn-primary  filter-button">{{ trans('message.Filtrlash') }}
                                        </button>

                                    </form>
                                </div>
                            </div>
                            {{-- ariza turi end --}}

                            <div class="table-responsive">
                                {{ $apps->links() }}
                                <table id="examples1" class="table table-striped table-bordered nowrap display"
                                    style="margin-top:20px;">
                                    <thead>
                                        <tr>
                                            <th class="border-bottom-0 border-top-0">№</th>
                                            {{-- <th class="border-bottom-0 border-top-0">{{ trans('app.Ariza statusi') }}</th> --}}
                                            <th class="border-bottom-0 border-top-0">{{ trans('app.Ariza raqami') }}</th>
                                            <th class="border-bottom-0 border-top-0">{{ trans('app.Ariza sanasi') }}</th>
                                            <th class="border-bottom-0 border-top-0">{{ trans('app.Ishlab chiqargan davlat') }}
                                            </th>
                                            <th class="border-bottom-0 border-top-0">
                                                {{ trans('app.Buyurtmachi korxona yoki tashkilot nomi') }}</th>
                                            <th class="border-bottom-0 border-top-0">
                                                {{ trans('app.Sertifikatlashtirish sxemasi') }}</th>
                                            <th class="border-bottom-0 border-top-0">{{ trans('app.Mahsulot turi') }}</th>
                                            <th class="border-bottom-0 border-top-0">{{ trans('app.Mahsulot navi') }}</th>
                                            <th class="border-bottom-0 border-top-0">{{ trans('app.Mahsulot miqdori') }}</th>
                                            <th class="border-bottom-0 border-top-0">{{ trans('app.Ariza turi') }}</th>
                                            <th class="border-bottom-0 border-top-0">{{ trans('app.Hosil yili') }}</th>
                                            <th class="border-bottom-0 border-top-0">{{ trans('app.Action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $offset = (request()->get('page', 1) - 1) * 50;
                                        @endphp

                                        @foreach ($apps as $app)
                                            <tr>
                                                <td>{{ $offset + $loop->iteration }}</td>
                                                {{-- <td><a href="{!! url('/application/view/' . $app->id) !!}"><button type="button"
                                                            class="btn btn-round btn-{{ $app->status_color }}">{{ $app->status_name }}</button></a>
                                                </td> --}}
                                                <td> <a
                                                        href="{!! url('/application/view/' . $app->id) !!}">{{ $app->app_number == 0 ? '-' : $app->app_number }}</a>
                                                </td>
                                                <td>{{ $app->date }}</td>
                                                <td>{{ optional($app->crops->country)->name }}</td>
                                                <td><a
                                                        href="{!! url('/organization/view/' . $app->organization_id) !!}">{{ optional($app->organization)->name }}</a>
                                                </td>
                                                <td>{{ $app->crops->sxeme_number }}</td>
                                                <td>{{ optional($app->crops->name)->name }}</td>
                                                <td>{{ optional($app->crops->type)->name }}</td>
                                                <td>{{ optional($app->crops)->amount_name }}</td>
                                                <td>{{ \app\models\Application::getType($app->type) }}</td>
                                                <td>{{ optional($app->crops)->year }}</td>
                                                <td>
                                                    @if ($app->status == \App\Models\Application::STATUS_REJECTED)
                                                        <button class="btn btn-secondary"
                                                            onclick="buttonClickHandler('{{ $app->comment->comment ?? '' }}')">{{trans("app.Rad etildi")}}</button>
                                                    @else
                                                        @if ($app->status == 1)
                                                            <a href="{!! url('/application/view/' . $app->id) !!}"><button type="button"
                                                                    class="btn btn-round btn-warning">{{trans("app.Yangi ariza")}}</button></a>
                                                        @else
                                                            <a href="{!! url('/application/view/' . $app->id) !!}"><button type="button"
                                                                    class="btn btn-round btn-info">{{ trans('app.View') }}</button></a>
                                                            @if (!isset($app->tests->result))
                                                                <a href="{!! url('/application/edit/' . $app->id) !!}"><button type="button"
                                                                        class="btn btn-round btn-success">{{ trans('app.Edit') }}</button></a>
                                                            @endif
                                                        @endif
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $apps->links() }}
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
    @endcan
    <!-- /page content -->
    <script src="{{ URL::asset('vendors/jquery/dist/jquery.min.js') }}"></script>
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
    <script>
        function buttonClickHandler(data) {
            alert(data);
        }
    </script>

@endsection
