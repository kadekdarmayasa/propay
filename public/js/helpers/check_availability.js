import { errorMessage } from './error_message.js';

function checkAvailability(name, value, url) {
	const data = { [name]: value };

	const xHttp = new XMLHttpRequest();
	xHttp.open('POST', url, true);

	xHttp.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			const data = JSON.parse(this.responseText);
			if (data.status == 'error') {
				document.querySelector('.next-btn').disabled = true;
				document.querySelector(`.${name}`).classList.add('error');
				errorMessage(`${name}-message`, data.message);
			} else {
				document.querySelector('.next-btn').disabled = false;
				document.querySelector(`.${name}`).classList.remove('error');
			}
		}
	};

	xHttp.setRequestHeader('Content-type', 'application/json');
	xHttp.send(JSON.stringify(data));
}

export { checkAvailability };
