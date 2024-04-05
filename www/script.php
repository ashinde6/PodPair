<?php

    // Note that these are for the local Docker container
    $host = "localhost";
    $port = "5432";
    $database = "dgs5qm";
    $user = "dgs5qm";
    $password = "Pcv4wW4Z96Ng"; 

    $dbHandle = pg_connect("host=$host port=$port dbname=$database user=$user password=$password");

    if ($dbHandle) {
        echo "Success connecting to database";
    } else {
        echo "An error occurred connecting to the database";
    }

    // Drop tables and sequences (that are created later)
    $res  = pg_query($dbHandle, "drop sequence if exists user_seq;");
    $res  = pg_query($dbHandle, "drop table if exists featured_on;");
    $res  = pg_query($dbHandle, "drop table if exists users;");
    $res  = pg_query($dbHandle, "drop table if exists tags;");

    // Create sequences
    $res  = pg_query($dbHandle, "create sequence featuredOn_seq;");
    $res  = pg_query($dbHandle, "create sequence user_seq;");
    $res  = pg_query($dbHandle, "create sequence tags_seq;");

    // Create tables
    $res  = pg_query($dbHandle, "create table users (
            username text primary key,
            name text,
            id  int default nextval('user_seq'),
            email text,
            password text,
            bio text,
            type text,
            profile_picture text
    );");
    $res  = pg_query($dbHandle, "create table featured_on (
            id  int primary key default nextval('featuredOn_seq'),
            username text,
            feature text,
    );");
    $res  = pg_query($dbHandle, "create table tags (
            id  int primary key default nextval('tags_seq'),
            username text,
            tag text,
    );");

    // Read json and insert the trivia questions into the database, assuming
    // the trivia-s24.json file is in the same directory as this script.
    // $questions = json_decode(
    //     file_get_contents("trivia-s24.json"), true);

    // $res = pg_prepare($dbHandle, "myinsert", "insert into questions (question, answer) values 
    // ($1, $2);");
    // foreach ($questions as $q) {
    //         $res = pg_execute($dbHandle, "myinsert", [$q["question"], $q["answer"]]);
    // }
    
    $username = 'john_doe';
    $name = 'John Doe';
    $email = 'john.doe@example.com';
    $password = '12345';
    $bio = 'I am a seasoned fitness expert with a decade of experience. As a certified personal trainer and nutrition coach, I advocate for a balanced approach to fitness, emphasizing functional training, nutrition, and holistic wellness. I am a sought-after speaker and podcast guest, sharing practical insights on workout routines, nutrition, and mindset shifts for sustainable health and fitness success. My passion for empowering individuals to prioritize their health shines through in every discussion, inspiring listeners to adopt healthier lifestyles and unlock their full potential.';
    $type = 'guest';
    $profile_picture = '../../images/person3.png'; // This should be the file path or reference to the profile picture
    
    $query = "INSERT INTO users (username, name, email, password, bio, type, profile_picture) VALUES ('$username', '$name', '$email', '$password', '$bio', '$type', '$profile_picture')";
    
    $res = pg_query($dbHandle, $query);
    