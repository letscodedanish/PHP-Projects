<?php

include "database.php";

function get_public_url()
{
    return 'http://localhost:2022/bevx';
}

function get_image_url($image)
{
    $url = get_public_url() . "/assets/images/" . $image;
    return $url;
}

function get_stylesheet_url($file)
{
    $url = get_public_url() . "/assets/css/" . $file;
    return $url;
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

function get_drink($id)
{
    global $db;
    $sql = "select * from drinks where d_id = ?";
    $stmt = $db->prepare($sql);
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result;
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
                $_SESSION["first_name"] = $row["first_name"];
                $_SESSION["last_name"] = $row["last_name"];
                $_SESSION["email"] = $row["email"];
                $_SESSION["is_admin"] = $row["is_admin"];
                return 1;
            } else {
                return 0;
            }
        }
    }
    return 0;
}

function signup($data)
{
    global $db;
    $password = md5($data["password"]);
    $sql = "insert into users(first_name, last_name, email, password, is_admin) values(?,?,?,?,?)";
    $stmt = $db->prepare($sql);
    $stmt->bind_param("sssss", $data["fname"], $data["lname"], $data["email"], $password, $data["is_admin"]);
    if ($stmt->execute()) {
        return 1;
    }
    return 0;
}

function get_user($data)
{
    global $db;
    $sql = "select * from users where email = ?";
    $stmt = $db->prepare($sql);
    $stmt->bind_param("s", $data["email"]);
    $stmt->execute();
    $result = $stmt->get_result();
    if (mysqli_num_rows($result)) {
        return 1;
    }
    return 0;
}

function add_product($data)
{
    global $db;
    $sql = "insert into drinks(title, description, price, image) values(?,?,?,?)";
    $stmt = $db->prepare($sql);
    $stmt->bind_param("ssss", $data["title"], $data["description"], $data["price"], $data["image"]);
    if ($stmt->execute()) {
        return 1;
    }
    return 0;
}

function edit_product($data)
{
    global $db;
    $sql = "update drinks set title = ?, description = ?, price = ?, image = ? where d_id = ?";
    $stmt = $db->prepare($sql);
    $stmt->bind_param("sssss", $data["title"], $data["description"], $data["price"], $data["image"], $data["d_id"]);
    if ($stmt->execute()) {
        return 1;
    }
    return 0;
}

function delete_product($id)
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

function remove_from_cart($cart_item)
{
    if (isset($_SESSION["cart"])) {
        $cart = $_SESSION["cart"];
    } else {
        $cart = [];
    }
    unset($cart[$cart_item]);
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

function get_drinks_by_ids($drink_ids)
{
    global $db;
    $id_str = implode("', '", array_keys($drink_ids));
    $sql = "select * from drinks where d_id in ('" . $id_str . "')";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result;
}

function remove_query_params()
{
    return strtok($_SERVER["PHP_SELF"], '?');
}

function get_cart_total()
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
    $sql = "insert into orders(u_id, first_name, last_name, email, total, drinks) values(?,?,?,?,?,?)";
    $stmt = $db->prepare($sql);
    $stmt->bind_param("ssssss", $_SESSION["u_id"], $_SESSION["first_name"], $_SESSION["last_name"], $_SESSION["email"], $data["total"], $data["drinks"]);
    echo mysqli_error($db);
    if ($stmt->execute()) {
        return 1;
    }
    return 0;
}

function empty_cart()
{
    $_SESSION["cart"] = [];
}

function get_orders()
{
    global $db;
    $sql = "select * from orders";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result;
}

function get_my_orders($id)
{
    global $db;
    $sql = "select * from orders where u_id = ?";
    $stmt = $db->prepare($sql);
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result;
}
