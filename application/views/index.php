<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        Login
    </title>

    <!-- Bootstrap/Bootstrap-DatePicker/Bootstrap-Toggle CSS File -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">

    <!-- Css File -->
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="container-fluid col-md-4 mt-5">

        <div class="text-center">
            <h1>
                Login
            </h1>
        </div>

        <?php
        // Get Session Value If Login Error
        $errMessage = $this->session->userdata('errorMsg');
        if ($errMessage) {
            echo "<script>alert('$errMessage');</script>";
            $this->session->unset_userdata('errorMsg');
        }
        ?>

        <!-- Form Start -->
        <form method="post" id="myForm">

            <div class="text-danger"><?= isset($errMsg) ? $errMsg : "" ?></div>

            <div class="row">
                <label for="email" class="form-label">Email</label>
                <input type="text" name="email" id="email" class="form-control" placeholder="Enter Your Email">
                <!-- For Display Error Message -->
                <span id="errEmail"></span>
            </div>

            <div class="row">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Enter Your Password">
                <!-- For Display Error Message -->
                <span id="errPassword"></span>
            </div>

            <div class="text-right mt-5">
                <input type="submit" class="btn btn-primary btn-lg" value="Login" name="login">
            </div>
        </form>
        <!-- Form End -->
    </div>

    <!-- JQuery/Bootstrap/Bootstrap-DatePicker/Bootstrap4-Toggle JS File -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>

    <script>
        $(document).ready(function() {

            // On Form Submit
            $(document).on('submit', "#myForm", function(event) {

                var email = $("#email").val();
                var password = $("#password").val();

                // Regular Expression For Email
                var emailPattern = /^([a-zA-Z0-9_\.]+)@([a-zA-Z0-9_\.]+)\.([a-zA-Z]{2,5})$/;

                // For Email
                if (email == "") { // Check Email Is Blank Or NOt
                    $("#errEmail").addClass("text-danger");
                    $("#errEmail").html("Please Enter Your Email.");
                    event.preventDefault();

                } else if (!emailPattern.test(email)) { // Check Email Is Valid Or NOt
                    $("#errEmail").addClass("text-danger");
                    $("#errEmail").html("Please Enter Valid Email Id.");
                    event.preventDefault();

                } else {
                    $("#errEmail").removeClass("text-danger");
                    $("#errEmail").html("");
                }

                // For Password
                if (password == "") { // Check Name Is Blank Or NOt
                    $("#errPassword").addClass("text-danger");
                    $("#errPassword").html("Please Enter Your Password.");
                    event.preventDefault();

                } else {
                    $("#errPassword").removeClass("text-danger");
                    $("#errPassword").html("");
                }
            })
        })
    </script>
</body>

</html>