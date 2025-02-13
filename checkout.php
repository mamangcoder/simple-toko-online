<?php
include 'config.php';

$data = json_decode(file_get_contents("php://input"));

if ($data) {
    $customerName = $data->customerName;
    $email = $data->email;
    $cart = $data->cart;
    
    $total_price = array_reduce($cart, function ($sum, $item) {
        return $sum + $item->price;
    }, 0);

    $conn->query("INSERT INTO orders (customer_name, email, total_price) VALUES ('$customerName', '$email', $total_price)");
    $orderId = $conn->insert_id;

    foreach ($cart as $item) {
        $conn->query("INSERT INTO order_items (order_id, product_name, price, quantity) 
                      VALUES ($orderId, '{$item->name}', {$item->price}, 1)");
    }

    echo json_encode(["success" => true, "message" => "Checkout berhasil!"]);
} else {
    echo json_encode(["success" => false, "message" => "Gagal melakukan checkout"]);
}
?>
