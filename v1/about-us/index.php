<?php
include_once '../version1.php';
include_once '../conexion.php';


//valores de los parametros
$existeId = false;
$valorId = 0;
$about = 'about-us';

if (count($_parametros) > 0) {
    foreach ($_parametros as $p) {
        if (strpos($p, 'id') !== false) {
            $existeId = true;
            $valorId = explode('=', $p)[1];
        }
    }
}

if($_version == 'v1'){
    if($_mantenedor == $about){
        switch ($_metodo){
            case 'GET':
                if ($_header == $_token_get){
                    $lista = consumirEndpoint($about);

                    http_response_code(200);
                    echo json_encode(["data" => $lista]);
                }else{
                    http_response_code(401);
                    echo json_encode(["Error" => "No tiene autorizacion GET"]);
                }
                break;
            default:
                http_response_code(405);
                echo json_encode(["Error" => "No implementado"]);
                break;
        }
    }
}