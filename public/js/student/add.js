import '../components/illustration.js';
import validateInputs from '../helpers/validator/index.js';
import { showIllustrationComp, prepIllustrationComp } from '../helpers/illustration.js';

const firstForm = document.querySelector('.form.first');
const secondForm = document.querySelector('.form.second');
const nextBtn = document.querySelector('.next-btn');
const prevBtn = document.querySelector('.prev-btn');
const submitBtn = document.querySelector('.submit-btn');
const illustrationComponent = document.querySelector('illustration-element');
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

	const inputs = document.querySelectorAll('.input');

	const data = {};
	inputs.forEach((input) => {
		data[input.id] = input.value;
	});

	const response = await insertStudentToDatabase(data);

	if (response.status == 'success') {
		document.querySelector('form').reset();
		document.querySelector('.first-content').style.display = 'none';

		const illustrationProps = {
			title: 'Congratulations',
			message: response.message,
			description: `
				You just add new student with sin ${response.sin},<br>lets see the list of student by clicking the button below
			`,
			view: 'student',
			redirectUrl: response.url,
			illustrationImage: `${url}public/images/completed.svg`,
		};

		showIllustrationComp(prepIllustrationComp(illustrationProps), 'success');
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
