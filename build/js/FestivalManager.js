if (document.getElementById('finishFestival')) {
    document.getElementById('finishFestival').onclick = function () {
        if (confirm('این عملیات قابل بازگشت نیست، آیا مطمئن هستید؟')){
            $.ajax({
                url: "build/php/inc/FestivalManager.php",
                type: "POST",
                data: {
                    work: 'Finish_Festival',
                },
                success: function (response) {
                    if (response==='Done'){
                        location.reload();
                    }
                }
            });
        }
    }
}

if (document.getElementById('New_Festival')) {
    document.getElementById('New_Festival').onclick = function () {
        // if (confirm('این عملیات قابل بازگشت نیست، آیا مطمئن هستید؟')){
        var festival_name=document.getElementById('festival_name').value;
        var start_date=document.getElementById('start_date').value;
        var password=document.getElementById('password').value;
        function convertDigitsToFarsi(input) {
            const persianDigits = [/۰/g, /۱/g, /۲/g, /۳/g, /۴/g, /۵/g, /۶/g, /۷/g, /۸/g, /۹/g];
            const englishDigits = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];

            for (let i = 0; i < persianDigits.length; i++) {
                input = input.replace(persianDigits[i], englishDigits[i]);
            }

            return input;
        }
        start_date = convertDigitsToFarsi(start_date);

            $.ajax({
                url: "build/php/inc/FestivalManager.php",
                type: "POST",
                data: {
                    work: 'New_Festival',
                    festivalName:festival_name,
                    startDate:start_date,
                    password: password,
                },
                success: function (response) {
                    switch (response){
                        case 'Done':
                            alert('فراخوان با موفقیت ایجاد شد.');
                            location.reload();
                            break;
                        case 'FestivalNameExists':
                            alert('نام جشنواره تکراری است.');
                            return false;
                            break;
                        case 'WrongPassword':
                            alert('رمز عبور اشتباه است.');
                            return false;
                            break;
                    }
                }
            });
        // }
    }
}