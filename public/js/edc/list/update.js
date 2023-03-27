import '../../components/illustration.js';
import validateInputs from '../../helpers/validator/index.js';
import { prepIllustrationComp, showIllustrationComp } from '../../helpers/illustration.js';

const submitBtn = document.getElementById('submit-btn');
const url = location.href.split('edc_list', 1).toString();
const form = document.querySelector('form');
submitBtn.style.visibility = 'visible';

form.addEventListener('keyup', function (e) {
	let isContainError = validateInputs(e.target, 'update-edc', this);
	submitBtn.style.visibility = isContainError ? 'hidden' : 'visible';
});

form.addEventListener('input', function (e) {
	let isContainError = validateInputs(e.target, 'update-edc', this);
	submitBtn.style.visibility = isContainError ? 'hidden' : 'visible';
});

form.addEventListener('change', function (e) {
	let isContainError = validateInputs(e.target, 'update-edc', this);
	submitBtn.style.visibility = isContainError ? 'hidden' : 'visible';
});

submitBtn.addEventListener('click', async (e) => {
	e.preventDefault();

	const inputs = [...document.querySelectorAll('input'), ...document.querySelectorAll('select')];

	const data = {};
	inputs.forEach((input) => {
		data[input.id] = input.value;
	});

	const response = await updateClass(data);

	if (response.status == 'success') {
		form.reset();
		document.querySelector('.first-content').style.display = 'none';

		const illustrationProps = {
			title: 'Congratulations',
			message: response.message,
			description: `
			EDC has been successfully updated,<br>lets see the list of edc by clicking the button below
		`,
			view: 'edc',
			redirectUrl: response.url,
			illustrationImage: `${url}public/images/completed.svg`,
		};

		showIllustrationComp(prepIllustrationComp(illustrationProps));
	} else if (response.status == 'nothing-update') {
		document.querySelector('form').reset();
		document.querySelector('.first-content').style.display = 'none';

		const illustrationProps = {
			title: 'No Data Change',
			message: response.message,
			description: `
			There is no data edc change,<br>lets see the list of edc by clicking the button below
		`,
			view: 'edc',
			redirectUrl: response.url,
			illustrationImage: `${url}public/images/no-data-update-illustration.svg`,
		};

		showIllustrationComp(prepIllustrationComp(illustrationProps), 'nothing-update');
	}
});

async function updateClass(edc_data) {
	const data = edc_data;
	const url = 'http://localhost/propay/edc_list/update_action';

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
