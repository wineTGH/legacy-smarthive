const ADDRES = window.location.href + 'hive/get_data.php';

// Vertical bar chart
var ctx = document.getElementById('myChart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'line',

    data: {
     labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
     datasets: [{
         label: '# of Votes',
         data: [12, 19, 3, 5, 2, 3]
    }]
}
});

setInterval(getData, 60000);

async function getData() {
    console.log(window.location.href);
    let response = await fetch(ADDRES);
    let content = await response.json();

    document.getElementById("temp").innerHTML = content.data;
 }
