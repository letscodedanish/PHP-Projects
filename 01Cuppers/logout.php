<?php

session_start();

unset($_SESSION["u_id"]);
unset($_SESSION["fname"]);
unset($_SESSION["lname"]);
unset($_SESSION["email"]);
unset($_SESSION["type"]);

header("Location: index.php");