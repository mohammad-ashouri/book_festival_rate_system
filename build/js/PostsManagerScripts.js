var rowCounter = 2;
$(document).ready(function () {
    function updateRowIds() {
        $("#cooperatorsTable tbody tr").each(function (index) {
            var rowId = index + 1;
            $(this).attr("id", "row" + rowId);
            $(this)
                .find("input")
                .each(function () {
                    var inputId = $(this).attr("id");
                    if (inputId) {
                        var updatedInputId = inputId.replace(/\d+$/, rowId);
                        $(this).attr("id", updatedInputId);
                    }
                });
            $(this).find("td:first").text(index + 1);
            rowCounter = index + 2;
        });
    }

    $("#addRowButton").click(function () {
        var lastRow = $("#cooperatorsTable tbody tr:last");
        var clonedRow = lastRow.clone();
        clonedRow.find("td:first").text(rowCounter);
        clonedRow.find("td input").val("");
        var deleteButton = $("<button class='deleteRowButton btn btn-danger'>حذف</button>");
        clonedRow.find("td:last").empty().append(deleteButton);
        lastRow.after(clonedRow);
        rowCounter++;
        updateRowIds();
        return false;
    });

    $(document).on("click", ".deleteRowButton", function () {
        $(this).closest("tr").remove();
        updateRowIds();
        return false;
    });
});

document.getElementById("postFormat").onchange = function () {
    if (postFormat.value == 'کتاب') {
        bookTR1.hidden = false;
        bookTR2.hidden = false;
        publisherTD.colspan = 3;
        thesisTR1.hidden = true;
        thesisTR2.hidden = true;
        var selectElement = document.querySelector('#publisher');
        selectElement.style.width = '100% !important';

    } else if (postFormat.value == 'پایان نامه') {
        thesisTR1.hidden = false;
        thesisTR2.hidden = false;
        bookTR1.hidden = true;
        bookTR2.hidden = true;
    }
}

document.getElementById("research_type").onchange = function () {
    if (research_type.value == 'تک رشته ای') {
        scientificGroup1TH.hidden = false;
        scientificGroup1TD.hidden = false;
        scientificGroup2TH.hidden = true;
        scientificGroup2TD.hidden = true;
    } else if (research_type.value == 'چند رشته ای') {
        scientificGroup1TH.hidden = false;
        scientificGroup1TD.hidden = false;
        scientificGroup2TH.hidden = false;
        scientificGroup2TD.hidden = false;
    }
}

properties.addEventListener("change", function () {
    const wordCount = document.getElementById("wordCount");
    if (properties.value.length > 0) {
        const text = properties.value.trim();
        const words = text.split(/\s+/);
        let wordCountValue = words.length;
    } else {
        let wordCountValue = 0;
    }

    wordCount.textContent = "تعداد کلمات: " + wordCountValue;
});

document.getElementById("activityType").onchange = function () {
    const cooperatorsTable = document.getElementById("cooperatorsTable");
    if (activityType.value == 'فردی') {
        cooperatorsTable.hidden = true;
    } else if (activityType.value == 'مشترک') {
        cooperatorsTable.hidden = false;
    }
}


document.getElementById("proceedings_file").onchange = function () {
    var proceedings_file_label = document.getElementById("proceedings_file_label");
    if (proceedings_file.value.length !== 0) {
        proceedings_file_label.innerHTML = this.value.replace(/.*[\/\\]/, '');
    }
}
document.getElementById("post_file").onchange = function () {
    var post_file_label = document.getElementById("post_file_label");
    if (post_file.value.length !== 0) {
        post_file_label.innerHTML = this.value.replace(/.*[\/\\]/, '');
    }
}

document.getElementById("postDeliveryMethod").onchange = function () {
    if (postDeliveryMethod.value == 'digital') {
        filesTR.hidden = false;
        if (postFormat.value == 'پایان نامه') {
            thesisFileTH.hidden = false;
            thesisFileTD.hidden = false;
        }
    } else if (postDeliveryMethod.value == 'physical') {
        filesTR.hidden = true;
    }
}
document.getElementById("NewPostForm").addEventListener("submit", function (event) {
    event.preventDefault();

    // دریافت اطلاعات فرم
    var formData = $("#NewPostForm").serialize();
    var postName = $("#postName").val();
    var science_rank = $("#science_rank").val();
    console.log(science_rank);

    // ارسال اطلاعات به سمت سرور
    // $.ajax({
    //     url: "build/php/inc/Add_Post.php",
    //     method: "POST",
    //     data: formData,
    //     success: function(response) {
    //         // عملیات موفقیت‌آمیز
    //         console.log(response);
    //         // انجام دیگر عملیات مورد نیاز
    //     },
    //     error: function(xhr, status, error) {
    //         // خطا در ارسال درخواست
    //         console.log(xhr.responseText);
    //     }
    // });
});