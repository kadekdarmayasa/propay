import validateInputs from '../helpers/validator/index.js';
import Database from '../helpers/database.js';
import { prepIllustrationComp, showIllustrationComp } from '../helpers/illustration.js';

const form = document.querySelector('form');
const firstContent = document.querySelector('.first-content');
const submitBtn = document.getElementById('submit-btn');
const url = location.href.split('classes', 1).toString();

form.addEventListener('keyup', function (e) {
	let isContainError = validateInputs(e.target, 'update-class');
	submitBtn.style.visibility = isContainError ? 'hidden' : 'visible';
});

form.addEventListener('input', function (e) {
	let isContainError = validateInputs(e.target, 'update-class');
	submitBtn.style.visibility = isContainError ? 'hidden' : 'visible';
});

form.addEventListener('change', function (e) {
	let isContainError = validateInputs(e.target, 'update-class');
	submitBtn.style.visibility = isContainError ? 'hidden' : 'visible';
});

submitBtn.addEventListener('click', async (e) => {
	e.preventDefault();

	const data = {};

	const inputs = document.querySelectorAll('.input');

	inputs.forEach((input) => {
		data[input.id] = input.value;
	});

	try {
		const database = new Database('http://localhost/propay/classes/update_action');
		const response = await database.update(data);

		if (response.status == 'success') {
			form.reset();
			firstContent.style.display = 'none';

			const illustrationProps = {
				title: 'Congratulations',
				message: 'Class has been successfully updated',
				description: `
					Class with id ${response.class_id} has been successfully updated,<br>lets see the list of class by clicking the button below
				`,
				view: 'class',
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
				title: 'No Data Update',
				message: 'No data class update',
				description: `
					There is no data class change with id ${response.class_id},<br>lets see the list of class by clicking the button below
				`,
				view: 'class',
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
					Failed to update class, please try again letter.
				`,
			view: 'class',
			redirectUrl: url + 'student/index',
			illustrationImage: `${url}public/images/something-wrong.svg`,
			state: 'error'
		};

		showIllustrationComp(prepIllustrationComp(illustrationProps));
	}


});
