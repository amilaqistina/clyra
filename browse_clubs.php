<?php
include 'header.php';

if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit;
}

$categories = [
  'Academic' => [
    'icon' => 'bi-mortarboard',
    'clubs' => ['AIS', 'SISMA', 'DIQMA', 'MOBISM', 'ATLAST', 'OMSA']
  ],
  'Non-Academic' => [
    'icon' => 'bi-trophy',
    'clubs' => ['HAC', 'ENACTUS', 'DEBAT & PIDATO', 'PRIME MOVER', 'SILAT CEKAK', 'ORC']
  ],
  'JPK' => [
    'icon' => 'bi-building',
    'clubs' => ['JPK TR', 'JPK TDM', 'JPK DO', 'JPK THO', 'JPK TAR', 'JPK NR']
  ]
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Browse Clubs - CLYRA</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <style>
    body { background-color: #f3e8ff; }
    .category-box {
      background: #fff;
      border-radius: 10px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
      padding: 20px;
    }
    .club-name {
      cursor: pointer;
      color: #6f42c1;
    }
  </style>
</head>
<body>
<div class="container py-5">
  <h2 class="mb-4 text-center">Club Browsing & Registration</h2>
  <div class="row g-4">
    <?php foreach ($categories as $cat => $data): ?>
      <div class="col-md-4">
        <div class="category-box text-center">
          <i class="bi <?= $data['icon'] ?> display-4 text-purple"></i>
          <h4 class="mt-2"><?= $cat ?> Clubs</h4>
          <hr>
          <?php foreach ($data['clubs'] as $club): ?>
            <p>
              <a class="club-name" href="club_list.php?category=<?= urlencode($cat) ?>&club=<?= urlencode($club) ?>">
                <?= htmlspecialchars($club) ?>
              </a>
            </p>
          <?php endforeach; ?>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>
</body>
</html>