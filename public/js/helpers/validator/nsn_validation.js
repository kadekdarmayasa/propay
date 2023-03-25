function validateNsn(nsn) {
	const nsnRegex = /^[0-9]{10}$/;
	let isValid = nsnRegex.test(nsn);
	return { isValid, errorMessage: 'Please enter a valid NSN' };
}

export { validateNsn };
