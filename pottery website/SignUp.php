<?php

require 'db.php'; 
 include'header.php'; 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    // Hash the password using bcrypt
    $password_hash = password_hash($password, PASSWORD_BCRYPT);

    // Insert the new user into the database
    $query = "INSERT INTO users (username, email, password_hash) VALUES ('$username', '$email', '$password_hash')";

    if (mysqli_query($conn, $query)) {

    	 header("Location: login.php");
  exit();
        
    } else {
        if (mysqli_errno($conn) == 1062) { 
            echo "Username or email already exists. Please try another.";
        } else {
            echo "Error during registration: " . mysqli_error($conn);
        }
    }
}
?>
<title>Register</title>
    <style>
       
        .form-container {
            display: flex;
            justify-content: center; 
            align-items: center; 
            height: 100vh; 
            background-color: #f0f0f0; 
        }

    
        label {
            display: block; 
            font-weight: bold; 
            margin-bottom: 10px; 
            color: black;
        }

        input {
            width: 100%; 
            padding: 10px; 
            border: 1px solid #ccc; 
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); 
            margin-bottom: 20px; 
        }

        button {
          
            padding: 10px; 
            background-color: #4CAF50; 
            color: white; 
            border: none; 
            border-radius: 5px; 
            cursor: pointer; 
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
    <div id="templatemo_content">
 <div class="form-container"> 
        <div class="form"> 
            <h2>Register</h2> 
            <form action="SignUp.php" method="POST"> 
                <label for="username">Username:</label>
                <input type="text" name="username" required>

                <label for="email">Email:</label>
                <input type="email" name="email" required>

                <label for="password">Password:</label>
                <input type="password" name="password" required>

                <button type="submit">Register</button> 
            </form>
        </div>
    </div>
       </div>




 <?php include'footer.php'; ?>