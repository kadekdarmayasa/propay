function validateTerm(term) {
	const termRegex = /^[1-9]{1}[0-9]{3}\/[1-9]{1}[0-9]{3}$/i;
	let isValid = termRegex.test(term);

	if (isValid) {
		const firstTerm = term.split('/')[0];
		const secondTerm = term.split('/')[1];

		if (secondTerm == firstTerm) {
			return { isValid: false, errorMessage: 'First value cannot be the same with second value' };
		}

		if (firstTerm > secondTerm) {
			return { isValid: false, errorMessage: 'First value cannot be larger than second value' };
		}

		if (secondTerm - 1 > firstTerm) {
			return { isValid: false, errorMessage: 'Second value cannot be twice larger than first value' };
		}
	}

	return { isValid, errorMessage: 'Invalid term format' };
}

export { validateTerm };
