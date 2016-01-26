                <p class="login-box-msg">تسجيل الدخول</p>
                <form action="login.php" method="POST">
                    <div class="form-group has-feedback">
                        <input type="text" id="user_name" name="user_name" required class="form-control" placeholder="اسم المستخدم">
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input id="user_password" type="password" name="user_password" autocomplete="off" required  class="form-control" placeholder="كلمة السر">
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>
                    <div class="row">
                        <div class="col-xs-8">
                            <div class="checkbox icheck">
                                <label>
                                    <input type="checkbox" id="user_rememberme" name="user_rememberme" value="1"> تذكر تسجيل الدخول
                                </label>
                            </div>
                        </div><!-- /.col -->
                        <div class="col-xs-4">
                            <button type="submit" name="login" class="btn btn-success btn-block">دخول</button>
                        </div><!-- /.col -->
                    </div>
                </form>
                <br>
                <a href="login.php?register" class="btn btn-success btn-block ">انشاء حساب جديد</a>
