



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Regitastion</title>
    <link rel="stylesheet" href="style.css" type="text/css">
   
</head>
<body>  
    <div class="main">
        <div>
        <div class="register">
            <h2>Register Here</h2>
            <form id="register" action="login.html" method="post">
                <label>First Name :</label>
                <br>
                <input type="text" name="fname" id="name" placeholder="Enter Your First Name" required>
                <br><br>
                <label>Last Name :</label>
                <br>
                <input type="text" name="lname" id="name" placeholder="Enter Your Last Name" required>
                <br><br>
                
                <label>Email :</label>
                <br>
                <input type="email" name="Email" id="name" placeholder="Enter your valid email" required>
                <br><br>
                <label>Password :</label>
                <br>
                <input type="text" id="name" placeholder="Password" required>
                &nbsp;&nbsp;&nbsp;&nbsp;
                <br><br>
                <label>Mobile No. :</label>
                <br>
               <input type="text" id="name" name="contry code"  placeholder="Enter your 10 digit No" pattern="[0-9]{10}" required>
                &nbsp;&nbsp;&nbsp;&nbsp;
                <br><br>
                <label>Gender :</label>
                <br>
                &nbsp;&nbsp;&nbsp;
                <input type="radio" name="Gender" id="male">
                &nbsp;
                <span id="male">Male</span>
                &nbsp;&nbsp;&nbsp;&nbsp;
                <input type="radio" name="Gender" id="female">
                &nbsp;
                <span id="female">Female</span>
                <br><br>
                <div class="form-check d-flex justify-content-center mb-5">
                    <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3cg" required />
                    <label class="form-check-label" for="form2Example3g">
                      I agree all statements in <a href="#" class="text-body"><u>Terms of service</u></a>
                    </label>
                  </div>
                <br>
                &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;<input type="submit" value="Register"
                name="submit" id="submit" onclick="showAlert()">
                
                <script>
                    function showAlert() {
                      var myText = "Register Sucessfully";
                      alert (myText);
                    }
                    </script>


            </form>
            </div>
        </div><!--end register-->
    </div><!--end main-->
    
</body>
</html>
<?php
require_once "config.php";

$email = $_password="";
$email_err = $_password_err="";
if ($_SERVER['REQUEST_METHOD'] == "POST"){

    if(empty(trim($_POST["email"]))){
        $email_err = "Email cannot be blank";

    }
    else{
        $sql ="SELECT id from users where email= ?";
        $stmt = mysqli_prepare($conn, $sql);
        if($stmt)
        {
            mysqli_stmt_bind_param($stmt,"s",$param_email);
            $param_email = trim($_POST['email']);
           
            if(mysqli_stmt_execute($stmt))
            {
                mysqli_stmt_store_result($stmt);
                if(mysqli_stmt_num_rows($stmt)==1)
                {
                    $email_err = "This email already taken";
                }
                else
                {
                    $email = trim($_POST['email']);
                }

            }
            else{
                echo "Something went Wrong";
            }

        }
    }

    mysqli_stmt_close($stmt);

   if(empty((trim($_POST['password']))))
   {
     $password_err = "Password Cannot be blank";
   }
   else
   {
    $password = trim($_POST['password']);
   }

   if(empty($email_err) && empty($password_err))
   {
       $sql ="insert into users (email, password) values (?, ? )";
       $stmt = mysqli_prepare($conn, $sql);
       if($stmt)
       {
            mysqli_stmt_bind_param($stmt, "ss", $param_email, $param_password);

            $param_email = $email;
            $param_password = $password;

            if(mysqli_stmt_execute($stmt))
            {
                header("location: login.php");
            }
            else{
                echo "Something went wrong... ";
            }


        }
       mysqli_stmt_close($stmt);
       
    }
    mysqli_close($conn);
}
?>