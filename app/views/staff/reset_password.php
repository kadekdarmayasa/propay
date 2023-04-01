<div class="main-content">
  <div class="main-container">
    <?php if ($_SESSION['user']['role'] == 'admin' || $_SESSION['user']['role'] == 'staff') : ?>
      <div class="first-content">
        <div class="meta">
          <h2 class="meta-title">Update Password</h2>
          <p class="meta-description">Please kindly fill the fields below</pc>
        </div>

        <?php if (isset($_SESSION['flasher'])) : ?>
          <?php Flasher::flash(); ?>
        <?php endif; ?>

        <form action="" method="post">
          <input type="hidden" class="input staff_id" name="staff_id" id="staff_id" value="<?= $data['staff']['staff_id'] ?>">

          <div class="form">
            <div class="input-group">
              <label for="staff-password">New Password</label>
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

            <div class="input-group prev-submit-btn">
              <a href="<?= BASEURL . 'staff/profile/' . $data['staff']['staff_id'] ?>" class="prev-btn">
                <span>Cancel</span>
              </a>
              <button type="submit" name="save-password" class="submit-btn">
                <span>Save Changes</span>
                <svg width="23" height="28" viewBox="0 0 23 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M1 6V25.5945C1 26.4842 2.07459 26.9309 2.70529 26.3034L10.6439 18.4053C11.0298 18.0214 11.6518 18.0166 12.0435 18.3945L20.3057 26.3654C20.9407 26.978 22 26.528 22 25.6457V6C22 3.23858 19.7614 1 17 1H6C3.23858 1 1 3.23858 1 6Z" stroke="black" stroke-width="2" />
                </svg>
              </button>
            </div>
          </div>
        </form>
      </div>
    <?php else : ?>
      <div class="first-content">
        <div class="meta">
          <h2 class="meta-title">Update Password</h2>
          <p class="meta-description">Please kindly fill the fields below</pc>
        </div>

        <?php if (isset($_SESSION['flasher'])) : ?>
          <?php Flasher::flash(); ?>
        <?php endif; ?>

        <form action="" method="post">
          <input type="hidden" class="input staff_id" name="staff_id" id="staff_id" value="<?= $data['staff']['staff_id'] ?>">

          <div class="form">
            <div class="input-group">
              <label for="staff-password">New Password</label>
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

            <div class="input-group prev-submit-btn">
              <a href="<?= BASEURL . 'staff/profile/' . $data['staff']['staff_id'] ?>" class="prev-btn">
                <span>Cancel</span>
              </a>
              <button type="submit" name="save-password" class="submit-btn">
                <span>Save Changes</span>
                <svg width="23" height="28" viewBox="0 0 23 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M1 6V25.5945C1 26.4842 2.07459 26.9309 2.70529 26.3034L10.6439 18.4053C11.0298 18.0214 11.6518 18.0166 12.0435 18.3945L20.3057 26.3654C20.9407 26.978 22 26.528 22 25.6457V6C22 3.23858 19.7614 1 17 1H6C3.23858 1 1 3.23858 1 6Z" stroke="black" stroke-width="2" />
                </svg>
              </button>
            </div>
          </div>
        </form>
      </div>
    <?php endif; ?>
  </div>
</div>