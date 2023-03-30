const rowSelectedContainer = document.querySelector('.row-selected');
const listOfRows = document.querySelectorAll('.list-of-row li');
const select = document.getElementById('select');

if (rowSelectedContainer) {
	rowSelectedContainer.tabIndex = 0;
	if (location.href.split('/').includes('edc_payment')) {
		rowSelectedContainer.firstElementChild.textContent = 6;
	} else {
		rowSelectedContainer.firstElementChild.textContent = 5;
	}

	if (localStorage.getItem('selected')) {
		rowSelectedContainer.firstElementChild.textContent = localStorage.getItem('selected');
	}

	rowSelectedContainer.addEventListener('click', (e) => {
		e.preventDefault();
		document.querySelector('.list-of-row').classList.toggle('show');

		listOfRows.forEach((row) => {
			if (row.textContent == rowSelectedContainer.firstElementChild.textContent) {
				row.classList.add('selected');
			} else {
				row.classList.remove('selected');
			}

			row.addEventListener('click', (e) => {
				select.firstElementChild.value = e.target.textContent;
				localStorage.setItem('selected', e.target.textContent);

				if (select.firstElementChild.value !== '') {
					select.parentElement.submit();
				}
			});
		});
	});
}
