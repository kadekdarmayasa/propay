import '../components/illustration.js';

const submitBtn = document.getElementById('submit-btn');
const illustrationComponent = document.querySelector('illustration-component');

submitBtn.addEventListener('click', async (e) => {
	const className = document.getElementById('class-name');
	const major = document.getElementById('major');

	if (className.value != '' || major.value != '') {
		e.preventDefault();

		const data = {
			className: className.value,
			major: major.value,
		};

		const response = await insertClassToDatabase(data);
		if (response.status == 'success') {
			document.querySelector('form').reset();
			document.querySelector('.first-content').style.display = 'none';

			const message = response.message;
			const description = `
			You just add new class with name ${response.class_name},<br>lets see the list of class by clicking the button below
		`;
			const view = 'class';
			const listOfClassUrl = response.url;

			illustrationComponent.setAttribute('success-message', message);
			illustrationComponent.setAttribute('description', description);
			illustrationComponent.setAttribute('view', view);
			illustrationComponent.setAttribute('url', listOfClassUrl);

			illustrationComponent.firstElementChild.style.opacity = '1';
			illustrationComponent.firstElementChild.style.display = 'flex';
		}
	}
});

async function insertClassToDatabase(class_data) {
	const data = class_data;
	const url = 'http://localhost/propay-payment-system/classes/add_class';

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
