<div class="main-content">
  <div class="table-container">
    <!-- Staff Header -->
    <div class="header">
      <div class="left-header">
        <h2>Payment Histories</h2>
        <form action="" method="post" id="search-form">
          <?php if (isset($_SESSION['search_history_keyword']) && $_SESSION['search_history_keyword'] != '') : ?>
            <input type="text" name="payment_history_keyword" id="payment_history_keyword" placeholder="Search history..." value="<?= $_SESSION['search_history_keyword'] ?>" autocomplete="off">
          <?php else : ?>
            <input type="text" name="payment_history_keyword" id="payment_history_keyword" placeholder="Search history..." autocomplete="off">
          <?php endif; ?>
          <button type="submit" name="search-payment-history"><svg width="17" height="18" viewBox="0 0 17 18" fill="none" xmlns="http://www.w3.org/2000/svg">
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
            <span>5</span>
            <svg width="7" height="6" viewBox="0 0 7 6" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M1 1L3.55914 5L6 1" stroke="#152A4A" stroke-linecap="round" />
            </svg>
            <ul class="list-of-row">
              <li><a href="" class="selected">5</a></li>
              <li><a href="">10</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <!-- End of Staff Header -->

    <!-- Staff Data -->
    <div class="data">
      <?php if ($data['payment_history'] == null) : ?>
        <p class="empty-message">There is no history found</p>
      <?php else : ?>
        <table>
          <tr>
            <th>#</th>
            <th>Staff Name</th>
            <th>SIN</th>
            <th>Date Of Payment</th>
            <th>Payment Amount</th>
            <th>Refund</th>
          </tr>
          <?php
          $number = $data['pagination']['start_data'] + 1;
          for ($i = 0; $i < count($data['payment_history']); $i++) : ?>
            <tr>
              <td><?= $number++ ?></td>
              <td class="toggled-column"><?= $data['payment_history'][$i]['staff']['staff_name']; ?></td>
              <td><?= $data['payment_history'][$i]['student']['sin']; ?></td>
              <td><?= date('d F Y', strtotime($data['payment_history'][$i]['date_of_payment'])); ?></td>
              <td>Rp. <?= number_format($data['payment_history'][$i]['payment_amount'], 0, ',', '.'); ?></td>
              <td>Rp. <?= number_format($data['payment_history'][$i]['refund_total'], 0, ',', '.'); ?></td>
            </tr>
          <?php endfor; ?>
        </table>
      <?php endif; ?>
    </div>
    <!-- End of Staff Data -->


    <?php if ($data['history_amount'] > 0) : ?>
      <!-- History Footer -->
      <div class="cls-footer">
        <div class="footer-left">
          <?= $data['pagination']['start_data'] + 1 ?>
          <?php if ($data['pagination']['start_data'] + 1 != $data['history_amount']) : ?>
            -
            <?php if ($data['history_amount'] < $data['pagination']['end_data']) : ?>
              <?= $data['history_amount'] ?>
            <?php else : ?>
              <?= $data['pagination']['end_data'] ?>
            <?php endif; ?>
          <?php endif; ?>
          of
          <?= $data['history_amount']; ?>
          <?php if ($data['history_amount'] < 2) : ?>
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
                    <a class="page-link" href="<?= BASEURL . 'edc_payment_history/page/' . $data['pagination']['current_page'] - 1 ?>" aria-label="Previous">
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
                      <a class="page-link" href="<?= BASEURL . 'edc_payment_history/page/' . 1 ?>">1</a>
                    </li>
                    <li class="page-item dots">
                      <a class="page-link">...</a>
                    </li>
                  <?php endif; ?>
                <?php endif; ?>

                <?php for ($page_number = $data['pagination']['start_number']; $page_number <= $data['pagination']['end_number']; $page_number++) : ?>
                  <?php if ($page_number == $data['pagination']['current_page']) : ?>
                    <li class="page-item active">
                      <a class="page-link" href="<?= BASEURL . 'edc_payment_history/page/' . $page_number ?>">
                        <?= $page_number; ?>
                      </a>
                    </li>
                  <?php else : ?>
                    <li class="page-item">
                      <a class="page-link" href="<?= BASEURL . 'edc_payment_history/page/' . $page_number  ?>">
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
                    <a class="page-link" href="<?= BASEURL . 'edc_payment_history/page/' . $data['pagination']['total_page'] ?>">
                      <?= $data['pagination']['total_page']; ?>
                    </a>
                  </li>
                <?php endif ?>
                <!-- End of Pagination Page -->

                <!-- Next Btn -->
                <?php if ($data['pagination']['current_page'] != $data['pagination']['total_page']) : ?>
                  <li class="next-btn">
                    <a class="page-link" href="<?= BASEURL . 'edc_payment_history/page/' . $data['pagination']['current_page'] + 1 ?>" aria-label="Next">
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
      <!-- End of History Footer -->
    <?php endif; ?>
  </div>
</div>