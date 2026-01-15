document.addEventListener('DOMContentLoaded', () => {

    // OPEN EDIT SLIDER
    document.querySelectorAll('.action-btn.edit').forEach(btn => {
        btn.addEventListener('click', e => {
            e.preventDefault();

            const panel = document.getElementById('editSidePanel');
            panel.classList.add('open');

            const dt = btn.dataset.datetime.split(' ');

            document.getElementById('edit_event_id').value = btn.dataset.id;
            document.getElementById('edit_eventName').value = btn.dataset.title;
            document.getElementById('edit_eventDate').value = dt[0];
            document.getElementById('edit_eventTime').value = dt[1].substring(0, 5);
            document.getElementById('edit_location').value = btn.dataset.location;
            document.getElementById('edit_count').value = btn.dataset.count;
            document.getElementById('edit_eventDescription').value = btn.dataset.description;
        });
    });

    // CLOSE EDIT SLIDER
    document.getElementById('closeEditPanelBtn')
        .addEventListener('click', () => {
            document.getElementById('editSidePanel').classList.remove('open');
        });

});
