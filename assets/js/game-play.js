function is_correct_card(){
    var x = document.getElementById("cardOnTable").textContent;
    alert(x);
    //var buttonValue = document.getElementByName("card").value;
    //alert(buttonValue);
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
    alert(document.getElementById("content_card").value);
}