<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0">

    <!-- Site Metas -->
    <title>مٍــــٌن الأًخٍــــــّر</title>

    <!-- Favicon -->
    <link rel="icon" href="{{asset('assets/img/brand/favicon.png')}}" type="image/x-icon"/>
    <!-- Bootstrap css -->
    <link href="{{asset('assets/plugins/bootstrap/css/bootstrap.rtl.min.css')}}" rel="stylesheet">
    <!--- Style css --->
    <link href="{{asset('assets/css-rtl/style.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/login/css/style.css') }}">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="{{ asset('assets/login/css/responsive.css') }}">
    <!-- color -->
    <link id="changeable-colors" rel="stylesheet" href="{{ asset('assets/login/css/colors/orange.css') }}"/>
    <!-- Modernizer -->
    <script src="{{ asset('assets/login/js/modernizer.js') }}"></script>
    <!--Internal Notify -->
    <link href="{{asset('assets/plugins/notify/css/notifIt.css')}}" rel="stylesheet"/>

</head>

<body>

@include('messages.messages')

<div id="banner" class="banner full-screen-mode parallax p-0 m-0 border-0">
    <div class="container pr">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="banner-static">
                <div class="banner-text">
                    <div class="banner-cell">
                        <h1><span class="typer" id="some-id" data-delay="200" data-delim=":"
                                  data-words="مٍــــٌن:الأًخٍــــــّر" data-colors="red"></span></h1>
                        <h2>Maestro Technology</h2>
                        <p>تصميم وبرمجة مايسترو تكنولوجى</p>
                        <div class="book-btn">
                            <a href="#modaldemo8" class="modal-effect table-btn hvr-underline-from-center"
                               data-bs-toggle="modal" data-bs-effect="effect-slide-in-right">دخول</a>
                        </div>
                    </div>
                    <!-- end banner-cell -->
                </div>
                <!-- end banner-text -->
            </div>
            <!-- end banner-static -->
        </div>
        <!-- end col -->
    </div>
    <!-- end container -->
</div>
<!-- end banner -->

<!-- Modal effects -->
<div class="modal fade" id="modaldemo8">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">تسجيل الدخول</h6>
                <button aria-label="Close" class="close"
                        data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form class="needs-validation was-validated" action="{{ route('login') }}" method="post"
                      autocomplete="off">
                    @csrf
                    <div class="form-group has-success mg-b-0">
                        <input class="form-control" name="username" placeholder="اسم المستخدم" required=""
                               type="text">
                        <input class="form-control mg-t-20" name="password" placeholder="ادخل كلمة المرور"
                               required=""
                               type="text">

                    </div>
                    <div class="modal-footer">
                        <button class="btn ripple btn-primary" type="submit">تسجيل الدخول</button>
                        <button class="btn ripple btn-secondary" data-bs-dismiss="modal" type="button">إلغاء
                        </button>
                    </div>
                </form>
                <!--/div-->
            </div>
        </div>
    </div>
</div>
<!-- End Modal effects-->

<!-- ALL JS FILES -->
<script src="{{ asset('assets/login/js/all.js') }}"></script>
<script src="{{ asset('assets/login/js/bootstrap.min.js') }}"></script>
<!-- ALL PLUGINS -->
<script src="{{ asset('assets/login/js/custom.js') }}"></script>
<!-- Internal Modal js-->
<script src="{{asset('assets/js/modal.js')}}"></script>
<!-- Jquery js-->
<script src="{{asset('assets/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap js-->
<script src="{{asset('assets/plugins/bootstrap/js/popper.min.js')}}"></script>
<script src="{{asset('assets/plugins/bootstrap/js/bootstrap-rtl.js')}}"></script>
<!-- Notify js -->
<script src="{{asset('assets/plugins/notify/js/notifIt-rtl.js')}}"></script>
</body>

</html>
