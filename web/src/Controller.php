<?php

class Controller {

    private $warnedOnce;   
    private $db;

    // An error message to display on the welcome page
    private $errorMessage = "";

    /**
     * Constructor
     */
    public function __construct($input) {
        // We should always start (or join) a session at the top
        // of execution of PHP -- the constructor is the best place
        // to do that.
        session_start(); // start a session!
        $this->$warnedOnce = false;
        
        // Connect to the database by instantiating a
        // Database object (provided by CS4640).  You have a copy
        // in the src/example directory, but it will be below as well.
        $this->db = new Database();

        // Set input
        $this->input = $input;

        // Loading questions no longer necessary, as they are
        // in the database
        //$this->loadQuestions();
    }

    /**
     * Run the server
     * 
     * Given the input (usually $_GET), then it will determine
     * which command to execute based on the given "command"
     * parameter.  Default is the welcome page.
     */
    public function run() {
        // Get the command
        $command = "home";
        if (isset($this->input["command"]))
            $command = $this->input["command"];

        // NOTE: UPDATED 3/29/2024!!!!!
        // If the session doesn't have the key "name", AND they
        // are not trying to login (UPDATE!), then they
        // got here without going through the welcome page, so we
        // should send them back to the welcome page only.
        if (!isset($_SESSION["username"]) && $command != "login" && $this->$warnedOnce == false){
            $command = "login";
            $this->$warnedOnce = true;
        }

        switch($command) {
            case "home":
                $this->showHome();
                break;
            case "profile":
                $this->showProfile();
                break;
            case "login":
                $this->loginDatabase();
                break;
            case "json":
                $this->showJson();
            case "logout":
                $this->logout();
                // no break; logout will also show the welcome page.
            default:
                $this->showWelcome();
                break;
        }
    }


    /**
     * Alternate Login Function
     *
     * **NEW**: we can replace the function above with this function which
     * will check the user's credentials against their information in the
     * database's users table to see if their password is correct.
     *
     * 1) if the user is not in the table, it automatically adds them and saves
     * the 1-way hash of their password to the table (so that they can log in again later)
     * 2) if the user is in the table, then it verifies that the password they
     * provided is correct.   If so, it allows them to continue playing, reading their
     * score out of the database.
     *
     * NOTE: you should **not** save passwords in clear text -- only the hashed passwords
     * are stored in the database.
     */
    public function loginDatabase() {
        // User must provide a non-empty name and password to attempt a login
        if(isset($_POST["username"]) && !empty($_POST["username"]) &&
            isset($_POST["passwd"]) && !empty($_POST["passwd"])) {

                // Check if user is in database, by name
                $res = $this->db->query("select * from users where username = $1;", $_POST["username"]);
                if (empty($res)) {
                    // User was not there (empty result), so insert them
                    $this->db->query("insert into users (username, password) values ($1, $2);",
                        $_POST["username"], 
                        // Use the hashed password!
                        password_hash($_POST["passwd"], PASSWORD_DEFAULT));
                    $_SESSION["username"] = $_POST["username"];
                    // Send user to the appropriate page (question)
                    header("Location: ?command=home");
                    return;
                } else {
                    // User was in the database, verify password is correct
                    // Note: Since we used a 1-way hash, we must use password_verify()
                    // to check that the passwords match.
                    if (password_verify($_POST["passwd"], $res[0]["password"])) {
                        // Password was correct, save their information to the
                        // session and send them to the question page
                        $_SESSION["username"] = $res[0]["username"];
                        header("Location: ?command=home");
                        return;
                    } else {
                        // Password was incorrect
                        $this->errorMessage = "Incorrect password.";
                    }
                }
        } else {
            $this->errorMessage = "Name and password are required.";
        }
        // If something went wrong, show the welcome page again
        $this->showWelcome();
    }


    /**
     * Logout
     *
     * Destroys the session, essentially logging the user out.  It will then start
     * a new session so that we have $_SESSION if we need it.
     */
    public function logout() {
        session_destroy();
        session_start();
    }

    public function showProfile() {
        if (isset($_POST["user"])) {
            $username = $_POST["user"];
            $user = $this->findUser($username);
            include('templates/profile.php');
        }
    }

    public function showJson() {
        if (isset($_POST["json"])) {
            $query = "SELECT * FROM users WHERE username = $1";
            $username = $_POST["json"];
            // Execute the query with the provided username
            $user = $this->db->query($query, [$username]);
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
            $user = $this->db->query($query, [$username]);
    
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
    

    /**
     * Show a question to the user.  This function loads a
     * template PHP file and displays it to the user based on
     * properties of this object and the SESSION information.
     */
    public function showHome($message = "") {
        if (isset($_GET['searchQuery']) && !empty($_GET['searchQuery'])) {
            $search_query = trim($_GET['searchQuery']);
            $users = $this->db->query("SELECT * FROM users WHERE LOWER(name) LIKE LOWER('%$search_query%')");
        } else {
            $users = $this->getUsers();
        }
        $name = $_SESSION["username"];
        // $score = $_SESSION["score"];
        include("templates/home.php");
    }

    /**
     * Show the welcome page to the user.
     */
    public function showWelcome() {
        // Show an optional error message if the errorMessage field
        // is not empty.
        $message = "";
        if (!empty($this->errorMessage)) {
            $message = "<div class='alert alert-danger'>{$this->errorMessage}</div>";
        }
        include("templates/login.php");
    }

    public function getUsers($id=null) {

        // If $id is not set, then get a random question
        // We wrote this in class.
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

}
