<?php
    //Starting the session 
    session_start();

    //Change the login session variable to FALSE
    $_SESSION['login'] = FALSE;

    // //Clear all session variables
    // session_unset();

    //Destroy the session
    session_destroy();

    //Redirect to the login page after destroying the session
    header("Location: login.php");
    exit();
?>