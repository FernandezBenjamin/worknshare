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





    var params = [
        "date=" + date,
        "room_id=" + room,
        "site_id=" + site
    ];


    request.open('GET', '/getSpaces?' + params.join('&'));






    request.send();
};





SpacesController.checkHours = function (date,room,site,start, end,callback){
    const request = new XMLHttpRequest();


    request.onreadystatechange = function () {
        if (request.readyState == 4){
            if (request.status == 200){
                callback( JSON.parse(request.responseText) );
            }
        }
    };





    var params = [
        "date=" + date,
        "room_id=" + room,
        "site_id=" + site,
        "start=" + start,
        "end=" + end,
    ];


    request.open('GET', '/getHours?' + params.join('&'));

    request.send();
};