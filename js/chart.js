const ADDRES = 'http://localhost/php/get_data.php'

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
      let response = await fetch(ADDRES);
      let content = await response.json();

      document.getElementById("ajax_data").innerHTML = content.data;
 }
