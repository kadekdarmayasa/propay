import '../components/overlay.js';
import validateInputs from '../helpers/validator/index.js';
import Payment from '../helpers/payment.js';
import formatDate from '../utils/date_format.js';

const paymentForm = document.querySelector('#payment-form');
const closeBtn = document.querySelector('.close-btn');
const overlayInputForm = document.querySelector('.overlay-input-form');
const payButtons = document.querySelectorAll('.pay-btn');
const paymentId = document.querySelector('#payment_id');
const dateOfPayment = document.querySelector('#date_of_payment');
const submitBtn = document.querySelector('.submit-btn');

const overlay = document.querySelector('.overlay');
const overlayCancelBtn = document.getElementById('overlay-cancel-btn');
const overlayDeleteBtn = document.getElementById('overlay-delete-btn');
const overlayMetaTitle = document.querySelector('.overlay .title');
const overlayMetaDescription = document.querySelector('.overlay .description');
const icon = document.querySelector('.icon');

submitBtn.style.visibility = 'hidden';
submitBtn.disabled = true;

window.addEventListener('click', (e) => {
	if (e.target === overlayInputForm) {
		overlayInputForm.classList.remove('show');
	}
});

payButtons.forEach((payBtn) => {
	payBtn.addEventListener('click', function (e) {
		paymentId.value = this.dataset.paymentId;
		dateOfPayment.value = formatDate(this.dataset.paymentDate);

		overlayInputForm.classList.add('show');
		e.preventDefault();
	});
});

paymentForm.addEventListener('input', function (e) {
	const isContainError = validateInputs(e.target, 'payment', this);

	submitBtn.style.visibility = isContainError ? 'hidden' : 'visible';
	submitBtn.disabled = isContainError ? true : false;
});

paymentForm.addEventListener('change', function (e) {
	const isContainError = validateInputs(e.target, 'payment', this);

	submitBtn.style.visibility = isContainError ? 'hidden' : 'visible';
	submitBtn.disabled = isContainError ? true : false;
});

paymentForm.addEventListener('keyup', function (e) {
	const isContainError = validateInputs(e.target, 'payment', this);

	submitBtn.style.visibility = isContainError ? 'hidden' : 'visible';
	submitBtn.disabled = isContainError ? true : false;
});

paymentForm.addEventListener('submit', async function (e) {
	e.preventDefault();

	const data = {};

	const inputs = document.querySelectorAll('.input');

	inputs.forEach((input) => {
		data[input.id] = input.value;
	});

	try {
		const payment = new Payment('http://localhost/propay/payment/payment_action');
		const response = await payment.process(data);

		if (response.status == 'success') {
			this.reset();
			overlayInputForm.classList.remove('show');

			icon.innerHTML = /* html */ `
				<svg width="52" height="52" viewBox="0 0 52 52" fill="none" xmlns="http://www.w3.org/2000/svg" class="success">
					<rect x="2.5" y="2.5" width="47" height="47" rx="23.5" stroke="black"/>
					<path d="M15 23.5L24.5 34L39.5 18" stroke="black" stroke-linecap="round"/>
				</svg>
			`;

			overlayMetaTitle.textContent = response.message;

			if (response.refund != 'Rp. 0') {
				overlayMetaDescription.style.lineHeight = '1.8';
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
	} catch (e) {
		this.reset();
		overlayInputForm.classList.remove('show');

		icon.innerHTML = /* html */ `
			<svg width="52" height="52" viewBox="0 0 52 52" fill="none" xmlns="http://www.w3.org/2000/svg" class="error">
					<rect x="2.5" y="2.5" width="47" height="47" rx="23.5" stroke="black"/>
					<path d="M15 15.8505L37.5 36.3505" stroke="black" stroke-linecap="round"/>
					<path d="M15.0585 36.4144L37.4415 15.7867" stroke="black" stroke-linecap="round"/>
			</svg>
		`;

		overlayMetaTitle.textContent = 'Oops!!!';
		overlayMetaDescription.innerHTML = 'Your payment failed to process';

		overlay.classList.add('show');

		overlayDeleteBtn.style.display = 'none';
		overlayCancelBtn.textContent = 'Close';

		overlayCancelBtn.addEventListener('click', () => {
			location.reload();
		});
	}

});

closeBtn.addEventListener('click', () => {
	overlayInputForm.classList.remove('show');
});

