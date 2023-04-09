<div class="main-content">
  <div class="edc-payment-container">
    <div class="payment-header">
      <div class="payment-title">
        <h2>EDC Payment</h2>
        <p>Find student who want to pay</p>
      </div>

      <div class="payment-search">
        <form action="" method="post">
          <?php if (isset($data['keyword']) && $data['keyword'] != '') : ?>
            <input type="number" name="sin" id="sin" placeholder="Search student..." value="<?= $data['keyword'] ?>" autocomplete="off">
          <?php else : ?>
            <input type="number" name="sin" id="sin" placeholder="Search student..." autocomplete="off">
          <?php endif; ?>
          <button type="submit" name="search"><svg width="17" height="18" viewBox="0 0 17 18" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M13.7857 6.96721C13.7857 10.5273 10.8234 13.4344 7.14286 13.4344C3.4623 13.4344 0.5 10.5273 0.5 6.96721C0.5 3.40713 3.4623 0.5 7.14286 0.5C10.8234 0.5 13.7857 3.40713 13.7857 6.96721Z" stroke="#989898" />
              <path d="M12 12.2623L16 17" stroke="#989898" stroke-linecap="round" />
            </svg>
          </button>
        </form>
      </div>
    </div>

    <div class="payment-body">
      <?php if (isset($data['isStudentFound']) && $data['isStudentFound'] == false) : ?>
        <illustration-element src="<?= BASEURL . 'public/images/not-found-illustration.svg' ?>" id="not-found-illustration">
        </illustration-element>
      <?php elseif (isset($data['isStudentFound']) && $data['isStudentFound'] == true) : ?>
        <!-- Student Bio -->
        <div class="student-bio">
          <div class="student-bio-header">
            <h3>Student Bio</h3>
          </div>
          <div class="student-bio-body">
            <div class="left-body">
              <div class="student-bio-item">
                <small>Student ID Number</small>
                <p><?= $data['student']['sin']; ?></p>
              </div>
              <div class="student-bio-item">
                <small>Student Name</small>
                <p><?= $data['student']['student_name']; ?></p>
              </div>
              <div class="student-bio-item">
                <small>Class Name</small>
                <p><?= $data['student']['class']['class_name']; ?></p>
              </div>
              <div class="student-bio-item">
                <small>Enrollment Date</small>
                <p><?= date('d F Y', strtotime($data['student']['enrollment_date'])); ?></p>
              </div>
              <div class="student-bio-item">
                <small><?= $data['student']['religion']; ?></small>
                <p>Hindu</p>
              </div>
            </div>
            <div class="right-body">
              <div class="student-bio-item">
                <small>National Student Number</small>
                <p><?= $data['student']['nsn']; ?></p>
              </div>
              <div class="student-bio-item">
                <small>Term</small>
                <p><?= $data['student']['term']; ?></p>
              </div>
              <div class="student-bio-item">
                <small>Major</small>
                <p><?= $data['student']['class']['major_name']; ?></p>
              </div>
              <div class="student-bio-item">
                <small>Birth Date</small>
                <p><?= $data['student']['date_of_birth']; ?></p>
              </div>
              <div class="student-bio-item address">
                <small>Address</small>
                <p><?= $data['student']['address']; ?></p>
              </div>
            </div>
          </div>
        </div>

        <!-- Student Bills -->
        <div class="student-bills table-container">
          <div class="header">
            <div class="left-header">
              <h2>Student Bills</h2>
              <form action="" method="post">
                <?php if (isset($_SESSION['search-payment-keyword']) && $_SESSION['search-payment-keyword'] != '') : ?>
                  <input type="text" name="payment-field" id="payment-field" placeholder="Search payment..." value="<?= $_SESSION['search-payment-keyword'] ?>" autocomplete="off">
                <?php else : ?>
                  <input type="text" name="payment-field" id="payment-field" placeholder="Search payment..." autocomplete="off">
                <?php endif; ?>
                <button type="submit" name="search-payment"><svg width="17" height="18" viewBox="0 0 17 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M13.7857 6.96721C13.7857 10.5273 10.8234 13.4344 7.14286 13.4344C3.4623 13.4344 0.5 10.5273 0.5 6.96721C0.5 3.40713 3.4623 0.5 7.14286 0.5C10.8234 0.5 13.7857 3.40713 13.7857 6.96721Z" stroke="#989898" />
                    <path d="M12 12.2623L16 17" stroke="#989898" stroke-linecap="round" />
                  </svg>
                </button>
              </form>
            </div>
            <div class="right-header">
              <div class="row-per-page">
                <p>Rows per page</p>
                <form action="" method="post" style="visibility: hidden; user-select: none; cursor: none; position: absolute;">
                  <select name="row_per_page" id="select">
                    <option value=""></option>
                  </select>
                </form>

                <div class="row-selected">
                  <span></span>
                  <svg width="7" height="6" viewBox="0 0 7 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1 1L3.55914 5L6 1" stroke="#152A4A" stroke-linecap="round" />
                  </svg>
                  <ul class="list-of-row payment">
                    <li><a href="" class="selected">6</a></li>
                    <li><a href="">12</a></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>

          <div class="data">
            <table>
              <tr>
                <th>#</th>
                <th>Month</th>
                <th>Year</th>
                <th>Due Date</th>
                <th>Total Bills</th>
                <th>Payment Amount</th>
                <th>Status</th>
                <th>Actions</th>
              </tr>
              <?php
              $number = $data['pagination']['start_data'] + 1;
              for ($i = 0; $i < count($data['payment']); $i++) : ?>
                <tr>
                  <td><?= $number++; ?></td>
                  <td><?= $data['payment'][$i]['month'] ?></td>
                  <td><?= $data['payment'][$i]['year'] ?></td>
                  <td><?= $data['payment'][$i]['due_date']  ?></td>

                  <?php
                  $enrollment_date_time = strtotime($data['student']['enrollment_date']);
                  $start_date_time = strtotime($data['student']['edc']['start_date']);
                  $due_date_time = strtotime($data['payment'][$i]['due_date']);

                  if ($enrollment_date_time >= $due_date_time && $data['payment'][$i] != 'Paid') : ?>
                    <td>Rp. 0</td>
                  <?php elseif (($enrollment_date_time <= $due_date_time || $enrollment_date_time <= $start_date_time) && $data['payment'][$i]['payment_status'] == 'Paid') : ?>
                    <td>Rp. <?= number_format($data['payment'][$i]['payment_amount'], 0, ',', '.'); ?></td>
                  <?php else : ?>
                    <td>Rp. <?= number_format($data['student']['edc']['nominal'], 0, ',', '.'); ?></td>
                  <?php endif; ?>

                  <?php if ($data['payment'][$i]['payment_amount'] == null) : ?>
                    <td>
                      <?php
                      $dash = '';
                      $nominalArr = str_split($data['student']['edc']['nominal']);
                      for ($nominalIndex = 0; $nominalIndex < count($nominalArr); $nominalIndex++) : ?>
                        <?php $dash .= '-'  ?>
                      <?php endfor; ?>
                      <?= $dash ?>
                    </td>
                  <?php else : ?>
                    <td>Rp. <?= number_format($data['payment'][$i]['payment_amount'], 0, ',', '.');  ?></td>
                  <?php endif; ?>

                  <?php if ($data['payment'][$i]['payment_status'] == 'Unpaid') : ?>
                    <?php if ($enrollment_date_time >= $due_date_time && $data['payment'][$i] != 'Paid') : ?>
                      <td>------</td>
                    <?php else : ?>
                      <td class="unpaid">
                        <div class="indicator"></div>
                        <p><?= $data['payment'][$i]['payment_status']; ?></p>
                      </td>
                    <?php endif; ?>
                  <?php endif; ?>

                  <?php if ($data['payment'][$i]['payment_status'] == 'Paid Half') : ?>
                    <td class="paid-half">
                      <div class="indicator"></div>
                      <p><?= $data['payment'][$i]['payment_status']; ?></p>
                    </td>
                  <?php endif; ?>

                  <?php if ($data['payment'][$i]['payment_status'] == 'Paid') : ?>
                    <td class="paid">
                      <div class="indicator"></div>
                      <p><?= $data['payment'][$i]['payment_status']; ?></p>
                    </td>
                  <?php endif; ?>

                  <?php
                  if ($i > 0) $prev_index  = $i - 1;
                  $prev_payment;
                  $payment_status = $data['payment'][$i]['payment_status'];

                  if ($payment_status == 'Unpaid' || $payment_status == 'Paid Half') : ?>
                    <?php if ($enrollment_date_time >= $due_date_time && $data['payment'][$i] != 'Paid') : ?>
                      <td>------</td>
                    <?php else : ?>
                      <td>
                        <a href="" class="pay-btn" data-payment-date="<?= $data['payment'][$i]['due_date'] ?>" data-payment-id="<?= $data['payment'][$i]['payment_id'] ?>">
                          <svg width="53" height="60" viewBox="0 0 53 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect x="0.696898" y="-0.110377" width="6.74323" height="16.046" rx="3.37161" transform="matrix(0.586046 -0.810278 0.807751 0.589524 2.37764 12.373)" fill="white" stroke="black" />
                            <path d="M39.9519 33.5075V25.8859V7C39.9519 5.89543 39.0564 5 37.9519 5H13.5977C12.4932 5 11.5977 5.89543 11.5977 7V53C11.5977 54.1046 12.4932 55 13.5977 55H32.1419C32.6942 55 33.1419 54.5523 33.1419 54V45.7463V38.5075C33.1419 35.746 35.3805 33.5075 38.1419 33.5075H39.9519Z" fill="white" />
                            <path d="M48 55V37.0896V20.5205C48 19.7796 47.3995 19.1791 46.6586 19.1791V19.1791C42.9546 19.1791 39.9519 22.1818 39.9519 25.8859V33.5075M39.9519 33.5075H38.1419C35.3805 33.5075 33.1419 35.746 33.1419 38.5075V45.7463V54C33.1419 54.5523 32.6942 55 32.1419 55H13.5977C12.4932 55 11.5977 54.1046 11.5977 53V7C11.5977 5.89543 12.4932 5 13.5977 5H37.9519C39.0564 5 39.9519 5.89543 39.9519 7V33.5075Z" stroke="black" stroke-linecap="round" />
                            <path d="M11.5977 46.791H33.1419" stroke="black" />
                            <path d="M21.2555 50.5224L29.4274 50.5224" stroke="black" stroke-linecap="round" />
                            <path d="M12 11.7164H39.8281" stroke="black" />
                            <rect x="17.2981" y="16.694" width="16.8297" height="16.9104" rx="8.41484" stroke="black" />
                            <path d="M27.9416 22.7332V22.7332C27.9416 21.6564 27.0688 20.7835 25.992 20.7835H25.2647M22.7413 26.4645V26.8494C22.7413 28.2854 23.9054 29.4496 25.3415 29.4496V29.4496M25.2647 20.7835H24.8355C23.6789 20.7835 22.7413 21.7212 22.7413 22.8778V22.8778C22.7413 24.0344 23.6789 24.972 24.8355 24.972H25.7028C26.9393 24.972 27.9416 25.9743 27.9416 27.2108V27.2108C27.9416 28.4472 26.9393 29.4496 25.7028 29.4496H25.3415M25.2647 20.7835V19.1791M25.3415 29.4496V30.9421" stroke="black" stroke-linecap="round" />
                            <rect x="0.696898" y="-0.110377" width="6.74323" height="16.046" rx="3.37161" transform="matrix(0.586046 -0.810278 0.807751 0.589524 5.21813 22.6697)" fill="white" stroke="black" />
                            <rect x="0.696898" y="-0.110377" width="6.74323" height="16.046" rx="3.37161" transform="matrix(0.586046 -0.810278 0.807751 0.589524 5.28926 31.9428)" fill="white" stroke="black" />
                            <rect x="0.696898" y="-0.110377" width="6.74323" height="16.046" rx="3.37161" transform="matrix(0.586046 -0.810278 0.807751 0.589524 5.28926 40.898)" fill="white" stroke="black" />
                          </svg>
                          <span class="tooltip">Pay Bill</span>
                        </a>
                      </td>
                    <?php endif; ?>
                  <?php else : ?>
                    <td>
                      <a class="no-action-btn">
                        <svg width="33" height="33" viewBox="0 0 33 33" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <rect x="0.5" y="0.5" width="32" height="32" rx="16" stroke="black" />
                          <path d="M9.5 15L15.5 22.5L24 10.5" stroke="black" stroke-linecap="round" />
                        </svg>
                        <span class="tooltip">Paid</span>
                      </a>
                    </td>
                  <?php endif; ?>
                </tr>
              <?php endfor; ?>
            </table>
          </div>

          <?php if ($data['payment_count'] > 0) : ?>
            <!-- Classlist Footer -->
            <div class="cls-footer">
              <div class="footer-left">
                <?= $data['pagination']['start_data'] + 1 ?>
                <?php if ($data['pagination']['start_data'] + 1 != $data['payment_count']) : ?>
                  -
                  <?php if ($data['payment_count'] < $data['pagination']['end_data']) : ?>
                    <?= $data['payment_count'] ?>
                  <?php else : ?>
                    <?= $data['pagination']['end_data'] ?>
                  <?php endif; ?>
                <?php endif; ?>
                of
                <?= $data['payment_count']; ?>
                <?php if ($data['payment_count'] < 2) : ?>
                  Item
                <?php else : ?>
                  Items
                <?php endif; ?>
              </div>
              <?php if ($data['pagination']['total_page'] > 1) : ?>
                <div class="footer-right">
                  <nav class="pagination">
                    <?php if ($data['pagination']['total_page'] >= 2) : ?>
                      <!-- Prev Btn -->
                      <?php if ($data['pagination']['current_page'] != 1) : ?>
                        <li class="prev-btn">
                          <a class="page-link" href="<?= BASEURL . 'payment/page/' . $data['pagination']['current_page'] - 1 . '/' . $data['student']['sin'] ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span> Prev
                          </a>
                        </li>
                      <?php endif; ?>
                      <!-- End of Prev Btn -->

                      <!-- Pagination Page -->
                      <?php if ($data['pagination']['total_page'] > 5) : ?>
                        <?php
                        $end_page_number = $data['pagination']['end_number'];
                        $total_page = $data['pagination']['total_page'];

                        if ($end_page_number >= $total_page) :
                        ?>
                          <li class="page-item">
                            <a class="page-link" href="<?= BASEURL . 'payment/page/' . 1 . '/' . $data['student']['sin'] ?>">1</a>
                          </li>
                          <li class="page-item dots">
                            <a class="page-link">...</a>
                          </li>
                        <?php endif; ?>
                      <?php endif; ?>

                      <?php for ($page_number = $data['pagination']['start_number']; $page_number <= $data['pagination']['end_number']; $page_number++) : ?>
                        <?php if ($page_number == $data['pagination']['current_page']) : ?>
                          <li class="page-item active">
                            <a class="page-link" href="<?= BASEURL . 'payment/page/' . $page_number . '/' . $data['student']['sin'] ?>">
                              <?= $page_number; ?>
                            </a>
                          </li>
                        <?php else : ?>
                          <li class="page-item">
                            <a class="page-link" href="<?= BASEURL . 'payment/page/' . $page_number . '/' . $data['student']['sin']  ?>">
                              <?= $page_number; ?>
                            </a>
                          </li>
                        <?php endif; ?>
                      <?php endfor; ?>


                      <?php
                      if ($data['pagination']['end_number'] != $data['pagination']['total_page']) :
                      ?>
                        <li class="page-item dots">
                          <a class="page-link">...</a>
                        </li>
                        <li class="page-item">
                          <a class="page-link" href="<?= BASEURL . 'payment/page/' . $data['pagination']['total_page'] . '/' . $data['student']['sin'] ?> ">
                            <?= $data['pagination']['total_page']; ?>
                          </a>
                        </li>
                      <?php endif ?>
                      <!-- End of Pagination Page -->

                      <!-- Next Btn -->
                      <?php if ($data['pagination']['current_page'] != $data['pagination']['total_page']) : ?>
                        <li class="next-btn">
                          <a class="page-link" href="<?= BASEURL . 'payment/page/' . $data['pagination']['current_page'] + 1 . '/' . $data['student']['sin'] ?>" aria-label="Next">
                            Next <span aria-hidden="true">&raquo;</span>
                          </a>
                        </li>
                      <?php endif; ?>
                      <!-- End of Next Btn -->
                    <?php endif; ?>
                  </nav>
                </div>
              <?php endif; ?>
            </div>
            <!-- End of Classlist Footer -->
          <?php endif; ?>
        </div>
      <?php else : ?>
        <illustration-element src="<?= BASEURL . 'public/images/search-illustration.svg' ?>" id="waiting-for-search-illustration"></illustration-element>
      <?php endif; ?>
    </div>
  </div>
</div>

<div class="overlay-input-form">
  <div class="input-form-container">
    <form action="" method="post" id="payment-form">
      <input type="hidden" name="payment_id" class="input" id="payment_id">
      <input type="hidden" name="staff_id" class="input" id="staff_id" value="<?= $_SESSION['user']['staff_id']; ?>">
      <input type="hidden" name="sin" class="input" id="sin" value="<?= $data['keyword'] ?>">

      <div class="input-group">
        <label for="payment_amount">Payment Amount</label>
        <input type="number" name="payment_amount" id="payment_amount" class="input payment-amount" placeholder="Enter payment amount..." required autocomplete="off">
        <img src=" <?= BASEURL . 'public/images/error.svg' ?>" alt="error-icon" class="error-icon">
        <small class="message payment-amount-message"></small>
      </div>

      <div class="input-group">
        <label for="date_of_payment">Date Of Payment</label>
        <input type="date" class="input" name="date_of_payment" id="date_of_payment" placeholder="Enter date of payment..." required autofocus="off" value="<?= date('Y-m-d', time()); ?>" autocomplete="off">
        <svg width="27" height="27" viewBox="0 0 27 27" fill="none" xmlns="http://www.w3.org/2000/svg">
          <rect x="2" y="4" width="23" height="20" rx="2" stroke="white" stroke-width="2" />
          <rect x="6" y="14" width="5" height="5" rx="1" stroke="white" stroke-width="2" />
          <rect x="16" y="14" width="5" height="5" rx="1" stroke="white" stroke-width="2" />
          <path d="M2 9H25" stroke="white" stroke-width="2" />
          <path d="M6 2L6 6" stroke="white" stroke-width="2" stroke-linecap="round" />
          <path d="M21 2L21 6" stroke="white" stroke-width="2" stroke-linecap="round" />
        </svg>
      </div>

      <div class="input-group prev-submit-btn">
        <button type="button" name="prev-btn" class="prev-btn close-btn">
          <span>Close</span>
        </button>
        <button type="submit" name="submit-btn" class="submit-btn">
          <span>Pay</span>
          <svg width="53" height="60" viewBox="0 0 53 60" fill="none" xmlns="http://www.w3.org/2000/svg" class="pay">
            <rect x="0.696898" y="-0.110377" width="6.74323" height="16.046" rx="3.37161" transform="matrix(0.586046 -0.810278 0.807751 0.589524 2.37764 12.373)" fill="white" stroke="black" />
            <path d="M39.9519 33.5075V25.8859V7C39.9519 5.89543 39.0564 5 37.9519 5H13.5977C12.4932 5 11.5977 5.89543 11.5977 7V53C11.5977 54.1046 12.4932 55 13.5977 55H32.1419C32.6942 55 33.1419 54.5523 33.1419 54V45.7463V38.5075C33.1419 35.746 35.3805 33.5075 38.1419 33.5075H39.9519Z" fill="white" />
            <path d="M48 55V37.0896V20.5205C48 19.7796 47.3995 19.1791 46.6586 19.1791V19.1791C42.9546 19.1791 39.9519 22.1818 39.9519 25.8859V33.5075M39.9519 33.5075H38.1419C35.3805 33.5075 33.1419 35.746 33.1419 38.5075V45.7463V54C33.1419 54.5523 32.6942 55 32.1419 55H13.5977C12.4932 55 11.5977 54.1046 11.5977 53V7C11.5977 5.89543 12.4932 5 13.5977 5H37.9519C39.0564 5 39.9519 5.89543 39.9519 7V33.5075Z" stroke="black" stroke-linecap="round" />
            <path d="M11.5977 46.791H33.1419" stroke="black" />
            <path d="M21.2555 50.5224L29.4274 50.5224" stroke="black" stroke-linecap="round" />
            <path d="M12 11.7164H39.8281" stroke="black" />
            <rect x="17.2981" y="16.694" width="16.8297" height="16.9104" rx="8.41484" stroke="black" />
            <path d="M27.9416 22.7332V22.7332C27.9416 21.6564 27.0688 20.7835 25.992 20.7835H25.2647M22.7413 26.4645V26.8494C22.7413 28.2854 23.9054 29.4496 25.3415 29.4496V29.4496M25.2647 20.7835H24.8355C23.6789 20.7835 22.7413 21.7212 22.7413 22.8778V22.8778C22.7413 24.0344 23.6789 24.972 24.8355 24.972H25.7028C26.9393 24.972 27.9416 25.9743 27.9416 27.2108V27.2108C27.9416 28.4472 26.9393 29.4496 25.7028 29.4496H25.3415M25.2647 20.7835V19.1791M25.3415 29.4496V30.9421" stroke="black" stroke-linecap="round" />
            <rect x="0.696898" y="-0.110377" width="6.74323" height="16.046" rx="3.37161" transform="matrix(0.586046 -0.810278 0.807751 0.589524 5.21813 22.6697)" fill="white" stroke="black" />
            <rect x="0.696898" y="-0.110377" width="6.74323" height="16.046" rx="3.37161" transform="matrix(0.586046 -0.810278 0.807751 0.589524 5.28926 31.9428)" fill="white" stroke="black" />
            <rect x="0.696898" y="-0.110377" width="6.74323" height="16.046" rx="3.37161" transform="matrix(0.586046 -0.810278 0.807751 0.589524 5.28926 40.898)" fill="white" stroke="black" />
          </svg>
        </button>
      </div>
    </form>
  </div>
</div>

<over-lay></over-lay>