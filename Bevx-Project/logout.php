<?php

session_start();

unset($_SESSION["u_id"]);
unset($_SESSION["first_name"]);
unset($_SESSION["last_name"]);
unset($_SESSION["email"]);
unset($_SESSION["is_admin"]);

header("Location: index.php");
