const passwordToggle = document.querySelectorAll('.toggle-password');
const passwordField = document.querySelectorAll('.password');
const isDarkMode = document.body.classList.contains('dark');

if (isDarkMode) {
	passwordToggle.forEach((togglePass) => {
		let baseurl = togglePass.getAttribute('src').split('/images')[0];
		togglePass.setAttribute('src', `${baseurl}/images/eye-slash-white.svg`);
	});
}

passwordToggle.forEach((togglePass, index) => {
	togglePass.addEventListener('click', () => {
		let attributeType = passwordField[index].getAttribute('type');
		let baseurl = togglePass.getAttribute('src').split('/images')[0];

		passwordField[index].removeAttribute('type');

		if (attributeType == 'text') {
			if (!isDarkMode) {
				passwordField[index].setAttribute('type', 'password');
				togglePass.setAttribute('src', `${baseurl}/images/eye-slash-regular.svg`);
			} else {
				passwordField[index].setAttribute('type', 'password');
				togglePass.setAttribute('src', `${baseurl}/images/eye-slash-white.svg`);
			}
		} else {
			if (!isDarkMode) {
				passwordField[index].setAttribute('type', 'text');
				togglePass.setAttribute('src', `${baseurl}/images/eye-regular.svg`);
			} else {
				passwordField[index].setAttribute('type', 'text');
				togglePass.setAttribute('src', `${baseurl}/images/eye-regular-white.svg`);
			}
		}
	});
});
