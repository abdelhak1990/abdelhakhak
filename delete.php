<?php

$file_name = "./data.json";

$json = file_get_contents('php://input');

$data =  json_decode($json,true);

$id = $data['id'];

if (file_exists($file_name)){
    $personnageList = file_get_contents($file_name);
    $personnages = json_decode($personnageList, true);

    foreach ($personnages as $index => $personnage){
        if ($personnage['id'] === $id){
            unset($personnages[$index]);
            break;
        }
    }
    $json = json_encode($personnages, JSON_PRETTY_PRINT);
    file_put_contents($file_name, $json);
}
