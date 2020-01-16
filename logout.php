<?php

require_once 'core/system.php';

session_destroy();
header('Location: login-admin');

?>