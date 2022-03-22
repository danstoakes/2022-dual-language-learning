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
            excerptView.value = "";
            excerptView.disabled = true;

            let descriptionView = document.getElementById("language_select_description");
            descriptionView.innerHTML = "";
            descriptionView.disabled = true;

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

                excerptView.value = excerpt;
                descriptionView.innerHTML = description;
            }
        });
    }
});