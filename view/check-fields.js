function checkCreate(){
    if(checkName() == true){
        return true;
    }
    return false;
}

function checkJoin(){
    if(checkRoomCode() == true&&
    checkName() == true){
        location.href = "../core/game-play.php";
    }
}
function checkRoomCode(){
    let r = document.getElementById("roomnum").value;
    if(r == ""){
        alert("You must insert a room code");
        return false;
    }else{
        if(r.length < 5 || r.length > 5){
            alert("Your code must consist of 4 numbers");
            return false;
        }else{
            if(r[4]<="9" && r[4]>="0"){
                alert("Room codes should finish with 'r' letter");
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