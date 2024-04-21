<?php

// Función para consumir el endpoint y devolver la respuesta
function consumirEndpoint($urlEnd)
{
    // Token de acceso
    $token = "ciisa";

    // Endpoint que proporciona la información y le concateno lo que falta de la url, en este caso services o about-us
    $endpoint = "https://ciisa.coningenio.cl/v1/" . $urlEnd . '/';

    // Configurar la solicitud con autenticación
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $endpoint);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Authorization: Bearer ' . $token
    ));

    // Realizar la solicitud
    $response = curl_exec($ch);
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    // Verificar si la solicitud fue exitosa
    if ($httpcode == 200) {
        // Procesar la respuesta
        $data = json_decode($response, true);

        // Cerrar la conexión
        curl_close($ch);

        // Devolver los datos
        return $data;
    } else {
        // Si la solicitud falla, devolver un mensaje de error
        return "Error al obtener los datos: " . $httpcode;
    }
}
