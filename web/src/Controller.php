<?php

class Controller {
 
    private $db;

    /**
     * Constructor
     */
    public function __construct($input) {

        session_start(); // start a session
        
        // Connect to the database and check if tables exist, if not, instantiate them
        $this->db = new Database();

        // Set input
        $this->input = $input;

    }

    // Run server
    public function run() {
        // Get the command
        $command = "home";
        if (isset($this->input["command"]))
            $command = $this->input["command"];

        // if user is not logged in, redirect to login page
        if (!isset($_SESSION["username"]) && ($command != "showLogin" && $command != "login")){
            $command = "showLogin";

        }

        switch($command) {
            case "home":
                $this->showHome();
                break;
            case "showLogin":
                $this->showLogin();
            case "profile":
                $this->showProfile();
                break;
            case "login":
                $this->login();
                break;
            case "json":
                $this->showJson();
            case "logout":
                $this->logout();
                // no break; logout will also show the welcome page.
            default:
                $this->showLogin();
                break;
        }
    }


    //checks that user inputted name, email, and password that adhere to our guidelines, if so, checks if login information is valid, and create new account if not
    public function login() {
        $username = "";
        $password = "";

        // Check if the user has provided a password that adheres to our guidelines
        if (isset($_POST["passwd"])) {
            $password = (string)$_POST["passwd"];

            if (strlen($password) <= 5) {
                $_SESSION['errorMessages'][] = "Password must be longer than 5 characters."; //check if password is longer than 5 characters
            }
            if (!preg_match('~[0-9]+~', $password)) {
                $_SESSION['errorMessages'][] = "Password must contain at least one number."; //use regex to check if password has at least one number
            }
        } else {
            $_SESSION['errorMessages'][] = "Password is required.";
        }

        // Check if the user has provided a username that adheres to our guidelines
        if (isset($_POST["username"])) {
            $name = (string)$_POST["username"];

            if (strlen($name) <= 3) {
                $_SESSION['errorMessages'][] = "Username must be longer than 3 characters."; //check that username is longer than 3 characters
            }
        } else {
            $_SESSION['errorMessages'][] = "Username is required.";
        }

        //check if email follows standard guidelines
        $pattern = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";
        if (!isset($_POST["email"]) || !preg_match($pattern, $_POST["email"])){
            $_SESSION['errorMessages'][] = "email is not formatted correctly. Please follow the standard guidelines"; 
        }

        //if there are any error messages, resend the user to welcome page
        if(!empty($_SESSION['errorMessages'])){
            $this -> showLogin();
            return;
        }

        //if there are no error messages, time to validate the user details

        // Check if user is in database
        $res = $this->db->query("select * from users where username = $1;", $_POST["username"]);
        if (empty($res)) {
            // User was not there (empty result), so insert them
            $this->db->query("insert into users (username, name, email, password, bio) values ($1, $2, $3, $4, $5);",
                $_POST["username"], 
                $_POST["username"],
                $_POST["email"],
                password_hash($_POST["passwd"], PASSWORD_DEFAULT), 
                $_POST["bio"]);

            $_SESSION["username"] = $_POST["username"];
            $_SESSION["name"] = $_POST["username"];
            // Send user to homepage
            header("Location: ?command=home");
            return;
        } else {
            //check if passwords match
            if (password_verify($_POST["passwd"], $res[0]["password"])) {
                // Password was correct
                $_SESSION["username"] = $res[0]["username"];
                $_SESSION["name"] = $res[0]["username"];
                //update existing bio if user decided to write something else.
                if (isset($_POST["bio"]) && !empty($_POST["bio"])) {
                    $result = $this->db->query("UPDATE users SET bio = $1 WHERE username = $2", $_POST["bio"], $_SESSION['username']);
                } 
                header("Location: ?command=home");
                return;
            } else {
                // Account found but password was incorrect
                $_SESSION['errorMessages'] = ["Account found but password was incorrect"];
            }
        }
    // If something went wrong, show the welcome page again
    $this->showLogin();
    }


   //logout. Destroy and restart session
    public function logout() {
        session_destroy();
        session_start();
    }


    //show the profile of self or other users
    public function showProfile() {
        if (isset($_POST["username"])) {
            $user = $this->findUser($_POST["username"]);
            include('templates/profile.php');
        }
    }

    //return user information in json format
    public function showJson() {
        if (isset($_POST["json"])) {
            $query = "SELECT * FROM users WHERE username = $1";
            $username = $_POST["json"];
            // Execute the query with the provided username
            $user = $this->db->query($query, $username);
            if ($user) {
                // Set the response content type to JSON
                header('Content-Type: application/json');
                
                // Output the user data as JSON
                echo json_encode($user, JSON_PRETTY_PRINT);
                
                // Exit to prevent further output
                exit();
            } else {
                // Handle the case when the user does not exist
                // You can return an error message or perform other actions as needed
                echo json_encode(array('error' => 'User not found'));
                exit();
            }
        }
    }

    // Define the findUser method here
    public function findUser($username) {
        try {
            // Prepare the SQL query to select a user by username
            $query = "SELECT * FROM users WHERE username = $1";
            
            // Execute the query with the provided username
            $user = $this->db->query($query, $username);
    
            // Check if the query was successful
            if ($user === false || empty($user)) {
                throw new Exception("User not found.");
            }
    
            return $user[0]; // Assuming you expect only one user or the first one if multiple
        } catch (Exception $e) {
            // Log the error or handle it appropriately
            error_log("Error: " . $e->getMessage());
            return null;
        }
    }
    

    // prepare homepage and handle search requests
    public function showHome() {
        if (!isset($_SESSION["username"])) {
            throw new Exception("Session username is not set.");
        }
    
        $type = "SELECT type FROM users WHERE username = $1";
        $result = $this->db->query($type, $_SESSION["username"]);

        if (empty($result)) {
            throw new Exception("User not found or type could not be determined.");
        }
    
        $user_type = $result[0]['type'];
    
        $opposite = ($user_type === 'p') ? 'g' : 'p';
        $header = ($user_type === 'p') ? 'Guest' : 'Feature';
    
        if (isset($_GET['searchQuery']) && !empty($_GET['searchQuery'])) {
            $search_query = trim($_GET['searchQuery']);
    
            // ensure that you can only search from the opposite type of user
            $users = $this->db->query("SELECT * FROM users WHERE LOWER(name) LIKE LOWER('%$search_query%') AND type = $1;", $opposite);
            if (empty($users)) {
                $users = $this->getUsers();
            }
        } else {
            $users = $this->getUsers();
        }
        include("templates/home.php");
    }
    

    //display the login page
    public function showLogin() {
        include("templates/login.php");
    }

    public function getUsers() {
        $type = "SELECT type FROM users WHERE username = $1";
        $result = $this->db->query($type, $_SESSION["username"]);
        
        if (empty($result)) {
            throw new Exception("User not found or type could not be determined.");
        }
    
        $user_type = $result[0]['type'];
        // get the opposite type of user
        $opposite = ($user_type === 'p') ? 'g' : 'p';
    
        try {
            // only select the opposite type of user
            $users = $this->db->query("SELECT * FROM users WHERE type = $1;", $opposite);
            
            if ($users === false) {
                throw new Exception("Error retrieving users from the database.");
            }
            
            return $users;
        } catch (Exception $e) {
            error_log("Error: " . $e->getMessage());
            return false;
        }
    }    

}
