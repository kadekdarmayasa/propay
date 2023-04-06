import '../utils/row-selected.js';
import './form-overlay.js';
import { showIllustrationComp, prepIllustrationComp } from '../helpers/illustration.js';

localStorage.removeItem('selected');

const baseUrl = window.location.href.split('payment')[0];
const element = document.querySelector('.student-bills');

if (element) element.scrollIntoView({ behavior: 'smooth' });

const illustration = {
	waitingForSearch: document.getElementById('waiting-for-search-illustration'),
	notFound: document.getElementById('not-found-illustration'),
};

const illustrationProps = {
	waitingForSearch: {
		view: 'waiting-for-search-payment',
		description: 'Waiting for Search',
		illustrationImage: `${baseUrl}public/images/search-illustration.svg`,
	},
	notFound: {
		view: 'not-found-payment',
		description: 'Not Data Student Found',
		illustrationImage: `${baseUrl}public/images/not-found-illustration.svg`,
	},
};

if (illustration.waitingForSearch) {
	showIllustrationComp(prepIllustrationComp(illustrationProps.waitingForSearch));
}

if (illustration.notFound) {
	showIllustrationComp(prepIllustrationComp(illustrationProps.notFound));
}
