import '../components/overlay.js';
import '../utils/row-selected.js';
localStorage.removeItem('selected');

const deleteButtons = document.querySelectorAll('.delete-btn');
const overlay = document.querySelector('.overlay');
const overlayCancelBtn = document.getElementById('overlay-cancel-btn');
const overlayDeleteBtn = document.getElementById('overlay-delete-btn');
const icon = document.querySelector('.icon');
const overlayMetaTitle = document.querySelector('.overlay .title');
const overlayMetaDescription = document.querySelector('.overlay .description');

window.addEventListener('click', function (e) {
	if (e.target == overlay) {
		e.target.classList.remove('show');
		location.reload();
	}
});

deleteButtons.forEach((button) => {
	button.addEventListener('click', function (e) {
		icon.innerHTML = /* html */ `
			<svg width="33" height="33" viewBox="0 0 33 33" fill="none" xmlns="http://www.w3.org/2000/svg">
				<circle cx="16" cy="23.5" r="1" fill="black" />
				<path d="M12 13V13C12 10.7909 13.7909 9 16 9H17V9C19.4853 9 21.5 11.0147 21.5 13.5V13.5C21.5 15.9853 19.4853 18 17 18H16V21.5" stroke="black" />
				<rect x="0.5" y="0.5" width="32" height="32" rx="16" stroke="black" />
			</svg>`;

		overlay.classList.add('show');

		let urlDelete = overlayDeleteBtn.getAttribute('href');
		let baseUrl = urlDelete.split('delete_student')[0];
		overlayDeleteBtn.removeAttribute('href');
		overlayDeleteBtn.setAttribute('href', baseUrl + 'delete_action/' + this.dataset.studentSin);

		e.preventDefault();
	});
});

overlayDeleteBtn.addEventListener('click', function (e) {
	e.preventDefault();

	const url = this.getAttribute('href');
	fetch(url, {
		mode: 'no-cors',
		credentials: 'same-origin',
		headers: {
			'Content-Type': 'application/json',
		},
	})
		.then((response) => response.json())
		.then((data) => {
			icon.innerHTML = /* html */ `
				<svg width="33" height="33" viewBox="0 0 33 33" fill="none" xmlns="http://www.w3.org/2000/svg">
					<rect x="0.5" y="0.5" width="32" height="32" rx="16" stroke="black"/>
					<path d="M9.5 15L15.5 22.5L24 10.5" stroke="black" stroke-linecap="round"/>
				</svg>
`;
			overlayMetaTitle.textContent = 'Congratulations';
			overlayMetaDescription.innerHTML = `Student with sin ${data.sin} has been successfully deleted`;
			overlay.classList.add('show');
			overlayDeleteBtn.style.display = 'none';
			overlayCancelBtn.textContent = 'Close';
			overlayCancelBtn.addEventListener('click', () => {
				location.reload();
			});
		});
	e.preventDefault();
});

overlayCancelBtn.addEventListener('click', (e) => {
	overlay.classList.remove('show');
	e.preventDefault();
});
