<?php

$file_name = "./data.json";

$json = file_get_contents('php://input');

$data =  json_decode($json,true);

$response = null;

$id = $data['id'];


if (file_exists($file_name)){

    try {
        $personnages = json_decode(file_get_contents($file_name),true);
        foreach ($personnages as $personne){
            if ($personne['id'] === $id ){
                $response = json_encode($personne);
            }
        }
        if ($response !== null){
            echo $response;
        }else{
            throw new Exception("Aucun personnage ne correspond à cet identifiant", 400);
        }

    }catch (\Exception $e) {
        echo $e->getMessage();
    }

}else{
    echo "le fichier nexiste pas";
}
