<div class="container">
  <?php if (isset($_SESSION['payment_data_per_student'])) : ?>
    <div class="header">
      <div class="brand">
        <a class="title-logo">
          <img src="<?= BASEURL . 'public/images/propay-logo.svg' ?>" alt="Propay Logo">
          <span class="brand-name">Propay</span>
        </a>
      </div>
      <h2 class="meta-title"><?= $_SESSION['student']['student_name']; ?></h2>
      <div class="meta-description">
        <p class="desc-1"><?= $_SESSION['student']['sin']; ?></p>
        <hr>
        <p class="desc-2"><?= $_SESSION['class']['class_name']; ?></p>
      </div>
    </div>

    <table>
      <tr>
        <th>#</th>
        <th>Date</th>
        <th>Bills</th>
      </tr>
      <?php
      $number = 1;
      $total_bills;
      for ($i = 0; $i < count($_SESSION['payment_data_per_student']); $i++) :
        global $total_bills;
        $total_bills = $total_bills + $_SESSION['payment_data_per_student'][$i]['payment_amount'];
      ?>
        <tr>
          <td style="text-align: center"><?= $number++; ?></td>
          <td><?= date('d F Y', strtotime($_SESSION['payment_data_per_student'][$i]['due_date'])) ?></td>
          <td style="text-align: right;">Rp. <?= number_format($_SESSION['payment_data_per_student'][$i]['payment_amount'], 0, ',', '.'); ?></td>
        </tr>
      <?php endfor; ?>
      <tr>
        <td colspan='2' class="bills-total" style="text-align: right;">Total Bills</td>
        <?php if (isset($total_bills)) : ?>
          <td class="bills-total" style="text-align: right;">Rp. <?= number_format($total_bills, 0, ',', '.'); ?></td>
        <?php endif; ?>
      </tr>
    </table>

  <?php else : ?>
    <div class="header">
      <div class="brand">
        <a class="title-logo">
          <img src="<?= BASEURL . 'public/images/propay-logo.svg' ?>" alt="Propay Logo">
          <span class="brand-name">Propay</span>
        </a>
      </div>
      <h2 class="meta-title">Payment Report of <?= $_SESSION['payment_date']; ?></h2>
      <div class="meta-description">
        <p class="desc-1"><?= $_SESSION['class']['class_name']; ?></p>
        <hr>
        <p class="desc-2"><?= $_SESSION['class']['major_name']; ?></p>
      </div>
    </div>

    <table>
      <tr>
        <th>#</th>
        <th>SIN</th>
        <th>Student Name</th>
        <th>Student Bill</th>
      </tr>
      <?php
      $number = 1;
      $total_bills;
      for ($i = 0; $i < count($_SESSION['payment_data_per_class']); $i++) :
        global $total_bills;
        $total_bills = $total_bills + $_SESSION['payment_data_per_class'][$i]['payment']['payment_amount'];
      ?>

        <tr>
          <td style="text-align: center"><?= $number++; ?></td>
          <td><?= $_SESSION['payment_data_per_class'][$i]['sin']; ?></td>
          <td><?= $_SESSION['payment_data_per_class'][$i]['student_name']; ?></td>
          <td style="text-align: right;">Rp. <?= number_format($_SESSION['payment_data_per_class'][$i]['payment']['payment_amount'], 0, ',', '.'); ?></td>
        </tr>
      <?php endfor; ?>
      <tr>
        <td colspan='3' class="bills-total" style="text-align: right;">Total Bills</td>
        <?php if (isset($total_bills)) : ?>
          <td class="bills-total" style="text-align: right;">Rp. <?= number_format($total_bills, 0, ',', '.'); ?></td>
        <?php endif; ?>
      </tr>
    </table>
  <?php endif; ?>

  <div class="buttons">
    <a href="<?= BASEURL . 'payment_report' ?>" class="back">Cancel</a>
    <button class="print" onclick="window.print()">
      Print
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
        <path d="M128 0C92.7 0 64 28.7 64 64v96h64V64H354.7L384 93.3V160h64V93.3c0-17-6.7-33.3-18.7-45.3L400 18.7C388 6.7 371.7 0 354.7 0H128zM384 352v32 64H128V384 368 352H384zm64 32h32c17.7 0 32-14.3 32-32V256c0-35.3-28.7-64-64-64H64c-35.3 0-64 28.7-64 64v96c0 17.7 14.3 32 32 32H64v64c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V384zM432 248a24 24 0 1 1 0 48 24 24 0 1 1 0-48z" />
      </svg>
    </button>
  </div>
</div>