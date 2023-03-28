import '../components/illustration.js';
let illustrationComponent = document.querySelector('illustration-element');
const illustrationImage = document.querySelector('.illustration-image');

function prepIllustrationComp({ title = '', message = '', description = '', view = '', redirectUrl = '', illustrationImage = '' }) {
	if (view == 'waiting-for-search-payment') {
		illustrationComponent = document.querySelector('#waiting-for-search-illustration');
		illustrationComponent.setAttribute('description', description);
		illustrationComponent.setAttribute('src', illustrationImage);
		illustrationComponent.setAttribute('view', view);
	} else if (view == 'not-found-payment') {
		illustrationComponent = document.querySelector('#not-found-illustration');
		illustrationComponent.setAttribute('description', description);
		illustrationComponent.setAttribute('src', illustrationImage);
		illustrationComponent.setAttribute('view', view);
	} else {
		illustrationComponent.setAttribute('title', title);
		illustrationComponent.setAttribute('message', message);
		illustrationComponent.setAttribute('description', description);
		illustrationComponent.setAttribute('view', view);
		illustrationComponent.setAttribute('url', redirectUrl);
		illustrationComponent.setAttribute('src', illustrationImage);
	}

	return illustrationComponent;
}

function showIllustrationComp(illustrationComp, state) {
	illustrationComp.firstElementChild.style.opacity = '1';
	illustrationComp.firstElementChild.style.display = 'flex';

	if (state == 'nothing-update') {
		illustrationImage.style.width = '40%';
	}
}

export { prepIllustrationComp, showIllustrationComp };
