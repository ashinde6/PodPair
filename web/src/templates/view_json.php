<?php
// Assuming $user is already defined
$userName = isset($user['name']) ? $user['name'] : 'User Name';
$userBio = isset($user['bio']) ? $user['bio'] : 'User Bio';

// Encode $user array into JSON format
$json_user = json_encode($user, JSON_PRETTY_PRINT);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View JSON</title>
    <!-- Bootstrap CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>JSON Representation of User Data</h2>
        <pre><?php echo $json_user; ?></pre>
    </div>
</body>
</html>
