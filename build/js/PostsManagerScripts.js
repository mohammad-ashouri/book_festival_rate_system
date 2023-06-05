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
        var inputs = lastRow.find("input");
        var isRowValid = true;

        inputs.each(function () {
            if ($(this).val().trim() === '') {
                isRowValid = false;
                alert('لطفاً تمامی فیلدها را پر کنید');
                return false;
            }
        });

        var percentageInputs = $("input[id^='coopPer']");
        var totalPercentage = 0;
        percentageInputs.each(function () {
            var percentageValue = parseInt($(this).val());
            if (percentageValue === 0) {
                alert('درصد همکاری نمی تواند 0 باشد.');
                isRowValid = false;
            }else if (percentageValue <= 0) {
                alert('درصد همکاری نمی تواند کمتر از 0 باشد.');
                isRowValid = false;
            }
            totalPercentage += percentageValue;

        });
        alert(totalPercentage);
        if (totalPercentage > 50) {
            alert('جمع مقادیر درصد همکاری نمی تواند بیشتر از 50 باشد');
            isRowValid = false;
            return false;
        }
        else if (totalPercentage < 0) {
            alert('جمع مقادیر درصد همکاری نمی تواند کمتر از 0 باشد');
            isRowValid = false;
            return false;
        }else if (isRowValid) {
            var clonedRow = lastRow.clone();
            clonedRow.find("td:first").text(rowCounter);
            clonedRow.find("td input").val("");
            var deleteButton = $("<button class='deleteRowButton btn btn-danger'>حذف</button>");
            clonedRow.find("td:last").empty().append(deleteButton);
            lastRow.after(clonedRow);
            rowCounter++;
            updateRowIds();
        }
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

document.getElementById("thesisCertificateNumber").oninput = function () {
    let checkCertificateP = document.getElementById("checkCertificateP");
    if (isNaN(thesisCertificateNumber.value)){
        alert('مقدار عددی وارد کنید.');
        thesisCertificateNumber.value="";
        return false;
    }else{
        $.ajax({
            url: "build/ajax/SearchInputs.php",
            method: "POST",
            data: {
                'work':'thesisCertificateNumberCheck',
                'data':thesisCertificateNumber.value
            },
            success: function (response) {
                if (response==='Wrong'){
                    checkCertificateP.innerText = "شماره گواهی وارد شده تکراری می باشد.";
                    checkCertificateP.style.color = "red";
                    Add_Post.hidden=true;
                }else{
                    checkCertificateP.innerText = "شماره گواهی قابل ثبت می باشد.";
                    checkCertificateP.style.color = "green";
                    Add_Post.hidden=false;
                }
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
    }
}

document.getElementById("activityType").onchange = function () {
    const cooperatorsTable = document.getElementById("cooperatorsTable");
    if (activityType.value === 'فردی') {
        cooperatorsTable.hidden = true;
        addRowButton.hidden = true;
    } else if (activityType.value === 'مشترک') {
        addRowButton.hidden = false;
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
    var formData = new FormData();
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
        formData.append("publisher", publisher);
        formData.append("ISSN", ISSN);
        formData.append("numberOfCovers", numberOfCovers);
        formData.append("circulation", circulation);
        formData.append("bookSize", bookSize);

    } else if (postFormat === 'پایان نامه') {
        var thesisCertificateNumber = $("#thesisCertificateNumber").val();
        var thesisDefencePlace = $("#thesisDefencePlace").val();
        var thesisGrade = $("#thesisGrade").val();
        var thesisSupervisor = $("#thesisSupervisor").val();
        var thesisAdvisor = $("#thesisAdvisor").val();
        formData.append("thesisCertificateNumber", thesisCertificateNumber);
        formData.append("thesisDefencePlace", thesisDefencePlace);
        formData.append("thesisGrade", thesisGrade);
        formData.append("thesisSupervisor", thesisSupervisor);
        formData.append("thesisAdvisor", thesisAdvisor);
    }

    if (research_type === 'چند رشته ای') {
        var scientificGroup2 = $("#scientificGroup2").val();
        formData.append("scientificGroup2", scientificGroup2);
    }

    if (activityType === 'مشترک') {
        $("#postTable tbody tr").each(function () {
            var row = $(this);
            var postData = {
                'coopName': row.find('td:eq(1) input').val(),
                'coopFamily': row.find('td:eq(2) input').val(),
                'coopNationalCode': row.find('td:eq(3) input').val(),
                'coopCode': row.find('td:eq(4) input').val(),
                'coopPer': row.find('td:eq(5) input').val(),
                'coopMobile': row.find('td:eq(6) input').val(),
            };
            formData.append('postData[]', JSON.stringify(postData));
        });
    }

    if (postDeliveryMethod === 'digital') {
        if (post_file.value.length === 0) {
            alert('فایل اثر انتخاب نشده است.');
            return false;
        }
        if (postFormat === 'پایان نامه' && proceedings_file.value.length === 0) {
            alert('فایل صورتجلسه انتخاب نشده است.');
            return false;
        }
    }

    //Person Info
    var fName = $("#fName").val();
    var lName = $("#lName").val();
    var national_code = $("#national_code").val();
    var mobile = $("#mobile").val();
    var gender = $("#gender").val();
    var shparvandetahsili = $("#shparvandetahsili").val();

    formData.append("postName", postName);
    formData.append("postFormat", postFormat);
    formData.append("language", language);
    formData.append("postType", postType);
    formData.append("pagesNumber", pagesNumber);
    formData.append("specialSection", specialSection);
    formData.append("properties", properties);
    formData.append("research_type", research_type);
    formData.append("scientificGroup1", scientificGroup1);
    formData.append("activityType", activityType);
    formData.append("postDeliveryMethod", postDeliveryMethod);
    formData.append("fName", fName);
    formData.append("lName", lName);
    formData.append("national_code", national_code);
    formData.append("gender", gender);
    formData.append("mobile", mobile);
    formData.append("shparvandetahsili", shparvandetahsili);
    formData.append("post_file", post_file.files[0]);
    formData.append("proceedings_file", proceedings_file.files[0]);

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
    } else if (postFormat === 'کتاب' && !publisher) {
        alert('ناشر انتخاب نشده است.');
        return false;
    } else if (postFormat === 'کتاب' && numberOfCovers === "") {
        alert('تعداد جلد وارد نشده است.');
        return false;
    } else if (postFormat === 'کتاب' && circulation === "") {
        alert('تیراژ وارد نشده است.');
        return false;
    } else if (postFormat === 'کتاب' && !bookSize) {
        alert('قطع انتخاب نشده است.');
        return false;
    } else if (postFormat === 'پایان نامه' && thesisCertificateNumber === "") {
        alert('شماره گواهی دفاع پایان نامه وارد نشده است.');
        return false;
    } else if (postFormat === 'پایان نامه' && thesisDefencePlace === "") {
        alert('محل دفاع وارد نشده است.');
        return false;
    } else if (postFormat === 'پایان نامه' && thesisGrade === "") {
        alert('امتیاز پایان نامه وارد نشده است.');
        return false;
    } else if (postFormat === 'پایان نامه' && thesisSupervisor === "") {
        alert('مشخصات استاد راهنما وارد نشده است.');
        return false;
    } else if (postFormat === 'پایان نامه' && thesisAdvisor === "") {
        alert('مشخصات استاد مشاور وارد نشده است.');
        return false;
    } else if (pagesNumber === "") {
        alert('شمارگان صفحه وارد نشده است.');
        return false;
    } else if (!research_type) {
        alert('نوع تحقیق انتخاب نشده است.');
        return false;
    } else if (research_type === "تک رشته ای" && !scientificGroup1) {
        alert('گروه علمی اول انتخاب نشده است.');
        return false;
    } else if (research_type === 'چند رشته ای' && !scientificGroup1) {
        alert('گروه علمی اول انتخاب نشده است.');
        return false;
    } else if (research_type === 'چند رشته ای' && !scientificGroup2) {
        alert('گروه علمی دوم انتخاب نشده است.');
        return false;
    } else if (research_type === 'چند رشته ای' && scientificGroup1 === scientificGroup2) {
        alert('گروه علمی اول و دوم با هم برابر می باشد.')
        return false;
    } else if (!activityType) {
        alert('نوع همکاری انتخاب نشده است.')
        return false;
    } else if (!postDeliveryMethod) {
        alert('نحوه تحویل اثر انتخاب نشده است.')
        return false;
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
    } else if (!gender) {
        alert('جنسیت صاحب اثر انتخاب نشده است.')
        return false;
    } else {
        if (confirm('اطلاعات وارد شده قابل تغییر نیست. آیا مطمئن هستید؟')) {
            $.ajax({
                url: "build/php/inc/Add_Post.php",
                method: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    alert('اثر جدید با موفقیت اضافه شد.');
                    console.log(response);
                    location.reload();
                },
                error: function (xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        }
    }
})
;







document.getElementById("showPosts").onsubmit = function () {
    var festival = document.getElementById('festival');
    if (festival.value==="" || festival.value==='انتخاب کنید' || festival.value===null){
        alert('لطفا جشنواره را انتخاب نمایید.');
        return false;
    }else{
        return true;
    }
}