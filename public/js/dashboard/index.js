const modeToggle = body.querySelector('.mode-toggle'),
	sidebar = body.querySelector('nav'),
	sidebarToggle = body.querySelector('.sidebar-toggle');
const subMenuToggler = document.getElementById('sub-menu-toggler');
const subMenu = document.querySelector('.menu-items .sub-menu');

if (subMenu.parentElement.classList.contains('active')) {
	subMenuToggler.style.transform = 'rotate(90deg)';
} else {
	subMenuToggler.style.transform = 'rotate(0deg)';
}

let getStatus = localStorage.getItem('status');
if (getStatus && getStatus === 'close') {
	sidebar.classList.toggle('close');
}

subMenuToggler.parentElement.addEventListener('click', (e) => {
	subMenuToggler.parentElement.parentElement.classList.toggle('active');
	if (subMenuToggler.parentElement.parentElement.classList.contains('active')) {
		subMenuToggler.style.transform = 'rotate(90deg)';
	} else {
		subMenuToggler.style.transform = 'rotate(0deg)';
	}
	e.preventDefault();
});

modeToggle.addEventListener('click', () => {
	body.classList.toggle('dark');
	if (body.classList.contains('dark')) {
		localStorage.setItem('mode', 'dark');
	} else {
		localStorage.setItem('mode', 'light');
	}
});

sidebarToggle.addEventListener('click', () => {
	sidebar.classList.toggle('close');
	if (sidebar.classList.contains('close')) {
		localStorage.setItem('status', 'close');
	} else {
		localStorage.setItem('status', 'open');
	}
});
