<?php

    // Note that these are for the local Docker container
    $host = "db";
    $port = "5432";
    $database = "podpair";
    $user = "dgs5qm";
    $password = "Pcv4wW4Z96Ng"; 

    $dbHandle = pg_connect("host=$host port=$port dbname=$database user=$user password=$password");

    if ($dbHandle) {
        echo "Success connecting to database";
    } else {
        echo "An error occurred connecting to the database";
    }

    // Drop tables and sequences (that are created later)
    $res  = pg_query($dbHandle, "drop sequence if exists question_seq;");
    $res  = pg_query($dbHandle, "drop sequence if exists user_seq;");
    $res  = pg_query($dbHandle, "drop sequence if exists userquestion_seq;");
    $res  = pg_query($dbHandle, "drop table if exists questions;");
    $res  = pg_query($dbHandle, "drop table if exists users;");

    // Create sequences
    $res  = pg_query($dbHandle, "create sequence question_seq;");
    $res  = pg_query($dbHandle, "create sequence user_seq;");
    $res  = pg_query($dbHandle, "create sequence userquestion_seq;");

    // Create tablse
    $res  = pg_query($dbHandle, "create table users (
            name text,
            email text,
            username text primary key,
            password text,
            bio text,
            type text,
    );");
    $res  = pg_query($dbHandle, "create table featured_on (
            id  int primary key default nextval('user_seq'),
            username text,
            feature text,
    );");
    $res  = pg_query($dbHandle, "create table tags (
            id  int primary key default nextval('user_seq'),
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
