<div class="main-content">
  <div class="main-container">
    <div class="meta">
      <h2 class="meta-title">Report Per Class</h2>
    </div>

    <form action="" method="post">
      <input type="hidden" id="sin">
      <input type="hidden" id="class_id" name="class_id">

      <div class="input-group">
        <label for="class-name">Class Name</label>
        <input type="text" name="class-name" id="class-name" class="input class-name" placeholder="Enter class name..." required autocomplete="off">
        <img src=" <?= BASEURL . 'public/images/error.svg' ?>" alt="error-icon" class="error-icon">
        <small class="message class-name-message"></small>
      </div>

      <div style="display: flex; gap: 20px">
        <div class="input-group" style="width: 60%">
          <label for="month">Month</label>
          <select name="month" id="month" class="input" autocomplete="off">
            <option value="">-- Select Month --</option>
            <?php foreach ($data['months'] as $month) : ?>
              <option value="<?= $month; ?>"><?= $month; ?></option>
            <?php endforeach; ?>
          </select>
        </div>

        <div class="input-group" style="width: 40%">
          <label for="year">Year</label>
          <select name="year" id="year" class="input" autocomplete="off">
            <option value="">-- Select Year --</option>
          </select>
        </div>
      </div>

      <div class="input-group prev-submit-btn">
        <a href="<?= BASEURL . 'payment_report'  ?>" name="prev-btn" class="prev-btn">
          <span>Cancel</span>
        </a>
        <button type="submit" name="generate" id="submit-btn" class="submit-btn">
          <span>Generate Report</span>
        </button>
      </div>
    </form>
  </div>
</div>