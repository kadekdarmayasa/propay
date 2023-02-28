<script src="<?= BASEURL . 'public/js/index.js' ?>"></script>
<script src="<?= BASEURL . 'public/js/flasher.js' ?>"></script>

<?php if ($activeTab == 'login') : ?>
  <script src="<?= BASEURL . 'public/js/auth/login.js' ?>" type="module"></script>
<?php endif; ?>

<?php if ($activeTab !== 'login') : ?>
  <script src="<?= BASEURL . 'public/js/dashboard/top-bar.js' ?>"></script>
  <script src="<?= BASEURL . 'public/js/dashboard/index.js' ?>"></script>
<?php endif ?>

</body>

</html>