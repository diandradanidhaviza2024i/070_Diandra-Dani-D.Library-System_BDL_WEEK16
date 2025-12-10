<?php
require 'config.php';
// show active loans and option to return, include overdue days and fine
$fine_per_day = 1000; // denda per hari
$stmt = $pdo->prepare("SELECT l.id AS loan_id, b.title, s.name AS student_name, l.loan_date, l.due_date, l.returned, overdue_days(l.id) AS overdue_days FROM loans l JOIN books b ON l.book_id=b.id JOIN students s ON l.student_id=s.id ORDER BY l.created_at DESC");
$stmt->execute();
$loans = $stmt->fetchAll();
?>
<!doctype html>
<html><head><meta charset="utf-8"><title>Daftar Peminjaman</title><link rel="stylesheet" href="style.css"></head>
<body>
  <div class="container">
    <h2>Daftar Peminjaman</h2>
    <p><a href="lend.php">+ Peminjaman Baru</a> | <a href="index.php">Kembali</a></p>
    <table>
      <thead><tr><th>ID</th><th>Buku</th><th>Mahasiswa</th><th>Tanggal Pinjam</th><th>Jatuh Tempo</th><th>Status</th><th>Overdue (hari)</th><th>Denda</th><th>Aksi</th></tr></thead>
      <tbody>
      <?php foreach($loans as $l): ?>
        <tr>
          <td><?= $l['loan_id'] ?></td>
          <td><?= htmlspecialchars($l['title']) ?></td>
          <td><?= htmlspecialchars($l['student_name']) ?></td>
          <td><?= $l['loan_date'] ?></td>
          <td><?= $l['due_date'] ?></td>
          <td><?= $l['returned'] ? 'Dikembalikan' : 'Dipinjam' ?></td>
          <td><?= $l['overdue_days'] ?></td>
          <td><?= number_format($l['overdue_days'] * $fine_per_day,0,',','.') ?></td>
          <td>
            <?php if(!$l['returned']): ?>
              <form method="post" action="return.php" style="display:inline">
                <input type="hidden" name="loan_id" value="<?= $l['loan_id'] ?>">
                <button type="submit" onclick="return confirm('Tandai sebagai dikembalikan?')">Kembalikan</button>
              </form>
            <?php else: ?>
              -
            <?php endif; ?>
          </td>
        </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</body>
</html>
