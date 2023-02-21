const passwordToggle = document.querySelectorAll('.toggle-password');
const passwordField = document.querySelectorAll('.password');

passwordToggle.forEach((togglePass, index) => {
	togglePass.addEventListener('click', () => {
		let attributeType = passwordField[index].getAttribute('type');
		let baseurl = togglePass.getAttribute('src').split('/images')[0];

		togglePass.removeAttribute('src');
		passwordField[index].removeAttribute('type');

		if (attributeType == 'text') {
			passwordField[index].setAttribute('type', 'password');
			togglePass.setAttribute('src', `${baseurl}/images/eye-slash-regular.svg`);
		} else {
			passwordField[index].setAttribute('type', 'text');
			togglePass.setAttribute('src', `${baseurl}/images/eye-regular.svg`);
		}
	});
});
