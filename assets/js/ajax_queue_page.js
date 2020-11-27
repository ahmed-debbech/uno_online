function updateStart(){
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var arr =  JSON.parse(this.responseText)
            if(arr[0].start == "1"){
                location.href = "game-play.php?room-code="+document.getElementById("roomC").value+"&player-id="+document.getElementById("playerI").value;
            }
        }
    };
    xmlhttp.open("GET", "core/check-started.php?room-code="+document.getElementById("roomC").value+"&player-id="+document.getElementById("playerI").value, true);
    xmlhttp.send();
}

//caller for updaters
$(document).ready(function(){
    setInterval(() => {
        updateStart();
    }, 500);
})