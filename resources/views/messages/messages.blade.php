@if (session()->has('save'))
<script>
    window.onload = function () {
        notif({
            msg: "تم حفظ البيانات بنجاح",
            type: "success"
        });
    }
</script>
@endif

@if (session()->has('update'))
    <script>
        window.onload = function () {
            notif({
                msg: "تم تعديل البيانات بنجاح",
                type: "success"
            });
        }
    </script>
@endif

@if (session()->has('error'))
    <script>
        window.onload = function () {
            notif({
                msg: "حدث خطأ ما",
                type: "error"
            });
        }
    </script>
@endif

@if (session()->has('delete'))
    <script>
        window.onload = function () {
            notif({
                msg: "تم حذف البيانات بنجاح",
                type: "warning"
            });
        }
    </script>
@endif

@if (session()->has('login'))
    <script>
        window.onload = function () {
            notif({
                msg: "تم تسجيل الدخول بنجاح",
                type: "info"
            });
        }
    </script>
@endif

@if (session()->has('logout'))
    <script>
        window.onload = function () {
            notif({
                msg: "تم تسجيل الخروج بنجاح",
                type: "info"
            });
        }
    </script>
@endif
