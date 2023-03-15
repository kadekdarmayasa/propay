<div class="main-content">

  <div class="staff-container">
    <div class="flasher-container">
      <?php Flasher::flash(); ?>
    </div>

    <!-- Staff Header -->
    <div class="header">
      <div class="left-header">
        <h2>List of Staff</h2>
        <form action="" method="post">
          <input type="text" name="staff-field" id="staff-field" placeholder="Search staff...">
          <button type="submit" name="search-staff"><svg width="17" height="18" viewBox="0 0 17 18" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M13.7857 6.96721C13.7857 10.5273 10.8234 13.4344 7.14286 13.4344C3.4623 13.4344 0.5 10.5273 0.5 6.96721C0.5 3.40713 3.4623 0.5 7.14286 0.5C10.8234 0.5 13.7857 3.40713 13.7857 6.96721Z" stroke="#989898" />
              <path d="M12 12.2623L16 17" stroke="#989898" stroke-linecap="round" />
            </svg>
          </button>
        </form>
      </div>
      <div class="right-header">
        <div class="row-per-page">
          <p>Rows per page</p>
          <div class="page-selected">
            <span>2</span>
            <svg width="7" height="6" viewBox="0 0 7 6" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M1 1L3.55914 5L6 1" stroke="#152A4A" stroke-linecap="round" />
            </svg>
            <ul class="list-of-page">
              <li><a href="">1</a></li>
              <li><a href="">2</a></li>
              <li><a href="">3</a></li>
              <li><a href="">4</a></li>
            </ul>
          </div>
        </div>
        <a href="<?= BASEURL . 'staff/add' ?>" class="add-staff-btn">
          <svg width="33" height="33" viewBox="0 0 33 33" fill="none" xmlns="http://www.w3.org/2000/svg">
            <rect x="0.5" y="0.5" width="32" height="32" rx="16" stroke="black" />
            <path d="M16.3333 8V25" stroke="black" stroke-linecap="round" />
            <path d="M7 16.5H26" stroke="black" stroke-linecap="round" />
          </svg>
          Add staff
        </a>
      </div>
    </div>
    <!-- End of Staff Header -->

    <!-- Staff Data -->
    <div class="data">
      <table>
        <tr>
          <th>Staff ID</th>
          <th>Username</th>
          <th>Level</th>
          <th>Staff Name</th>
          <th>Actions</th>
        </tr>
        <?php for ($i = 0; $i < count($data['staff']); $i++) : ?>
          <tr>
            <td><?= $data['staff'][$i]['staff_id']; ?></td>
            <td><?= $data['staff'][$i]['username']; ?></td>
            <td><?= $data['staff'][$i]['staff_level']; ?></td>
            <td><?= $data['staff'][$i]['staff_name']; ?></td>
            <?php if ($_SESSION['user']['username'] != $data['staff'][$i]['username']) : ?>
              <td>
                <a href="" class="update-btn">
                  <svg width="21" height="19" viewBox="0 0 21 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M4.63638 12.7742L5.21649 10.4983C5.27328 10.2755 5.40513 10.0791 5.58984 9.94209L17.691 0.967977C18.415 0.431087 19.4359 0.57489 19.9834 1.29088C20.5424 2.02193 20.3949 3.06908 19.6557 3.61727L7.57334 12.5774C7.40103 12.7052 7.19219 12.7742 6.97767 12.7742H4.63638Z" stroke="#989898" stroke-linecap="round" />
                    <path d="M16.4545 2.03223L18.2727 4.35481" stroke="#989898" stroke-linecap="round" />
                    <path d="M13.5916 1.16113H3C1.89543 1.16113 1 2.05656 1 3.16113V15.9998C1 17.1044 1.89543 17.9998 3 17.9998H16.5758C17.6803 17.9998 18.5758 17.1044 18.5758 15.9998V6.32138" stroke="#989898" stroke-linecap="round" />
                  </svg>
                  <span class="tooltip">Update Staff</span>
                </a>
                <a href="" class="delete-btn">
                  <svg width=" 20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M5.76471 4.08571V2C5.76471 1.44771 6.21242 1 6.76471 1H10H13.2353C13.7876 1 14.2353 1.44772 14.2353 2V4.08571" stroke="#989898" />
                    <path d="M3.8125 4.3291V17C3.8125 18.1046 4.70793 19 5.8125 19H14.1875C15.2921 19 16.1875 18.1046 16.1875 17V4.3291M3.8125 4.3291H16.1875M3.8125 4.3291H1M16.1875 4.3291H19" stroke="#989898" stroke-linecap="round" />
                  </svg>
                  <span class="tooltip">Delete Staff</span>
                </a>
                <a href="" class="detail-btn">
                  <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect x="1" y="1" width="38" height="38" rx="4" stroke="black" stroke-width="2" />
                    <path d="M20 30V16C20 15.4477 19.5523 15 19 15H17M20 30H17M20 30H23" stroke="black" stroke-width="2" stroke-linecap="round" />
                    <rect x="18" y="8" width="3" height="3" rx="1.5" fill="black" />
                  </svg>
                  <span class="tooltip">Detail Staff</span>
                </a>
              </td>
            <?php else : ?>
              <td>
                <a href="" class="view-profile-btn">View Profile</a>
              </td>
            <?php endif; ?>
          </tr>
        <?php endfor; ?>
      </table>
    </div>
    <!-- End of Staff Data -->

    <!-- Staff Footer -->
    <div class="cls-footer">
      <div class="footer-left">
        1 - 5 of 50 Items
      </div>
      <div class="footer-right">
        <nav class="pagination">
          <!-- Prev Btn -->
          <li class="prev-btn">
            <a class="page-link" href="" aria-label="Previous">
              <span aria-hidden="true">&laquo;</span> Prev
            </a>
          </li>
          <!-- End of Prev Btn -->

          <!-- Pagination Page -->
          <li class="page-item active">
            <a class="page-link" href="">1</a>
          </li>
          <li class="page-item">
            <a class="page-link" href="">2</a>
          </li>
          <li class="page-item">
            <a class="page-link" href="">3</a>
          </li>
          <li class="page-item">
            <a class="page-link" href="">4</a>
          </li>
          <li class="page-item dots">
            <a class="page-link">...</a>
          </li>
          </li>
          <li class="page-item">
            <a class="page-link" href="">6</a>
          </li>
          <!-- End of Pagination Page -->

          <!-- Next Btn -->
          <li class="next-btn">
            <a class="page-link" href="" aria-label="Next">
              Next <span aria-hidden="true">&raquo;</span>
            </a>
          </li>
          <!-- End of Next Btn -->
        </nav>
      </div>
    </div>
    <!-- End of Staff Footer -->
  </div>
</div>