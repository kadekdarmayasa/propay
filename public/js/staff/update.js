import '../components/illustration.js';
import Database from '../helpers/database.js';
import validateInputs from '../helpers/validator/index.js';
import { prepIllustrationComp, showIllustrationComp } from '../helpers/illustration.js';

const form = document.forms[0];
const firstContent = document.querySelector('.first-content');
const formClass = document.querySelector('.form');
const submitBtn = document.querySelector('.submit-btn');
const url = location.href.split('staff', 1).toString();

formClass.addEventListener('keyup', function (e) {
	const isContainError = validateInputs(e.target, 'update-staff', this);
	submitBtn.style.visibility = isContainError ? 'hidden' : 'visible';
	submitBtn.disabled = isContainError ? true : false;
});

formClass.addEventListener('input', function (e) {
	const isContainError = validateInputs(e.target, 'update-staff', this);
	submitBtn.style.visibility = isContainError ? 'hidden' : 'visible';
	submitBtn.disabled = isContainError ? true : false;
});

formClass.addEventListener('change', function (e) {
	const isContainError = validateInputs(e.target, 'update-staff', this);
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
		const database = new Database('http://localhost/propay/staff/update_action')
		const response = await database.update(data);

		if (response.status == 'success') {
			form.reset();
			firstContent.style.display = 'none';

			const illustrationProps = {
				title: 'Congratulations',
				message: 'Staff has been successfully update',
				description: `
				Staff with id ${response.id_staff} has successfully updated,<br>lets see the list of staff by clicking the button below
			`,
				view: 'staff',
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
				message: 'No staff data update',
				description: `
				There is no staff data change with id ${response.id_staff},<br>lets see the list of staff by clicking the button below
			`,
				view: 'staff',
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
					Failed to update student, please try again letter.
				`,
			view: 'staff',
			redirectUrl: `${url}staff/index`,
			illustrationImage: `${url}public/images/something-wrong.svg`,
			state: 'error'
		};

		showIllustrationComp(prepIllustrationComp(illustrationProps));
	}
});

