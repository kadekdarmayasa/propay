  <div class="top-bar">
    <div class="left-bar">
      <!-- Hamburger Menu -->
      <div class="sidebar-toggle">
        <span></span>
        <span></span>
        <span></span>
      </div>
      <!-- End of Hamburger Menu -->

      <!-- Breadcrumb -->
      <nav class="bread-crumb">
        <?php
        $url = strtolower($data['breadcrumb']) . '/';
        $breadcrumbs = explode('/', $data['breadcrumb']);
        ?>

        <?php if (count($breadcrumbs) > 1) : ?>
          <?php for ($i = 0; $i < count($breadcrumbs); $i++) : ?>
            <li>
              <?php if ($breadcrumbs[$i] == $breadcrumbs[count($breadcrumbs) - 1]) : ?>
                <a><?= $breadcrumbs[$i]; ?></a>
              <?php else : ?>
                <?php if ($breadcrumbs[$i] == 'EDC List') : ?>
                  <a href="<?= BASEURL . 'edc_list' . '/page/' . $data['page']  ?>" class="link">
                  <?php else : ?>
                    <a href="<?= BASEURL . strtolower($breadcrumbs[$i]) . '/page/' . $data['page']  ?>" class="link">
                    <?php endif; ?>
                    <?= $breadcrumbs[$i]; ?>
                    </a>
                    <span>/</span>
                  <?php endif; ?>
            </li>
          <?php endfor; ?>
        <?php else : ?>
          <li>
            <a>
              <?= $data['breadcrumb']; ?>
            </a>
          </li>
        <?php endif; ?>
      </nav>
      <!-- End of Breadcrumb -->
    </div>


    <div class="notification-profile">
      <div class="icons">
        <div class="notification">
          <svg width="24" height="20" viewBox="0 0 24 20" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M5.35714 14.0263L3 16.3947H10.6829L10.5303 17.0448C10.2959 18.0436 11.0538 19 12.0797 19C13.053 19 13.7983 18.1342 13.6535 17.1717L13.5366 16.3947H21L18.8571 14.0263V7.75C18.8571 4.02208 15.8351 1 12.1071 1C8.37922 1 5.35714 4.02208 5.35714 7.75V14.0263Z" stroke="#152A4A" stroke-width="2" />
          </svg>
          <span>99+</span>
        </div>
        <hr>
        <svg class="profile-toggle" width="9" height="7" viewBox="0 0 9 7" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M1 1L4.5828 6L8 1" stroke="#152A4A" stroke-linecap="round" />
        </svg>
      </div>
      <div class="profile">
        <h4 class="name"><?= $data['name'] ?></h4>
        <p class="role"><?= $data['role'] ?></p>
        <hr>
        <a href="<?= BASEURL . 'auth/logout' ?>">
          <svg width="44" height="39" viewBox="0 0 44 39" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M43 19.9471L14.2762 19.9471" stroke="#998899" stroke-linecap="round" />
            <path d="M22.2308 27.9241L13.9231 19.9472L22.2308 11.5714" stroke="#998899" stroke-linecap="round" />
            <path d="M37.1846 13.4767V13.4767C35.041 6.08547 28.2711 1 20.5753 1H19.5C9.28273 1 1 9.28273 1 19.5V19.5C1 29.7173 9.28273 38 19.5 38H20.5015C28.2384 38 35.0418 32.8807 37.1846 25.4464V25.4464" stroke="#998899" stroke-linecap="round" />
          </svg>
          <span class="link-name">Sign Out</span>
        </a>
      </div>
    </div>
  </div>