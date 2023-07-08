function sortingG1(postID, groupName) {
    $.ajax({
        url: "build/php/inc/Sorting.php",
        type: "POST",
        data: {
            work: "sortG1",
            postID: postID,
            groupName: groupName
        },
        success: function (response) {
            console.log(response);
            if (response === 'err') {
                alert('خطا در ثبت گونه بندی.');
            }
        }
    });
}

function sortingG2(postID, groupName, selectionID) {
    $.ajax({
        url: "build/php/inc/Sorting.php",
        type: "POST",
        data: {
            work: "sortG2",
            postID: postID,
            groupName: groupName
        },
        success: function (response) {
            if (response === 'err') {
                alert('خطا در ثبت گونه بندی.');
            } else if (response === 'EqualGroups') {
                alert('گروه اول با دوم نمی تواند برابر باشد.');
                return false;
            }
        }
    });
}

document.getElementById('SortingClassificationFile').onchange = function () {
    SortingClassificationFileLabel.innerText = this.value.split('\\').pop();
}

var buttons = document.getElementsByClassName('forApprove');

for (var i = 0; i < buttons.length; i++) {
    (function (index) {
        buttons[index].addEventListener('click', function () {
            if (confirm("پس از تایید شما، گروه ها ثابت خواهند شد و دیگر امکان ویرایش وجود ندارد." +
                "\n" +
                " آیا مطمئن هستید؟")) {
                var rowNumber = index + 1;
                this.remove();
                var button = document.createElement('button');
                button.innerText = 'تایید شد';
                button.classList.add('btn', 'btn-success');
                var container = document.getElementById('buttonTD' + rowNumber);
                container.classList.add('text-center');
                container.appendChild(button);

                var groupSelect1 = document.getElementById('groupSelect1_' + rowNumber);
                var labelG1 = document.createElement('label');
                labelG1.innerText = groupSelect1.options[groupSelect1.selectedIndex].text;
                var group1TD = document.getElementById('group1TD_' + rowNumber);
                group1TD.appendChild(labelG1);

                var groupSelect2 = document.getElementById('groupSelect2_' + rowNumber);
                var labelG2 = document.createElement('label');
                labelG2.innerText = groupSelect2.options[groupSelect2.selectedIndex].text;
                var group2TD = document.getElementById('group2TD_' + rowNumber);
                if (groupSelect2.value !== null && groupSelect2.value !== '' && groupSelect2.value !== 'انتخاب کنید') {
                    group2TD.appendChild(labelG2);
                }

                groupSelect1.remove();
                groupSelect2.remove();

                var postID = this.value;
                $.ajax({
                    url: "build/php/inc/Sorting.php",
                    type: "POST",
                    data: {
                        work: "approveSort",
                        postID: postID
                    },
                    success: function (response) {
                        if (response === 'err') {
                            alert('خطا در تایید.');
                        }
                    }
                });
            }
        });
    })(i);
}

document.getElementById("SortingClassificationForm").addEventListener("submit", function (event) {
    event.preventDefault();
    if (SortingClassificationFile.value) {
        if (confirm('توجه داشته باشید: پس از تایید شما تمامی آثاری که برای گونه بندی تایید کرده اید به مرحله اجمالی راه خواهند یافت. این عملیات قابل بازگشت نیست.' +
            '\n' +
            ' آیا مطمئن هستید؟')) {
            var formData = new FormData();
            let SortingClassificationFile = document.getElementById('SortingClassificationFile');
            formData.append("SortingClassificationFile", SortingClassificationFile.files[0]);
            $.ajax({
                url: "build/php/inc/Sorting.php",
                method: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    if (response === 'ErrorForSubmittingFile') {
                        alert('خطا در دریافت/ثبت فایل صورتجلسه');
                        return false;
                    } else {
                        alert('فایل تاییدیه با موفقیت بارگزاری شد. صفحه مجددا بارگزاری خواهد شد.')
                        location.reload();
                    }
                },
                error: function (xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        }
    } else {
        alert('فایل انتخاب نشده است.');
        return false;
    }
});
