<?php

$file_name = "./data.json";

$json = file_get_contents('php://input');

$data =  json_decode($json,true);

$response = null;

$id = $data['id'];
$nom = $data['nom'];
$prenom = $data['prenom'];
$role = $data['role'];


if (file_exists($file_name)){

        $personnages = json_decode(file_get_contents($file_name),true);

        $keys = array_keys($personnages);

        foreach ($keys as $key) {
            if($personnages[$key]['id'] == $id){
                $personnages[$key]["nom"] = $nom;
                $personnages[$key]["prenom"] = $prenom;
                $personnages[$key]["role"] = $role;
            }
        }

        $viewchange = json_encode($personnages);

        file_put_contents($file_name, $viewchange);

}else{
    echo "le fichier nexiste pas";
}
