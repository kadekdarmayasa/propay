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

  <?php if ($activeTab == 'class') : ?>
    <script src="<?= BASEURL . 'public/js/class/index.js' ?>" type="module"></script>
  <?php endif; ?>

  <?php if ($activeTab == 'staff') : ?>
    <script src="<?= BASEURL . 'public/js/toggle_password.js' ?>"></script>
    <script src="<?= BASEURL . 'public/js/staff/index.js' ?>"></script>
  <?php endif; ?>
<?php endif ?>

</body>

</html>