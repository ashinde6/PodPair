<!-- Bootstrap Elements:
    - Navbar
    - Modal
    - Card
    - Carousal
    - Accordian
-->

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

        <meta property="og:title" content="PodPair">
        <meta property="og:type" content="website">
        <meta property="og:url" content="https://cs4640.cs.virginia.edu/mag2sqv/hw2/">
        <meta property="og:image" content="https://i.imgur.com/kIcrJfZ.jpeg">
        <meta property="og:description" content="Share your best climbable formations and discover others around the world!">
        <meta property="og:site_name" content="PodPair">
        
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" crossorigin="anonymous">

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

        <!-- <script src="https://cdn.jsdelivr.net/npm/less@3.15.0/dist/less.min.js"></script>
        <link rel="stylesheet/less" type="text/css" href="styles/custom.less" /> -->

        <!-- <link rel="stylesheet/less" type="text/css" href="styles/custom.less"> -->
        <script src="https://cdn.jsdelivr.net/npm/less" ></script>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Katibeh&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
        
        <!-- <link rel="stylesheet" href="styles/main.css"> -->

        <title>Profile</title>
    </head>  

    <body>
        <nav class="navbar navbar-expand-lg" aria-label="Main Navigation Bar" style="padding-bottom: 0; background-color: #0D3B66;">
            <div class="container-fluid">
                <a class="navbar-brand align-self-start" href="index.html" style="font-family: 'Katibeh', serif; font-size: 35px; margin-left: 20px;">PodPair</a>
                <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsTop"
                    aria-controls="navbarsTop" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="navbar-collapse collapse justify-content-end" id="navbarsTop">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="signUp.html">
                                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="25" fill="currentColor" class="bi bi-box-arrow-in-right" viewBox="0 0 16 16" aria-label="a door with an inviting arrow">
                                    <path fill-rule="evenodd" d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0z"/>
                                    <path fill-rule="evenodd" d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z"/>
                                  </svg>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="profile.html">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16" aria-label="a figure of a person's upper body">
                                    <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
                                </svg>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="contact.html">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-envelope-at-fill" viewBox="0 0 16 16" aria-label="a mailing box">
                                    <path d="M2 2A2 2 0 0 0 .05 3.555L8 8.414l7.95-4.859A2 2 0 0 0 14 2zm-2 9.8V4.698l5.803 3.546zm6.761-2.97-6.57 4.026A2 2 0 0 0 2 14h6.256A4.5 4.5 0 0 1 8 12.5a4.49 4.49 0 0 1 1.606-3.446l-.367-.225L8 9.586zM16 9.671V4.697l-5.803 3.546.338.208A4.5 4.5 0 0 1 12.5 8c1.414 0 2.675.652 3.5 1.671"/>
                                    <path d="M15.834 12.244c0 1.168-.577 2.025-1.587 2.025-.503 0-1.002-.228-1.12-.648h-.043c-.118.416-.543.643-1.015.643-.77 0-1.259-.542-1.259-1.434v-.529c0-.844.481-1.4 1.26-1.4.585 0 .87.333.953.63h.03v-.568h.905v2.19c0 .272.18.42.411.42.315 0 .639-.415.639-1.39v-.118c0-1.277-.95-2.326-2.484-2.326h-.04c-1.582 0-2.64 1.067-2.64 2.724v.157c0 1.867 1.237 2.654 2.57 2.654h.045c.507 0 .935-.07 1.18-.18v.731c-.219.1-.643.175-1.237.175h-.044C10.438 16 9 14.82 9 12.646v-.214C9 10.36 10.421 9 12.485 9h.035c2.12 0 3.314 1.43 3.314 3.034zm-4.04.21v.227c0 .586.227.8.581.8.31 0 .564-.17.564-.743v-.367c0-.516-.275-.708-.572-.708-.346 0-.573.245-.573.791"/>
                                  </svg>
                            </a>
                        </li>

                    </ul>
                </div>
                
            </div>
        </nav>

        <main>

            <div class="container">
                <div class="row">
                    <div class="column" style="max-width: 300px;">
                        <img src="images/person1.png" alt="User Profile" class="profile-picture">
                    </div>
                    <div class="column">
                        <h3 style="font-family: 'Katibeh', serif; font-size: 40px;"></h3>
                        <div class="badges">
                            <span class="badge-info">Health</span>
                            <span class="badge-info">Healthy Eating</span>
                            <span class="badge-info">Exercise</span>
                        </div>
                        <button type="button" class="btn btn-secondary" style="margin-top: 60px">Send Request</button>
                    </div>
                </div>
            </div>
                <div class="container-test">
                    <div class="row">
                        <div class="column"  style="max-width: 60%;">
                            <div class="section">
                                <div class="column">
                                    <h3 style="font-family: 'Katibeh', serif;">About</h3>
                                    <p>As a current 3rd Year at the University of Virginia, I am on a mission to inspire others to prioritize their health amidst the demands of academic life. I look to share insights on cultivating a balanced lifestyle, emphasizing the importance of healthy eating and regular exercise. Join my journey as I navigate the challenges of maintaining well-being in a college setting, offer practical tips, nutritious recipes, and motivate fellow students. </p>
                                </div>
                            </div>
                        </div>
                        <div class="column">
                            <div class="section">
                                <div class="column">
                                    <h3 style="font-family: 'Katibeh', serif;">Featured On</h3>
                                    <div style="margin-left: 20px">
                                        <div class="row">
                                            <div class="column">
                                                <div class="featured-item">
                                                    <img src="images/healthbeats.png" alt="HealthBeats" class="featured-image">
                                                    <p class="featured-text">HealthBeats</p>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="column">
                                                <div class="featured-item">
                                                    <img src="images/dailydose.png" alt="HealthBeats" class="featured-image">
                                                    <p class="featured-text">HealthBeats</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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