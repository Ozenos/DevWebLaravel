const form = document.getElementById('newTicketForm');
form.addEventListener('submit', function(e) {
    e.preventDefault();

    const url = form.action; // récupère l'URL de la route Blade

    let adv;
    switch(document.getElementById('advancement').value) {
        case "En cours":
            adv = "progress";
        case "Ouvert":
            adv = "open";
        case "Terminé":
            adv = "completed";
    }
    let facturation = document.getElementById('facturation').value
    let fact = facturation === "Inclus" ? "included" : "facturable";

    const formData = {
        user_id: Number(document.getElementById('user_id').value),
        title: document.getElementById('title').value,
        time: Number(document.getElementById('time').value),
        advancement: adv,
        facturation: fact
    };

    console.log(formData)
    
    fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        },
        body: JSON.stringify(formData)
    })
    .then(res => res.json())
    .then(ticket => console.log('Ticket créé :', ticket))
    .catch(err => console.error(err));
});