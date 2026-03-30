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

function openEditDialog(ticket) {
    document.getElementById('id').value = ticket.id;
    document.getElementById('title').value = ticket.title;
    document.getElementById('time').value = ticket.time;
    switch (ticket.advancement) {
        case "open": document.getElementById('advancement').value = "Ouvert"; break;
        case "progress": document.getElementById('advancement').value = "En cours"; break;
        case "completed": document.getElementById('advancement').value = "Terminé"; break;
    }
    document.getElementById('facturation').value = ticket.facturation === "included" ? "Inclus" : "Facturable";

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
