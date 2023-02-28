const profileToggle = document.querySelector('.profile-toggle');
const profileContent = document.querySelector('.notification-profile .profile');

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
