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
function is_correct_card(){
    var cardTable = document.getElementById("cardOnTable").textContent;
    var cardPressed = document.getElementById("content_card").value;
    var numTable= "";
    var colorTable = "";
    var numPressed = "";
    var colorPressed = "";
    var isCardOnTableWithHiphen = is_with_hiphen(cardTable); //with '-'
    var isCardPressedWithHiphen  = is_with_hiphen(cardPressed); //with'-'
    var i=0;
    if(isCardOnTableWithHiphen == true){
        i=0;
        do{
            numTable = numTable + cardTable[i];
            i++;
        }while(cardTable[i] != "-");
        i++;
        colorTable = cardTable[i];
    }else{
        i=0;
        do{
            numTable = numTable + cardTable[i];
            i++;
        }while(cardTable[i] < cardTable.length);
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
        i=0;
        do{
            numPressed = numPressed + cardPressed[i];
            i++;
        }while(cardPressed[i] < cardPressed.length);
    }
    if(isCardPressedWithHiphen == true &&  isCardPressedWithHiphen == true){
        if((numPressed == numTable) || (colorPressed == colorTable)){
            return true;
        }
    }   
    return false;
}
function is_turn(){
    var x = document.getElementById("turn").value;
    if(x == 1){
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
