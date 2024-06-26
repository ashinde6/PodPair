
<!DOCTYPE html>
<html lang="en">
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1"> 
        <meta name="author" content="Mohamed Gadelrab, Anushka Shinde">
        <meta name="description" content="Landing page for Climb-able">
        <meta name="keywords" content="athletics, rock climbing, extreme sports, mountains, hiking, outdoors">        

        <meta property="og:title" content="Climb-able: Find your next adventure">
        <meta property="og:type" content="website">
        <meta property="og:url" content="https://cs4640.cs.virginia.edu/mag2sqv/hw2/">
        <meta property="og:image" content="https://i.imgur.com/kIcrJfZ.jpeg">
        <meta property="og:description" content="Share your best climbable formations and discover others around the world!">
        <meta property="og:site_name" content="Climb-able">
        
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" crossorigin="anonymous">

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

        <link rel="stylesheet/less" type="text/css" href="styles/custom.less">
        <script src="https://cdn.jsdelivr.net/npm/less" ></script>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Katibeh&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
        
        <link rel="stylesheet" href="styles/main.css">

        <title>Podpair</title>
    </head>  

    <body>
        <nav class="navbar navbar-expand-lg" aria-label="Main Navigation Bar" style="padding-bottom: 0; background-color: #0D3B66;">
            <div class="container-fluid">
                <form action="?command=showHome" method="post">
                    <button type="submit" style="border: none; background: none; padding: 0;">
                        <p class="navbar-brand align-self-start" style="font-family: 'Katibeh', serif; font-size: 35px; margin-left: 20px;">PodPair</p>
                    </button>
                </form>
                <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsTop"
                    aria-controls="navbarsTop" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="navbar-collapse collapse justify-content-end" id="navbarsTop">
                    <ul class="navbar-nav">
                        <li class="nav-item" style="margin-right: 10px">
                            <form action="?command=showLogin" method="post">
                                <button type="submit" style="border: none; background: none; padding: 0;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="25" fill="currentColor" class="bi bi-box-arrow-in-right" viewBox="0 0 16 16" aria-label="a door with an inviting arrow">
                                        <path fill-rule="evenodd" d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0z"/>
                                        <path fill-rule="evenodd" d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z"/>
                                    </svg>
                                </button>
                            </form>
                        </li>
                        <li class="nav-item" style="margin-right: 10px">
                            <form action="?command=showProfile" method="post">
                                <button type="submit" style="border: none; background: none; padding: 0;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16" aria-label="a figure of a person's upper body">
                                        <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
                                    </svg>
                                </button> 
                            </form>
                        </li>
                    </ul>
                </div>
                
            </div>
        </nav>

        <main>
            <h1 class="d-flex justify-content-center align-items-center" style="margin: 40px; font-family: 'Katibeh', serif; font-size: xxx-large; color: #0D3B66;">Find Your Next Podcast Guest</h1>
            <div class="d-flex justify-content-center align-items-center" style="margin: 40px">
                <div class="input-group rounded" style="width: 50%;">
                    <div class="input-group">
                        <input type="search" class="form-control rounded" placeholder="Search" aria-label="Search">
                        <button type="button" class="btn" data-mdb-ripple-init>
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16" aria-label="a magnifying glass">
                                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                            </svg>
                        </button>
                          <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-filter" viewBox="0 0 16 16" style="margin-top: 4px;">
                            <path d="M6 10.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5m-2-3a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m-2-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5"/>
                          </svg>
                    </div>
                </div>
            </div>

            <div class="container" style="background-color: transparent; border: none;">
                <div class="row row-cols-1 row-cols-md-3 g-4">
                    <?php
                        foreach ($users as $user) {
                            ?>
                            <div class="col">
                                <form action="?command=showProfile" method="post">
                                    <input type="hidden" name="user" value="<?=$user['username']?>">
                                    <button type="submit" style="border: none; background: none; padding: 0;">
                                        <div class="card card-home">
                                            <!-- <img src="<?php echo $user['profile_picture']; ?>" class="card-img-top" alt="User Profile Image"> -->
                                            <div class="card-body">
                                                <h5 class="card-title"><?php echo $user['name']; ?></h5>
                                                <!-- <p class="card-text"><?php echo $user['bio']; ?></p> -->
                                            </div>
                                        </div>
                                    </button>
                                </form>
                            </div>
                            <?php
                        }
                    ?>  
                    <!-- <div class="col">
                        <a href="profile.html">
                        <div class="card card-home">
                            <img src="images/person1.png" class="card-img-top" alt="Card 1 Image">
                            <div class="card-body">
                                <h5 class="card-title">Ava Davis <span class="badge badge-success badge-unpaid">Unpaid</span></h5>
                                <p class="card-text">Some description for Card 1.</p>
                            </div>
                        </div>
                        </a>
                    </div>
        
                    <div class="col">
                        <div class="card">
                            <img src="images/person2.png" class="card-img-top" alt="Card 2 Image">
                            <div class="card-body">
                                <h5 class="card-title">Jayden Johnson <span class="badge badge-success badge-paid">Paid</span></h5>
                                <p class="card-text">Some description for Card 2.</p>
                            </div>
                        </div>
                    </div>
        
                    <div class="col">
                        <div class="card">
                            <img src="images/person3.png" class="card-img-top" alt="Card 3 Image">
                            <div class="card-body">
                                <h5 class="card-title">Ethan Williams <span class="badge badge-success badge-unpaid">Unpaid</span></h5>
                                <p class="card-text">Some description for Card 3.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card">
                            <img src="images/person4.png" class="card-img-top" alt="Card 3 Image">
                            <div class="card-body">
                                <h5 class="card-title">Emily Johnson <span class="badge badge-secondary badge-paid">Paid</span></h5>
                                <p class="card-text">Some description for Card 3.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card">
                            <img src="images/person5.png" class="card-img-top" alt="Card 3 Image">
                            <div class="card-body">
                                <h5 class="card-title">Olivia Martinez <span class="badge badge-secondary badge-paid">Paid</span></h5>
                                <p class="card-text">Some description for Card 3.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card">
                            <img src="images/person6.png" class="card-img-top" alt="Card 3 Image">
                            <div class="card-body">
                                <h5 class="card-title">Liam Anderson <span class="badge badge-secondary badge-unpaid">Unpaid</span></h5>
                                <p class="card-text">Some description for Card 3.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card">
                            <img src="images/person7.png" class="card-img-top" alt="Card 3 Image">
                            <div class="card-body">
                                <h5 class="card-title">Noah Taylor <span class="badge badge-secondary badge-unpaid">Unpaid</span></h5>
                                <p class="card-text">Some description for Card 3.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card">
                            <img src="images/person8.png" class="card-img-top" alt="Card 3 Image">
                            <div class="card-body">
                                <h5 class="card-title">Asmita Patel <span class="badge badge-secondary badge-unpaid">Unpaid</span></h5>
                                <p class="card-text">Some description for Card 3.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card">
                            <img src="images/person9.png" class="card-img-top" alt="Card 3 Image">
                            <div class="card-body">
                                <h5 class="card-title">Mason Mitchell <span class="badge badge-secondary badge-paid">Paid</span></h5>
                                <p class="card-text">Some description for Card 3.</p>
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>
        </main>

        <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top" style="background-color:white; margin-bottom: 0;">
            <p class="col-md-4 mb-0 text-muted" style="margin-left: 30px;">© PodPair</p>
            <ul class="nav col-md-4 justify-content-end align-self-start" style="margin-right: 30px;">
              <li class="nav-item"><a href="signUp.html" class="nav-link px-2 text-muted">Sign-Up</a></li>
              <li class="nav-item"><a href="profile.html" class="nav-link px-2 text-muted">Profile</a></li>
              <li class="nav-item"><a href="contact.html" class="nav-link px-2 text-muted">Contact Us</a></li>
            </ul>
          </footer>
    </body>

</html>
