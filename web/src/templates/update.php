<?php
// Ensure session is already started in the initial part of your application
$userData = json_decode($_SESSION['updateData'], true); // Decode the JSON back to an array
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Profile</title>
</head>
<body>
    <form action="?command=performUpdate" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" placeholder="<?php echo htmlspecialchars($userData['username']); ?>">
        <br>
        <label for="bio">Bio:</label>
        <textarea id="bio" name="bio"><?php echo htmlspecialchars($userData['bio']); ?></textarea>
        <br>
        <button type="submit" class="btn btn-success">Update</button>
    </form>
</body>
</html>
