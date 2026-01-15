document.addEventListener("DOMContentLoaded", () => {
    const openBtn = document.getElementById("openPanelBtn");
    const closeBtn = document.getElementById("closePanelBtn");
    const panel = document.getElementById("sidePanel");

    openBtn.addEventListener("click", () => {
        panel.classList.add("open");
    });

    closeBtn.addEventListener("click", () => {
        panel.classList.remove("open");
    });
});
