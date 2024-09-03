<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection settings
    $servername = "localhost"; 
    $username = "root"; 
    $password = ""; 
    $dbname = "assets"; 

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if username already exists
    $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        echo "Username already exists";
    } else {
        // Hash the password
        $password_hash = password_hash($password, PASSWORD_BCRYPT);

        // Insert user into database (using correct column names)
        $stmt = $conn->prepare("INSERT INTO users (username, password_hash,password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $password_hash,$password);

        if ($stmt->execute()) {
            echo "Sign-up successful!";
            header("Location: login.html");
            exit(); // Prevent further script execution after redirect
        } else {
            echo "Error: " . $stmt->error;
        }
    }

    $stmt->close();
    $conn->close();
}

// For debugging purposes only
echo "Plaintext Password: " . $password . "<br>";
echo "Password Hash: " . $password_hash . "<br>";

?>
