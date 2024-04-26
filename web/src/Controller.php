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

        $_SESSION['errorMessages'] = [];

    }

    // Run server
    public function run() {
        // Get the command
        $command = "showLogin";
        if (isset($this->input["command"]))
            $command = $this->input["command"];

        // if user is not logged in, redirect to login page
        if (!isset($_SESSION["username"]) && ($command != "showLogin" && $command != "login" && $command != "signup")){
            $command = "showLogin";

        }

        switch($command) {
            case "home":
                $this->showHome();
                break;
            case "showLogin":
                $this->showLogin();
                break;
            case "profile":
                $this->showProfile();
                break;
            case "ownProfile":
                $this->showOwnProfile();
                break;
            case "login":
                $this->login();
                break;
            case "json":
                $this->showJson();
                break;
            case "logout":
                $this->logout();
                // no break; logout will also show the welcome page.
                break;
            case "signup":
                $this->signup();
                break;
            case "updateprofile":
                $this->updateprofile();
                break;
            case "performUpdate":
                $this->performUpdate();
                break;
            default:
                $this->showLogin();
                break;
        }
    }


    //checks that user inputted name, email, and password that adhere to our guidelines, if so, checks if login information is valid, and create new account if not
    public function login() {
        // Check if the user has provided a password that adheres to our guidelines
        if (!isset($_POST["passwd"])) {
            $_SESSION['errorMessages'][] = "Password is required.";
        }

        // Check if the user has provided a username that adheres to our guidelines
        if (!isset($_POST["username"])) {
            $_SESSION['errorMessages'][] = "Username is required.";
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
            $_SESSION['errorMessages'][] = "Could not find your account in our system. Consider signing up instead?";
        } else {
            //check if passwords match
            if (password_verify($_POST["passwd"], $res[0]["password"])) {
                // Password was correct
                $_SESSION["username"] = $res[0]["username"];
                $_SESSION["name"] = $res[0]["username"];
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


    public function signup(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["username"], $_POST["email"], $_POST["password"])) {
            $username = $_POST["username"];
            $email = $_POST["email"];
            $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
            $role = ($_POST['role'] === "podcast host") ? 'p' : 'g';
    
            // Check if user already exists
            $res = $this->db->query("SELECT 1 FROM users WHERE username = $1;", $username);
            if (empty($res)) {  
                $this->db->query("INSERT INTO users (name, username, email, password, type) VALUES ($1, $1, $2, $3, $4);",
                    $username, 
                    $email,
                    $password, 
                    $role
                );

                $_SESSION["username"] = $username;
                $_SESSION["name"] = $username; // Assuming 'name' should also be set to 'username' at this point
                header("Location: ?command=home");
                exit();
            }
            else {
                //check if passwords match
                if (password_verify($_POST["password"], $res[0]["password"])) {
                    // Password was correct
                    $_SESSION["username"] = $res[0]["username"];
                    $_SESSION["name"] = $res[0]["username"];
                    header("Location: ?command=home");
                    return;
                } else {
                    // Account found but password was incorrect. Tell the user that the username is already taken
                    $_SESSION['errorMessage'] = ["This username is already taken, please pick a new one"];;
                }
        }
    }
            include 'templates/signup.php';
            return;
    }
    
   //logout. Destroy and restart session
    public function logout() {
        session_destroy();
        session_start();
    }

    public function showOwnProfile(){
        if (isset($_SESSION["username"])) {
            $user = $this->findUser($_SESSION["username"]);
        }
        else {
            // Optionally handle the error state when no username is available
            echo "No username provided for profile lookup.";
            return;
        }
        if ($user) {
            include('templates/ownProfile.php');
        } else {
            // Handle case where user is not found
            echo "User not found.";
        }
    }

    //show the profile of self or other users
    public function showProfile() {
        if (isset($_POST["username"])) {
            $user = $this->findUser($_POST["username"]);
        }
        else {
            // Optionally handle the error state when no username is available
            echo "No username provided for profile lookup.";
            return;
        }
        if ($user) {
            include('templates/profile.php');
        } else {
            // Handle case where user is not found
            echo "User not found.";
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

    public function updateprofile(){
        $_SESSION['updateData'] = $_POST['userData'];
        header("Location: update.php");
        exit();
    }

    public function performUpdate(){
        $username = $_POST['username'];
        $bio = $_POST['bio'];
        // Assume userID is stored in session or retrieved through other secure means
        $userID = $_SESSION['userId']; // Ensure userID is already set in session when user logs in
        // Update database query here, e.g.,
        $this->db->query("UPDATE users SET username = $1, bio = $2 WHERE id = $3", $username, $bio, $userID);
        header("Location: ownProfile.php"); // Redirect back to the profile page
        exit();
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
