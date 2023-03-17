<div class="main-content">
  <div class="update-staff-container">
    <div class="first-content">
      <div class="meta">
        <h2 class="meta-title">Add New Staff</h2>
        <p class="meta-description">Please kindly fill the fields below</p>
      </div>

      <form action="" method="post">
        <input type="hidden" class="input staff_id" name="staff_id" id="staff_id" value="<?= $data['staff']['staff_id'] ?>">

        <!-- First Form -->
        <div class="form first">
          <div class="input-group">
            <label for="username">Username</label>
            <input type="text" class="input username" name="username" id="username" placeholder="Enter username..." autocomplete="off" value="<?= $data['staff']['username'] ?>" required>
            <img src=" <?= BASEURL . 'public/images/error.svg' ?>" alt="error-icon" class="error-icon">
            <small class="message username-message"></small>
          </div>

          <div class="input-group">
            <label for="staff-password">Password</label>
            <input type="password" name="password" id="staff-password" placeholder="Enter Password..." class="input password" value="<?= $data['staff']['password'] ?>" required>
            <img src="<?= BASEURL . 'public/images/eye-slash-regular.svg' ?>" alt="eye" class="toggle-password">
            <img src=" <?= BASEURL . 'public/images/error.svg' ?>" alt="error-icon" class="error-icon">
            <small class="message password-message"></small>
          </div>

          <div class="input-group">
            <label for="staff-password">Confirm Password</label>
            <input type="password" name="confirm-password" id="confirm-password" placeholder="Confirm your password..." class="input password confirm-password" value="<?= $data['staff']['password'] ?>" required>
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
              <?php if ($data['staff']['staff_level'] == 'admin') : ?>
                <option value="admin" selected>Admin</option>
                <option value="staff">Staff</option>
              <?php else : ?>
                <option value="admin">Admin</option>
                <option value="staff" selected>Staff</option>
              <?php endif; ?>
            </select>
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
            <button type="button" name="prev-btn" class="prev-btn">
              <svg width="36" height="32" viewBox="0 0 36 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M34.5 16L2.8551 31.3704C1.93495 31.8173 1.01674 30.7579 1.58991 29.9106L11 16M34.5 16L17 8L2.92694 1.5666C1.99415 1.14018 1.10057 2.22688 1.69917 3.05972L11 16M34.5 16H22.75H11" stroke="black" />
              </svg>
              <span>Previous</span>
            </button>
            <button type="submit" name="submit-btn" class="submit-btn">
              <span>Update Staff</span>
              <svg width="21" height="19" viewBox="0 0 21 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M4.63638 12.7742L5.21649 10.4983C5.27328 10.2755 5.40513 10.0791 5.58984 9.94209L17.691 0.967977C18.415 0.431087 19.4359 0.57489 19.9834 1.29088C20.5424 2.02193 20.3949 3.06908 19.6557 3.61727L7.57334 12.5774C7.40103 12.7052 7.19219 12.7742 6.97767 12.7742H4.63638Z" stroke="#989898" stroke-linecap="round" />
                <path d="M16.4545 2.03223L18.2727 4.35481" stroke="#989898" stroke-linecap="round" />
                <path d="M13.5916 1.16113H3C1.89543 1.16113 1 2.05656 1 3.16113V15.9998C1 17.1044 1.89543 17.9998 3 17.9998H16.5758C17.6803 17.9998 18.5758 17.1044 18.5758 15.9998V6.32138" stroke="#989898" stroke-linecap="round" />
              </svg>
            </button>
          </div>
        </div>
        <!-- End of Second Form -->
      </form>
    </div>

    <completed-illustration src="<?= BASEURL . 'public/images/completed.svg' ?>"></completed-illustration>
  </div>
</div>