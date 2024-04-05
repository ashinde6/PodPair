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

<?php if ($msg != ""): ?>
        <div class="alert alert-danger" role="alert">
            <?= htmlspecialchars($msg); ?>
        </div>
<?php endif; ?>

<div class="container" style="margin-top: 15px;">
            <div class="row">
                <div class="col-xs-12">
                <h1>Welcome to PodPair!</h1>
                <p>Please input your email to sign up</p>
                </div>
            </div>
            
            <div class="row">
                <div class="col-xs-12">
                <form action="?command=signUp" method="post">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
                        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                    </div>
                    <!-- Hidden inputs for name and password -->
                    <input type="hidden" name="name" value="<?php echo htmlspecialchars($name); ?>">
                    <input type="hidden" name="passwd" value="<?php echo htmlspecialchars($password); ?>">
                    <button type="submit" class="btn btn-primary">Start</button>
                </form>
                </div>
            </div>
        </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>