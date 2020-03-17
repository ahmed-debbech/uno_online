function checkJoin(){
    checkRoomCode();
    checkName();
}
function checkRoomCode(){
    let r = document.getElementById("roomnum").value;
    if(r == ""){
        alert("You must insert a room code");
    }else{
        if(r.match(/^[A-Z]+$/i) == true){
            alert("Your code must be only numbers");
        }else{
            if(r.length < 4 || r.length > 4){
                alert("Your code must consist of 4 numbers");
            }
        }
    }
}
function checkName(){
    let r = document.getElementById("player-name").value;
    if(r == ""){
        alert("You must write your name!");
    }
}