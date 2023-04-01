<div class="main-content">
  <div class="main-container">
    <div class="first-content">
      <div class="meta">
        <h2 class="meta-title">Staff Profile</h2>
      </div>

      <?php if (isset($_SESSION['flasher'])) : ?>
        <?php Flasher::flash(); ?>
      <?php endif; ?>

      <form action="" method="post">
        <input type="hidden" class="input staff_id" name="staff_id" id="staff_id" value="<?= $data['staff']['staff_id'] ?>">

        <div class="form">
          <div class="input-group">
            <label for="username">Username</label>
            <input type="text" name="username" class="input" id="username" placeholder="Enter staff name..." autocomplete="off" value="<?= $data['staff']['username'] ?>" required autofocus="off">
          </div>

          <div class="input-group">
            <label for="staff-name">Staff Name</label>
            <input type="text" name="staff-name" class="input" id="staff-name" placeholder="Enter staff name..." autocomplete="off" value="<?= $data['staff']['staff_name'] ?>" required autofocus="off">
          </div>

          <div class="input-group">
            <label for="date-of-birth">Date of Birth</label>
            <input type="date" class="input" name="date-of-birth" id="date-of-birth" placeholder="Enter birth date..." value="<?= $data['staff']['date_of_birth'] ?>" required autofocus="off">
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
                <?php if ($religion == $data['staff']['religion']) : ?>
                  <option value="<?= $religion ?>" selected><?= $religion ?></option>
                <?php endif; ?>
                <option value="<?= $religion ?>"><?= $religion ?></option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="input-group">
            <label for="address">Address</label>
            <textarea name="address" class="input textarea" id="address" cols="30" rows="3" autocomplete="off" placeholder="Enter full address..." required autofocus="off"><?= $data['staff']['address'] ?></textarea>
          </div>

          <div class="input-group prev-submit-btn">
            <a href="<?= BASEURL ?>" class="prev-btn">
              <span>Back to Dashboard</span>
            </a>
            <button type="submit" name="save-profile" class="submit-btn">
              <span>Save Profile</span>
              <svg width="23" height="28" viewBox="0 0 23 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M1 6V25.5945C1 26.4842 2.07459 26.9309 2.70529 26.3034L10.6439 18.4053C11.0298 18.0214 11.6518 18.0166 12.0435 18.3945L20.3057 26.3654C20.9407 26.978 22 26.528 22 25.6457V6C22 3.23858 19.7614 1 17 1H6C3.23858 1 1 3.23858 1 6Z" stroke="black" stroke-width="2" />
              </svg>
            </button>
          </div>
        </div>

        <small class="forgot-password-link">
          Forgot your password? <a href="<?= BASEURL . 'staff/reset_password/' . $_SESSION['user']['staff_id'] ?>">Reset Here</a>
        </small>
      </form>
    </div>

    <illustration-element></illustration-element>
  </div>
</div>