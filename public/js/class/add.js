import '../components/illustration.js';
import { checkAvailability } from '../helpers/check_availability.js';
import { prepIllustrationComp, showIllustrationComp } from '../helpers/illustration.js';

const submitBtn = document.getElementById('submit-btn');
const url = location.href.split('classes', 1).toString();
const form = document.querySelector('form');
submitBtn.style.visibility = 'hidden';

form.addEventListener('keyup', function (e) {
	let isContainError = validateInputs(e);
	submitBtn.style.visibility = isContainError ? 'hidden' : 'visible';
});

form.addEventListener('input', function (e) {
	let isContainError = validateInputs(e);
	submitBtn.style.visibility = isContainError ? 'hidden' : 'visible';
});

form.addEventListener('change', function (e) {
	let isContainError = validateInputs(e);
	submitBtn.style.visibility = isContainError ? 'hidden' : 'visible';
});

function validateInputs(e) {
	const allInputs = Array.from(document.querySelectorAll('.input'));

	if (e.target.id == 'class_name') {
		checkAvailability('class-name', e.target.value, 'http://localhost/propay/classes/check_action');
	}

	const isContainError = allInputs.some((input) => input.classList.contains('error') || input.value == '');
	return isContainError;
}

submitBtn.addEventListener('click', async (e) => {
	e.preventDefault();

	const inputs = Array.from(document.querySelectorAll('.input'));

	const data = {};
	inputs.forEach((input) => {
		data[input.id] = input.value;
	});

	const response = await insertClassToDatabase(data);

	if (response.status == 'success') {
		form.reset();
		document.querySelector('.first-content').style.display = 'none';

		const illustrationProps = {
			title: 'Congratulations',
			message: response.message,
			description: `
			Class ${response.class_name} has been successfully added,<br>lets see the list of class by clicking the button below
		`,
			view: 'class',
			redirectUrl: response.url,
			illustrationImage: `${url}public/images/completed.svg`,
		};

		showIllustrationComp(prepIllustrationComp(illustrationProps));
	}
});

async function insertClassToDatabase(class_data) {
	const data = class_data;
	const url = 'http://localhost/propay/classes/insert_action';

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
