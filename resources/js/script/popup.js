window.addEventListener("DOMContentLoaded", function () {
    console.log('DOM fully loaded and parsed');

    document.getElementById("alert_popup_close").addEventListener("click", function (e) {
        e.target.parentNode.classList.remove("d-flex");
        e.target.parentNode.classList.add("d-none");
    });
});