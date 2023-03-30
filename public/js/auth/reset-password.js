import validateInputs from '../helpers/validator/index.js';

const form = document.getElementById('reset_password');

if (form) {
	const saveChangesBtn = document.querySelector('.save-changes');
	saveChangesBtn.style.visibility = 'hidden';

	form.addEventListener('keyup', function (e) {
		const isContainError = validateInputs(e.target, 'reset-password', this);
		saveChangesBtn.style.visibility = isContainError ? 'hidden' : 'visible';
		saveChangesBtn.style.visibility = isContainError ? 'hidden' : 'visible';
	});
	form.addEventListener('change', function (e) {
		const isContainError = validateInputs(e.target, 'reset-password', this);
		saveChangesBtn.style.visibility = isContainError ? 'hidden' : 'visible';
		saveChangesBtn.style.visibility = isContainError ? 'hidden' : 'visible';
	});
	form.addEventListener('keydown', function (e) {
		const isContainError = validateInputs(e.target, 'reset-password', this);
		saveChangesBtn.style.visibility = isContainError ? 'hidden' : 'visible';
		saveChangesBtn.style.visibility = isContainError ? 'hidden' : 'visible';
	});
}
