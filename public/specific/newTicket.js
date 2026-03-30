console.log("newTicket.js initiated");

const titleInput = document.getElementById("title");
const timeInput = document.getElementById("time");
const descInput = document.getElementById("description");

function check_title() {
    // Verify title selection
    const title = titleInput
    // .value get input value
    //console.log("title : ", title.value);

    const title_error = document.querySelector('#title_error');

    if (title.value == "") {
        title_error.classList.remove('invisible');
        return 1;
    } else {
        title_error.classList.add('invisible');
        return 0;
    }
}

function check_time() {
    // Verify time selection
    const time = timeInput
    // .value get input value
    //console.log("time H : ", time.value);
    const Hval = Number.isInteger(Number(time.value)) && Number(time.value) > 0;

    const time_error = document.querySelector('#time_error');
    if (time.value == "") {
        time_error.classList.remove('invisible');
        time_error.textContent = 'Veuillez entrer une estimation de temps en heures';
        return 1;
    }
    if (Hval == false) {
        time_error.classList.remove('invisible');
        time_error.textContent = 'Veuillez entrer une valeur entière';
        return 2;
    } else {
        time_error.classList.add('invisible');
        return 0;
    }
}

titleInput.addEventListener('blur', check_title);
timeInput.addEventListener('blur', check_time);

const form = document.getElementById('newTicketForm');

form.addEventListener('submit', function (e) {
    e.preventDefault();
    let nb_errors = check_title() + check_time();
    //console.log("nb_errors : ", nb_errors);

    if (nb_errors == 0) {

        let adv;
        switch (document.getElementById('advancement').value) {
            case "En cours":
                adv = "progress";
                break;
            case "Ouvert":
                adv = "open";
                break;
            case "Terminé":
                adv = "completed";
                break;
        }
        let fact = document.getElementById('facturation').value === "Inclus" ? "included" : "facturable";

        const ticketId = document.getElementById('id').value;

        const formData = {
            user_id: Number(document.getElementById('user_id').value),
            title: document.getElementById('title').value,
            time: Number(document.getElementById('time').value),
            advancement: adv,
            facturation: fact
        };

        //console.log(formData)

        const updateRoute = document.getElementById('update_url').value;
        // Si ticketId est présent → édition, sinon création
        const url = ticketId
            ? updateRoute.replace('__ID__', ticketId)   // PUT
            : form.action;                              // POST
        const method = ticketId ? 'PUT' : 'POST';

        fetch(url, {
            method: method,
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify(formData)
        })
            .then(res => res.json())
            //.then(ticket => console.log('Ticket créé :', ticket))
            .then(data => {
                const ticket_list = document.getElementById('ticket_list');
                if (ticket_list == null) return;

                //console.log('Ticket créé :', data);
                const ticket = data.ticket; 
                
                const existing = ticket_list.querySelector(`[data-id="${ticket.id}"]`);
                //console.log(existing);
                if (existing) {
                    console.log('UPDATING A TICKET');
                    // UPDATE
                    existing.dataset.tags = `${ticket.advancement} ${ticket.facturation}`;
                    existing.querySelector('[data-field="title"]').textContent = ticket.title;
                    existing.querySelector('[data-field="time"]').textContent = `${ticket.time} heure${ticket.time > 1 ? 's' : ''}`;
                    existing.querySelector('[data-field="advancement"]').textContent = convertAdvancement(ticket.advancement);
                    existing.querySelector('[data-field="facturation"]').textContent = convertFacturation(ticket.facturation);
                } else {
                    console.log('ADDING A TICKET');
                    // CREATE
                    addTicketToList(ticket);
                }
                dialog.close();
            })
            .catch(err => console.error(err));

        titleInput.value = "";
        timeInput.value = "";
        descInput.value = "";

        const toast = document.getElementById("success");
        //console.log(toast);
        toast.classList.remove('invisible');
        // Wait 3 seconds then remove
        setTimeout(() => {
            toast.classList.add('invisible');
        }, 5000);
    }
});

function convertAdvancement(adv) {
    switch (adv) {
        case 'open': return 'Ouvert';
        case 'progress': return 'En cours';
        case 'completed': return 'Terminé';
        default: return adv;
    }
}
function convertFacturation(fac) {
    switch (fac) {
        case "included": return "Inclus";
        case "facturable": return "Facturable";
        default: return fac;
    }
}