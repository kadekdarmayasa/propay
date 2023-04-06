const profileToggle = document.querySelector('.profile-toggle');
const profileContent = document.querySelector('.notification-profile .profile');
const modeToggleBtn = document.querySelector('.mode-toggle');

window.addEventListener('click', function (e) {
	if (e.target != profileToggle) {
		profileContent.classList.remove('show');

		if (document.body.classList.contains('dark')) {
			profileToggle.firstElementChild.style.stroke = 'var(--white-color)';
		} else {
			profileToggle.firstElementChild.style.stroke = 'var(--black-color)';
		}
	}
})

modeToggleBtn.addEventListener('click', function () {
	const switcher = window.getComputedStyle(document.querySelector('.mode-toggle .switch'), '::before');

	if (switcher.getPropertyValue('left') == '20px') {
		if (profileContent.classList.contains('show')) {
			profileToggle.firstElementChild.style.stroke = 'var(--primary-color)';
		} else {
			profileToggle.firstElementChild.style.stroke = 'var(--black-color)';
		}
	} else {
		if (profileContent.classList.contains('show')) {
			profileToggle.firstElementChild.style.stroke = 'var(--primary-color)';
		} else {
			profileToggle.firstElementChild.style.stroke = 'var(--white-color)';
		}
	}
});

profileToggle.addEventListener('click', function () {
	profileContent.classList.toggle('show');

	if (profileContent.classList.contains('show')) {
		this.firstElementChild.style.stroke = 'var(--primary-color)';
	} else {
		if (document.body.classList.contains('dark')) {
			this.firstElementChild.style.stroke = 'var(--white-color)';
		} else {
			this.firstElementChild.style.stroke = 'var(--black-color)';
		}
	}
});
