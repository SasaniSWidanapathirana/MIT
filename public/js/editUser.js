document.addEventListener('DOMContentLoaded', () => {

    // OPEN EDIT SLIDER
    document.querySelectorAll('.action-btn.edit').forEach(btn => {
        btn.addEventListener('click', e => {
            e.preventDefault();
            const panel = document.getElementById('editSidePanel');
            panel.classList.add('open');
document.getElementById('edit_userID').value = btn.dataset.id;

           // document.getElementById('edit_userID').value = btn.dataset.id;
           document.getElementById('edit_userRole').value = btn.dataset.role;
           document.getElementById('edit_userName').value = btn.dataset.name;
            document.getElementById('edit_userNIC').value = btn.dataset.nic;
            document.getElementById('edit_userEmail').value = btn.dataset.email;
            // document.getElementById('edit_status').value = btn.dataset.status;
            // document.getElementById('edit_field').value = btn.dataset.field;
        });
    });

    // CLOSE EDIT SLIDER
    document.getElementById('closeEditPanelBtn')
        .addEventListener('click', () => {
            document.getElementById('editSidePanel').classList.remove('open');
        });
});