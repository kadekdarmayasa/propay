<div class="main-content">
  <div class="main-container">
    <div class="first-content">
      <div class="meta">
        <h2 class="meta-title">Add New EDC</h2>
        <p class="meta-description">Please kindly fill the fields below</p>
      </div>

      <form action="" method="post">
        <div class="input-group">
          <label for="term">Term</label>
          <input type="text" name="term" maxlength="9" id="term" class="input term" placeholder="2022/2023" required autocomplete="off">
          <img src=" <?= BASEURL . 'public/images/error.svg' ?>" alt="error-icon" class="error-icon">
          <small class="message term-message"></small>
        </div>

        <div class="input-group">
          <label for="nominal">Nominal Payment</label>
          <input type="number" name="nominal" id="nominal" class="input nominal" placeholder="600000" required autocomplete="off">
          <img src=" <?= BASEURL . 'public/images/error.svg' ?>" alt="error-icon" class="error-icon">
          <small class="message nominal-message"></small>
        </div>

        <div class="input-group">
          <button type="submit" name="add-class" id="submit-btn" class="submit-btn">
            <span>Add EDC</span>
            <svg width="33" height="33" viewBox="0 0 33 33" fill="none" xmlns="http://www.w3.org/2000/svg">
              <rect x="0.5" y="0.5" width="32" height="32" rx="16" stroke="black" />
              <path d="M16.3333 8V25" stroke="black" stroke-linecap="round" />
              <path d="M7 16.5H26" stroke="black" stroke-linecap="round" />
            </svg>
          </button>
        </div>
      </form>
    </div>

    <illustration-element></illustration-element>
  </div>
</div>