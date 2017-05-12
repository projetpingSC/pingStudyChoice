<?php
session_start();
header("Location: ../editer_password/?id=".$_SESSION['id']);

?>