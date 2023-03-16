class Overlay extends HTMLElement {
	constructor() {
		super();
	}

	get deleteMessage() {
		return this.getAttribute('delete-message');
	}

	set deleteMessage(message) {
		this.setAttribute('delete-message', message);
	}

	get url() {
		return this.getAttribute('href');
	}

	set url(value) {
		this.setAttribute('href', value);
	}

	get stateProp() {
		return this.getAttribute('state');
	}
	set stateProp(state) {
		this.setAttribute('state', state);
	}

	attributeChangedCallback(prop, _, newVal) {
		this[prop] = newVal;
		this.render();
	}

	static get observedAttributes() {
		return ['class', 'delete-message', 'href', 'state'];
	}

	connectedCallback() {
		this.render();
	}

	render() {
		this.innerHTML = /* html */ `
    <div class="overlay">
      <div class="container">
        <div class="icon">
        </div>
        <div class="meta">
          <h2 class="title">Are you sure?</h2>
          <p class="description">This data will permanently deleted</p>
        </div>
        <div class="action-button">
          <a href="" id="overlay-cancel-btn" class="cancel-class-btn">
            No, thanks!
          </a>
          <a href="${this.url}" id="overlay-delete-btn" class="delete-class-btn">
            Yes, sure!
          </a>
        </div>
      </div>
    </div>
    `;
	}
}

customElements.define('over-lay', Overlay);
