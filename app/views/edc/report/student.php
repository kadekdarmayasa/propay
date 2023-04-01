<div class="main-content">
  <div class="main-container">
    <div class="meta">
      <h2 class="meta-title">Report Per Student</h2>
    </div>

    <form action="" method="post">
      <div class="input-group">
        <label for="sin">Student ID Number</label>
        <input type="number" name="sin" id="sin" class="input class-name" placeholder="Enter nis..." required autocomplete="off">
        <img src=" <?= BASEURL . 'public/images/error.svg' ?>" alt="error-icon" class="error-icon">
        <small class="message sin-message"></small>
      </div>


      <div class="dates" style="display: flex; gap: 20px">
        <div class="input-group" style="width: 100%">
          <label for="start-date">Start Date</label>
          <input type="date" class="input" name="start-date" id="start-date" placeholder="Enter start date..." required autofocus="off" autocomplete="off">
          <svg width="27" height="27" viewBox="0 0 27 27" fill="none" xmlns="http://www.w3.org/2000/svg">
            <rect x="2" y="4" width="23" height="20" rx="2" stroke="white" stroke-width="2" />
            <rect x="6" y="14" width="5" height="5" rx="1" stroke="white" stroke-width="2" />
            <rect x="16" y="14" width="5" height="5" rx="1" stroke="white" stroke-width="2" />
            <path d="M2 9H25" stroke="white" stroke-width="2" />
            <path d="M6 2L6 6" stroke="white" stroke-width="2" stroke-linecap="round" />
            <path d="M21 2L21 6" stroke="white" stroke-width="2" stroke-linecap="round" />
          </svg>
        </div>

        <div class="input-group" style="width: 100%">
          <label for="end-date">End Date</label>
          <input type="date" class="input" name="end-date" id="end-date" placeholder="Enter end date..." required autofocus="off" autocomplete="off">
          <svg width="27" height="27" viewBox="0 0 27 27" fill="none" xmlns="http://www.w3.org/2000/svg">
            <rect x="2" y="4" width="23" height="20" rx="2" stroke="white" stroke-width="2" />
            <rect x="6" y="14" width="5" height="5" rx="1" stroke="white" stroke-width="2" />
            <rect x="16" y="14" width="5" height="5" rx="1" stroke="white" stroke-width="2" />
            <path d="M2 9H25" stroke="white" stroke-width="2" />
            <path d="M6 2L6 6" stroke="white" stroke-width="2" stroke-linecap="round" />
            <path d="M21 2L21 6" stroke="white" stroke-width="2" stroke-linecap="round" />
          </svg>
        </div>
      </div>

      <div class="input-group prev-submit-btn">
        <a href="<?= BASEURL . 'edc_report'  ?>" name="prev-btn" class="prev-btn">
          <span>Cancel</span>
        </a>
        <button type="submit" name="generate" id="submit-btn" class="submit-btn">
          <span>Generate Report</span>
        </button>
      </div>
    </form>
  </div>
</div>