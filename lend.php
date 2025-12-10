<?php
require 'config.php';
// get books (only those with copies available)
$booksStmt = $pdo->prepare("SELECT b.*, (b.copies - IFNULL((SELECT COUNT(*) FROM loans l WHERE l.book_id=b.id AND l.returned=0),0)) AS available FROM books b ORDER BY b.title");
$booksStmt->execute(); $books = $booksStmt->fetchAll();
// get students
$studentsStmt = $pdo->query('SELECT * FROM students ORDER BY name'); $students = $studentsStmt->fetchAll();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $book_id = (int)$_POST['book_id'];
  $student_id = (int)$_POST['student_id'];
  $due_date = $_POST['due_date'];
  try {
    $call = $pdo->prepare('CALL lend_book(?,?,?)');
    $call->execute([$book_id, $student_id, $due_date]);
    header('Location: loans.php'); exit;
  } catch (PDOException $e) {
    $error = $e->getMessage();
  }
}
?>
<!doctype html>
<html><head><meta charset="utf-8"><title>Peminjaman Buku</title><link rel="stylesheet" href="style.css"></head>
<body>
  <div class="container">
    <h2>Form Peminjaman</h2>
    <?php if(!empty($error)): ?><p style="color:red"><?= htmlspecialchars($error) ?></p><?php endif; ?>
    <form method="post">
      <label>Buku<br>
        <select name="book_id" required>
          <?php foreach($books as $b): ?>
            <option value="<?= $b['id'] ?>"><?= htmlspecialchars($b['title']) ?> (tersedia: <?= $b['available'] ?>)</option>
          <?php endforeach; ?>
        </select>
      </label>
      <label>Mahasiswa<br>
        <select name="student_id" required>
          <?php foreach($students as $s): ?>
            <option value="<?= $s['id'] ?>"><?= htmlspecialchars($s['name']) ?> - <?= htmlspecialchars($s['nim']) ?></option>
          <?php endforeach; ?>
        </select>
      </label>
      <label>Jatuh Tempo<br><input type="date" name="due_date" value="<?= date('Y-m-d', strtotime('+7 days')) ?>" required></label>
      <button type="submit">Pinjam</button>
    </form>
    <p><a href="loans.php">Kembali ke daftar peminjaman</a></p>
  </div>
</body>
</html>
