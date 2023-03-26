<script src="<?= BASEURL . 'public/js/index.js' ?>"></script>
<script src="<?= BASEURL . 'public/js/helpers/flasher.js' ?>"></script>

<?php if ($activeTab == 'login') : ?>
  <script src="<?= BASEURL . 'public/js/auth/switcher-form.js' ?>"></script>
  <script src="<?= BASEURL . 'public/js/toggle_password.js' ?>"></script>
<?php endif; ?>

<?php if ($activeTab !== 'login') : ?>
  <script src="<?= BASEURL . 'public/js/core/index.js' ?>" type="module"></script>

  <?php if ($activeTab == 'dashboard') : ?>
    <script src="<?= BASEURL . 'public/js/dashboard/index.js' ?>" type="module"></script>
  <?php endif; ?>

  <?php $tabs = explode('/', $activeTab); ?>

  <?php if ($tabs[0] == 'class') : ?>
    <?php if ($tabs[1] == 'index') : ?>
      <script src="<?= BASEURL . 'public/js/class/index.js' ?>" type="module"></script>
    <?php elseif ($tabs[1] == 'update') : ?>
      <script src="<?= BASEURL . 'public/js/class/update.js' ?>" type="module"></script>
    <?php else : ?>
      <script src="<?= BASEURL . 'public/js/class/add.js' ?>" type="module"></script>
    <?php endif; ?>
  <?php endif; ?>


  <?php if ($tabs[0] == 'staff') : ?>
    <?php if ($tabs[1] == 'index') : ?>
      <script src="<?= BASEURL . 'public/js/staff/index.js' ?>" type="module"></script>
    <?php endif; ?>

    <?php if ($tabs[1] == 'add') : ?>
      <script src="<?= BASEURL . 'public/js/staff/add.js' ?>" type="module"></script>
      <script src="<?= BASEURL . 'public/js/toggle_password.js' ?>"></script>
    <?php endif; ?>

    <?php if ($tabs[1] == 'update') : ?>
      <script src="<?= BASEURL . 'public/js/staff/update.js' ?>" type="module"></script>
    <?php endif; ?>
  <?php endif; ?>

  <?php if ($tabs[0] == 'student') : ?>
    <?php if ($tabs[1] == 'index') : ?>
      <script src="<?= BASEURL . 'public/js/student/index.js' ?>" type="module"></script>
    <?php endif; ?>

    <?php if ($tabs[1] == 'add') : ?>
      <script src="<?= BASEURL . 'public/js/student/add.js' ?>" type="module"></script>
      <script src="<?= BASEURL . 'public/js/toggle_password.js' ?>"></script>
    <?php endif; ?>

    <?php if ($tabs[1] == 'update') : ?>
      <script src="<?= BASEURL . 'public/js/student/update.js' ?>" type="module"></script>
    <?php endif; ?>
  <?php endif ?>

  <?php if ($tabs[0] == 'edc') : ?>
    <?php if ($tabs[1] == 'list') : ?>
      <script src="<?= BASEURL . 'public/js/edc/list.js' ?>" type="module"></script>
    <?php endif; ?>

    <?php if ($tabs[1] == 'add_edc_list') : ?>
      <script src="<?= BASEURL . 'public/js/edc/add_edc_list.js' ?>" type="module"></script>
    <?php endif; ?>
  <?php endif; ?>
<?php endif ?>

</body>

</html>