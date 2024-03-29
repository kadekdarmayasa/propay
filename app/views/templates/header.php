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
    <link rel="stylesheet" href="<?= BASEURL . 'public/css/input-group.css' ?>">
    <link rel="stylesheet" href="<?= BASEURL . 'public/css/auth/index.css' ?>">
  <?php endif; ?>

  <?php if ($activeTab != 'login') : ?>
    <link rel="stylesheet" href="<?= BASEURL . 'public/css/index.css' ?>">
    <link rel="stylesheet" href="<?= BASEURL . 'public/css/top-bar.css' ?>">
    <link rel="stylesheet" href="<?= BASEURL . 'public/css/sidebar.css' ?>">

    <?php if ($activeTab == 'dashboard') : ?>
      <link rel="stylesheet" href="<?= BASEURL . 'public/css/dashboard/index.css' ?>">
    <?php endif; ?>


    <?php $tabs = explode('/', $activeTab); ?>

    <?php if ($tabs[0] == 'student') : ?>
      <link rel="stylesheet" href="<?= BASEURL . 'public/css/overlay.css' ?>">
      <link rel="stylesheet" href="<?= BASEURL . 'public/css/input-group.css' ?>">
      <link rel="stylesheet" href="<?= BASEURL . 'public/css/illustration.css' ?>">
      <link rel="stylesheet" href="<?= BASEURL . 'public/css/student/index.css' ?>">

      <?php if ($tabs[1] == 'detail') : ?>
        <link rel="stylesheet" href="<?= BASEURL . 'public/css/student/detail.css' ?>">
      <?php endif; ?>
    <?php endif; ?>


    <?php if ($tabs[0] == 'class') : ?>
      <link rel="stylesheet" href="<?= BASEURL . 'public/css/class/index.css' ?>">
      <link rel="stylesheet" href="<?= BASEURL . 'public/css/overlay.css' ?>">
      <link rel="stylesheet" href="<?= BASEURL . 'public/css/input-group.css' ?>">
      <link rel="stylesheet" href="<?= BASEURL . 'public/css/illustration.css' ?>">


      <?php if ($tabs[1] == 'add') : ?>
        <link rel="stylesheet" href="<?= BASEURL . 'public/css/class/add.css' ?>">
      <?php endif; ?>
    <?php endif; ?>

    <?php if ($tabs[0] == 'staff') : ?>
      <link rel="stylesheet" href="<?= BASEURL . 'public/css/staff/index.css' ?>">
      <link rel="stylesheet" href="<?= BASEURL . 'public/css/overlay.css' ?>">
      <link rel="stylesheet" href="<?= BASEURL . 'public/css/input-group.css' ?>">
      <link rel="stylesheet" href="<?= BASEURL . 'public/css/illustration.css' ?>">

      <?php if ($tabs[1] == 'add') : ?>
        <link rel="stylesheet" href="<?= BASEURL . 'public/css/staff/add.css' ?>">
      <?php endif; ?>

      <?php if ($tabs[1] == 'detail') : ?>
        <link rel="stylesheet" href="<?= BASEURL . 'public/css/staff/detail.css' ?>">
      <?php endif; ?>
    <?php endif; ?>

    <?php if ($tabs[0] == 'user') : ?>
      <link rel="stylesheet" href="<?= BASEURL . 'public/css/user/index.css' ?>">
    <?php endif; ?>

    <?php if ($tabs[0] == 'user') : ?>
      <link rel="stylesheet" href="<?= BASEURL . 'public/css/input-group.css' ?>">
    <?php endif; ?>

    <?php if ($tabs[0] == 'edc') : ?>
      <link rel="stylesheet" href="<?= BASEURL . 'public/css/overlay.css' ?>">
      <link rel="stylesheet" href="<?= BASEURL . 'public/css/input-group.css' ?>">
      <link rel="stylesheet" href="<?= BASEURL . 'public/css/illustration.css' ?>">

      <?php if ($tabs[1] == 'payment') : ?>
        <link rel="stylesheet" href="<?= BASEURL . 'public/css/payment/index.css' ?>">
      <?php endif; ?>

      <?php if ($tabs[1] == 'payment-history') : ?>
        <link rel="stylesheet" href="<?= BASEURL . 'public/css/payment-history/index.css' ?>">
      <?php endif; ?>

      <?php if ($tabs[1] == 'report') : ?>
        <link rel="stylesheet" href="<?= BASEURL . 'public/css/report/index.css' ?>">

        <?php if ($tabs[2] == 'generate') : ?>
          <link rel="stylesheet" href="<?= BASEURL . 'public/css/report/generate.css' ?>">
        <?php endif; ?>
      <?php endif; ?>
    <?php endif; ?>
  <?php endif; ?>
</head>

<body>