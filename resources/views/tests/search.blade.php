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
                            <i class="fe fe-life-buoy mr-1"></i>&nbsp
                            {{ trans('app.Sertifikatlashtirish bo\'yicha sinov dasturlari ro\'yxati') }}
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
                                                <th class="border-bottom-0 border-top-0">{{ trans('app.Mahsulot navi') }}</th>
                                                <th class="border-bottom-0 border-top-0">{{ trans('app.Mahsulot miqdori') }}</th>
                                                <th class="border-bottom-0 border-top-0">{{ trans('app.Ishlab chiqarilgan sana') }}
                                                </th>
                                                <th class="border-bottom-0 border-top-0 bg-info w-25" style="width: 25%">
                                                    <select style="cursor: pointer; "
                                                        class="w-100 form-control state_of_country custom-select" name="status"
                                                        id="status">
                                                        <option value="">{{ trans('message.Barchasi') }}</option>
                                                        <option value="3"
                                                            @if ($status == 3) selected="selected" @endif>
                                                            {{ trans('app.Sinov dasturi shakillantirilmagan') }}</option>
                                                        <option value="1"
                                                            @if ($status == 1) selected="selected" @endif>
                                                            {{ trans('app.Sinov dasturi shakllantirilgan') }}</option>
                                                        <option value="2"
                                                            @if ($status == 2) selected="selected" @endif>
                                                            {{ trans('app.Yuborilgan') }}</option>
                                                    </select>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $offset = (request()->get('page', 1) - 1) * 50;
                                            @endphp
                                            @foreach ($apps as $app)
                                                <tr>
                                                    @if ($app->decision)
                                                        <td>{{ $offset + $loop->iteration }}</td>
                                                        <td><a href="{!! url('/application/view/' . $app->id) !!}">{{ $app->app_number }}</a></td>
                                                        <td>{{ $app->date }}</td>
                                                        <td><a
                                                                href="{!! url('/organization/view/' . optional($app->organization)->id) !!}">{{ optional($app->organization)->name }}</a>
                                                        </td>
                                                        <td>{{ optional($app->crops->name)->name }}</td>
                                                        <td>{{ optional($app->crops->type)->name }}</td>
                                                        <td>{{ optional($app->crops)->amount_name }}</td>
                                                        <td>{{ optional($app->crops)->year }}</td>
                                                        <td style="width: 35%;">
                                                            <?php $appid = Auth::User()->id; ?>
                                                            @if ($app->decision)
                                                                @if ($app->tests)
                                                                    <a href="{!! url('/tests/view/' . $app->tests->id) !!}"><button type="button"
                                                                            class="btn btn-round btn-info">{{ trans('app.Sinov dasturi fayli') }}</button></a>
                                                                    @if (!$app->tests->code && !$app->tests->final_result)
                                                                        {{-- <a href="{!! url('/tests/list/edit/' . $app->tests->id) !!}"><button type="button" class="btn btn-round btn-warning">{{ trans('app.Edit') }}</button></a> --}} {{--- vaqtinchalikdan ochish ---}}
                                                                        {{-- <a url="{!! url('/tests/send/'.$app->tests->id) !!}" class="sa-warning"> <button type="button" class="btn btn-round btn-success ">{{ trans('app.Yubor')}}</button></a> --}}
                                                                    @else
                                                                        {{-- <button type="button"
                                                                        class="btn btn-round btn-danger ">{{ trans('app.Yuborilgan') }}</button></a> --}}
                                                                    @endif
                                                                    <a href="{!! url('/tests/list/edit/' . $app->tests->id) !!}"><button type="button" class="btn btn-round btn-warning">{{ trans('app.Edit') }}</button></a> {{--- vaqtinchalik ---}}
                                                                @else
                                                                    <a href="{!! url('/tests/add/' . $app->id) !!}"><button type="button"
                                                                            class="btn btn-round btn-success">&nbsp;
                                                                            {{ trans('app.Sinov dasturini shakllantirish') }}
                                                                            &nbsp;</button></a>
                                                                @endif
                                                            @endif
                                                        </td>
                                                    @endif
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
                title: "{{ trans('app.Laboratoriyaga yuborishni xoxlaysizmi?') }}",
                html: "<span style='color: red;'>{{ trans('app.Yuborilgandan so\'ng ma\'lumotlarni o\'zgartirib bo\'lmaydi!') }}</span>",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#297FCA",
                confirmButtonText: "{{ trans('app.Ha, yuborish!') }}",
                cancelButtonText: "{{ trans('app.Cancel') }}",
                closeOnConfirm: false
            }).then((result) => {
                window.location.href = url;
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#status').change(function() {
                var selectedRegion = $(this).val();
                var currentUrl = window.location.href;
                var url = new URL(currentUrl);

                url.searchParams.set('status', selectedRegion);

                var newUrl = url.toString();
                window.history.pushState({
                    path: newUrl
                }, '', newUrl);
                $.ajax({
                    url: newUrl,
                    method: "GET",
                    success: function(response) {
                        window.location.reload(true);
                    }
                });
            });
        });
    </script>

@endsection
