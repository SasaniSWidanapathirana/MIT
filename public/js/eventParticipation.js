document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll(".participation-toggle").forEach(toggle => {
        toggle.addEventListener("change", function () {
            const eventId = this.dataset.eventId;
            const status = this.checked ? 1 : 0;

            fetch("../../controllers/eventParticipation.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({
                    event_id: eventId,
                    status: status
                })
            })
            .then(res => res.json())
            .then(data => {
                if (!data.success) {
                    alert("Failed to update participation");
                    this.checked = !this.checked; // rollback
                }
            });
        });
    });
});
