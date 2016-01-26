/******************************************************************************************************

    Functie(s) voor eventhandling 
    
******************************************************************************************************/

ie = (document.all) ? true : false;
dom = ((document.getElementById) && (!ie)) ? true : false;
function setEventByID(id, ev, fu) {
    if (dom) {
        document.getElementById(id).addEventListener(ev, fu, false);
    }
    if (ie) {
        document.getElementById(id).attachEvent('on' + ev, fu);
    }
}

/************************************************************************************************************

    Algemenen functies voor het tonen en verbergen van bijvoorbeeld vensters, buttons etc. voor aangegeven ID
    
*************************************************************************************************************/

function toonId(id) {
    document.getElementById(id).style.display ="block";    
}

function verbergId(id) {
    document.getElementById(id).style.display ="none";    
}

/******************************************************************************************************

    Algemenen functies voor het verversen van de inhoud voor aangegeven ID
    
******************************************************************************************************/

function vernieuwInhoudId(id,inhoud) {
    document.getElementById(id).innerHTML = inhoud;    
}

/******************************************************************************************************

    Functies voor het in- en uitloggen, hierin worden sessie vairalen aangemaakt / vrij gegeven
    
******************************************************************************************************/

function logIn () {
//    presenteerLoginVenster();
}

function logUit () {
//	alert("Er wordt uigelogd!");
//    presenteerId('inlog_menu_id');
//    verbergId('uitlog_menu_id');
}

/******************************************************************************************************

    Eventhandling voor in- en uitloggen
    
******************************************************************************************************/

setEventByID('logUit_id', 'click', logUit);
setEventByID('logIn_id', 'click', logIn);
