import './bootstrap';
import '@fortawesome/fontawesome-free/css/all.css';
import $ from 'jquery';
import Swal from 'sweetalert2';
window.Swal = Swal;

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
    var pattern = /^\/Rate\/Summary\/\d+$/;
    switch (window.location.pathname) {
        case "/Profile":
            resetFields();

            $('#change-password').submit(function (e) {
                e.preventDefault();

                var form = $(this);
                var data = form.serialize();

                $.ajax({
                    type: 'POST', url: "/ChangePasswordInc", data: data, headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    }, success: function (response) {
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
                    }, error: function (xhr, textStatus, errorThrown) {
                        // console.log(xhr);
                    }
                });
            });
            $('#change-user-image').submit(function (e) {
                e.preventDefault();
                var form = $(this);
                var formData = new FormData(form[0]);
                $.ajax({
                    type: 'POST',
                    url: "/ChangeUserImage",
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        if (response.success) {
                            location.reload();
                        } else {
                            if (response.errors.wrongImage) {
                                swalFire('خطا!', response.errors.wrongImage[0], 'error', 'تلاش مجدد');
                            } else {
                                location.reload();
                            }
                        }
                    }, error: function (xhr, textStatus, errorThrown) {
                        // console.log(xhr);
                    }
                });
            });
            break;
        case "/UserManager":
            resetFields();
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
                            var row = '<tr class="bg-white"><td class="px-6 py-4">' + user.username + '</td><td class="px-6 py-4">' + user.name + '</td><td class="px-6 py-4">' + type + '</td>';
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
                            var row = '<tr class="bg-white"><td class="px-6 py-4">' + user.username + '</td><td class="px-6 py-4">' + user.name + '</td><td class="px-6 py-4">' + type + '</td>';
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
            resetFields();
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
                                    // swalFire('ثبت اطلاعات صاحب اثر موفقیت آمیز بود!', response.message.PersonAdded[0], 'success', 'بستن');
                                    // toggleModal(newPersonModal.id);
                                    resetFields();
                                    location.reload();
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
                                    // swalFire('ویرایش صاحب اثر موفقیت آمیز بود!', response.message.personEdited[0], 'success', 'بستن');
                                    // toggleModal(editPersonModal.id);
                                    resetFields();
                                    location.reload();
                                }
                            }
                        });
                    }
                });
            });
            break;
        case '/Posts':
            resetFields();
            $('.absolute.inset-0.bg-gray-500.opacity-75.add').on('click', function () {
                toggleModal(newPostModal.id)
            });
            $('.absolute.inset-0.bg-gray-500.opacity-75.edit').on('click', function () {
                toggleModal(editPostModal.id)
            });
            $('#post_format').on('change', function () {
                if (post_format.value == 'کتاب') {
                    bookDIV1.classList.remove('hidden');
                    bookDIV2.classList.remove('hidden');
                    thesisDIV1.classList.add('hidden');
                    thesisDIV2.classList.add('hidden');
                    if (post_delivery_method.value == 'digital') {
                        file_srcDIV.classList.remove('hidden');
                        thesis_proceedings_srcDIV.classList.add('hidden');
                    }
                } else if (post_format.value == 'پایان نامه') {
                    bookDIV1.classList.add('hidden');
                    bookDIV2.classList.add('hidden');
                    thesisDIV1.classList.remove('hidden');
                    thesisDIV2.classList.remove('hidden');
                    if (post_delivery_method.value == 'digital') {
                        file_srcDIV.classList.remove('hidden');
                        thesis_proceedings_srcDIV.classList.remove('hidden');
                    }
                }
            });
            $('#post_formatForEdit').on('change', function () {
                if (post_formatForEdit.value == 'کتاب') {
                    bookDIV1ForEdit.classList.remove('hidden');
                    bookDIV2ForEdit.classList.remove('hidden');
                    thesisDIV1ForEdit.classList.add('hidden');
                    thesisDIV2ForEdit.classList.add('hidden');
                    if (post_delivery_methodForEdit.value == 'digital') {
                        file_srcDIVForEdit.classList.remove('hidden');
                        thesis_proceedings_srcDIVForEdit.classList.add('hidden');
                    }
                } else if (post_formatForEdit.value == 'پایان نامه') {
                    bookDIV1ForEdit.classList.add('hidden');
                    bookDIV2ForEdit.classList.add('hidden');
                    thesisDIV1ForEdit.classList.remove('hidden');
                    thesisDIV2ForEdit.classList.remove('hidden');
                    if (post_delivery_methodForEdit.value == 'digital') {
                        file_srcDIVForEdit.classList.remove('hidden');
                        thesis_proceedings_srcDIVForEdit.classList.remove('hidden');
                    }
                }
            });
            $('#activity_type').on('change', function () {
                if (activity_type.value == 'common') {
                    commonDIV.classList.remove('hidden');
                } else {
                    commonDIV.classList.add('hidden');
                }
            });
            $('#activity_typeForEdit').on('change', function () {
                if (activity_typeForEdit.value == 'common') {
                    commonDIVForEdit.classList.remove('hidden');
                } else {
                    commonDIVForEdit.classList.add('hidden');
                }
            });
            $('#post_delivery_method').on('change', function () {
                if (post_delivery_method.value == 'physical') {
                    file_srcDIV.classList.add('hidden');
                    thesis_proceedings_srcDIV.classList.add('hidden');
                } else if (post_delivery_method.value == 'digital') {
                    file_srcDIV.classList.remove('hidden');
                    if (post_format.value == 'پایان نامه') {
                        thesis_proceedings_srcDIV.classList.remove('hidden');
                    }
                }
            });
            $('#post_delivery_methodForEdit').on('change', function () {
                if (post_delivery_methodForEdit.value == 'physical') {
                    file_srcDIVForEdit.classList.add('hidden');
                    thesis_proceedings_srcDIVForEdit.classList.add('hidden');
                } else if (post_delivery_methodForEdit.value == 'digital') {
                    file_srcDIVForEdit.classList.remove('hidden');
                    if (post_formatForEdit.value == 'پایان نامه') {
                        thesis_proceedings_srcDIVForEdit.classList.remove('hidden');
                    }
                }
            });
            $('#new-post-button,#cancel-new-post').on('click', function () {
                toggleModal(newPostModal.id);
            });
            $('#new-post').on('submit', function (e) {
                e.preventDefault();
                if (scientific_group1.value === scientific_group2.value) {
                    swalFire('خطا!', 'گروه اول و دوم با هم برابر می باشد.', 'error', 'تلاش مجدد');
                } else {
                    Swal.fire({
                        title: 'آیا مطمئن هستید؟',
                        text: 'این اثر در سامانه اضافه خواهد شد.',
                        icon: 'warning',
                        showCancelButton: true,
                        cancelButtonText: 'خیر',
                        confirmButtonText: 'بله',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            var form = $(this);
                            var formData = new FormData(form[0]);
                            $.ajax({
                                type: 'POST',
                                url: '/newPost',
                                data: formData,
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                                },
                                contentType: false,
                                processData: false,
                                success: function (response) {
                                    if (response.errors) {
                                        if (response.errors.nullPerson) {
                                            swalFire('خطا!', response.errors.nullPerson[0], 'error', 'تلاش مجدد');
                                        }
                                        if (response.errors.nullName) {
                                            swalFire('خطا!', response.errors.nullName[0], 'error', 'تلاش مجدد');
                                        }
                                        if (response.errors.nullPostFormat) {
                                            swalFire('خطا!', response.errors.nullPostFormat[0], 'error', 'تلاش مجدد');
                                        }
                                        if (response.errors.nullPostType) {
                                            swalFire('خطا!', response.errors.nullPostType[0], 'error', 'تلاش مجدد');
                                        }
                                        if (response.errors.nullLanguage) {
                                            swalFire('خطا!', response.errors.nullLanguage[0], 'error', 'تلاش مجدد');
                                        }
                                        if (response.errors.nullPagesNumber) {
                                            swalFire('خطا!', response.errors.nullPagesNumber[0], 'error', 'تلاش مجدد');
                                        }
                                        if (response.errors.nullSG1) {
                                            swalFire('خطا!', response.errors.nullSG1[0], 'error', 'تلاش مجدد');
                                        }
                                        if (response.errors.nullActivityType) {
                                            swalFire('خطا!', response.errors.nullActivityType[0], 'error', 'تلاش مجدد');
                                        }
                                        if (response.errors.nullPostDeliveryMethod) {
                                            swalFire('خطا!', response.errors.nullPostDeliveryMethod[0], 'error', 'تلاش مجدد');
                                        }
                                        if (response.errors.nullPublisher) {
                                            swalFire('خطا!', response.errors.nullPublisher[0], 'error', 'تلاش مجدد');
                                        }
                                        if (response.errors.nullISSN) {
                                            swalFire('خطا!', response.errors.nullISSN[0], 'error', 'تلاش مجدد');
                                        }
                                        if (response.errors.nullNumberOfCovers) {
                                            swalFire('خطا!', response.errors.nullNumberOfCovers[0], 'error', 'تلاش مجدد');
                                        }
                                        if (response.errors.nullCirculation) {
                                            swalFire('خطا!', response.errors.nullCirculation[0], 'error', 'تلاش مجدد');
                                        }
                                        if (response.errors.nullBookSize) {
                                            swalFire('خطا!', response.errors.nullBookSize[0], 'error', 'تلاش مجدد');
                                        }
                                        if (response.errors.nullThesisCertificateNumber) {
                                            swalFire('خطا!', response.errors.nullThesisCertificateNumber[0], 'error', 'تلاش مجدد');
                                        }
                                        if (response.errors.nullThesisDefencePlace) {
                                            swalFire('خطا!', response.errors.nullThesisDefencePlace[0], 'error', 'تلاش مجدد');
                                        }
                                        if (response.errors.nullGrade) {
                                            swalFire('خطا!', response.errors.nullGrade[0], 'error', 'تلاش مجدد');
                                        }
                                        if (response.errors.nullSupervisor) {
                                            swalFire('خطا!', response.errors.nullSupervisor[0], 'error', 'تلاش مجدد');
                                        }
                                        if (response.errors.nullAdvisor) {
                                            swalFire('خطا!', response.errors.nullAdvisor[0], 'error', 'تلاش مجدد');
                                        }
                                        if (response.errors.nullReferee) {
                                            swalFire('خطا!', response.errors.nullReferee[0], 'error', 'تلاش مجدد');
                                        }
                                        if (response.errors.nullCooperatorInformation) {
                                            swalFire('خطا!', response.errors.nullCooperatorInformation[0], 'error', 'تلاش مجدد');
                                        }
                                        if (response.errors.nullPostFile) {
                                            swalFire('خطا!', response.errors.nullPostFile[0], 'error', 'تلاش مجدد');
                                        }
                                        if (response.errors.nullThesisFile) {
                                            swalFire('خطا!', response.errors.nullThesisFile[0], 'error', 'تلاش مجدد');
                                        }
                                    } else if (response.success) {
                                        // swalFire('ثبت اثر جدید موفقیت آمیز بود!', response.message.PostAdded[0], 'success', 'بستن');
                                        // toggleModal(newPostModal.id);
                                        resetFields();
                                        location.reload();
                                    }
                                }
                            });
                        }
                    });
                }
            });
            $('.PostControl,#cancel-edit-post').on('click', function () {
                toggleModal(editPostModal.id);
            });
            $('.PostControl').on('click', function () {
                $.ajax({
                    type: 'GET',
                    url: '/getPostInfo',
                    data: {
                        id: $(this).data('id')
                    },
                    success: function (response) {
                        if (response) {
                            postIDForEdit.value = response.id;
                            personForEdit.value = response.person_id;
                            nameForEdit.value = response.title;
                            post_formatForEdit.value = response.post_format;
                            post_typeForEdit.value = response.post_type;
                            languageForEdit.value = response.language;
                            pages_numberForEdit.value = response.pages_number;
                            if (response.special_section) {
                                special_sectionForEdit.value = response.special_section;
                            }

                            if (response.post_format == 'کتاب') {
                                bookDIV1ForEdit.classList.remove('hidden');
                                bookDIV2ForEdit.classList.remove('hidden');
                                thesisDIV1ForEdit.classList.add('hidden');
                                thesisDIV2ForEdit.classList.add('hidden');
                                publisherForEdit.value = response.publisher;
                                ISSNForEdit.value = response.ISSN;
                                number_of_coversForEdit.value = response.number_of_covers;
                                circulationForEdit.value = response.circulation
                                book_sizeForEdit.value = response.book_size
                            } else if (response.post_format == 'پایان نامه') {
                                bookDIV1ForEdit.classList.add('hidden');
                                bookDIV2ForEdit.classList.add('hidden');
                                thesisDIV1ForEdit.classList.remove('hidden');
                                thesisDIV2ForEdit.classList.remove('hidden');
                                thesis_certificate_numberForEdit.value = response.thesis_certificate_number;
                                thesis_defence_placeForEdit.value = response.thesis_defence_place;
                                thesis_gradeForEdit.value = response.thesis_grade;
                                thesis_supervisorForEdit.value = response.thesis_supervisor;
                                thesis_advisorForEdit.value = response.thesis_advisor;
                                thesis_refereeForEdit.value = response.thesis_referee;
                            }


                            scientific_group1ForEdit.value = response.scientific_group_v1;
                            if (response.scientific_group_v2) {
                                scientific_group2ForEdit.value = response.scientific_group_v2;
                            }
                            propertiesForEdit.value = response.properties;
                            activity_typeForEdit.value = response.activity_type;
                            if (response.activity_type == 'individual') {
                                commonDIVForEdit.classList.add('hidden');
                            } else if (response.activity_type == 'common') {
                                $.ajax({
                                    type: 'GET',
                                    url: '/getParticipants',
                                    data: {
                                        id: response.id
                                    },
                                    success: function (response) {
                                        if (response[0]) {
                                            comm_name1ForEdit.value = response[0].name;
                                            comm_family1ForEdit.value = response[0].family;
                                            comm_national_code1ForEdit.value = response[0].national_code;
                                            comm_percentage1ForEdit.value = response[0].participation_percentage;
                                            comm_mobile1ForEdit.value = response[0].mobile;
                                        }
                                        if (response[1]) {
                                            comm_name2ForEdit.value = response[1].name;
                                            comm_family2ForEdit.value = response[1].family;
                                            comm_national_code2ForEdit.value = response[1].national_code;
                                            comm_percentage2ForEdit.value = response[1].participation_percentage;
                                            comm_mobile2ForEdit.value = response[1].mobile;
                                        }
                                        if (response[2]) {
                                            comm_name3ForEdit.value = response[2].name;
                                            comm_family3ForEdit.value = response[2].family;
                                            comm_national_code3ForEdit.value = response[2].national_code;
                                            comm_percentage3ForEdit.value = response[2].participation_percentage;
                                            comm_mobile3ForEdit.value = response[2].mobile;
                                        }
                                        if (response[3]) {
                                            comm_name4ForEdit.value = response[3].name;
                                            comm_family4ForEdit.value = response[3].family;
                                            comm_national_code4ForEdit.value = response[3].national_code;
                                            comm_percentage4ForEdit.value = response[3].participation_percentage;
                                            comm_mobile4ForEdit.value = response[3].mobile;
                                        }
                                        if (response[4]) {
                                            comm_name5ForEdit.value = response[4].name;
                                            comm_family5ForEdit.value = response[4].family;
                                            comm_national_code5ForEdit.value = response[4].national_code;
                                            comm_percentage5ForEdit.value = response[4].participation_percentage;
                                            comm_mobile5ForEdit.value = response[4].mobile;
                                        }

                                    }
                                });
                                commonDIVForEdit.classList.remove('hidden');
                            }
                            post_delivery_methodForEdit.value = response.post_delivery_method;
                            if (response.post_delivery_method == 'digital') {
                                file_srcDIVForEdit.classList.remove('hidden');
                                response.file_src = response.file_src.replace('public', 'storage');
                                postFile.href = response.file_src;
                                if (response.post_format == 'پایان نامه') {
                                    response.thesis_proceedings_src = response.thesis_proceedings_src.replace('public', 'storage');
                                    proceedingsFile.href = response.thesis_proceedings_src;
                                    thesis_proceedings_srcDIVForEdit.classList.remove('hidden');
                                } else {
                                    thesis_proceedings_srcDIVForEdit.classList.add('hidden');
                                }
                            } else {
                                file_srcDIVForEdit.classList.add('hidden');
                                thesis_proceedings_srcDIVForEdit.classList.add('hidden');
                            }
                        }
                    }
                });
            });
            $('#edit-post').on('submit', function (e) {
                e.preventDefault();
                if (scientific_group1ForEdit.value === scientific_group2ForEdit.value) {
                    swalFire('خطا!', 'گروه اول و دوم با هم برابر می باشد.', 'error', 'تلاش مجدد');
                } else {
                    Swal.fire({
                        title: 'آیا مطمئن هستید؟',
                        text: 'این اثر ویرایش خواهد شد.',
                        icon: 'warning',
                        showCancelButton: true,
                        cancelButtonText: 'خیر',
                        confirmButtonText: 'بله',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            var form = $(this);
                            var formData = new FormData(form[0]);
                            $.ajax({
                                type: 'POST',
                                url: '/editPost',
                                data: formData,
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                                },
                                contentType: false,
                                processData: false,
                                success: function (response) {
                                    if (response.errors) {
                                        if (response.errors.nullPerson) {
                                            swalFire('خطا!', response.errors.nullPerson[0], 'error', 'تلاش مجدد');
                                        }
                                        if (response.errors.nullName) {
                                            swalFire('خطا!', response.errors.nullName[0], 'error', 'تلاش مجدد');
                                        }
                                        if (response.errors.nullPostFormat) {
                                            swalFire('خطا!', response.errors.nullPostFormat[0], 'error', 'تلاش مجدد');
                                        }
                                        if (response.errors.nullPostType) {
                                            swalFire('خطا!', response.errors.nullPostType[0], 'error', 'تلاش مجدد');
                                        }
                                        if (response.errors.nullLanguage) {
                                            swalFire('خطا!', response.errors.nullLanguage[0], 'error', 'تلاش مجدد');
                                        }
                                        if (response.errors.nullPagesNumber) {
                                            swalFire('خطا!', response.errors.nullPagesNumber[0], 'error', 'تلاش مجدد');
                                        }
                                        if (response.errors.nullSG1) {
                                            swalFire('خطا!', response.errors.nullSG1[0], 'error', 'تلاش مجدد');
                                        }
                                        if (response.errors.nullActivityType) {
                                            swalFire('خطا!', response.errors.nullActivityType[0], 'error', 'تلاش مجدد');
                                        }
                                        if (response.errors.nullPostDeliveryMethod) {
                                            swalFire('خطا!', response.errors.nullPostDeliveryMethod[0], 'error', 'تلاش مجدد');
                                        }
                                        if (response.errors.nullPublisher) {
                                            swalFire('خطا!', response.errors.nullPublisher[0], 'error', 'تلاش مجدد');
                                        }
                                        if (response.errors.nullISSN) {
                                            swalFire('خطا!', response.errors.nullISSN[0], 'error', 'تلاش مجدد');
                                        }
                                        if (response.errors.nullNumberOfCovers) {
                                            swalFire('خطا!', response.errors.nullNumberOfCovers[0], 'error', 'تلاش مجدد');
                                        }
                                        if (response.errors.nullCirculation) {
                                            swalFire('خطا!', response.errors.nullCirculation[0], 'error', 'تلاش مجدد');
                                        }
                                        if (response.errors.nullBookSize) {
                                            swalFire('خطا!', response.errors.nullBookSize[0], 'error', 'تلاش مجدد');
                                        }
                                        if (response.errors.nullThesisCertificateNumber) {
                                            swalFire('خطا!', response.errors.nullThesisCertificateNumber[0], 'error', 'تلاش مجدد');
                                        }
                                        if (response.errors.nullThesisDefencePlace) {
                                            swalFire('خطا!', response.errors.nullThesisDefencePlace[0], 'error', 'تلاش مجدد');
                                        }
                                        if (response.errors.nullGrade) {
                                            swalFire('خطا!', response.errors.nullGrade[0], 'error', 'تلاش مجدد');
                                        }
                                        if (response.errors.nullSupervisor) {
                                            swalFire('خطا!', response.errors.nullSupervisor[0], 'error', 'تلاش مجدد');
                                        }
                                        if (response.errors.nullAdvisor) {
                                            swalFire('خطا!', response.errors.nullAdvisor[0], 'error', 'تلاش مجدد');
                                        }
                                        if (response.errors.nullReferee) {
                                            swalFire('خطا!', response.errors.nullReferee[0], 'error', 'تلاش مجدد');
                                        }
                                        if (response.errors.nullCooperatorInformation) {
                                            swalFire('خطا!', response.errors.nullCooperatorInformation[0], 'error', 'تلاش مجدد');
                                        }
                                        if (response.errors.nullPostFile) {
                                            swalFire('خطا!', response.errors.nullPostFile[0], 'error', 'تلاش مجدد');
                                        }
                                        if (response.errors.nullThesisFile) {
                                            swalFire('خطا!', response.errors.nullThesisFile[0], 'error', 'تلاش مجدد');
                                        }
                                    } else if (response.success) {
                                        swalFire('ویرایش اثر موفقیت آمیز بود!', response.message.PostEdited[0], 'success', 'بستن');
                                        toggleModal(editPostModal.id);
                                        resetFields();
                                    }
                                }
                            });
                        }
                    });
                }
            });
            $('.DeletePost').on('click', function (e) {
                e.preventDefault();
                Swal.fire({
                    title: 'آیا مطمئن هستید؟',
                    text: 'این اثر به صورت دائمی حذف خواهد شد.',
                    icon: 'warning',
                    showCancelButton: true,
                    cancelButtonText: 'خیر',
                    confirmButtonText: 'بله',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: 'DELETE',
                            url: '/deletePost',
                            data: {
                                id: $(this).data('id')
                            },
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                            },
                            success: function (response) {
                                location.reload();
                            }
                        });
                    }
                });
            });
            break;
        case '/Classification':
        function bindChangeEvents() {
            $('.sg1').on('change', function () {
                $.ajax({
                    type: 'POST',
                    url: '/changeScientificGroup',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                    data: {
                        PostID: $(this).data('postid'),
                        work: 'ChangeScientificGroup1',
                        newSG1: $(this).val(),
                    },
                    success: function (response) {
                        console.log(response)
                    }
                });
            });

            $('.sg2').on('change', function () {
                $.ajax({
                    type: 'POST',
                    url: '/changeScientificGroup',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                    data: {
                        PostID: $(this).data('postid'),
                        work: 'ChangeScientificGroup2',
                        newSG2: $(this).val(),
                    },
                    success: function (response) {
                        console.log(response)
                    }
                });
            });
        }

            bindChangeEvents();
            $('#classification-form').on('submit', function (e) {
                e.preventDefault();
                Swal.fire({
                    title: 'آیا مطمئن هستید؟',
                    text: 'کلیه آثار، گونه بندی شده و به مرحله اجمالی راه خواهند یافت.' +
                        '\n' +
                        'این عملیات برگشت پذیر نیست.',
                    icon: 'warning',
                    showCancelButton: true,
                    cancelButtonText: 'خیر',
                    confirmButtonText: 'بله',
                }).then((result) => {
                    if (result.isConfirmed) {
                        var form = $(this);
                        var formData = new FormData(form[0]);
                        $.ajax({
                            type: 'POST',
                            url: '/Classification',
                            data: formData,
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                            },
                            contentType: false,
                            processData: false,
                            success: function (response) {
                                if (response.errors) {
                                    if (response.errors.wrongFileType) {
                                        swalFire('خطا!', response.errors.wrongFileType[0], 'error', 'تلاش مجدد');
                                    }
                                } else if (response.success) {
                                    location.reload();
                                }
                            }
                        });
                    }
                });
            });
            $('#search-title-Classification').on('input', function () {
                var inputTitle = $('#search-title-Classification').val();
                var SG1 = $('#search-SG1-Classification').val();
                var SG2 = $('#search-SG2-Classification').val();
                $.ajax({
                    url: '/Search',
                    type: 'GET',
                    data: {
                        Title: inputTitle,
                        SG1: SG1,
                        SG2: SG2,
                        work: 'ClassificationSearch'
                    },
                    success: function (data) {
                        var tableBody = $('.w-full.border-collapse.rounded-lg.overflow-hidden.text-center tbody');
                        tableBody.empty();

                        async function fetchDataAndPopulateTable() {
                            for (const classification of data) {
                                try {
                                    let festivalResponse = await $.ajax({
                                        type: 'GET',
                                        url: '/getFestivalInfo',
                                        data: {
                                            id: classification.festival_id
                                        }
                                    });
                                    let FestivalName = festivalResponse;

                                    let languageResponse = await $.ajax({
                                        type: 'GET',
                                        url: '/getLanguageInfo',
                                        data: {
                                            id: classification.language
                                        }
                                    });
                                    let LanguageName = languageResponse;

                                    let personResponse = await $.ajax({
                                        type: 'GET',
                                        url: '/getPersonInfo',
                                        data: {
                                            id: classification.person_id
                                        }
                                    });
                                    let PersonName = personResponse;

                                    let group1Response = await $.ajax({
                                        type: 'GET',
                                        url: '/getScientificGroupInfo',
                                        data: {
                                            id: classification.scientific_group_v1
                                        }
                                    });
                                    let SG1Name = group1Response;

                                    let SG2Name = null;
                                    let group2Response = await $.ajax({
                                        type: 'GET',
                                        url: '/getScientificGroupInfo',
                                        data: {
                                            id: classification.scientific_group_v2
                                        }
                                    });
                                    SG2Name = group2Response;

                                    let groupsResponse = await $.ajax({
                                        type: 'GET',
                                        url: '/getAllGroups',
                                    });
                                    let groups = groupsResponse;

                                    const selectSG1Element = document.createElement('select');
                                    selectSG1Element.classList.add('border', 'rounded-md', 'w-full', 'px-3', 'py-2', 'sg1');
                                    selectSG1Element.id = 'sg1';
                                    selectSG1Element.name = 'sg1';
                                    selectSG1Element.setAttribute('data-postid', classification.id);
                                    groups.forEach(function (currentValue) {
                                        const option = document.createElement('option');
                                        option.value = currentValue.id;
                                        option.text = currentValue.name;
                                        if (currentValue.id == Number(classification.scientific_group_v1)) {
                                            option.setAttribute('selected', 'selected');
                                        }
                                        selectSG1Element.appendChild(option);
                                    });

                                    const selectSG2Element = document.createElement('select');
                                    selectSG2Element.classList.add('border', 'rounded-md', 'w-full', 'px-3', 'py-2', 'sg2');
                                    selectSG2Element.id = 'sg2';
                                    selectSG2Element.name = 'sg2';
                                    selectSG2Element.setAttribute('data-postid', classification.id);
                                    const option = document.createElement('option');
                                    option.value = '';
                                    option.text = 'بدون گروه علمی دوم';
                                    option.setAttribute('selected', 'selected');
                                    selectSG2Element.appendChild(option);
                                    groups.forEach(function (currentValue) {
                                        const option = document.createElement('option');
                                        option.value = currentValue.id;
                                        option.text = currentValue.name;
                                        if (currentValue.id == Number(classification.scientific_group_v2)) {
                                            option.setAttribute('selected', 'selected');
                                        }
                                        selectSG2Element.appendChild(option);
                                    });
                                    const selectSG1HTML = selectSG1Element.outerHTML;
                                    const selectSG2HTML = selectSG2Element.outerHTML;

                                    const row = '<tr class="bg-white">'
                                        + '<td class="px-6 py-4">' + FestivalName.name + '</td>'
                                        + '<td class="px-6 py-4">' + classification.festival_id + '</td>'
                                        + '<td class="px-6 py-4">' + classification.title + '</td>'
                                        + '<td class="px-6 py-4">' + classification.post_format + '</td>'
                                        + '<td class="px-6 py-4">' + classification.post_type + '</td>'
                                        + '<td class="px-6 py-4">' + LanguageName + '</td>'
                                        + '<td class="px-6 py-4">' + selectSG1HTML + '</td>'
                                        + '<td class="px-6 py-4">' + selectSG2HTML + '</td>'
                                        + '<td class="px-6 py-4">' + PersonName.name + ' ' + PersonName.family + '</td>'
                                        + '</tr>';

                                    tableBody.append(row);
                                } catch (error) {
                                    console.error('Error fetching data:', error);
                                }
                            }
                            bindChangeEvents();
                        }

                        fetchDataAndPopulateTable();

                    },
                    error: function () {
                        console.log('خطا در ارتباط با سرور');
                    }
                });
            });
            $('#search-SG1-Classification,#search-SG2-Classification').on('change', function () {
                var inputTitle = $('#search-title-Classification').val();
                var SG1 = $('#search-SG1-Classification').val();
                var SG2 = $('#search-SG2-Classification').val();
                $.ajax({
                    url: '/Search',
                    type: 'GET',
                    data: {
                        Title: inputTitle,
                        SG1: SG1,
                        SG2: SG2,
                        work: 'ClassificationSearch'
                    },
                    success: function (data) {
                        var tableBody = $('.w-full.border-collapse.rounded-lg.overflow-hidden.text-center tbody');
                        tableBody.empty();

                        async function fetchDataAndPopulateTable() {
                            for (const classification of data) {
                                try {
                                    let festivalResponse = await $.ajax({
                                        type: 'GET',
                                        url: '/getFestivalInfo',
                                        data: {
                                            id: classification.festival_id
                                        }
                                    });
                                    let FestivalName = festivalResponse;

                                    let languageResponse = await $.ajax({
                                        type: 'GET',
                                        url: '/getLanguageInfo',
                                        data: {
                                            id: classification.language
                                        }
                                    });
                                    let LanguageName = languageResponse;

                                    let personResponse = await $.ajax({
                                        type: 'GET',
                                        url: '/getPersonInfo',
                                        data: {
                                            id: classification.person_id
                                        }
                                    });
                                    let PersonName = personResponse;

                                    let group1Response = await $.ajax({
                                        type: 'GET',
                                        url: '/getScientificGroupInfo',
                                    });
                                    let SG1Name = group1Response;

                                    let SG2Name = null;
                                    let group2Response = await $.ajax({
                                        type: 'GET',
                                        url: '/getScientificGroupInfo',
                                    });
                                    SG2Name = group2Response;

                                    let groupsResponse = await $.ajax({
                                        type: 'GET',
                                        url: '/getAllGroups',
                                    });
                                    let groups = groupsResponse;
                                    const selectSG1Element = document.createElement('select');
                                    selectSG1Element.classList.add('border', 'rounded-md', 'w-full', 'px-3', 'py-2', 'sg1');
                                    selectSG1Element.id = 'sg1';
                                    selectSG1Element.name = 'sg1';
                                    selectSG1Element.setAttribute('data-postid', classification.id);
                                    groups.forEach(function (currentValue) {
                                        const option = document.createElement('option');
                                        option.value = currentValue.id;
                                        option.text = currentValue.name;
                                        if (currentValue.id == Number(classification.scientific_group_v1)) {
                                            option.setAttribute('selected', 'selected');
                                        }
                                        selectSG1Element.appendChild(option);
                                    });

                                    const selectSG2Element = document.createElement('select');
                                    selectSG2Element.classList.add('border', 'rounded-md', 'w-full', 'px-3', 'py-2', 'sg2');
                                    selectSG2Element.id = 'sg2';
                                    selectSG2Element.name = 'sg2';
                                    selectSG2Element.setAttribute('data-postid', classification.id);
                                    const option = document.createElement('option');
                                    option.value = '';
                                    option.text = 'بدون گروه علمی دوم';
                                    option.setAttribute('selected', 'selected');
                                    selectSG2Element.appendChild(option);
                                    groups.forEach(function (currentValue) {
                                        const option = document.createElement('option');
                                        option.value = currentValue.id;
                                        option.text = currentValue.name;
                                        if (currentValue.id == Number(classification.scientific_group_v2)) {
                                            option.setAttribute('selected', 'selected');
                                        }
                                        selectSG2Element.appendChild(option);
                                    });
                                    const selectSG1HTML = selectSG1Element.outerHTML;
                                    const selectSG2HTML = selectSG2Element.outerHTML;

                                    const row = '<tr class="bg-white">'
                                        + '<td class="px-6 py-4">' + FestivalName.name + '</td>'
                                        + '<td class="px-6 py-4">' + classification.festival_id + '</td>'
                                        + '<td class="px-6 py-4">' + classification.title + '</td>'
                                        + '<td class="px-6 py-4">' + classification.post_format + '</td>'
                                        + '<td class="px-6 py-4">' + classification.post_type + '</td>'
                                        + '<td class="px-6 py-4">' + LanguageName + '</td>'
                                        + '<td class="px-6 py-4">' + selectSG1HTML + '</td>'
                                        + '<td class="px-6 py-4">' + selectSG2HTML + '</td>'
                                        + '<td class="px-6 py-4">' + PersonName.name + ' ' + PersonName.family + '</td>'
                                        + '</tr>';

                                    tableBody.append(row);
                                } catch (error) {
                                    console.error('Error fetching data:', error);
                                }
                            }
                            bindChangeEvents();
                        }

                        fetchDataAndPopulateTable();

                    },
                    error: function () {
                        console.log('خطا در ارتباط با سرور');
                    }
                });
            });
            break;
        case '/HeaderApproval':
        case '/Approval':
            const selectors = document.querySelectorAll('select');
            selectors.forEach(select => select.value = "");

            $('.relation-with-summary-group').on('change', function () {
                var row = $(this).data('row');
                var SetScientificGroupDIV = $('.SetScientificGroupDIV[data-row="' + row + '"]');
                var SetFormTypeDIV = $('.SetFormTypeDIV[data-row="' + row + '"]');
                switch (this.value){
                    case 'اثر مربوط به گروه حاضر است':
                        SetScientificGroupDIV.addClass('hidden');
                        SetFormTypeDIV.removeClass('hidden');
                        break;
                    case 'اثر میان رشته ای است':
                        SetScientificGroupDIV.removeClass('hidden');
                        SetFormTypeDIV.removeClass('hidden');
                        break;
                    case 'اثر مربوط به گروه حاضر نیست':
                        SetScientificGroupDIV.removeClass('hidden');
                        SetFormTypeDIV.addClass('hidden');
                        break;
                }
            });

            $('.approve-rate-form').on('submit', function (e) {
                e.preventDefault();
                Swal.fire({
                    title: 'آیا مطمئن هستید؟',
                    text: 'اثر ثبت شده  به مرحله اجمالی راه خواهند یافت.' ,
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
                            url: '/Approve',
                            data: data,
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                            },
                            success: function (response) {
                                console.log(response);
                                if (response.errors){
                                    if (response.errors.nullRelation){
                                        swalFire('خطا!', response.errors.nullRelation[0], 'error', 'تلاش مجدد');
                                    }else if (response.errors.wrongGroup){
                                        swalFire('خطا!', response.errors.wrongGroup[0], 'error', 'تلاش مجدد');
                                    }else if (response.errors.nullScientificGroup){
                                        swalFire('خطا!', response.errors.nullScientificGroup[0], 'error', 'تلاش مجدد');
                                    }else if (response.errors.nullFormType){
                                        swalFire('خطا!', response.errors.nullFormType[0], 'error', 'تلاش مجدد');
                                    }
                                }else{
                                    location.reload();
                                }
                            }
                        });
                    }
                });
            });

            break;
        case '/SummaryAssessmentManager':
            $('.SetSummaryRater').on('change', function (e) {
                $.ajax({
                    type: 'POST',
                    url: '/SetSummaryRater',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                    data: {
                        PostID: $(this).data('postid'),
                        work: $(this).data('work'),
                        username: $(this).val(),
                    },
                    success: function (response) {
                        if (response.errors) {
                            if (response.errors.UsersAreEqual) {
                                swalFire('ثبت نشد!', response.errors.UsersAreEqual[0], 'error', 'تلاش مجدد');
                            }
                        }
                    }
                });
            });
            break;

    }
});
