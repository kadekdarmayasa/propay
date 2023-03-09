const pageSelectedContainer = document.querySelector('.page-selected');

pageSelectedContainer.addEventListener('click', () => {
	document.querySelector('.list-of-page').classList.toggle('show');
});

const deleteButtons = document.querySelectorAll('.delete-btn');
const updateButtons = document.querySelectorAll('.update-btn');
const overlay = document.querySelector('.overlay');
const overlayCancelBtn = document.getElementById('overlay-cancel-btn');
const overlayDeleteBtn = document.getElementById('overlay-delete-btn');
const overlayMetaTitle = document.querySelector('.overlay .title');
const overlayMetaDescription = document.querySelector('.overlay .description');

overlay.addEventListener('click', function () {
	overlay.classList.remove('show');
});

deleteButtons.forEach((button) => {
	button.addEventListener('click', function (e) {
		overlayMetaTitle.textContent = 'Are you sure?';
		overlayMetaDescription.textContent = 'This data will be permanently deleted';

		overlay.classList.add('show');

		let urlDelete = overlayDeleteBtn.getAttribute('href');
		let baseUrl = urlDelete.split('delete')[0];
		overlayDeleteBtn.removeAttribute('href');
		overlayDeleteBtn.setAttribute('href', baseUrl + 'delete/' + this.dataset.classId);

		e.preventDefault();
	});
});

overlayCancelBtn.addEventListener('click', (e) => {
	overlay.classList.remove('show');
	e.preventDefault();
});
