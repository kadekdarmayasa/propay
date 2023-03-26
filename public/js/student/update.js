import '../components/illustration.js';
import validateInputs from '../helpers/validator/index.js';
import { showIllustrationComp, prepIllustrationComp } from '../helpers/illustration.js';

const form = document.querySelector('.form');
const submitBtn = document.querySelector('.submit-btn');
const url = location.href.split('student', 1).toString();

form.addEventListener('keyup', function (e) {
	const isContainError = validateInputs(e.target, 'update-student', this);
	submitBtn.style.visibility = isContainError ? 'hidden' : 'visible';
});

form.addEventListener('input', function (e) {
	const isContainError = validateInputs(e.target, 'update-student', this);
	submitBtn.style.visibility = isContainError ? 'hidden' : 'visible';
});

form.addEventListener('change', function (e) {
	const isContainError = validateInputs(e.target, 'update-student', this);
	submitBtn.style.visibility = isContainError ? 'hidden' : 'visible';
});

submitBtn.addEventListener('click', async (e) => {
	e.preventDefault();

	const inputs = document.querySelectorAll('.input');

	const data = {};
	inputs.forEach((input) => {
		data[input.id] = input.value;
	});

	const response = await updateStudentInDatabase(data);
	if (response.status == 'success') {
		document.querySelector('form').reset();
		document.querySelector('.first-content').style.display = 'none';

		const illustrationProps = {
			title: 'Congratulations',
			message: response.message,
			description: `
				You just updated student with sin ${response.sin},<br>lets see the list of student by clicking the button below
			`,
			view: 'student',
			redirectUrl: response.url,
			illustrationImage: `${url}public/images/completed.svg`,
		};

		showIllustrationComp(prepIllustrationComp(illustrationProps), 'success');
	} else if (response.status == 'nothing-update') {
		document.querySelector('form').reset();
		document.querySelector('.first-content').style.display = 'none';

		const illustrationProps = {
			title: 'No Data Change',
			message: response.message,
			description: `
				There is no student data change with sin ${response.sin},<br>lets see the list of student by clicking the button below
			`,
			view: 'student',
			redirectUrl: response.url,
			illustrationImage: `${url}public/images/no-data-update-illustration.svg`,
		};

		showIllustrationComp(prepIllustrationComp(illustrationProps), 'nothing-update');
	}
});

async function updateStudentInDatabase(student_data) {
	const data = student_data;
	const url = 'http://localhost/propay/student/update_action';

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
