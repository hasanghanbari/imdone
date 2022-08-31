<?php
$style = '<link href="assets/css/login.css" rel="stylesheet">';
require_once 'header.php';
?>
<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7 col-lg-5">
                <div class="wrap">
                    <div class="img" style="background-image: url(assets/img/bg-1.jpg);"></div>
                    <div class="login-wrap p-4 p-md-5">
                <div class="d-flex">
                    <div class="w-100">
                        <h3 class="mb-4">صفحه ورود</h3>
                    </div>
                </div>
                <form action="./action/admins/login" method="post" class="signin-form">
                    <div class="form-group mt-3">
                        <input type="text" class="form-control" name="username" required>
                        <label class="form-control-placeholder" for="username">نام کاربری</label>
                    </div>
                    <div class="form-group">
                        <input id="password-field" type="password" class="form-control" name="password" required>
                        <label class="form-control-placeholder" for="password">رمزعبور</label>
                        <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="form-control btn btn-primary rounded submit px-3">ورود</button>
                    </div>
                    <!-- <div class="form-group d-md-flex">
                        <div class="w-50 text-left">
                            <label class="checkbox-wrap checkbox-primary mb-0">مرا به خاطر بسپار
                            <input type="checkbox" checked>
                            <span class="checkmark"></span>
                            </label>
                        </div>
                    </div> -->
                </form>
            </div>
            </div>
            </div>
        </div>
    </div>
</section>
<?php
require_once 'footer.php';
?>