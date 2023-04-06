import { errorMessage } from '../helpers/error_message.js';
import validateInputs from '../helpers/validator/index.js';
const form = document.querySelector('form');
const submitBtn = document.querySelector('.submit-btn');
submitBtn.style.visibility = 'hidden';
submitBtn.disabled = true;

form.addEventListener('keyup', function (e) {
  if (e.target.id == 'sin') {
    checkStudentSIN(e.target.value, e);
  }

  const isContainError = validateInputs(e.target, 'report', this);
  submitBtn.style.visibility = isContainError ? 'hidden' : 'visible';
  submitBtn.disabled = isContainError ? true : false;
});

form.addEventListener('input', function (e) {
  if (e.target.id == 'sin') {
    checkStudentSIN(e.target.value, e);
  }

  const isContainError = validateInputs(e.target, 'report', this);
  submitBtn.style.visibility = isContainError ? 'hidden' : 'visible';
  submitBtn.disabled = isContainError ? true : false;
});

form.addEventListener('change', function (e) {
  if (e.target.id == 'sin') {
    checkStudentSIN(e.target.value, e);
  }

  const isContainError = validateInputs(e.target, 'report', this);
  submitBtn.style.visibility = isContainError ? 'hidden' : 'visible';
  submitBtn.disabled = isContainError ? true : false;
});


function checkStudentSIN(sin) {
  const data = { sin };
  const xHttp = new XMLHttpRequest();

  xHttp.onreadystatechange = async function () {
    if (this.readyState == 4 && this.status == 200) {
      const data = JSON.parse(this.responseText);

      if (data.status == 'error') {
        document.getElementById('sin').classList.remove('error');
      } else {
        document.getElementById('sin').classList.add('error');
        errorMessage('sin-message', `Sin doesn't exist`);
      }
    }
  };

  xHttp.open('POST', 'http://localhost/propay/student/check_action', true);
  xHttp.setRequestHeader('Content-type', 'application/json');
  xHttp.send(JSON.stringify(data));
}
