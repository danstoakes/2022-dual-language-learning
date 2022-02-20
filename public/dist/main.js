window.addEventListener("DOMContentLoaded", function () {
    let closeButton = document.getElementById("alert_popup_close");

    if (closeButton) {
        closeButton.addEventListener("click", function (e) {
            e.target.parentNode.classList.remove("d-flex");
            e.target.parentNode.classList.add("d-none");
        });
    }
});
window.addEventListener("DOMContentLoaded", function () {
    let phraseCheckbox = document.getElementById("phrase_create_checkbox");

    if (phraseCheckbox) {
        phraseCheckbox.addEventListener("click", function (e) {
            var display = "none";
            if (phraseCheckbox.checked)
                display = "block";

            let sectionToToggle = document.getElementById("select_similar_section");
            
            if (sectionToToggle)
                sectionToToggle.style.display = display;
        });
    }
});
function changeCount(e, id) {
    e = e || window.event;

    let target = e.target || e.srcElement;
    let maxLength = target.getAttribute("maxlength");
    let length = target.value.length;

    document.getElementById(id).innerHTML = `${maxLength - length} characters remaining`;
}