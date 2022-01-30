<?php

$file_name = "./data.json";

if (file_exists($file_name)){

    try {
        $personnages = json_decode(file_get_contents($file_name),true);
        echo json_encode([
            'personnages' => $personnages,
            'status' => 201
        ]);
    }catch (\Exception $e) {
        return json_encode([
            'status' => 401,
            'message' => $e->getMessage()
        ]);
    }

}else{
    echo "le fichier nexiste pas";
}