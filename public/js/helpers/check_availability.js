import { errorMessage } from './error_message.js';

function checkAvailability(name, value, url) {
	const data = { [name]: value.trim() };

	const xHttp = new XMLHttpRequest();

	xHttp.onreadystatechange = async function () {
		if (this.readyState == 4 && this.status == 200) {
			const data = JSON.parse(this.responseText);
			const classNames = {
				username: '.next-btn',
				'class-name': '.submit-btn',
			};

			if (data.status == 'error') {
				document.querySelector(`${classNames[name]}`).disabled = true;
				document.querySelector(`.${name}`).classList.add('error');
				errorMessage(`${name}-message`, data.message);
			} else {
				document.querySelector(`${classNames[name]}`).disabled = false;
				document.querySelector(`.${name}`).classList.remove('error');
			}
		}
	};

	xHttp.open('POST', url, true);
	xHttp.setRequestHeader('Content-type', 'application/json');
	xHttp.send(JSON.stringify(data));
}

export { checkAvailability };
