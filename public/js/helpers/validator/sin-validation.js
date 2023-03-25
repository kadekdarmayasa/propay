function validateSin(sin) {
	const sinRegex = /^[1-9][0-9]{3,4}$/i;
	let isValid = sin.match(sinRegex);
	return isValid;
}

export { validateSin };
