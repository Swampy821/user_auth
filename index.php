<?php

    include('./lib/rest.php');
    
    $rest = new Rest();

    echo json_encode($rest->process($_GET, $_POST));