//updater for card on table
function updateTable(){
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        var arr =  JSON.parse(this.responseText)
        $("#cardOnTable").html(arr[0].cardOnTable);
        $("#cardOnTable").css("background-color", arr[0].color);
    }
    };
    xmlhttp.open("GET", "core/game/ajax/update_table.php?room-code="+document.getElementById("rc").value, true);
    xmlhttp.send();
}

//updater for status
function updateStatus(){
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        if(this.responseText == 1){
            $("#stat").attr("hidden",true);
            $("#stat-2").attr("hidden",true);
        }else{
            $("#stat").attr("hidden",false);
            $("#stat-2").attr("hidden",false);
        }
    }
    };
    xmlhttp.open("GET", "core/game/ajax/update_status.php?room-code="+document.getElementById("rc").value, true);
    xmlhttp.send();
}

//caller for updaters
$(document).ready(function(){
    setInterval(() => {
        updateTable();
        updateStatus();
    }, 500);
})