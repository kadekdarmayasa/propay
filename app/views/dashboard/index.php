<div class="main-content">
  <div class="welcome-message">
    <h1 class="heading-1">Welcome Back, <?= $data['greeting_name'] ?></h1>
    <p>We hope you're having a great day.</p>
  </div>

  <div class="overview">
    <?php if ($_SESSION['user']['role'] == 'admin') : ?>
      <a href="<?= BASEURL . 'student' ?>" class="student">
      <?php else : ?>
        <a class="student">
        <?php endif; ?>
        <div class="thumb">
          <img src="<?= BASEURL . 'public/images/student-icon.svg' ?>" alt="Student Icon">
        </div>
        <h3 class="amount"><?= $data['total_student']; ?></h3>
        <p class="desc">Total Student</p>
        </a>

        <?php if ($_SESSION['user']['role'] == 'admin') : ?>
          <a href="<?= BASEURL . 'staff' ?>" class="staff">
          <?php else : ?>
            <a class="staff">
            <?php endif; ?>
            <div class="thumb">
              <img src="<?= BASEURL . 'public/images/staff-icon.svg' ?>" alt="Staff Icon">
            </div>
            <h3 class="amount"><?= $data['total_staff']; ?></h3>
            <p class="desc">Total Staffs</p>
            </a>

            <?php if ($_SESSION['user']['role'] == 'admin') : ?>
              <a href="<?= BASEURL . 'classes' ?>" class="classes">
              <?php else : ?>
                <a class="classes">
                <?php endif; ?>
                <div class="thumb">
                  <img src="<?= BASEURL . 'public/images/classroom-icon.svg' ?>" alt="ClassRoom Icon">
                </div>
                <h3 class="amount"><?= $data['total_class']; ?></h3>
                <p class="desc">Total Classes</p>
                </a>

                <div class="time" id="time">
                  <h2 class="hour-minute">
                    <span id="hour">00</span> : <span id="minute">00</span>
                  </h2>
                  <p class="date">Monday, 20 January 2020</p>
                </div>
  </div>

  <?php if (isset($data['payment_histories']) && count($data['payment_histories']) > 0) : ?>
    <div class="newest-content">
      <div class="newest-payment">
        <!-- Payment Header -->
        <div class="payment-header">
          <h2 class="title">Newest Payments</h2>
        </div>

        <!-- Payment Content -->
        <div class="payment-content">
          <div class="columns">
            <!-- Staff Name Column -->
            <div class="column-staff-name">
              <small>Staff Name</small>
              <?php for ($i = 0; $i < count($data['payment_histories']); $i++) : ?>
                <p><?= $data['payment_histories'][$i]['staff']['staff_name']; ?></p>
              <?php endfor; ?>
            </div>
            <!-- Student SIN column -->
            <div class="column-sin">
              <small>SIN</small>
              <?php for ($i = 0; $i < count($data['payment_histories']); $i++) : ?>
                <p><?= $data['payment_histories'][$i]['sin']; ?></p>
              <?php endfor; ?>
            </div>
            <!-- Date Of Payment Column -->
            <div class="column-dop">
              <small>Date Of Payment</small>
              <?php for ($i = 0; $i < count($data['payment_histories']); $i++) : ?>
                <p><?= date('d F Y', strtotime($data['payment_histories'][$i]['date_of_payment'])); ?></p>
              <?php endfor; ?>
            </div>
            <!-- Payment Amount Column -->
            <div class="column-payment-amount">
              <small>Payment Amount</small>
              <?php for ($i = 0; $i < count($data['payment_histories']); $i++) : ?>
                <p>Rp. <?= number_format($data['payment_histories'][$i]['payment_amount'], 0, ',', '.'); ?></p>
              <?php endfor; ?>
            </div>
            <!-- Total Refund Column -->
            <div class="column-refund">
              <small>Refund</small>
              <?php for ($i = 0; $i < count($data['payment_histories']); $i++) : ?>
                <p>Rp. <?= number_format($data['payment_histories'][$i]['refund_total'], 0, ',', '.'); ?></p>
              <?php endfor; ?>
            </div>
          </div>
          <!-- See More Button -->
          <a href="<?= BASEURL . 'edc/payment_history'; ?>" class="see-more-btn">
            <span>See more</span>
            <svg width="7" height="9" viewBox="0 0 7 9" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M1 8L6 4.64286L1 1" stroke="#152A4A" stroke-linecap="round" />
            </svg>
          </a>
        </div>
      </div>
    </div>
  <?php endif; ?>
</div>