import '../components/illustration.js';
let illustrationComponent = document.querySelector('illustration-element');

function prepIllustrationComp({ title = '', message = '', description = '', view = '', redirectUrl = '', illustrationImage = '', state = '' }) {
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

	const appliedStyle = {
		error: 'height: 300px; width: 300px',
		'nothing-update': 'height: 300px; width: 300px',
		success: 'height: 400px; width: 400px'
	};

	illustrationComponent.setAttribute('style', appliedStyle[state]);

	return illustrationComponent;
}

function showIllustrationComp(illustrationComp) {
	illustrationComp.firstElementChild.style.opacity = '1';
	illustrationComp.firstElementChild.style.display = 'flex';
}

export { prepIllustrationComp, showIllustrationComp };
