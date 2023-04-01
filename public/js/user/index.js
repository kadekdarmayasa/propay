import validateInputs from '../helpers/validator/index.js';

const form = document.querySelector('form');
const submitBtn = document.querySelector('.submit-btn');
submitBtn.style.visibility = 'hidden';

form.addEventListener('keyup', function (e) {
	const isContainError = validateInputs(e.target, 'reset-password', this);
	submitBtn.style.visibility = isContainError ? 'hidden' : 'visible';
});

form.addEventListener('input', function (e) {
	const isContainError = validateInputs(e.target, 'reset-password', this);
	submitBtn.style.visibility = isContainError ? 'hidden' : 'visible';
});

form.addEventListener('change', function (e) {
	const isContainError = validateInputs(e.target, 'reset-password', this);
	submitBtn.style.visibility = isContainError ? 'hidden' : 'visible';
});
