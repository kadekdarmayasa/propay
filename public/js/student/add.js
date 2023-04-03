import '../components/illustration.js';
import Database from '../helpers/database.js';
import validateInputs from '../helpers/validator/index.js';
import { showIllustrationComp, prepIllustrationComp } from '../helpers/illustration.js';

const form = document.forms[0];
const firstContent = document.querySelector('.first-content');
const firstForm = document.querySelector('.form.first');
const secondForm = document.querySelector('.form.second');
const nextBtn = document.querySelector('.next-btn');
const prevBtn = document.querySelector('.prev-btn');
const submitBtn = document.querySelector('.submit-btn');
const url = location.href.split('student', 1).toString();

nextBtn.style.visibility = 'hidden';
submitBtn.style.visibility = 'hidden';

secondForm.addEventListener('keyup', function (e) {
	const isContainError = validateInputs(e.target, 'add-student', this);
	nextBtn.style.visibility = isContainError ? 'hidden' : 'visible';
	submitBtn.style.visibility = isContainError ? 'hidden' : 'visible';
});

secondForm.addEventListener('input', function (e) {
	const isContainError = validateInputs(e.target, 'add-student', this);
	nextBtn.style.visibility = isContainError ? 'hidden' : 'visible';
	submitBtn.style.visibility = isContainError ? 'hidden' : 'visible';
});

secondForm.addEventListener('change', function (e) {
	const isContainError = validateInputs(e.target, 'add-student', this);
	nextBtn.style.visibility = isContainError ? 'hidden' : 'visible';
	submitBtn.style.visibility = isContainError ? 'hidden' : 'visible';
});

firstForm.addEventListener('keyup', function (e) {
	const isContainError = validateInputs(e.target, 'add-student', this);
	nextBtn.style.visibility = isContainError ? 'hidden' : 'visible';
});

firstForm.addEventListener('input', function (e) {
	const isContainError = validateInputs(e.target, 'add-student', this);
	nextBtn.style.visibility = isContainError ? 'hidden' : 'visible';
});

prevBtn.addEventListener('click', () => {
	firstForm.classList.remove('hide');
});

nextBtn.addEventListener('click', () => {
	firstForm.classList.add('hide');
});

submitBtn.addEventListener('click', async (e) => {
	e.preventDefault();

	const data = {};

	const inputs = document.querySelectorAll('.input');

	inputs.forEach((input) => {
		data[input.id] = input.value;
	});

	try {
		const database = new Database('http://localhost/propay/student/insert_action');
		const response = await database.insert(data);

		if (response.status == 'success') {
			form.reset();
			firstContent.style.display = 'none';

			const illustrationProps = {
				title: 'Congratulations',
				message: 'Student has been successfully added',
				description: `
				You just add new student with sin ${response.sin},<br>lets see the list of student by clicking the button below
			`,
				view: 'student',
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
			description: `
				Failure occurred when attempting to add a student or place a payment. <br>Please check and try again.
			`,
			view: 'student',
			redirectUrl: url + 'student/index',
			illustrationImage: `${url}public/images/something-wrong.svg`,
			state: 'error'
		};

		showIllustrationComp(prepIllustrationComp(illustrationProps));
	}
});