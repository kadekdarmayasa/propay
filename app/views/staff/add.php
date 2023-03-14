<div class="main-content">
  <div class="add-staff-container">
    <div class="meta">
      <h2 class="meta-title">Add New Staff</h2>
      <p class="meta-description">Please kindly fill the fields below</p>
    </div>

    <div class="flasher-container">
      <?php Flasher::flash(); ?>
    </div>

    <form action="" method="post">
      <!-- First Form -->
      <div class="form first">
        <div class="input-group">
          <label for="username">Username</label>
          <input type="text" class="input username" name="username" id="username" placeholder="Enter username..." autocomplete="off" required>
          <img src=" <?= BASEURL . 'public/images/error.svg' ?>" alt="error-icon" class="error-icon">
          <small class="message username-message"></small>
        </div>

        <div class="input-group">
          <label for="staff-password">Password</label>
          <input type="password" name="password" id="staff-password" placeholder="Enter Password..." class="input password" required>
          <img src="<?= BASEURL . 'public/images/eye-slash-regular.svg' ?>" alt="eye" class="toggle-password">
          <img src=" <?= BASEURL . 'public/images/error.svg' ?>" alt="error-icon" class="error-icon">
          <small class="message password-message"></small>
        </div>

        <div class="input-group">
          <label for="staff-password">Confirm Password</label>
          <input type="password" name="confirm-password" id="confirm-password" placeholder="Confirm your password..." class="input password confirm-password" required>
          <img src="<?= BASEURL . 'public/images/eye-slash-regular.svg' ?>" alt="eye" class="toggle-password">
          <img src=" <?= BASEURL . 'public/images/error.svg' ?>" alt="error-icon" class="error-icon">
          <small class="message confirm-password-message"></small>
        </div>

        <div class="input-group">
          <button type="button" name="next-btn" class="next-btn">
            <span>Next</span>
            <svg width="36" height="32" viewBox="0 0 36 32" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M34.5 16L2.8551 31.3704C1.93495 31.8173 1.01674 30.7579 1.58991 29.9106L11 16M34.5 16L17 8L2.92694 1.5666C1.99415 1.14018 1.10057 2.22688 1.69917 3.05972L11 16M34.5 16H22.75H11" stroke="black" />
            </svg>
          </button>
        </div>
      </div>
      <!-- End of First Form -->

      <!-- Second Form -->
      <div class="form second">
        <div class="input-group">
          <label for="staff-level">Staff Level</label>
          <select name="staff-level" id="staff-level" class="input" required autofocus="off">
            <option value="">-- Select Level Staff ---</option>
            <option value="admin">Admin</option>
            <option value="staff">Staff</option>
          </select>
        </div>

        <div class="input-group">
          <label for="staff-name">Staff Name</label>
          <input type="text" name="staff-name" class="input" id="staff-name" placeholder="Enter staff name..." required autofocus="off">
        </div>

        <div class="input-group">
          <label for="date-of-birth">Date of Birth</label>
          <input type="date" class="input" name="date-of-birth" id="date-of-birth" placeholder="Enter birth date..." required autofocus="off">
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
            <option value="Hindu">Hindu</option>
            <option value="Islam">Islam</option>
            <option value="Christian">Christian</option>
            <option value="Buddha">Buddha</option>
            <option value="Kong Hu Cu">Kong Hu Cu</option>
          </select>
        </div>

        <div class="input-group">
          <label for="address">Address</label>
          <textarea name="address" class="input textarea" id="address" cols="30" rows="3" placeholder="Enter full address..." required autofocus="off"></textarea>
        </div>

        <div class="input-group prev-submit-btn">
          <button type="button" name="prev-btn" class="prev-btn">
            <svg width="36" height="32" viewBox="0 0 36 32" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M34.5 16L2.8551 31.3704C1.93495 31.8173 1.01674 30.7579 1.58991 29.9106L11 16M34.5 16L17 8L2.92694 1.5666C1.99415 1.14018 1.10057 2.22688 1.69917 3.05972L11 16M34.5 16H22.75H11" stroke="black" />
            </svg>
            <span>Previous</span>
          </button>
          <button type="submit" name="submit-btn" class="submit-btn">
            <span>Add Staff</span>
            <svg width="33" height="33" viewBox="0 0 33 33" fill="none" xmlns="http://www.w3.org/2000/svg">
              <rect x="0.5" y="0.5" width="32" height="32" rx="16" stroke="black" />
              <path d="M16.3333 8V25" stroke="black" stroke-linecap="round" />
              <path d="M7 16.5H26" stroke="black" stroke-linecap="round" />
            </svg>
          </button>
        </div>
      </div>
      <!-- End of Second Form -->
    </form>

    <completed-illustration src="<?= BASEURL . 'public/images/completed.svg' ?>"></completed-illustration>
  </div>
</div>