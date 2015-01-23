<?php
    include('./lib/rest.php');
    
    $rest = new Rest();
    
    $rest->process($_GET, $_POST);

?>