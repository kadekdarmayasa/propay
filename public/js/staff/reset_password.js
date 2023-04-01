import validateInputs from '../helpers/validator/index.js';

const submitBtn = document.querySelector('.submit-btn');
submitBtn.style.visibility = 'hidden';
const form = document.querySelector('form');

form.addEventListener('keyup', function (e) {
	const isContainError = validateInputs(e.target, 'add-staff', this);
	submitBtn.style.visibility = isContainError ? 'hidden' : 'visible';
});

form.addEventListener('input', function (e) {
	const isContainError = validateInputs(e.target, 'add-staff', this);
	submitBtn.style.visibility = isContainError ? 'hidden' : 'visible';
});

form.addEventListener('change', function (e) {
	const isContainError = validateInputs(e.target, 'add-staff', this);
	submitBtn.style.visibility = isContainError ? 'hidden' : 'visible';
});
