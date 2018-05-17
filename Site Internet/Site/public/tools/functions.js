function add_new_site(){


    var city = document.getElementById("city");
    var wifi = document.getElementById("wifi");
    var member_tray = document.getElementById("member_tray");
    var unlimited_drink = document.getElementById("unlimited_drink");
    var meeting_rooms = document.getElementById("meeting_rooms");
    var call_rooms = document.getElementById("call_rooms");
    var cosy_rooms = document.getElementById("cosy_rooms");
    var printers = document.getElementById("printers");
    var computers = document.getElementById("computers");
    var hours = document.getElementById("hours");






    var request = new XMLHttpRequest();
    request.onreadystatechange = function(){
        if (request.readyState == 4){
            console.log(request.responseText);
            if(request.status == 200){
                notification("Le site a bien été ajouté",1);

                city.value = "";
                wifi.value = "";
                member_tray.value = "";
                unlimited_drink.value = "";
                meeting_rooms.value = "";
                call_rooms.value = "";
                cosy_rooms.value = "";
                printers.value = "";
                computers.value = "";
                hours.value = "";
            } else {
                notification("Une erreur est survenu, le site n'a pas été ajouté. Veuillez vérifier les champs",0);
            }
        }
    };
    request.open('POST', '../administration/create_site.php');
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');


    var params = [
        "city=" + city.value,
        "wifi=" + wifi.value,
        "member_tray=" + member_tray.value,
        "unlimited_drink=" + unlimited_drink.value,
        "meeting_rooms=" + meeting_rooms.value,
        "call_rooms=" + call_rooms.value,
        "cosy_rooms=" + cosy_rooms.value,
        "printers=" + printers.value,
        "computers=" + computers.value,
        "hours=" + encodeURIComponent(hours.value)
    ];


    request.send(params.join('&'));

}


function notification(text,succes){
    var container =  document.body;

    if (succes == 1){
        var div = document.createElement("div");
        div.setAttribute("class","notification succes");
        div.setAttribute("id","notification");
        div.style.display = "block";


        var i = document.createElement('i');
        i.setAttribute('class','fa fa-check fa-3x');
        i.setAttribute('aria-hidden','true');

    } else if(succes == 0){
        var div = document.createElement("div");
        div.setAttribute("class","notification fail");
        div.setAttribute("id","notification");
        div.style.display = "block";


        var i = document.createElement('i');
        i.setAttribute('class','fa fa-cross fa-3x');
        i.setAttribute('aria-hidden','true');

    }

    var p = document.createElement("p");
    p.innerHTML = text;


    container.appendChild(div);
    div.appendChild(i);
    div.appendChild(p);



    setTimeout(function() {
        var notif = document.getElementById('notification');
        notif.parentNode.removeChild(notif);
    },5000);



}






function revele() {
    var select = document.getElementById('sites');
    if (select.value != null){
        document.getElementById('revele').style.display = "block";

        var today = new Date();
        today = today.parseTodayDate();

        

        document.getElementById('reserveDate').setAttribute("min",today);

        var todayPlusTwoMonth = new Date();
        todayPlusTwoMonth = todayPlusTwoMonth.parseTodayDateWithExtrasMonths(2);

        document.getElementById('reserveDate').setAttribute("max",todayPlusTwoMonth);



    } else {
        document.getElementById('revele').style.display = "none";
    }


}




function changeColor(elm, succes) {

    if(!succes && elm.classList.contains('check-succes')){
        elm.classList.remove('check-succes');
        elm.classList.add('check-error');
    } else if (!succes) {

        elm.classList.add('check-error');
    } else {
        elm.classList.remove('check-error');
        elm.classList.add('check-succes');
    }

}


function checkHours(){

    var reservationStart = document.getElementById('reservationStart');
    var reservationEnd = document.getElementById('reservationEnd');

    var date = document.getElementById('reserveDate');
    var type = document.getElementById('rooms');
    var sites = document.getElementById('sites');


    var end = parseInt(reservationEnd.value);
    var start = parseInt(reservationStart.value);

    if ( date.value != "" &&
        type.value != "null" &&
        sites.value != "null" &&
        (end <= 20 || end >= 8 ) &&
        (start >= 8 || start <= 19) &&
        start != end
    ){

        SpacesController.checkHours(date.value, type.value, sites.value, reservationStart.value, reservationEnd.value, function (check) {


            var number = parseInt(check['countBetween']) + parseInt(check['countNotBetween']);

            if (number >= parseInt(check['quantity'])) {


                changeColor(date, 0);
                changeColor(reservationStart, 0);
                changeColor(reservationEnd, 0);


                document.getElementById('reserveSpace').style.display = "none";
                document.getElementById('text-hours-error').style.display = "block";


            } else if (number < parseInt(check['quantity'])) {

                changeColor(sites, 1);
                changeColor(type, 1);
                changeColor(date, 1);
                changeColor(reservationStart, 1);
                changeColor(reservationEnd, 1);


                document.getElementById('reserveSpace').style.display = "block";
                document.getElementById('text-hours-error').style.display = "none";


            }
        });
    }

}




function reveleElem(id) {
    var elem = document.getElementById(id);
    if (elem.value != null){
        document.getElementById('revele').style.display = "block";

    } else {
        document.getElementById('revele').style.display = "none";
    }


}




function checkService(){


    var service_name = document.getElementById('service_name');
    var service_desc = document.getElementById('description');
    var short_name = document.getElementById('short_name');

    console.log(service_name.value);
    console.log(short_name.value);


    ServicesController.checkIfExist(service_name.value, short_name.value, function (check) {



        if(service_name.value != undefined && short_name.value != undefined && service_desc.value != undefined){

            if ( check.length > 0 ) {


                changeColor(service_name, 0);
                changeColor(service_desc, 0);
                changeColor(short_name, 0);


                document.getElementById('add_service').style.display = "none";


            } else {

                changeColor(service_name, 1);
                changeColor(service_desc, 1);
                changeColor(short_name, 1);



                document.getElementById('add_service').style.display = "block";


            }
        }

    });

}



function checkEquipement(){


    var name = document.getElementById('equipement_name');
    var desc = document.getElementById('description');
    var short_name = document.getElementById('short_name');



    EquipementsController.checkIfExist(name.value, short_name.value, function (check) {

        if(name.value != "" && short_name.value != "" && desc.value != "") {


            if (check.length > 0) {


                changeColor(name, 0);
                changeColor(desc, 0);
                changeColor(short_name, 0);


                document.getElementById('add_equipement').style.display = "none";


            } else {

                changeColor(name, 1);
                changeColor(desc, 1);
                changeColor(short_name, 1);


                document.getElementById('add_equipement').style.display = "block";


            }
        }
    });

}



function displayCounter(id){
 var checkboxSite = document.getElementById('checkboxSite' + id);
 var counterSite = document.getElementById('counterSite' + id);


     if ( counterSite.style.display == 'none' &&  checkboxSite.checked == true ){
         counterSite.style.display = 'block';
     } else if ( counterSite.style.display == 'block' &&  checkboxSite.checked == false ) {
         counterSite.style.display = 'none';
     }
}


function checkEquipementBySite(){

    var sites = document.getElementById('sites');
    var equipements = document.getElementById('equipements');
    var date = document.getElementById('reserveDate');



    EquipementsController.checkIfExistInSite(equipements.value,sites.value,date.value, function (check) {


        var today = new Date().parseTodayDate();


        if(sites.value >= 0 && equipements.value >= 0 && date.value > today) {



            if (check.equipements_loans.length == check.equipements_sites.quantity) {


                changeColor(sites, 0);
                changeColor(equipements, 0);


                notification("Cet équipement n'est plus disponible a cet date.",0);

                document.getElementById('rent_equipement').style.display = "none";


            } else {

                changeColor(sites, 1);
                changeColor(equipements, 1);


                document.getElementById('rent_equipement').style.display = "block";

                notification("Tous les champs sont bons, vous pouvez valider.",1);

            }
        }
    });
}





function checkServices(){

    var sites = document.getElementById('sites');
    var equipements = document.getElementById('services');
    var date = document.getElementById('reserveDate');



    EquipementsController.checkIfExistInSite(equipements.value,sites.value,date.value, function (check) {


        var today = new Date().parseTodayDate();


        if(sites.value >= 0 && equipements.value >= 0 && date.value > today) {



            if (check.equipements_loans.length == check.equipements_sites.quantity) {


                changeColor(sites, 0);
                changeColor(equipements, 0);


                notification("Cet équipement n'est plus disponible a cet date.",0);

                document.getElementById('rent_equipement').style.display = "none";


            } else {

                changeColor(sites, 1);
                changeColor(equipements, 1);


                document.getElementById('rent_equipement').style.display = "block";

                notification("Tous les champs sont bons, vous pouvez valider.",1);

            }
        }
    });
}
