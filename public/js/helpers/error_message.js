const messages = document.querySelectorAll('.message');

function showErrorMessage(classNm, errorMessage) {
	messages.forEach((message) => {
		if (message.classList.contains(classNm)) {
			message.innerText = errorMessage;
		}
	});
}

export { showErrorMessage as errorMessage };
