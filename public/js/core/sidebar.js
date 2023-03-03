const sidebar = document.body.querySelector('nav');
const sidebarToggle = document.body.querySelector('.sidebar-toggle');
const subMenuToggler = document.getElementById('sub-menu-toggler');
const subMenu = document.querySelector('.menu-items .sub-menu');

if (subMenu.parentElement.classList.contains('active')) {
	subMenuToggler.style.transform = 'rotate(90deg)';
} else {
	subMenuToggler.style.transform = 'rotate(0deg)';
}

let getState = localStorage.getItem('state');
if (getState && getState === 'close') {
	sidebar.classList.toggle('close');
}

sidebarToggle.addEventListener('click', () => {
	sidebar.classList.toggle('close');
	if (sidebar.classList.contains('close')) {
		localStorage.setItem('state', 'close');
	} else {
		localStorage.setItem('state', 'open');
	}
});

subMenuToggler.parentElement.addEventListener('click', (e) => {
	subMenuToggler.parentElement.parentElement.classList.toggle('active');
	if (subMenuToggler.parentElement.parentElement.classList.contains('active')) {
		subMenuToggler.style.transform = 'rotate(90deg)';
	} else {
		subMenuToggler.style.transform = 'rotate(0deg)';
	}
	e.preventDefault();
});
