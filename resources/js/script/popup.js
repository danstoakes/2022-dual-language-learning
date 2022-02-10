window.addEventListener("DOMContentLoaded", function () {
    let closeButton = document.getElementById("alert_popup_close");

    if (closeButton) {
        closeButton.addEventListener("click", function (e) {
            e.target.parentNode.classList.remove("d-flex");
            e.target.parentNode.classList.add("d-none");
        });
    }
});