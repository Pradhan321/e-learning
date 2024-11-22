<?php
include 'db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validate email and password
    $query = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $query->bind_param('s', $email);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        if (password_verify($password, $row['password'])) {
            // Delete user
            $deleteQuery = $conn->prepare("DELETE FROM users WHERE email = ?");
            $deleteQuery->bind_param('s', $email);
            $deleteQuery->execute();

            // Log out the user
            session_destroy();
            header("Location: index.php");
        } else {
            echo "Incorrect password.";
        }
    } else {
        echo "User not found.";
    }
}
?>
