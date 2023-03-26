import '../components/illustration.js';
import validateInputs from '../helpers/validator/index.js';
import { prepIllustrationComp, showIllustrationComp } from '../helpers/illustration.js';

const form = document.querySelector('.form');
const submitBtn = document.querySelector('.submit-btn');
const url = location.href.split('staff', 1).toString();

form.addEventListener('keyup', function (e) {
	const isContainError = validateInputs(e.target, 'update-staff', this);
	submitBtn.style.visibility = isContainError ? 'hidden' : 'visible';
});

form.addEventListener('input', function (e) {
	const isContainError = validateInputs(e.target, 'update-staff', this);
	submitBtn.style.visibility = isContainError ? 'hidden' : 'visible';
});

form.addEventListener('change', function (e) {
	const isContainError = validateInputs(e.target, 'update-staff', this);
	submitBtn.style.visibility = isContainError ? 'hidden' : 'visible';
});

submitBtn.addEventListener('click', async (e) => {
	e.preventDefault();

	const inputs = [...document.querySelectorAll('input'), ...document.querySelectorAll('select'), document.querySelector('textarea')];

	const data = {};
	inputs.forEach((input) => {
		data[input.id] = input.value;
	});

	const response = await updateStaff(data);

	if (response.status == 'success') {
		document.querySelector('form').reset();
		document.querySelector('.first-content').style.display = 'none';

		const illustrationProps = {
			title: 'Congratulations',
			message: response.message,
			description: `
				Staff with id ${response.id_staff} has successfully updated,<br>lets see the list of staff by clicking the button below
			`,
			view: 'staff',
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
				There is no staff data change with id ${response.id_staff},<br>lets see the list of staff by clicking the button below
			`,
			view: 'staff',
			redirectUrl: response.url,
			illustrationImage: `${url}public/images/no-data-update-illustration.svg`,
		};

		showIllustrationComp(prepIllustrationComp(illustrationProps), 'nothing-update');
	}
});

async function updateStaff(staff_data) {
	const data = staff_data;
	const url = 'http://localhost/propay/staff/update_action';

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
