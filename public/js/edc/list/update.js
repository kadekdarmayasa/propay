import '../../components/illustration.js';
import Database from '../../helpers/database.js';
import validateInputs from '../../helpers/validator/index.js';
import { prepIllustrationComp, showIllustrationComp } from '../../helpers/illustration.js';

const submitBtn = document.getElementById('submit-btn');
const url = location.href.split('edc_list', 1).toString();
const form = document.querySelector('form');
const firstContent = document.querySelector('.first-content');

submitBtn.style.visibility = 'visible';
submitBtn.disabled = false;

form.addEventListener('keyup', function (e) {
	let isContainError = validateInputs(e.target, 'update-edc', this);
	submitBtn.style.visibility = isContainError ? 'hidden' : 'visible';
	submitBtn.disabled = isContainError ? true : false;
});

form.addEventListener('input', function (e) {
	let isContainError = validateInputs(e.target, 'update-edc', this);
	submitBtn.style.visibility = isContainError ? 'hidden' : 'visible';
	submitBtn.disabled = isContainError ? true : false;
});

form.addEventListener('change', function (e) {
	let isContainError = validateInputs(e.target, 'update-edc', this);
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
		const database = new Database('http://localhost/propay/edc_list/update_action');
		const response = await database.update(data);

		if (response.status == 'success') {
			form.reset();
			firstContent.style.display = 'none';

			const illustrationProps = {
				title: 'Congratulations',
				message: 'EDC has been successfully updated',
				description: `
					EDC has been successfully updated,<br>lets see the list of edc by clicking the button below
				`,
				view: 'edc',
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
				title: 'No Data Updated',
				message: 'No Data EDC Update',
				description: `
					There is no data edc change,<br>lets see the list of edc by clicking the button below
				`,
				view: 'edc',
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
				Failed to update edc, please try again later
				`,
			view: 'edc',
			redirectUrl: `${url}edc_list/index`,
			illustrationImage: `${url}public/images/something-wrong.svg`,
			state: 'error'
		};

		showIllustrationComp(prepIllustrationComp(illustrationProps));
	}
});

