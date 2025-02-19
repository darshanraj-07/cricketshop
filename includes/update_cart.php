<?php
session_start();
header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);
$product_id = $data['product_id'];
$increment = $data['increment'];

if (!isset($_SESSION['cart'][$product_id])) {
    $_SESSION['cart'][$product_id] = 0;
}

if ($increment) {
    $_SESSION['cart'][$product_id]++;
} else {
    if ($_SESSION['cart'][$product_id] > 1) {
        $_SESSION['cart'][$product_id]--;
    }
}

echo json_encode(['success' => true]);
?> 