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