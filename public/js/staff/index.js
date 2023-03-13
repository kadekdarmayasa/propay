const firstForm = document.querySelector('.form.first');
const username = document.querySelector('.username');
const nextBtn = document.querySelector('.next-btn');
const prevBtn = document.querySelector('.prev-btn');

nextBtn.addEventListener('click', () => {
	firstForm.classList.add('hide');
});

prevBtn.addEventListener('click', () => {
	firstForm.classList.remove('hide');
});

username.addEventListener('keyup', function () {
	let isValid = validateUsername(this.value);

	if (!isValid) {
		document.querySelector('.next-btn').disabled = true;
		document.querySelector('.username').classList.add('error');
		document.getElementById('message').innerText = 'Please enter a valid username';
	} else {
		checkAvailability(this.value);
	}
});

function validateUsername(username) {
	var nameRegex = /^([a-z0-9-_]+)$/i;
	var isValid = username.match(nameRegex);
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
				document.getElementById('message').innerText = data.message;
			} else {
				document.querySelector('.next-btn').disabled = false;
				document.querySelector('.username').classList.remove('error');
				document.getElementById('message').innerText = '';
			}
		}
	};

	xHttp.setRequestHeader('Content-type', 'application/json');
	xHttp.send(JSON.stringify(data));
}
