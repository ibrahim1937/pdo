<?php 


if(isset($_GET['op'])){
    chdir('../');
    extract($_GET);
    include 'services/FiliereServices.php';
    if($op == "affiche"){
        // affiche le code des filiere existant
        $fs = new FiliereServices();
        $filieres = $fs->findAllajax();
        echo json_encode($filieres);
    } elseif ($op == "supprimer" && isset($_GET['idf'])){
        $fs = new FiliereServices();
        $fs->delete($idf);
        $filieres = $fs->findAllajax();
        echo json_encode($filieres);

    } elseif($op == "modifier" && isset($_GET['idf']) && isset($_GET['codef']) && isset($_GET['libellef'])){
        $fs = new FiliereServices();
        $temp = new Filiere($idf, $codef, $libellef);
        $fs->update($temp);
        $filieres = $fs->findAllajax();
        echo json_encode($filieres);
        
    } elseif($op == "ajouter"  && isset($_GET['codef']) && isset($_GET['libellef'])){
        $fs = new FiliereServices();
        $temp = new Filiere(1, $codef, $libellef);
        $fs->create($temp);
        $filieres = $fs->findAllajax();
        echo json_encode($filieres);
        
    }
}