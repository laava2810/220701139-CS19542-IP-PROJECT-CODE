// Fetch bus data from JSON file
fetch('busData.json')
    .then(response => response.json())
    .then(data => {
        busData = data;  // Store data in a variable for filtering
        console.log(busData);  // Verify data has been loaded
    })
    .catch(error => console.log('Error loading bus data:', error));
