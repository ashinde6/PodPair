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

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        echo "<script>document.addEventListener('DOMContentLoaded', function() { showButton(); });</script>";
    }
    ?>

    <body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h1 class="mb-3 text-center">Welcome to PodPair!</h1>
                <p class="text-center">Please login to continue</p>

                <form action="?command=login" method="post" class="card p-4 shadow mb-2">
                    <div class="form-group mb-3">
                        <label for="username" class="form-label">Name</label>
                        <input type="text" class="form-control" id="username" name="username">
                    </div>
                    <div class="form-group mb-4">
                        <label for="passwd" class="form-label">Password</label>
                        <input type="password" class="form-control" id="passwd" name="passwd">
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Start</button>
                </form>

                <form action="?command=signup" method="post" class="text-center">
                    <button type="submit" class="btn btn-success" id="hiddenButton" style="display: none;">Sign up instead?</button>
                </form>
            </div>
        </div>
    </div>
        
    <script>
        function showButton() {
            document.getElementById('hiddenButton').style.display = 'block';
        }
    </script>

</body>
</html>
