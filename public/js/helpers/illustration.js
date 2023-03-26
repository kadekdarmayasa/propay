import '../components/illustration.js';
const illustrationComponent = document.querySelector('illustration-element');
const illustrationImage = document.querySelector('.illustration-image');

function prepIllustrationComp({ title, message, description, view, redirectUrl, illustrationImage }) {
	illustrationComponent.setAttribute('title', title);
	illustrationComponent.setAttribute('message', message);
	illustrationComponent.setAttribute('description', description);
	illustrationComponent.setAttribute('view', view);
	illustrationComponent.setAttribute('url', redirectUrl);
	illustrationComponent.setAttribute('src', illustrationImage);

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
