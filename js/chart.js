const ADDRES = 'http://localhost/php/get_data.php'

setInterval(getData, 60000);

async function getData() {
     let response = await fetch(ADDRES);
     let content = await response.json();

     return content;
}
