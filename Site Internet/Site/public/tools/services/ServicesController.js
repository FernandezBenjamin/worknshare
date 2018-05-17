const ServicesController = function(){

};




ServicesController.checkIfExist = function (service_name,short_name,callback){
    const request = new XMLHttpRequest();


    request.onreadystatechange = function () {
        if (request.readyState == 4){
            if (request.status == 200){
                callback( JSON.parse(request.responseText) );
            }
        }
    };





    var params = [
        "service_name=" + service_name,
        "short_name=" + short_name,
    ];


    request.open('GET', '/getServices?' + params.join('&'));

    request.send();
};



