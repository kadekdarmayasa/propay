function validateNsn(nsn) {
	const nsnRegex = /^[0-9]{10}$/i;
	let isValid = nsnRegex.test(nsn);
	if (isValid == false) {
		return { isValid, errorMessage: 'Please enter a valid NSN' };
	}
	if (nsn == '0000000000' || nsn == '00000000000') {
		return { isValid: false, errorMessage: 'NSN cannot be all zeros' };
	}
	return { isValid: true, errorMessage: '' };
}

export { validateNsn };
