<nav class="sidebar">
  <div class="brand">
    <a class="title-logo" href="<?= BASEURL . 'dashboard' ?>">
      <img src="<?= BASEURL . 'public/images/propay-logo.svg' ?>" alt="Propay Logo">
      <span class="brand-name">Propay</span>
    </a>
    <hr>
  </div>

  <div class="menu-items">
    <!-- Navbar Links -->
    <ul class="nav-links">
      <?php if ($activeTab == 'dashboard') : ?>
        <li class="active">
        <?php else : ?>
        <li>
        <?php endif; ?>
        <a href="<?= BASEURL . 'dashboard' ?>">
          <svg width="35" height="35" viewBox="0 0 35 35" fill="none" xmlns="http://www.w3.org/2000/svg">
            <rect x="0.5" y="0.5" width="15.4062" height="20.875" stroke="gray" />
            <rect x="19.0938" y="13.625" width="15.4062" height="20.875" stroke="gray" />
            <rect x="19.0938" y="0.5" width="15.4062" height="9.9375" stroke="gray" />
            <rect x="0.5" y="24.5625" width="15.4062" height="9.9375" stroke="gray" />
          </svg>
          <span class="link-name">Dashboard</span>
        </a>
        </li>

        <?php $tabs = explode('/', $activeTab);  ?>
        <?php if ($_SESSION['user']['role'] == 'admin') : ?>
          <?php if ($tabs[0] == 'student') : ?>
            <li class="active">
            <?php else : ?>
            <li>
            <?php endif; ?>
            <a href="<?= BASEURL . 'student' ?>">
              <svg width="38" height="38" viewBox="0 0 38 38" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M3.06055 6V16" stroke="#989898" stroke-width="2" />
                <path d="M2 5.23077L19.554 2L37 5.23077L19.554 9L2 5.23077Z" stroke="#989898" stroke-width="2" />
                <path d="M19.6871 8.98234L28.9694 7.21429L28.8243 13.0281C28.6997 18.0189 24.6181 22 19.6257 22C14.5438 22 10.4242 17.8804 10.4242 12.7985V7.21801L19.3053 8.98086L19.4961 9.01873L19.6871 8.98234Z" stroke="#989898" stroke-width="2" />
                <path d="M19.6871 8.98234L28.9694 7.21429L28.8243 13.0281C28.6997 18.0189 24.6181 22 19.6257 22C14.5438 22 10.4242 17.8804 10.4242 12.7985V7.21801L19.3053 8.98086L19.4961 9.01873L19.6871 8.98234Z" stroke="#989898" stroke-opacity="0.2" stroke-width="2" />
                <path d="M9.95459 11.0045V11.0045C15.7426 14.0254 22.6197 14.125 28.4928 11.2729L29.0455 11.0045" stroke="#989898" stroke-width="2" />
                <path d="M13.6666 25.5L18.9697 29L24.803 25.5" stroke="#989898" stroke-width="2" />
                <path d="M14.9293 21L13.5286 25.5714H12.0784C6.73866 25.5714 2.34096 29.7667 2.08954 35.1006L2 37H35.9394L35.7162 34.6328C35.232 29.4964 30.9196 25.5714 25.7604 25.5714H24.6263L23.2121 21.5" stroke="#989898" stroke-width="2" />
              </svg>
              <span class="link-name">Student</span>
            </a>
            </li>
          <?php endif; ?>

          <?php if ($_SESSION['user']['role'] == 'admin') : ?>
            <?php if ($tabs[0] == 'staff' && $tabs[1] != 'profile' && $tabs[1] != 'reset_password') : ?>
              <li class="active">
              <?php else : ?>
              <li>
              <?php endif; ?>
              <a href="<?= BASEURL . 'staff' ?>">
                <svg width="37" height="36" viewBox="0 0 37 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M10.3773 9.73697C9.76417 4.83221 13.5886 0.5 18.5315 0.5C22.8639 0.5 26.4522 3.86348 26.732 8.18686L26.75 8.46445V9.35345C26.75 13.9033 23.0668 17.593 18.5194 17.6034L18.2403 17.5814L18.201 18.0799L18.2403 17.5814C14.1934 17.2625 10.928 14.143 10.4245 10.1149L10.3773 9.73697Z" stroke="#989898" />
                  <path d="M10.3773 9.73697C9.76417 4.83221 13.5886 0.5 18.5315 0.5C22.8639 0.5 26.4522 3.86348 26.732 8.18686L26.75 8.46445V9.35345C26.75 13.9033 23.0668 17.593 18.5194 17.6034L18.2403 17.5814L18.201 18.0799L18.2403 17.5814C14.1934 17.2625 10.928 14.143 10.4245 10.1149L10.3773 9.73697Z" stroke="#989898" stroke-opacity="0.2" />
                  <path d="M13.0312 21.1207L18.5 25.3449L24.5156 21.1207" stroke="#989898" />
                  <path d="M14.125 16.2931L12.8889 21.2069H11.1609C5.7946 21.2069 1.38495 25.4425 1.16899 30.8044L1 35H36L35.6298 30.4039C35.2113 25.2093 30.8735 21.2069 25.6621 21.2069H24.3333L22.875 16.2931" stroke="#989898" />
                  <path d="M25.0625 30.1724V26.5517H29.4375V30.1724L27.25 31.9827L25.0625 30.1724Z" stroke="#989898" />
                </svg>
                <span class="link-name">Staff</span>
              </a>
              </li>
            <?php endif; ?>

            <?php if ($_SESSION['user']['role'] == 'admin') : ?>
              <?php if ($tabs[0] == 'class') : ?>
                <li class="active">
                <?php else :  ?>
                <li>
                <?php endif; ?>
                <a href="<?= BASEURL . 'classes' ?>">
                  <svg width="34" height="39" viewBox="0 0 34 39" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M15.1566 23.7391L17 20.9837L18.8434 23.7391" stroke="black" stroke-linecap="round" />
                    <path d="M10.9699 25.0109C10.9699 27.0922 9.34372 28.75 7.37349 28.75C5.40327 28.75 3.77711 27.0922 3.77711 25.0109C3.77711 22.9295 5.40327 21.2717 7.37349 21.2717C9.34372 21.2717 10.9699 22.9295 10.9699 25.0109Z" stroke="black" />
                    <path d="M6 30.5978H9.15662C12.1942 30.5978 14.6566 33.0603 14.6566 36.0978V38.5H0.5V36.0978C0.5 33.0603 2.96243 30.5978 6 30.5978Z" stroke="black" />
                    <path d="M29.8133 25.0109C29.8133 27.0922 28.1871 28.75 26.2169 28.75C24.2466 28.75 22.6205 27.0922 22.6205 25.0109C22.6205 22.9295 24.2466 21.2717 26.2169 21.2717C28.1871 21.2717 29.8133 22.9295 29.8133 25.0109Z" stroke="black" />
                    <path d="M24.8434 30.5978H28C31.0376 30.5978 33.5 33.0603 33.5 36.0978V38.5H19.3434V36.0978C19.3434 33.0603 21.8058 30.5978 24.8434 30.5978Z" stroke="black" />
                    <rect x="0.5" y="0.5" width="33" height="18.0761" rx="3.5" stroke="black" />
                    <line x1="3.77711" y1="5.43478" x2="22.0301" y2="5.43478" stroke="black" stroke-linecap="round" />
                    <line x1="3.77711" y1="9.25" x2="30.2229" y2="9.25" stroke="black" stroke-linecap="round" />
                    <line x1="3.77711" y1="13.0652" x2="30.2229" y2="13.0652" stroke="black" stroke-linecap="round" />
                  </svg>

                  <span class="link-name">Class</span>
                </a>
                </li>
              <?php endif; ?>

              <?php if ($tabs[0] == 'edc') : ?>
                <li class="edc active">
                <?php else : ?>
                <li>
                <?php endif; ?>
                <?php if ($_SESSION['user']['role'] == 'admin') : ?>
                  <a href="<?= BASEURL . 'edc' ?>">
                  <?php elseif ($_SESSION['user']['role'] == 'staff') : ?>
                    <a href="<?= BASEURL . 'edc/payment' ?>">
                    <?php else : ?>
                      <a href="<?= BASEURL . 'edc/payment_history' ?>">
                      <?php endif; ?>
                      <svg width="39" height="30" viewBox="0 0 39 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1.02637 5L34.8948 5" stroke="#989898" stroke-linecap="round" />
                        <path d="M1.02637 10L34.8948 10" stroke="#989898" stroke-linecap="round" />
                        <path d="M8.73687 21C8.73687 22.3685 7.59456 23.5 6.15793 23.5C4.72129 23.5 3.57898 22.3685 3.57898 21C3.57898 19.6315 4.72129 18.5 6.15793 18.5C7.59456 18.5 8.73687 19.6315 8.73687 21Z" stroke="#989898" />
                        <path d="M12.8421 21C12.8421 22.3685 11.6998 23.5 10.2632 23.5C8.82652 23.5 7.6842 22.3685 7.6842 21C7.6842 19.6315 8.82652 18.5 10.2632 18.5C11.6998 18.5 12.8421 19.6315 12.8421 21Z" fill="fffffff" stroke="#989898" />
                        <rect x="0.5" y="0.5" width="34.9211" height="26" rx="0.5" stroke="#989898" />
                      </svg>
                      <span class="link-name">EDC</span>
                      <svg id="sub-menu-toggler" width="19" height="31" viewBox="0 0 19 31" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1.5 1.5L17 15.2791L1.5 30" stroke="black" stroke-width="2" stroke-linecap="round" />
                      </svg>
                      </a>

                      <ul class="sub-menu">
                        <?php if ($_SESSION['user']['role'] == 'admin') : ?>
                          <?php if (isset($tabs[1]) && $tabs[1] == 'list') : ?>
                            <li class="sub-menu-active">
                            <?php else : ?>
                            <li>
                            <?php endif; ?>
                            <a href="<?= BASEURL . 'edc/' ?>" class="link-name">List</a>
                            </li>
                          <?php endif; ?>

                          <?php if ($_SESSION['user']['role'] == 'admin' || $_SESSION['user']['role'] == 'staff') : ?>
                            <?php if (isset($tabs[1]) && $tabs[1] == 'payment') : ?>
                              <li class="sub-menu-active">
                              <?php else : ?>
                              <li>
                              <?php endif; ?>
                              <a href="<?= BASEURL . 'edc/payment' ?>" class="link-name">Payment</a>
                              </li>
                            <?php endif; ?>

                            <?php if (isset($tabs[1]) && $tabs[1] == 'payment-history') : ?>
                              <li class="sub-menu-active">
                              <?php else : ?>
                              <li>
                              <?php endif; ?>
                              <a href="<?= BASEURL . 'edc/payment_history' ?>" class="link-name">Payment History</a>
                              </li>

                              <?php if ($_SESSION['user']['role'] == 'admin') : ?>
                                <?php if (isset($tabs[1]) && $tabs[1] == 'report') : ?>
                                  <li class="sub-menu-active">
                                  <?php else : ?>
                                  <li>
                                  <?php endif; ?>
                                  <a href="<?= BASEURL . 'edc/report' ?>" class="link-name">Report</a>
                                  </li>
                                <?php endif; ?>
                      </ul>
                </li>
    </ul>

    <!-- Logout and Mode -->
    <ul class="logout-mode">
      <hr>
      <li><a href="<?= BASEURL . 'auth/logout' ?>">
          <svg width="44" height="39" viewBox="0 0 44 39" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M43 19.9471L14.2762 19.9471" stroke="#998899" stroke-linecap="round" />
            <path d="M22.2308 27.9241L13.9231 19.9472L22.2308 11.5714" stroke="#998899" stroke-linecap="round" />
            <path d="M37.1846 13.4767V13.4767C35.041 6.08547 28.2711 1 20.5753 1H19.5C9.28273 1 1 9.28273 1 19.5V19.5C1 29.7173 9.28273 38 19.5 38H20.5015C28.2384 38 35.0418 32.8807 37.1846 25.4464V25.4464" stroke="#998899" stroke-linecap="round" />
          </svg>
          <span class="link-name">Sign Out</span>
        </a></li>

      <li class="mode">
        <a>
          <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M6.92233 6.84045L12.7271 1.46756C9.27673 17.2264 23.3678 31.4664 39.0833 27.8237L33.3441 33.2566C28.4083 37.929 21.4255 39.7524 14.8353 38.0896C8.31697 36.445 3.22727 31.3553 1.58264 24.8369C-0.0633953 18.313 1.9845 11.4109 6.92233 6.84045Z" stroke="#998899" stroke-linecap="round" />
          </svg>
          <span class="link-name">Dark Mode</span>
        </a>
        <div class="mode-toggle">
          <span class="switch"></span>
        </div>
      </li>
    </ul>
  </div>
</nav>