<?php 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST, PUT");

function handelGet() {

}

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        handelGet();
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body);
        echo $data;
        break;
    case 'POST':
        // Xử lý dữ liệu từ request POST
        break;
    case 'PUT':
        // Xử lý dữ liệu từ request PUT
        break;
    case 'DELETE':
        // Xử lý dữ liệu từ request DELETE
        break;
    default:
        // Xử lý dữ liệu cho các method khác
        break;
}
