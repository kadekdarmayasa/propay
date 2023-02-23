const alertElement = document.querySelector('.alert');
const closeBtn = document.getElementById('close-btn');

window.addEventListener('click', function (e) {
	if (e.target.id == 'close-btn' || e.target.getAttribute('alt') == 'close-icon') {
		alertElement.style.display = 'none';
	}
});
