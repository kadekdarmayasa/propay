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
      <div class="input-group">
        <label for="username">Username</label>
        <input type="text" class="username" name="username" id="username" placeholder="Enter username..." onkeyup="checkAvailability(this.value)" autocomplete="off" required>
        <img src="<?= BASEURL . 'public/images/error.svg' ?>" alt="error-icon" class="error-icon">
        <small id="message"></small>
      </div>

      <div class="input-group">
        <label for="staff-password">Password</label>
        <input type="password" name="password" id="staff-password" placeholder="Enter Password..." class="password" required>
        <img src="<?= BASEURL . 'public/images/eye-slash-regular.svg' ?>" alt="eye" class="toggle-password">
      </div>

      <div class="input-group">
        <label for="staff-password">Confirm Password</label>
        <input type="password" name="confirm-password" id="confirm-password" placeholder="Confirm your password..." class="password" required>
        <img src="<?= BASEURL . 'public/images/eye-slash-regular.svg' ?>" alt="eye" class="toggle-password">
      </div>

      <div class="input-group">
        <button type="submit" name="next-btn" class="next-btn">
          <span>Next</span>
          <svg width="36" height="32" viewBox="0 0 36 32" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M34.5 16L2.8551 31.3704C1.93495 31.8173 1.01674 30.7579 1.58991 29.9106L11 16M34.5 16L17 8L2.92694 1.5666C1.99415 1.14018 1.10057 2.22688 1.69917 3.05972L11 16M34.5 16H22.75H11" stroke="black" />
          </svg>
        </button>
      </div>
    </form>
  </div>
</div>