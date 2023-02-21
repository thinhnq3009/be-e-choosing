<?php
include '../connect.php';

if (true) {

    $sql = 'SELECT * FROM `subjects`';

    if (isset($_GET['name'])) {
        $sql = 'SELECT * FROM `subjects` WHERE name LIKE "%' . $_GET['name'] . '%"';
    } else if (isset($_GET['code'])) {
        $sql = 'SELECT * FROM `subjects` WHERE code LIKE "%' . $_GET['code'] . '%"';
    }


    $result = mysqli_query($conn, $sql);

    $response = [];

    if (isset($result)) {
        $data = [];
        foreach ($result as $row) {
            $data[] = $row;
        }

        $response = [
            "status_code" => 201,
            "status" => "success",
            "message" => count($data)." subjects have been found",
            "values" => $data
        ];

    } else {
        $response = [
            "status_code" => 201,
            "status" => "success",
            "message" => "Can't find any subjects",
            "values" => null
        ];
    }


    echo json_encode($response);
}
