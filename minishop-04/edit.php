<?php
require 'config.php';

$id=$_GET["id"];

$stmt=db()->prepare("SELECT * FROM categories WHERE id=?");
$stmt->execute([$id]);

$row=$stmt->fetch();

if(!$row)
{
    die("Không tồn tại");
}

$error="";

if($_SERVER["REQUEST_METHOD"]=="POST")
{
    $name=trim($_POST["name"]);
    $description=trim($_POST["description"]);

    try
    {
        $stmt=db()->prepare("
        UPDATE categories
        SET name=?,description=?
        WHERE id=?
        ");

        $stmt->execute([$name,$description,$id]);

        header("Location:list.php");
        exit;
    }
    catch(PDOException $e)
    {
        $error="Tên bị trùng";
    }
}

?>

<h2>Sửa</h2>

<p><?= $error ?></p>

<form method="post">

Tên

<input
name="name"
value="<?= htmlspecialchars($row['name']) ?>">

<br><br>

Mô tả

<input
name="description"
value="<?= htmlspecialchars($row['description']) ?>">

<br><br>

<button>Cập nhật</button>

</form>