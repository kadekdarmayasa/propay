import '../components/illustration.js';
import Database from '../helpers/database.js';
import validateInputs from '../helpers/validator/index.js';
import { showIllustrationComp, prepIllustrationComp } from '../helpers/illustration.js';

const form = document.forms[0];
const submitBtn = document.querySelector('.submit-btn');
const firstContent = document.querySelector('.first-content');
const url = location.href.split('student', 1).toString();

form.addEventListener('keyup', function (e) {
	const isContainError = validateInputs(e.target, 'update-student', this);
	submitBtn.style.visibility = isContainError ? 'hidden' : 'visible';
	submitBtn.disabled = isContainError ? true : false;
});

form.addEventListener('input', function (e) {
	const isContainError = validateInputs(e.target, 'update-student', this);
	submitBtn.style.visibility = isContainError ? 'hidden' : 'visible';
	submitBtn.disabled = isContainError ? true : false;
});

form.addEventListener('change', function (e) {
	const isContainError = validateInputs(e.target, 'update-student', this);
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
		const database = new Database('http://localhost/propay/student/update_action');
		const response = await database.update(data);

		if (response.status == 'success') {
			form.reset();
			firstContent.style.display = 'none';

			const illustrationProps = {
				title: 'Congratulations',
				message: 'Student has been successfully updated',
				description: `
					You just updated student with sin ${response.sin},<br>lets see the list of student by clicking the button below
				`,
				view: 'student',
				redirectUrl: response.url,
				illustrationImage: `${url}public/images/completed.svg`,
				state: 'success'
			};

			showIllustrationComp(prepIllustrationComp(illustrationProps));
		}

		if (response.status == 'nothing-update') {
			form.reset();
			firstContent.style.display = 'none';

			const illustrationProps = {
				title: 'Nothing Update',
				message: 'No student data update',
				description: `
					There is no student data change with sin ${response.sin},<br>lets see the list of student by clicking the button below
				`,
				view: 'student',
				redirectUrl: response.url,
				illustrationImage: `${url}public/images/no-data-update-illustration.svg`,
				state: 'nothing-update'
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
					Failed to update student, please try again later.
				`,
			view: 'student',
			redirectUrl: `${url}student/index`,
			illustrationImage: `${url}public/images/something-wrong.svg`,
			state: 'error'
		};

		showIllustrationComp(prepIllustrationComp(illustrationProps));
	}
});
