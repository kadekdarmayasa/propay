import { checkAvailability } from '../helpers/check_availability.js';
import { prepIllustrationComp, showIllustrationComp } from '../helpers/illustration.js';

const submitBtn = document.getElementById('submit-btn');
const url = location.href.split('classes', 1).toString();
const form = document.querySelector('form');

form.addEventListener('keyup', function (e) {
	const prevClassName = document.getElementById('prev_class_name');

	if (e.target.id == 'class_name' && prevClassName.value != e.target.value) {
		checkAvailability('class-name', e.target.value, 'http://localhost/propay/classes/check_action');
	}

	const allInputs = Array.from(document.querySelectorAll('.input'));
	const isContainError = allInputs.some((input) => input.classList.contains('error') || input.value == '');

	submitBtn.style.visibility = isContainError ? 'hidden' : 'visible';
});

form.addEventListener('change', function () {
	const select = document.getElementById('major_name');
	submitBtn.style.visibility = select.value == '' ? 'hidden' : 'visible';
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
			Class with id ${response.class_id} has been successfully updated,<br>lets see the list of class by clicking the button below
		`,
			view: 'class',
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
			There is no data class change with id ${response.class_id},<br>lets see the list of class by clicking the button below
		`,
			view: 'class',
			redirectUrl: response.url,
			illustrationImage: `${url}public/images/no-data-update-illustration.svg`,
		};

		showIllustrationComp(prepIllustrationComp(illustrationProps));
	}
});

async function updateClass(class_data) {
	const data = class_data;
	const url = 'http://localhost/propay/classes/update_action';

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
