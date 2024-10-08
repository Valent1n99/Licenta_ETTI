<?php
require('/Applications/XAMPP/xamppfiles/htdocs/Licenta/admin/inc/db_config.php');
require('/Applications/XAMPP/xamppfiles/htdocs/Licenta/admin/inc/essentials.php');
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login Panel</title>
    <!-- Include fișierele CSS și JavaScript -->
    <?php require('inc/links.php'); ?>
    <style>
        div.login-form {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 400px;
        }
        
    </style>
</head>

<body class="bg-light">

    <div class="login-form text-center rounded bg-white shadow overflow-hidden">
        <form method="POST">
            <h4 class="bg-dark text-white py-3">ADMIN LOGIN PANEL</h4>
            <div class="p-4">
                <div class="mb-3">
                    <input name="admin_name" required type="text" class="form-control shadow-none"
                        placeholder="Admin Name">
                </div>
                <div class="mb-4">
                    <input name="admin_pass" required type="password" class="form-control shadow-none"
                        placeholder="Password">
                </div>
                <button name="login" type="submit" class="btn text-white custom-bg shadow-none">LOGIN</button>
            </div>
        </form>
    </div>













    
    <?php
    if (isset($_POST['login'])) {
        $frm_data = filteration($_POST);
        
        // Afisează numele și parola admin filtrate
        #echo "<h1>{$frm_data['admin_name']}</h1>";
        #echo "<h1>{$frm_data['admin_pass']}</h1>";
        
        // Aici poți adăuga codul pentru interogarea SQL
         $query = "SELECT * FROM `admin_crew` WHERE `admin_name`=? AND `admin_pass`=?";
        $values = [$frm_data['admin_name'], $frm_data['admin_pass']];
        $res = select($query, $values, "ss");
        if($res->num_rows==1){
            $row=mysqli_fetch_assoc($res);
            session_start();
            $_SESSION['adminLogin']=true;
            $_SESSION['adminId']=$row['sr_no'];
            redirect('dashboard.php');

        }
        else{
            alert('error', 'Login failed - Invalid Credentials!');
       
           }
       
    }
    ?>

    <!-- Include fișierele JavaScript -->
    <?php require('inc/scripts.php') ?>
</body>

</html>




 

