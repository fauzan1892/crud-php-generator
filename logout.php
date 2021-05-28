<?php
    session_start();
    
    include 'setting.php';
    include 'helper.php';

    session_destroy();

    redirect($baseURL.'login.php');
?>