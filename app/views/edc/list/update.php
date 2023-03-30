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

        <div class="input-group prev-submit-btn">
          <a href="<?= BASEURL . 'edc/list'  ?>" class="prev-btn">
            <span>Cancel</span>
          </a>
          <button type="submit" name="add-class" id="submit-btn" class="submit-btn">
            <span>Update EDC</span>
            <svg width="21" height="19" viewBox="0 0 21 19" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M4.63638 12.7742L5.21649 10.4983C5.27328 10.2755 5.40513 10.0791 5.58984 9.94209L17.691 0.967977C18.415 0.431087 19.4359 0.57489 19.9834 1.29088C20.5424 2.02193 20.3949 3.06908 19.6557 3.61727L7.57334 12.5774C7.40103 12.7052 7.19219 12.7742 6.97767 12.7742H4.63638Z" stroke="#989898" stroke-linecap="round" />
              <path d="M16.4545 2.03223L18.2727 4.35481" stroke="#989898" stroke-linecap="round" />
              <path d="M13.5916 1.16113H3C1.89543 1.16113 1 2.05656 1 3.16113V15.9998C1 17.1044 1.89543 17.9998 3 17.9998H16.5758C17.6803 17.9998 18.5758 17.1044 18.5758 15.9998V6.32138" stroke="#989898" stroke-linecap="round" />
            </svg>
          </button>
        </div>
      </form>
    </div>

    <illustration-element></illustration-element>
  </div>
</div>