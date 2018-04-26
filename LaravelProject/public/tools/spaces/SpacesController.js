const SpacesController = function(){

};


SpacesController.addSpace = function(name, country, callback){
    const request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.readyState == 4){
            if (request.status == 200){
                callback(request.responseText);
            } else {
                callback(false);
            }
        }
    };



    request.open('POST', '../services/team/add.php');
    request.setRequestHeader('Content-Type','application/x-www-form-urlencoded');

    request.send( `name=${ name }&country=${country}` );
};

SpacesController.getSpace = function (callback) {
    const request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.readyState == 4){
            if (request.status == 200){
                callback( JSON.parse(request.responseText) );
            } else {
                callback(false);
            }
        }
    };



    request.open('GET', '../services/team/list.php');

    request.send();
};



SpacesController.checkDate = function (date,room,site,callback){
    const request = new XMLHttpRequest();


    request.onreadystatechange = function () {
        if (request.readyState == 4){
            if (request.status == 200){
                callback( JSON.parse(request.responseText) );
            }
        }
    };



    request.open('GET', '/getSpaces');

    request.send( `date=${ date }&room_id=${room}&site_id=${site}` );
};