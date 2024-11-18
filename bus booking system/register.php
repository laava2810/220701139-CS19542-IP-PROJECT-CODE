<?php
    session_start();
    if(isset($_SESSION['username'])){
        header("Location: register.php");
    }
?>
<?php
    include("connect.php");
    if(isset($_POST['submit'])){
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $cpassword = mysqli_real_escape_string($conn, $_POST['cpassword']);
        
        $sql="select * from signin where name='$name'";
        $result = mysqli_query($conn, $sql);
        $count_user = mysqli_num_rows($result);

        $sql="select * from signin where email='$email'";
        $result = mysqli_query($conn, $sql);
        $count_email = mysqli_num_rows($result);

        if($count_user == 0 & $count_email==0){
            if($password==$cpassword){
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $sql = "INSERT INTO signin(name, email, password) VALUES('$name', '$email', '$hash')";
                $result = mysqli_query($conn, $sql);
                if($result){
                    header("Location: index.php");
                }
            }
            else{
                echo '<script>
                    alert("Passwords do not match");
                    window.location.href = "signup.php";
                </script>';
            }
        }
        else{
            if($count_user>0){
                echo '<script>
                    window.location.href="index.php";
                    alert("Username already exists!!");
                </script>';
            }
            if($count_email>0){
                echo '<script>
                    window.location.href="index.php";
                    alert("Email already exists!!");
                </script>';
            }
        }
        
    }
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account</title>
    <link rel="stylesheet" href="regstyle.css">
</head>
<body>

    <div class="signup-container">
        <div class="form-box">
            <h1>CREATE ACCOUNT</h1>
            <form name="form" action="register.php" method="POST">
                <!-- Name Input -->
                <input type="text" id="name" name="name" placeholder="John Doe" required>
                
                <!-- Email Input -->
                <input type="email" id="email" name="email" placeholder="Your Email" required>

                <!-- Password Input -->
                <input type="password" id="password" name="password" placeholder="Password" required>

                <!-- Confirm Password Input -->
                <input type="password" id="confirm-password" name="cpassword" placeholder="Repeat your password" required>

                <!-- Terms Checkbox -->
                <div class="terms">
                    <input type="checkbox" id="terms" name="terms" required>
                    <label for="terms">I agree to all statements in <a href="#">Terms of service</a></label>
                </div>

                <!-- Sign Up Button -->
                <button type="submit" class="signup-btn" name="submit">SIGN UP</button>
            </form>
            
            <p>Have already an account? <a href="index.php">Login here</a></p>
        </div>
    </div>

</body>
</html>
