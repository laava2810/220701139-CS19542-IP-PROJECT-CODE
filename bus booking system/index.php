<?php
    session_start();
    if(isset($_SESSION['username'])){
        header("Location: index.php");
    }
?>
<?php
    $login = false;
    include('connect.php');
    if (isset($_POST['submit1'])) {
        $username = $_POST['name'];
        $password = $_POST['password'];
        echo $password;
        $sql = "select * from signin where name = '$username'or password = '$password'";  
        $result = mysqli_query($conn, $sql);  
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
        $count = mysqli_num_rows($result);  
        
        if($row){  
            echo $count;

            if(password_verify($password, $row["password"])){
                $login=true;
                session_start();

                $sql = "select name from signin where name = '$username'or password = '$password'";     
                $r = mysqli_fetch_array(mysqli_query($conn, $sql), MYSQLI_ASSOC);  

                $_SESSION['username']= $r['username'];
                $_SESSION['loggedin'] = true;
                header("Location: index.php");
            }
        }  
        else{  
            echo  '<script>
                        
                        alert("Login failed. Invalid username or password!!")
                        window.location.href = "index.php";
                    </script>';
        }     
    }
    ?>
    <?php 
    include("connect.php");


    ?>
    





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BookMyBusTicket - Login</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Additional styles for user account icon */
        .user-account {
            position: absolute; /* Position it in the top right corner */
            top: 20px; /* Distance from the top */
            right: 20px; /* Distance from the right */
            width: 50px; /* Width of the circle */
            height: 50px; /* Height of the circle */
            background-color: #007bff; /* Background color for the icon */
            border-radius: 50%; /* Make it round */
            display: flex; /* Center content */
            align-items: center; /* Center vertically */
            justify-content: center; /* Center horizontally */
            color: white; /* Text color */
            cursor: pointer; /* Pointer cursor on hover */
            font-size: 24px; /* Font size for the initial */
        }

        .user-info {
            display: none; /* Initially hidden */
            position: absolute; /* Position it below the icon */
            top: 80px; /* Distance from the top */
            right: 20px; /* Distance from the right */
            background-color: #fff; /* White background */
            color: #000; /* Text color */
            border: 1px solid #ccc; /* Border for the info box */
            border-radius: 5px; /* Rounded corners */
            padding: 10px; /* Padding inside the box */
            z-index: 10; /* Make sure it appears above other elements */
        }

        /* Style for hiding the info box */
        .user-info.hidden {
            display: none;
        }

        .user-info.visible {
            display: block; /* Show the info box */
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-box">
            <h2>Login</h2>
            <form name="form" action="index.php" method="POST" >
                <div class="input-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="name" placeholder="eg.Johannes" required>
                </div>
                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="eg.Johannes123" required>
                </div>
                <!-- Change the button to an anchor link -->
                <a href="search.html" class="login-btn" name="submit1">Continue</a>
            </form>
            <div class="register-link">
                <a href="register.php">Register Now</a>
            </div>

            <!-- Customer Support Section -->
            <div class="support-section">
                <button id="supportToggle" class="support-btn">Customer Support</button>
                <div id="supportDetails" class="support-details" style="display: none;">
                    <p>Contact us at: <strong>+123-456-7890</strong></p>
                </div>
            </div>
        </div>
    </div>

    

    <script>
        // User data (replace with actual data from registration)
        const userData = {
            name: "John Doe",
            email: "john.doe@example.com"
        };

        // Function to display user information
        document.getElementById("userAccount").onclick = function() {
            const userInfoBox = document.getElementById("userInfo");
            const userName = document.getElementById("userName");
            const userEmail = document.getElementById("userEmail");

            // Fill the user information
            userName.textContent = userData.name;
            userEmail.textContent = userData.email;

            // Toggle visibility
            if (userInfoBox.classList.contains('hidden')) {
                userInfoBox.classList.remove('hidden');
                userInfoBox.classList.add('visible');
            } else {
                userInfoBox.classList.remove('visible');
                userInfoBox.classList.add('hidden');
            }
        };
    </script>
</body>
</html>
