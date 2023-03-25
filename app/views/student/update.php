<div class="main-content">
  <div class="main-container">
    <div class="first-content">
      <div class="meta">
        <h2 class="meta-title">Update Student</h2>
        <p class="meta-description">Please kindly fill the fields below</p>
      </div>

      <form action="" method="post">
        <div class="form">
          <input type="hidden" id="sin" class="input" autocomplete="off" value="<?= $data['student']['sin'] ?>" required>

          <div class="input-group">
            <label for="student-name">Student Name</label>
            <input type="text" name="student-name" class="input" id="student-name" placeholder="Enter student name..." required autofocus="off" autocomplete="off" value="<?= $data['student']['student_name'] ?>">
          </div>

          <div class="input-group">
            <label for="class_id">Class</label>
            <select name="class_id" id="class_id" class="input" required autofocus="off">
              <option value="">-- Select Class --</option>
              <?php foreach ($data['class'] as $class) : ?>
                <?php if ($data['student']['class_id'] == $class['class_id']) : ?>
                  <option value="<?= $class['class_id'] ?>" selected><?= $class['class_name'] ?></option>
                <?php else : ?>
                  <option value="<?= $class['class_id'] ?>"><?= $class['class_name'] ?></option>
                <?php endif; ?>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="input-group">
            <label for="date-of-birth">Date of Birth</label>
            <input type="date" class="input" name="date-of-birth" id="date-of-birth" placeholder="Enter birth date..." required autofocus="off" autocomplete="off" value="<?= $data['student']['date_of_birth'] ?>">
            <svg width="27" height="27" viewBox="0 0 27 27" fill="none" xmlns="http://www.w3.org/2000/svg">
              <rect x="2" y="4" width="23" height="20" rx="2" stroke="white" stroke-width="2" />
              <rect x="6" y="14" width="5" height="5" rx="1" stroke="white" stroke-width="2" />
              <rect x="16" y="14" width="5" height="5" rx="1" stroke="white" stroke-width="2" />
              <path d="M2 9H25" stroke="white" stroke-width="2" />
              <path d="M6 2L6 6" stroke="white" stroke-width="2" stroke-linecap="round" />
              <path d="M21 2L21 6" stroke="white" stroke-width="2" stroke-linecap="round" />
            </svg>
          </div>

          <div class="input-group">
            <label for="religion">Religion</label>
            <select name="religion" id="religion" class="input" required autofocus="off">
              <option value="">-- Select Religion --</option>
              <?php foreach ($data['religions'] as $religion) : ?>
                <?php if ($religion == $data['student']['religion']) : ?>
                  <option value="<?= $religion ?>" selected><?= $religion ?></option>
                <?php else : ?>
                  <option value="<?= $religion ?>"><?= $religion ?></option>
                <?php endif; ?>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="input-group">
            <label for="address">Address</label>
            <textarea name="address" class="input textarea" id="address" cols="30" rows="3" placeholder="Enter full address..." required autofocus="off" autocomplete="off"><?= $data['student']['address'] ?></textarea>
          </div>

          <div class="input-group prev-submit-btn">
            <button type="submit" name="submit-btn" class="submit-btn">
              <span>Update Student</span>
              <svg width="33" height="33" viewBox="0 0 33 33" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="0.5" y="0.5" width="32" height="32" rx="16" stroke="black" />
                <path d="M16.3333 8V25" stroke="black" stroke-linecap="round" />
                <path d="M7 16.5H26" stroke="black" stroke-linecap="round" />
              </svg>
            </button>
          </div>
        </div>
      </form>
    </div>

    <illustration-element></illustration-element>
  </div>
</div>