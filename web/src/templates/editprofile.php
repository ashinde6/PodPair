<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
</head>
<body>
    <h2>Edit Profile</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name"><br>

        <label for="bio">Bio:</label><br>
        <textarea id="bio" name="bio"></textarea><br>

        <label for="user_type">User Type:</label><br>
        <select id="user_type" name="user_type">
            <option value="guest">Guest</option>
            <option value="podcast">Podcast</option>
        </select><br>

        <button type="submit">Submit</button>
    </form>
</body>
</html>