function changeCount(e, id) {
    e = e || window.event;

    let target = e.target || e.srcElement;
    let maxLength = target.getAttribute("maxlength");
    let length = target.value.length;

    document.getElementById(id).innerHTML = `${maxLength - length} characters remaining`;
}