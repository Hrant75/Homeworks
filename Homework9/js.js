
var cardType=0;
var cards  = [
    [1, 'AmericanExpress', 'ae.jpg'],
    [2, 'DinersClub', 'dc.jpg'],
    [3, 'Discover', 'd.jpg'],
    [4, 'enRoute', 'e.jpg'],
    [5, 'JCB', 'jcb.jpg'],
    [6, 'MasterCard', 'mc.jpg'],
    [7, 'Visa', 'visa.jpg']
];

function cardCheck(){
    var inputElement = document.getElementById('cardNumberInput');
    var value = inputElement.value;
    cardType = 0;

    value = value.replace(/[^0-9.]/g, "");  //grel miayn tver

    if(value.length > 16) {                 // 16ic shat chpetq a lini
        value=value.slice(0,value.length-1);
    }
    inputElement.value = value;

    if(valid_luhn(value) && valid_cc_type(value)){
        console.log(cards[cardType-1][0]+cards[cardType-1][1]+cards[cardType-1][2]);
        document.getElementById('carTypeImage').setAttribute("src", 'img/'+cards[cardType-1][2] );
        document.getElementById('validOrNotText').innerHTML = 'valid';
        document.getElementById('cardTypeText').innerHTML = cards[cardType-1][1];
        document.getElementById('frontSide').style.backgroundColor='#e0e0e0';
        document.getElementById('backSide').style.backgroundColor='#e0e0e0';

    } else{
        document.getElementById('validOrNotText').innerHTML = 'not valid';
        document.getElementById('carTypeImage').setAttribute("src", 'img/nocard.jpg' );
        document.getElementById('cardTypeText').innerHTML = 'not defined';
        document.getElementById('frontSide').style.backgroundColor='black';
        document.getElementById('backSide').style.backgroundColor='black';
    }
}

function valid_cc_type(type){    //voroshum enq cardi tipy
    var cc = type.toString();

    if(cc.length < 13 || cc.length > 16) {
        return false;
    }
    if (cc[0]==3 && (cc[1]==4 || cc[1]==7 ) && cc.length==15){
        cardType = 1; console.log('AmericanExpress');
        return true;
    }
    if (cc[0]==3 && (cc[1]==0 || cc[1]==6 || cc[1]==8 )  && cc.length==14){
        cardType = 2; console.log('DinersClub');
        return true;
    }
    if ( ( (parseInt(cc.substr(0,8)) >= 60110000 && parseInt(cc.substr(0,8)) <= 60119999 ) ||
        (parseInt(cc.substr(0,8)) >= 65000000 && parseInt(cc.substr(0,8)) <= 60119999 ) ||
        (parseInt(cc.substr(0,8)) >= 62212600 && parseInt(cc.substr(0,8)) <= 62292599 ) )
        && cc.length==16){
        cardType = 3; console.log('Discover');
        return true;
    }
    if ( (cc.startsWith('2014') || cc.startsWith('2149') ) && cc.length==15){
        cardType = 4; console.log('enRoute');
        return true;
    }
    if ( (cc.startsWith('3088') || cc.startsWith('3096') || cc.startsWith('3112') || cc.startsWith('3158')
            || cc.startsWith('3337') ||
            ( parseInt(cc.substr(0,8)) >= 35280000 && parseInt(cc.substr(0,8)) <= 35899999 )
        ) && cc.length==16 ){
        cardType = 5; console.log('JCB');
        return true;
    }
//        console.log(parseInt(cc.substr(0,2)) >= 51);
//        console.log(parseInt(cc.substr(0,8)) <= 55);
//        console.log(cc.length==16);
    if(parseInt(cc.substr(0,2)) >= 51 && parseInt(cc.substr(0,2)) <= 55 && cc.length==16 ){
        cardType = 6; console.log('MasterCard');
        return true;
    }
    if(cc[0]==4 && cc.length>=13 &&  cc.length<=16){
        cardType = 7; console.log('Visa');
        return true;
    }


}
function valid_luhn(ccValue) {
    var cc = ccValue.toString();
    var hashvich=true;
    var sum=0;
    for(var i=cc.length-1; i>=0; i--){
        if(hashvich){
            sum+=parseInt(cc[i]);
        }else{
            sum+=luhn(parseInt(cc[i]));
        }
        console.log('hashvich='+hashvich+' i='+i+' sum='+sum);
        hashvich=!hashvich;
    }
    return (sum % 10) == 0;
}

function luhn(num){
    switch (num) {
        case 0: return 0;
        case 1: return 2;
        case 2: return 4;
        case 3: return 6;
        case 4: return 8;
        case 5: return 1;
        case 6: return 3;
        case 7: return 5;
        case 8: return 7;
        case 9: return 9;
    }
}
