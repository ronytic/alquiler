<?php
session_start();
include_once("../config.php");
session_unregister("login");
session_unregister("CodUsuarioLog");
session_destroy();
header("Location:$url$directory/");
?>