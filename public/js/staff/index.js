const allInputs = document.querySelectorAll('input');
const username = document.querySelector('.username');
const nextBtn = document.querySelector('.next-btn');
const form = document.querySelector('form');
nextBtn.style.display = 'none';
let isFieldError = false;

for (const input of allInputs) {
	input.addEventListener('keypress', function () {
		if (input.value == '' || isFieldError) {
			nextBtn.style.display = 'none';
			return;
		} else {
			nextBtn.style.display = 'flex';
		}
	});
}

// form.addEventListener('keypress', function () {
// 	if (isFieldError) {
// 		nextBtn.style.display = 'none';
// 	} else {
// 		for (const input of allInputs) {
// 			if (input.value == '') {
// 				nextBtn.style.display = 'none';
// 				break;
// 			} else {
// 				nextBtn.style.display = 'flex';
// 			}
// 		}
// 	}
// });

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
				isFieldError = true;
				// nextBtn.style.display = 'none';
			} else {
				document.querySelector('.next-btn').disabled = false;
				document.querySelector('.username').classList.remove('error');
				document.getElementById('message').innerText = '';
				isFieldError = false;
				// nextBtn.style.display = 'flex';
			}
		}
	};

	xHttp.setRequestHeader('Content-type', 'application/json');
	xHttp.send(JSON.stringify(data));
}

/**	
	Pseudocode of filling the first until third form :

	1. User fill the username
	2. If the user name is can be used, then remove disabled attribute from the next input 
	3. User fill the password
	4. User fill the password confirmation
	5. If the password and password confirmation is match, then show the next button
 */
