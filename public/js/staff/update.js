import '../components/illustration.js';

const submitBtn = document.querySelector('.submit-btn');
const illustrationComponent = document.querySelector('illustration-element');
const illustrationImage = document.querySelector('.illustration-image');
const url = location.href.split('staff', 1).toString();

submitBtn.addEventListener('click', async (e) => {
	const inputs = [...document.querySelectorAll('input'), ...document.querySelectorAll('select'), document.querySelector('textarea')];
	const isEmpty = inputs.filter((input) => input.value === '');

	if (!isEmpty.length) {
		e.preventDefault();

		const data = {};
		inputs.forEach((input) => {
			data[input.id] = input.value;
		});

		const response = await updateStaff(data);
		if (response.status == 'success') {
			document.querySelector('form').reset();
			document.querySelector('.first-content').style.display = 'none';

			const title = 'Congratulations';
			const message = response.message;
			const description = `
			Staff with id ${response.id_staff} has successfully updated,<br>lets see the list of staff by clicking the button below
		`;
			const view = 'staff';
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
			There is no staff data change with id ${response.id_staff},<br>lets see the list of staff by clicking the button below
		`;
			const view = 'staff';
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
