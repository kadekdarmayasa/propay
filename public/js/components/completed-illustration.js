class CompletedIllustration extends HTMLElement {
	constructor() {
		super();
	}

	get successMessage() {
		return this.getAttribute('success-message');
	}

	get src() {
		return this.getAttribute('src');
	}

	set successMessage(value) {
		this.setAttribute('success-message', value);
	}

	get description() {
		return this.getAttribute('description');
	}

	set description(value) {
		this.setAttribute('description', value);
	}

	get url() {
		return this.getAttribute('url');
	}

	set url(value) {
		this.setAttribute('url', value);
	}

	get view() {
		return this.getAttribute('view');
	}

	set view(value) {
		this.setAttribute('view', value);
	}

	attributeChangedCallback(prop, _, newVal) {
		this[prop] = newVal;
		this.render();
	}

	static get observedAttributes() {
		return ['success-message', 'description', 'view', 'url'];
	}
	connectedCallback() {
		this.render();
	}

	render() {
		this.innerHTML = /*html*/ `
			<div class="completed-illustration">
				<div class="illustration-header">
					<h1>Congratulations</h1>
					<p>${this.successMessage}</p>
				</div>

				<img src="${this.src}" alt="Completed Illustration" class="illustration-image" />

				<div class="illustration-footer">
					<p>${this.description}</p>
					<a href="${this.url}">See list of ${this.view}</a>
				</div>
			</div>
		`;
	}
}

customElements.define('completed-illustration', CompletedIllustration);
