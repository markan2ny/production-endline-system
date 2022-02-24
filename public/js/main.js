
function clock(){
    var hour = document.getElementById('hour');
    var minutes = document.getElementById('minutes');
    var seconds = document.getElementById('seconds');

    var now = new Date();
    
    var h = now.getHours();
    var m = now.getMinutes();
    var s = now.getSeconds();

    hour.innerHTML = h + ' :';
    minutes.innerHTML = m + ' :';
    seconds.innerHTML = s;
}

var interval = setInterval(clock, 1000);