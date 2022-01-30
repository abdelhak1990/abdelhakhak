document.addEventListener("DOMContentLoaded", async () => {
    await load_data();
});

$lastId = 0;

async function load_data() {
    const contentElement = document.getElementById("bodypersonnage");
    const request = await fetch("./get.php");
    const response = await request.json();
    const personnages = response.personnages;
    contentElement.innerHTML = "";
    for (const personnage of personnages) {
        $lastId = personnage.id > $lastId ? personnage.id : $lastId
        var markup = "<tr><td>"+personnage.nom+"</td><td>"+personnage.prenom+"</td><td>"+personnage.role+"</td><td class='text-right'><a data-toggle='modal' data-target='#myModalEdit' class='btn btn-info btn-xs' onclick='modalEdit("+personnage.id+")'><i class='fas fa-edit'></i>Modifier</a> <a onclick='supp("+personnage.id+")' class='btn btn-danger btn-xs'><i class='far fa-trash-alt'></i> Supprimer</a></td></tr>";
        contentElement.innerHTML += `${markup}`
    }
}


async function create_personnage() {
    // Création d'un personnage
    const nom = document.getElementById("nom_input").value;
    const prenom = document.getElementById("prenom_input").value;
    const role = document.getElementById("role_input").value;

    const new_personnage = {
        "id": $lastId+1, "nom": nom, "prenom": prenom, "role": role
    };
    // envoi du champion en POST
    const request = await fetch("add.php", {
        method: "POST",
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(new_personnage)
    })
    await load_data();
    const response = await request.json();
    document.getElementById("errorServe").innerHTML = response.message;
    document.getElementById("errorServe").removeAttribute("style");
}

async function supp(id) {
    await fetch("delete.php", {
        method: "DELETE",
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            "id": id
        })
    });
    await load_data();
}

async function modalEdit(id) {

    const request = await fetch("getById.php", { method: "POST",
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            "id": id
        })
    });
    const personnage = await request.json();
    document.getElementById("id_edit").value = personnage.id;
    document.getElementById("nom_edit").value = personnage.nom;
    document.getElementById("prenom_edit").value = personnage.prenom;
    document.getElementById("role_edit").value = personnage.role;

}

async function editer() {
    const id = document.getElementById("id_edit").value;
    const nom = document.getElementById("nom_edit").value;
    const prenom = document.getElementById("prenom_edit").value;
    const role = document.getElementById("role_edit").value;

    const edit_personnage = {
        "id": id, "nom": nom, "prenom": prenom, "role": role
    };

    await fetch("update.php", {
        method: "PUT",
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(edit_personnage)
    });
    await load_data();
        
}
