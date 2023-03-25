import '../components/illustration.js';
import { validateNsn, validateSin, validatePassword } from '../helpers/validator/index.js';
import { errorMessage } from '../helpers/error_message.js';
import { checkAvailability } from '../helpers/check_availability.js';

const firstForm = document.querySelector('.form.first');
const secondForm = document.querySelector('.form.second');
const nextBtn = document.querySelector('.next-btn');
const prevBtn = document.querySelector('.prev-btn');
const submitBtn = document.querySelector('.submit-btn');
const illustrationComponent = document.querySelector('illustration-element');
const url = location.href.split('student', 1).toString();
waves;
nextBtn.style.visibility = 'hidden';
submitBtn.style.visibility = 'hidden';

secondForm.addEventListener('keyup', function (e) {
	const inputs = Array.from(this.querySelectorAll('.input'));

	if (e.target.id == 'nsn') {
		let result = validateNsn(e.target.value);

		if (!result['isValid']) {
			e.target.classList.add('error');
			errorMessage('nsn-message', result['errorMessage']);
		} else {
			checkAvailability('nsn', e.target.value, 'http://localhost/propay/student/check_action');
		}
	}

	const isContainError = inputs.some((input) => input.classList.contains('error') || input.value == '');

	if (!isContainError) {
		submitBtn.style.visibility = 'visible';
	} else {
		submitBtn.style.visibility = 'hidden';
	}
});

secondForm.addEventListener('change', function (e) {
	const inputs = Array.from(this.querySelectorAll('.input'));
	const isInputEmpty = inputs.some((input) => input.value == '');

	if (e.target.id == 'term') {
		const term = e.target.value.split('/')[0];
		document.getElementById('enrollment_date').value = `${term}-07-01`;
		document.getElementById('due_date').value = `${term}-07-10`;
	}

	if (e.target.id == 'enrollment_date') {
		const enrollment_date = e.target.value;
		console.log(enrollment_date);
	}

	if (!isInputEmpty) {
		submitBtn.style.visibility = 'visible';
	} else {
		submitBtn.style.visibility = 'hidden';
	}
});

firstForm.addEventListener('keyup', async (e) => {
	const inputs = [document.getElementById('student-password'), document.querySelector('input.sin'), document.querySelector('input.confirm-password')];

	if (e.target.classList.contains('sin')) {
		let isValid = validateSin(e.target.value);

		if (!isValid) {
			e.target.classList.add('error');
			errorMessage('sin-message', 'Please enter a valid sin');
		} else {
			checkAvailability('sin', e.target.value, 'http://localhost/propay/student/check_action');
		}
	}

	if (e.target.id == 'student-password') {
		let result = validatePassword(e.target.value);

		if (!result['isValid']) {
			e.target.classList.add('error');
			errorMessage('password-message', result['errorMessage']);
		} else {
			e.target.classList.remove('error');
		}
	}

	if (e.target.classList.contains('confirm-password')) {
		let password = document.getElementById('student-password');

		if (e.target.value !== password.value) {
			e.target.classList.add('error');
			errorMessage('confirm-password-message', `Password doesn't match`);
		} else {
			e.target.classList.remove('error');
		}
	}

	const isContainErrors = inputs.some((input) => input.classList.contains('error') || input.value == '');

	if (!isContainErrors) {
		nextBtn.style.visibility = 'visible';
	} else {
		nextBtn.style.visibility = 'hidden';
	}
});

prevBtn.addEventListener('click', () => {
	firstForm.classList.remove('hide');
});

nextBtn.addEventListener('click', function () {
	firstForm.classList.add('hide');
});

submitBtn.addEventListener('click', async (e) => {
	e.preventDefault();

	const inputs = document.querySelectorAll('.input');

	const data = {};
	inputs.forEach((input) => {
		data[input.id] = input.value;
	});

	const response = await insertStudentToDatabase(data);
	if (response.status == 'success') {
		document.querySelector('form').reset();
		document.querySelector('.first-content').style.display = 'none';

		const title = 'Congratulations';
		const message = response.message;
		const description = `
      You just add new student with sin ${response.sin},<br>lets see the list of student by clicking the button below
    `;
		const view = 'student';
		const listOfStaffUrl = response.url;
		const imgSource = `${url}public/images/completed.svg`;

		illustrationComponent.setAttribute('title', title);
		illustrationComponent.setAttribute('message', message);
		illustrationComponent.setAttribute('src', imgSource);
		illustrationComponent.setAttribute('description', description);
		illustrationComponent.setAttribute('view', view);
		illustrationComponent.setAttribute('url', listOfStaffUrl);
		illustrationComponent.firstElementChild.style.opacity = '1';
		illustrationComponent.firstElementChild.style.display = 'flex';
	}
});

async function insertStudentToDatabase(student_data) {
	const data = student_data;
	const url = 'http://localhost/propay/student/insert_action';

	const response = await fetch(url, {
		method: 'POST',
		mode: 'no-cors',
		credentials: 'same-origin',
		headers: {
			'Content-Type': 'application/json',
		},
		body: JSON.stringify(data),
	});

	return response.json();
}
