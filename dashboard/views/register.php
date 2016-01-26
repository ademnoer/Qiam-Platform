<p class="login-box-msg">قم بتعبئة معلوماتك  من اجل انشاء حساب جديد</p>
<form action="login.php?register" method="post">
    <div class="form-group has-feedback">
        <input id="user_name" type="text" pattern="[a-zA-Z0-9]{2,64}" name="user_name" required class="form-control" placeholder="اسم المستخدم">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
    </div>
    <div class="form-group has-feedback">
        <input id="user_email" type="email" name="user_email" required class="form-control" autocomplete="off" value="" placeholder="البريد الالكتروني">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
    </div>
    <div class="form-group has-feedback">
        <input id="user_password_new" type="password" name="user_password_new" pattern=".{6,}" required autocomplete="off" value="" class="form-control" placeholder="كلمة السر">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
    </div>
    <div class="form-group has-feedback">
        <input id="user_password_repeat" type="password" name="user_password_repeat" pattern=".{6,}" required autocomplete="off" class="form-control" placeholder="اعد كتابة كلمة السر">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
    </div>
    <div class="form-group has-feedback">
        <input id="user_orgnization" type="text" name="user_orgnization" pattern=".{2,64}" required class="form-control" placeholder="اسم المنظمة">
        <span class="glyphicon glyphicon-ok-sign form-control-feedback"></span>
    </div>
    <div class="form-group has-feedback">
        <input id="user_class" type="text" pattern=".{2,64}" name="user_class" required class="form-control" placeholder="الوصف: متطوع او مدرب او مشارك ...">
        <span class="glyphicon glyphicon-ok-sign form-control-feedback"></span>
    </div>
    <div class="form-group has-feedback">
        <?php echo '<img src="functions/tools/showCaptcha.php" alt="captcha" />'; ?>
        <input type="text" name="captcha" required class="form-control" placeholder="رمز التحقق">
    </div>
    <div class="row">
        <div class="col-xs-8">
            <div class="checkbox icheck">
                <label>
                    <input required type="checkbox"> اوافق على شروط الخدمة
                </label>
            </div>
        </div>
        <div class="col-xs-4">
            <input type="submit" name="register" id="submit" class="btn btn-success btn-block" value="تسجيل">
        </div>
    </div>
</form>
<br><br>
<a href="login.php" class="btn btn-success btn-block">هل لديك حساب من قبل ؟</a>
