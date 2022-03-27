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
window.addEventListener("DOMContentLoaded", function () 
{
    /**
     * Gets the container which houses the "music icon" SVG
     */
    function getButtonParentContainer (button) {
        let buttonParent = button.parentElement;
        
        return buttonParent.querySelectorAll(".music-container-body")[0];
    }

    /**
     * Gets the path objects for the play pause SVG icons
     */
    function getSVGPaths (button) {
        let buttonContainer = button.querySelectorAll(".music-container-overlay-circle")[0];
        let playPauseSVG = buttonContainer.getElementsByTagName("svg")[0];

        return {
            "playPath" : playPauseSVG.children[0],
            "pausePath" : playPauseSVG.children[1]
        };
    }

    /**
     * Updates GUI elements to show the recording is playing
     */
    function updateForPlay (button) {
        let paths = getSVGPaths(button);

        getButtonParentContainer(button).classList.add("music-container-body-hidden");
        button.classList.add("music-container-overlay-visible");
        paths["pausePath"].style.display = "block";
        paths["playPath"].style.display = "none";
    }

    /**
     * Updates GUI elements to show the recording is no longer playing
     */
    function updateForPause (button) {
        let paths = getSVGPaths(button);

        getButtonParentContainer(button).classList.remove("music-container-body-hidden");
        button.classList.remove("music-container-overlay-visible");
        paths["pausePath"].style.display = "none";
        paths["playPath"].style.display = "block";
    }

    // get all buttons and loop through them
    let buttons = document.querySelectorAll(".music-container-overlay");
    for (var i = 0; i < buttons.length; i++) {
        let button = buttons[i];

        // add a click listener
        button.addEventListener("click", function (e) {
            let targetAudio = button.getElementsByTagName("audio")[0];

            // loop through all audio elements and check if any are playing
            let audios = document.querySelectorAll(".recording-audio");
            var canPlay = true;
            for (var j = 0; j < audios.length; j++) {
                let audio = audios[j];

                // audio is already playing
                if (!audio.paused) {
                    canPlay = false;

                    // if the user has clicked the playing audio a second time,
                    // pause it (end it in this case)
                    if (audio == targetAudio) {
                        targetAudio.pause();
                        targetAudio.currentTime = 0;

                        updateForPause(button);
                    }
                }
            }

            // play the audio if it can be played and update GUI
            if (canPlay) {
                targetAudio.addEventListener("ended", function () {
                    updateForPause(button);
                });

                targetAudio.play();
                updateForPlay(button);
            }
        });
    }
});
window.addEventListener("DOMContentLoaded", function () {
    let languageDropdown = document.getElementById("language_select_dropdown");

    if (languageDropdown) {
        languageDropdown.addEventListener("change", function (e) {
            var selectedLanguage = this.options[this.selectedIndex];

            let languageCodes = selectedLanguage.getAttribute("language_codes");
            let excerpt = selectedLanguage.getAttribute("excerpt");

            let description = selectedLanguage.getAttribute("description");

            let codesSelect = document.getElementById("language_variant_select_dropdown");
            codesSelect.disabled = true;

            let excerptView = document.getElementById("language_select_excerpt");

            if (excerptView !== null) {
                excerptView.value = "";
                excerptView.disabled = true;
            }

            let descriptionView = document.getElementById("language_select_description");

            if (descriptionView !== null) {
                descriptionView.innerHTML = "";
                descriptionView.disabled = true;
            }

            codesSelect.innerHTML = "";

            let languageCodeArray = JSON.parse(languageCodes);

            if (languageCodeArray !== null) {
                let languageCodeArrayKeys = Object.keys(languageCodeArray);

                if (languageCodeArrayKeys.length > 0)
                    codesSelect.disabled = false;

                for (var i = 0; i < languageCodeArrayKeys.length; i++) {
                    let languageCode = languageCodeArray[languageCodeArrayKeys[i]];
                    codesSelect.add(new Option(languageCode, languageCodeArrayKeys[i]));
                }

                if (excerptView !== null)
                    excerptView.value = excerpt;
                
                if (descriptionView !== null)
                    descriptionView.innerHTML = description;
            }
        });
    }
});