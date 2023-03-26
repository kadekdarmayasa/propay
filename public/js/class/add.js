import '../components/illustration.js';
import validateInputs from '../helpers/validator/index.js';
import { prepIllustrationComp, showIllustrationComp } from '../helpers/illustration.js';

const submitBtn = document.getElementById('submit-btn');
const url = location.href.split('classes', 1).toString();
const form = document.querySelector('form');
submitBtn.style.visibility = 'hidden';

form.addEventListener('keyup', function (e) {
	let isContainError = validateInputs(e.target, 'add-class');
	submitBtn.style.visibility = isContainError ? 'hidden' : 'visible';
});

form.addEventListener('input', function (e) {
	let isContainError = validateInputs(e.target, 'add-class');
	submitBtn.style.visibility = isContainError ? 'hidden' : 'visible';
});

form.addEventListener('change', function (e) {
	let isContainError = validateInputs(e.target, 'add-class');
	submitBtn.style.visibility = isContainError ? 'hidden' : 'visible';
});

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
