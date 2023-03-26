import '../components/illustration.js';
import '../helpers/illustration.js';
import { prepIllustrationComp, showIllustrationComp } from '../helpers/illustration.js';
import validateInputs from '../helpers/validator/index.js';

const firstForm = document.querySelector('.form.first');
const secondForm = document.querySelector('.form.second');
const nextBtn = document.querySelector('.next-btn');
const prevBtn = document.querySelector('.prev-btn');
const submitBtn = document.querySelector('.submit-btn');
const url = location.href.split('staff', 1).toString();

nextBtn.style.visibility = 'hidden';
submitBtn.style.visibility = 'hidden';

nextBtn.addEventListener('click', (e) => {
	firstForm.classList.add('hide');
	e.preventDefault();
});

prevBtn.addEventListener('click', () => {
	firstForm.classList.remove('hide');
});

firstForm.addEventListener('keyup', function (e) {
	const isContainError = validateInputs(e.target, 'add-staff', this);
	submitBtn.style.visibility = isContainError ? 'hidden' : 'hidden';
});

firstForm.addEventListener('input', function (e) {
	const isContainError = validateInputs(e.target, 'add-staff', this);
	submitBtn.style.visibility = isContainError ? 'hidden' : 'hidden';
});

secondForm.addEventListener('keyup', function (e) {
	const isContainError = validateInputs(e.target, 'add-staff', this);
	submitBtn.style.visibility = isContainError ? 'hidden' : 'hidden';
});

secondForm.addEventListener('input', function (e) {
	const isContainError = validateInputs(e.target, 'add-staff', this);
	submitBtn.style.visibility = isContainError ? 'hidden' : 'hidden';
});

secondForm.addEventListener('change', function (e) {
	const isContainError = validateInputs(e.target, 'add-staff', this);
	submitBtn.style.visibility = isContainError ? 'hidden' : 'hidden';
});

submitBtn.addEventListener('click', async (e) => {
	e.preventDefault();

	const inputs = [...document.querySelectorAll('input'), ...document.querySelectorAll('select'), document.querySelector('textarea')];

	const data = {};
	inputs.forEach((input) => {
		data[input.id] = input.value;
	});

	const response = await insertStaffToDatabase(data);

	if (response.status == 'success') {
		document.querySelector('form').reset();
		document.querySelector('.first-content').style.display = 'none';

		const illustrationProps = {
			title: 'Congratulations',
			message: response.message,
			description: `You just add new staff with id ${response.id_staff},<br>lets see the list of staff by clicking the button below`,
			view: 'staff',
			redirectUrl: response.url,
			illustrationImage: `${url}public/images/completed.svg`,
		};

		showIllustrationComp(prepIllustrationComp(illustrationProps), 'success');
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
