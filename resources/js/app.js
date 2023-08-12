import './bootstrap';
import '@fortawesome/fontawesome-free/css/all.css';
import $ from 'jquery';
import Swal from 'sweetalert2';

function swalFire(title = null, text, icon, confirmButtonText) {
    Swal.fire({
        title: title,
        text: text,
        icon: icon,
        confirmButtonText: confirmButtonText,
    });
}

function toggleModal(modalID) {
    var modal = document.getElementById(modalID);
    if (modal.classList.contains('modal-active')) {
        modal.classList.remove('animate-fade-in');
        modal.classList.add('animate-fade-out');
        setTimeout(() => {
            modal.classList.remove('modal-active');
            modal.classList.remove('animate-fade-out');
        }, 150);
    } else {
        modal.classList.add('modal-active');
        modal.classList.remove('animate-fade-out');
        modal.classList.add('animate-fade-in');
    }
}

function hasOnlyPersianCharacters(input) {
    var persianPattern = /^[\u0600-\u06FF\s]+$/;
    return persianPattern.test(input);
}

function hasOnlyEnglishCharacters(input) {
    var englishPattern = /^[a-zA-Z\s]+$/;
    return englishPattern.test(input);
}

function swalFireWithQuestion() {
    Swal.fire({
        title: 'آیا مطمئن هستید؟',
        text: 'این مقدار به صورت دائمی اضافه خواهد شد.',
        icon: 'warning',
        showCancelButton: true,
        cancelButtonText: 'خیر',
        confirmButtonText: 'بله',
    }).then((result) => {
        if (result.isConfirmed) {
            // کدی که برای حالت بله نوشته می‌شود
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            // کدی که برای حالت خیر نوشته می‌شود
        }
    });
}

function hasNumber(text) {
    return /\d/.test(text);
}

function resetFields() {
    const inputs = document.querySelectorAll('input');
    inputs.forEach(input => input.value = "");
    const selectors = document.querySelectorAll('select');
    selectors.forEach(select => select.value = "");
}

$(document).ready(function () {
    resetFields();
    //Check Login Form
    $('#loginForm').submit(function (e) {
        e.preventDefault();

        var form = $(this);
        var url = form.attr('action');
        var data = form.serialize();

        $.ajax({
            type: 'POST',
            url: url,
            data: data,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            success: function (response) {
                if (response.success) {
                    window.location.href = response.redirect;
                } else {
                    if (response.errors.username) {
                        swalFire('خطای نام کاربری', response.errors.username[0], 'error', 'تلاش مجدد');
                        reloadCaptcha();
                        captcha.value = '';
                    }

                    if (response.errors.password) {
                        swalFire('خطای رمز عبور', response.errors.password[0], 'error', 'تلاش مجدد');
                        reloadCaptcha();
                        captcha.value = '';
                    }

                    if (response.errors.captcha) {
                        swalFire('کد امنیتی نامعتبر', response.errors.captcha[0], 'error', 'تلاش مجدد');
                        reloadCaptcha();
                        captcha.value = '';
                    }
                    if (response.errors.loginError) {
                        swalFire('نام کاربری یا رمز عبور نامعتبر', response.errors.loginError[0], 'error', 'تلاش مجدد');
                        reloadCaptcha();
                        captcha.value = '';
                    }
                }
            },
            error: function (xhr, textStatus, errorThrown) {
                if (xhr.responseJSON['YouAreLocked']) {
                    swalFire('دسترسی غیرمجاز', 'آی پی شما به دلیل تعداد درخواست های زیاد بلاک شده است. لطفا یک ساعت دیگر مجددا تلاش کنید.', 'error', 'تایید');
                    const fields = [username, password, captcha];
                    fields.forEach(field => {
                        field.disabled = true;
                        field.value = null;
                        field.style.backgroundColor = 'gray';
                    });
                } else {
                    swalFire('خطای ناشناخته', 'ارتباط با سرور برقرار نشد.', 'error', 'تلاش مجدد');
                    console.clear();
                }

            }
        });
    });
    //Change Password
    $('#change-password').submit(function (e) {
        e.preventDefault();

        var form = $(this);
        var url = form.attr('action');
        var data = form.serialize();

        $.ajax({
            type: 'POST',
            url: url,
            data: data,
            success: function (response) {
                if (response.success) {
                    swalFire('عملیات موفقیت آمیز بود!', response.errors.passwordChanged[0], 'success', 'بستن');
                    oldPass.value = '';
                    newPass.value = '';
                    repeatNewPass.value = '';
                } else {
                    if (response.errors.oldPassNull) {
                        swalFire('خطا!', response.errors.oldPassNull[0], 'error', 'تلاش مجدد');
                    } else if (response.errors.newPassNull) {
                        swalFire('خطا!', response.errors.newPassNull[0], 'error', 'تلاش مجدد');
                    } else if (response.errors.repeatNewPassNull) {
                        swalFire('خطا!', response.errors.repeatNewPassNull[0], 'error', 'تلاش مجدد');
                    } else if (response.errors.lowerThan8) {
                        swalFire('خطا!', response.errors.lowerThan8[0], 'error', 'تلاش مجدد');
                    } else if (response.errors.higherThan12) {
                        swalFire('خطا!', response.errors.higherThan12[0], 'error', 'تلاش مجدد');
                    } else if (response.errors.wrongRepeat) {
                        swalFire('خطا!', response.errors.wrongRepeat[0], 'error', 'تلاش مجدد');
                    } else if (response.errors.wrongPassword) {
                        swalFire('خطا!', response.errors.wrongPassword[0], 'error', 'تلاش مجدد');
                    } else {
                        location.reload();
                    }
                }
            },
            error: function (xhr, textStatus, errorThrown) {
                // console.log(xhr);
            }
        });
    });
    switch (window.location.pathname) {
        case "/UserManager":
            //Search In User Manager
            $('#search-Username-UserManager').on('input', function () {
                var inputUsername = $('#search-Username-UserManager').val().trim().toLowerCase();
                var type = $('#search-type-UserManager').val();
                $.ajax({
                    url: '/Search',
                    type: 'GET',
                    data: {
                        username: inputUsername,
                        type: type,
                        work: 'UserManagerSearch'
                    },
                    success: function (data) {
                        var tableBody = $('.w-full.border-collapse.rounded-lg.overflow-hidden.text-center tbody');
                        tableBody.empty();

                        data.forEach(function (user) {
                            var type;
                            switch (user.type) {
                                case 1:
                                    type = 'ادمین کل';
                                    break;
                                case 5:
                                    type = 'سازمان';
                                    break;
                                case 6:
                                    type = 'باسکول';
                                    break;
                            }
                            var row = '<tr class="bg-white"><td class="px-6 py-4">' + user.id + '</td><td class="px-6 py-4">' + user.name + '</td><td class="px-6 py-4">' + type + '</td>';
                            if (user.active == 1) {
                                row += '<td class="px-6 py-4">' + '<button type="submit" data-username="' + user.username + '" class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 focus:outline-none focus:ring focus:border-blue-300 ASUM" data-active="1">غیرفعال‌سازی</button>';
                            } else if (user.active == 0) {
                                row += '<td class="px-6 py-4">' + '<button type="submit" data-username="' + user.username + '" class="px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600 focus:outline-none focus:ring focus:border-blue-300 ASUM" data-active="0">فعال‌سازی</button>';
                            }
                            row += '</td>';
                            if (user.NTCP == 1) {
                                row += '<td class="px-6 py-4">' + '<button type="submit" data-ntcp-username="' + user.username + '" class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 focus:outline-none focus:ring focus:border-blue-300 ntcp" data-ntcp="1">می باشد</button>';
                            } else if (user.NTCP == 0) {
                                row += '<td class="px-6 py-4">' + '<button type="submit" data-ntcp-username="' + user.username + '" class="px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600 focus:outline-none focus:ring focus:border-blue-300 ntcp" data-ntcp="0">نمی باشد</button>';
                            }
                            row += '</td>';
                            row += '<td class="px-6 py-4">' + '<button type="submit" data-rp-username="' + user.username + '" class="px-4 py-2 p-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring focus:border-blue-300 rp">بازنشانی رمز</button>';
                            row += '</td>';
                            row += '</tr>';
                            tableBody.append(row);
                        });
                    },
                    error: function () {
                        console.log('خطا در ارتباط با سرور');
                    }
                });
            });
            $('#search-type-UserManager').on('change', function () {
                var inputUsername = $('#search-Username-UserManager').val().trim().toLowerCase();
                var type = $('#search-type-UserManager').val();
                $.ajax({
                    url: '/Search',
                    type: 'GET',
                    data: {
                        username: inputUsername,
                        type: type,
                        work: 'UserManagerSearch'
                    },
                    success: function (data) {
                        var tableBody = $('.w-full.border-collapse.rounded-lg.overflow-hidden.text-center tbody');
                        tableBody.empty();

                        data.forEach(function (user) {
                            var type;
                            switch (user.type) {
                                case 1:
                                    type = 'ادمین کل';
                                    break;
                                case 2:
                                    type = 'کارشناس سامانه';
                                    break;
                                case 3:
                                    type = 'مدیر گروه';
                                    break;
                                case 4:
                                    type = 'ارزیاب';
                                    break;
                            }
                            var row = '<tr class="bg-white"><td class="px-6 py-4">' + user.id + '</td><td class="px-6 py-4">' + user.name + '</td><td class="px-6 py-4">' + type + '</td>';
                            if (user.active == 1) {
                                row += '<td class="px-6 py-4">' + '<button type="submit" data-username="' + user.username + '" class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 focus:outline-none focus:ring focus:border-blue-300 ASUM" data-active="1">غیرفعال‌سازی</button>';
                            } else if (user.active == 0) {
                                row += '<td class="px-6 py-4">' + '<button type="submit" data-username="' + user.username + '" class="px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600 focus:outline-none focus:ring focus:border-blue-300 ASUM" data-active="0">فعال‌سازی</button>';
                            }
                            row += '</td>';
                            if (user.NTCP == 1) {
                                row += '<td class="px-6 py-4">' + '<button type="submit" data-ntcp-username="' + user.username + '" class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 focus:outline-none focus:ring focus:border-blue-300 ntcp" data-ntcp="1">می باشد</button>';
                            } else if (user.NTCP == 0) {
                                row += '<td class="px-6 py-4">' + '<button type="submit" data-ntcp-username="' + user.username + '" class="px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600 focus:outline-none focus:ring focus:border-blue-300 ntcp" data-ntcp="0">نمی باشد</button>';
                            }
                            row += '</td>';
                            row += '<td class="px-6 py-4">' + '<button type="submit" data-rp-username="' + user.username + '" class="px-4 py-2 p-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring focus:border-blue-300 rp">بازنشانی رمز</button>';
                            row += '</td>';
                            row += '</tr>';
                            tableBody.append(row);
                        });
                    },
                    error: function () {
                        console.log('خطا در ارتباط با سرور');
                    }
                });
            });
            //Activation Status In User Manager
            $(document).on('click', '.ASUM', function (e) {
                const username = $(this).data('username');
                const active = $(this).data('active');
                let status = null;
                if (active == 1) {
                    status = 'غیرفعال';
                } else if (active == 0) {
                    status = 'فعال';
                }
                e.preventDefault();
                Swal.fire({
                    title: 'آیا مطمئن هستید؟',
                    text: 'کاربر انتخاب شده ' + status + ' خواهد شد.',
                    icon: 'warning',
                    showCancelButton: true,
                    cancelButtonText: 'خیر',
                    confirmButtonText: 'بله',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: 'POST',
                            url: '/ChangeUserActivationStatus',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                            },
                            data: {
                                username: username,
                            },
                            success: function (response) {
                                if (response.success) {
                                    swalFire('عملیات موفقیت آمیز بود!', response.message.changedUserActivation[0], 'success', 'بستن');
                                    const activeButton = $(`button[data-username="${username}"]`);
                                    if (active == 1) {
                                        activeButton.removeClass('bg-red-500').addClass('bg-green-500');
                                        activeButton.removeClass('hover:bg-red-600').addClass('hover:bg-green-600');
                                        activeButton.text('فعال‌سازی');
                                        activeButton.data('active', 0);
                                    } else if (active == 0) {
                                        activeButton.removeClass('bg-green-500').addClass('bg-red-500');
                                        activeButton.removeClass('hover:bg-green-600').addClass('hover:bg-red-600');
                                        activeButton.text('غیرفعال‌سازی');
                                        activeButton.data('active', 1);
                                    }
                                } else {
                                    swalFire('خطا!', response.errors.changedUserActivationFailed[0], 'error', 'تلاش مجدد');
                                }
                            }
                        });
                    }
                });
            });
            //NTCP Status In User Manager
            $(document).on('click', '.ntcp', function (e) {
                const username = $(this).data('ntcp-username');
                const NTCP = $(this).data('ntcp');
                let status = null;
                if (NTCP == 1) {
                    status = 'نمی باشد';
                } else if (NTCP == 0) {
                    status = 'می باشد';
                }
                e.preventDefault();
                Swal.fire({
                    title: 'آیا مطمئن هستید؟',
                    text: 'کاربر انتخاب شده نیازمند تغییر رمزعبور ' + status + '؟',
                    icon: 'warning',
                    showCancelButton: true,
                    cancelButtonText: 'خیر',
                    confirmButtonText: 'بله',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: 'POST',
                            url: '/ChangeUserNTCP',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                            },
                            data: {
                                username: username,
                            },
                            success: function (response) {
                                if (response.success) {
                                    swalFire('عملیات موفقیت آمیز بود!', response.message.changedUserNTCP[0], 'success', 'بستن');
                                    const ntcpButton = $(`button[data-ntcp-username="${username}"]`);
                                    if (NTCP == 1) {
                                        ntcpButton.removeClass('bg-red-500').addClass('bg-green-500');
                                        ntcpButton.removeClass('hover:bg-red-600').addClass('hover:bg-green-600');
                                        ntcpButton.text('نمی باشد');
                                        ntcpButton.data('ntcp', 0);
                                    } else if (NTCP == 0) {
                                        ntcpButton.removeClass('bg-green-500').addClass('bg-red-500');
                                        ntcpButton.removeClass('hover:bg-green-600').addClass('hover:bg-red-600');
                                        ntcpButton.text('می باشد');
                                        ntcpButton.data('ntcp', 1);
                                    }
                                } else {
                                    swalFire('خطا!', response.errors.changedUserNTCPFailed[0], 'error', 'تلاش مجدد');
                                }
                            }
                        });
                    }
                });
            });
            //Hide Or Showing scientific_groupDIV
            $(document).on('change', '#type', function (e) {
                if (type.value == 3 || type.value == 4) {
                    scientific_groupDIV.hidden = false;
                    scientific_group.value = "";
                } else {
                    scientific_groupDIV.hidden = true;
                    scientific_group.value = "";
                }
            });
            $(document).on('change', '#editedType', function (e) {
                if (editedType.value == 3 || editedType.value == 4) {
                    editedscientific_groupDIV.hidden = false;
                    scientific_group.value = "";
                } else {
                    editedscientific_groupDIV.hidden = true;
                    scientific_group.value = "";
                }
            });
            //Reset Password In User Manager
            $(document).on('click', '.rp', function (e) {
                const username = $(this).data('rp-username');
                let status = null;

                e.preventDefault();
                Swal.fire({
                    title: 'آیا مطمئن هستید؟',
                    text: 'رمز عبور کاربر انتخاب شده به 12345678 بازنشانی خواهد شد.',
                    icon: 'warning',
                    showCancelButton: true,
                    cancelButtonText: 'خیر',
                    confirmButtonText: 'بله',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: 'POST',
                            url: '/ResetPassword',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                            },
                            data: {
                                username: username,
                            },
                            success: function (response) {
                                if (response.success) {
                                    swalFire('عملیات موفقیت آمیز بود!', response.message.passwordResetted[0], 'success', 'بستن');
                                } else {
                                    swalFire('خطا!', response.errors.resetPasswordFailed[0], 'error', 'تلاش مجدد');
                                }
                            }
                        });
                    }
                });
            });
            //Showing Or Hiding Modal
            $('#new-user-button, #cancel-new-user').on('click', function () {
                toggleModal(newUserModal.id);
            });
            $('#edit-user-button, #cancel-edit-user').on('click', function () {
                toggleModal(editUserModal.id);
            });
            //New User
            $('#new-user').submit(function (e) {
                e.preventDefault();
                var name = document.getElementById('name').value;
                var family = document.getElementById('family').value;
                var username = document.getElementById('username').value;
                var password = document.getElementById('password').value;
                var type = document.getElementById('type').value;
                var scientific_group = document.getElementById('scientific_group').value;

                if (name.length === 0) {
                    swalFire('خطا!', 'نام وارد نشده است.', 'error', 'تلاش مجدد');
                } else if (family.length === 0) {
                    swalFire('خطا!', 'نام وارد نشده است.', 'error', 'تلاش مجدد');
                } else if (!hasOnlyPersianCharacters(name)) {
                    swalFire('خطا!', 'نام نمی تواند مقدار غیر از کاراکتر فارسی یا عدد داشته باشد.', 'error', 'تلاش مجدد');
                } else if (!hasOnlyPersianCharacters(family)) {
                    swalFire('خطا!', 'نام خانوادگی نمی تواند مقدار غیر از کاراکتر فارسی یا عدد داشته باشد.', 'error', 'تلاش مجدد');
                } else if (username.length === 0) {
                    swalFire('خطا!', 'نام کاربری وارد نشده است.', 'error', 'تلاش مجدد');
                } else if (password.length === 0) {
                    swalFire('خطا!', 'رمز عبور وارد نشده است.', 'error', 'تلاش مجدد');
                } else if (type.length === 0) {
                    swalFire('خطا!', 'نوع کاربری انتخاب نشده است.', 'error', 'تلاش مجدد');
                } else if ((type == '3' || type == '4') && scientific_group == '') {
                    swalFire('خطا!', 'گروه علمی انتخاب نشده است.', 'error', 'تلاش مجدد');
                } else if (hasOnlyPersianCharacters(username)) {
                    swalFire('خطا!', 'نام کاربری نمی تواند مقدار فارسی داشته باشد.', 'error', 'تلاش مجدد');
                } else if (hasOnlyPersianCharacters(password)) {
                    swalFire('خطا!', 'رمز عبور نمی تواند مقدار فارسی داشته باشد.', 'error', 'تلاش مجدد');
                } else {
                    var form = $(this);
                    var data = form.serialize();

                    $.ajax({
                        type: 'POST',
                        url: '/NewUser',
                        data: data,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        },
                        success: function (response) {
                            if (response.errors && response.errors.userFounded) {
                                swalFire('خطا!', response.errors.userFounded[0], 'error', 'تلاش مجدد');
                            } else if (response.success) {
                                swalFire('عملیات موفقیت آمیز بود!', response.message.userAdded[0], 'success', 'بستن');
                                toggleModal(newUserModal.id);
                                resetFields();
                            }

                        }
                    });
                }
            });
            //Getting User Information
            $('#userIdForEdit').change(function (e) {
                e.preventDefault();
                if (userIdForEdit.value === null || userIdForEdit.value === '') {
                    swalFire('خطا!', 'کاربر انتخاب نشده است.', 'error', 'تلاش مجدد');
                } else {
                    $.ajax({
                        type: 'GET',
                        url: '/GetUserInfo',
                        data: {
                            userID: userIdForEdit.value
                        },
                        success: function (response) {
                            userEditDiv.hidden = false;
                            editedName.value = response.name;
                            editedFamily.value = response.family;
                            editedType.value = response.type;
                            if (response.type == 3 || response.type == 4) {
                                editedscientific_group.value = response.scientific_group;
                                editedscientific_groupDIV.hidden = false;
                            } else {
                                editedscientific_group.value = "";
                                editedscientific_groupDIV.hidden = true;
                            }
                        }
                    });
                }
            });
            //Edit User
            $('#edit-user').submit(function (e) {
                e.preventDefault();
                var userID = userIdForEdit.value;
                var name = editedName.value;
                var family = editedFamily.value;
                var type = editedType.value;

                if (name.length === 0) {
                    swalFire('خطا!', 'نام وارد نشده است.', 'error', 'تلاش مجدد');
                } else if (family.length === 0) {
                    swalFire('خطا!', 'نام خانوادگی وارد نشده است.', 'error', 'تلاش مجدد');
                } else if (!hasOnlyPersianCharacters(name)) {
                    swalFire('خطا!', 'نام نمی تواند مقدار غیر از کاراکتر فارسی یا عدد داشته باشد.', 'error', 'تلاش مجدد');
                } else if (!hasOnlyPersianCharacters(family)) {
                    swalFire('خطا!', 'نام نمی تواند مقدار غیر از کاراکتر فارسی یا عدد داشته باشد.', 'error', 'تلاش مجدد');
                } else if (userID.length === 0) {
                    swalFire('خطا!', 'کاربر انتخاب نشده است.', 'error', 'تلاش مجدد');
                } else if (type.length === 0) {
                    swalFire('خطا!', 'نوع کاربری انتخاب نشده است.', 'error', 'تلاش مجدد');
                } else if ((type === 3 || type === 4) && editedscientific_group.value == null) {
                    swalFire('خطا!', 'گروه علمی انتخاب نشده است.', 'error', 'تلاش مجدد');
                } else {
                    var form = $(this);
                    var data = form.serialize();

                    $.ajax({
                        type: 'POST',
                        url: '/EditUser',
                        data: data,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        },
                        success: function (response) {
                            if (response.errors && response.errors.userFounded) {
                                swalFire('خطا!', response.errors.userFounded[0], 'error', 'تلاش مجدد');
                            } else if (response.success) {
                                swalFire('عملیات موفقیت آمیز بود!', response.message.userEdited[0], 'success', 'بستن');
                                toggleModal(editUserModal.id);
                                resetFields();
                            }

                        }
                    });
                }
            });
            break;
        case '/Person':
            $('#new-person-button, #cancel-new-person').on('click', function () {
                toggleModal(newPersonModal.id);
            });
            $('.absolute.inset-0.bg-gray-500.opacity-75.add').on('click', function () {
                toggleModal(newPersonModal.id)
            });
            $('.absolute.inset-0.bg-gray-500.opacity-75.edit').on('click', function () {
                toggleModal(editPersonModal.id)
            });
            $('.PersonControl,#cancel-edit-person').on('click', function () {
                toggleModal(editPersonModal.id);
            });
            $('#new-person').on('submit', function (e) {
                e.preventDefault();
                Swal.fire({
                    title: 'آیا مطمئن هستید؟',
                    text: 'این مقدار به صورت دائمی اضافه خواهد شد.',
                    icon: 'warning',
                    showCancelButton: true,
                    cancelButtonText: 'خیر',
                    confirmButtonText: 'بله',
                }).then((result) => {
                    if (result.isConfirmed) {
                        var form = $(this);
                        var data = form.serialize();
                        $.ajax({
                            type: 'POST',
                            url: '/newPerson',
                            data: data,
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                            },
                            success: function (response) {
                                if (response.errors) {
                                    if (response.errors.nullName) {
                                        swalFire('خطا!', response.errors.nullName[0], 'error', 'تلاش مجدد');
                                    } else if (response.errors.nullFamily) {
                                        swalFire('خطا!', response.errors.nullFamily[0], 'error', 'تلاش مجدد');
                                    } else if (response.errors.nullNationalCode) {
                                        swalFire('خطا!', response.errors.nullNationalCode[0], 'error', 'تلاش مجدد');
                                    } else if (response.errors.wrongNationalCode) {
                                        swalFire('خطا!', response.errors.wrongNationalCode[0], 'error', 'تلاش مجدد');
                                    } else if (response.errors.nullGender) {
                                        swalFire('خطا!', response.errors.nullGender[0], 'error', 'تلاش مجدد');
                                    } else if (response.errors.nullMobile) {
                                        swalFire('خطا!', response.errors.nullMobile[0], 'error', 'تلاش مجدد');
                                    } else if (response.errors.wrongMobile) {
                                        swalFire('خطا!', response.errors.wrongMobile[0], 'error', 'تلاش مجدد');
                                    } else if (response.errors.dupNationalCode) {
                                        swalFire('خطا!', response.errors.dupNationalCode[0], 'error', 'تلاش مجدد');
                                    }
                                } else if (response.success) {
                                    swalFire('ثبت اطلاعات صاحب اثر موفقیت آمیز بود!', response.message.PersonAdded[0], 'success', 'بستن');
                                    toggleModal(newPersonModal.id);
                                    resetFields();
                                }
                            }
                        });
                    }
                });
            });
            $('.PersonControl').on('click', function () {
                $.ajax({
                    type: 'GET',
                    url: '/getPersonInfo',
                    data: {
                        id: $(this).data('id')
                    },
                    success: function (response) {
                        if (response) {
                            personID.value = response.id;
                            nameForEdit.value = response.name;
                            familyForEdit.value = response.family;
                            national_codeForEdit.value = response.national_code;
                            mobileForEdit.value = response.mobile;
                            genderForEdit.value = response.gender;
                            howzah_codeForEdit.value = response.howzah_code;
                        }
                    }
                });
            });
            $('#edit-person').on('submit', function (e) {
                e.preventDefault();
                Swal.fire({
                    title: 'آیا مطمئن هستید؟',
                    text: 'با ویرایش این مقدار، تمامی فیلدها تغییر خواهند کرد.',
                    icon: 'warning',
                    showCancelButton: true,
                    cancelButtonText: 'خیر',
                    confirmButtonText: 'بله',
                }).then((result) => {
                    if (result.isConfirmed) {
                        var form = $(this);
                        var data = form.serialize();
                        $.ajax({
                            type: 'POST',
                            url: '/editPerson',
                            data: data,
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                            },
                            success: function (response) {
                                if (response.errors) {
                                    if (response.errors.nullName) {
                                        swalFire('خطا!', response.errors.nullName[0], 'error', 'تلاش مجدد');
                                    } else if (response.errors.nullFamily) {
                                        swalFire('خطا!', response.errors.nullFamily[0], 'error', 'تلاش مجدد');
                                    } else if (response.errors.nullGender) {
                                        swalFire('خطا!', response.errors.nullGender[0], 'error', 'تلاش مجدد');
                                    } else if (response.errors.nullMobile) {
                                        swalFire('خطا!', response.errors.nullMobile[0], 'error', 'تلاش مجدد');
                                    } else if (response.errors.wrongMobile) {
                                        swalFire('خطا!', response.errors.wrongMobile[0], 'error', 'تلاش مجدد');
                                    }
                                } else if (response.success) {
                                    swalFire('ویرایش صاحب اثر موفقیت آمیز بود!', response.message.personEdited[0], 'success', 'بستن');
                                    toggleModal(editPersonModal.id);
                                    resetFields();
                                }
                            }
                        });
                    }
                });
            });
            break;
        case '/Posts':
            $('#new-post-button, #cancel-new-post').on('click', function () {
                toggleModal(newPostModal.id);
            });
            $('.absolute.inset-0.bg-gray-500.opacity-75.add').on('click', function () {
                toggleModal(newPostModal.id)
            });
            $('.absolute.inset-0.bg-gray-500.opacity-75.edit').on('click', function () {
                toggleModal(editPostModal.id)
            });
            $('.PostControl,#cancel-edit-post').on('click', function () {
                toggleModal(editPostModal.id);
            });
            $('#new-post').on('submit', function (e) {
                e.preventDefault();
                Swal.fire({
                    title: 'آیا مطمئن هستید؟',
                    text: 'این مقدار به صورت دائمی اضافه خواهد شد.',
                    icon: 'warning',
                    showCancelButton: true,
                    cancelButtonText: 'خیر',
                    confirmButtonText: 'بله',
                }).then((result) => {
                    if (result.isConfirmed) {
                        var form = $(this);
                        var data = form.serialize();
                        $.ajax({
                            type: 'POST',
                            url: '/newPost',
                            data: data,
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                            },
                            success: function (response) {
                                if (response.errors) {
                                    if (response.errors.nullName) {
                                        swalFire('خطا!', response.errors.nullName[0], 'error', 'تلاش مجدد');
                                    } else if (response.errors.nullFamily) {
                                        swalFire('خطا!', response.errors.nullFamily[0], 'error', 'تلاش مجدد');
                                    } else if (response.errors.nullNationalCode) {
                                        swalFire('خطا!', response.errors.nullNationalCode[0], 'error', 'تلاش مجدد');
                                    } else if (response.errors.wrongNationalCode) {
                                        swalFire('خطا!', response.errors.wrongNationalCode[0], 'error', 'تلاش مجدد');
                                    } else if (response.errors.nullGender) {
                                        swalFire('خطا!', response.errors.nullGender[0], 'error', 'تلاش مجدد');
                                    } else if (response.errors.nullMobile) {
                                        swalFire('خطا!', response.errors.nullMobile[0], 'error', 'تلاش مجدد');
                                    } else if (response.errors.wrongMobile) {
                                        swalFire('خطا!', response.errors.wrongMobile[0], 'error', 'تلاش مجدد');
                                    } else if (response.errors.dupNationalCode) {
                                        swalFire('خطا!', response.errors.dupNationalCode[0], 'error', 'تلاش مجدد');
                                    }
                                } else if (response.success) {
                                    swalFire('ثبت اطلاعات صاحب اثر موفقیت آمیز بود!', response.message.PersonAdded[0], 'success', 'بستن');
                                    toggleModal(newPersonModal.id);
                                    resetFields();
                                }
                            }
                        });
                    }
                });
            });
            $('.PersonControl').on('click', function () {
                $.ajax({
                    type: 'GET',
                    url: '/getPersonInfo',
                    data: {
                        id: $(this).data('id')
                    },
                    success: function (response) {
                        if (response) {
                            personID.value = response.id;
                            nameForEdit.value = response.name;
                            familyForEdit.value = response.family;
                            national_codeForEdit.value = response.national_code;
                            mobileForEdit.value = response.mobile;
                            genderForEdit.value = response.gender;
                            howzah_codeForEdit.value = response.howzah_code;
                        }
                    }
                });
            });
            $('#edit-person').on('submit', function (e) {
                e.preventDefault();
                Swal.fire({
                    title: 'آیا مطمئن هستید؟',
                    text: 'با ویرایش این مقدار، تمامی فیلدها تغییر خواهند کرد.',
                    icon: 'warning',
                    showCancelButton: true,
                    cancelButtonText: 'خیر',
                    confirmButtonText: 'بله',
                }).then((result) => {
                    if (result.isConfirmed) {
                        var form = $(this);
                        var data = form.serialize();
                        $.ajax({
                            type: 'POST',
                            url: '/editPerson',
                            data: data,
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                            },
                            success: function (response) {
                                if (response.errors) {
                                    if (response.errors.nullName) {
                                        swalFire('خطا!', response.errors.nullName[0], 'error', 'تلاش مجدد');
                                    } else if (response.errors.nullFamily) {
                                        swalFire('خطا!', response.errors.nullFamily[0], 'error', 'تلاش مجدد');
                                    } else if (response.errors.nullGender) {
                                        swalFire('خطا!', response.errors.nullGender[0], 'error', 'تلاش مجدد');
                                    } else if (response.errors.nullMobile) {
                                        swalFire('خطا!', response.errors.nullMobile[0], 'error', 'تلاش مجدد');
                                    } else if (response.errors.wrongMobile) {
                                        swalFire('خطا!', response.errors.wrongMobile[0], 'error', 'تلاش مجدد');
                                    }
                                } else if (response.success) {
                                    swalFire('ویرایش صاحب اثر موفقیت آمیز بود!', response.message.personEdited[0], 'success', 'بستن');
                                    toggleModal(editPersonModal.id);
                                    resetFields();
                                }
                            }
                        });
                    }
                });
            });
            break;
    }
});