// Данные графика температуры
var temp = document.getElementById('tempChart').getContext('2d');
var tempChart = new Chart(temp, {
    type: 'line',

    data: {
     labels: ['10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00'],
     datasets: [{
         data: [26, 24, 27, 30, 26, 23, 25],
         backgroundColor: 'rgba(255, 0, 0, 0.2)'
    }]
},

options: {
    legend: {
        display: false
    },
    title: {
        display: true,
        text:"Температура",
        position: "left",
        fontStyle: "bold"
    }
}

});

// Данные графика влажности
var hum = document.getElementById('humChart').getContext('2d');
var humChart = new Chart(hum, {
    type: 'line',

    data: {
     labels: ['10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00'],
     datasets: [{
         data: [12, 19, 3, 5, 2, 3, 7],
         backgroundColor: 'rgba(0, 0, 255, 0.2)'
         
    }]
},

    options: {
        legend: {
            display: false
        },
        title: {
            display: true,
            text:"Влажность",
            position: "left",
            fontStyle: "bold"
        }
    }
});

const ADDRES = window.location.href + 'hive/get_data.php';

setInterval(getData, 60000);

async function getData() {
    console.log(window.location.href);
    let response = await fetch(ADDRES);
    let content = await response.json();
 }
