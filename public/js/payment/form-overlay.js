import '../components/overlay.js';

const closeBtn = document.querySelector('.close-btn');
const overlayInputForm = document.querySelector('.overlay-input-form');
const payButtons = document.querySelectorAll('.pay-btn');
const paymentAmount = document.querySelector('#payment_amount');
const paymentId = document.querySelector('#payment_id');
const dateOfPayment = document.querySelector('#date_of_payment');
const paymentForm = document.querySelector('#payment-form');

const overlay = document.querySelector('.overlay');
const overlayCancelBtn = document.getElementById('overlay-cancel-btn');
const overlayDeleteBtn = document.getElementById('overlay-delete-btn');
const overlayMetaTitle = document.querySelector('.overlay .title');
const overlayMetaDescription = document.querySelector('.overlay .description');
const icon = document.querySelector('.icon');

paymentForm.addEventListener('submit', async function (e) {
	if (!parseInt(paymentAmount.value)) {
		e.preventDefault();
		this.reset();
		overlayInputForm.classList.remove('show');
	}

	if (paymentAmount.value != '' || dateOfPayment.value != '') {
		e.preventDefault();

		const inputs = [...this.querySelectorAll('.input')];

		const data = {};
		inputs.forEach((input) => {
			data[input.id] = input.value;
		});

		const response = await payment(data);

		if (response.status == 'success') {
			this.reset();
			overlayInputForm.classList.remove('show');

			icon.innerHTML = /* html */ `
				<svg width="33" height="33" viewBox="0 0 33 33" fill="none" xmlns="http://www.w3.org/2000/svg">
					<rect x="0.5" y="0.5" width="32" height="32" rx="16" stroke="black"/>
					<path d="M9.5 15L15.5 22.5L24 10.5" stroke="black" stroke-linecap="round"/>
				</svg>
`;
			overlayMetaTitle.textContent = response.message;

			if (response.refund != 'Rp. 0') {
				overlayMetaDescription.innerHTML = response.description + '<br>' + ' with Total Refund <b>' + response.refund + ' </b>';
			} else {
				overlayMetaDescription.innerHTML = response.description;
			}

			overlay.classList.add('show');

			overlayDeleteBtn.style.display = 'none';
			overlayCancelBtn.textContent = 'Close';

			overlayCancelBtn.addEventListener('click', () => {
				location.reload();
			});
		}
	}
});

async function payment(payment_data) {
	const data = payment_data;
	const url = 'http://localhost/propay/edc_payment/payment_action';

	const response = await fetch(url, {
		method: 'POST',
		mode: 'no-cors',
		credentials: 'same-origin',
		headers: {
			'Content-Type': 'application/json',
		},
		body: JSON.stringify(data),
	});

	return response.json();
}

window.addEventListener('click', (e) => {
	if (e.target === overlayInputForm) {
		overlayInputForm.classList.remove('show');
	}
});

closeBtn.addEventListener('click', () => {
	overlayInputForm.classList.remove('show');
});

payButtons.forEach((payBtn) => {
	payBtn.addEventListener('click', function (e) {
		paymentId.value = this.dataset.paymentId;
		dateOfPayment.value = formatDate(this.dataset.paymentDate);
		overlayInputForm.classList.add('show');
		e.preventDefault();
	});
});

function formatDate(strDate) {
	const months = {
		Jan: '01',
		Feb: '02',
		Mar: '03',
		Apr: '04',
		May: '05',
		Jun: '06',
		Jul: '07',
		Aug: '08',
		Sep: '09',
		Oct: '10',
		Nov: '11',
		Dec: '12',
	};

	const dates = strDate.split(' ');
	const date = dates[0];
	const month = months[dates[1]];
	const year = dates[2];

	return `${year}-${month}-${date}`;
}
