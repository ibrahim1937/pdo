<?php 

chdir('../');

include_once 'services/ClasseServices.php';
include_once 'services/FiliereServices.php';

if(isset($_GET['op'])){
    // create a classe service
    extract($_GET);
    if($op == "afficher"){
        $classeservice = new ClasseServices();
        $classes = $classeservice->findAll();
        echo json_encode($classes);
    } elseif($op == "supprimer" && isset($_GET['idc'])){
        $classeservice = new ClasseServices();
        $classeservice->delete($idc);
        $classes = $classeservice->findAll();
        echo json_encode($classes);
    } elseif($op == "modifier" && isset($_GET['idc']) && isset($_GET['codec']) && isset($_GET['filiereid'])){
        $filiereservice = new FiliereServices();
        $filiere = $filiereservice->findById($filiereid);
        $classeservice = new ClasseServices();
        $classe = new Classe($idc, $codec, $filiere);
        $classeservice->update($classe);
        $classes = $classeservice->findAll();
        echo json_encode($classes);

    } elseif ($op == "ajouter" && isset($_GET['codec'])  && isset($_GET['filiereid'])){
        $filiereservice = new FiliereServices();
        $filiere = $filiereservice->findById($filiereid);
        $classeservice = new ClasseServices();
        $classe = new Classe(1, $codec, $filiere);
        $classeservice->create($classe);
        $classes = $classeservice->findAll();
        echo json_encode($classes);
    } elseif ($op == 'filtrage' && isset($_GET['idf'])){
        $filiereservice = new FiliereServices();
        $filiere = $filiereservice->findById($idf);
        $classeservice = new ClasseServices();
        $classes = $classeservice->findByFiliere2($filiere);
        echo json_encode($classes);
    }
    

}


