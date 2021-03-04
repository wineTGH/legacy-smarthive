let ADDRES = 'hive/get_data.php';
const tempProgress = document.querySelector('#tempProgress');
const humProgress = document.querySelector('#humProgress');
const weightProgress = document.querySelector('#weightProgress');
const energyProgress = document.querySelector('#energyProgress');



// Данные графика температуры
let temp = document.getElementById('tempChart').getContext('2d');
let tempChart = new Chart(temp, {
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
let hum = document.getElementById('humChart').getContext('2d');
let humChart = new Chart(hum, {
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
    
    console.log(ADDRES);
    
    if (content.status == 0) {
        change_values(content['temp' + active], content['hum' + active], content['weight' + active], content['energy' + active]);
    }
    
 }

// Тестовая функция
// setInterval(change_temp, 1000);
let i = 15;
function change_values(temperature, humidity, weight, energy) {
    console.log(temperature, humidity, weight, energy);

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
