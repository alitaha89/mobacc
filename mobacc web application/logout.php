<?php
require_once('header.php');


session_destroy();
header('Location: index.php')
?>
<script>window.location ='index.php';</script>
<a href="index.php">Main</a>