class Payment {
  constructor(url) {
    this.url = url;
  }

  async process(data) {
    const response = await fetch(this.url, {
      method: 'POST',
      mode: 'no-cors',
      credentials: 'same-origin',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify(data),
    });

    return response.json();
  }
}

export default Payment;