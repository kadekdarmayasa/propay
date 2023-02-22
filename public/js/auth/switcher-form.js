const studentForm = document.getElementById('student-form');
const staffForm = document.getElementById('staff-form');
const switcherBtn = document.getElementById('switcher-btn');
studentForm.style.display = 'none';

switcherBtn.addEventListener('click', function () {
	let btnValue = this.innerText.split(' ')[3].toLowerCase();

	if (btnValue == 'student') {
		this.innerText = 'Sign In As Staff';
		staffForm.style.display = 'none';
		studentForm.style.display = 'flex';
	} else {
		this.innerText = 'Sign In As Student';
		studentForm.style.display = 'none';
		staffForm.style.display = 'flex';
	}
});
