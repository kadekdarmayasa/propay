<div class="container">
  <div class="login-container">
    <!-- Left Panel -->
    <div class="left-panel">
      <img src="<?= BASEURL . 'public/images/login-to-payment-illustration.svg' ?>" alt="Login Illustration">
    </div>
    <!-- End Of Left Panel -->

    <!-- Right Panel -->
    <div class="right-panel">
      <!-- Meta -->
      <div class="meta">
        <h1 class="meta-title">Sign In To <span>Pro</span>pay</h1>
        <p class="meta-description">Please fill the fields below correctly</p>
      </div>
      <!-- End of Meta -->

      <!-- Flasher -->
      <?php if (isset($_SESSION['flasher'])) : ?>
        <?php Flasher::flash(); ?>
      <?php endif; ?>
      <!-- End of Flasher -->

      <!-- Login Form -->
      <!-- Staff Form -->
      <form action="" method="post" id="staff-form">
        <div class="form-group">
          <label for="username">Username</label>
          <input type="text" name="username" id="username" placeholder="Enter username..." required>
        </div>
        <div class="form-group">
          <label for="staff-password">Password</label>
          <input type="password" name="password" id="staff-password" placeholder="Enter Password..." class="password" required>
          <img src="<?= BASEURL . 'public/images/eye-slash-regular.svg' ?>" alt="eye" class="toggle-password">
        </div>
        <button type="submit" class="submit-btn">
          <img src="<?= BASEURL . 'public/images/arrow-round-icon.svg' ?>" alt="Arrow Round Icon">
          Sign Me In
        </button>
      </form>

      <!-- Student Form -->
      <form action="" method="post" id="student-form">
        <div class="form-group">
          <label for="sin">Student ID Number (SIN)</label>
          <input type="text" name="sin" id="sin" placeholder="example: 5327" required>
        </div>
        <div class="form-group">
          <label for="student-password">Password</label>
          <input type="password" name="password" id="student-password" placeholder="Enter Password..." class="password" required>
          <img src="<?= BASEURL . 'public/images/eye-slash-regular.svg' ?>" alt="eye" class="toggle-password">
        </div>
        <button type="submit" class="submit-btn">
          <img src="<?= BASEURL . 'public/images/arrow-round-icon.svg' ?>" alt="Arrow Round Icon">
          Sign Me In
        </button>
      </form>
      <!-- End of Login Form -->

      <div class="option-divider">
        <hr>
        or
        <hr>
      </div>

      <button id="switcher-btn">Sign In As Student</button>
    </div>
    <!-- End of Right Panel -->
  </div>
</div>