<?php

require 'config.php';

$id=$_POST["id"];

$stmt=db()->prepare("
DELETE FROM categories
WHERE id=?
");

$stmt->execute([$id]);

header("Location:list.php");