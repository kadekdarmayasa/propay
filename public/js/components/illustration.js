class Illustration extends HTMLElement {
	constructor() {
		super();

		this._title = this.getAttribute('title') || '';
		this._message = this.getAttribute('message') || '';
		this._description = this.getAttribute('description') || '';
		this._view = this.getAttribute('view') || '';
		this._url = this.getAttribute('url') || '';
		this._src = this.getAttribute('src') || '';
	}

	get title() {
		return this._title;
	}

	set title(value) {
		this._title = value;
	}

	get message() {
		return this._message;
	}

	set message(value) {
		this._message = value;
	}

	get description() {
		return this._description;
	}

	set description(value) {
		this._description = value;
	}

	get view() {
		return this._view;
	}

	set view(value) {
		this._view = value;
	}

	get url() {
		return this._url;
	}

	set url(value) {
		this._url = value;
	}

	get src() {
		return this._src;
	}

	set src(value) {
		this._src = value;
	}

	connectedCallback() {
		this.render();
	}

	attributeChangedCallback(name, oldValue, newValue) {
		if (oldValue == newValue) return;

		this[name] = newValue;
		this.render();
	}

	static get observedAttributes() {
		return ['title', 'message', 'description', 'view', 'url', 'src'];
	}

	render() {
		this.innerHTML = /*html*/ `
			<div class="illustration">
				<div class="illustration-header">
					<h1>${this.title}</h1>
					<p>${this.message}</p>
				</div>

				<img src="${this.src}" alt="Illustration" class="illustration-image" />

				<div class="illustration-footer">
					<p>${this.description}</p>
					<a href="${this.url}">See list of ${this.view}</a>
				</div>
			</div>
		`;
	}
}

customElements.define('illustration-element', Illustration);
