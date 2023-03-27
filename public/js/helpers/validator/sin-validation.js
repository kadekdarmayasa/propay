function validateSin(sin) {
	const sinRegex = /^[1-9][0-9]{3}$/i;
	let isValid = sinRegex.test(sin);
	if (isValid == false) {
		return { isValid, errorMessage: 'Please enter a valid SIN' };
	}
	return { isValid: true, errorMessage: '' };
}

export { validateSin };
