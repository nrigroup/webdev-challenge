export const fetchData = (parsedCsvToJson) => {
  fetch('http://localhost:3001/api/storecsv', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
    },
    body: JSON.stringify({
      data: parsedCsvToJson,
    }),
  })
    .then((response) => response.json())
    .then((data) => console.log(data))
    .catch((error) => console.error(error))
}
