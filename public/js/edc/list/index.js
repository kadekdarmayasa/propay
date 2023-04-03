import '../../components/overlay.js';
import '../../utils/row-selected.js';
import Database from '../../helpers/database.js';

const deleteButtons = document.querySelectorAll('.delete-btn');
const overlay = document.querySelector('.overlay');
const overlayCancelBtn = document.getElementById('overlay-cancel-btn');
const overlayDeleteBtn = document.getElementById('overlay-delete-btn');
const overlayMetaTitle = document.querySelector('.overlay .title');
const overlayMetaDescription = document.querySelector('.overlay .description');
const icon = document.querySelector('.icon');

overlay.addEventListener('click', function () {
	overlay.classList.remove('show');
});

deleteButtons.forEach((button) => {
	button.addEventListener('click', function (e) {
		e.preventDefault();

		icon.innerHTML = /* html */ `
			<svg width="33" height="33" viewBox="0 0 33 33" fill="none" xmlns="http://www.w3.org/2000/svg" class="question">
				<circle cx="16" cy="23.5" r="1" fill="black" />
				<path d="M12 13V13C12 10.7909 13.7909 9 16 9H17V9C19.4853 9 21.5 11.0147 21.5 13.5V13.5C21.5 15.9853 19.4853 18 17 18H16V21.5" stroke="black" />
				<rect x="0.5" y="0.5" width="32" height="32" rx="16" stroke="black" />
			</svg>`;

		overlay.classList.add('show');

		let urlDelete = overlayDeleteBtn.getAttribute('href');
		let baseUrl = urlDelete.split('delete_edc')[0];

		overlayDeleteBtn.removeAttribute('href');
		overlayDeleteBtn.setAttribute('href', baseUrl + 'delete_action/' + this.dataset.edcId);
	});
});

overlayDeleteBtn.addEventListener('click', async function (e) {
	e.preventDefault();

	try {
		const url = this.getAttribute('href');
		const database = new Database(url);
		const response = await database.delete();

		if (response.status === 'success') {
			icon.innerHTML = /* html */ `
				<svg width="33" height="33" viewBox="0 0 33 33" fill="none" xmlns="http://www.w3.org/2000/svg" class="success">
					<rect x="0.5" y="0.5" width="32" height="32" rx="16" stroke="black"/>
					<path d="M9.5 15L15.5 22.5L24 10.5" stroke="black" stroke-linecap="round"/>
				</svg>
`;
			overlayMetaTitle.textContent = 'Congratulations';
			overlayMetaDescription.textContent = ` EDC with id ${response.edc_id} has been successfully deleted`;

			overlay.classList.add('show');

			overlayDeleteBtn.style.display = 'none';
			overlayCancelBtn.textContent = 'Close';

			overlayCancelBtn.addEventListener('click', () => {
				location.reload();
			});
		}
	} catch (e) {
		icon.innerHTML = /* html */ `
			<svg width="52" height="52" viewBox="0 0 52 52" fill="none" xmlns="http://www.w3.org/2000/svg" class="error">
					<rect x="2.5" y="2.5" width="47" height="47" rx="23.5" stroke="black"/>
					<path d="M15 15.8505L37.5 36.3505" stroke="black" stroke-linecap="round"/>
					<path d="M15.0585 36.4144L37.4415 15.7867" stroke="black" stroke-linecap="round"/>
			</svg>
		`;

		overlayMetaTitle.textContent = 'Oops!!!';
		overlayMetaDescription.textContent = `EDC cannot be deleted`;

		overlay.classList.add('show');

		overlayDeleteBtn.style.display = 'none';
		overlayCancelBtn.textContent = 'Close';

		overlayCancelBtn.addEventListener('click', () => {
			location.reload();
		});
	}
});

overlayCancelBtn.addEventListener('click', (e) => {
	overlay.classList.remove('show');
	e.preventDefault();
});
