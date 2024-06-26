<?php
/**
 * Database Class
 *
 * Contains connection information to query PostgresSQL.
 */


class Database {
    private $dbConnector;

    /**
     * Constructor
     *
     * Connects to PostgresSQL
     */
    public function __construct() {
        $host = "localhost";
        $port = "5432";
        $database = "dgs5qm";
        $user = "dgs5qm";
        $password = "Pcv4wW4Z96Ng"; 
        $this->dbConnector = pg_connect("host=$host port=$port dbname=$database user=$user password=$password");

        $tableQ = "SELECT EXISTS (
            SELECT FROM pg_tables 
            WHERE schemaname = 'public' AND tablename  = 'users'
            );";
            $tableSearch = pg_query($this->dbConnector, $tableQ);
            $tableExists = pg_fetch_result($tableSearch, 0, 0);
        
            if (!$tableExists) {
                $this->createTables();
            }
        }
    
    //if tables aren't instantiated, create them
    private function createTables(){

        //Create our sequences
        pg_query($this->dbConnector, "CREATE SEQUENCE featuredOn_seq;");
        pg_query($this->dbConnector, "CREATE SEQUENCE user_seq;");
        pg_query($this->dbConnector, "CREATE SEQUENCE tags_seq;");

        //Create our tables
        pg_query($this->dbConnector, "CREATE TABLE users (
            username TEXT PRIMARY KEY,
            name TEXT,
            id INT DEFAULT nextval('user_seq'),
            email TEXT,
            password TEXT,
            bio TEXT,
            type TEXT,
            profile_picture TEXT
        );");
        pg_query($this->dbConnector, "CREATE TABLE featured_on (
            id INT PRIMARY KEY DEFAULT nextval('featuredOn_seq'),
            username TEXT,
            feature TEXT
        );");
        pg_query($this->dbConnector, "CREATE TABLE tags (
            id INT PRIMARY KEY DEFAULT nextval('tags_seq'),
            username TEXT,
            tag TEXT
        );");

        echo "New database created\n";

    } 

    //updated from original to take variables not arrays
    public function query($query, ...$params) {
        if (empty($params)) {
            $res = pg_query($this->dbConnector, $query);
        } else {
            $res = pg_query_params($this->dbConnector, $query, $params);
        }
    
        if ($res === false) {
            // More detailed error reporting
            $error = pg_last_error($this->dbConnector);
            error_log($error);  // Log error to PHP error log
            return false;
        }
    
        return pg_fetch_all($res);
    }
    
}
