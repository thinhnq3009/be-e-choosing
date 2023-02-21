<?php
include '../connect.php';

if ($_POST['username'] && $_POST['password']) {

    $hash_password = hash('sha256', $_POST['username']);


    $sql = 'SELECT * FROM users WHERE username = "' . $_POST['username'] . '" AND password = "' . $hash_password . '";';


    $result = mysqli_query($conn, $sql);

    // Nếu tồn tại bản ghi thõa mãn
    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        $response = array(
            'status' => 'success',
            'message' => 'Đăng nhập thành công',
            'user' => $user
        );
    } else {
        $response = array(
            'status' => 'error',
            'message' => 'Sai tên đăng nhập hoặc mật khẩu'
        );
    }

    echo json_encode($response);
}
