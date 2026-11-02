<?php
// 1. Incluimos el archivo de la base de datos
require_once __DIR__ .'/../config/db.php';

//2.2. Indicamos al navegador/cliente que la respuesta será un JSON con codificación UTF-8
header('Content-Type: application/json; charset=utf-8');

try{
    //3. Lanzamos la consulta SQL para traernos todos los campos de la tabla del database
    $query = "SELECT id, nombre, tipo, latitud, longitud, direccion FROM recursos";
    $stmt = $pdo->query($query);
    //4. Se recuperan todos los registros en forma de array asociativo
    $recursos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    //5. Convertimos los datos de PHP a JSON y los enviamos al cliente
    echo json_encode($recursos, JSON_UNESCAPED_UNICODE);


}catch(PDOException $e){
    //si ocurre algún error en la consulta, devolvemos un JSON con el mensaje de error
    echo json_encode(["error" => "Error al consultar los datos: ". $e ->getMessage()]);
}