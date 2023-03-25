<div class="main-content">
  <div class="detail-student-container">
    <div class="information personal">
      <h2 class="header">Personal Information</h2>
      <div class="field">
        <small class="name">Name</small>
        <p class="value"><?= $data['student']['student_name'] ?></p>
      </div>
      <div class="field">
        <small class="name">Date of Birth</small>
        <p class="value"><?= date('d F Y', strtotime($data['student']['date_of_birth'])); ?></p>
      </div>
      <div class="field">
        <small class="name">Religion</small>
        <p class="value"><?= $data['student']['religion'] ?></p>
      </div>
      <div class="field">
        <small class="name">Address</small>
        <p class="value"><?= $data['student']['address'] ?></p>
      </div>
    </div>

    <div class="information school">
      <h2 class="header">School Information</h2>
      <div class="field">
        <small class="name">Student ID Number</small>
        <p class="value"><?= $data['student']['sin'] ?></p>
      </div>
      <div class="field">
        <small class="name">National Student Number</small>
        <p class="value"><?= $data['student']['nsn'] ?></p>
      </div>
      <div class="field">
        <small class="name">Class Name</small>
        <p class="value"><?= $data['class']['class_name'] ?></p>
      </div>
      <div class="field">
        <small class="name">Major</small>
        <p class="value"><?= $data['class']['major_name'] ?></p>
      </div>
      <div class="field">
        <small class="name">Enrollment Date</small>
        <p class="value"><?= date('d F Y', strtotime($data['student']['enrollment_date'])) ?></p>
      </div>
      <div class="field">
        <small class="name">Term</small>
        <p class="value"><?= $data['student']['term'] ?></p>
      </div>
    </div>

    <div class="information auth">
      <h2 class="header">Authentication Information</h2>
      <div class="field">
        <small class="name">Student ID Number</small>
        <p class="value"><?= $data['student']['sin'] ?></p>
      </div>
      <div class="field">
        <small class="name">Password</small>
        <p class="value password"><?= $data['student']['password'] ?></p>
      </div>
    </div>
  </div>
</div>