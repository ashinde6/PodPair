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
        if (!isset($_SESSION["username"]) && ($command != "showLogin" || $command != "login"))
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
        $username = "";
        $password = "";
        // array to hold error messages
        $errorMessages = [];

        // Check if the user has provided a password that adheres to our guidelines
        if (isset($_POST["passwd"])) {
            $password = (string)$_POST["passwd"];

            if (strlen($password) <= 5) {
                $errorMessages[] = "Password must be longer than 5 characters."; //check if password is longer than 5 characters
            }
            if (!preg_match('~[0-9]+~', $password)) {
                $errorMessages[] = "Password must contain at least one number."; //use regex to check if password has at least one number
            }
        } else {
            $errorMessages[] = "Password is required.";
        }

        // Check if the user has provided a username that adheres to our guidelines
        if (isset($_POST["name"])) {
            $name = (string)$_POST["name"];
        
            if (strlen($name) <= 3) {
                $errorMessages[] = "Username must be longer than 3 characters."; //check that username is longer than 3 characters
            }
        } else {
            $errorMessages[] = "Username is required.";
        }

        if(!empty($errorMessages)){
            $this -> showLogin($errorMessages, $_POST);
            return;
        }

        //if the user's name and password are syntactically correct, check if their credintials are in our database

        $res = $this->db->query("select * from users where username = $1;", $name);
        if (empty($res)) {
            // User not in database, direct them to signup page to input their email
            $this-> showSignup($name, $password);
            return;
        } 
        
        else {
            //if user is in database, check if password is right.
            if (password_verify($password, $res[0]["password"])) {
                // Password was correct, save their information to the
                // session and redirect them to home page
                $_SESSION["username"] = $username;
                $_SESSION["email"] = $res[0]["email"];
                header("Location: ?command=showHome");
                return;
            } 
            else {
                // Password was incorrect. Redirect to login
                $this -> showLogin([], $_POST, true);
                return;
            }
        }

        // If something went wrong, show the home page
        $this->showHome();
    }

    public function signUp(){
 
        $pattern = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";

        // Check if the user has provided an email that adheres to our guidelines
        if (!isset($_POST["email"]) || !preg_match($pattern, $_POST["email"])) {
            $this->showSignup($_POST["name"],$_POST["passwd"],"Your email address is not valid");
            return;
        }
        
        //if the email is correct, create an entry for the user in the database and direct to homepage.
        
        $this->db->query("insert into users (username, email, password) values ($1, $2, $3);",
        $_POST["name"], $_POST["email"],
        // hashed password
        password_hash($_POST["passwd"], PASSWORD_DEFAULT), 0);

        $_SESSION["username"] = $_POST["name"];
        $_SESSION["email"] = $_POST["email"];

        // Send user to the homepage
        $this->logout();
        exit();
        header("Location: ?command=showHome");
        return;
    }

    //direct the user to the login page
    public function showLogin($errorMessages = [], $formInput = [], $passWarning = false){
        include_once('../src/templates/login.php');
    }

    //direct the user to the sign up page
    public function showSignup($name = "", $password = "", $msg =""){
        header('Location: ../src/templates/signUp.php');
    }



    //destroys current session and restarts it.
    public function logout() {
        session_destroy();
        session_start();
    }

    public function showProfile() {
        header('Location: ../src/templates/profile.php');
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
    }


}
