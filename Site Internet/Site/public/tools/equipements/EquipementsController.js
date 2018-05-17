const EquipementsController = function(){

};




EquipementsController.checkIfExist = function (equipement_name,short_name,callback){
    const request = new XMLHttpRequest();


    request.onreadystatechange = function () {
        if (request.readyState == 4){
            if (request.status == 200){
                callback( JSON.parse(request.responseText) );
            }
        }
    };





    var params = [
        "equipement_name=" + equipement_name,
        "short_name=" + short_name,
    ];


    request.open('GET', '/getEquipements?' + params.join('&'));

    request.send();
};





EquipementsController.checkIfExistInSite = function (equipement_id,sites_id,date,callback){
    const request = new XMLHttpRequest();


    request.onreadystatechange = function () {
        if (request.readyState == 4){
            if (request.status == 200){
                callback( JSON.parse(request.responseText) );
            }
        }
    };





    var params = [
        "equipements_id=" + equipement_id,
        "sites_id=" + sites_id,
        "date=" + date,
    ];


    request.open('GET', '/getEquipementsBySites?' + params.join('&'));

    request.send();
};
