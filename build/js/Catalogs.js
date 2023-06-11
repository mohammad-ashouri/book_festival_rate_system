document.getElementById("publishersSubject").ondblclick = function () {
    var existingAddPublisher = document.getElementById("addPublisher");
    if (existingAddPublisher) {
        publisherNameForDisplayLabel.hidden = false;
        publisherNameForDisplay.hidden = false;
        publisherNameLabel.hidden = false;
        publishersCardTitle.innerText = 'ویرایش ناشر';
        addPublisher.remove();
        var optionValue = document.querySelector('#publishersSubject option[value="' + publishersSubject.value + '"]').label;
        publisherNameForDisplay.setAttribute("value", optionValue);
        publisherIDForUpdate.setAttribute("value", publishersSubject.value);

        var cardBody = document.querySelector(".publisherBody");
        var existingCancelButton = document.querySelector(".cancelEditPublisher");
        if (existingCancelButton) {
            existingCancelButton.remove();
        }
        var editButton = document.createElement("button");
        editButton.innerHTML = "ویرایش";
        editButton.classList.add("btn", "btn-success", "mt-2", "ml-2", "cancelEditPublisher");
        editButton.id = "editPublisher";
        cardBody.appendChild(editButton);

        var cancelButton = document.createElement("button");
        cancelButton.innerHTML = "لغو";
        cancelButton.classList.add("btn", "btn-secondary", "mt-2", "ml-2", "cancelEditPublisher");
        cancelButton.id = "cancelEdit";
        cardBody.insertBefore(cancelButton, editButton);
    } else {
        publisherNameForDisplayLabel.hidden = false;
        publisherNameForDisplay.hidden = false;
        publisherNameLabel.hidden = false;
        var optionValue = document.querySelector('#publishersSubject option[value="' + publishersSubject.value + '"]').label;
        publisherNameForDisplay.setAttribute("value", optionValue);
        publisherIDForUpdate.setAttribute("value", publishersSubject.value);
    }

    document.getElementById("editPublisher").onclick = function () {
        if (confirm('توجه داشته باشید که با تغییر نام ناشر، انتشارات تمامی آثاری که با این ناشر ثبت شده باشند تغییر خواهند کرد. آیا مطمئن هستید؟')) {
            $.ajax({
                url: "build/ajax/PublishersManager.php",
                method: "POST",
                data: {
                    work: "updatePublisher",
                    data: {
                        'id': publisherIDForUpdate.value,
                        'editedValue': publisherName.value,
                    }
                },
                success: function (response) {
                    if (response === 'Done') {
                        publisherNameForDisplayLabel.hidden = true;
                        publisherNameForDisplay.hidden = true;
                        publisherNameLabel.hidden = true;
                        editPublisher.remove();
                        cancelEdit.remove();
                        var addButton = document.createElement("button");
                        addButton.innerHTML = "اضافه کردن";
                        addButton.classList.add("btn", "btn-primary", "mt-2");
                        addButton.id = "addPublisher";
                        cardBody.appendChild(addButton);
                        publishersCardTitle.innerText = 'تعریف ناشر';
                        publisherName.value = null;
                        alert('ناشر انتخاب شده با موفقیت ویرایش شد.');
                    }
                },
                error: function (xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        }
    }

    document.getElementById("cancelEdit").onclick = function () {
        var cardBody = document.querySelector(".publisherBody");
        editPublisher.remove();
        cancelEdit.remove();
        var addButton = document.createElement("button");
        addButton.innerHTML = "اضافه کردن";
        addButton.classList.add("btn", "btn-primary", "mt-2");
        addButton.id = "addPublisher";
        cardBody.appendChild(addButton);
        publishersCardTitle.innerText = 'تعریف ناشر';
        publisherName.value = null;
        publisherNameForDisplayLabel.hidden = true;
        publisherNameForDisplay.hidden = true;
        publisherNameLabel.hidden = true;
    }
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