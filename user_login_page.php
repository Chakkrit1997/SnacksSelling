


<!doctype html>
<html lang="en">

<head>
    <title>Snack Webprogramming</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Favicon -->
    <link rel="shortcut icon" href="#" type="image/x-icon">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="src/css/bootstrap.min.css">

    <!-- Google Fonts CSS -->
    <link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="src/css/style.css">


</head>

<body class="mt-2 forms-body">
    <div class="container">
        <!--  Start Heading -->
        <div class="text-center">
            <!-- <p class="h1 text-center text-justify">Welcome to Snack Selling!</p> -->
            <img src="src/img/snack.jpg" class="rounded img-fluid" alt="Responsive image" width="1170" height="250">
        </div>

        <!--  Start Login Form-->
        <form class="mt-2 myForm" method="post" action="user_login.php">
            <div class="text-center">
                <h2 class="mt-2 font-weight-normal">Customer Login</h2>
            </div>
            <div class="form-group mt-2">
                <input type="text" class="form-control" name="username" id="username" placeholder="Username" required autofocus>
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
            </div>

            <div class="form-group">
                <button type="submit" name="login" class="mt-2 btn btn-primary btn-block">Login</button>
            </div>

            <!-- Button trigger modal -->
            <div class="text-center ">
                <button type="button" class="mt-2 btn btn-danger btn-block" data-toggle="modal" data-target="#myModal">
                    Register
                </button>
            </div>
        </form>
        <div class="text-center mt-2">
        <footer class="footer">
            <div class="container">
                <div class="copyright align-right">
                    <a href="admin_login_page.php">&copy;
                        <script>
                            document.write(new Date().getFullYear())
                        </script>,</a> Designed and Coded by Chakkrit Tha-aphai, Pongsakorn Pitakkanitkul
                </div>
            </div>
        </footer>
        </div>
        <!--  End Login Form-->
    </div>






    <!-- Start Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">สมัครสมาชิก</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!--  Start Register Form-->
                    <form class="mt-5 myForm" method="post" action="register.php">
                        <div class="text-center">
                            <h2 class="mt-2 font-weight-normal">สมัครสมาชิก</h2>
                        </div>

                        <div class="form-group mt-5">
                            <input type="text" class="form-control" name="username" id="username_register" onkeyup="checkusername();" placeholder="Username" required autofocus>
                            <span id="name_status"></span>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="password" id="password_register" placeholder="Password" required>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="ConfirmPassword" required>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="firstname" id="firstname_register" placeholder="Firstname" required>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="lastname" id="lastname_register" placeholder="Lastname" required>
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" name="email" id="email_register" placeholder="Email Address" required>
                        </div>
                        <button type="submit" name="login" class="mt-2 btn btn-success btn-block" id="btn_regis">Register</button>
                    </form>
                    <!--  End Register Form-->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- End Modal -->
    <!-- Check confirm Password -->
    <script type="text/javascript">
        //Confirm password
        var password = document.getElementById("password_register"),
            confirm_password = document.getElementById("confirm_password");

        function validatePassword() {
            if (password.value != confirm_password.value) {
                confirm_password.setCustomValidity("Passwords Don't Match");
            } else {
                confirm_password.setCustomValidity('');
            }
        }
        password.onchange = validatePassword;
        confirm_password.onkeyup = validatePassword;
    </script>

    <!-- Check Username ซ้ำกัน -->
    <script type="text/javascript">
        function checkusername() {
            var name = document.getElementById("username_register").value;
            console.log(name);
            if (name) {
                $.ajax({
                    type: 'post',
                    url: 'check_username.php',
                    data: {
                        username: name,
                    },
                    success: function(response) {
                        $('#name_status').html(response);
                        if (response == "สามารถใช้ได้") {
                            $("#name_status").css('color', 'green', 'important');
                            $("#btn_regis").attr('disabled', false);
                            return true;
                        } else {
                            $("#name_status").css('color', 'red', 'important');
                            $("#btn_regis").prop('disabled', true);
                            return false;
                        }
                    }
                });
            } else {
                $('#name_status').html("");
                return false;
            }
        }
    </script>


    <!-- jQuery -->
    <script src="src/js/jquery-3.3.1.min.js"></script>

    <!--  Bootstrap JS -->
    <script src="src/js/bootstrap.min.js"></script>



</body>

</html>