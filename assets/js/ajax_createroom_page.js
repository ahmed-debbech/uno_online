function updateTable(){
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            $("#players").empty();
            $("#players").append(this.responseText);
        }
    };
    xmlhttp.open("GET", "core/ajax_create_room.php?room-code="+document.getElementById("roomC").value+"&player-id="+document.getElementById("playerI").value, true);
    xmlhttp.send();
}

//caller for updaters
$(document).ready(function(){
    setInterval(() => {
        updateTable();
    }, 500);
})