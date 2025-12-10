<?php
require 'config.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $title = $_POST['title'];
  $author = $_POST['author'];
  $isbn = $_POST['isbn'];
  $year = $_POST['year'];
  $copies = (int)$_POST['copies'];
  $stmt = $pdo->prepare("INSERT INTO books (title, author, isbn, year, copies) VALUES (?,?,?,?,?)");
  $stmt->execute([$title,$author,$isbn,$year,$copies]);
  header('Location: index.php');exit;
}
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Tambah Buku</title><link rel="stylesheet" href="style.css"></head>
<body>
  <div class="container">
    <h2>Tambah Buku</h2>
    <form method="post">
      <label>Judul<br><input name="title" required></label>
      <label>Author<br><input name="author"></label>
      <label>ISBN<br><input name="isbn"></label>
      <label>Tahun<br><input name="year" type="number"></label>
      <label>Copies<br><input name="copies" type="number" value="1"></label>
      <button type="submit">Simpan</button>
    </form>
    <p><a href="index.php">Kembali</a></p>
  </div>
  <script src="app.js"></script>
</body>
</html>
