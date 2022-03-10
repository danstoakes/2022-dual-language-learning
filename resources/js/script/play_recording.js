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