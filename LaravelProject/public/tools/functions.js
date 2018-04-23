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
        var dd = today.getDate();
        var mm = today.getMonth()+1; //January is 0!
        var yyyy = today.getFullYear();

        if(dd<10) {
            dd = '0'+dd
        }

        if(mm<10) {
            mm = '0'+mm
        }

        today = yyyy + '-' + mm + '-' + dd;
        document.getElementById('reserveDate').setAttribute("min",today);

        mm = parseInt(mm) + 2;
        if (mm < 10){
            var ze = "0";
            mm =  ze.concat(mm);
        }
        today = yyyy + '-' + mm + '-' + dd;
        document.getElementById('reserveDate').setAttribute("max",today);



    } else {
        document.getElementById('revele').style.display = "none";
    }


}




