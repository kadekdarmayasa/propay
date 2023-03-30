<div class="container">
  <div class="login-container">
    <!-- Left Panel -->
    <div class="left-panel">
      <img src="<?= BASEURL . 'public/images/login-to-payment-illustration.svg' ?>" alt="Login Illustration">
    </div>
    <!-- End Of Left Panel -->

    <!-- Right Panel -->
    <div class="right-panel">

      <div class="meta">
        <h1 class="meta-title">Reset Password <span>Pro</span>pay</h1>
        <p class="meta-description">Please fill the fields below correctly</p>
      </div>

      <!-- Flasher -->
      <?php if (isset($_SESSION['flasher'])) : ?>
        <?php Flasher::flash(); ?>
      <?php endif; ?>
      <!-- End of Flasher -->

      <!-- Login Form -->
      <?php if (isset($data['staff']) || isset($data['student']) || isset($data['password_changed'])) : ?>
        <form action="" method="post" id="reset_password">
          <?php if (isset($data['staff'])) : ?>
            <div class="form-group">
              <input type="hidden" name="staff_id" value="<?= $data['staff']['staff_id'] ?>">
            </div>
          <?php endif; ?>

          <?php if (isset($data['student'])) : ?>
            <div class="form-group">
              <input type="hidden" name="sin" value="<?= $data['student']['sin'] ?>">
            </div>
          <?php endif; ?>

          <div class="input-group">
            <label for="password">New Password</label>
            <input type="password" name="password" id="password" placeholder="Enter new password..." class="input password" required>
            <img src="<?= BASEURL . 'public/images/eye-slash-regular.svg' ?>" alt="eye" class="toggle-password">
            <img src=" <?= BASEURL . 'public/images/error.svg' ?>" alt="error-icon" class="error-icon">
            <small class="message new-password-message"></small>
          </div>
          <div class="input-group">
            <label for="confirm-password">Confirm Password</label>
            <input type="password" name="confirm-password" id="confirm-password" placeholder="Confirm your password..." class="input password confirm-password" required>
            <img src="<?= BASEURL . 'public/images/eye-slash-regular.svg' ?>" alt="eye" class="toggle-password">
            <img src=" <?= BASEURL . 'public/images/error.svg' ?>" alt="error-icon" class="error-icon">
            <small class="message confirm-password-message"></small>
          </div>
          <div class="action-buttons">
            <a href="<?= BASEURL . 'auth/login' ?>" class="primary-btn">Cancel</a>
            <button type="submit" name="save-password" class="primary-btn save-changes">
              Save Password
              <svg width="23" height="28" viewBox="0 0 23 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M1 6V25.5945C1 26.4842 2.07459 26.9309 2.70529 26.3034L10.6439 18.4053C11.0298 18.0214 11.6518 18.0166 12.0435 18.3945L20.3057 26.3654C20.9407 26.978 22 26.528 22 25.6457V6C22 3.23858 19.7614 1 17 1H6C3.23858 1 1 3.23858 1 6Z" stroke="black" stroke-width="2" />
              </svg>
            </button>
          </div>
        </form>
      <?php else : ?>
        <form action="" method="post">
          <div class="form-group">
            <label for="uniq-identity">Username or SIN</label>
            <?php if (isset($_POST['uniq-identity'])) : ?>
              <input type="text" name="uniq-identity" id="uniq-identity" placeholder="Enter username or sin..." value="<?= $_POST['uniq-identity'] ?>" required>
            <?php else : ?>
              <input type="text" name="uniq-identity" id="uniq-identity" placeholder="Enter username or sin..." required>
            <?php endif; ?>
          </div>
          <div class="action-buttons">
            <a href="<?= BASEURL . 'auth/login' ?>" class="primary-btn">Cancel</a>
            <button type="submit" name="save-password" class="primary-btn save-changes">
              Next
              <svg width="36" height="32" viewBox="0 0 36 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M34.5 16L2.8551 31.3704C1.93495 31.8173 1.01674 30.7579 1.58991 29.9106L11 16M34.5 16L17 8L2.92694 1.5666C1.99415 1.14018 1.10057 2.22688 1.69917 3.05972L11 16M34.5 16H22.75H11" stroke="black" />
              </svg>
            </button>
          </div>
        </form>
      <?php endif; ?>
    </div>
    <!-- End of Right Panel -->
  </div>
</div>