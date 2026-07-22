<?php
require 'config.php';

$rows = db()->query("
SELECT *
FROM categories
ORDER BY id
")->fetchAll();

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Categories</title>
</head>

<body>

<h2>Danh sách danh mục</h2>

<a href="create.php">Thêm mới</a>

<table border="1" cellpadding="10">

<tr>
    <th>ID</th>
    <th>Tên</th>
    <th>Mô tả</th>
    <th>Ngày tạo</th>
    <th>Thao tác</th>
</tr>

<?php foreach($rows as $row): ?>

<tr>

<td><?= $row['id'] ?></td>

<td><?= htmlspecialchars($row['name']) ?></td>

<td><?= htmlspecialchars($row['description']) ?></td>

<td><?= $row['created_at'] ?></td>

<td>

<a href="edit.php?id=<?= $row['id'] ?>">Sửa</a>

|

<form action="delete.php" method="post" style="display:inline">

<input type="hidden" name="id" value="<?= $row['id'] ?>">

<button onclick="return confirm('Xóa?')">

Xóa

</button>

</form>

</td>

</tr>

<?php endforeach; ?>

</table>

</body>
</html>