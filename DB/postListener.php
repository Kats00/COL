<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once '../Models/DBHelper.php';
require_once '../DB/getListener.php';

global $db_host, $db_username, $db_pass, $db_name, $dbHelper;

$db_pass = "";
$db_host = "localhost";
$db_name = "colorsoflife";
$db_username = "root";
$dbHelper = new DBHelper($db_host, $db_username, $db_pass, $db_name);

$dbHelper->connect();

if (isset($_POST['form_action'])){
    switch ($_POST['form_action']) {
        case 'register':
            session_start();
            $email = $_POST['signup_email'];
            $password = $_POST['signup_password'];
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $contact_num = $_POST['contact_num'];
            $address = $_POST['address'];
            $user_type = $_POST['user_type'];
            
            if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == 0) {
                $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/COL/assets/Uploads/';
                $uploadFile = $uploadDir . basename($_FILES['profile_picture']['name']);
                move_uploaded_file($_FILES['profile_picture']['tmp_name'], $uploadFile);
                $profile_picture = basename($_FILES['profile_picture']['name']);
            } else {
                $profile_picture = 'noPic.png'; 
            }
        
            $result = registerUser($dbHelper, $first_name, $last_name, $email, $password, $contact_num, $address, $user_type, $profile_picture);
        
            if ($result === true) {
                echo "User registered successfully!";
            } else {
                echo $result;
            }
            break;                
        case 'editProfile':
            session_start();
            $user_id = $_SESSION['user_id']; 
            
            if (isset($_POST['first_name'], $_POST['last_name'], $_POST['contact_num'], $_POST['address'])) {
                $first_name = $_POST['first_name'];
                $last_name = $_POST['last_name'];
                $contact_num = $_POST['contact_num'];
                $address = $_POST['address'];
                $password = $_POST['password'];
                $confirm_password = $_POST['password_confirm'];
            
                if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == 0) {
                    $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/COL/assets/Uploads/';
                    $uploadFile = $uploadDir . basename($_FILES['profile_picture']['name']);
                    move_uploaded_file($_FILES['profile_picture']['tmp_name'], $uploadFile);
                    $profile_picture = basename($_FILES['profile_picture']['name']);
                } else {
                    $profile_picture = 'noPic.png'; 
                }
            
                if ($password == $confirm_password) {
                    $result = updateUserProfile($dbHelper, $user_id, $first_name, $last_name, $contact_num, $address, $password, $profile_picture);
            
                    if ($result === true) {
                        header('Location: ../?filename=profile');
                    } else {
                        echo $result;
                    }
                } else {
                    echo "Passwords do not match";
                }
            } else {
                echo "Missing required parameters for profile update.";
            }
            break;
        
        case 'signin':
            session_start();
            $email = $_POST['login_email'];
            $password = $_POST['login_password'];
        
            $user = authenticateUser($dbHelper, $email, $password);
        
            if ($user) {

                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['role'] = $user['user_type'];
            
                echo "User ID: " . $user['user_id'] . ", role: " . $user['user_type'] . "<br>";
            
                header('Location: ../?filename=home'); 
                exit();
            } else {
                echo "Invalid email or password. Please try again.";
            }
            
            break;
            
        case 'sendMessage':
            $name = $_POST['name'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $address = $_POST['address'];
            $subject = $_POST['subject'];
            $message = $_POST['message'];

            $result = sendMessage($dbHelper, $name, $email, $phone, $address, $subject, $message);

            if ($result === true) {
                echo "Message sent successfully!";
            } else {
                echo $result;
            }
            break;
        case 'addProduct':
            $product_name = $_POST['product_name'];
            $product_price = $_POST['product_price'];
            $product_qty = $_POST['product_qty'];
            $product_description = $_POST['product_description'];
            $product_for = $_POST['product_for'];
        
            if (isset($_FILES['product_picture']) && $_FILES['product_picture']['error'] === UPLOAD_ERR_OK) {
                $product_picture = file_get_contents($_FILES['product_picture']['tmp_name']);
            } else {
                echo "Error: Failed to upload product picture.";
                exit;
            }
        
            $result = addProduct($dbHelper, $product_name, $product_price, $product_qty, $product_description, $product_for, $product_picture);
        
            if ($result === true) {
                echo $product_for;
            } else {
                echo $result;
            }
            break;
            
        case 'editProduct':
            $product_id = $_POST['edit_product_id'];
            $product_name = $_POST['edit_product_name'];
            $product_price = $_POST['edit_product_price'];
            $product_qty = $_POST['edit_product_qty'];
            $product_description = $_POST['edit_product_description'];
            if (isset($_FILES['edit_product_picture']) && $_FILES['edit_product_picture']['error'] == 0) {
                $result = editProduct($dbHelper, $product_id, $product_name, $product_price, $product_qty, $product_description, $_FILES['edit_product_picture']);
            } else {
                $result = editProduct($dbHelper, $product_id, $product_name, $product_price, $product_qty, $product_description);
            }
                if ($result === true) {
                echo "edited product successfully!";
            } else {
                echo $result;
            }
            break;
        case 'deleteProduct':
            $product_id = $_POST['delete_product_id'];
            $result = deleteProduct($dbHelper, $product_id);
            
            if ($result === true) {
                echo "deleted product successfully!";
            } else {
                echo $result;
            }
            break;
        case 'addToCart':
            $productId = $_POST['product_id'];
            $quantity = $_POST['quantity'];
            $userId = $_POST['user_id'];
         
            $success = addToCart($dbHelper, $userId, $productId, $quantity);
        
            header('Content-Type: application/json'); 
        
            error_log("Add to Cart Success: " . ($success ? 'Yes' : 'No'));
        
            echo json_encode(['success' => $success]);
            break;
        case 'removeCartItem':
            $cart_item_id = $_POST['cart_item_id'];
            $result = removeCartItem($dbHelper, $cart_item_id);
            
            if ($result === true) {
                echo "removed item successfully!";
            } else {
                echo $result;
            }
            break;     

        case 'addOrderItems':
            $user_id = $_POST['user_id'];
            
            $cartItems = json_decode($_POST['cartItems'], true);
        
            foreach ($cartItems as $item) {
                $product_id = $item['product_id'];
                $quantity = $item['quantity'];
        
                $result = addOrderItem($dbHelper, $user_id, $product_id, $quantity);
        
                if ($result !== true) {
                    error_log("Error in addOrderItem function: " . $result);
                }
            }
        
            echo 'Order items added successfully';
            break;
        case 'changeStatus':
            if (isset($_POST['order_id']) && isset($_POST['newStatus'])) {
                $order_id = $_POST['order_id'];
                $newStatus = $_POST['newStatus'];
        
                $result = changeStatus($dbHelper, $order_id, $newStatus);
                
                if ($result === true) {
                    echo "removed item successfully!";
                } else {
                    echo $result;
                }
            }
            break;
    }
}

function registerUser($dbHelper, $first_name, $last_name, $email, $password, $contact_num, $address, $user_type, $profile_picture) {
    try {
        $checkStmt = $dbHelper->prepare("SELECT COUNT(*) FROM users WHERE email = :email");
        $checkStmt->bindParam(':email', $email);
        $checkStmt->execute();
        $count = $checkStmt->fetchColumn();

        if ($count > 0) {
            return "Error: Email is already registered.";
        }

        $insertStmt = $dbHelper->prepare("INSERT INTO users (first_name, last_name, email, password, contact_num, address, user_type, profile_picture) VALUES (:first_name, :last_name, :email, :password, :contact_num, :address, :user_type, :profile_picture)");

        $insertStmt->bindParam(':first_name', $first_name);
        $insertStmt->bindParam(':last_name', $last_name);
        $insertStmt->bindParam(':email', $email);
        $insertStmt->bindParam(':password', $password); 
        $insertStmt->bindParam(':contact_num', $contact_num);
        $insertStmt->bindParam(':address', $address);
        $insertStmt->bindParam(':user_type', $user_type);
        $insertStmt->bindParam(':profile_picture', $profile_picture);

        if ($insertStmt->execute()) {
            header('Location: ../?filename=signin');
            exit();
        } else {
            return "Error: " . implode(", ", $insertStmt->errorInfo()); 
        }
    } catch (PDOException $e) {
        return "Error: " . $e->getMessage();
    }
}



function authenticateUser($dbHelper, $email, $password) {
    try {
        $stmt = $dbHelper->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            if ($password === $user['password']) {
                makeCart($dbHelper, $user['user_id']);
                return $user; 
            } else {
                echo "Invalid password. Please try again.<br>";
                return false; 
            }
        } else {
            echo "User not found.<br>";
            return false;
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage() . "<br>";
        return false;
    }
}



function sendMessage($dbHelper, $name, $email, $phone, $address, $subject, $message) {
    try {
        $stmt = $dbHelper->prepare("INSERT INTO messages (name, email, phone, address, subject, message) 
                                   VALUES (:name, :email, :phone, :address, :subject, :message)");

        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':subject', $subject);
        $stmt->bindParam(':message', $message);

        if ($stmt->execute()) {
            header('Location: ../?filename=questions');
        } else {
            return "Error: " . implode(", ", $stmt->errorInfo());  
        }
    } catch (PDOException $e) {
        return "Error: " . $e->getMessage();
    }
}

/*======================================================================================================================*/

function addProduct($dbHelper, $product_name, $product_price, $product_qty, $product_description, $product_for) {
    try {
        if (isset($_FILES['product_picture']) && $_FILES['product_picture']['error'] == 0) {
            $uploadDir =  $_SERVER['DOCUMENT_ROOT'] . '/COL/assets/Uploads/'; 
            $uploadFile = $uploadDir . basename($_FILES['product_picture']['name']);

            if (move_uploaded_file($_FILES['product_picture']['tmp_name'], $uploadFile)) {

                $insertStmt = $dbHelper->prepare("INSERT INTO products (product_name, product_price, product_qty, product_description, product_for, product_picture) VALUES (:product_name, :product_price, :product_qty, :product_description, :product_for, :product_picture)");

                $insertStmt->bindParam(':product_name', $product_name);
                $insertStmt->bindParam(':product_price', $product_price);
                $insertStmt->bindParam(':product_qty', $product_qty);
                $insertStmt->bindParam(':product_description', $product_description);
                $insertStmt->bindParam(':product_for', $product_for);
                $insertStmt->bindParam(':product_picture', basename($_FILES['product_picture']['name']));

                if ($insertStmt->execute()) {
                    header('Location: ../?filename=donate');
                } else {
                    return "Error: " . implode(", ", $insertStmt->errorInfo());
                }
            } else {
                return "Error: Failed to move the uploaded file.";
            }
        } else {
            return "Error: File upload failed or no file was uploaded.";
        }
    } catch (PDOException $e) {
        return "Error: " . $e->getMessage();
    }
}



function editProduct($dbHelper, $product_id, $product_name, $product_price, $product_qty, $product_description) {
    try {
        $updateStmt = $dbHelper->prepare("UPDATE products SET product_name = :product_name, product_price = :product_price, product_qty = :product_qty, product_description = :product_description, product_picture = :product_picture WHERE product_id = :product_id");

        $updateStmt->bindParam(':product_id', $product_id);
        $updateStmt->bindParam(':product_name', $product_name);
        $updateStmt->bindParam(':product_price', $product_price);
        $updateStmt->bindParam(':product_qty', $product_qty);
        $updateStmt->bindParam(':product_description', $product_description);

        if (isset($_FILES['edit_product_picture']) && $_FILES['edit_product_picture']['error'] == 0) {
            $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/COL/assets/Uploads/';
            $uploadFile = $uploadDir . basename($_FILES['edit_product_picture']['name']);
            move_uploaded_file($_FILES['edit_product_picture']['tmp_name'], $uploadFile);

            $updateStmt->bindParam(':product_picture', basename($_FILES['edit_product_picture']['name']));
        }

        if ($updateStmt->execute()) {
            return true;
        } else {
            return "Error: " . implode(", ", $updateStmt->errorInfo());
        }
    } catch (PDOException $e) {
        return "Error: " . $e->getMessage();
    }
}


function deleteProduct($dbHelper, $product_id) {
    try {
        $deleteStmt = $dbHelper->prepare("DELETE FROM products WHERE product_id = :product_id");
        $deleteStmt->bindParam(':product_id', $product_id);

        if ($deleteStmt->execute()) {
            return true;
        } else {
            return "Error: " . implode(", ", $deleteStmt->errorInfo());
        }
    } catch (PDOException $e) {
        return "Error: " . $e->getMessage();
    }
}

/*======================================================================================================================*/
function makeCart($dbHelper, $user_id) {
    try {
        $checkCartStmt = $dbHelper->prepare("SELECT * FROM cart WHERE user_id = :user_id");
        $checkCartStmt->bindParam(':user_id', $user_id);
        $checkCartStmt->execute();

        if ($checkCartStmt->rowCount() === 0) {
            $createCartStmt = $dbHelper->prepare("INSERT INTO cart (user_id, date_created) VALUES (:user_id, NOW())");
            $createCartStmt->bindParam(':user_id', $user_id);
            $createCartStmt->execute();
        }

        return true;
    } catch (PDOException $e) {
        return "Error: " . $e->getMessage();
    }
}

function addToCart($dbHelper, $user_id, $product_id, $quantity) {
    try {
        makeCart($dbHelper, $user_id);

        $cart = findCartByUserId($dbHelper, $user_id);

        if (!$cart) {
            echo json_encode(['success' => false, 'error' => 'Error: Cart not found for the user.']);
            exit();
        }

        $stmt = $dbHelper->prepare("INSERT INTO cartItems (cart_id, product_id, quantity) VALUES (:cart_id, :product_id, :quantity)");
        $stmt->bindParam(':cart_id', $cart['cart_id']);
        $stmt->bindParam(':product_id', $product_id);
        $stmt->bindParam(':quantity', $quantity);
        $stmt->execute();

        echo json_encode(['success' => true]);
        exit();
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'error' => 'Error: ' . $e->getMessage()]);
        exit();
    }
}

function removeCartItem($dbHelper, $cart_item_id) {
    try {
        $deleteStmt = $dbHelper->prepare("DELETE FROM cartitems WHERE cart_item_id = :cart_item_id");
        $deleteStmt->bindParam(':cart_item_id', $cart_item_id);

        if ($deleteStmt->execute()) {
            return true;
        } else {
            return "Error: " . implode(", ", $deleteStmt->errorInfo());
        }
    } catch (PDOException $e) {
        return "Error: " . $e->getMessage();
    }
}

/*======================================================================================================================*/

function addOrderItem($dbHelper, $user_id, $product_id, $quantity) {
    try {
        $openOrderStmt = $dbHelper->prepare("SELECT * FROM orders WHERE user_id = :user_id AND status = 'open'");
        $openOrderStmt->bindParam(':user_id', $user_id);
        $openOrderStmt->execute();
        $existingOrder = $openOrderStmt->fetch(PDO::FETCH_ASSOC);

        if (!$existingOrder) {
            $createOrderStmt = $dbHelper->prepare("INSERT INTO orders (user_id, date_ordered, status) VALUES (:user_id, NOW(), 'open')");
            $createOrderStmt->bindParam(':user_id', $user_id);
            $createOrderStmt->execute();

            $order_id = $dbHelper->lastInsertId();
        } else {
            $order_id = $existingOrder['order_id'];
        }

        $product = findProductById($dbHelper, $product_id);
        if (!empty($product) && !isset($product['error'])) {
            $product_price = $product['product_price'];
        } else {
            $product_price = 0;
        }

        $price = $product_price * $quantity;

        $addProductStmt = $dbHelper->prepare("INSERT INTO orderitems (order_id, product_id, quantity, price) VALUES (:order_id, :product_id, :quantity, :price)");
        $addProductStmt->bindParam(':order_id', $order_id);
        $addProductStmt->bindParam(':product_id', $product_id);
        $addProductStmt->bindParam(':quantity', $quantity);
        $addProductStmt->bindParam(':price', $price);

        $addProductStmt->execute();

        return true;
    } catch (PDOException $e) {
        error_log("Error in addOrderItem function: " . $e->getMessage());
        return false;
    }
}

function changeStatus($dbHelper, $order_id, $newStatus) {
    try {
        $updateStatusStmt = $dbHelper->prepare("UPDATE orders SET status = :newStatus WHERE order_id = :order_id");
        $updateStatusStmt->bindParam(':newStatus', $newStatus);
        $updateStatusStmt->bindParam(':order_id', $order_id);
        $updateStatusStmt->execute();

        return true;
    } catch (PDOException $e) {
        error_log("Error in changeStatus function: " . $e->getMessage());
        return false;
    }
}

function updateUserProfile($dbHelper, $user_id, $first_name, $last_name, $contact_num, $address, $password, $profile_picture) {
    try {
        $updateProfileStmt = $dbHelper->prepare("UPDATE users SET first_name = :first_name, last_name = :last_name, contact_num = :contact_num, address = :address, profile_picture = :profile_picture WHERE user_id = :user_id");

        $updateProfileStmt->bindParam(':user_id', $user_id);
        $updateProfileStmt->bindParam(':first_name', $first_name);
        $updateProfileStmt->bindParam(':last_name', $last_name);
        $updateProfileStmt->bindParam(':contact_num', $contact_num);
        $updateProfileStmt->bindParam(':address', $address);
        $updateProfileStmt->bindParam(':profile_picture', $profile_picture);

        $updateProfileStmt->execute();

        return true; 
    } catch (PDOException $e) {
        error_log("Error in updateUserProfile function: " . $e->getMessage());
        return "Failed to update profile.";
    }
}
