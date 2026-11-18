<?php
require_once __DIR__ . "/../controller/c_auth.php";
session_unset();
session_destroy();
header('Location: v_login.php');
exit;
