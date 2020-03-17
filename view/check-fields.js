function checkCreate(){
    if(checkName() == true){
        location.href = "game-play.html";
    }
}

function checkJoin(){
    if(checkRoomCode() == true&&
    checkName() == true){
        location.href = "game-play.html";
    }
}
function checkRoomCode(){
    let r = document.getElementById("roomnum").value;
    if(r == ""){
        alert("You must insert a room code");
        return false;
    }else{
        if(r.match(/^[A-Z]+$/i) == true){
            alert("Your code must be only numbers");
            return false;
        }else{
            if(r.length < 4 || r.length > 4){
                alert("Your code must consist of 4 numbers");
                return false;
            }
        }
    }
    return true;
}
function checkName(){
    let r = document.getElementById("player-name").value;
    if(r == ""){
        alert("You must write your name!");
        return false;
    }
    return true;
}