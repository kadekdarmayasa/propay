import '../components/illustration.js';
import '../helpers/illustration.js';
import Database from '../helpers/database.js';
import { prepIllustrationComp, showIllustrationComp } from '../helpers/illustration.js';
import validateInputs from '../helpers/validator/index.js';

const form = document.forms[0];
const firstContent = document.querySelector('.first-content');
const firstForm = document.querySelector('.form.first');
const secondForm = document.querySelector('.form.second');
const nextBtn = document.querySelector('.next-btn');
const prevBtn = document.querySelector('.prev-btn');
const submitBtn = document.querySelector('.submit-btn');
const url = location.href.split('staff', 1).toString();

nextBtn.style.visibility = 'hidden';
submitBtn.style.visibility = 'hidden';
nextBtn.disabled = true;
submitBtn.disabled = true;

nextBtn.addEventListener('click', (e) => {
	firstForm.classList.add('hide');
	e.preventDefault();
});

prevBtn.addEventListener('click', () => {
	firstForm.classList.remove('hide');
});

firstForm.addEventListener('keyup', function (e) {
	const isContainError = validateInputs(e.target, 'add-staff', this);
	nextBtn.style.visibility = isContainError ? 'hidden' : 'visible';
	nextBtn.disabled = isContainError ? true : false;
});

firstForm.addEventListener('input', function (e) {
	const isContainError = validateInputs(e.target, 'add-staff', this);
	nextBtn.style.visibility = isContainError ? 'hidden' : 'visible';
	nextBtn.disabled = isContainError ? true : false;
});

firstForm.addEventListener('change', function (e) {
	const isContainError = validateInputs(e.target, 'add-staff', this);
	nextBtn.style.visibility = isContainError ? 'hidden' : 'visible';
	nextBtn.disabled = isContainError ? true : false;
});

secondForm.addEventListener('keyup', function (e) {
	const isContainError = validateInputs(e.target, 'add-staff', this);
	submitBtn.style.visibility = isContainError ? 'hidden' : 'visible';
	submitBtn.disabled = isContainError ? true : false;
});

secondForm.addEventListener('input', function (e) {
	const isContainError = validateInputs(e.target, 'add-staff', this);
	submitBtn.style.visibility = isContainError ? 'hidden' : 'visible';
	submitBtn.disabled = isContainError ? true : false;
});

secondForm.addEventListener('change', function (e) {
	const isContainError = validateInputs(e.target, 'add-staff', this);
	submitBtn.style.visibility = isContainError ? 'hidden' : 'visible';
	submitBtn.disabled = isContainError ? true : false;
});

submitBtn.addEventListener('click', async (e) => {
	e.preventDefault();

	const data = {};

	const inputs = document.querySelectorAll('.input');

	inputs.forEach((input) => {
		data[input.id] = input.value;
	});

	try {
		const database = new Database('http://localhost/propay/staff/insert_action');
		const response = await database.insert(data);

		if (response.status == 'success') {
			form.reset();
			firstContent.style.display = 'none';

			const illustrationProps = {
				title: 'Congratulations',
				message: 'Staff has been successfully added',
				description: `You just add new staff with id ${response.id_staff},<br>lets see the list of staff by clicking the button below`,
				view: 'staff',
				redirectUrl: response.url,
				illustrationImage: `${url}public/images/completed.svg`,
				state: 'success'
			};

			showIllustrationComp(prepIllustrationComp(illustrationProps));
		}
	} catch (e) {
		form.reset();
		firstContent.style.display = 'none';

		const illustrationProps = {
			title: 'Oops!!!',
			message: 'Something went wrong',
			description: `Failure occurred when attempting to add a staff. <br>Please check and try again.`,
			view: 'staff',
			redirectUrl: url + 'staff/index',
			illustrationImage: `${url}public/images/something-wrong.svg`,
			state: 'error'
		};

		showIllustrationComp(prepIllustrationComp(illustrationProps));
	}
});


