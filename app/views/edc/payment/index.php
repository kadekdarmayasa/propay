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
                <p>XII SE 1</p>
              </div>
              <div class="student-bio-item">
                <small>Enrollment Date</small>
                <p><?= $data['student']['enrollment_date']; ?></p>
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
                <p>Software Engineering</p>
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
        <div class="student-bills table-container">
          <div class="header">
            <div class="left-header">
              <h2>Student Bills</h2>
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
                  <span>6</span>
                  <svg width="7" height="6" viewBox="0 0 7 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1 1L3.55914 5L6 1" stroke="#152A4A" stroke-linecap="round" />
                  </svg>
                  <ul class="list-of-row">
                    <li><a href="" class="selected">5</a></li>
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
                <th>Description</th>
                <th>Actions</th>
              </tr>
              <?php
              $number = $data['pagination']['start_data'] + 1;
              for ($i = 0; $i < count($data['payment']); $i++) : ?>
                <tr>
                  <td><?= $number++; ?></td>
                  <td><?= $data['payment'][$i]['month'] ?></td>
                  <td><?= $data['payment'][$i]['year'] ?></td>
                  <td><?= date('d F Y', strtotime($data['payment'][$i]['due_date']))  ?></td>
                  <td>Rp. 600.000</td>
                  <td><?= $data['payment'][$i]['payment_amount']  ?></td>
                  <td class="paid-half">
                    <div class="indicator"></div>
                    <p><?= $data['payment'][$i]['payment_status']; ?></p>
                  </td>
                  <td>
                    Pay
                  </td>
                </tr>
              <?php endfor; ?>
            </table>
          </div>

          <?php if ($data['payment_amount'] > 0) : ?>
            <!-- Classlist Footer -->
            <div class="cls-footer">
              <div class="footer-left">
                <?= $data['pagination']['start_data'] + 1 ?>
                <?php if ($data['pagination']['start_data'] + 1 != $data['payment_amount']) : ?>
                  -
                  <?php if ($data['payment_amount'] < $data['pagination']['end_data']) : ?>
                    <?= $data['payment_amount'] ?>
                  <?php else : ?>
                    <?= $data['pagination']['end_data'] ?>
                  <?php endif; ?>
                <?php endif; ?>
                of
                <?= $data['payment_amount']; ?>
                <?php if ($data['payment_amount'] < 2) : ?>
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
                          <a class="page-link" href="<?= BASEURL . 'edc_payment/page/' . $data['pagination']['current_page'] - 1 . '/' . $data['student']['sin'] ?>" aria-label="Previous">
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
                            <a class="page-link" href="<?= BASEURL . 'classes/page/' . 1 ?>">1</a>
                          </li>
                          <li class="page-item dots">
                            <a class="page-link">...</a>
                          </li>
                        <?php endif; ?>
                      <?php endif; ?>

                      <?php for ($page_number = $data['pagination']['start_number']; $page_number <= $data['pagination']['end_number']; $page_number++) : ?>
                        <?php if ($page_number == $data['pagination']['current_page']) : ?>
                          <li class="page-item active">
                            <a class="page-link" href="<?= BASEURL . 'classes/page/' . $page_number ?>">
                              <?= $page_number; ?>
                            </a>
                          </li>
                        <?php else : ?>
                          <li class="page-item">
                            <a class="page-link" href="<?= BASEURL . 'classes/page/' . $page_number  ?>">
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
                          <a class="page-link" href="<?= BASEURL . 'classes/page/' . $data['pagination']['total_page'] ?>">
                            <?= $data['pagination']['total_page']; ?>
                          </a>
                        </li>
                      <?php endif ?>
                      <!-- End of Pagination Page -->

                      <!-- Next Btn -->
                      <?php if ($data['pagination']['current_page'] != $data['pagination']['total_page']) : ?>
                        <li class="next-btn">
                          <a class="page-link" href="<?= BASEURL . 'edc_payment/page/' . $data['pagination']['current_page'] + 1 . '/' . $data['student']['sin'] ?>" aria-label="Next">
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