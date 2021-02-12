<?php
// Session
$user = $this->session->userdata('userEmail');

if (!isset($user)) {
    redirect('Project/day8/crud'); // Redirect On Index(Login) Page If User Is Not Login
}

// Get Id From URL 
$id = $this->input->get('id');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php
        echo ($id) ? "Update" : "Insert"; //If $id Is Blank Than Title Is Insert Otherwise Update
        ?>
    </title>

    <!-- Bootstrap/Bootstrap-DatePicker/Bootstrap-Toggle CSS File -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">

    <!-- Css File -->
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="container-fluid col-md-6 mt-5">

        <div class="text-center">
            <h1>
                <?php
                echo ($id) ? "Update" : "Insert"; //If $id Is Blank Than Header Is Insert Otherwise Update
                ?>
            </h1>
        </div>

        <?php
        // Get Session Value If insert/update Error
        $errMessage = $this->session->userdata('errorMsg');
        if ($errMessage) {
            echo "<script>alert('$errMessage');</script>";
            $this->session->unset_userdata('errorMsg');
        }
        ?>

        <!-- Form Start -->
        <form action="" method="post" id="myForm" enctype="multipart/form-data">


            <?php
            if ($id) { // If ID is Available Than Select Record Of These ID

                $tableName = REGISTRATION; //Set Table Name

                // Store Recore Come Form Model fetchRecordById 
                $record = $this->crud_model->fetchRecordById($tableName, $id);

                $updateName = (!isset($record[0]->name) || $record[0]->name == "") ? "N/A" : $record[0]->name;
                $updateContact = (!isset($record[0]->contact) || $record[0]->contact == "") ? "N/A" : explode(":", $record[0]->contact);
                $updateEmail = (!isset($record[0]->email) || $record[0]->email == "") ? "N/A" : $record[0]->email;
                $updatePassword = (!isset($record[0]->password) || $record[0]->password == "") ? "" : $record[0]->password;
                $updateAddress = (!isset($record[0]->address) || $record[0]->address == "") ? "N/A" : $record[0]->address;
                $updateUserType = (!isset($record[0]->user_type) || $record[0]->user_type == "") ? "N/A" : $record[0]->user_type;
                $updateActive = (!isset($record[0]->is_active)) ? "inactive" : $record[0]->is_active;
                $updateHobbies = (!isset($record[0]->hobby) && $record[0]->hobby == "") ? "" : explode(",", $record[0]->hobby);
                $updateDob = (!isset($record[0]->date_of_birth) || $record[0]->date_of_birth == "") ? "N/A" : date('d/m/Y', strtotime($record[0]->date_of_birth));
                $updateProfile = (!isset($record[0]->profile) || $record[0]->profile == "") ? "N/A" : $record[0]->profile;
            }
            ?>


            <div class="row mt-5">
                <div class="col-6">

                    <input type="text" name="id" id="id" value="<?php echo isset($id) ? $id : ""; ?>" hidden>

                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Enter Your Name" value="<?php echo isset($updateName) ? $updateName : ""; ?>">
                    <!-- For Display Error Message -->
                    <span id="errName"></span>

                </div>
                <div class="col-6">
                    <div class="textbox">
                        <label for="mobile" class="form-label">Mobile No.</label>
                        <div class="input-group">
                            <input type="text" name="mno[]" class="form-control" placeholder="Enter Your Mobile Number" maxlength="10" value="<?php echo isset($updateContact) ? $updateContact[0] : ""; ?>">&nbsp;
                            <span class="btn btn-outline-primary btn-sm">+</span>&nbsp;
                        </div>

                        <!-- If Contact Is More Than 1 -->
                        <?php
                        if (isset($updateContact)) {

                            for ($i = 1; $i < count($updateContact); $i++) {
                        ?>
                                <div class="input-group mt-2">
                                    <input type="text" name="mno[]" class="form-control" placeholder="Enter Your Mobile Number" maxlength="10" value="<?= $updateContact[$i]; ?>">&nbsp;
                                    <span class="btn btn-outline-primary btn-sm">+</span>&nbsp;
                                    <span class="btn btn-outline-danger btn-sm">-</span>
                                </div>
                        <?php
                            }
                        }
                        ?>
                        <!-- If Contact Is More Than 1 End -->
                    </div>
                    <span id="errContact"></span>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" name="email" id="email" class="form-control" placeholder="Enter Your Email Id" value="<?php echo isset($updateEmail) ? $updateEmail : ""; ?>">
                    <span id="errEmail"></span>
                </div>
                <div class="col-6">
                    <label for="address" class="form-label">Address</label>
                    <textarea name="address" id="address" cols="10" rows="2" class="form-control" placeholder="Enter Your Address"><?php echo isset($updateAddress) ? $updateAddress : ""; ?></textarea>
                    <span id="errAddress"></span>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <label for="usertype" class="form-label ">User Type</label>
                    <select name="usertype" id="usertype" class="form-control">
                        <option value="">-- Select User Type --</option>
                        <option value="super admin" <?php if (isset($updateUserType)) {
                                                        if ($updateUserType == "super admin") {
                                                            echo "selected";
                                                        }
                                                    } ?>>Super Admin</option>
                        <option value="manager" <?php if (isset($updateUserType)) {
                                                    if ($updateUserType == "manager") {
                                                        echo "selected";
                                                    }
                                                } ?>>Manager</option>
                        <option value="user" <?php if (isset($updateUserType)) {
                                                    if ($updateUserType == "user") {
                                                        echo "selected";
                                                    }
                                                } ?>>User</option>
                        <option value="owner" <?php if (isset($updateUserType)) {
                                                    if ($updateUserType == "owner") {
                                                        echo "selected";
                                                    }
                                                } ?>>Owner</option>
                    </select>
                    <span id="errUserType"></span>
                </div>
                <div class="col-6">
                    <label for="isactive" class="form-check-label">Is Active</label>
                    <div class="">
                        <input type="checkbox" name="isactive" id="isactive" class="form-check-input" data-toggle="toggle" data-on="Active" data-off="Inactive" data-onstyle="primary" hidden <?php if (isset($updateActive)) {
                                                                                                                                                                                                    if ($updateActive == "active") {
                                                                                                                                                                                                        echo "checked";
                                                                                                                                                                                                    }
                                                                                                                                                                                                } else {
                                                                                                                                                                                                    echo "checked";
                                                                                                                                                                                                } ?>>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <label for="hobby" class="form-label">Hobby</label>
                    <div>
                        <input type="checkbox" name="hobby[]" id="reading" value="reading" <?php if (isset($updateHobbies)) {
                                                                                                if (in_array("reading", $updateHobbies)) {
                                                                                                    echo "checked";
                                                                                                }
                                                                                            } ?>>
                        <label for="reading">Reading</label>&nbsp;&nbsp;
                        <input type="checkbox" name="hobby[]" id="playing" value="playing" <?php if (isset($updateHobbies)) {
                                                                                                if (in_array("playing", $updateHobbies)) {
                                                                                                    echo "checked";
                                                                                                }
                                                                                            } ?>>
                        <label for="playing">Playing</label>&nbsp;&nbsp;
                        <input type="checkbox" name="hobby[]" id="travelling" value="travelling" <?php if (isset($updateHobbies)) {
                                                                                                        if (in_array("travelling", $updateHobbies)) {
                                                                                                            echo "checked";
                                                                                                        }
                                                                                                    } ?>>
                        <label for="travelling">Travelling</label><br>
                        <span id="errHobby"></span>
                    </div>
                </div>
                <div class="col-6">
                    <label for="dob" class="form-label">Date Of Birth</label>
                    <input type="text" name="birthdate" id="birthdate" class="form-control datepicker" placeholder="Select Your Birth Date" data-provide="datepicker" value="<?php echo isset($updateDob) ? $updateDob : ""; ?>">
                    <span id="errBirthDate"></span>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <label for="profile" class="form-label">Profile Image</label>
                    <input type="file" name="profile" id="profile">
                    <div><span id="errProfile"></span></div>
                </div>

                <?php
                if ((!$id) || ($user == $updateEmail)) {
                ?>
                    <div class="col-6">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Enter Your Password" value="<?php echo isset($updatePassword) ? $updatePassword : ""; ?>">
                        <span id="errPassword"></span>
                    </div>
                <?php
                } else {
                ?>
                    <div class="col-6">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Enter Your Password" value="<?php echo isset($updatePassword) ? $updatePassword : ""; ?>" readonly>
                        <span id="errPassword"></span>
                    </div>
                <?php
                }
                ?>

            </div>

            <div class="text-right mt-3">
                <input type="submit" class="btn btn-primary btn-lg" value="<?php echo ($id) ? "Update" : "Insert"; ?>" name="<?php echo ($id) ? "update" : "insert"; ?>">
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

            // Date Picker
            $('.datepicker').datepicker({
                format: 'dd/mm/yyyy'
            });

            // Switch Button
            $(function() {
                $('.form-check-input').bootstrapToggle();
            })

            // Add TextBox on Button Click
            $(document).on('click', ".btn-outline-primary", function() {
                $(".textbox").append(
                    '<div class="input-group mt-2"><input type="text" name="mno[]" class="form-control" placeholder="Enter Your Mobile Number" maxlength="10">&nbsp;<span class="btn btn-outline-primary btn-sm">+</span>&nbsp;<span class="btn btn-outline-danger btn-sm">-</span></div>'
                );
            })

            // Remove TextBox on Button Click
            $(document).on('click', ".btn-outline-danger", function() {
                $(this).parent().remove();
            })

            // On Form Submit
            $(document).on('submit', "#myForm", function(event) {
                // event.preventDefault();

                var name = $("#name").val();
                var contact = [];
                var email = $("#email").val();
                var password = $("#password").val();
                var address = $("#address").val();
                var userType = $("#usertype").val();
                var hobby = [];
                var dob = $("#birthdate").val();
                var profile = $("#profile").val();

                var i = 0;
                $("input[name='mno[]']").each(function() { // Fetch Selected Checkbox Value
                    contact += $(this).val();
                    i++;
                })

                $("input[name='hobby[]']:checked").each(function() { // Fetch Selected Checkbox Value
                    hobby += $(this).val() + " ";
                })

                var contactPattern = /^[0-9 ]+$/; // Regular Expression for Contact Number

                var contactLength = contact.length; //Get The Length Of Contact Number

                // Regular Expression For Email
                var emailPattern = /^([a-zA-Z0-9_\.]+)@([a-zA-Z0-9_\.]+)\.([a-zA-Z]{2,5})$/;

                // For Name
                if (name == "") { // Check Name Is Blank Or NOt
                    $("#errName").addClass("text-danger");
                    $("#errName").html("Please Enter Your Name.");
                    event.preventDefault();

                } else {
                    $("#errName").removeClass("text-danger");
                    $("#errName").html("");
                }

                // For Mobile Number
                if (i > 1) { // If Mobile Number Field are More Than 1

                    i *= 10; // i Multyply by 10 to Compare with Contact Number Length
                    var index = i - 10; // Minus 10 From i To Check Next Contact Field

                    if (contact[0] == undefined) { // Check Contact Is Blank Or NOt
                        $("#errContact").addClass("text-danger");
                        $("#errContact").html("Please Enter Your Contact Number.");
                        event.preventDefault();

                    }
                    if (contact[index] == undefined) { // Check Contact Is Blank Or NOt
                        $("#errContact").addClass("text-danger");
                        $("#errContact").html("Please Enter Your Contact Number.");
                        event.preventDefault();

                    } else if (!contactPattern.test(contact)) { // Check Contact Number Is Only Digit Or Not
                        $("#errContact").addClass("text-danger");
                        $("#errContact").html("Please Enter Only Digit In Contact Number.");
                        event.preventDefault();

                    } else if (contactLength != i) { // Check Contact Number Is 10 Digit Or Not
                        $("#errContact").addClass("text-danger");
                        $("#errContact").html("Enter 10 Digit In Contact Number.");
                        event.preventDefault();

                    } else {
                        $("#errContact").removeClass("text-danger");
                        $("#errContact").html("");
                    }

                } else { // If Mobile Number Field is Only 1

                    if (contact == "") { // Check Contact Is Blank Or NOt
                        $("#errContact").addClass("text-danger");
                        $("#errContact").html("Please Enter Your Contact Number.");
                        event.preventDefault();

                    } else if (!contactPattern.test(contact)) { // Check Contact Number Is Only Digit Or Not
                        $("#errContact").addClass("text-danger");
                        $("#errContact").html("Please Enter Only Digit In Contact Number.");
                        event.preventDefault();

                    } else if (contactLength != 10) { // Check Contact Number Is 10 Digit Or Not
                        $("#errContact").addClass("text-danger");
                        $("#errContact").html("Enter 10 Digit In Contact Number.");
                        event.preventDefault();

                    } else {
                        $("#errContact").removeClass("text-danger");
                        $("#errContact").html("");
                    }
                }

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
                if (password == "") { // Check Password Is Blank Or NOt
                    $("#errPassword").addClass("text-danger");
                    $("#errPassword").html("Please Enter Your Password.");
                    event.preventDefault();

                } else {
                    $("#errPassword").removeClass("text-danger");
                    $("#errPassword").html("");
                }

                // For Address
                if (address == "") { // Check Address Is Blank Or NOt
                    $("#errAddress").addClass("text-danger");
                    $("#errAddress").html("Please Enter Your Address.");
                    event.preventDefault();

                } else {
                    $("#errAddress").removeClass("text-danger");
                    $("#errAddress").html("");
                }

                // For User Type
                if (userType == "") { // Check UserType Is Blank Or NOt
                    $("#errUserType").addClass("text-danger");
                    $("#errUserType").html("Please Select User Type.");
                    event.preventDefault();

                } else {
                    $("#errUserType").removeClass("text-danger");
                    $("#errUserType").html("");
                }

                // For Hobby
                if (hobby == "") { // Check Hobby Is Blank Or NOt
                    $("#errHobby").addClass("text-danger");
                    $("#errHobby").html("Please Select at Least One Hobby.");
                    event.preventDefault();

                } else {
                    $("#errHobby").removeClass("text-danger");
                    $("#errHobby").html("");
                }

                // For Date of Birth
                if (dob == "") { // Check Date-of-Birth IS Blank Or NOt
                    $("#errBirthDate").addClass("text-danger");
                    $("#errBirthDate").html("Please Select Your BithDate.");
                    event.preventDefault();

                } else {
                    $("#errBirthDate").removeClass("text-danger");
                    $("#errBirthDate").html("");
                }

                // For Profile Image
                if (profile == "") { // Check Iamge Selected Or NOt
                    $("#errProfile").addClass("text-danger");
                    $("#errProfile").html("Please Select Your Profile Image.");
                    event.preventDefault();

                } else {
                    $("#errProfile").removeClass("text-danger");
                    $("#errProfile").html("");
                }
            })
        })
    </script>
</body>

</html>