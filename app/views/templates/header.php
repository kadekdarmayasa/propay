<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Propay Payment System">
  <meta name="keywords" content="EDC Payment">
  <meta name="author" content="Darma Yasa">
  <title><?= $data['title']; ?></title>

  <link rel="stylesheet" href="<?= BASEURL . 'public/css/root.css' ?>">
  <link rel="stylesheet" href="<?= BASEURL . 'public/css/flasher.css' ?>">

  <?php if ($activeTab == 'login') : ?>
    <link rel="stylesheet" href="<?= BASEURL . 'public/css/auth/index.css' ?>">
  <?php endif; ?>

  <?php if ($activeTab != 'login') : ?>
    <link rel="stylesheet" href="<?= BASEURL . 'public/css/index.css' ?>">
    <link rel="stylesheet" href="<?= BASEURL . 'public/css/top-bar.css' ?>">

    <?php if ($activeTab == 'dashboard') : ?>
      <link rel="stylesheet" href="<?= BASEURL . 'public/css/dashboard/index.css' ?>">
    <?php endif; ?>
    <?php  ?>
  <?php endif; ?>
</head>

<body class="dark">