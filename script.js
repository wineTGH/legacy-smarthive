let ADDRES = 'hive/get_data.php';
const tempProgress = document.querySelector('#tempProgress');

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

async function get_data() {
    let get = get_param();
    if (get["active"] != "0") {
        ADDRES += "?active=" + get["active"];
    } else {
        ADDRES += "?active=0"
    }
    let response = await fetch(ADDRES);
    let content = await response.json();
    console.log(content);
    ADDRES = '/hive/get_data.php';
    
 }

// Тестовая функция
// setInterval(change_temp, 1000);
let i = 15;
function change_temp() {
    tempProgress.style = 'width:' + String(i) + '%;';
    document.getElementById('tempProgress').innerHTML = i;
}

function log_out() {
    let con = confirm('Вы уверенны, что хотите выйти?');
    if (con) {
        window.location.href = '/auth/logout.php';
    }
}
