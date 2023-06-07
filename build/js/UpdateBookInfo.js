function sendwork(post_id, work, data) {
    $.ajax({
        url: "build/php/inc/UpdatePostInfo.php",
        type: "POST",
        data: {
            "postID": post_id,
            "work": work,
            "data": data
        },
        success: function (response) {
            console.log(response);
            if (response == 'Done') {
                // console.clear();
            }
        },
        error: function (xhr, status, error) {
            console.log(xhr.responseText);
        }
    });
}


document.getElementById('postNameForEdit').oninput = function () {
    sendwork(post_id.value, "updateName", postNameForEdit.value);
}

document.getElementById('postTypeForEdit').onchange = function () {
    sendwork(post_id.value, "updatePostType", postTypeForEdit.value);
}

document.getElementById('languageForEdit').onchange = function () {
    sendwork(post_id.value, "updateLanguage", languageForEdit.value);
}

