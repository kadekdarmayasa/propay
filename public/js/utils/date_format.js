function formatDate(strDate) {
  const months = {
    Jan: '01',
    Feb: '02',
    Mar: '03',
    Apr: '04',
    May: '05',
    Jun: '06',
    Jul: '07',
    Aug: '08',
    Sep: '09',
    Oct: '10',
    Nov: '11',
    Dec: '12',
  };

  const dates = strDate.split(' ');
  const date = dates[0];
  const month = months[dates[1]];
  const year = dates[2];

  return `${year}-${month}-${date}`;
}

export default formatDate;