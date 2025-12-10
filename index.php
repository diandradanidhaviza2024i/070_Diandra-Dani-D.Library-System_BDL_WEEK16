<?php
require 'config.php';
// fetch books with optional search
$q = isset($_GET['q']) ? "%".trim($_GET['q'])."%" : '%';
$stmt = $pdo->prepare("SELECT b.*, (SELECT COUNT(*) FROM loans l WHERE l.book_id=b.id AND l.returned=0) AS loaned_count FROM books b WHERE b.title LIKE ? OR b.author LIKE ? OR b.isbn LIKE ? ORDER BY b.id");
$stmt->execute([$q,$q,$q]);
$books = $stmt->fetchAll();
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Perpustakaan</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container">
    <h1>📚 Perpustakaan Kampus</h1>
    <div class="controls">
      <form method="get">
        <input type="text" name="q" placeholder="Cari judul/penulis/ISBN..." value="<?= htmlspecialchars(isset($_GET['q'])?$_GET['q']:'') ?>">
        <button type="submit">Cari</button>
      </form>
      <div class="actions">
        <a href="add.php" class="btn">+ Tambah Buku</a>
        <a href="loans.php" class="btn">Daftar Peminjaman</a>
        <button id="themeToggle" class="btn small">Toggle Theme</button>
      </div>
    </div>

    <table>
      <thead>
        <tr><th>ID</th><th>Judul</th><th>Author</th><th>ISBN</th><th>Tahun</th><th>Stok</th><th>Aksi</th></tr>
      </thead>
      <tbody>
        <?php foreach($books as $b): ?>
        <tr>
          <td><?= $b['id'] ?></td>
          <td><?= htmlspecialchars($b['title']) ?></td>
          <td><?= htmlspecialchars($b['author']) ?></td>
          <td><?= htmlspecialchars($b['isbn']) ?></td>
          <td><?= $b['year'] ?></td>
          <td><?= $b['copies'] - $b['loaned_count'] ?>/<?= $b['copies'] ?></td>
          <td>
            <a href="edit.php?id=<?= $b['id'] ?>">Edit</a> |
            <a href="delete.php?id=<?= $b['id'] ?>" onclick="return confirm('Hapus buku?')">Hapus</a>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
  <script src="app.js"></script>
</body>
</html>
