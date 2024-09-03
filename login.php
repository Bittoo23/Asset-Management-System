ob_start();
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

    // Fetch user from database
    $stmt = $conn->prepare("SELECT id, password_hash FROM users WHERE username = ?");
    if (!$stmt) {
        die("SQL Error: " . $conn->error);
    }

    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $password_hash);
        $stmt->fetch();

        // Verify password
        if (password_verify($password, $password_hash)) {
            $_SESSION['user_id'] = $id;
            
            // Debugging line to check if session is set and code reaches here
            echo "Login successful! Redirecting...";
            // die(); // Temporarily stop execution here to check if login succeeds
            header("Location:land.php");
            exit();
        } else {
            echo "Invalid credentials";
        }
    } else {
        echo "No user found";
    }

    $stmt->close();
    $conn->close();
}

?>


ob_end_flush();