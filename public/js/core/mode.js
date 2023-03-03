const modeToggle = document.body.querySelector('.mode-toggle');

modeToggle.addEventListener('click', () => {
	document.body.classList.toggle('dark');
	if (document.body.classList.contains('dark')) {
		localStorage.setItem('mode', 'dark');
	} else {
		localStorage.setItem('mode', 'light');
	}
});
