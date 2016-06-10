
var positionX = 0;
var positionY = 0;
var matrixContainer = document.getElementById('matrixContainer');
var currentItem;

function drawMatrix(){    //draw MATRIX
    var matrixHTML = '';
    for(var i=0; i<10; i++){
        matrixHTML += '<div class="row">';
        for(var j=0; j<10; j++){
            if(j==0) matrixHTML += '<div class="col-xs-offset-1 col-xs-1"></div>';
            else matrixHTML += '<div class="col-xs-1"></div>';
        }
        matrixHTML += '</div>';
    }
    document.getElementById('matrixContainer').innerHTML = matrixHTML;
    drawRed();
}

var drawRed = function drawRed(){
    currentItem  = matrixContainer.childNodes[positionY].childNodes[positionX];

    currentItem.style.backgroundColor = "red";
    currentItem.style.border = "5px solid black";
    currentItem.classList.add('blink');
}

function clearBorder(){
    currentItem  = matrixContainer.childNodes[positionY].childNodes[positionX];

    currentItem.style.border = "none";
    currentItem.classList.remove('blink');
}

function animation(){
    currentItem  = matrixContainer.childNodes[positionY].childNodes[positionX];

    currentItem.style.transitionDuration = "2s";
    currentItem.style.WebkitTransitionDuration = "2s";
    currentItem.style.filter = "hue-rotate(380deg)";
    currentItem.style.webkitFilter = "hue-rotate(380deg)";
}

function move(event){
    checkMove(event.which);
}

function clicked() {
    checkMove(document.getElementById('myInput').value);
    document.getElementById('myInput').value='';
    document.getElementById('myInput').focus();
}

function checkMove(eventValue) {

    var str;
    if(typeof(eventValue) == 'number'){
        str = [eventValue];
    } else {
        str = eventValue;
    }

    for (var i=0; i<str.length; i++){

        switch ( str[i] ) {
            case 'u': case 'U' : case 38: {  //UP
                    if (positionY == 0  || matrixContainer.childNodes[(positionY-1)].childNodes[positionX].style.backgroundColor == "red" )
                    {
                        ifNoWay();
                    } else {
                        clearBorder();
                        positionY--;
                        drawRed();
                    }
                } break;
            case 'd': case 'D' : case 40:  {  //down
                    if (positionY == 9 || matrixContainer.childNodes[(positionY+1)].childNodes[positionX].style.backgroundColor == "red" )
                    {
                        ifNoWay();
                    } else {
                        clearBorder();
                        positionY++;
                        drawRed();
                    }
                } break;
            case 'r': case 'R' : case 39: {  //Right
                    if (positionX == 9 || matrixContainer.childNodes[positionY].childNodes[positionX+1].style.backgroundColor == "red" )
                    {
                        ifNoWay();
                    } else {
                        clearBorder();
                        positionX++;
                        drawRed();
                    }
                } break;
            case 'l': case 'L' : case 37: {  //left
                if (positionX == 0 || matrixContainer.childNodes[positionY].childNodes[positionX-1].style.backgroundColor == "red" )
                {
                    ifNoWay();
                } else {
                    clearBorder();
                    positionX--;
                    drawRed();
                }
            } break;
        }  //end of switch
    }  //end of for
}

function ifNoWay(){
    if (
        (positionY == 0  || matrixContainer.childNodes[(positionY-1)].childNodes[positionX].style.backgroundColor == "red" )
        &&
        (positionY == 9 || matrixContainer.childNodes[(positionY+1)].childNodes[positionX].style.backgroundColor == "red" )
        &&
        (positionX == 9 || matrixContainer.childNodes[positionY].childNodes[positionX+1].style.backgroundColor == "red" )
        &&
        (positionX == 0 || matrixContainer.childNodes[positionY].childNodes[positionX-1].style.backgroundColor == "red" )
    ){
        alert("No Way, Sorry !!!");
        reloadpage();
    }
    else{
        animation();
    }
}

function reloadpage() {
    location.reload();
}