<script src="<?= BASEURL . 'public/js/index.js' ?>"></script>
<script src="<?= BASEURL . 'public/js/helpers/flasher.js' ?>"></script>

<?php if ($activeTab == 'login') : ?>
  <script src="<?= BASEURL . 'public/js/auth/login.js' ?>" type="module"></script>
<?php endif; ?>

<?php if ($activeTab !== 'login') : ?>
  <script src="<?= BASEURL . 'public/js/core/index.js' ?>" type="module"></script>

  <?php if ($activeTab == 'dashboard') : ?>
    <script src="<?= BASEURL . 'public/js/dashboard/index.js' ?>" type="module"></script>
  <?php endif; ?>
<?php endif ?>

</body>

</html>