<?php include("header_login.php");?>
    <div class="container">
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery-form@4.2.2/dist/jquery.form.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#LoginForm').on('submit', function(e) {
                    e.preventDefault();
                    $('#submitButton').attr('disabled', '');
                    $("#output").html('<div class="alert alert-info" role="alert">正在登录，请稍等...</div>');
                    $(this).ajaxSubmit({
                        target: '#output',
                        success:  afterSuccess
                    });
                });
            });
            function afterSuccess() {
                $('#submitButton').removeAttr('disabled');
            }
        </script>
        <section class="col-md-5 col-centered">
            <div class="panel panel-default">
                <div class="panel-heading"><h3>管理控制台</h3></div>
                <div class="panel-body">
                    <div class="the-form">
                        <div id="output"></div>
                        <form id="LoginForm" action="submit_login.php" method="post">
                            <div class="form-group">
                                <label for="inputUsername">用户名</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-user"></span>
                                    </span>
                                    <input type="text" class="form-control" name="inputUsername" id="inputUsername" placeholder="请输入用户名...">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword">密码</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-lock"></span>
                                    </span>
                                    <input type="password" class="form-control" name="inputPassword" id="inputPassword" placeholder="请输入密码...">
                                </div>
                            </div>
                            <button type="submit" id="submitButton" class="btn btn-default btn-success btn-lg pull-right">登录</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
<?php include("footer.php");?>