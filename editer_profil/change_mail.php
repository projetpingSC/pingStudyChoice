<?php
session_start();
header("Location: ../editer_mail/?id=".$_SESSION['id']);

?>