function is_turn(){
    var x = document.getElementById("turn").value;
    if(x == 1){
        return true;
    }
    alert("Wait your turn!");
    return false;
}