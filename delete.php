<?php
require 'config.php';
$id = (int)($_GET['id'] ?? 0);
if ($id) {
  $stmt = $pdo->prepare('DELETE FROM books WHERE id=?');
  try {
    $stmt->execute([$id]);
  } catch (PDOException $e) {
    die('Gagal menghapus: '.$e->getMessage());
  }
}
header('Location: index.php');
