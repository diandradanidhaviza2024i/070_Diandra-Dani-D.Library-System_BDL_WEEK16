<?php
require 'config.php';
$id = (int)($_GET['id'] ?? 0);
if (!$id) { header('Location: index.php'); exit; }
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $stmt = $pdo->prepare('UPDATE books SET title=?, author=?, isbn=?, year=?, copies=? WHERE id=?');
  $stmt->execute([$_POST['title'], $_POST['author'], $_POST['isbn'], $_POST['year'], (int)$_POST['copies'], $id]);
  header('Location: index.php'); exit;
}
$stmt = $pdo->prepare('SELECT * FROM books WHERE id=?'); $stmt->execute([$id]);
$book = $stmt->fetch();
if (!$book) { echo 'Buku tidak ditemukan'; exit; }
?>
<!doctype html>
<html><head><meta charset="utf-8"><title>Edit Buku</title><link rel="stylesheet" href="style.css"></head>
<body>
  <div class="container">
    <h2>Edit Buku</h2>
    <form method="post">
      <label>Judul<br><input name="title" value="<?= htmlspecialchars($book['title']) ?>" required></label>
      <label>Author<br><input name="author" value="<?= htmlspecialchars($book['author']) ?>"></label>
      <label>ISBN<br><input name="isbn" value="<?= htmlspecialchars($book['isbn']) ?>"></label>
      <label>Tahun<br><input name="year" type="number" value="<?= $book['year'] ?>"></label>
      <label>Copies<br><input name="copies" type="number" value="<?= $book['copies'] ?>"></label>
      <button type="submit">Update</button>
    </form>
    <p><a href="index.php">Kembali</a></p>
  </div>
  <script src="app.js"></script>
</body>
</html>
