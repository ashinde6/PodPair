<?php
/**
 * Database Class
 */

class Database {
    private $dbConnector;

    /**
     * Connects to PostgresSQL
     */
    public function __construct() {
        $host = "localhost";
        $port = "5432";
        $database = "dgs5qm";
        $user = "dgs5qm";
        $password = "Pcv4wW4Z96Ng";

        $this->dbConnector = pg_connect("host=$host port=$port dbname=$database user=$user password=$password");

        // Check if the 'users' table exists. This will tell us whether we need to instantiate our tables or not.
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

    private function createTables(){
        //Since the 'users' table doesn't exist, drop all other tables and instantiate the database
        pg_query($this->dbConnector, "DROP SEQUENCE IF EXISTS user_seq, featuredOn_seq, tags_seq;");
        pg_query($this->dbConnector, "DROP TABLE IF EXISTS featured_on, users, tags;");

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

    /**
     * Query
     *
     * Makes a query to posgres and returns an array of the results.
     * The query must include placeholders for each of the additional
     * parameters provided.
     */
    public function query($query, ...$params) {
        $res = pg_query_params($this->dbConnector, $query, $params);

        if ($res === false) {
            echo pg_last_error($this->dbConnector);
            return false;
        }

        return pg_fetch_all($res);
    }
}
