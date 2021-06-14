<?php
header('Content-Type: application/json');
$method = $_SERVER['REQUEST_METHOD'];
include_once 'mysqli.php';
$db = new MySQLBase('localhost', 'ukt', 'root', '');

if ($method == 'GET' && !empty($_GET['nim'])) {
    $nim = $_GET['nim'];
    if ($nim == "all") {
        $data = $db->getAll("pembayaran");
    }else{
        $data = $db->getBy("pembayaran", 'nim', $nim);
    }

    if ($data->num_rows > 0) {
        http_response_code(200);
        if ($nim == "all") {
            $dataJson = [];
            foreach ($data as $d) {
                array_push($dataJson, $d);
            }
            echo json_encode($dataJson);
        }else{
            echo json_encode($data->fetch_assoc());
        }
    }else{
        http_response_code(400);
        $result = array(
            'status' => false,
            'status_message' => 'NIM Not Found.',
        );
        echo json_encode($result);
    }
}else if ($method == 'POST') {
    $entityBody = (array) json_decode(file_get_contents('php://input'));
    $process = $db->insert("pembayaran", $entityBody);
    if ($process['status']) {
        http_response_code(200);
        $result = array(
            'status' => true,
            'status_message' => 'Create UKT Successfully.',
        );
        echo json_encode($result);
    }else{
        http_response_code(400);
        $result = array(
            'status' => false,
            'status_message' => $process['message'],
        );
        echo json_encode($result);
    }
}else if ($method == 'DELETE' && !empty($_GET['nim'])) {
    $nim = $_GET['nim'];
    $data = $db->getBy("pembayaran", 'nim', $nim);
    if ($data->num_rows > 0) {
        $process = $db->delete("pembayaran", 'nim', $nim);
        if ($process['status']) {
            http_response_code(200);
            $result = array(
                'status' => true,
                'nim' => $nim,
                'status_message' => 'Delete UKT Successfully.',
            );
            echo json_encode($result);
        }else{
            http_response_code(400);
            $result = array(
                'status' => false,
                'nim' => $nim,
                'status_message' => 'Delete UKT Failed.',
            );
            echo json_encode($result);
        }
    }else{
        http_response_code(400);
        $result = array(
            'status' => false,
            'status_message' => 'NIM Not Found.',
        );
        echo json_encode($result);
    }
}else if ($method == 'PUT' && !empty($_GET['nim'])) {
    $nim = $_GET['nim'];
    $data = $db->getBy("pembayaran", 'nim', $nim);
    if ($data->num_rows > 0) {
        $entityBody = (array) json_decode(file_get_contents('php://input'));
        // $dataUpdate['status_ukt'] = $entityBody['status_ukt'];
        $process = $db->update("pembayaran", $entityBody, 'nim', $nim);
        if ($process['status']) {
            http_response_code(200);
            $result = array(
                'status' => true,
                'nim' => $nim,
                'status_message' => 'Update Status UKT Successfully.',
            );
            echo json_encode($result);
        }else{
            http_response_code(400);
            $result = array(
                'status' => false,
                'nim' => $nim,
                'status_message' => 'Update Status UKT Failed.',
            );
            echo json_encode($result);
        }
    }else{
        http_response_code(400);
        $result = array(
            'status' => false,
            'status_message' => 'NIM Not Found.',
        );
        echo json_encode($result);
    }
}else{
    http_response_code(404);
    $result = array(
        'status' => false,
        'status_message' => 'Page Not Found.',
    );
    echo json_encode($result);
}