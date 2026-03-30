console.log("listTicket.js initiated");

const dialog = document.getElementById('newTicketDialog');

dialog.addEventListener('click', (event) => {
    const rect = dialog.getBoundingClientRect();

    const isInDialog =
        event.clientX >= rect.left &&
        event.clientX <= rect.right &&
        event.clientY >= rect.top &&
        event.clientY <= rect.bottom;

    if (!isInDialog) {
        dialog.close();
    }
});
dialog.addEventListener('close', () => {
    document.body.classList.remove('overflow-hidden');
});
dialog.addEventListener('cancel', (event) => {
    event.preventDefault(); // évite comportement par défaut si besoin
    dialog.close();
});

function openCreateDialog() {
    document.getElementById('id').value = '';
    document.getElementById('title').value = '';
    document.getElementById('time').value = '';
    document.getElementById('advancement').value = 'En cours';
    document.getElementById('facturation').value = 'Inclus';

    const dialog = document.getElementById('newTicketDialog');
    dialog.showModal();
    document.body.classList.add('overflow-hidden');
}

function openEditDialog(ticket_id) {
    const ticket_list = document.getElementById('ticket_list');
    const thisTicket = ticket_list.querySelector(`[data-id="${ticket_id}"]`);
    //console.log(thisTicket);

    document.getElementById('id').value = ticket_id;
    document.getElementById('title').value = thisTicket.querySelector('[data-field="title"]').innerText;
    document.getElementById('time').value = parseInt(thisTicket.querySelector('[data-field="time"]').innerText);
    document.getElementById('advancement').value = thisTicket.querySelector('[data-field="advancement"]').innerText;
    document.getElementById('facturation').value = thisTicket.querySelector('[data-field="facturation"]').innerText;

    dialog.showModal();
    document.body.classList.add('overflow-hidden');
}

const checkboxes = document.querySelectorAll('input[type="checkbox"][data-filter]');
const items = document.querySelectorAll('.ticket');

function applyFilters() {
    const activeFilters = Array.from(checkboxes)
        .filter(cb => cb.checked)
        .map(cb => cb.dataset.filter);

    items.forEach(item => {
        const tags = item.dataset.tags.split(' ');
        const matches =
            activeFilters.length === 0 ||
            activeFilters.every(filter => tags.includes(filter));

        item.classList.toggle('hidden', !matches);
    });
}

checkboxes.forEach(cb => cb.addEventListener('change', applyFilters));

// Affichage dynamique
function addTicketToList(ticket) {
    const ticket_list = document.getElementById('ticket_list');

    const div = document.createElement('div');
    div.className = "bg-background rounded-xl shadow-lg p-8 space-y-6 w-[340px] max-w-[340px] self-start";
    div.dataset.id = ticket.id;
    div.dataset.tags = `${ticket.advancement} ${ticket.facturation}`;

    const timeText = `${ticket.time} heure${ticket.time > 1 ? 's' : ''}`;

    const advancementClass = window.advancementStyles[ticket.advancement] ?? "bg-gray-100 text-gray-700";
    const facturationClass = window.facturationStyles[ticket.facturation] ?? "bg-gray-100 text-gray-700";

    const advancementLabel = convertAdvancement(ticket.advancement);
    const facturationLabel = convertFacturation(ticket.facturation);

    const collaboratorsHtml = ticket.collaborators
        ? ticket.collaborators.map(name => `
            <li class="px-3 py-1 text-sm rounded-full bg-secondary text-text">
                ${name}
            </li>
        `).join('')
        : '';
    
    const editButton = ticket.can_edit
        ? `
            <div class="text-right">
                <a onclick='openEditDialog(${JSON.stringify(ticket)})'
                    class="inline-block bg-primary text-white p-2 rounded-lg font-semibold hover:bg-accent transition">
                    Modifier
                </a>
            </div>
        ` : '';

    div.innerHTML = `
        <div class="flex justify-center">
            <h1 class="text-2xl font-bold text-text text-center" data-field="title">
                ${ticket.title}
            </h1>
        </div>

        <div class="flex mb-2 justify-between gap-2">
            <div>
                <h2 class="text-sm font-semibold text-accent">
                    Temps passé
                </h2>
                <p class="text-text" data-field="time">
                    ${timeText}
                </p>
            </div>

            <div class="text-right">
            <span data-field="advancement" class="inline-block px-3 py-1 text-sm font-semibold rounded-full ${advancementClass}">
                ${advancementLabel}
            </span>
            <span data-field="facturation" class="inline-block px-3 mt-1 py-1 text-sm font-semibold rounded-full ${facturationClass}">
                ${facturationLabel}
            </span>
        </div>
        </div>

        <!-- Propriétaire et Collaborateurs -->
        <div>
            <h2 class="text-sm font-semibold text-accent mb-2">
                Propriétaire et collaborateurs
            </h2>
            <ul class="flex gap-2 flex-wrap">
                <li class="px-3 py-1 text-sm rounded-full bg-tertiary text-text">
                    ${ticket.user_name}
                </li>
                ${collaboratorsHtml}
            </ul>
        </div>

        ${editButton}
        `;

    ticket_list.append(div); // ajoute en bas
}