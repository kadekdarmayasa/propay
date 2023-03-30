<div class="main-content">
  <div class="detail-staff-container">
    <div class="left-content">
      <h2 class="header">Personal Information</h2>
      <div class="field">
        <small class="name">Name</small>
        <p class="value"><?= $data['staff']['staff_name'] ?></p>
      </div>
      <div class="field">
        <small class="name">Date Of Birth</small>
        <p class="value">
          <?= date('d F Y', strtotime($data['staff']['date_of_birth'])); ?>
        </p>
      </div>
      <div class="field">
        <small class="name">Religion</small>
        <p class="value"><?= $data['staff']['religion']; ?></p>
      </div>
      <div class="field">
        <small class="name">Address</small>
        <p class="value"><?= $data['staff']['address']; ?></p>
      </div>
    </div>

    <div class="right-content">
      <h2 class="header">Authentication Information</h2>
      <div class="field">
        <small class="name">Staff ID</small>
        <p class="value"><?= $data['staff']['staff_id']; ?></p>
      </div>
      <div class="field">
        <small class="name">Username</small>
        <p class="value"><?= $data['staff']['username']; ?></p>
      </div>
      <div class="field">
        <small class="name">Staff Level</small>
        <p class="value"><?= $data['staff']['staff_level']; ?></p>
      </div>
      <div class="field">
        <small class="name">Password</small>
        <p class="value password">
          <?= $data['staff']['password']; ?>
        </p>
      </div>
    </div>
  </div>
</div>