import { errorMessage } from '../helpers/error_message.js';
import validateInputs from '../helpers/validator/index.js';

const form = document.querySelector('form');
const submitBtn = document.querySelector('.submit-btn');
const sinInput = document.getElementById('sin');
const monthInput = document.getElementById('month');
const yearInput = document.getElementById('year');
const classIdInput = document.getElementById('class_id');

submitBtn.style.visibility = 'hidden';
submitBtn.disabled = true;

form.addEventListener('input', function (e) {
  if (e.target.id === 'class-name') {
    checkCLass(e.target.value);
  }

  if (e.target.id == 'class-name' && !(e.target.classList.contains('error'))) {
    checkTotalStudent(e.target.value);
    getYears(monthInput.value, sinInput.value)
  }

  const isContainError = validateInputs(e.target, 'report', this);
  submitBtn.style.visibility = isContainError ? 'hidden' : 'visible';
  submitBtn.disabled = isContainError ? true : false;
});

form.addEventListener('change', function (e) {
  if (e.target.id === 'class-name') {
    checkCLass(e.target.value);
  }

  if (e.target.id == 'class-name' && !(e.target.classList.contains('error'))) {
    checkTotalStudent(e.target.value);
    getYears(monthInput.value, sinInput.value)
  }

  if (e.target.id == 'month') {
    getYears(e.target.value, sinInput.value);
  }

  const isContainError = validateInputs(e.target, 'report', this);
  submitBtn.style.visibility = isContainError ? 'hidden' : 'visible';
  submitBtn.disabled = isContainError ? true : false;
});

form.addEventListener('keyup', function (e) {
  if (e.target.id === 'class-name') {
    checkCLass(e.target.value);
  }

  if (e.target.id == 'class-name' && !(e.target.classList.contains('error'))) {
    checkTotalStudent(e.target.value);
    getYears(monthInput.value, sinInput.value)
  }

  const isContainError = validateInputs(e.target, 'report', this);
  submitBtn.style.visibility = isContainError ? 'hidden' : 'visible';
  submitBtn.disabled = isContainError ? true : false;
})

function getYears(month, sin) {
  const data = { month, sin };
  const xHttp = new XMLHttpRequest();

  xHttp.onreadystatechange = async function () {
    if (this.readyState == 4 && this.status == 200) {
      if (this.response != '') {
        const response = JSON.parse(this.response);

        if (response.status == 'success') {
          const years = response.years;

          yearInput.innerHTML = '';
          yearInput.innerHTML += `
            <option value="">-- Select Year --</option>
          `;

          for (let i = 0; i < years.length; i++) {
            yearInput.innerHTML += `
              <option value="${years[i]['year']}">${years[i]['year']}</option>
            `;
          }
        } else {
          yearInput.innerHTML = '';
          yearInput.innerHTML += `
            <option value="">-- Select Year --</option>
          `;
        }
      }
    }
  };

  xHttp.open('POST', 'http://localhost/propay/payment/check_years', true);
  xHttp.setRequestHeader('Content-type', 'application/json');
  xHttp.send(JSON.stringify(data));
}

function checkTotalStudent(class_name) {
  const data = { 'class-name': class_name };
  const xHttp = new XMLHttpRequest();

  xHttp.onreadystatechange = async function () {
    if (this.readyState == 4 && this.status == 200) {
      if (this.response != '') {
        const response = JSON.parse(this.response);

        if (response.status == 'success') {
          sinInput.value = response.student[0]['sin'];
          document.getElementById('class-name').classList.remove('error');
        } else {
          sinInput.value = '';
          document.getElementById('class-name').classList.add('error');
          errorMessage('class-name-message', `There is no student with this class`);
        }
      }
    }
  };

  xHttp.open('POST', 'http://localhost/propay/classes/check_total_student', true);
  xHttp.setRequestHeader('Content-type', 'application/json');
  xHttp.send(JSON.stringify(data));
}

function checkCLass(class_name) {
  const data = { 'class-name': class_name };
  const xHttp = new XMLHttpRequest();

  xHttp.onreadystatechange = async function () {
    if (this.readyState == 4 && this.status == 200) {
      const response = JSON.parse(this.responseText);

      if (response.status == 'error') {
        if (document.querySelector('.class-name-message').innerHTML != 'There is no student with this class') {
          document.getElementById('class-name').classList.remove('error');
        }

        classIdInput.value = response.class['class_id'];
      } else {
        classIdInput.value = '';
        document.getElementById('class-name').classList.add('error');
        errorMessage('class-name-message', `Class doesn't exist`);
        sinInput.value = '';
      }
    }
  };

  xHttp.open('POST', 'http://localhost/propay/classes/check_action', true);
  xHttp.setRequestHeader('Content-type', 'application/json');
  xHttp.send(JSON.stringify(data));
}