class Database {
  constructor(url) {
    this.url = url;
  }

  async update(data) {
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

  async delete() {
    const response = await fetch(this.url, {
      mode: 'no-cors',
      credentials: 'same-origin',
      headers: {
        'Content-Type': 'application/json',
      },
    });

    return response.json();
  }

  async insert(data) {
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

export default Database;