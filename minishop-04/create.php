<?php
require 'config.php';

$error="";

if($_SERVER["REQUEST_METHOD"]=="POST")
{
    $name=trim($_POST["name"]);
    $description=trim($_POST["description"]);

    if(strlen($name)<2)
    {
        $error="Tên quá ngắn";
    }
    else
    {
        try
        {
            $stmt=db()->prepare("
            INSERT INTO categories(name,description)
            VALUES(?,?)
            ");

            $stmt->execute([$name,$description]);

            header("Location:list.php");
            exit;

        }
        catch(PDOException $e)
        {
            $error="Tên đã tồn tại";
        }
    }
}

?>

<h2>Thêm danh mục</h2>

<p style="color:red"><?= $error ?></p>

<form method="post">

Tên

<input name="name">

<br><br>

Mô tả

<input name="description">

<br><br>

<button>Lưu</button>

</form>