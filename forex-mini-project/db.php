<?php
header('Content-Type: application/json');
include 'config.php';

$action = $_GET['action'];

if ($action == 'signup') {
    $data = json_decode(file_get_contents("php://input"));
    $username = $data->username;
    $password = password_hash($data->password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    if ($stmt->execute([$username, $password])) {
        echo json_encode(["status" => "success"]);
    } else {
        echo json_encode(["status" => "error"]);
    }
} elseif ($action == 'login') {
    $data = json_decode(file_get_contents("php://input"));
    $username = $data->username;
    $password = $data->password;

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        echo json_encode(["status" => "success"]);
    } else {
        http_response_code(401);
        echo json_encode(["status" => "error"]);
    }
} elseif ($action == 'convert') {
    $data = json_decode(file_get_contents("php://input"));
    $amount = $data->amount;
    $currency = $data->currency;

    $rates = [
        "USD" => 0.012,
        "AED" => 0.044,
        "SGD" => 0.016,
        "MYR" => 0.054,
        "THB" => 0.4
    ];

    $convertedAmount = ($amount * $rates[$currency]) * 0.98; // Deducting 2% tax
    echo json_encode(["convertedAmount" => $convertedAmount]);
}

