<?php

class Controller {
    
    private $db;
    private $input;

    //Constructor
    public function __construct($input) {

        session_start(); // start our session
        
        // Connect to the database or create new one if it doesn't exist
        $this->db = new Database();
        if ($this->db === false) {
            die("Error connecting to the database."); 
        }
        

        // Set input
        $this->input = $input;
    }

    //Run the server
    //Determine command to execute based on 'command' parameter
     
    public function run() {
        // Get the command
        $command = "home";
        if (isset($this->input["command"]))
            $command = $this->input["command"];

        // If user isn't logged in, direct to login/sign-up page
        if (!isset($_SESSION["username"]) && ($command != "showLogin" && $command != "login"))
            $command = "showLogin";

        switch($command) {
            case "home":
                $this->showHome();
                break;
            case "profile":
                $this->showProfile();
                break;
            case "showLogin":
                $this -> showLogin();
            case "login":
                $this->login();
                break;
            case "showSignup":
                $this -> showSignup();
                break;
            case "signUp":
                $this -> signUp();
                break;
            default:
                $this->showHome();
                break;
        }
    }


    //Login function with dynamic error handling. Checks if a user's input adheres to our guidelines, if so, determines whether the user is
    //new or returning. If the user is new, redirects them  to a sign up page that preserves their previously set username and password and
    //creates a new user instance.
    public function login() {
 
        $errorMessages = [];

        // Check for non-empty username and password
        if (empty($_POST['name'])) {
            $errorMessages[] = "Username is required.";
        }
        if (empty($_Post['passwd'])) {
            $errorMessages[] = "Password is required.";
        }

        if(empty($errorMessages)){
            $res = $this->db->query("select * from users where username = $1;", $_POST['name']);
            if (empty($res)) {
                // User not in database, direct them to home page and sign them up
                $_SESSION["username"] = $_POST['name'];
                $_SESSION['password'] = $_POST['passwd'];
                $this->db->query(
                    "INSERT INTO users (username, password) VALUES ($1, $2);",
                    $_SESSION["username"], 
                    $_SESSION['password']
                );   
                $this-> showHome();
                exit();
            }
            else{
                if (password_verify($_POST['password'], $res[0]["password"])) {
                    // Password was correct, save their information to the
                    // session and redirect them to home page
                    $_SESSION["username"] = $_POST['name'];
                    header("Location: ?command=showHome");
                    exit();
                } 
                else {
                    // Password was incorrect. Redirect to login
                    $errorMessages[] = "Password is not correct. Check it again";
                }
            } 

        }

        if (!empty($errorMessages)) {
            $this->showLogin($errorMessages);
        exit();
        }
    }

    public function signUp(){
 
        $pattern = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";

        // Check if the user has provided an email that adheres to our guidelines
        if (!isset($_POST["email"]) || !preg_match($pattern, $_POST["email"])) {
            $_SESSION['invalid_email'] = true;
            $this->showSignup();
            exit();
        }
        
        //if the email is correct, create an entry for the user in the database and direct to homepage.
        
        $this->db->query(
            "INSERT INTO users (username, email, password) VALUES ($1, $2, $3);",
            $_SESSION["username"], 
            $_POST["email"],
            // Hashed password
            password_hash($_SESSION["password"], PASSWORD_DEFAULT)
        );        

        $_SESSION["email"] = $_POST["email"];

        // Send user to the homepage
        header("Location: ?command=showHome");
        exit();
    }

    //direct the user to the login page
    public function showLogin($errorMessages = []){
        include("../src/templates/login.php");
    }

    //direct the user to the sign up page
    public function showSignup(){
        header('Location: ../src/templates/signUp.php');
    }



    //destroys current session and restarts it.
    public function logout() {
        session_destroy();
        session_start();
        exit();
    }

    public function showProfile() {
        header('Location: ../src/templates/profile.php');
        exit();
    }
    
    //fetches all users
    public function getUsers() {
        try {
            // Query to select all users
            $users = $this->db->query("SELECT * FROM users;");
            
            // Check if query was successful
            if ($users === false) {
                throw new Exception("Error retrieving users from the database.");
            }
    
            return $users;
        } catch (Exception $e) {
            // Log the error or handle it appropriately
            error_log("Error: " . $e->getMessage());
            return false;
        }
    }

    //displays homepage
    public function showHome() {
        $users = $this->getUsers();
        header('Location: ../src/templates/home.php');
        exit();
    }


}
