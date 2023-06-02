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
    if (postFormat.value === 'کتاب') {
        bookTR1.hidden = false;
        bookTR2.hidden = false;
        publisherTD.colspan = 3;
        thesisTR1.hidden = true;
        thesisTR2.hidden = true;
        var selectElement = document.querySelector('#publisher');
        selectElement.style.width = '100% !important';

    } else if (postFormat.value === 'پایان نامه') {
        thesisTR1.hidden = false;
        thesisTR2.hidden = false;
        bookTR1.hidden = true;
        bookTR2.hidden = true;
    }
}

document.getElementById("research_type").onchange = function () {
    if (research_type.value === 'تک رشته ای') {
        scientificGroup1TH.hidden = false;
        scientificGroup1TD.hidden = false;
        scientificGroup2TH.hidden = true;
        scientificGroup2TD.hidden = true;
    } else if (research_type.value === 'چند رشته ای') {
        scientificGroup1TH.hidden = false;
        scientificGroup1TD.hidden = false;
        scientificGroup2TH.hidden = false;
        scientificGroup2TD.hidden = false;
    }
}

properties.addEventListener("input", function () {
    const wordCount = document.getElementById("wordCount");
    if (properties.value === "") {
        wordCount.textContent = "تعداد کلمات: " + 0;
    } else {
        const text = properties.value.trim();
        const words = text.split(/\s+/);
        let wordCountValue = words.length;
        wordCount.textContent = "تعداد کلمات: " + wordCountValue;
    }

});

document.getElementById("activityType").onchange = function () {
    const cooperatorsTable = document.getElementById("cooperatorsTable");
    if (activityType.value === 'فردی') {
        cooperatorsTable.hidden = true;
    } else if (activityType.value === 'مشترک') {
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
    if (postDeliveryMethod.value === 'digital') {
        filesTR.hidden = false;
        if (postFormat.value === 'پایان نامه') {
            thesisFileTH.hidden = false;
            thesisFileTD.hidden = false;
        }
    } else if (postDeliveryMethod.value === 'physical') {
        filesTR.hidden = true;
    }
}
document.getElementById("NewPostForm").addEventListener("submit", function (event) {
    event.preventDefault();

    var formData = $("#NewPostForm").serialize();
    var postName = $("#postName").val();
    var postFormat = $("#postFormat").val();
    var language = $("#language").val();
    var postType = $("#postType").val();
    var pagesNumber = $("#pagesNumber").val();
    var specialSection = $("#specialSection").val();
    var properties = $("#properties").val();
    var research_type = $("#research_type").val();
    var scientificGroup1 = $("#scientificGroup1").val();
    var activityType = $("#activityType").val();
    var postDeliveryMethod = $("#postDeliveryMethod").val();

    if (postFormat === 'کتاب') {
        var publisher = $("#publisher").val();
        var ISSN = $("#ISSN").val();
        var numberOfCovers = $("#numberOfCovers").val();
        var circulation = $("#circulation").val();
        var bookSize = $("#bookSize").val();

    } else if (postFormat === 'پایان نامه') {
        var thesisCertificateNumber = $("#thesisCertificateNumber").val();
        var thesisDefencePlace = $("#thesisDefencePlace").val();
        var thesisGrade = $("#thesisGrade").val();
        var thesisSupervisor = $("#thesisSupervisor").val();
        var thesisAdvisor = $("#thesisAdvisor").val();
    }

    if (research_type === 'چند رشته ای') {
        var scientificGroup2 = $("#scientificGroup2").val();
    }

    if (activityType === 'مشترک') {

    }

    if (postDeliveryMethod === 'digital') {

    }

    //Person Info
    var fName = $("#fName").val();
    var lName = $("#lName").val();
    var national_code = $("#national_code").val();
    var mobile = $("#mobile").val();
    var shparvandetahsili = $("#shparvandetahsili").val();

    if (!postName) {
        alert('نام اثر وارد نشده است.');
        return false;
    } else if (!postFormat) {
        alert('قالب علمی انتخاب نشده است.');
        return false;
    } else if (!postType) {
        alert('نوع اثر انتخاب نشده است.');
        return false;
    } else if (!language) {
        alert('زبان اثر انتخاب نشده است.');
        return false;
    } else if (postFormat === 'کتاب') {
        if (!publisher) {
            alert('ناشر انتخاب نشده است.');
            return false;
        } else if (numberOfCovers === "") {
            alert('تعداد جلد وارد نشده است.');
            return false;
        } else if (circulation === "") {
            alert('تیراژ وارد نشده است.');
            return false;
        } else if (!bookSize) {
            alert('قطع انتخاب نشده است.');
            return false;
        }
    } else if (postFormat === 'پایان نامه') {
        if (thesisCertificateNumber === "") {
            alert('شماره گواهی دفاع پایان نامه وارد نشده است.');
            return false;
        } else if (thesisDefencePlace === "") {
            alert('محل دفاع وارد نشده است.');
            return false;
        } else if (thesisGrade === "") {
            alert('امتیاز پایان نامه وارد نشده است.');
            return false;
        } else if (thesisSupervisor === "") {
            alert('مشخصات استاد راهنما وارد نشده است.');
            return false;
        } else if (thesisAdvisor === "") {
            alert('مشخصات استاد مشاور وارد نشده است.');
            return false;
        }
    } else if (pagesNumber === "") {
        alert('شمارگان صفحه وارد نشده است.');
        return false;
    } else if (!research_type) {
        alert('نوع تحقیق انتخاب نشده است.');
        return false;
    } else if (research_type === "تک رشته ای" && !scientificGroup1) {
        alert('گروه علمی اول انتخاب نشده است.');
        return false;
    } else if (research_type === 'چند رشته ای') {
        if (!scientificGroup1) {
            alert('گروه علمی اول انتخاب نشده است.');
            return false;
        } else if (!scientificGroup2) {
            alert('گروه علمی دوم انتخاب نشده است.');
            return false;
        } else if (scientificGroup1 === scientificGroup2) {
            alert('گروه علمی اول و دوم با هم برابر می باشد.')
            return false;
        }
    } else if (fName === "") {
        alert('نام صاحب اثر وارد نشده است.')
        return false;
    } else if (lName === "") {
        alert('نام خانوادگی صاحب اثر وارد نشده است.')
        return false;
    } else if (national_code === "") {
        alert('کد ملی صاحب اثر وارد نشده است.')
        return false;
    } else if (mobile === "") {
        alert('شماره همراه صاحب اثر وارد نشده است.')
        return false;
    } else {
        $.ajax({
            url: "build/php/inc/Add_Post.php",
            method: "POST",
            data: formData,
            success: function (response) {
                console.log(response);
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
    }


});