function validatePassword(password) {
	let passwordRegex = /^[1-9A-Za-z]\w{7,20}$/;
	let isValid = password.match(passwordRegex);
	return { isValid, errorMessage: 'Password must contains at least 8 characters exclude space' };
}

export { validatePassword };
