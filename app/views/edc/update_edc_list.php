<div class="main-content">
  <div class="main-container">
    <div class="first-content">
      <div class="meta">
        <h2 class="meta-title">Update EDC</h2>
        <p class="meta-description">Please kindly fill the fields below</p>
      </div>

      <form action="" method="post">
        <input type="hidden" name="edc_id" class="input" id="edc_id" value="<?= $data['edc']['edc_id'] ?>">
        <input type="hidden" name="prev_start_date" class="input" id="prev_start_date" value="<?= $data['edc']['start_date'] ?>">

        <div class="input-group">
          <label for="nominal">Nominal Payment</label>
          <input type="number" name="nominal" id="nominal" class="input nominal" placeholder="600000" required autocomplete="off" value="<?= $data['edc']['nominal'] ?>">
          <img src=" <?= BASEURL . 'public/images/error.svg' ?>" alt="error-icon" class="error-icon">
          <small class="message nominal-message"></small>
        </div>


        <div class="input-group">
          <label for="start_date">Start Date</label>
          <input type="date" class="input start-date" name="start_date" id="start_date" placeholder="Enter start date..." required autofocus="off" autocomplete="off" value="<?= $data['edc']['start_date'] ?>">
          <img src=" <?= BASEURL . 'public/images/error.svg' ?>" alt="error-icon" class="error-icon">
          <svg width="27" height="27" viewBox="0 0 27 27" fill="none" xmlns="http://www.w3.org/2000/svg">
            <rect x="2" y="4" width="23" height="20" rx="2" stroke="white" stroke-width="2" />
            <rect x="6" y="14" width="5" height="5" rx="1" stroke="white" stroke-width="2" />
            <rect x="16" y="14" width="5" height="5" rx="1" stroke="white" stroke-width="2" />
            <path d="M2 9H25" stroke="white" stroke-width="2" />
            <path d="M6 2L6 6" stroke="white" stroke-width="2" stroke-linecap="round" />
            <path d="M21 2L21 6" stroke="white" stroke-width="2" stroke-linecap="round" />
          </svg>
          <small class="message start-date-message"></small>
        </div>

        <div class="input-group">
          <button type="submit" name="add-class" id="submit-btn" class="submit-btn">
            <svg width="33" height="33" viewBox="0 0 33 33" fill="none" xmlns="http://www.w3.org/2000/svg">
              <rect x="0.5" y="0.5" width="32" height="32" rx="16" stroke="black" />
              <path d="M16.3333 8V25" stroke="black" stroke-linecap="round" />
              <path d="M7 16.5H26" stroke="black" stroke-linecap="round" />
            </svg>
            <span>Update EDC</span>
          </button>
        </div>
      </form>
    </div>

    <illustration-element></illustration-element>
  </div>
</div>