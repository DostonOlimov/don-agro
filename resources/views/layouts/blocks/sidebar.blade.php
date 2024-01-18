<div class="sidebar sidebar-dark sidebar-fixed " id="sidebar">
    <div class="sidebar-brand d-none d-md-flex justify-content-around">
        <img style="width:50px;" src="/img/dashboard/Seed.png">
        <h2 style="font-size: 20px; color: white; margin: 6px 22px 5px 0; !important;">
            {{ trans('message.AGROINSPEKSIYA') }}</h2>


    </div>
    <ul class="sidebar-nav" data-coreui="navigation" data-simplebar="">
        <li class="nav-item"><a class="nav-link" href="/home">
                <svg class="nav-icon">
                    <use xlink:href="/assets/vendors/@coreui/icons/svg/free.svg#cil-home"></use>
                </svg>{{ trans('message.Bosh sahifa') }}</a></li>
        @if (auth()->user()->role != \App\Models\User::STATE_EMPLOYEE)
            <li class="nav-group"><a class="nav-link nav-group-toggle">
                    <svg class="nav-icon">
                        <use xlink:href="/assets/vendors/@coreui/icons/svg/free.svg#cil-folder"></use>
                    </svg>{{ trans('message.Hisobotlar') }}</a>
                <ul class="nav-group-items">
                    <li class="nav-item"><a class="nav-link" href="{!! url('full-report') !!}">
                            <svg class="nav-icon">
                                <use xlink:href="/assets/vendors/@coreui/icons/svg/free.svg#cil-list"></use>
                            </svg>{{ trans('message.Umumiy ro\'yxat') }}</a></li>
                    <li class="nav-item"><a class="nav-link" href="{!! url('region-report') !!}">
                            <svg class="nav-icon">
                                <use xlink:href="/assets/vendors/@coreui/icons/svg/free.svg#cil-chart-line"></use>
                            </svg>{{ trans('message.Viloyatlar kesimida hisobot') }}</a></li>
                    <li class="nav-item"><a class="nav-link" href="{!! url('company-report') !!}">
                            <svg class="nav-icon">
                                <use xlink:href="/assets/vendors/@coreui/icons/svg/free.svg#cil-graph"></use>
                            </svg><?php echo nl2br(trans('message.Korxonalar kesimida hisobot')); ?></a></li>
                </ul>
            </li>
        @endif
        <li class="nav-title">{{ trans('message.Bo\'limlar') }}</li>


        <li class="nav-item"><a class="nav-link" href="{!! url('/application/list') !!}"> <svg class="nav-icon">
                    <use xlink:href="/assets/vendors/@coreui/icons/svg/free.svg#cil-cursor"></use>
                </svg>{{ trans('message.Arizalar') }}</a></li>

        <li class="nav-item"><a class="nav-link" href="{!! url('/decision/search') !!}"> <svg class="nav-icon">
                    <use xlink:href="/assets/vendors/@coreui/icons/svg/free.svg#cil-folder-open"></use>
                </svg>{{ trans('message.Qarorlar') }}</a></li>
        <li class="nav-item"><a class="nav-link" href="{!! url('/akt/list') !!}"> <svg class="nav-icon">
                    <use xlink:href="/assets/vendors/@coreui/icons/svg/free.svg#cil-file"></use>
                </svg>{{ trans('app.Namuna  olish dalolatnomasi') }}</a></li>
        {{-- <li class="nav-item"><a class="nav-link" href="{!! url('/tests-laboratory/list') !!}"> <svg class="nav-icon">
                    <use xlink:href="/assets/vendors/@coreui/icons/svg/free.svg#cil-file"></use>
                </svg>{{ trans('app.Labaratoriya') }}</a></li> --}}
        <li class="nav-item"><a class="nav-link" href="{!! url('/tests/search') !!}"> <svg class="nav-icon">
                    <use xlink:href="/assets/vendors/@coreui/icons/svg/free.svg#cil-recycle"></use>
                </svg>{{ trans('app.Sinov dasturlari') }}</a></li>

        <li class="nav-item"><a class="nav-link" href="{!! url('/final_results/search') !!}"> <svg class="nav-icon">
                    <use xlink:href="/assets/vendors/@coreui/icons/svg/free.svg#cil-bar-chart"></use>
                </svg>{{ trans('message.Yakuniy natijalar') }}</a></li>
        @if (auth()->user()->role != \App\Models\User::STATE_EMPLOYEE)
            <li class="nav-item"><a class="nav-link" href="{!! url('/sertificate/search') !!}"> <svg class="nav-icon">
                        <use xlink:href="/assets/vendors/@coreui/icons/svg/free.svg#cil-credit-card"></use>
                    </svg>{{ trans('message.Sertifikatlar') }}</a></li>
        @endif
        <li class="nav-item"><a class="nav-link" href="{!! url('/final_decision/search') !!}"> <svg class="nav-icon">
                    <use xlink:href="/assets/vendors/@coreui/icons/svg/free.svg#cil-library"></use>
                </svg><?php echo nl2br(trans('message.Yakuniy qarorlar')); ?></a></li>
        @if (auth()->user()->role != \App\Models\User::ROLE_INSPECTION_DIROCTOR)
            <li class="nav-title">{{ trans('message.Tizim sozlamalari') }}</li>
            <li class="nav-group"><a class="nav-link nav-group-toggle">
                    <svg class="nav-icon">
                        <use xlink:href="/assets/vendors/@coreui/icons/svg/free.svg#cil-plant"></use>
                    </svg>{{ trans('message.Mahsulot') }}</a>
                <ul class="nav-group-items">
                    <li class="nav-item"><a class="nav-link" href="{{ url('/crops_name/list') }}"><span
                                class="nav-icon"></span>
                            <svg class="nav-icon">
                            </svg>{{ trans('message.Mahsulotlar ro\'yxati') }}</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/crops_type/list') }}"><span
                                class="nav-icon"></span>
                            <svg class="nav-icon">
                            </svg>{{ trans('message.Mahsulot navlari') }}</a>
                    </li>
                    {{-- <li class="nav-item"><a class="nav-link" href="{{ url('/crops_generation/list') }}"><span
                                class="nav-icon"></span>
                            <svg class="nav-icon">
                            </svg>{{ trans('message.Urug\'lik avlodlari') }}</a>
                    </li> --}}
                </ul>
            </li>
            <li class="nav-group"><a class="nav-link nav-group-toggle">
                    <svg class="nav-icon">
                        <use xlink:href="/assets/vendors/@coreui/icons/svg/free.svg#cil-factory"></use>
                    </svg><?php $str = trans('message.Korxona va tashkilotlar');
                    $str = preg_replace('/(\p{L}+\s+\p{L}+)\s+/u', '$1<br>', $str);
                    echo $str;
                    ?>
                </a>
                <ul class="nav-group-items">
                    <li class="nav-item"><a class="nav-link" href="{{ url('/organization/list') }}"><span
                                class="nav-icon"></span>
                            <svg class="nav-icon">
                                <use xlink:href="/assets/vendors/@coreui/icons/svg/free.svg#cis-map"></use>
                            </svg>{{ trans('message.Buyurtmachilar') }}</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/prepared/list') }}"><span
                                class="nav-icon"></span>
                            <svg class="nav-icon">
                                <use xlink:href="/assets/vendors/@coreui/icons/svg/free.svg#cil-city"></use>
                            </svg>{{ trans('message.Ishlab chiqaruvchi zavodlar') }}</a>
                        {{-- Urug'lukka tayorlovchilar --}}
                    </li>
                </ul>
            </li>

            @if (auth()->user()->role != \App\Models\User::STATE_EMPLOYEE)
                <li class="nav-group"><a class="nav-link nav-group-toggle">
                        <svg class="nav-icon">
                            <use xlink:href="/assets/vendors/@coreui/icons/svg/free.svg#cil-command"></use>
                        </svg>{{ trans('message.Normativ hujjatlar') }}</a>
                    <ul class="nav-group-items">
                        <li class="nav-item"><a class="nav-link" href="{!! url('/nds/list') !!}"><span
                                    class="nav-icon"></span>
                                <svg class="nav-icon">
                                    <use></use>
                                </svg>{{ trans('message.Normativ hujjatlar') }}</a></li>
                        <li class="nav-item"><a class="nav-link" href="{!! url('/indicator/list') !!}"><span
                                    class="nav-icon"></span>
                                <svg class="nav-icon">
                                    <use></use>
                                </svg>{{ trans('message.Sifat ko\'rsatkichlari') }}</a></li>
                    </ul>
                </li>
                <li class="nav-title">{{ trans('message.Sozlamalar') }}</li>

                <li class="nav-group"><a class="nav-link nav-group-toggle">
                        <svg class="nav-icon">
                            <use xlink:href="/assets/vendors/@coreui/icons/svg/free.svg#cil-settings"></use>
                        </svg>{{ trans('message.Sozlamalar') }}</a>
                    <ul class="nav-group-items">
                        <li class="nav-item"><a class="nav-link" href="{{ url('/requirement/list') }}"><span
                                    class="nav-icon"></span>
                                <svg class="nav-icon">
                                </svg>{{ trans('message.Talab etiluvchi hujjatlar') }}</a>
                        </li>
                    </ul>
                </li>
            @endif
        @endif
        @if (auth()->user()->role == 'admin')
            <li class="nav-group"><a class="nav-link nav-group-toggle">
                    <svg class="nav-icon">
                        <use xlink:href="/assets/vendors/@coreui/icons/svg/free.svg#cil-user"></use>
                    </svg>{{ trans('message.Foydalanuvchilar') }}</a>
                <ul class="nav-group-items">
                    <li class="nav-item"><a class="nav-link" href="{!! url('/employee/list') !!}"><span
                                class="nav-icon"></span>
                            <svg class="nav-icon">
                                <use xlink:href="/assets/vendors/@coreui/icons/svg/free.svg#cil-group"></use>
                            </svg>{{ trans('app.Ro\'yxat') }}</a></li>
                    <li class="nav-item"><a class="nav-link" href="{!! url('/employee/add') !!}"><span
                                class="nav-icon"></span>
                            <svg class="nav-icon">
                                <use xlink:href="/assets/vendors/@coreui/icons/svg/free.svg#cil-user-plus"></use>
                            </svg>{{ trans('app.Qo\'shish') }}</a>
                    </li>
                </ul>
            </li>

            <li class="nav-group"><a class="nav-link nav-group-toggle">
                    <svg class="nav-icon">
                        <use xlink:href="/assets/vendors/@coreui/icons/svg/free.svg#cil-map"></use>
                    </svg>{{ trans('message.Hududlar') }}</a>
                <ul class="nav-group-items">
                    <li class="nav-item"><a class="nav-link" href="{{ url('/states/list') }}"><span
                                class="nav-icon"></span>
                            <svg class="nav-icon">
                                <use xlink:href="/assets/vendors/@coreui/icons/svg/free.svg#cis-map"></use>
                            </svg>{{ trans('message.Viloyatlar') }}</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/cities/list') }}"><span
                                class="nav-icon"></span>
                            <svg class="nav-icon">
                                <use xlink:href="/assets/vendors/@coreui/icons/svg/free.svg#cil-city"></use>
                            </svg>{{ trans('message.Shaxar va tumanlar') }}</a>
                    </li>
                </ul>
            </li>
        @endif
        <li class="nav-item"><a class="nav-link"></a></li>
    </ul>
    <button class="sidebar-toggler" type="button" data-coreui-toggle="unfoldable"></button>
</div>
