function validateNominal(nominal) {
	const nominalRegex = /^[1-9][0-9]{5,}$/;
	let isValid = nominalRegex.test(nominal);
	return { isValid, errorMessage: 'Only enter a number (Not less than 1 hundred thousands rupiah)' };
}

export { validateNominal };
