function showUser(){
    var request = new XMLHttpRequest();
    request.onreadystatechange = function(){
        if (request.readyState == 4){
                var text = request.responseText;
                var users = JSON.parse(text);

                var container = document.getElementById('user_admin');
                container.innerText = "";

                users.forEach(displayUsers);

        }
    };
    request.open('POST', 'users/get_users.php');
    request.send();
}




function displayUsers(user) {
    var container = document.getElementById('user_admin');

    var tr = document.createElement('tr');
    tr.classList.add();

    var name = document.createElement('th');
    name.innerHTML = user.name;

    var surname = document.createElement('th');
    surname.innerHTML = user.surname;

    var mail = document.createElement('th');
    mail.innerHTML = user.email;

    var country = document.createElement('th');
    country.innerHTML = user.country;

    var birth = document.createElement('th');
    birth.innerHTML = user.birthday;

    var add_date = document.createElement('th');
    add_date.innerHTML = user.date_inserted;

    var action = document.createElement('th');


    var button = document.createElement('button');
    button.innerHTML = "Supprimer";
    button.classList.add("btn-danger");
    button.classList.add("btn");
    button.onclick = function onclick(event){ deleteUser(user.id); };


    action.appendChild(button);



    container.appendChild(tr);
    tr.appendChild(name);
    tr.appendChild(surname);
    tr.appendChild(mail);
    tr.appendChild(country);
    tr.appendChild(birth);
    tr.appendChild(add_date);
    tr.appendChild(button);

}




function deleteUser(id){
    var request = new XMLHttpRequest();
    request.onreadystatechange = function(){
        if (request.readyState == 4){
            var text = request.responseText;
            showUser();

        }
    };

    request.open('GET', 'users/deleteUsers.php?id=' + id);
    request.send();
}