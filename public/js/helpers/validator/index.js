import { validateNsn } from './nsn_validation.js';
import { validatePassword } from './password_validation.js';
import { validateSin } from './sin-validation.js';
import { validateUsername } from './username_validation.js';
import { checkAvailability } from '../check_availability.js';
import { errorMessage } from '../error_message.js';

function validateInputs(targetElement, view, currentElement) {
	if (view == 'update-class') {
		const prevClassName = document.getElementById('prev_class_name');
		const allInputs = Array.from(document.querySelectorAll('.input'));

		if (targetElement.id == 'class_name' && prevClassName.value != targetElement.value) {
			checkAvailability('class-name', targetElement.value, 'http://localhost/propay/classes/check_action');
		}

		const isContainError = allInputs.some((input) => input.classList.contains('error') || input.value == '');
		return isContainError;
	}

	if (view == 'add-class') {
		const allInputs = Array.from(document.querySelectorAll('.input'));

		if (targetElement.id == 'class_name') {
			checkAvailability('class-name', targetElement.value, 'http://localhost/propay/classes/check_action');
		}

		const isContainError = allInputs.some((input) => input.classList.contains('error') || input.value == '');
		return isContainError;
	}

	if (view == 'add-staff') {
		const inputs = Array.from(currentElement.querySelectorAll('.input'));

		if (targetElement.classList.contains('username')) {
			let isValid = validateUsername(targetElement.value);

			if (!isValid) {
				targetElement.classList.add('error');
				errorMessage('username-message', 'Please enter a valid username');
			} else {
				checkAvailability('username', targetElement.value, 'http://localhost/propay/staff/check_action');
			}
		}

		if (targetElement.classList.contains('password')) {
			let result = validatePassword(targetElement.value);

			if (!result['isValid']) {
				targetElement.classList.add('error');
				errorMessage('password-message', result['errorMessage']);
			} else {
				targetElement.classList.remove('error');
			}
		}

		if (targetElement.classList.contains('confirm-password')) {
			let password = document.querySelector('.password');

			if (targetElement.value !== password.value) {
				targetElement.classList.add('error');
				errorMessage('confirm-password-message', `Password doesn't match`);
			} else {
				targetElement.classList.remove('error');
			}
		}

		const isContainError = inputs.some((input) => input.classList.contains('error') || input.value == '');

		return isContainError;
	}

	if (view == 'update-staff') {
		const inputs = Array.from(currentElement.querySelectorAll('.input'));
		const isContainError = inputs.some((input) => input.value == '');

		return isContainError;
	}

	if (view == 'add-student') {
		const inputs = Array.from(currentElement.querySelectorAll('.input'));

		if (targetElement.classList.contains('sin')) {
			let result = validateSin(targetElement.value);

			if (!result['isValid']) {
				targetElement.classList.add('error');
				errorMessage('sin-message', result['errorMessage']);
			} else {
				checkAvailability('sin', targetElement.value, 'http://localhost/propay/student/check_action');
			}
		}

		if (targetElement.id == 'student-password') {
			let result = validatePassword(targetElement.value);

			if (!result['isValid']) {
				targetElement.classList.add('error');
				errorMessage('password-message', result['errorMessage']);
			} else {
				targetElement.classList.remove('error');
			}
		}

		if (targetElement.classList.contains('confirm-password')) {
			let password = document.getElementById('student-password');

			if (targetElement.value !== password.value) {
				targetElement.classList.add('error');
				errorMessage('confirm-password-message', `Password doesn't match`);
			} else {
				targetElement.classList.remove('error');
			}
		}

		if (targetElement.id == 'term') {
			const term = targetElement.value.split('/')[0];
			document.getElementById('enrollment_date').value = `${term}-07-01`;
		}

		if (targetElement.id == 'nsn') {
			let result = validateNsn(targetElement.value);

			if (!result['isValid']) {
				targetElement.classList.add('error');
				errorMessage('nsn-message', result['errorMessage']);
			} else {
				checkAvailability('nsn', targetElement.value, 'http://localhost/propay/student/check_action');
			}
		}

		const isContainError = inputs.some((input) => input.classList.contains('error') || input.value == '');

		return isContainError;
	}

	if (view == 'update-student') {
		const inputs = Array.from(currentElement.querySelectorAll('.input'));
		const isContainError = inputs.some((input) => input.classList.contains('error') || input.value == '');

		return isContainError;
	}
}

export default validateInputs;
