<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta name="description" content="don.agroset">
    <meta name="author" content="Doston Olimov">
    <title>Don va uni qayta ishlashdan olingan mahsulotlarni sertifikatlashtirish organi</title>
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('/assets/images/logo.png') }}">
    <!-- Vendors styles-->

    <link rel="stylesheet" href="{{ asset('front/css/owl.carousel.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('front/css/main.css') }}" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    {{--    <!-- My style files --> --}}
    <link href="{{ asset('resources/assets/plugins/sweetalert2/sweetalert2.min.css') }}"
          rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="{{ asset('build/css/bootstrap-datetimepicker.min.css') }}">
    <link rel="stylesheet" type="text/css"
          href="{{ asset('resources/assets/plugins/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('resources/assets/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('resources/assets/css/color-style.css') }}">

    <link href="{{ asset('resources/assets/plugins/tabs/tabs.css') }}" rel="stylesheet"/>

    <link rel="stylesheet" href="{{ asset('resources/assets/fonts/fonts/font-awesome.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('resources/assets/css/myStyle.css') }}"/>
    <style>
        .hf-warning{
            color:red !important;
        }
    </style>
    @yield('styles')
</head>

@if(Auth::User()->role == 'admin' or Auth::User()->branch_id == \App\Models\User::BRANCH_LABORATORY)
    <body class="app">
    <!-- partial:partials/_sidebar.php -->
{{--    <nav>--}}
{{--        @include('front.layouts.header')--}}
{{--    </nav>--}}
    <!-- partial -->
    <main>
        <div class="container">
            @yield('content')
        </div>
    </main>
    @else
        <div class="section" role="main">
            <div class="card">
                <div class="card-body text-center">
                    <span class="titleup text-danger"><i class="fa fa-exclamation-circle" aria-hidden="true"></i>&nbsp {{ trans('app.You Are Not Authorize This page.')}}</span>
                </div>
            </div>
        </div>
    @endif
    @include('front.layouts.footer')
    <!-- JQUERY SCRIPTS JS-->
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>

    <script src="{{ asset('resources/assets/plugins/hyperform/dist/hyperform.js') }}"></script>
    <script>hyperform(window)</script>
    <script src="{{ asset('resources/assets/js/vendors/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('resources/assets/plugins/date-picker/jquery-ui.js') }}"></script>
    <script src="{{ asset('resources/assets/plugins/waves/js/popper.min.js')}}"></script>

    <script src="{{ asset('resources/assets/plugins/input-mask/input-mask.min.js') }}"></script>
    <script src="{{ asset('resources/assets/plugins/p-scroll/p-scroll.js') }}"></script>
    <script src="{{ asset('resources/assets/plugins/sidemenu/sidemenu.js') }}"></script>
    <script src="{{ asset('resources/assets/plugins/sidemenu-responsive-tabs/js/sidemenu-responsive-tabs.js') }}"></script>
    <script src="{{ asset('resources/assets/plugins/tabs/jquery.multipurpose_tabcontent.js') }}"></script>
    <script src="{{ asset('resources/assets/plugins/tabs/tab-content.js') }}"></script>
    <script src="{{ asset('resources/assets/js/left-menu.js') }}"></script>


    <script src="{{ asset('resources/assets/plugins/select2/dist/js/select2.min.js') }}"></script>
    <script src="{{ asset('resources/assets/plugins/date-picker/date-picker.js') }}"></script>
    <script src="{{ asset('resources/assets/js/vendors/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ asset('vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js') }}"></script>


    {{--<!-- FILE UPLOADES JS -->--}}
    <script src="{{ asset('resources/assets/plugins/fileupload/js/fileupload.min.js') }}"></script>
    <script src="{{ asset('resources/assets/plugins/fileupload/js/file-upload.js') }}"></script>
    <script src="{{ asset('resources/assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('resources/assets/plugins/multipleselect/multiple-select.js') }}"></script>
    <script src="{{ asset('resources/assets/plugins/multipleselect/multi-select.js') }}"></script>

    <script src="{{ asset('resources/assets/plugins/datatable/js/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('resources/assets/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ asset('resources/assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>

    <script src="{{ asset('resources/assets/plugins/datatable/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('resources/assets/plugins/datatable/js//vfs_fonts.js') }}"></script>
    <script src="{{ asset('resources/assets/plugins/datatable/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('resources/assets/plugins/datatable/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('resources/assets/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('resources/assets/plugins/datatable/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('resources/assets/plugins/datatable/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('resources/assets/plugins/datatable/datatable.js') }}"></script>

    <script sync type="text/javascript" src="{{ asset('resources/assets/plugins/table-export/file-saver.min.js') }}"></script>
    <script sync type="text/javascript" src="{{ asset('resources/assets/plugins/table-export/blob.min.js') }}"></script>
    <script src="{{ asset('resources/assets/plugins/stickyTable/jquery.stickytable.js') }}"></script>
    <script src="{{ asset('resources/assets/js/moment.js') }}"></script>
    <script src="{{ asset('resources/assets/js/uz-latn.js') }}"></script>
    <script src="{{ asset('vendors/bootstrap-daterangepicker/daterangepicker.js') }}"></script>

    <script src="/js/num.js"></script>
    <script src="{{ asset('resources/assets/plugins/print/dist/jQuery.print.min.js') }}"></script>
    <script src="{{ asset('resources/assets/plugins/cropper/cropper.min.js') }}"></script>
    <script src="{{ asset('build/js/control.js') }}"></script>

    <script src="{{ asset('resources/assets/js/custom.js') }}"></script>
    <script src="{{ asset('resources/assets/js/myjs.js') }}"></script>
    @yield('scripts')
    <script>
        function changeLanguage(language) {
            // Use AJAX to send a request to change the language
            var token = "{{ csrf_token() }}";
            $.ajax({
                type: 'POST',
                url: '/change-language',
                data: { language: language , _token: token},
                success: function (data) {
                    location.reload();
                },
                error: function (error) {
                    console.error('Error changing language', error);
                }
            });
        }

        function changeYear(year) {
            $.ajax({
                type: 'POST',
                url: '/change-year',
                data: { year: year, _token: "{{ csrf_token() }}" },
                success: function () {
                    location.reload();
                },
                error: function (error) {
                    console.error('Error changing year', error);
                }
            });
        }
    </script>

    </body>

</html>
