let arr = {
    text: 32
};

document.getElementById('text').innerHTML = JSON.stringify(arr);
console.log(typeof(arr));

function set_cookies() {
    Cookies.set('site_data', '{"test": "Hello!"}');
    document.getElementById('text').innerHTML = Cookies.get('site_data');
}