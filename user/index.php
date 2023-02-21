<?php


include "../connect.php";


try {
    // Phương thức GET
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {

        $append = "";
        if (isset($_GET)) {

            foreach (array_keys($_GET) as $key) {
                $append = $append . ' AND ' . $key . " = '" . $_GET[$key] . "' ";
            }
            $append = substr($append, 4);
        }

        $result = $conn->query("SELECT * FROM users WHERE" . $append);
        $outp = array();
        $outp = $result->fetch_all(MYSQLI_ASSOC);
        echo json_encode($outp);
    }

    // Phương thức POST
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $data = json_decode(file_get_contents("php://input"));
        $data = $data->params;
        $columns = '';
        $values = '';
        foreach ($data as $key => $value) {
            $columns .= $key . ', ';
            $values .= '"' . $value . '", ';
        }

        // Thêm token cho user mới 
        $newToken = hash("sha256", $data->username . time());
        $columns .= 'token';
        $values .= '"' . $newToken . '"';
        
        // // Xóa dấu phẩy thừa cuối cùng của chuỗi columns và values
        // $columns = rtrim($columns, ', ');
        // $values = rtrim($values, ', ');

        $sql = "INSERT INTO users ($columns) VALUES ($values)";



        if (mysqli_query($conn, $sql)) {
            echo json_encode(array("success" => "Registration successful."));
        } else {
            echo json_encode(array("error" => "Registration failed."));
        }
    }

    // Phương thức PUT
    if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
        $data = json_decode(file_get_contents("php://input"));
        $username = $conn->real_escape_string($data->username);
        $password = $conn->real_escape_string($data->password);
        $avatar = $conn->real_escape_string($data->avatar);
        $dob = $conn->real_escape_string($data->dob);
        $class = $conn->real_escape_string($data->class);
        $school = $conn->real_escape_string($data->school);
        $gender = $conn->real_escape_string($data->gender);
        $code = $conn->real_escape_string($data->code);
        $email = $conn->real_escape_string($data->email);
        $phone = $conn->real_escape_string($data->phone);

        $conn->query("UPDATE users SET password='$password', avatar='$avatar', dob='$dob', class='$class', school='$school', gender='$gender', code='$code', email='$email', phone='$phone' WHERE username='$username'");
        echo json_encode(array("message" => "Cập nhật dữ liệu thành công."));
    }

    $conn->close();
} catch (Exception $e) {
    echo json_encode(array("message" => "Error: " . $e->getMessage()));
}
