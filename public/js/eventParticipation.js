document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll(".participation-toggle").forEach(toggle => {
        toggle.addEventListener("change", function () {
            const eventId = this.dataset.eventId;
            const action  = this.checked ? "join" : "leave";

            fetch("../../controller/eventParticipation.php", { // <-- absolute path
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({ event_id: eventId, action: action })
            })
            .then(res => res.json())
            .then(data => {
                if (!data.success) {
                    alert("Failed to update participation: " + data.message);
                    this.checked = !this.checked; // rollback toggle
                }
            })
            .catch(err => {
                console.error(err);
                alert("Server error");
                this.checked = !this.checked;
            });
        });
    });
});
