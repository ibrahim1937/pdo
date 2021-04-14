<?php

chdir("../");

if(isset($_GET['op'])){
    include_once 'services/ClasseServices.php';

    $cs = new ClasseServices();
    $classes = $cs->classeStats();
    echo $classes;
}


