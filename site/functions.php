<?php

$dbname = 'choirs';
$dbuser = 'root';
$dbpass = '';
$dbhost = 'localhost';

$db = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

if (!$db) {
    echo "Error Connecting to Database";
}
session_start();

function signup($data)
{
    global $db;
    $password = md5($data["password"]);
    $sql = "insert into users(fname, lname, email, password, type) values(?,?,?,?,?)";
    $stmt = $db->prepare($sql);
    $stmt->bind_param("sssss", $data["fname"], $data["lname"], $data["email"], $password, $data["type"]);
    if ($stmt->execute()) {
        return 1;
    }
    return 0;
}

function email_exists($email)
{
    global $db;
    $sql = "select * from users where email = ?";
    $stmt = $db->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    if (mysqli_num_rows($result)) {
        return 1;
    }
    return 0;
}

function login($data)
{
    global $db;
    $sql = "select * from users where email = ?";
    $stmt = $db->prepare($sql);
    $stmt->bind_param("s", $data["email"]);
    $stmt->execute();
    $result = $stmt->get_result();
    if (mysqli_num_rows($result)) {
        while ($row = $result->fetch_assoc()) {
            if ($row["password"] == md5($data["password"])) {
                $_SESSION["u_id"] = $row["u_id"];
                $_SESSION["fname"] = $row["fname"];
                $_SESSION["lname"] = $row["lname"];
                $_SESSION["email"] = $row["email"];
                $_SESSION["type"] = $row["type"];
                return 1;
            } else {
                return 0;
            }
        }
    }
    return 0;
}

function get_drinks()
{
    global $db;
    $sql = "select * from drinks";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result;
}

function add_drink($data)
{
    global $db;
    $sql = "insert into drinks(name, description, price, image) values(?,?,?,?)";
    $stmt = $db->prepare($sql);
    $stmt->bind_param("ssss", $data["name"], $data["description"], $data["price"], $data["image"]);
    if ($stmt->execute()) {
        return 1;
    }
    return 0;
}

function edit_drink($data)
{
    global $db;
    $sql = "update drinks set name = ?, description = ?, price = ?, image = ? where d_id = ?";
    $stmt = $db->prepare($sql);
    $stmt->bind_param("sssss", $data["name"], $data["description"], $data["price"], $data["image"], $data['d_id']);
    if ($stmt->execute()) {
        return 1;
    }
    return 0;
}

function delete_drink($id)
{
    global $db;
    $sql = "delete from drinks where d_id = ?";
    $stmt = $db->prepare($sql);
    $stmt->bind_param("s", $id);
    if ($stmt->execute()) {
        return 1;
    }
    return 0;
}

function get_drink($id)
{
    global $db;
    $sql = "select * from drinks where d_id = ?";
    $stmt = $db->prepare($sql);
    $stmt->bind_param("s", $id);
    $stmt->execute();
    return $stmt->get_result();
}

function get_users()
{
    global $db;
    $id = $_SESSION['u_id'];
    $sql = "select * from users";
    $stmt = $db->prepare($sql);
    // $stmt->bind_param("s", $id);
    $stmt->execute();
    return $stmt->get_result();
}

function get_user($id)
{
    global $db;
    $sql = "select * from users where u_id = ?";
    $stmt = $db->prepare($sql);
    $stmt->bind_param("s", $id);
    $stmt->execute();
    return $stmt->get_result();
}

function edit_user($data)
{
    global $db;
    $password = md5($data['password']);
    $sql = "update users set fname = ?, lname = ?, email = ?, password = ? where u_id = ?";
    $stmt = $db->prepare($sql);
    $stmt->bind_param('sssss', $data['fname'], $data['lname'], $data['email'], $password, $data['u_id']);
    if ($stmt->execute()) {
        return 1;
    }
    return 0;
}

function delete_user($id)
{
    global $db;
    $sql = "delete from users where u_id = ?";
    $stmt = $db->prepare($sql);
    $stmt->bind_param("s", $id);
    if ($stmt->execute()) {
        return 1;
    }
    return 0;
}

function add_to_cart($item, $quantity)
{
    if (isset($_SESSION["cart"])) {
        $cart = $_SESSION["cart"];
    } else {
        $cart = [];
    }

    if (array_key_exists($item, $cart)) {
        $tmpqty = $cart[$item] + $quantity;
        unset($cart[$item]);
        $cart[$item] = $tmpqty;
        $_SESSION["cart"] = $cart;
    } else {
        $cart[$item] = $quantity;
        $_SESSION["cart"] = $cart;
    }

    return 1;
}

function update_to_cart($item, $quantity)
{
    if (isset($_SESSION["cart"])) {
        $cart = $_SESSION["cart"];
    } else {
        $cart = [];
    }

    if (array_key_exists($item, $cart)) {
        $tmpqty = $quantity;
        unset($cart[$item]);
        $cart[$item] = $tmpqty;
        $_SESSION["cart"] = $cart;
    }

    return 1;
}

function remove_from_cart($item)
{
    if (isset($_SESSION["cart"])) {
        $cart = $_SESSION["cart"];
    } else {
        $cart = [];
    }
    unset($cart[$item]);
    $_SESSION["cart"] = $cart;
    return 1;
}

function get_cart()
{
    if (isset($_SESSION["cart"])) {
        return $_SESSION["cart"];
    }
    return [];
}

function get_drinks_by_ids($ids)
{
    global $db;
    $id_str = implode("', '", array_keys($ids));
    $sql = "select * from drinks where d_id in ('" . $id_str . "')";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result;
}

function get_total()
{
    $cart = get_cart();
    $drinks = get_drinks_by_ids($cart);
    $total = 0;
    if (mysqli_num_rows($drinks)) {
        while ($row = $drinks->fetch_assoc()) {
            $total += $cart[$row["d_id"]] * $row["price"];
        }
    }
    return $total;
}

function checkout($data)
{
    global $db;
    $sql = "insert into orders(u_id, fname, lname, email, total, drinks) values(?,?,?,?,?,?)";
    $stmt = $db->prepare($sql);
    $stmt->bind_param("ssssss", $data["u_id"], $data["fname"], $data["lname"], $data["email"], $data["total"], $data["drinks"]);
    if ($stmt->execute()) {
        return 1;
    }
    return 0;
}

function empty_cart()
{
    $cart = [];
    $_SESSION['cart'] = $cart;
}

function get_orders($id)
{
    global $db;
    $sql = "select * from orders where u_id = ?";
    $stmt = $db->prepare($sql);
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result;
}
