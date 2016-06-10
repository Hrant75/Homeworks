
var celsiusElement=document.getElementById("celsiusInput");
var fahrenheitElement=document.getElementById("fahrenheitInput");
var lenghtFirstInp=document.getElementById("lenghtFirstInput");
var lenghtSecondInp=document.getElementById("lenghtSecondInput");

var celsiusValue;
var farValue;

var celsiusProg = document.getElementById("celsiusProgress");
var fahrenheitProg = document.getElementById("fahrenheitProgress");

function clearValues(){
    celsiusElement.value="";
    fahrenheitElement.value="";
    lenghtFirstInp.value="";
    lenghtSecondInp.value="";
}
function clearClasses(){
    celsiusProg.classList.remove("progress-bar-danger");
    fahrenheitProg.classList.remove("progress-bar-danger");
    celsiusProg.classList.remove("progress-bar-warning");
    fahrenheitProg.classList.remove("progress-bar-warning");
    celsiusProg.classList.remove("progress-bar-info");
    fahrenheitProg.classList.remove("progress-bar-info");
}
function calculate(){
    celsiusValue = celsiusElement.value;
    farValue = fahrenheitElement.value;
    if (celsiusElement.value!=""){
        farValue=Math.round(celsiusValue*9/5+32);
    } else if (fahrenheitElement.value!=""){
        celsiusValue=Math.round((farValue-32)*5/9);
    }
    celsiusProg.style="width:"+celsiusValue+"%";
    fahrenheitProg.style="width:"+farValue/2.12+"%";
    document.getElementById("celsiusText").innerHTML=celsiusValue+"&deg;C";
    document.getElementById("fahrenheitText").innerHTML=farValue+"&deg;F";
    celsiusElement.value=celsiusValue;
    fahrenheitElement.value=farValue;

    if (celsiusValue<20){
        clearClasses();
        celsiusProg.classList.add("progress-bar-info");
        fahrenheitProg.classList.add("progress-bar-info");
    } else if(celsiusValue<30){
        clearClasses();
        celsiusProg.classList.add("progress-bar-warning");
        fahrenheitProg.classList.add("progress-bar-warning");
    } else{
        clearClasses();
        celsiusProg.classList.add("progress-bar-danger");
        fahrenheitProg.classList.add("progress-bar-danger");
    }
}

function calculateLenght() {
    var firstSelValue = document.getElementById("lenghtFirstSelect").value;
    var secondSelValue = document.getElementById("lenghtSecondSelect").value;
    var firstInpValue = document.getElementById("lenghtFirstInput").value;
    var secondInputElement = document.getElementById("lenghtSecondInput");
    var bzik=1;
    console.log(firstSelValue+" "+secondSelValue);
    if (firstSelValue=="mm"){
        console.log("mm");
        switch(secondSelValue) {
            case "mm": bzik=1; break;
            case "cm": bzik=0.1; break;
            case "m": bzik=0.001; break;
            case "km": bzik=0.000001; break;
            case "feet": bzik=0.0032808399; break;
            case "inch": bzik=0.0393707; break;
            case "mile": bzik=0.00000062; break;
            case "yard": bzik=.001094; break;
        }
        console.log("mm");
    } else if (firstSelValue=="cm"){
        console.log("cm");
        switch(secondSelValue) {
            case "mm": bzik=10; break;
            case "cm": bzik=1; break;
            case "m": bzik=0.01; break;
            case "km": bzik=0.00001; break;
            case "feet": bzik=0.032808399; break;
            case "inch": bzik=0.393707; break;
            case "mile": bzik=0.0000062; break;
            case "yard": bzik=.01094; break;
        }
        console.log("cm");
    } else if (firstSelValue=="m"){
        console.log("m");
        switch(secondSelValue) {
            case "mm": bzik=1000; break;
            case "cm": bzik=100; break;
            case "m": bzik=1; break;
            case "km": bzik=0.001; break;
            case "feet": bzik=3.2808399; break;
            case "inch": bzik=39.3707; break;
            case "mile": bzik=0.00062; break;
            case "yard": bzik=1.094; break;
        }
        console.log("m");
    } else if (firstSelValue=="km"){
        console.log("km");
        switch(secondSelValue) {
            case "mm": bzik=1000000; break;
            case "cm": bzik=100000; break;
            case "m": bzik=1000; break;
            case "km": bzik=1; break;
            case "feet": bzik=3280.8399; break;
            case "inch": bzik=39370.7; break;
            case "mile": bzik=0.62; break;
            case "yard": bzik=1094; break;
        }
        console.log("km");
    } else if (firstSelValue=="feet"){
        console.log("feet");
        switch(secondSelValue) {
            case "mm": bzik=304.79999953670; break;
            case "cm": bzik=30.479999953670; break;
            case "m": bzik=0.30479999953670; break;
            case "km": bzik=0.0003047999995; break;
            case "feet": bzik=1; break;
            case "inch": bzik=12.000189341759; break;
            case "mile": bzik=0.0001889759997; break;
            case "yard": bzik=0.3334511994931; break;
        }
        console.log("feet");
    } else if (firstSelValue=="inch"){
        console.log("inch");
        switch(secondSelValue) {
            case "mm": bzik=25.399599194324; break;
            case "cm": bzik=2.5399599194324; break;
            case "m": bzik=0.025399599194324; break;
            case "km": bzik=0.000025399599194324; break;
            case "feet": bzik=0.0833320184807; break;
            case "inch": bzik=1; break;
            case "mile": bzik=0.0000157477515; break;
            case "yard": bzik=0.0277871615185; break;
        }
        console.log("inch");
    } else if (firstSelValue=="mile"){
        console.log("mile");
        switch(secondSelValue) {
            case "mm": bzik=1612903.2258064; break;
            case "cm": bzik=161290.32258064; break;
            case "m": bzik=1612.9032258064; break;
            case "km": bzik=1.6129032258064; break;
            case "feet": bzik=5291.6772580645; break;
            case "inch": bzik=63501.129032258; break;
            case "mile": bzik=1; break;
            case "yard": bzik=1764.5161290322; break;
        }
        console.log("mile");
    } else if (firstSelValue=="yard"){
        console.log("yard");
        switch(secondSelValue) {
            case "mm": bzik=914.07678244972; break;
            case "cm": bzik=91.407678244972; break;
            case "m": bzik=0.91407678244972; break;
            case "km": bzik=0.00091407678244972; break;
            case "feet": bzik=2.9989395795246; break;
            case "inch": bzik=35.987842778793; break;
            case "mile": bzik=0.0005667276051; break;
            case "yard": bzik=1; break;
        }
        console.log("yard");
    }
    secondInputElement.value=firstInpValue*bzik;
}