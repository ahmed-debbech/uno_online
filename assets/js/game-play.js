
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
                         
function getColor(text){
    var x ='';
    switch(text[text.length-1]){
        case 'r': 
            x='r'
            break;
            case 'y': 
            x='y'
            break;
            case 'b': 
            x='b'
            break;
            case 'g': 
            x='g'
            break;
    }
    return x;
}
function is_correct_card(){
    var cardTable = document.getElementById("carot").textContent;
    var cardPressed = document.getElementById("content_card").value;
    var numTable= "";
    var numPressed = "";
    var colorPressed = "";
    var colorTable = getColor(cardTable);
    if(colorTable == ''){
        var v = document.getElementById("indicator").innerHTML;
        switch(v){
            case "Red": colorTable = 'r'; break;
            case "Yellow": colorTable = 'y'; break;
            case "Green": colorTable = 'g'; break;
            case "Blue": colorTable = 'b'; break;
        }
    }
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
                if(colorPressed == colorTable){
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
