const pageSelectedContainer = document.querySelector('.page-selected');

pageSelectedContainer.addEventListener('click', () => {
	document.querySelector('.list-of-page').classList.toggle('show');
});
