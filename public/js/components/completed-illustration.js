class CompletedIllustration extends HTMLElement {
	constructor() {
		super();
	}

	get src() {
		return this.getAttribute('src');
	}

	set src(value) {
		this.setAttribute('src', value);
	}

	get successMessage() {
		return this.getAttribute('success-message');
	}

	set successMessage(value) {
		value = value == null ? '' : value;
		this.setAttribute('success-message', value);
	}

	get description() {
		if (this.getAttribute('description') != null) {
			return this.getAttribute('description');
		} else {
			return '';
		}
	}

	set description(value) {
		this.setAttribute('description', value);
	}

	get url() {
		if (this.getAttribute('url') != null) {
			return this.getAttribute('url');
		} else {
			return '';
		}
	}

	set url(value) {
		this.setAttribute('url', value);
	}

	get view() {
		if (this.getAttribute('view') != null) {
			return this.getAttribute('view');
		} else {
			return '';
		}
	}

	set view(value) {
		this.setAttribute('view', value);
	}

	attributeChangeCallback(prop) {
		if (prop != '') this.render();
	}

	static get observedAttributes() {
		const attributes = ['src', 'success-message', 'description', 'view', 'url'];
		return attributes;
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
