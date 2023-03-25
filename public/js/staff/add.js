import '../components/illustration.js';
import { validatePassword } from '../helpers/validator/password_validation.js';
import { errorMessage } from '../helpers/error_message.js';
import { validateUsername } from '../helpers/validator/username_validation.js';
import { checkAvailability } from '../helpers/check_availability.js';

const firstForm = document.querySelector('.form.first');
const nextBtn = document.querySelector('.next-btn');
const prevBtn = document.querySelector('.prev-btn');
const submitBtn = document.querySelector('.submit-btn');
const illustrationComponent = document.querySelector('illustration-element');
const url = location.href.split('staff', 1).toString();

submitBtn.addEventListener('click', async (e) => {
	const inputs = [...document.querySelectorAll('input'), ...document.querySelectorAll('select'), document.querySelector('textarea')];
	const isEmpty = inputs.filter((input) => input.value === '');

	if (!isEmpty.length) {
		e.preventDefault();

		const data = {};
		inputs.forEach((input) => {
			data[input.id] = input.value;
		});

		const response = await insertStaffToDatabase(data);
		if (response.status == 'success') {
			document.querySelector('form').reset();
			document.querySelector('.first-content').style.display = 'none';

			const title = 'Congratulations';
			const message = response.message;
			const description = `
			You just add new staff with id ${response.id_staff},<br>lets see the list of staff by clicking the button below
		`;
			const view = 'staff';
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
	}
});

nextBtn.addEventListener('click', (e) => {
	firstForm.classList.add('hide');
	e.preventDefault();
});

prevBtn.addEventListener('click', () => {
	firstForm.classList.remove('hide');
});

firstForm.addEventListener('keyup', (e) => {
	if (e.target.classList.contains('username')) {
		let isValid = validateUsername(e.target.value);

		if (!isValid) {
			document.querySelector('.next-btn').disabled = true;
			e.target.classList.add('error');
			errorMessage('username-message', 'Please enter a valid username');
		} else {
			checkAvailability('username', e.target.value, 'http://localhost/propay/staff/check_action');
		}
	}

	if (e.target.classList.contains('password')) {
		let result = validatePassword(e.target.value);

		if (!result['isValid']) {
			document.querySelector('.next-btn').disabled = true;
			e.target.classList.add('error');
			errorMessage('password-message', result['errorMessage']);
		} else {
			document.querySelector('.next-btn').disabled = false;
			e.target.classList.remove('error');
		}
	}

	if (e.target.classList.contains('confirm-password')) {
		let password = document.querySelector('.password');

		if (e.target.value !== password.value) {
			document.querySelector('.next-btn').disabled = true;
			e.target.classList.add('error');
			errorMessage('confirm-password-message', `Password doesn't match`);
		} else {
			document.querySelector('.next-btn').disabled = false;
			e.target.classList.remove('error');
		}
	}
});

async function insertStaffToDatabase(staff_data) {
	const data = staff_data;
	const url = 'http://localhost/propay/staff/insert_action';

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
