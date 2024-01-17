
@extends('layouts.front')
@section('content')
<style>
.btn-login{
    width: 100%;
    font-weight: bold;
    border-radius: 4px;
    padding: 10px;
}
</style>
<div class="container " >
    <div class="container-fluid page-body-wrapper full-page-wrapper" >
        <div class="content-wrapper d-flex align-items-center auth auth-bg-1 theme-one"  >
            <div class="row w-100">
                <div class="col-lg-6 mx-auto">
                    <div class="row">
                        <div class="col-lg-12 pr-0">
                            <a href="{!! url('login') !!}"><button type="button" class="btn btn-light rounded-top p-3 w-100" ><b>Kirish</b></button></a>
                        </div>
                        {{-- <div class="col-lg-6 pl-0">
                            <a href="{!! url('register') !!}"><button type="button" class="btn btn-primary rounded-top p-3 w-100"><b>Ro'yxatdan o'tish</b></button></a>
                        </div> --}}
                    </div>
                    <div class="auto-form-wrapper">
                        <form action="{{ route('login') }}" method="POST">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <b> <label class="label">Email</label></b>
                                <div class="input-group">
                                    <input name="email" type="text" class="form-control" placeholder="Email" value="{{ old('email') }}">
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                          <i class="mdi mdi-check-circle-outline"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            @if ($errors->has('email'))
                                <span class="help-block">
                                <strong>Kiritilgan pochta ma'lumotlari noto'g'ri</strong>
                            </span>
                            @endif
                            <div class="form-group">
                                <b><label class="label">Password</label></b>
                                <div class="input-group">
                                    <input name="password" type="password" class="form-control" placeholder="Parol" >
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                          <i class="mdi mdi-check-circle-outline"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            @if ($errors->has('password'))
                                <span class="help-block">
                                <strong>Parol kiritilmagan yoki noto'g'ri kiritilgan</strong>
                            </span>
                            @endif
                            <div class="form-group">
                                <button class="btn btn-primary submit-btn btn-block">Kirish</button>
                            </div>
                        </form>
                    </div>
                    <hr>
                   <b><p style="color:red;" class="footer-text text-center">Copyright © {{ date('Y') }} O'ZAGROINSPEKSIYA. Barcha huquqlar himoyalangan.</p></b>
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>


@endsection
