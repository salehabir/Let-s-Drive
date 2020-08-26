<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <meta charset="UTF-8">
    <title>Let's Drive | Admin Log In</title>

    <link rel="stylesheet" href="LogSign.css">
    <link rel="icon" href="car_logo.ico">
</head>

<body style="background-image: url('LogIn.jpg');">

<?php

	$con=mysqli_connect("localhost", "root", "", "letsdrive");
 
	session_start();
	if(isset($_POST['LogIn']))
    {
       if(empty($_POST['uname']) || empty($_POST['pass']))
       {
            header("location:AdminLogIn.php?Empty= Please Fill in the Blanks");
       }
       else
       {
		    $pass=$_POST['pass'];
			$pas=md5($pass);
            $query="select * from admin where UserName='".$_POST['uname']."' and Pass='$pas'";
            $result=mysqli_query($con,$query);
 
            if(mysqli_fetch_assoc($result))
            {
                $_SESSION['User']=$_POST['uname'];
                header("location:CarsAdmin.php");
            }
            else
            {
                header("location:AdminLogIn.php?Invalid= Please Enter Correct User Name and Password");
            }
       }
    }
    else
    {
        //echo 'Not Working';
    }
?>

    <div class="content">
	<form action="AdminLogIn.php" method="POST">
        <div class="form-area">
            <div class="img-area">
                <img src="carlogo.png" alt="" >
            </div>
            <h2 style="padding-bottom:-20px;">Admin Login Form</h2>
					<?php 
                        if(@$_GET['Empty']==true)
                        {
                    ?>
                        <p  style="color:red;text-align:center;margin-top:-25px;"><?php echo $_GET['Empty'] ?></p>                               
                    <?php
                        }
                    ?>
 
 
                    <?php 
                        if(@$_GET['Invalid']==true)
                        {
                    ?>
                        <p style="color:red;text-align:center;margin-top:-25px;"><?php echo $_GET['Invalid'] ?></p>                               
                    <?php
                        }
                    ?>
           
            <p style="margin-top:0px;">User Name:</p>
            <input type="text"  name="uname">
            <br/>
            <br/>
            <p>Password:</p>
            <input type="password"  name="pass">
			<button class="btn" type="submit" name="LogIn">Log In</button>
        </div>
	</form>
    </div>
</body>
</html>

