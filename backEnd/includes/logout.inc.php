<?php 

    session_start();
    session_unset();
    session_destroy();

    header('location:  https://webtech-ki46.webtech-uva.nl');