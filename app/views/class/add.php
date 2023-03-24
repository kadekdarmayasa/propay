<div class="main-content">
  <div class="add-class-container">
    <div class="first-content">
      <div class="meta">
        <h2 class="meta-title">Add New Class</h2>
        <p class="meta-description">Please kindly fill the fields below</p>
      </div>

      <form action="" method="post">
        <div class="input-group">
          <label for="class_name">Class Name</label>
          <input type="text" name="class_name" id="class_name" class="input class-name" placeholder="Enter Class Name" required autocomplete="off">
          <img src=" <?= BASEURL . 'public/images/error.svg' ?>" alt="error-icon" class="error-icon">
          <small class="message class-name-message"></small>
        </div>

        <div class="input-group">
          <label for="major_name">Major Name</label>
          <select name="major_name" id="major_name" required>
            <option value="">-- Select Major --</option>
            <?php foreach ($data['majors'] as $major) : ?>
              <option value="<?= $major ?>"><?= $major ?></option>
            <?php endforeach; ?>
          </select>
        </div>

        <div class="input-group">
          <button type="submit" name="add-class" id="submit-btn" class="submit-btn">
            <svg width="33" height="33" viewBox="0 0 33 33" fill="none" xmlns="http://www.w3.org/2000/svg">
              <rect x="0.5" y="0.5" width="32" height="32" rx="16" stroke="black" />
              <path d="M16.3333 8V25" stroke="black" stroke-linecap="round" />
              <path d="M7 16.5H26" stroke="black" stroke-linecap="round" />
            </svg>
            <span>Add Class</span>
          </button>
        </div>
      </form>
    </div>

    <illustration-element></illustration-element>
  </div>
</div>