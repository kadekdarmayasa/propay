<div class="main-content">
  <div class="main-container">
    <div class="first-content">
      <div class="meta">
        <h2 class="meta-title">Update Class</h2>
        <p class="meta-description">Please kindly fill the fields below</p>
      </div>

      <form action="" method="post">
        <input type="hidden" class="input class_id" name="class_id" id="class_id" value="<?= $data['class']['class_id'] ?>">
        <input type="hidden" class="prev_class_name" name="prev_class_name" id="prev_class_name" value="<?= $data['class']['class_name'] ?>">

        <div class="input-group">
          <label for="class_name">Class Name</label>
          <input type="text" name="class_name" id="class_name" class="input class-name" placeholder="Enter Class Name" required autocomplete="off" value="<?= $data['class']['class_name'] ?>">
          <img src=" <?= BASEURL . 'public/images/error.svg' ?>" alt="error-icon" class="error-icon">
          <small class="message class-name-message"></small>
        </div>

        <div class="input-group">
          <label for="major_name">Major Name</label>
          <select name="major_name" id="major_name" required class="input">
            <option value="">-- Select Major --</option>
            <?php foreach ($data['majors'] as $major) : ?>
              <?php if ($data['class']['major_name'] == $major) : ?>
                <option value="<?= $major ?>" selected><?= $major ?></option>
              <?php else : ?>
                <option value="<?= $major ?>"><?= $major ?></option>
              <?php endif; ?>
            <?php endforeach; ?>
          </select>
        </div>

        <div class="input-group prev-submit-btn">
          <a href="<?= BASEURL . 'classes'  ?>" name="prev-btn" class="prev-btn">
            <span>Cancel</span>
          </a>
          <button type="submit" name="update-class" id="submit-btn" class="submit-btn">
            <span>Update Class</span>
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