import '../components/illustration.js';
import { errorMessage } from '../helpers/error_message.js';
import validateInputs from '../helpers/validator/index.js';
const form = document.querySelector('form');
const submitBtn = document.querySelector('.submit-btn');
submitBtn.style.visibility = 'hidden';

form.addEventListener('keyup', function (e) {
	if (e.target.id == 'sin') {
		check_student_sin(e.target.value, e);
	}

	if (e.target.id == 'class-name') {
		check_class(e.target.value);
	}

	const isContainError = validateInputs(e.target, 'payment', this);
	submitBtn.style.visibility = isContainError ? 'hidden' : 'visible';
});

form.addEventListener('input', function (e) {
	if (e.target.id == 'sin') {
		check_student_sin(e.target.value, e);
	}

	if (e.target.id == 'class-name') {
		check_class(e.target.value);
	}

	const isContainError = validateInputs(e.target, 'payment', this);
	submitBtn.style.visibility = isContainError ? 'hidden' : 'visible';
});

form.addEventListener('change', function (e) {
	if (e.target.id == 'sin') {
		check_student_sin(e.target.value, e);
	}

	if (e.target.id == 'class-name') {
		check_class(e.target.value);
	}

	const isContainError = validateInputs(e.target, 'payment', this);
	submitBtn.style.visibility = isContainError ? 'hidden' : 'visible';
});

function check_class(class_name) {
	const data = { 'class-name': class_name };
	const xHttp = new XMLHttpRequest();

	xHttp.onreadystatechange = async function () {
		if (this.readyState == 4 && this.status == 200) {
			const data = JSON.parse(this.responseText);

			if (data.status == 'error') {
				document.getElementById('class-name').classList.remove('error');
			} else {
				document.getElementById('class-name').classList.add('error');
				errorMessage('class-name-message', `Class doesn't exist`);
			}
		}
	};

	xHttp.open('POST', 'http://localhost/propay/classes/check_action', true);
	xHttp.setRequestHeader('Content-type', 'application/json');
	xHttp.send(JSON.stringify(data));
}

function check_student_sin(sin) {
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
