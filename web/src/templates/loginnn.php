<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
<head>
  <meta charset="UTF-8">  
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="CS4640 Spring 2024">
  <meta name="description" content="Our Front-Controller PodPair">  
  <title>Podpair</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"  integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"  crossorigin="anonymous">       
</head>

<body>

<?php if (!empty($_SESSION['errorMessages'])): ?>
    <?php foreach ($_SESSION['errorMessages'] as $message): ?>
        <div class="alert alert-danger" role="alert">
            <?= htmlspecialchars($message); ?>
        </div>
    <?php endforeach; ?>
    <?php unset($_SESSION['errorMessages']); ?>
<?php endif; ?>

<div class="container" style="margin-top: 15px;">
            <div class="row">
                <div class="col-xs-12">
                <h1>Welcome to PodPair!</h1>
                <p>Please login to continue</p>
                </div>
            </div>

            <form action="?command=login" method="post">
                <div class="form-group">
                    <label for="username" class="form-label">Name</label>
                    <input type="text" class="form-control" id="username" name="username">
                </div>
                <div class="form-group">
                    <label for="passwd" class="form-label">Password</label>
                    <input type="password" class="form-control" id="passwd" name="passwd">
                </div>
                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email">
                </div>
                <div class="form-group">
                    <label for="bio" class="form-label">Update Bio (optional)</label>
                    <input type="text" class="form-control" id="bio" name="bio">
                </div>

                <button type="submit" class="btn btn-primary">Start</button>
            </form>

        </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
