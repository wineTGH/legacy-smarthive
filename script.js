let ADDRES = 'hive/get_data.php';

const tempProgress = document.querySelector('#tempProgress');
const humProgress = document.querySelector('#humProgress');
const weightProgress = document.querySelector('#weightProgress');
const energyProgress = document.querySelector('#energyProgress');

let old_time = "12:00";

// Данные графика температуры
let temp = document.getElementById('tempChart').getContext('2d');
let temp_config = {
    type: 'line',

    data: {
     //labels: ['10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00'],
     datasets: [{
         //data: [26, 24, 27, 30, 26, 23, 25],
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

};
let tempChart = new Chart(temp, temp_config);

// Данные графика влажности
let hum = document.getElementById('humChart').getContext('2d');
let hum_config =  {
    type: 'line',

    data: {
     //labels: ['10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00'],
     datasets: [{
         //data: [12, 19, 3, 5, 2, 3, 7],
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
};
let humChart = new Chart(hum, hum_config);

setInterval(get_data, 1000);

// возвращает все GET параметры ввиде массива
function get_param() {
    var a = window.location.search;
    var b = new Object();
    a = a.substring(1).split("&");
    for (var i = 0; i < a.length; i++) {
  	c = a[i].split("=");
        b[c[0]] = c[1];
    }
    return b;
};

async function get_data() {
    
    ADDRES = '/hive/get_data.php';
    
    let get = get_param();
    let active = get["active"];
    
    if (active && active != "0") {
        ADDRES += "?active=" + active;
    } else {
        ADDRES += "?active=0";
        active = "0";
    }

    let response = await fetch(ADDRES);
    let content = await response.json();
    
    //console.log(content);
    
    if (content.status == 0) {
        change_values(content['temp' + active], content['hum' + active], content['weight' + active], content['energy' + active], content['time']);
        update_chart(content['time']);
    }
    
 }


function change_values(temperature, humidity, weight, energy, time) {
    tempProgress.style = 'width:' + String(temperature) + '%;';
    document.getElementById('tempProgress').innerHTML = temperature;

    humProgress.style = 'width:' + String(humidity) + '%;';
    document.getElementById('humProgress').innerHTML = humidity;

    weightProgress.style = 'width:' + String(weight) + '%;';
    document.getElementById('weightProgress').innerHTML = weight;

    energyProgress.style = 'width:' + String(energy) + '%;';
    document.getElementById('energyProgress').innerHTML = energy;
}

function log_out() {
    let con = confirm('Вы уверенны, что хотите выйти?');
    if (con) {
        window.location.href = '/auth/logout.php';
    }
}

function update_chart(time = '0:00') { //TODO: Закементированть эту функцию
    if (time != old_time) {
        hum_config.data.labels.push(time);
        hum_config.data.datasets.forEach(function(dataset) { dataset.data.push(humidity); });
        humChart.update();

        temp_config.data.labels.push(time);
        temp_config.data.datasets.forEach(function(dataset) { dataset.data.push(temperature); });
        tempChart.update();

        old_time = time;
    }
}
