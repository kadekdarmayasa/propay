const timeContainer = document.getElementById('time');
const hourContainer = document.getElementById('hour');
const minuteContainer = document.getElementById('minute');
const dateContainer = document.querySelector('.date');

const time = new Date();
const days = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
const months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

showTime();
dateContainer.innerHTML = `${days[time.getDay()]}, ${time.getDate()} ${months[time.getMonth()]} ${time.getFullYear()}`;
setInterval(showTime, 1000);

function showTime() {
	let hour = new Date().getHours();
	let minute = new Date().getMinutes();

	if (hour < 10) {
		hour = '0' + hour;
	}

	if (minute < 10) {
		minute = '0' + minute;
	}

	hourContainer.innerHTML = hour;
	minuteContainer.innerHTML = minute;
}
