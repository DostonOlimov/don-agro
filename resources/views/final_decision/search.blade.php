@extends('layouts.app')
@section('content')
    <!-- page content -->
    <?php $userid = Auth::user()->id; ?>
    @can('viewAny', \App\Models\User::class)
            <div class="section">
                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <i class="fe fe-life-buoy mr-1"></i>&nbsp {{ trans('app.Yakuniy qarorlar ro\'yxati') }}
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
                <!-- filter component -->
                <x-filter :crop="$crop" :city="$city" :from="$from" :till="$till" />
                <!--filter component -->

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    {{ $apps->links() }}
                                    <table id="examples1" class="table table-striped table-bordered nowrap"
                                        style="margin-top:20px;">
                                        <thead>
                                            <tr>
                                                <th class="border-bottom-0 border-top-0">№</th>
                                                <th class="border-bottom-0 border-top-0">{{ trans('app.Ariza raqami') }}</th>
                                                <th class="border-bottom-0 border-top-0">{{ trans('app.Ariza sanasi') }}</th>
                                                <th class="border-bottom-0 border-top-0">
                                                    {{ trans('app.Buyurtmachi korxona yoki tashkilot nomi') }}</th>
                                                <th class="border-bottom-0 border-top-0">{{ trans('app.Mahsulot turi') }}</th>
                                                <th class="border-bottom-0 border-top-0">{{ trans('app.Mahsulot miqdori') }}</th>
                                                <th class="border-bottom-0 border-top-0">{{ trans('app.Ishlab chiqarilgan sana') }}
                                                </th>
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
                                                    <td>{{ optional(optional($app->test_program)->application)->app_number }}</td>
                                                    <td>{{ optional(optional($app->test_program)->application)->date }}</td>
                                                    <td>{{ optional(optional($app->test_program)->application)->organization->name }}
                                                    </td>
                                                    <td>{{ optional(optional($app->test_program)->application)->crops->name->name ?? '' }}
                                                    </td>
                                                    <td>{{ optional($app->test_program)->application->crops->type->name ?? '' }}
                                                    </td>
                                                    <td>{{ optional($app->test_program)->akt[0]->make_date ?? '' }}</td>
                                                    <td>{{ optional($app->test_program)->application->crops->year ?? '' }}</td>
                                                    <td>
                                                        <a href="{!! url('/final_decision/view/' . $app->id) !!}"><button type="button"
                                                                class="btn btn-round btn-info">{{ trans('app.View') }}</button></a>
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

@endsection
