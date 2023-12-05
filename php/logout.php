<?php

    session_start();
    session_destroy(); //destroys all session variables

    header('location:index.php');

?>