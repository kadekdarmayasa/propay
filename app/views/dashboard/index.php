<div class="main-content">
  <div class="welcome-message">
    <h1 class="heading-1">Welcome Back, <?= $data['greeting_name'] ?></h1>
    <p>We hope you're having a great day.</p>
  </div>

  <div class="overview">
    <a href="<?= BASEURL . 'student' ?>" class="student">
      <div class="thumb">
        <img src="<?= BASEURL . 'public/images/student-icon.svg' ?>" alt="Student Icon">
      </div>
      <h3 class="amount"><?= $data['total_student']; ?></h3>
      <p class="desc">Total Student</p>
    </a>

    <a href="<?= BASEURL . 'staff' ?>" class="staff">
      <div class="thumb">
        <img src="<?= BASEURL . 'public/images/staff-icon.svg' ?>" alt="Staff Icon">
      </div>
      <h3 class="amount"><?= $data['total_staff']; ?></h3>
      <p class="desc">Total Staffs</p>
    </a>

    <a href="<?= BASEURL . 'classes' ?>" class="classes">
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

  <div class="newest-content">
    <div class="newest-payment">
      <!-- Payment Header -->
      <div class="payment-header">
        <h2 class="title">Newest Payments</h2>
      </div>

      <!-- Payment Content -->
      <div class="payment-content">
        <div class="columns">
          <div class="column-staff-name">
            <small>Staff Name</small>
            <p>Bagas Adi Kusumo</p>
            <p>Komang Arta Wijaya</p>
            <p>Arie Wira Kusuma</p>
            <p>I Kadek Darmayasa Adi Putra</p>
          </div>
          <div class="column-sin">
            <small>SIN</small>
            <p>5327</p>
            <p>5328</p>
            <p>5329</p>
            <p>5329</p>
          </div>
          <div class="column-dop">
            <small>Date Of Payment</small>
            <p>20-01-2020</p>
            <p>20-01-2020</p>
            <p>20-01-2020</p>
            <p>20-01-2020</p>
          </div>
          <div class="column-payment-amount">
            <small>Payment Amount</small>
            <p>Rp. 240.000</p>
            <p>Rp. 600.000</p>
            <p>Rp. 750.000</p>
            <p>Rp. 600.000</p>
          </div>
          <div class="column-refund">
            <small>Refund</small>
            <p>Rp. 0</p>
            <p>Rp. 0</p>
            <p>Rp. 150.000</p>
            <p>Rp. 0</p>
          </div>
        </div>

        <a href="" class="see-more-btn">
          <span>See more</span>
          <svg width="7" height="9" viewBox="0 0 7 9" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M1 8L6 4.64286L1 1" stroke="#152A4A" stroke-linecap="round" />
          </svg>
        </a>
      </div>
    </div>
  </div>
</div>