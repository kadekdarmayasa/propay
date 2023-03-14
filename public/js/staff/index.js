import '../components/completed-illustration.js';

const firstForm = document.querySelector('.form.first');
const nextBtn = document.querySelector('.next-btn');
const prevBtn = document.querySelector('.prev-btn');
const submitBtn = document.querySelector('.submit-btn');
const messages = document.querySelectorAll('.message');
const completedIllustration = document.querySelector('completed-illustration');

submitBtn.addEventListener('click', async (e) => {
	const inputs = [...document.querySelectorAll('input'), ...document.querySelectorAll('select'), document.querySelector('textarea')];
	const isEmpty = inputs.filter((input) => input.value === '');

	if (!isEmpty.length) e.preventDefault();

	const data = {};
	inputs.forEach((input) => {
		data[input.id] = input.value;
	});

	const response = await insertStaffToDatabase(data);
	console.log(response);
});

nextBtn.addEventListener('click', (e) => {
	firstForm.classList.add('hide');
	e.preventDefault();
});

prevBtn.addEventListener('click', () => {
	firstForm.classList.remove('hide');
});

firstForm.addEventListener('keyup', (e) => {
	if (e.target.classList.contains('username')) {
		let isValid = validateUsername(e.target.value);

		if (!isValid) {
			document.querySelector('.next-btn').disabled = true;
			e.target.classList.add('error');
			showErrorMessage('username-message', 'Please enter a valid username');
		} else {
			checkAvailability(e.target.value);
		}
	}

	if (e.target.classList.contains('password')) {
		let isValid = validatePassword(e.target.value);

		if (!isValid) {
			document.querySelector('.next-btn').disabled = true;
			e.target.classList.add('error');
			showErrorMessage('password-message', 'The password must start with alphabet and followed by (7-14) characters except space');
		} else {
			document.querySelector('.next-btn').disabled = false;
			e.target.classList.remove('error');
		}
	}

	if (e.target.classList.contains('confirm-password')) {
		let password = document.querySelector('.password');

		if (e.target.value !== password.value) {
			document.querySelector('.next-btn').disabled = true;
			e.target.classList.add('error');
			showErrorMessage('confirm-password-message', `Password doesn't match`);
		} else {
			document.querySelector('.next-btn').disabled = false;
			e.target.classList.remove('error');
		}
	}
});

function showErrorMessage(classNm, errorMessage) {
	messages.forEach((message) => {
		if (message.classList.contains(classNm)) {
			message.innerText = errorMessage;
		}
	});
}

function validateUsername(username) {
	var nameRegex = /^([a-z0-9-_]+)$/i;
	var isValid = username.match(nameRegex);
	return isValid;
}

function validatePassword(password) {
	// This regex will check valid password
	// which is start from alphabet and followed by 7 to 14 characters
	var passwordRegex = /^[A-Za-z]\w{7,14}$/;
	var isValid = password.match(passwordRegex);
	return isValid;
}

function checkAvailability(str) {
	const data = { username: str };

	const xHttp = new XMLHttpRequest();
	xHttp.open('POST', 'http://localhost/propay-payment-system/staff/check_staff', true);

	xHttp.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			const data = JSON.parse(this.responseText);
			if (data.status == 'error') {
				document.querySelector('.next-btn').disabled = true;
				document.querySelector('.username').classList.add('error');
				showErrorMessage('username-message', data.message);
			} else {
				document.querySelector('.next-btn').disabled = false;
				document.querySelector('.username').classList.remove('error');
			}
		}
	};

	xHttp.setRequestHeader('Content-type', 'application/json');
	xHttp.send(JSON.stringify(data));
}

async function insertStaffToDatabase(staff_data) {
	const data = staff_data;
	const url = 'http://localhost/propay-payment-system/staff/add_staff';

	/* A fetch request to the server. */
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

// Flow add staff data
// 1. User click add staff button to the server
// 2. Server send the result to the client
// 3. Client show the result to the browser depending on the serve response status
