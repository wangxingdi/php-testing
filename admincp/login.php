<?php
session_start();
ob_start();
if (isset($_SESSION['adminuser'])) {
    header("location:index.php");
}
include("../db.php");
?>
    <!doctype html>
    <html>
    <head>
        <meta charset="utf-8">
        <title>管理员控制台</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="../images/favicon.ico" rel="shortcut icon" type="image/x-icon"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="css/style.css" rel="stylesheet" type="text/css">
        <link href="https://cdn.staticfile.org/font-awesome/5.8.2/css/all.min.css" rel="stylesheet" type="text/css">
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js" type="text/javascript"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js" type="text/javascript"></script>
        <![endif]-->
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.4.1/dist/jquery.min.js" type="text/javascript"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap.min.js@3.3.5/bootstrap.min.js" type="text/javascript"></script>
        <script src="https://cdn.jsdelivr.net/npm/jquery-pjax@2.0.1/jquery.pjax.min.js" type="text/javascript"></script>
        <script src="https://cdn.jsdelivr.net/npm/jquery-shake@1.0.0/jquery.ui.shake.min.js" type="text/javascript"></script>
        <script src="https://cdn.jsdelivr.net/npm/jquery-form@4.2.2/dist/jquery.form.min.js" type="text/javascript"></script>
        <script>
            $(function () {
                $(document).pjax('a', '.main-header');
            });
            $(document).ready(function () {
                $('#LoginForm').on('submit', function (e) {
                    e.preventDefault();
                    $('#submitButton').attr('disabled', '');
                    $("#output").html('<div class="alert alert-info" role="alert">正在登录，请稍等...</div>');
                    $(this).ajaxSubmit({
                        target: '#output',
                        success: afterSuccess
                    });
                });
            });

            function afterSuccess() {
                $('#submitButton').removeAttr('disabled');
            }
        </script>
    </head>
    <body>
    <div id="wrap">
        <div class="container-fluid">
            <header class="main-header">
                <a class="logo" href="index.php"><img class="img-responsive" src="images/admin-banner.png" alt="Admin Penal"></a>
            </header>
            <div class="container">
                <section class="col-md-5 col-centered">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3>管理控制台</h3>
                        </div>
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
<?php include("footer.php"); ?>