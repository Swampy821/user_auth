<?php

    include('./lib/Rest.php');
    
    $rest = new Rest();

    $rest->process($_GET, $_POST);