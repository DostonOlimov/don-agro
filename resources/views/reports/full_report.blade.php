@extends('layouts.app')
@section('styles')
    <style>
        th {
            background-color: #42b6fd !important;
            /* gradient from orange to dark orange */
            color: white !important;
            font-weight: bold !important;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #eaf2ee;
            /* Light Gray */
        }

        .table-striped tbody tr:nth-of-type(even) {
            background-color: #ffffff;
            /* Lighter Gray */
        }
    </style>
@endsection
@section('content')
    <!-- page content -->
    <?php $userid = Auth::user()->id; ?>
    @can('viewAny', \App\Models\Application::class)
            <div class="section">
                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <i class="fe fe-life-buoy mr-1"></i>&nbsp {{ trans('app.Barcha arizalar bo\'yicha umumiy ro\'yxat') }}
                        </li>
                    </ol>
                </div>
                <div class="row">
                    <div class="col-sm-3 pt-2">
                        <a class="btn btn-success"
                            href="{{ route('excel.export', [
                                'from' => $from,
                                'till' => $till,
                                'city' => $city,
                                'crop' => $crop,
                                'region' => $region,
                                'organization' => optional($organization)->id,
                                'prepared' => optional($prepared)->id,
                                'type' => $type,
                                // 'generation'=>$generation,
                                'region' => $region,
                                'country' => $country,
                                'year' => $year,
                            ]) }}">
                            <i class="fa fa-file-excel-o" style="margin-right: 6px"></i>{{ trans('app.Excel fayl') }}</a>
                    </div>
                    <div class="col-sm-9" id="list-date-filter" style="padding-top: 3px;">
                        <div class="show-date btn btn-default filter-button" style="background-color: #3160EE;color:white">
                            <b>{{ trans('message.Vaqt bo\'yicha filtrlash') }}</b> <i
                                class="fa {{ $from && $till ? 'fa-angle-left' : 'fa-angle-right' }}" style="margin-left: 5px"></i>
                        </div>
                        <div class="date {{ $from && $till ? 'open' : '' }}">
                            <form class="input-filter">
                                <input class="form-control fc-datepicker from input-filter" name="from" placeholder="dd-mm-yyyy"
                                    autocomplete="off" required="required"
                                    @if (!empty($from)) value="{{ $from }}" @endif />
                                {{ trans('message.dan') }}
                                <input class="form-control fc-datepicker till input-filter" name="till" placeholder="dd-mm-yyyy"
                                    autocomplete="off" required="required"
                                    @if (!empty($till)) value="{{ $till }}" @endif />
                                {{ trans('message.gacha') }}
                                @if ($from && $till)
                                    <button type="button" class="btn btn-primary filter-button"
                                        id="cancel-date-filter">{{ trans('message.Filtrni bekor qilish') }}
                                    </button>
                                @else
                                    <button type='submit' class="btn btn-primary  filter-button">{{ trans('message.Filtrlash') }}
                                    </button>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div style="margin-bottom: 25px">
                                    {{ $apps->links() }}
                                </div>
                                <div class="table-responsive text-nowrap">
                                    <table class="table table-striped table-bordered" style="margin-top:20px;">
                                        <thead>
                                            <tr>
                                                <th rowspan="2" class="border-bottom-0 border-top-0">№</th>
                                                <th rowspan="2">{{ trans('app.Ariza raqami') }}</th>
                                                <th rowspan="2">{{ trans('app.Ariza sanasi') }}</th>
                                                <th rowspan="2">&nbsp{{ trans('app.Na\'muna olingan viloyat') }}&nbsp</th>
                                                <th rowspan="2">{{ trans('app.Na\'muna olingan shahar yoki tuman') }}</th>
                                                <th rowspan="2">{{ trans('app.Buyurtmachi korxona yoki tashkilot nomi') }}</th>
                                                <th rowspan="2">
                                                    {{ trans('app.Mahsulot tayorlangan shaxobcha yoki sexning nomi') }}</th>
                                                <th rowspan="2">{{ trans('app.Ishlab chiqargan davlat') }}</th>
                                                <th rowspan="2">&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
                                                    {{ trans('app.Mahsulot turi') }} &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
                                                    &nbsp</th>
                                                <th rowspan="2">{{ trans('app.Mahsulot navi') }}</th>
                                                {{-- <th rowspan="2">{{trans('app.Ekin avlodi')}}</th> --}}
                                                <th rowspan="2">{{ trans('app.Toʼda (partiya) raqami') }}</th>
                                                <th rowspan="2">{{ trans('app.Mahsulot miqdori') }}</th>
                                                <th rowspan="2">&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
                                                    {{ trans('app.Ishlab chiqarilgan sana') }} &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
                                                    &nbsp</th>
                                                <th rowspan="2">{{ trans('app.Sinov bayonnoma raqami') }}</th>
                                                <th colspan="2">{{ trans('app.Sertifikat') }}</th>
                                                <th colspan="3">{{ trans('app.Tahlil natija') }}</th>
                                                <th rowspan="2">{{ trans('app.Izoh') }}</th>
                                                <th rowspan="2">{{ trans('app.Qaror fayllari') }}</th>
                                                <th rowspan="2">{{ trans('app.Sinov bayonnoma fayllari') }}</th>
                                                <th rowspan="2">{{ trans('app.Yakuniy natija fayli') }}</th>
                                            </tr>
                                            <tr>
                                                <th>{{ trans('app.Sertifikat raqami') }}</th>
                                                <th>{{ trans('app.Berilgan sanasi') }}</th>
                                                <th>{{ trans('app.Raqami') }}</th>
                                                <th>{{ trans('app.Berilgan sanasi') }}</th>
                                                <th style="border-right-width: 1px;">{{ trans('app.Yaroqliligi') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr style="background-color: #90aec6 !important;">
                                                <td> </td>
                                                <td>
                                                    <form class="d-flex">
                                                        <input type="text" name="app_number" class="search-input form-control"
                                                            value="{{ isset($_GET['app_number']) ? $_GET['app_number'] : '' }}">
                                                    </form>
                                                </td>
                                                <td></td>
                                                <td>
                                                    <select class="w-100 form-control state_of_country custom-select "
                                                        name="city" id="city" url="{!! url('/getcityfromstate') !!}">
                                                        @if (count($states))
                                                            <option value="">{{ trans('app.Viloyat tanlang') }}</option>
                                                        @endif
                                                        @if (!empty($states))
                                                            @foreach ($states as $state)
                                                                <option value="{{ $state->id }}"
                                                                    @if ($city && $city == $state->id) selected="selected" @endif>
                                                                    {{ $state->name }} </option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </td>
                                                <td>
                                                    <select class="form-control w-100 city_of_state custom-select" name="region"
                                                        id="region">
                                                        <option value="">{{ trans('app.Tumanni tanlang') }}</option>
                                                        @if (!empty($cities))
                                                            @foreach ($cities as $city)
                                                                <option value="{{ $city->id }}"
                                                                    @if (($region && $region == $city->id) || count($cities) == 1) selected="selected" @endif>
                                                                    {{ $city->name }} </option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </td>
                                                <td>
                                                    <select id="organization" class="form-control owner_search" name="organization">
                                                        @if (!empty($organization))
                                                            <option selected value="{{ $organization->id }}">
                                                                {{ $organization->name }}</option>
                                                        @endif
                                                    </select>
                                                    @if ($organization)
                                                        <i class="fa fa-trash" style="color:red"
                                                            onclick="changeDisplay('organization')"></i>
                                                    @endif
                                                </td>
                                                <td>
                                                    <select id="prepared" class="form-control owner_search2" name="prepared">
                                                        @if (!empty($prepared))
                                                            <option selected value="{{ $prepared->id }}">{{ $prepared->name }}
                                                            </option>
                                                        @endif
                                                    </select>
                                                    @if ($prepared)
                                                        <i class="fa fa-trash" style="color:red"
                                                            onclick="changeDisplay('prepared')"></i>
                                                    @endif
                                                </td>
                                                <td>
                                                    <select class="w-100 form-control" name="country" id="country">
                                                        @if (count($countries))
                                                            <option value="">{{ trans('app.Mamlakat nomini tanlang') }}
                                                            </option>
                                                        @endif
                                                        @if (!empty($countries))
                                                            @foreach ($countries as $name)
                                                                <option value="{{ $name->id }}"
                                                                    @if ($name->id == $country) selected @endif>
                                                                    {{ $name->name }} </option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </td>
                                                <td>
                                                    <select class="w-100 form-control name_of_corn custom-select" name="name"
                                                        id="crops_name" url="{!! url('/gettypefromname') !!}">
                                                        @if (count($names))
                                                            <option value="">{{ trans('app.Mahsulot turini tanlang') }}
                                                            </option>
                                                        @endif
                                                        @if (!empty($names))
                                                            @foreach ($names as $name)
                                                                <option value="{{ $name->id }}"
                                                                    @if ($crop == $name->id) selected @endif>
                                                                    {{ $name->name }} </option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </td>
                                                <td>
                                                    <select class="form-control w-100 type_of_corn custom-select" name="type"
                                                        id="type">
                                                        @if ($types)
                                                            <option value="">
                                                                {{ trans('app.Mahsulot (nav) sinfini tanlang') }}</option>
                                                        @endif
                                                        @if (!empty($types))
                                                            @foreach ($types as $type_name)
                                                                <option value="{{ $type_name->id }}"
                                                                    @if ($type == $type_name->id) selected @endif>
                                                                    {{ $type_name->name }} </option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </td>
                                                {{-- <td>
                                            <select class="form-control w-100 generation_of_corn custom-select" name="generation" id="generation" >
                                                @if ($types)
                                                    <option value="">Ekin avlodini tanlang</option>
                                                @endif
                                                @if (!empty($generations))
                                                    @foreach ($generations as $generation_name)
                                                        <option value="{{ $generation_name->id }}" @if ($generation == $generation_name->id) selected @endif
                                                        > {{$generation_name->name}} </option>
                                                    @endforeach

                                                @endif
                                            </select>
                                        </td> --}}
                                                <td>
                                                    <form class="d-flex">
                                                        <input type="text" name="s" class="search-input form-control"
                                                            value="{{ isset($_GET['s']) ? $_GET['s'] : '' }}">
                                                    </form>
                                                </td>
                                                <td>
                                                </td>
                                                <td>
                                                    <select class="w-100 form-control" name="year" id="year">
                                                        @if (count($years))
                                                            <option value="">
                                                                {{ trans('app.Ishlab chiqarilgan sanani tanlang') }}</option>
                                                        @endif
                                                        @foreach ($years as $key => $name)
                                                            <option value="{{ $key }}"
                                                                @if ($key == $year) selected @endif>
                                                                {{ $name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            @php
                                                $offset = (request()->get('page', 1) - 1) * 50;
                                                $partiya = 0;
                                                $all_amount = 0;
                                                $count_app = 0;
                                            @endphp
                                            @foreach ($apps as $key => $app)
                                                <tr>
                                                    @php $type = optional(optional($app->tests)->result)->type ; @endphp
                                                    <td>{{ $offset + $loop->iteration }}</td>
                                                    <td><a href="{!! url('/application/view/' . $app->id) !!}">{{ $app->app_number }}</a></td>
                                                    <td><a href="{!! url('/application/view/' . $app->id) !!}">{{ $app->date }}</a></td>
                                                    <td>{{ optional(optional(optional($app->organization)->city)->region)->name }}
                                                    </td>
                                                    <td>{{ optional(optional($app->organization)->city)->name }}</td>
                                                    <td><a
                                                            href="{!! url('/organization/view/' . $app->organization_id) !!}">{{ optional($app->organization)->name }}</a>
                                                    </td>
                                                    <td>{{ optional($app->prepared)->name }}</td>
                                                    <td>{{ optional($app->crops->country)->name }}</td>
                                                    <td>{{ optional($app->crops->name)->name }}</td>
                                                    <td>{{ optional($app->crops->type)->name }}</td>
                                                    {{-- <td>{{ optional($app->crops->generation)->name }}</td> --}}
                                                    @php
                                                        $akt = optional(optional($app->tests)->akt)[0];
                                                        if ($akt && $akt->party_number) {
                                                            $partiya += $akt->party_number;
                                                        }
                                                        $amounts = $app->crops;
                                                        if ($amounts) {
                                                            if($amounts->measure_type==2){
                                                                $all_amount += $amounts->amount * 0.001;
                                                            }
                                                            else {
                                                                $all_amount += $amounts->amount;
                                                            }
                                                        }
                                                        $count_app = $offset + $loop->iteration ?? 0;
                                                    @endphp
                                                    <td>{{ optional($app->tests)->akt[0]->party_number ?? '' }}</td>
                                                    <td>{{ optional($app->crops)->amount_name }}</td>
                                                    <td>{{ optional($app->crops)->year }}</td>
                                                    <td>
                                                        @if ($type == 2)
                                                            {{ $app->tests->akt[0]->lab_bayonnoma[0]->number ?? '' }}
                                                        @else
                                                            @if (is_null($type))
                                                                <button
                                                                    class="btn btn-warning">{{ trans('app.Jarayonda') }}</button>
                                                            @endif
                                                        @endif
                                                    </td>
                                                    <td>{{ optional(optional(optional($app->tests)->result)->certificate)->reestr_number }}
                                                    </td>
                                                    <td>{{ optional(optional(optional($app->tests)->result)->certificate)->given_date }}
                                                    </td>
                                                    {{-- start lab result --}}
                                                    <td>
                                                        @if ($type != 2)
                                                            {{ optional(optional($app->tests)->result)->number }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($type != 2)
                                                            {{ optional(optional($app->tests)->result)->date }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($type === 1)
                                                            {{ 'Muvofiq' }}
                                                        @endif
                                                        @if ($type === 0)
                                                            {{ 'Nomuvofiq' }}
                                                        @endif
                                                    </td>
                                                    {{-- end lab result --}}
                                                    <td>{{ optional(optional($app->tests)->result)->comment }}</td>
                                                    <td>
                                                        @if ($app->decision)
                                                            <a href="{!! url('/decision/view/' . optional($app->decision)->id) !!}"><button type="button"
                                                                    class="btn btn-round btn-info">{{ trans('app.Qaror fayli') }}</button></a>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($app->tests)
                                                            <a href="{!! url('/tests/view/' . $app->tests->id) !!}"><button type="button"
                                                                    class="btn btn-round btn-info">{{ trans('app.Sinov dasturi fayli') }}</button></a>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if (optional(optional($app->tests)->result)->attachment)
                                                            <a href="{{ route('attachment.download', ['id' => optional(optional($app->tests)->result)->attachment->id]) }}"
                                                                class="text-azure">
                                                                <i class="fa fa-download"></i> {{ trans('app.Yuklash') }}
                                                            </a>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                    </table>
                                </div>
                                {{ $apps->links() }}
                            </div>
                            <h4
                                style="position: sticky; bottom: 0; padding: 1%; color: #0052cc; width: 100%; display: flex; justify-content: space-between; background-color: white">
                                <span>{{ trans("app.Jami og'irligi:") . ' ' . number_format($all_amount, 2, ',', ' ') . ' ' . trans('app.tonna') }}</span>
                                <span style="color: #197da5;">{{ trans('app.Arizalar soni:') }} {{ $count_app }}
                                    {{ trans('app.ta') }}</span>
                                <span style="color: #097a22;">
                                    {{ trans('app.Jami partiyalar sonni:') . ' ' . number_format($partiya, 0, '', ' ') . ' ' . trans('app.ta') }}
                                </span>
                            </h4>
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
        function changeDisplay(name) {
            //organization companies change
            var currentUrl = window.location.href;
            var url = new URL(currentUrl);

            // Set the new query parameter
            url.searchParams.set(name, '');

            // Modify the URL and trigger an AJAX request
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
        }
    </script>
    <script>
        $(document).ready(function() {

            $('#region').change(function() {
                var selectedRegion = $(this).val();

                var currentUrl = window.location.href;
                var url = new URL(currentUrl);

                // Set the new query parameter
                url.searchParams.set('region', selectedRegion);

                // Modify the URL and trigger an AJAX request
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
        // add url for filter
        $(document).ready(function() {
            //organization companies change
            $('#organization').change(function() {
                var selectedRegion = $(this).val();

                var currentUrl = window.location.href;
                var url = new URL(currentUrl);

                // Set the new query parameter
                url.searchParams.set('organization', selectedRegion);

                // Modify the URL and trigger an AJAX request
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
            //prepared companies change
            $('#prepared').change(function() {
                var selectedRegion = $(this).val();

                var currentUrl = window.location.href;
                var url = new URL(currentUrl);

                // Set the new query parameter
                url.searchParams.set('prepared', selectedRegion);

                // Modify the URL and trigger an AJAX request
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
            //country change
            $('#country').change(function() {
                var selectedRegion = $(this).val();

                var currentUrl = window.location.href;
                var url = new URL(currentUrl);

                // Set the new query parameter
                url.searchParams.set('country', selectedRegion);

                // Modify the URL and trigger an AJAX request
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
            //crop names change
            $('#crops_name').change(function() {
                var selectedRegion = $(this).val();

                var currentUrl = window.location.href;
                var url = new URL(currentUrl);

                // Set the new query parameter
                url.searchParams.set('crop', selectedRegion);

                // Modify the URL and trigger an AJAX request
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
            //crop types change
            $('#type').change(function() {
                var selectedRegion = $(this).val();

                var currentUrl = window.location.href;
                var url = new URL(currentUrl);

                // Set the new query parameter
                url.searchParams.set('type', selectedRegion);

                // Modify the URL and trigger an AJAX request
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
            //crop generation change
            // $('#generation').change(function () {
            //     var selectedRegion = $(this).val();

            //     var currentUrl = window.location.href;
            //     var url = new URL(currentUrl);

            //     // Set the new query parameter
            //     url.searchParams.set('generation', selectedRegion);

            //     // Modify the URL and trigger an AJAX request
            //     var newUrl = url.toString();
            //     window.history.pushState({ path: newUrl }, '', newUrl);

            //     $.ajax({
            //         url:  newUrl,
            //         method: "GET",
            //         success: function (response) {
            //             window.location.reload(true);
            //         }
            //     });
            // });
        });
    </script>
    {{--    appllication add --}}
    <script>
        $(document).ready(function() {
            $('select.owner_search').select2({
                ajax: {
                    url: '/organization/search_by_name',
                    delay: 300,
                    dataType: 'json',
                    data: function(params) {
                        return {
                            search: params.term
                        }
                    },
                    processResults: function(data) {
                        data = data.map((name, index) => {
                            return {
                                id: name.id,
                                text: capitalize(name.name + (name.name ? ' - STiR:' + name
                                    .inn : ''))
                            }
                        });
                        return {
                            results: data
                        }
                    }
                },
                language: {
                    inputTooShort: function() {
                        return '{{ trans('app.Korxona (nomi), STIR ini kiritib izlang') }}';
                    },
                    searching: function() {
                        return '{{ trans('app.Izlanmoqda...') }}';
                    },
                    noResults: function() {
                        return '{{ trans('app.Natija topilmadi') }}'
                    },
                    errorLoading: function() {
                        return '{{ trans('app.Natija topilmadi') }}'
                    }
                },
                placeholder: '{{ trans('app.Korxona nomini kiriting') }}',
                minimumInputLength: 2
            })
            $('select.owner_search2').select2({
                ajax: {
                    url: '/prepared/search_by_name',
                    delay: 300,
                    dataType: 'json',
                    data: function(params) {
                        return {
                            search: params.term
                        }
                    },
                    processResults: function(data) {
                        data = data.map((name, index) => {
                            return {
                                id: name.id,
                                text: capitalize(name.name)
                            }
                        });
                        return {
                            results: data
                        }
                    }
                },
                language: {
                    inputTooShort: function() {
                        return '{{ trans('app.Korxona nomini kiritib izlang') }}';
                    },
                    searching: function() {
                        return '{{ trans('app.Izlanmoqda...') }}';
                    },
                    noResults: function() {
                        return '{{ trans('app.Natija topilmadi') }}'
                    },
                    errorLoading: function() {
                        return '{{ trans('app.Natija topilmadi') }}'
                    }
                },
                placeholder: '{{ trans('app.Korxona nomini kiriting') }}',
                minimumInputLength: 2
            })

            function capitalize(text) {
                var words = text.split(' ');
                for (var i = 0; i < words.length; i++) {
                    if (words[i][0] == null) {
                        continue;
                    } else {
                        words[i] = words[i][0].toUpperCase() + words[i].substring(1).toLowerCase();
                    }

                }
                return words.join(' ');
            }
        });
    </script>

@endsection
