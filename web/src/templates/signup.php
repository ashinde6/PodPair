<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
<head>
  <meta charset="UTF-8">  
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="CS4640 Spring 2024">
  <meta name="description" content="Our Front-Controller PodPair">  
  <title>Podpair Sign Up</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"  integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"  crossorigin="anonymous">       
</head>

<body>
<div class="container mt-5">

    <?php if (isset($_SESSION['errorMessage'])): ?>
            <div class="alert alert-danger" role="alert">
                <?= htmlspecialchars($_SESSION['errorMessage'][0]); ?>
            </div>
        <?php unset($_SESSION['errorMessage']); ?>
    <?php endif; ?>

    <div class="alert alert-danger" id="usernameError" style="display:none;">
        <strong>Error:</strong> Username must be longer than 3 characters
        <button type="button" class="close">&times;</button>
    </div>
    <div class="alert alert-danger" id="passwordError" style="display:none;">
        <strong>Error:</strong> Password must be longer than 5 characters and contain a symbol and a number
        <button type="button" class="close">&times;</button>
    </div>
    <div class="alert alert-danger" id="emailError" style="display:none;">
        <strong>Error:</strong> Email is not formatted correctly
        <button type="button" class="close">&times;</button>
    </div>
    <div class="alert alert-danger" id="roleError" style="display:none;">
        <strong>Error:</strong> Please select a role
        <button type="button" class="close">&times;</button>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <h1 class="mb-3 text-center">Sign Up to PodPair</h1>
            <p class="text-center">Welcome to PodPair, where small podcasters find interesting people to interview.</p>

            <form action="?command=signup" method="post" class="card p-4 shadow">
                <div class="form-group mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                <div class="form-group mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" class="form-control" id="email" name="email" required>
                </div>
                <div class="form-group mb-4">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>

                <fieldset class="mb-4">
                    <legend class="col-form-label">I am a...</legend>
                    <div class="d-flex align-items-center">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="role" id="podcastHost" value="podcast host" checked>
                            <label class="form-check-label" for="podcastHost">Podcast host</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="role" id="openGuest" value="open guest">
                            <label class="form-check-label" for="openGuest">Open guest</label>
                        </div>
                    </div>
                </fieldset>

                <button type="button" id="registerButton" class="btn btn-primary">Register</button>
            </form>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="signupValidation.js"></script>
</body>
</html>
