/**add new user function */
function newUsers(){
    /**url to send to */
    let url = "newUser.php?";
    /**creating variables with values from the form */
    let un = "un=" + document.getElementById("un").value + "&";
    let pw = "pw=" + document.getElementById("pw").value + "&";
    let em = "em=" + document.getElementById("em").value + "&";
    let fn = "fn=" + document.getElementById("fn").value + "&";
    let ln = "ln=" + document.getElementById("ln").value;
    /**concatinating to 'url' */
    url += un + pw + em + fn + ln;
    /**send to httpGetAsync() */
    httpGetAsync(url, "check");    
}

/**send message function */
function sendMessage(){
    /**url to send to */
    let url = "newMessage.php?";
    /**creating variables with values from the form */
    let to = "to=" + document.getElementById("to").value + "&";
    let fm = "fm=" + document.getElementById("fm").value + "&";
    let at = "ta=" + document.getElementById("ta").value;
    /**concatinating to 'url' */
    url += to + fm + at;
    /**send to httpGetAsync() */
    httpGetAsync(url, "send"); 

}

/**messages to function */
function searchMessageTo(){
 /**url to send to */
    let url = "searchMessage.php?";
    /**creating variables with values from the form */
    let st = "st=" + document.getElementById("st").value + "&";
    /**lets the php know if we want to user or from user to show first */
    let type = "type=to";
    /**concatinating to 'url' */
    url += st + type;
    /**send to httpGetAsync() */
    httpGetAsync(url, "report"); 
}

/**messages from function */
function searchMessageFrom(){
    /**url to send to */
    let url = "searchMessage.php?";
    /**creating variables with values from the form */
    let st = "st=" + document.getElementById("sf").value + "&";
    /**lets the php know if we want to user or from user to show first */
    let type = "type=from";
    /**concatinating to 'url' */
    url += st + type;
    /**send to httpGetAsync() */
    httpGetAsync(url, "report"); 
}

/**asyc function */
function httpGetAsync(theUrl, id) {
    let xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange = function() { 
        if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
	    let divvyDiv = document.getElementById( id );	
        divvyDiv.innerHTML = xmlHttp.responseText;
        }
    }
    xmlHttp.open("GET", theUrl, true); 	
    xmlHttp.send(null);
}