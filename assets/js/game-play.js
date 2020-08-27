
function is_with_hiphen(x){
    var i=0;
    do{
        if(x[i] == '-'){
            return true;
        }
        i++;
    }while(x.length > i);
    return false;
}
function selectColor(color){
    switch(color){
        case "rgb(255, 71, 71)": return 'r'; break;
        case "rgb(111, 199, 99)": return 'g'; break;
        case "rgb(84, 150, 255)": return 'b'; break;
        case "rgb(237, 220, 28)": return 'y'; break;
        default: return "grey"; break;
    }
}
function is_correct_card(){
    var cardTable = document.getElementById("cardOnTable").textContent;
    var cardPressed = document.getElementById("content_card").value;
    var numTable= "";
    var numPressed = "";
    var colorPressed = "";
    var col = document.getElementById("cardOnTable").style.backgroundColor;
    var colorTable = selectColor(col);
    var isCardOnTableWithHiphen = is_with_hiphen(cardTable); //with '-'
    var isCardPressedWithHiphen  = is_with_hiphen(cardPressed); //with'-'
    var i=0;
    if(isCardOnTableWithHiphen == true){
        i=0;
        do{
            numTable = numTable + cardTable[i];
            i++;
        }while(cardTable[i] != "-");
    }else{
        numTable = cardTable;
    }
    if(isCardPressedWithHiphen == true){
        i=0;
        do{
            numPressed = numPressed + cardPressed[i];
            i++;
        }while(cardPressed[i] != "-");
        i++;
        colorPressed = cardPressed[i];
    }else{
        numPressed = cardPressed;
    }
    if(isCardPressedWithHiphen == true &&  isCardOnTableWithHiphen == true){
        if((numPressed == numTable) || (colorPressed == colorTable)){
            return true;
        }
    }else{
        if(isCardPressedWithHiphen == false){
            return true;
        }else{
            if(isCardOnTableWithHiphen == false){
                if(colorPressed == colorTable || colorTable == "grey"){
                    return true;
                }
            }
        }
    }
    return false;
}
function is_turn(){
    var x = document.getElementById("turn").value;
    if(x == 1){
        var val = document.getElementById('content_card').value;
        if(val == "+4" || val == "wc"){
            document.getElementById("con").value = val;
            return false;
        }
        if(is_correct_card() == true){
            return true;
        }else{
            alert("Oops! Wrong card.");
            return false;
        }
    }
    alert("Wait your turn!");
    return false;
}
function setCont(x){
    document.getElementById("content_card").value = x;
}

//updater for card on table
function updateTable(){
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        var arr =  JSON.parse(this.responseText)
        $("#cardOnTable").html(arr[0].cardOnTable);
        $("#cardOnTable").attr("background-color", arr[0].color);
    }
    };
    xmlhttp.open("GET", "core/game/ajax/update_table.php?room-code="+document.getElementById("rc").value, true);
    xmlhttp.send();
}

//caller for updaters
$(document).ready(function(){
    setInterval(() => {
        updateTable();
    }, 1000);
})