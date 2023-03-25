function validateUsername(username) {
	let nameRegex = /^([a-z0-9-_]+)$/i;
	let isValid = username.match(nameRegex);
	return isValid;
}

export { validateUsername };
