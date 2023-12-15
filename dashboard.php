<?php
session_start();

// Check if the user clicked the logout button
if (isset($_POST['logout'])) {
    // Unset all session variables
    $_SESSION = array();

    // Destroy the session
    session_destroy();

    // Redirect to the login page
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
</head>
<body>

<h1>Welcome to Your Dashboard</h1>

<?php
// Check if the user is logged in (you may want to add more robust authentication)
if (isset($_SESSION['email']) && isset($_SESSION['picture'])) {
    $email = $_SESSION['email'];
    $picture = $_SESSION['picture'];

    // Display user information
    echo "<p>Email: $email</p>";
    echo "<img src='$picture' alt='User Picture' style='width: 100px; height: 100px;'>";

    // Add logout button
    echo "<form action='' method='post'>";
    echo "<input type='submit' name='logout' value='Logout'>";
    echo "</form>";
} 
?>

<!-- Add other content or links for the dashboard -->

</body>
</html>
