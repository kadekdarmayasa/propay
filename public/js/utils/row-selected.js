const rowSelectedContainer = document.querySelector('.row-selected');
const listOfRowContainer = document.querySelector('.list-of-row');
const listOfRowLis = document.querySelectorAll('.list-of-row li');
const select = document.getElementById('select');

if (rowSelectedContainer) {
	rowSelectedContainer.tabIndex = 0;

	if (location.href.split('/').includes('payment')) {
		rowSelectedContainer.firstElementChild.textContent = 6;
	} else {
		rowSelectedContainer.firstElementChild.textContent = 5;
	}

	if (localStorage.getItem('selected')) {
		if (localStorage.getItem('selected') == 5 && listOfRowContainer.classList.contains('payment')) {
			rowSelectedContainer.firstElementChild.textContent = 6;
		}

		if (localStorage.getItem('selected') == 10 && listOfRowContainer.classList.contains('payment')) {
			rowSelectedContainer.firstElementChild.textContent = 12;
		}

		if (localStorage.getItem('selected') == 5 && !listOfRowContainer.classList.contains('payment')) {
			rowSelectedContainer.firstElementChild.textContent = 5;
		}

		if (localStorage.getItem('selected') == 10 && !listOfRowContainer.classList.contains('payment')) {
			rowSelectedContainer.firstElementChild.textContent = 10;
		}

		if (localStorage.getItem('selected') == 12 && listOfRowContainer.classList.contains('payment')) {
			rowSelectedContainer.firstElementChild.textContent = 12;
		}

		if (localStorage.getItem('selected') == 6 && listOfRowContainer.classList.contains('payment')) {
			rowSelectedContainer.firstElementChild.textContent = 6;
		}

		if (localStorage.getItem('selected') == 12 && !listOfRowContainer.classList.contains('payment')) {
			rowSelectedContainer.firstElementChild.textContent = 10;
		}

		if (localStorage.getItem('selected') == 6 && !listOfRowContainer.classList.contains('payment')) {
			rowSelectedContainer.firstElementChild.textContent = 10;
		}
	}

	rowSelectedContainer.addEventListener('click', (e) => {
		e.preventDefault();
		listOfRowContainer.classList.toggle('show');

		listOfRowLis.forEach((row) => {
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

