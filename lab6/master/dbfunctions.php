<?php 
    include_once($_SERVER['DOCUMENT_ROOT'] . "/lab6/master/dbcontroller.php");

    // User functions

    // Check if email is already in use
    function checkEmail($email) {
        try {
            $isTaken = false;

            global $db;

            $sql  = "SELECT email ";
            $sql .= "FROM users ";
            $sql .= "WHERE email = :email;";

            $stmt = $db->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            if($stmt->rowCount()) $isTaken = true;

            return $isTaken;

        } catch(PDOException $e) { die("Failed to check for email"); }
    }

    // Validate entered user credentials are correct
    function validateUser($email, $guess) {
        global $db;
        try {
            $sql  = "SELECT user_id, password ";
            $sql .= "FROM users ";
            $sql .= "WHERE email = :email;";

            $stmt = $db->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            $results = $stmt->fetch(PDO::FETCH_ASSOC);
            var_dump($results);
            
            if(password_verify($guess, $results['password']))
                $user = $results['user_id'];
            else $user = NULL;

            return $user;

        } catch(PDOException $e) { die("Failed to validate user info"); }
    }

    // Get extended user information
    function getUserInfo($id) {
        global $db;
        try {
            $sql  = "SELECT * ";
            $sql .= "FROM userinfo ";
            $sql .= "WHERE user_id = :uId;";

            $stmt = $db->prepare($sql);
            $stmt->bindParam(':uId', $id);
            $stmt->execute();

            $results = $stmt->fetch(PDO::FETCH_ASSOC);
            return $results;

        } catch(PDOException $e) { die("Failed to retrieve user information"); }
    }

    // Create a new user
    function addUser($email, $hash, $fName, $lName, $adminId) {
        global $db;
        try {
            $sql  = "INSERT INTO `users` (email, password, created) ";
            $sql .= "VALUES (:email, :hash, NOW());";

            $stmt = $db->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':hash', $hash);
            $stmt->execute();

            if(!$stmt->rowCount()) die("Cannot add user to db");

            $newId = $db->lastInsertId();
            $sql = '';
            $sql  = "INSERT INTO `userinfo` ";
            $sql .= "VALUES (:id, :firstName, :lastName, :adminId);";

            $stmt = $db->prepare($sql);
            $stmt->bindParam(':id', $newId);
            $stmt->bindParam(':firstName', $fName);
            $stmt->bindParam(':lastName', $lName);
            $stmt->bindParam(':adminId', $adminId);
            $stmt->execute();

            if(!$stmt->rowCount()) {
                removeUserById($newId);
                die("Failed to add user information");
            }

            return $newId;

        } catch(PDOException $e) { die("Failed to create user"); }
    }

    // Verify user is registering as a valid pending administrator
    // Based on can_register and admin_id in table admins
    function verifyAdmin($adminId) {
        try {
		    $allow = false;
            
		    global $db;
		    $sql  = "SELECT admin_id, can_register ";
		    $sql .= "FROM `admins` ";
		    $sql .= "WHERE admin_id = :adminId;";
            
		    $stmt = $db->prepare($sql);
		    $stmt->bindParam(':adminId', $adminId);
		    $stmt->execute();
            
		    $results = $stmt->fetch(PDO::FETCH_ASSOC);
		    if($results && $results['can_register'])
		    	$allow = true;
            
            return $allow;

        } catch(PDOException $e) { die("Failed to verify admin status"); }
    }

    // Set if an admin can register their account
    function updateAdminStatus($adminId, $userId, $canRegister = false) {
        try {
            global $db;
            $sql  = "UPDATE `admins` ";
            $sql .= "SET user_id = :userId, can_register = :canRegister ";
            $sql .= "WHERE admin_id = :adminId;";

            $stmt = $db->prepare($sql);
            $stmt->bindParam(':userId', $userId);
            $stmt->bindParam(':adminId', $adminId);
            $stmt->bindParam(':canRegister', $canRegister);
            $stmt->execute();

            return $stmt->rowCount();

        } catch(PDOException $e) { die("Failed setting admin status"); }
    }

    // Remove user, not used
    function removeUserById($id) {
        global $db;
        try {
            $sql  = "DELETE FROM `users` WHERE user_id = :id;";

            $stmt = $db->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            $sql = "DELETE FROM `userinfo` WHERE user_id = :id;";

            $stmt = $db->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            return $stmt->rowCount();

        } catch(PDOException $e) { die("Failed to remove row"); }
    }

    // Order functions

    // Cehckout user, add information to orders/orderitems
    function checkout($cart, $userId) {
        try {
            global $db;

            $sql  = "INSERT INTO `orders` (user_id, shipping_date) ";
            $sql .= "VALUES(:userId, NOW());";

            $stmt = $db->prepare($sql);
            $stmt->bindParam(':userId', $userId);
            $stmt->execute();

            if(!$stmt->rowCount()) die("Failed adding order (1)");
            $orderId = $db->lastInsertId();

            foreach($cart as $line) {
                $sql  = "INSERT INTO `orderitems` (order_id, product_id, qty, price_paid) ";
                $sql .= "VALUES(:orderId, :productId, :qty, :price);";

                $stmt = $db->prepare($sql);
                $stmt->bindParam(':orderId', $orderId);
                $stmt->bindParam(':productId', $line['productId']);
                $stmt->bindParam(':qty', $line['qty']);
                $stmt->bindParam(':price', $line['price']);
                $stmt->execute();

                if(!$stmt->rowCount()) echo "Warning: failed to add item";
            }

            return $stmt->rowCount();

        } catch(PDOException $e) { die("Failed to checkout, sorry 'bout that (not really)"); }
    }

    // Get global list of orders, filter by user id if specified
    function getOrders($userId = NULL) {
        try {
            global $db;

            $sql  = "SELECT order_id, user_id, shipping_date ";
            $sql .= "FROM `orders`";
            if($userId) $sql .= " WHERE user_id = :userId";
            $sql .= ';';

            $stmt = $db->prepare($sql);
            if($userId) $stmt->bindParam(':userId', $userId);
            $stmt->execute();

            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $results;

        } catch(PDOException $e) {die("Failed to retrieve order list"); }
    }

    // Get order information
    function getOrderLines($orderId) {
        try {
            global $db;

            $sql  = "SELECT product_id, qty ";
            $sql .= "FROM `orderitems` ";
            $sql .= "WHERE order_id = :orderId;";

            $stmt = $db->prepare($sql);
            $stmt->bindParam(':orderId', $orderId, PDO::PARAM_INT);
            $stmt->execute();

            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $results;

        }catch(PDOException $e) { die("Failed to get order information"); }
    }

    // Product functions (consider moving to seperate file)

    // Get list of product categories
    function getCategories() {
        try {
            global $db;

            $sql  = "SELECT category_id, category ";
            $sql .= "FROM `categories` ";
            $sql .= "ORDER BY category_id ASC;";

            $stmt = $db->prepare($sql);
            $stmt->execute();

            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $results;

        } catch(PDOException $e) { die("Failed to get category list"); }
    }

    // Get products in a specific category only
    function getProductsByCategory($catId) {
        try {
            global $db;

            $sql  = "SELECT product_id, product, image ";
            $sql .= "FROM `products` ";
            $sql .= "WHERE category_id = :catId;";

            $stmt = $db->prepare($sql);
            $stmt->bindParam(':catId', $catId);
            $stmt->execute();

            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $results;

        } catch(PDOException $e) { die("Failed to get category products"); }
    }

    // Get list of all da products
    function getProductList() {
        try {
            global $db;

            $sql  = "SELECT product_id, product, image ";
            $sql .= "FROM `products`;";

            $stmt = $db->prepare($sql);
            $stmt->execute();

            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $results;

        } catch (PDOException $e) { die("Failed to get product listings"); };
    }

    // Get extended product information
    function getProductInfo($productId) {
        try {
            global $db;

            $sql  = "SELECT * ";
            $sql .= "FROM `products` ";
            $sql .= "WHERE product_id = :productId;";

            $stmt = $db->prepare($sql);
            $stmt->bindParam(':productId', $productId);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);

        } catch(PDOException $e) { die("Failed to get product information"); }
    }

    // Create a new product category
    function addCategory($catName) {
        try {
            global $db;

            $sql  = "INSERT INTO `categories` (category) ";
            $sql .= "VALUES (:catName);";

            $stmt = $db->prepare($sql);
            $stmt->bindParam(':catName', $catName);
            $stmt->execute();

            return $stmt->rowCount();

        } catch(PDOException $e) { die("Failed to add category"); }
    }

    // Update existing product category
    function updateCategory($catId, $catName) {
        try {
            global $db;

            $sql  = "UPDATE `categories` ";
            $sql .= "SET category = :catName ";
            $sql .= "WHERE category_id = :catId;";

            $stmt = $db->prepare($sql);
            $stmt->bindParam('catId', $catId);
            $stmt->bindParam(':catName', $catName);
            $stmt->execute();

            return $stmt->rowCount();

        } catch(PDOException $e) { die("Failed to update category"); }
    }

    // Delete a category if empty, otherwise return an error
    function deleteCategory($catId) {
        try {
            global $db;

            $sql  = "SELECT category_id ";
            $sql .= "FROM `products` ";
            $sql .= "WHERE category_id = :catId;";

            $stmt = $db->prepare($sql);
            $stmt->bindParam(':catId', $catId);
            $stmt->execute();

            if($stmt->rowCount()) return 'err_cat_not_empty';
            
            $sql  = "DELETE FROM `categories` ";
            $sql .= "WHERE category_id = :catId";

            $stmt = $db->prepare($sql);
            $stmt->bindParam(':catId', $catId);
            $stmt->execute();

            return $stmt->rowCount();

        } catch(PDOException $e) { die("Failed to delete category"); }
    }

    // Add a new product
    function addProduct($prodName, $price, $image, $categoryId) {
        try {
            global $db;

            $sql  = "INSERT INTO `products` (product, price, image, category_id) ";
            $sql .= "VALUES (:prodName, :price, :image, :categoryId);";

            $stmt = $db->prepare($sql);
            $stmt->bindParam(':prodName', $prodName);
            $stmt->bindParam(':price', $price);
            $stmt->bindParam(':image', $image);
            $stmt->bindParam(':categoryId', $categoryId);
            $stmt->execute();

            return $stmt->rowCount();

        } catch(PDOException $e) { die("Failed to add product"); }
    }

    // Delete a product
    function deleteProduct($prodId) {
        try {
            global $db;

            $sql  = "DELETE FROM `products` ";
            $sql .= "WHERE product_id = :prodId";

            $stmt = $db->prepare($sql);
            $stmt->bindParam(':prodId', $prodId);
            $stmt->execute();

            return $stmt->rowCount();

        } catch(PDOException $e) { die("Failed to delete product"); }
    }

    // Update a product
    function updateProductInfo($productId, $name, $price, $image, $catId) {
        try {
            global $db;

            $sql  = "UPDATE `products` ";
            $sql .= "SET product = :prodName, price = :price, image = :image, category_id = :catId ";
            $sql .= "WHERE product_id = :prodId;";

            $stmt = $db->prepare($sql);
            $stmt->bindParam(':prodName', $name);
            $stmt->bindParam(':price', $price);
            $stmt->bindParam(':image', $image);
            $stmt->bindParam(':catId', $catId);
            $stmt->bindParam(':prodId', $productId);
            $stmt->execute();

            return $stmt->rowCount();

        } catch(PDOException $e) { die("Failed to update product"); }
    }
?>