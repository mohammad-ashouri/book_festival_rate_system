document.getElementById("proceedings_file").onchange = function change_proceedings_file_label() {
    var proceedings_file_label = document.getElementById("proceedings_file_label");
    if (proceedings_file.value.length !== 0) {
        proceedings_file_label.innerHTML = this.value.replace(/.*[\/\\]/, '');
    }
}
document.getElementById("post_file").onchange = function change_file_url_label() {
    var post_file_label = document.getElementById("post_file_label");
    if (post_file.value.length !== 0) {
        post_file_label.innerHTML = this.value.replace(/.*[\/\\]/, '');
    }
}