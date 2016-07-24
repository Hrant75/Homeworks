function categoryName(){
    var element = document.getElementById('addCategory');
    var str = element.value;
    if(!validateCategoryName(str)){
        element.style.border = "3px solid red";
        document.getElementsByClassName('categoryNameAlert')[0].style.display = 'block';
        setAddButtonDisabled();
        return false;
    }
    document.getElementsByClassName('categoryNameAlert')[0].style.display = 'none';
    element.style.border = '1px solid #ccc';
    setAddButtonEnabled();
    return true;
}

function validateCategoryName(name) {
    var re = /^[-a-zA-Z0-9\s\)\(+=._~]{2,20}$/;
    if( re.test(name) ){
        return true;
    }
}

function authorName(){
    var element = document.getElementById('addAuthor');
    var str = element.value;
    if(!validateAuthorName(str)){
        element.style.border = "3px solid red";
        document.getElementsByClassName('authorNameAlert')[0].style.display = 'block';
        setAddButtonDisabled();
        return false;
    }
    document.getElementsByClassName('authorNameAlert')[0].style.display = 'none';
    element.style.border = '1px solid #ccc';
    setAddButtonEnabled();
    return true;
}

function validateAuthorName(name) {
    var re = /^[-a-zA-Z0-9\s\)\(+=._~]{2,50}$/;
    if( re.test(name) ){
        return true;
    }
}


function checkTitle(){
    var element = document.getElementById('addTitle');
    var str = element.value;
    if(!validateTitle(str)){
        element.style.border = "3px solid red";
        document.getElementsByClassName('titleAlert')[0].style.display = 'block';
        setAddButtonDisabled();
        return false;
    }
    document.getElementsByClassName('titleAlert')[0].style.display = 'none';
    element.style.border = '1px solid #ccc';
    setAddButtonEnabled();
    return true;
}

function validateTitle(name) {
    var re = /^[-a-zA-Z0-9\s\)\(+=._~?;,]{3,200}$/;
    if( re.test(name) ){
        return true;
    }
}


function checkLast(){
    var element = document.getElementById('addLast');
    var str = element.value;
    if(!validateLast(str)){
        element.style.border = "3px solid red";
        document.getElementsByClassName('lastAlert')[0].style.display = 'block';
        setAddButtonDisabled();
        return false;
    }
    document.getElementsByClassName('lastAlert')[0].style.display = 'none';
    element.style.border = '1px solid #ccc';
    setAddButtonEnabled();
    return true;
}

function checkEmail(){
    var element = document.getElementById('addEmail');
    var str = element.value;
    if(!validateEmail(str)){
        element.style.border = "3px solid red";
        document.getElementsByClassName('emailAlert')[0].style.display = 'block';
        setAddButtonDisabled();
        return false;
    }
    document.getElementsByClassName('emailAlert')[0].style.display = 'none';
    element.style.border = '1px solid #ccc';
    setAddButtonEnabled();
    return true;
}

function checkURL(){
    var element = document.getElementById('addGit');
    var str = element.value;
    if(!validateURL(str)){
        element.style.border = "3px solid red";
        document.getElementsByClassName('urlAlert')[0].style.display = 'block';
        setAddButtonDisabled();
        return false;
    }
    document.getElementsByClassName('urlAlert')[0].style.display = 'none';
    element.style.border = '1px solid #ccc';
    setAddButtonEnabled();
    return true;
}

function checkPhone(){
    var element = document.getElementById('addPhone');
    var str = element.value;
    if(!validatePhone(str)){
        element.style.border = "3px solid red";
        document.getElementsByClassName('phoneAlert')[0].style.display = 'block';
        setAddButtonDisabled();
        return false;
    }
    document.getElementsByClassName('phoneAlert')[0].style.display = 'none';
    element.style.border = '1px solid #ccc';
    setAddButtonEnabled();
    return true;
}


function setAddButtonDisabled(){
    document.getElementById('addButton').disabled = true;
}

function setAddButtonEnabled(){
    document.getElementById('addButton').disabled = false;
}

function validateLast(last) {
    var re = /^[A-Z][a-z]{1,40}$/;
    if( re.test(last) ){
        return true;
    }
}
function validateEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,7}))$/;
    if( re.test(email) ){
        return true;
    }
}
function validateURL(url) {
    var re = /(http(s)?:\/\/.)?(www\.)?[-a-zA-Z0-9@:%._\+~#=]{2,256}\.[a-z]{2,6}\b([-a-zA-Z0-9@:%_\+.~#?&//=]*)/g;
    if( re.test(url) ){
        return true;
    }
}
function validatePhone(phone) {
    var re = /^\(?0([0-9]{2})\)?[-. ]?([0-9]{6})$/;
    if( re.test(phone) ){
        return true;
    }
}
