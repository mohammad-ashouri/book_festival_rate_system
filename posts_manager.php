<?php include_once __DIR__ . '/header.php';
if ($_SESSION['head'] == 4 or $_SESSION['head'] == 3):

    if (isset($_GET['MagAdded'])):
        ?>
        <div class="card card-success">
            <div class="card-header">
                <center>
                    <h3 class="card-title">اثر با نام
                        <?php
                        echo $_GET['Added']
                        ?>
                        با موفقیت در سامانه ثبت شد.
                    </h3>
                </center>
            </div>
            <!-- /.card-header -->
        </div>
    <?php
    elseif (isset($_GET['WrongOperation'])):
        ?>
        <div class="card card-danger">
            <div class="card-header">
                <center>
                    <h3 class="card-title">
                        عملیات نامعتبر
                    </h3>
                </center>
            </div>
            <!-- /.card-header -->
        </div>
    <?php endif; ?>
    <!-- Main content -->
    <section class="content">
        <div class="card card-primary" id="newPostDiv">
            <div class="card-header">
                <h3 class="card-title">ثبت اثر جدید در دوره جاری: دوره
                <?php
                $query=mysqli_query($connection_book_signup,"select * from festivals where active=1");
                foreach ($query as $festivalInfo){}
                echo $festivalInfo['title'];
                ?>
                </h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" method="post" id="NewPostForm" enctype="multipart/form-data">
                <div class="card-body">
                    <center>
                        <table style="width: 100%" class="table table-striped">
                            <tr>
                                <th colspan="6" style="text-align: center;background-color: #dee2e6">
                                    اطلاعات اثر
                                </th>
                            </tr>
                            <tr>
                                <th colspan="1">نام اثر*</th>
                                <td colspan="5">
                                    <input type="text" class="form-control"
                                           placeholder="نام اثر را وارد کنید"
                                           name="postName" id="postName">
                                </td>
                            </tr>
                            <tr>
                                <th>قالب علمی*</th>
                                <td>
                                    <select name="postFormat" id="postFormat" class="form-control select2"
                                            title="قالب علمی را انتخاب کنید">
                                        <option disabled selected>انتخاب کنید</option>
                                        <option value="کتاب">کتاب</option>
                                        <option value="پایان نامه">پایان نامه</option>
                                    </select>
                                </td>
                                <th>نوع اثر*</th>
                                <td>
                                    <select class="form-control select2"
                                            style="width: 100%;text-align: right" name="postType" id="postType">
                                        <option disabled selected>انتخاب کنید</option>
                                        <option value="تألیف">تالیف</option>
                                        <option value="تصحیح و تحقیق">تصحیح و تحقیق</option>
                                        <option value="شرح و تلخیص">شرح و تلخیص</option>
                                        <option value="ترجمه">ترجمه</option>
                                    </select>
                                </td>
                                <th>زبان*</th>
                                <td>
                                    <select name="language" id="language" class="form-control select2"
                                            title="قالب علمی را انتخاب کنید">
                                        <option disabled selected>انتخاب کنید</option>
                                        <?php
                                        $query = mysqli_query($connection_book_signup, "select * from languages where active=1 order by title");
                                        foreach ($query as $languages):
                                            ?>
                                            <option value="<?php echo $languages['title']; ?>"><?php echo $languages['title']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </td>
                            </tr>
                            <tr id="bookTR1" hidden="hidden">
                                <th>ناشر*</th>
                                <td id="publisherTD">
                                    <select name="publisher" id="publisher" class="form-control select2"
                                            title="ناشر را انتخاب کنید">
                                        <option disabled selected>انتخاب کنید</option>
                                        <?php
                                        $query = mysqli_query($connection_book_signup, "select * from publishers where active=1 order by title");
                                        foreach ($query as $publishers):
                                            ?>
                                            <option value="<?php echo $publishers['title']; ?>"><?php echo $publishers['title']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </td>
                                <th>شابک</th>
                                <td>
                                    <input type="text" class="form-control"
                                           placeholder="شابک اثر را وارد کنید"
                                           name="ISSN" id="ISSN">
                                </td>
                            </tr>
                            <tr id="bookTR2" hidden="hidden">
                                <th>تعداد جلد*</th>
                                <td>
                                    <input type="text" class="form-control" value="1"
                                           placeholder="تعداد جلد اثر را وارد کنید"
                                           name="numberOfCovers" id="numberOfCovers">
                                </td>
                                <th>تیراژ*</th>
                                <td>
                                    <input type="text" class="form-control"
                                           placeholder="تیراژ اثر را وارد کنید"
                                           name="circulation" id="circulation">
                                </td>
                                <th>قطع*</th>
                                <td>
                                    <select name="bookSize" id="bookSize" class="form-control select2"
                                            title="قطع اثر را انتخاب کنید">
                                        <option disabled selected>انتخاب کنید</option>
                                        <option value="رحلی">رحلی</option>
                                        <option value="رقعی">رقعی</option>
                                        <option value="نیم رقعی">نیم رقعی</option>
                                        <option value="وزیری">وزیری</option>
                                        <option value="بیاضی">بیاضی</option>
                                        <option value="پالتویی">پالتویی</option>
                                        <option value="خشتی">خشتی</option>
                                        <option value="جیبی">جیبی</option>
                                    </select>
                                </td>
                            </tr>
                            <tr id="thesisTR1" hidden="hidden">
                                <th>شماره گواهی دفاع پایان نامه*</th>
                                <td>
                                    <input type="text" class="form-control"
                                           placeholder="شماره گواهی دفاع پایان نامه را وارد کنید"
                                           name="thesisCertificateNumber" id="thesisCertificateNumber">
                                    <p class="mr-3" id="checkCertificateP"></p>
                                </td>
                                <th>محل دفاع*</th>
                                <td>
                                    <input type="text" class="form-control"
                                           placeholder="محل دفاع اثر را وارد کنید"
                                           name="thesisDefencePlace" id="thesisDefencePlace">
                                </td>
                                <th>امتیاز پایان نامه*</th>
                                <td>
                                    <input type="text" class="form-control"
                                           placeholder="امتیاز پایان نامه را وارد کنید"
                                           name="thesisGrade" id="thesisGrade">
                                </td>
                            </tr>
                            <tr id="thesisTR2" hidden="hidden">
                                <th>مشخصات استاد راهنما*</th>
                                <td colspan="2">
                                    <input type="text" class="form-control"
                                           placeholder="نام و نام خانوادگی استاد راهنما را وارد کنید"
                                           name="thesisSupervisor" id="thesisSupervisor">
                                </td>
                                <th>مشخصات استاد مشاور*</th>
                                <td colspan="2">
                                    <input type="text" class="form-control"
                                           placeholder="نام و نام خانوادگی استاد مشاور را وارد کنید"
                                           name="thesisAdvisor" id="thesisAdvisor">
                                </td>
                            </tr>
                            <tr>
                                <th>شمارگان صفحه*</th>
                                <td>
                                    <input type="text" class="form-control"
                                           placeholder="شمارگان صفحه اثر را وارد کنید"
                                           name="pagesNumber" id="pagesNumber">
                                </td>
                                <th>محور ویژه</th>
                                <td colspan="4">
                                    <select name="specialSection" id="specialSection" class="form-control select2"
                                            title="محور ویژه را انتخاب کنید">
                                        <option disabled selected>انتخاب کنید</option>
                                        <?php
                                        $query = mysqli_query($connection_book_signup, "select * from special_sections where active=1 order by title");
                                        foreach ($query as $publishers):
                                            ?>
                                            <option value="<?php echo $publishers['title']; ?>"><?php echo $publishers['title']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th>ویژگی های اثر</th>
                                <td colspan="5">
                                    <textarea name="properties" id="properties" class="form-control" rows="3"
                                              placeholder="ویژگی های اثر را وارد کنید."></textarea>
                                    <p dir="ltr" id="wordCount">تعداد کلمات: 0</p>
                                </td>
                            </tr>
                        </table>

                        <table style="width: 100%" class="table table-striped">
                            <tr>
                                <th colspan="6" style="text-align: center;background-color: #dee2e6">
                                    اطلاعات نوع تحقیق
                                </th>
                            </tr>
                            <tr>
                                <th>نوع تحقیق را انتخاب کنید.*</th>
                                <td>
                                    <select name="research_type" id="research_type" class="form-control select2"
                                            title="نوع تحقیق را انتخاب کنید">
                                        <option disabled selected>انتخاب کنید</option>
                                        <option value="تک رشته ای">تک رشته ای</option>
                                        <option value="چند رشته ای">چند رشته ای</option>
                                    </select>
                                </td>
                                <th id="scientificGroup1TH" hidden="hidden">گروه علمی اول*</th>
                                <td id="scientificGroup1TD" hidden="hidden">
                                    <select name="scientificGroup1" id="scientificGroup1" class="form-control select2"
                                            title="گروه علمی اول را انتخاب کنید">
                                        <option disabled selected>انتخاب کنید</option>
                                        <?php
                                        $query = mysqli_query($connection_book_signup, "select * from scientific_groups where active=1 order by title");
                                        foreach ($query as $scientific_groups):
                                            ?>
                                            <option value="<?php echo $scientific_groups['title']; ?>"><?php echo $scientific_groups['title']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </td>
                                <th id="scientificGroup2TH" hidden="hidden">گروه علمی دوم*</th>
                                <td id="scientificGroup2TD" hidden="hidden">
                                    <select name="scientificGroup2" id="scientificGroup2" class="form-control select2"
                                            title="گروه علمی دوم را انتخاب کنید">
                                        <option disabled selected>انتخاب کنید</option>
                                        <?php
                                        $query = mysqli_query($connection_book_signup, "select * from scientific_groups where active=1 order by title");
                                        foreach ($query as $scientific_groups):
                                            ?>
                                            <option value="<?php echo $scientific_groups['title']; ?>"><?php echo $scientific_groups['title']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </td>
                            </tr>
                        </table>

                        <div>
                            <table style="width: 100%" class="table table-striped">
                                <tr>
                                    <th colspan="6" style="text-align: center;background-color: #dee2e6">
                                        اطلاعات مشارکان
                                    </th>
                                </tr>
                                <tr>
                                    <th>نوع همکاری*</th>
                                    <td>
                                        <select name="activityType" id="activityType" class="form-control select2"
                                                title="نوع همکاری را انتخاب کنید">
                                            <option disabled selected>انتخاب کنید</option>
                                            <option value="فردی">فردی</option>
                                            <option value="مشترک">مشترک</option>
                                        </select>
                                    </td>
                                </tr>
                            </table>
                            <div hidden="hidden" id="cooperatorsTable">
                                <table id="postTable" style="width: 100%" class="table table-striped">
                                    <thead>
                                    <tr style="text-align: center">
                                        <th>ردیف</th>
                                        <th>نام</th>
                                        <th>نام خانوادگی</th>
                                        <th>کد ملی/شماره گذرنامه</th>
                                        <th>درصد همکاری</th>
                                        <th>تلفن همراه</th>
                                        <th>حذف</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td style="text-align: center; vertical-align: middle;">1</td>
                                        <td style="text-align: center; vertical-align: middle;"><input
                                                    class="form-control"
                                                    style="width: 110px; margin: 0 auto; text-align: center;"
                                                    id="coopName1" type="text"></td>
                                        <td style="text-align: center; vertical-align: middle;"><input
                                                    class="form-control"
                                                    style="width: 110px; margin: 0 auto; text-align: center;"
                                                    id="coopFamily1" type="text"></td>
                                        <td style="text-align: center; vertical-align: middle;"><input
                                                    class="form-control"
                                                    style="width: 110px; margin: 0 auto; text-align: center;"
                                                    id="coopNationalCode1" type="text"></td>
                                        <td style="text-align: center; vertical-align: middle;"><input
                                                    class="form-control"
                                                    style="width: 80px; margin: 0 auto; text-align: center;"
                                                    id="coopPer1" type="number"></td>
                                        <td style="text-align: center; vertical-align: middle;"><input
                                                    class="form-control"
                                                    style="width: 110px; margin: 0 auto; text-align: center;"
                                                    id="coopMobile1" type="text"></td>
                                        <td></td>
                                    </tr>
                                    </tbody>
                                </table>
                                <button hidden="hidden" class="btn btn-success mb-4" id="addRowButton">اضافه کردن
                                    مشارک
                                </button>

                            </div>
                        </div>

                        <table style="width: 100%" class="table table-striped">
                            <tr>
                                <th colspan="6" style="text-align: center;background-color: #dee2e6">
                                    اطلاعات تحویل اثر به دبیرخانه
                                </th>
                            </tr>
                            <tr>
                                <th colspan="3">نحوه تحویل اثر*
                                    <select style="width: 40%; margin-left: 50px" name="postDeliveryMethod"
                                            id="postDeliveryMethod" class="form-control select2"
                                            title="نحوه تحویل را انتخاب کنید">
                                        <option disabled selected>انتخاب کنید</option>
                                        <option value="physical">نسخه فیزیکی</option>
                                        <option value="digital">نسخه دیجیتال</option>
                                    </select>
                                </th>
                            </tr>
                            <tr id="filesTR" hidden="hidden">
                                <th colspan="1">فایل اثر</th>
                                <td colspan="2">
                                    <div class="custom-file">
                                        <input title="فایل اثر" accept="application/pdf,.jpg,.jpeg" type="file"
                                               class="custom-file-input" id="post_file" name="post_file">
                                        <label id="post_file_label" class="custom-file-label">انتخاب فایل</label>
                                    </div>
                                </td>
                                <th id="thesisFileTH" hidden="hidden" colspan="1">فایل صورتجلسه</th>
                                <td id="thesisFileTD" hidden="hidden" colspan="2">
                                    <div class="custom-file">
                                        <input title="فایل صورتجلسه" accept="application/pdf,.jpg,.jpeg" type="file"
                                               class="custom-file-input" id="proceedings_file" name="proceedings_file">
                                        <label id="proceedings_file_label" class="custom-file-label">انتخاب فایل</label>
                                    </div>
                                </td>
                            </tr>
                        </table>


                        <table style="width: 100%" class="table table-striped">
                            <tr>
                                <th colspan="6" style="text-align: center;background-color: #dee2e6">
                                    اطلاعات صاحب اثر
                                </th>
                            </tr>
                        </table>
                        <div style="text-align: right">
                            <h6 style="display: inline-block">ثبت اثر برای کاربر از قبل ثبت شده:</h6>
                            <select style="width: 40%; margin-left: 50px;" name="getUserInfo"
                                    id="getUserInfo" class="form-control select2"
                                    title="کاربر را انتخاب کنید">
                                <option disabled selected>انتخاب کنید</option>
                                <?php
                                $query=mysqli_query($connection_book_signup,"select * from users");
                                foreach ($query as $users):
                                ?>
                                <option value="<?php echo $users['id']; ?>"><?php echo $users['name'].' '. $users['family']. ' - '.$users['national_code']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <table style="width: 100%" class="table table-striped">
                            <tr>
                                <th>
                                    نام*
                                </th>
                                <td>
                                    <input type="text" class="form-control"
                                           placeholder="نام صاحب اثر را وارد کنید"
                                           name="fName" id="fName">
                                </td>
                                <th>
                                    نام خانوادگی*
                                </th>
                                <td>
                                    <input type="text" class="form-control"
                                           placeholder="نام خانوادگی صاحب اثر را وارد کنید"
                                           name="lName" id="lName">
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    کد ملی*
                                </th>
                                <td>
                                    <input type="text" class="form-control"
                                           placeholder="به دلیل ثبت اثر با کد ملی لطفا با دقت وارد کنید"
                                           name="national_code" id="national_code">
                                </td>
                                <th>
                                    شماره همراه*
                                </th>
                                <td>
                                    <input type="text" class="form-control"
                                           placeholder="ترجیحا شماره ای که حساب کاربری ایتا دارد"
                                           name="mobile" id="mobile">
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    جنسیت
                                </th>
                                <td>
                                    <select name="gender" id="gender" class="form-control select2"
                                            title="نوع همکاری را انتخاب کنید">
                                        <option disabled selected>انتخاب کنید</option>
                                        <option value="مرد">مرد</option>
                                        <option value="زن">زن</option>
                                    </select>
                                </td>
                                <th>
                                    شماره پرونده حوزوی
                                </th>
                                <td>
                                    <input type="text" class="form-control"
                                           placeholder="شماره پرونده حوزوی صاحب اثر را وارد کنید"
                                           name="shparvandetahsili" id="shparvandetahsili">
                                </td>
                            </tr>
                        </table>
                    </center>

                </div>
                <!-- /.card-body -->
                <center>
                    <div class="card-footer">
                        <button name="Add_Post" id="Add_Post" type="submit" class="btn btn-primary">ثبت اثر جدید
                        </button>
                    </div>
                </center>
            </form>
        </div>
        <div class="card card-primary">
            <div class="card-header">
                <form action="#submitted_posts" method="get" style="display: flex" id="showPosts">
                    <h3 class="card-title">
                        نمایش آثار ثبت شده در جشنواره
                        <select name="festival" id="festival" class="form-control select2"
                                title="جشنواره مورد نظر را انتخاب کنید">
                            <option value="" disabled selected>انتخاب کنید</option>
                            <?php
                            $query = mysqli_query($connection_book_signup, "select * from festivals order by id");
                            foreach ($query as $festivals):
                                ?>
                                <option <?php if (@$_GET['festival'] == $festivals['id']) {
                                    echo 'selected';
                                } ?> value="<?php echo $festivals['id']; ?>"><?php echo $festivals['title']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <button name="Search_Posts" id="Search_Posts" type="submit" class="btn btn-warning">جستجو</button>
                    </h3>
                </form>
            </div>
            <?php if (isset($_GET['festival'])): ?>
                <div class="card-body">
                    <table id="submitted_posts" style="width: 100%" class="table table-striped">
                        <tr>
                            <th>ردیف</th>
                            <th>عنوان</th>
                            <th>قالب علمی</th>
                            <th>گروه(های) علمی</th>
                            <th>عملیات</th>
                        </tr>
                        <?php
                        $a = 1;
                        $festival_id = $_GET['festival'];
                        $query = mysqli_query($connection_book_signup, "select * from posts where festival_id='$festival_id'");
                        foreach ($query as $posts):
                            ?>
                            <tr>
                                <td><?php echo $a++; ?></td>
                                <td><?php echo $posts['title'] ?></td>
                                <td><?php echo $posts['post_format'] ?></td>
                                <td>
                                    <?php
                                    if ($posts['scientific_group_v2'] != null and $posts['scientific_group_v2'] != 'null') {
                                        echo $posts['scientific_group_v1'] . '/' . $posts['scientific_group_v2'];
                                    } else {
                                        echo $posts['scientific_group_v1'];
                                    }
                                    ?></td>
                                <td>
                                    <button onclick="getInfo(<?php echo $posts['id']; ?>)" type="button" id="getInfo"
                                            class="btn btn-primary" data-toggle="modal" data-target="#postInformation">
                                        نمایش جزئیات
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </table>

                    <div class="modal fade" id="postInformation" tabindex="-1" role="dialog"
                         aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content" style="width:auto">
                                <div class="modal-header">
                                    <h6 style="color: red" class="modal-title" id="exampleModalLongTitle">در صورت تغییر
                                        هر فیلد، مقادیر به صورت خودکار تغییر خواهند کرد.</h6>
                                    <button type="button" style="margin-left: -10px" class="close" data-dismiss="modal"
                                            aria-label="Close">
                                        <span>&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <center>
                                        <table style="" class="table table-striped">
                                            <tr>
                                                <th colspan="6" style="text-align: center;background-color: #dee2e6">
                                                    اطلاعات اثر
                                                </th>
                                            </tr>
                                            <tr>
                                                <th colspan="1">نام اثر*</th>
                                                <td colspan="5">
                                                    <input type="text" class="form-control"
                                                           placeholder="نام اثر را وارد کنید"
                                                           name="postName" id="postNameForEdit">
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>قالب علمی*</th>
                                                <td>
                                                    <select disabled name="postFormat" id="postFormatForEdit"
                                                            class="form-control select2"
                                                            title="قابل تغییر نیست">
                                                        <option disabled selected>انتخاب کنید</option>
                                                        <option value="کتاب">کتاب</option>
                                                        <option value="پایان نامه">پایان نامه</option>
                                                    </select>
                                                </td>
                                                <th>نوع اثر*</th>
                                                <td>
                                                    <select class="form-control select2"
                                                            style="width: 100%;text-align: right" name="postTypeForEdit"
                                                            id="postTypeForEdit">
                                                        <option disabled selected>انتخاب کنید</option>
                                                        <option value="تحقیق و تألیف">تحقیق و تألیف</option>
                                                        <option value="ترجمه">ترجمه</option>
                                                        <option value="تصحیح و تعلیق">تصحیح و تعلیق</option>
                                                    </select>
                                                </td>
                                                <th>زبان*</th>
                                                <td>
                                                    <select name="languageForEdit" id="languageForEdit"
                                                            class="form-control select2"
                                                            title="قالب علمی را انتخاب کنید">
                                                        <option disabled selected>انتخاب کنید</option>
                                                        <?php
                                                        $query = mysqli_query($connection_book_signup, "select * from languages where active=1 order by title");
                                                        foreach ($query as $languages):
                                                            ?>
                                                            <option value="<?php echo $languages['title']; ?>"><?php echo $languages['title']; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr id="bookTR1ForEdit" hidden="hidden">
                                                <th>ناشر*</th>
                                                <td id="publisherTD">
                                                    <select name="publisherForEdit" id="publisherForEdit"
                                                            class="form-control select2"
                                                            title="ناشر را انتخاب کنید">
                                                        <option disabled selected>انتخاب کنید</option>
                                                        <?php
                                                        $query = mysqli_query($connection_book_signup, "select * from publishers where active=1 order by title");
                                                        foreach ($query as $publishers):
                                                            ?>
                                                            <option value="<?php echo $publishers['title']; ?>"><?php echo $publishers['title']; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </td>
                                                <th>شابک</th>
                                                <td>
                                                    <input type="text" class="form-control"
                                                           placeholder="شابک اثر را وارد کنید"
                                                           name="ISSNForEdit" id="ISSNForEdit">
                                                </td>
                                            </tr>
                                            <tr id="bookTR2ForEdit" hidden="hidden">
                                                <th>تعداد جلد*</th>
                                                <td>
                                                    <input type="text" class="form-control" value="1"
                                                           placeholder="تعداد جلد اثر را وارد کنید"
                                                           name="numberOfCoversForEdit" id="numberOfCoversForEdit">
                                                </td>
                                                <th>تیراژ*</th>
                                                <td>
                                                    <input type="text" class="form-control"
                                                           placeholder="تیراژ اثر را وارد کنید"
                                                           name="circulationForEdit" id="circulationForEdit">
                                                </td>
                                                <th>قطع*</th>
                                                <td>
                                                    <select name="bookSizeForEdit" id="bookSizeForEdit"
                                                            class="form-control select2"
                                                            title="قطع اثر را انتخاب کنید">
                                                        <option disabled selected>انتخاب کنید</option>
                                                        <option value="رحلی">رحلی</option>
                                                        <option value="رقعی">رقعی</option>
                                                        <option value="نیم رقعی">نیم رقعی</option>
                                                        <option value="وزیری">وزیری</option>
                                                        <option value="بیاضی">بیاضی</option>
                                                        <option value="پالتویی">پالتویی</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr id="thesisTR1ForEdit" hidden="hidden">
                                                <th>شماره گواهی دفاع پایان نامه*</th>
                                                <td>
                                                    <input type="text" class="form-control"
                                                           placeholder="شماره گواهی دفاع پایان نامه را وارد کنید"
                                                           name="thesisCertificateNumberForEdit"
                                                           id="thesisCertificateNumberForEdit">
                                                </td>
                                                <th>محل دفاع*</th>
                                                <td>
                                                    <input type="text" class="form-control"
                                                           placeholder="محل دفاع اثر را وارد کنید"
                                                           name="thesisDefencePlaceForEdit" id="thesisDefencePlaceForEdit">
                                                </td>
                                                <th>امتیاز پایان نامه*</th>
                                                <td>
                                                    <input type="text" class="form-control"
                                                           placeholder="امتیاز پایان نامه را وارد کنید"
                                                           name="thesisGradeForEdit" id="thesisGradeForEdit">
                                                </td>
                                            </tr>
                                            <tr id="thesisTR2ForEdit" hidden="hidden">
                                                <th>مشخصات استاد راهنما*</th>
                                                <td colspan="2">
                                                    <input type="text" class="form-control"
                                                           placeholder="نام و نام خانوادگی استاد راهنما را وارد کنید"
                                                           name="thesisSupervisorForEdit" id="thesisSupervisorForEdit">
                                                </td>
                                                <th>مشخصات استاد مشاور*</th>
                                                <td colspan="2">
                                                    <input type="text" class="form-control"
                                                           placeholder="نام و نام خانوادگی استاد مشاور را وارد کنید"
                                                           name="thesisAdvisorForEdit" id="thesisAdvisorForEdit">
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>شمارگان صفحه*</th>
                                                <td>
                                                    <input type="text" class="form-control"
                                                           placeholder="شمارگان صفحه اثر را وارد کنید"
                                                           name="pagesNumberForEdit" id="pagesNumberForEdit">
                                                </td>
                                                <th>محور ویژه</th>
                                                <td colspan="4">
                                                    <select name="specialSectionForEdit" id="specialSectionForEdit"
                                                            class="form-control select2"
                                                            title="محور ویژه را انتخاب کنید">
                                                        <option disabled selected>انتخاب کنید</option>
                                                        <?php
                                                        $query = mysqli_query($connection_book_signup, "select * from special_sections where active=1 order by title");
                                                        foreach ($query as $publishers):
                                                            ?>
                                                            <option value="<?php echo $publishers['title']; ?>"><?php echo $publishers['title']; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>ویژگی های اثر</th>
                                                <td colspan="5">
                                    <textarea name="propertiesForEdit" id="propertiesForEdit" class="form-control" rows="3"
                                              placeholder="ویژگی های اثر را وارد کنید."></textarea>
                                                    <p dir="ltr" id="wordCountForEdit">تعداد کلمات: 0</p>
                                                </td>
                                            </tr>
                                        </table>
                                        <div>
                                            <table style="width: 100%" class="table table-striped">
                                                <tr>
                                                    <th colspan="6"
                                                        style="text-align: center;background-color: #dee2e6">
                                                        اطلاعات نوع تحقیق
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th>نوع تحقیق*</th>
                                                    <td>
                                                        <select name="research_typeForEdit" id="research_typeForEdit"
                                                                class="form-control select2"
                                                                title="نوع تحقیق را انتخاب کنید">
                                                            <option disabled selected>انتخاب کنید</option>
                                                            <option value="تک رشته ای">تک رشته ای</option>
                                                            <option value="چند رشته ای">چند رشته ای</option>
                                                        </select>
                                                    </td>
                                                    <th id="scientificGroup1TH">گروه علمی اول*</th>
                                                    <td id="scientificGroup1TD">
                                                        <select name="scientificGroup1ForEdit" id="scientificGroup1ForEdit"
                                                                class="form-control select2"
                                                                title="گروه علمی اول را انتخاب کنید">
                                                            <option disabled selected>انتخاب کنید</option>
                                                            <?php
                                                            $query = mysqli_query($connection_book_signup, "select * from scientific_groups where active=1 order by title");
                                                            foreach ($query as $scientific_groups):
                                                                ?>
                                                                <option value="<?php echo $scientific_groups['title']; ?>"><?php echo $scientific_groups['title']; ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </td>
                                                    <th id="scientificGroup2THForEdit" hidden="hidden">گروه علمی دوم*
                                                    </th>
                                                    <td id="scientificGroup2TDForEdit" hidden="hidden">
                                                        <select name="scientificGroup2" id="scientificGroup2ForEdit"
                                                                class="form-control select2"
                                                                title="گروه علمی دوم را انتخاب کنید">
                                                            <option disabled selected>انتخاب کنید</option>
                                                            <?php
                                                            $query = mysqli_query($connection_book_signup, "select * from scientific_groups where active=1 order by title");
                                                            foreach ($query as $scientific_groups):
                                                                ?>
                                                                <option value="<?php echo $scientific_groups['title']; ?>"><?php echo $scientific_groups['title']; ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div>
                                            <table style="width: 100%" class="table table-striped">
                                                <tr>
                                                    <th colspan="6"
                                                        style="text-align: center;background-color: #dee2e6">
                                                        اطلاعات مشارکان
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th style="width: 20%">نوع همکاری*</th>
                                                    <td>
                                                        <select name="activityTypeForEdit" id="activityTypeForEdit"
                                                                class="form-control select2"
                                                                title="نوع همکاری را انتخاب کنید">
                                                            <option disabled selected>انتخاب کنید</option>
                                                            <option value="فردی">فردی</option>
                                                            <option value="مشترک">مشترک</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                            </table>
                                            <div hidden="hidden" id="cooperatorsTableForEdit">
                                                <table id="postTable" style="width: 100%" class="table table-striped">
                                                    <thead>
                                                    <tr style="text-align: center">
                                                        <th>ردیف</th>
                                                        <th>نام</th>
                                                        <th>نام خانوادگی</th>
                                                        <th>کد ملی/شماره گذرنامه</th>
                                                        <th>درصد همکاری</th>
                                                        <th>تلفن همراه</th>
                                                        <th>حذف</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr>
                                                        <td style="text-align: center; vertical-align: middle;">1</td>
                                                        <td style="text-align: center; vertical-align: middle;"><input
                                                                    class="form-control"
                                                                    style="width: 110px; margin: 0 auto; text-align: center;"
                                                                    id="coopName1" type="text"></td>
                                                        <td style="text-align: center; vertical-align: middle;"><input
                                                                    class="form-control"
                                                                    style="width: 110px; margin: 0 auto; text-align: center;"
                                                                    id="coopFamily1" type="text"></td>
                                                        <td style="text-align: center; vertical-align: middle;"><input
                                                                    class="form-control"
                                                                    style="width: 110px; margin: 0 auto; text-align: center;"
                                                                    id="coopNationalCode1" type="text"></td>
                                                        <td style="text-align: center; vertical-align: middle;"><input
                                                                    class="form-control"
                                                                    style="width: 80px; margin: 0 auto; text-align: center;"
                                                                    id="coopPer1" type="number"></td>
                                                        <td style="text-align: center; vertical-align: middle;"><input
                                                                    class="form-control"
                                                                    style="width: 110px; margin: 0 auto; text-align: center;"
                                                                    id="coopMobile1" type="text"></td>
                                                        <td></td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                                <button hidden="hidden" class="btn btn-success mb-4" id="addRowButton">
                                                    اضافه کردن مشارک
                                                </button>

                                            </div>
                                        </div>

                                        <table class="table table-striped">
                                            <tr>
                                                <th colspan="6" style="text-align: center;background-color: #dee2e6">
                                                    اطلاعات تحویل اثر به دبیرخانه
                                                </th>
                                            </tr>
                                            <tr>
                                                <th colspan="4">نحوه تحویل اثر*
                                                    <select style="width: 40%; margin-left: 50px"
                                                            name="postDeliveryMethod"
                                                            id="postDeliveryMethodForEdit" class="form-control select2"
                                                            title="نحوه تحویل را انتخاب کنید">
                                                        <option disabled selected>انتخاب کنید</option>
                                                        <option value="physical">نسخه فیزیکی</option>
                                                        <option value="digital">نسخه دیجیتال</option>
                                                    </select>
                                                </th>
                                            </tr>
                                            <tr id="filesTR1ForEdit" hidden="hidden">
                                                <th colspan="1">فایل اثر</th>
                                                <th colspan="1" style="width: 20%">
                                                    <a id="postFileURL" target="_blank">
                                                        دانلود فایل
                                                    </a>
                                                </th>
                                                <td colspan="3">
                                                    <div class="custom-file">
                                                        <input title="فایل اثر" accept="application/pdf,.jpg,.jpeg"
                                                               type="file"
                                                               class="custom-file-input" id="post_file"
                                                               name="post_file">
                                                        <label id="post_file_label" class="custom-file-label">انتخاب
                                                            فایل</label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr id="filesTR2ForEdit" hidden="hidden">
                                                <th id="thesisFileTH1ForEdit" hidden="hidden" colspan="1">فایل صورتجلسه
                                                </th>
                                                <th id="thesisFileTH2ForEdit" colspan="1" style="width: 20%">
                                                    <a id="thesisFileURL" target="_blank">
                                                        دانلود فایل
                                                    </a>
                                                </th>
                                                <td id="thesisFileTDForEdit" hidden="hidden" colspan="2">
                                                    <div class="custom-file">
                                                        <input title="فایل صورتجلسه" accept="application/pdf,.jpg,.jpeg"
                                                               type="file"
                                                               class="custom-file-input" id="proceedings_file"
                                                               name="proceedings_file">
                                                        <label id="proceedings_file_label" class="custom-file-label">انتخاب
                                                            فایل</label>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>

                                        <table style="width: 100%" class="table table-striped">
                                            <tr>
                                                <th colspan="6" style="text-align: center;background-color: #dee2e6">
                                                    اطلاعات صاحب اثر (در صورت تغییر اطلاعات، تمامی اطلاعاتی که با این کد ملی ثبت شده اند تغییر خواهد کرد)
                                                </th>
                                            </tr>
                                            <tr>
                                                <th>
                                                    نام*
                                                </th>
                                                <td>
                                                    <input type="text" class="form-control"
                                                           placeholder="نام صاحب اثر را وارد کنید"
                                                           name="fNameForEdit" id="fNameForEdit">
                                                </td>
                                                <th>
                                                    نام خانوادگی*
                                                </th>
                                                <td>
                                                    <input type="text" class="form-control"
                                                           placeholder="نام خانوادگی صاحب اثر را وارد کنید"
                                                           name="lNameForEdit" id="lNameForEdit">
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>
                                                    کد ملی*
                                                </th>
                                                <td>
                                                    <input type="text" class="form-control" disabled
                                                           name="national_codeForEdit" id="national_codeForEdit">
                                                </td>
                                                <th>
                                                    شماره همراه*
                                                </th>
                                                <td>
                                                    <input type="text" class="form-control"
                                                           placeholder="ترجیحا شماره ای که حساب کاربری ایتا دارد"
                                                           name="mobileForEdit" id="mobileForEdit">
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>
                                                    جنسیت
                                                </th>
                                                <td>
                                                    <select name="genderForEdit" id="genderForEdit"
                                                            class="form-control select2"
                                                            title="نوع همکاری را انتخاب کنید">
                                                        <option disabled selected>انتخاب کنید</option>
                                                        <option value="مرد">مرد</option>
                                                        <option value="زن">زن</option>
                                                    </select>
                                                </td>
                                                <th>
                                                    شماره پرونده حوزوی
                                                </th>
                                                <td>
                                                    <input type="text" class="form-control"
                                                           placeholder="شماره پرونده حوزوی صاحب اثر را وارد کنید"
                                                           name="shparvandetahsiliForEdit" id="shparvandetahsiliForEdit">
                                                </td>
                                            </tr>
                                        </table>
                                    </center>
                                    <input type="hidden" id="post_id" value="">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">بستن</button>
                                </div>
                                <script src="build/js/UpdateBookInfo.js"></script>
                                <!--    <script src="build/js/Delete_Mag.js"></script>-->
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>

    </section>
    <!-- /.content -->
    </div>

    <script src="build/js/SearchInMagManagerTable.js"></script>
    <script src="build/js/PostsManagerScripts.js"></script>
    <script src="build/js/GetBookInfo.js"></script>

<?php
endif;
include_once __DIR__ . '/footer.php'; ?>
