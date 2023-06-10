document.getElementById("publishersSubject").ondblclick = function () {
    publishersCardTitle.innerText = 'ویرایش ناشر';
    addPublisher.innerHTML='ویرایش';
    var cardBody = document.querySelector(".publisherBody");
    var newButton = document.createElement("button");
    newButton.innerHTML = "لغو";
    newButton.classList.add("btn", "btn-secondary", "mt-2", "ml-2", "cancelEditPublisher");
    cardBody.insertBefore(newButton, addPublisher);
}

document.getElementById("activePublisherSubject").onclick = function () {
    $.ajax({
        url: "build/ajax/PublishersManager.php",
        method: "GET",
        data: {
            work: "ActivePublishers"
        },
        success: function (response) {
            $("#activePublisherSubject").html(response);
        },
        error: function (xhr, status, error) {
            console.log(xhr.responseText);
        }
    });
}

document.getElementById("deactivePublisherSubject").onclick = function () {
    $.ajax({
        url: "build/ajax/PublishersManager.php",
        method: "GET",
        data: {
            work: "DeactivePublishers"
        },
        success: function (response) {

            $("#deactivePublisherSubject").html(response);
        },
        error: function (xhr, status, error) {
            console.log(xhr.responseText);
        }
    });
}

document.getElementById("addPublisher").onclick = function () {
    $.ajax({
        url: "build/ajax/PublishersManager.php",
        method: "GET",
        data: {
            work: "addPublisher"
        },
        success: function (response) {

            $("#deactivePublisherSubject").html(response);
        },
        error: function (xhr, status, error) {
            console.log(xhr.responseText);
        }
    });
}