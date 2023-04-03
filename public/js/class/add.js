import '../components/illustration.js';
import Database from '../helpers/database.js';
import validateInputs from '../helpers/validator/index.js';
import { prepIllustrationComp, showIllustrationComp } from '../helpers/illustration.js';

const form = document.querySelector('form');
const firstContent = document.querySelector('.first-content');
const submitBtn = document.getElementById('submit-btn');
const url = location.href.split('classes', 1).toString();
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

	const data = {};

	const inputs = document.querySelectorAll('.input');

	inputs.forEach((input) => {
		data[input.id] = input.value;
	});

	try {
		const database = new Database('http://localhost/propay/classes/insert_action');
		const response = await database.insert(data);

		if (response.status == 'success') {
			form.reset();
			document.querySelector('.first-content').style.display = 'none';

			const illustrationProps = {
				title: 'Congratulations',
				message: 'Class has been successfully added',
				description: `
					Class ${response.class_name} has been successfully added,<br>lets see the list of class by clicking the button below
				`,
				view: 'class',
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
				Failure occurred when attempting to add a class.
			`,
			view: 'student',
			redirectUrl: url + 'classes/index',
			illustrationImage: `${url}public/images/something-wrong.svg`,
			state: 'error'
		};

		showIllustrationComp(prepIllustrationComp(illustrationProps));
	}

});

