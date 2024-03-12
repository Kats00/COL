<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once '../Models/DBHelper.php';

global $db_host, $db_username, $db_pass, $db_name, $dbHelper;
$db_pass = "";
$db_host = "localhost";
$db_name = "colorsoflife";
$db_username = "root";
$dbHelper = new DBHelper($db_host, $db_username, $db_pass, $db_name);

if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'getProducts':
            $dbHelper->connect();

            $products = getProducts($dbHelper);

            $productsJson = json_encode(['products' => $products]);

            header('Content-Type: application/json');

            echo $productsJson;
            break;
        case 'findProductById':
            if (isset($_GET['product_id'])) {
                $dbHelper->connect();
                $product_id = $_GET['product_id'];
                $product = findProductById($dbHelper, $product_id);

                header('Content-Type: application/json');

                echo json_encode(['product' => $product]);
            } else {
                $errorData = array(
                    'error' => "'product_id' parameter not found in the GET request."
                );
                header('Content-Type: application/json');
                echo json_encode($errorData);
            }
            break;
        case 'getCartItems':
            if (isset($_GET['user_id'])) {
                $dbHelper->connect();
                $user_id = $_GET['user_id'];
        
                $cartItems = getCartItems($dbHelper, $user_id);
        
                header('Content-Type: application/json');
        
                echo json_encode(['cartItems' => $cartItems]);
            } else {
                $errorData = array(
                    'error' => "'user_id' parameter not found in the GET request."
                );
                header('Content-Type: application/json');
                echo json_encode($errorData);
            }
            break;   
        case 'getOrders':
            $dbHelper->connect();
        
            $orders = getOrders($dbHelper);
            $ordersJSON = json_encode(['orders' => $orders]);
        
            header('Content-Type: application/json');
            echo $ordersJSON;
            break;
        
        case 'getOrderItems':
            if (isset($_GET['order_id'])) {
                $order_id = $_GET['order_id'];
                $dbHelper->connect();
        
                $orderItems = getOrderItems($dbHelper, $order_id);
                $orderItemsJSON = json_encode(['orderItems' => $orderItems]);
        
                header('Content-Type: application/json');
                echo $orderItemsJSON;
            } else {
                echo json_encode(['error' => 'Missing order_id parameter']);
            }
            break;
        case 'getOrdersByUserId':
            if (isset($_GET['user_id'])) {
                $user_id = $_GET['user_id'];
                $dbHelper->connect();
        
                $orders = getOrdersByUserId($dbHelper, $user_id);
                $ordersJSON = json_encode(['orders' => $orders]);
        
                header('Content-Type: application/json');
                echo $ordersJSON;
            } else {
                echo json_encode(['error' => 'Missing user_id parameter']);
            }
            break;
        case 'findUserById':
            if (isset($_GET['user_id'])) {
                $dbHelper->connect();
                $user_id = $_GET['user_id'];
                $user = findUserById($dbHelper, $user_id);
        
                header('Content-Type: application/json');
        
                echo json_encode(['user' => $user]);
            } else {
                $errorData = [
                    'error' => "'user_id' parameter not found in the GET request."
                ];
                header('Content-Type: application/json');
                http_response_code(400); 
                echo json_encode($errorData);
            }
            break;
            
    }
} else {
    $errorData = array(
        'error' => "No 'action' parameter found in the GET request."
    );
    header('Content-Type: application/json');
    echo json_encode($errorData);
}

function getProducts($dbHelper) {
    try {
        $stmt = $dbHelper->prepare("SELECT * FROM products");
        $stmt->execute();

        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $products;
    } catch (PDOException $e) {
        $errorData = array(
            'error' => "Error: " . $e->getMessage()
        );

        return $errorData;
    }
}

function findProductById($dbHelper, $product_id) {
    try {
        $stmt = $dbHelper->prepare("SELECT * FROM products WHERE product_id = :product_id");
        $stmt->bindParam(':product_id', $product_id);
        $stmt->execute();
        $product = $stmt->fetch(PDO::FETCH_ASSOC);
        return $product;
    } catch (PDOException $e) {
        $errorData = array(
            'error' => "Error: " . $e->getMessage()
        );
        return $errorData;
    }
}

function findUserById($dbHelper, $user_id) {
    try {
        $stmt = $dbHelper->prepare("SELECT * FROM users WHERE user_id = :user_id");
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user;
    } catch (PDOException $e) {
        $errorData = array(
            'error' => "Error: " . $e->getMessage()
        );
        return $errorData;
    }
}


function findCartByUserId($dbHelper, $user_id) {
    try {
        $stmt = $dbHelper->prepare("SELECT cart_id FROM cart WHERE user_id = :user_id");
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        $cart = $stmt->fetch(PDO::FETCH_ASSOC);
        return $cart;
    } catch (PDOException $e) {
        $errorData = array(
            'error' => "Error: " . $e->getMessage()
        );
        return $errorData;
    }
}

function getCartItems($dbHelper, $user_id){
    try {
        $cart = findCartByUserId($dbHelper, $user_id);

        if (!$cart) {
            return array('error' => 'Cart not found for the user.');
        }

        $stmt = $dbHelper->prepare("SELECT cart_item_id, product_id, quantity FROM cartItems WHERE cart_id = :cart_id");
        $stmt->bindParam(':cart_id', $cart['cart_id']);
        $stmt->execute();
        $cartItems = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $cartItems;
    } catch (PDOException $e) {
        $errorData = array('error' => 'Error: ' . $e->getMessage());
        return $errorData;
    }
}

function getOrders($dbHelper) {
    try {
        $stmt = $dbHelper->prepare("SELECT * FROM orders");
        $stmt->execute();

        $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $orders;
    } catch (PDOException $e) {
        $errorData = array(
            'error' => "Error: " . $e->getMessage()
        );

        return $errorData;
    }
}

function getOrderItems($dbHelper, $order_id) {
    try {
        $stmt = $dbHelper->prepare("SELECT * FROM orderitems WHERE order_id = :order_id");
        $stmt->bindParam(':order_id', $order_id);
        $stmt->execute();
        $orderItems = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $orderItems;
    } catch (PDOException $e) {
        return ['error' => 'Error fetching order items: ' . $e->getMessage()];
    }
}

function getOrdersByUserId($dbHelper, $user_id) {
    $getOrdersStmt = $dbHelper->prepare("SELECT * FROM orders WHERE user_id = :user_id");
    $getOrdersStmt->bindParam(':user_id', $user_id);
    $getOrdersStmt->execute();

    $orders = $getOrdersStmt->fetchAll(PDO::FETCH_ASSOC);

    return $orders;
}
?>