import '../components/illustration.js';

const form = document.querySelector('.form');
const submitBtn = document.querySelector('.submit-btn');
const illustrationComponent = document.querySelector('illustration-element');
const url = location.href.split('student', 1).toString();

form.addEventListener('keyup', function () {
	validateAllInputs(this);
});

form.addEventListener('change', function () {
	validateAllInputs(this);
});

function validateAllInputs(element) {
	const inputs = Array.from(element.querySelectorAll('.input'));
	const isContainError = inputs.some((input) => input.value == '');

	if (!isContainError) {
		submitBtn.style.visibility = 'visible';
	} else {
		submitBtn.style.visibility = 'hidden';
	}
}

submitBtn.addEventListener('click', async (e) => {
	e.preventDefault();

	const inputs = document.querySelectorAll('.input');

	const data = {};
	inputs.forEach((input) => {
		data[input.id] = input.value;
	});

	const response = await updateStudentInDatabase(data);
	if (response.status == 'success') {
		document.querySelector('form').reset();
		document.querySelector('.first-content').style.display = 'none';

		const title = 'Congratulations';
		const message = response.message;
		const description = `
      You just updated student with sin ${response.sin},<br>lets see the list of student by clicking the button below
    `;
		const view = 'student';
		const listOfStaffUrl = response.url;
		const imgSource = `${url}public/images/completed.svg`;

		illustrationComponent.setAttribute('title', title);
		illustrationComponent.setAttribute('message', message);
		illustrationComponent.setAttribute('src', imgSource);
		illustrationComponent.setAttribute('description', description);
		illustrationComponent.setAttribute('view', view);
		illustrationComponent.setAttribute('url', listOfStaffUrl);
		illustrationComponent.firstElementChild.style.opacity = '1';
		illustrationComponent.firstElementChild.style.display = 'flex';
	}
});

async function updateStudentInDatabase(student_data) {
	const data = student_data;
	const url = 'http://localhost/propay/student/update_action';

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
