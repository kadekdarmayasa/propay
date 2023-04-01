<div class="container">
  <div class="header">
    <div class="brand">
      <a class="title-logo">
        <img src="<?= BASEURL . 'public/images/propay-logo.svg' ?>" alt="Propay Logo">
        <span class="brand-name">Propay</span>
      </a>
    </div>
    <div class="name"><?= $data['payment']['student']['student_name']; ?></div>
    <div class="sin"><?= $data['payment']['student']['sin']; ?></div>
  </div>

  <table>
    <tr>
      <td>#</td>
      <td>Date</td>
      <td>Bills</td>
    </tr>
    <?php
    $number = 1;
    $total_bills;
    for ($i = 0; $i < count($data['payment']) - 1; $i++) :
      global $total_bills;
      $total_bills = $total_bills + $data['payment'][$i]['payment_amount'];
    ?>
      <tr>
        <td><?= $number++; ?></td>
        <td><?= date('d F Y', strtotime($data['payment'][$i]['due_date'])) ?></td>
        <td>Rp. <?= number_format($data['payment'][$i]['payment_amount'], 0, ',', '.'); ?></td>
      </tr>
    <?php endfor; ?>
    <tr>
      <td colspan='2' class="bills-total">Total Bills</td>
      <?php if (isset($total_bills)) : ?>
        <td class="bills-total">Rp. <?= number_format($total_bills, 0, ',', '.'); ?></td>
      <?php endif; ?>
    </tr>
  </table>
  <div class="buttons">
    <a href="<?= BASEURL . 'edc_report/student' ?>" class="back">Cancel</a>
    <button class="print" onclick="window.print()">
      Print
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
        <path d="M128 0C92.7 0 64 28.7 64 64v96h64V64H354.7L384 93.3V160h64V93.3c0-17-6.7-33.3-18.7-45.3L400 18.7C388 6.7 371.7 0 354.7 0H128zM384 352v32 64H128V384 368 352H384zm64 32h32c17.7 0 32-14.3 32-32V256c0-35.3-28.7-64-64-64H64c-35.3 0-64 28.7-64 64v96c0 17.7 14.3 32 32 32H64v64c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V384zM432 248a24 24 0 1 1 0 48 24 24 0 1 1 0-48z" />
      </svg>
    </button>
  </div>
</div>