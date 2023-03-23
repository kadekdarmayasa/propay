import '../components/illustration.js';
import { checkAvailability } from '../helpers/check_availability.js';

const submitBtn = document.getElementById('submit-btn');
const illustrationComponent = document.querySelector('illustration-element');
const illustrationImage = document.querySelector('.illustration-image');
const url = location.href.split('classes', 1).toString();
const form = document.querySelector('form');

form.addEventListener('keyup', function (e) {
	if (e.target.id == 'class_name') {
		checkAvailability('class-name', e.target.value, 'http://localhost/propay/classes/check_class');
	}
});

submitBtn.addEventListener('click', async (e) => {
	const inputs = [...document.querySelectorAll('input'), ...document.querySelectorAll('select')];
	const isEmpty = inputs.filter((input) => input.value === '');

	if (!isEmpty.length) {
		e.preventDefault();

		const data = {};
		inputs.forEach((input) => {
			data[input.id] = input.value;
		});

		const response = await updateClass(data);
		if (response.status == 'success') {
			form.reset();
			document.querySelector('.first-content').style.display = 'none';

			const title = 'Congratulations';
			const message = response.message;
			const description = `
			Class with id ${response.class_id} has been successfully updated,<br>lets see the list of class by clicking the button below
		`;
			const view = 'class';
			const listOfStaffUrl = response.url;
			const src = `${url}public/images/completed.svg`;

			illustrationComponent.setAttribute('title', title);
			illustrationComponent.setAttribute('message', message);
			illustrationComponent.setAttribute('description', description);
			illustrationComponent.setAttribute('view', view);
			illustrationComponent.setAttribute('url', listOfStaffUrl);
			illustrationComponent.setAttribute('src', src);

			illustrationComponent.firstElementChild.style.opacity = '1';
			illustrationComponent.firstElementChild.style.display = 'flex';
		} else if (response.status == 'nothing-update') {
			document.querySelector('form').reset();
			document.querySelector('.first-content').style.display = 'none';

			const title = 'No Data Change';
			const message = response.message;
			const description = `
			There is no data change in class ${response.class_name},<br>lets see the list of class by clicking the button below
		`;
			const view = 'class';
			const listOfStaffUrl = response.url;
			const src = `${url}public/images/no-data-update-illustration.svg`;

			illustrationComponent.setAttribute('title', title);
			illustrationComponent.setAttribute('message', message);
			illustrationComponent.setAttribute('description', description);
			illustrationComponent.setAttribute('view', view);
			illustrationComponent.setAttribute('url', listOfStaffUrl);
			illustrationComponent.setAttribute('src', src);

			illustrationComponent.firstElementChild.style.opacity = '1';
			illustrationComponent.firstElementChild.style.display = 'flex';
			illustrationImage.style.width = '40%';
		}
	}
});

async function updateClass(class_data) {
	const data = class_data;
	const url = 'http://localhost/propay/classes/update_class';

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
