<?php
require 'config.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $loan_id = (int)($_POST['loan_id'] ?? 0);
  if ($loan_id) {
    try {
      $call = $pdo->prepare('CALL return_book(?)');
      $call->execute([$loan_id]);
    } catch (PDOException $e) {
      die('Gagal mengembalikan: '.$e->getMessage());
    }
  }
}
header('Location: loans.php');
