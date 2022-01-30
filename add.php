<?php

$file_name = "./data.json";

$json = file_get_contents('php://input');

$data =  json_decode($json,true);
try {
    $id = $data['id'] !== '' ? $data['id'] : null;
    $nom = $data['nom'] !== '' ? $data['nom'] : null;
    $prenom = $data['prenom'] !== '' ? $data['prenom'] : null;
    $role = $data['role'] !== '' ? $data['role'] : null;
    if($id === null || $nom === null || $prenom === null || $role === null) {
        http_response_code(400);
        throw new Exception("Veuillez renseigner tous les champs");
    }elseif (file_exists($file_name)){
        $personnages = json_decode(file_get_contents($file_name),true);
        foreach ($personnages as $personne){
            if ($prenom === $personne['prenom'] || $role === $personne['role']){
                http_response_code(400);
                throw new Exception("Le prénom ou le rôle existe déjà");
            }
        }
        $inp = file_get_contents($file_name);
        $tempArray = json_decode($inp);
        array_push($tempArray, $data);
        $jsonData = json_encode($tempArray);
        file_put_contents($file_name, $jsonData);
    }
}catch (Exception $exception){
    echo json_encode([
        'message' => $exception->getMessage()
    ]);
}
