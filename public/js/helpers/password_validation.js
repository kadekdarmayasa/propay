function validatePassword(password) {
	let passwordRegex = /^[A-Za-z]\w{7,20}$/;
	let isValid = password.match(passwordRegex);
	return { isValid, errorMessage: 'The password must start with alphabet and followed by (7-20) characters' };
}

export { validatePassword };
