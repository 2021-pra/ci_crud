<?php

$user = $this->session->userdata('userEmail');
$msgSuccess = $this->session->userdata('successMsg');
$msgError = $this->session->userdata('errorMsg');

if (isset($user)) { // If UserData Session Is Set
    if (isset($msgSuccess)) { // If Success Message Session IS Set
        echo "<script>alert('$msgSuccess');</script>";
        $this->session->unset_userdata('successMsg');
    }

    if ($msgError) { // If Error Message Session IS Set
        echo "<script>alert('$msgError');</script>";
        $this->session->unset_userdata('errorMsg');
    }
} else {
    redirect('Project/day8/crud'); // Redirect On Index(Login) Page If User Is Not Login
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View</title>

    <!-- Bootstrap/Bootstrap-DatePicker CSS File -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">

    <!-- Css File -->
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="container-fluid mt-5">

        <div class="text-center">
            <h1> View </h1>
        </div>

        <form method="post">
            <div class="row mb-3">
                <div class="col-6">
                    <input type="submit" name="logout" class="btn btn-primary" value="LogOut">
                </div>
                <div class="col-6 text-right">
                    <input type="submit" name="addData" class="btn btn-primary" value="Add Data">
                </div>
            </div>
        </form>

        <table class="table table-bordered table-striped table-hover">
            <tr>
                <th>Name</th>
                <th>Contact</th>
                <th>Email</th>
                <th>Address</th>
                <th>User Type</th>
                <th>Is Active</th>
                <th>Hobby</th>
                <th>Date Of Birth</th>
                <th>Profile</th>
                <th>Operation</th>
            </tr>

            <?php
            foreach ($data as $row) {

                $id = (!isset($row->id) || $row->id == "") ? "N/A" : $row->id;
                $name = (!isset($row->name) || $row->name == "") ? "N/A" : $row->name;
                $contact = (!isset($row->contact) || $row->contact == "") ? "N/A" : $row->contact;
                $email = (!isset($row->email) || $row->email == "") ? "N/A" : $row->email;
                $address = (!isset($row->address) || $row->address == "") ? "N/A" : $row->address;
                $userType = (!isset($row->user_type) || $row->user_type == "") ? "N/A" : $row->user_type;
                $active = (!isset($row->is_active) || $row->is_active == "") ? "N/A" : $row->is_active;
                $hobby = (!isset($row->hobby) || $row->hobby == "") ? "N/A" : $row->hobby;
                $dob = (!isset($row->date_of_birth) || $row->date_of_birth == "") ? "N/A" : date('d/m/Y', strtotime($row->date_of_birth));
                $profile = (!isset($row->profile) || $row->profile == "") ? "N/A" : $row->profile;
            ?>
                <tr>


                    <td><?= $name; ?></td>
                    <td><?= $contact; ?></td>
                    <td><?= $email; ?></td>
                    <td><?= $address; ?></td>
                    <td><?= $userType; ?></td>
                    <td><?= $active; ?></td>
                    <td><?= $hobby; ?></td>
                    <td><?= $dob; ?></td>
                    <td><?= $profile; ?></td>
                    <td>
                        <a href="insert?id=<?= $id; ?>" class="text-info text-decoration-none">Edit</a>&nbsp;&nbsp;
                        <a href="delete?id=<?= $id; ?>" class="text-danger text-decoration-none" onClick="return confirm('Are you sure to remove this record ?')">Delete</a>
                    </td>

                </tr>
            <?php
            }
            ?>
            </tr>
        </table>

    </div>



    <!-- JQuery/Bootstrap/Bootstrap-DatePicker JS File -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
</body>

</html>