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

<?php if ($_SESSION['passWarning'] === true): ?>
        <div class="alert alert-warning" role="alert">
            Account found, but your password is incorrect
        </div>
        <?php unset($_SESSION['passWarning']); ?>
<?php endif; ?>


<div class="container" style="margin-top: 15px;">
            <div class="row">
                <div class="col-xs-12">
                <h1>Welcome to PodPair!</h1>
                <p>Please login to continue</p>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                <form action="?command=login" method="post">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name">
                    </div>
                    <div class="mb-3">
                        <label for="passwd" class="form-label">Password</label>
                        <input type="password" class="form-control" id="passwd" name="passwd">
                    </div>

                    <button type="submit" class="btn btn-primary">Start</button>
                </form>
                </div>
            </div>
        </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>

