const body = document.querySelector('body');

let getMode = localStorage.getItem('mode');

if (getMode && getMode === 'dark') {
	body.classList.add('dark');
} else {
	body.classList.remove('dark');
}

window.addEventListener('load', () => {
	window.history.replaceState(null, null, window.location.href);
});
