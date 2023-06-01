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
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">ثبت اثر جدید</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" method="post" action="build/php/inc/Add_Post.php" id="NewPostForm">
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
                                        <option value="تحقیق و تألیف">تحقیق و تألیف</option>
                                        <option value="ترجمه">ترجمه</option>
                                        <option value="تصحیح و تعلیق">تصحیح و تعلیق</option>
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
                                <th>تعداد جلد</th>
                                <td>
                                    <input type="text" class="form-control"
                                           placeholder="تعداد جلد اثر را وارد کنید"
                                           name="numberOfCovers" id="numberOfCovers">
                                </td>
                                <th>تیراژ</th>
                                <td>
                                    <input type="text" class="form-control"
                                           placeholder="تیراژ اثر را وارد کنید"
                                           name="circulation" id="circulation">
                                </td>
                                <th>قطع</th>
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
                                    </select>
                                </td>
                            </tr>
                            <tr id="thesisTR1" hidden="hidden">
                                <th>شماره گواهی دفاع پایان نامه*</th>
                                <td>
                                    <input type="text" class="form-control"
                                           placeholder="شماره گواهی دفاع پایان نامه را وارد کنید"
                                           name="thesisCertificateNumber" id="thesisCertificateNumber">
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
                            <div id="cooperatorsTable">
                                <table style="width: 100%" class="table table-striped">
                                    <thead>
                                    <tr style="text-align: center">
                                        <th>ردیف</th>
                                        <th>نام</th>
                                        <th>نام خانوادگی</th>
                                        <th>کد ملی/شماره گذرنامه</th>
                                        <th>شماره پرونده حوزوی</th>
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
                                                    style="width: 110px; margin: 0 auto; text-align: center;"
                                                    id="coopCode1" type="text"></td>
                                        <td style="text-align: center; vertical-align: middle;"><input
                                                    class="form-control"
                                                    style="width: 50px; margin: 0 auto; text-align: center;"
                                                    id="coopPer1" type="text"></td>
                                        <td style="text-align: center; vertical-align: middle;"><input
                                                    class="form-control"
                                                    style="width: 110px; margin: 0 auto; text-align: center;"
                                                    id="coopMobile1" type="text"></td>
                                        <td></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <button class="btn btn-success mb-4" id="addRowButton">اضافه کردن ردیف</button>
                            <script>

                            </script>

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
                    </center>

                </div>
                <!-- /.card-body -->
                <center>
                    <div class="card-footer">
                        <button name="Add_Journal" type="submit" class="btn btn-primary">ثبت اثر جدید</button>
                    </div>
                </center>

            </form>
        </div>

        <!--        <div class="row">-->
        <!--            <div class="col-12">-->
        <!--                <div class="card">-->
        <!--                    <div class="card-header">-->
        <!--                        <h3 class="card-title">نمایش و مدیریت نشریات (به ترتیب نام نشریه)</h3>-->
        <!--                        <br>-->
        <!--                        <div class="card-tools-user-manager">-->
        <!--                            <input type="search" name="table_search" class="form-control float-right"-->
        <!--                                   placeholder="لطفا برای جستجو، نام نشریه مورد نظر را تایپ نمایید"-->
        <!--                                   onkeyup="myFunction()"-->
        <!--                                   id="myInput">-->
        <!--                        </div>-->
        <!--                    </div>-->
        <!--                    <!-- /.card-header -->-->
        <!--                    <div class="card-body table-responsive p-0">-->
        <!--                        <table class="table table-bordered table-striped" id="myTable">-->
        <!--                            <tr style="text-align: center">-->
        <!--                                <th>ردیف</th>-->
        <!--                                <th>نام</th>-->
        <!--                                <th>رتبه علمی</th>-->
        <!--                                <th style="width: 100px;">گروه علمی</th>-->
        <!--                                <th>نوع نشریه</th>-->
        <!--                                <th>دوره انتشار</th>-->
        <!--                                <th>عملیات</th>-->
        <!--                            </tr>-->
        <!--                            --><?php
        //                            $a = 1;
        //                            $SelectAllMagInfos = mysqli_query($connection_mag, "select * from mag_info where deleted =0 order by active desc,name asc");
        //                            foreach ($SelectAllMagInfos as $mag_info):
        //                                $admin_id = $mag_info['admin_id'];
        //                                $query = mysqli_query($connection_mag, "select * from mag_admins where id='$admin_id'");
        //                                foreach ($query as $mag_admin) {
        //                                }
        //
        ?>
        <!--                                <tr>-->
        <!--                                    <td>--><?php //echo $a;
        //                                        $a++;
        ?><!--</td>-->
        <!--                                    <td>-->
        <!--                                        --><?php
        //                                        echo $mag_info['name'];
        //
        ?>
        <!--                                    </td>-->
        <!--                                    <td>-->
        <!--                                        --><?php
        //                                        echo $mag_info['science_rank'];
        //
        ?>
        <!--                                    </td>-->
        <!--                                    <td>-->
        <!--                                        --><?php
        //                                        echo $mag_info['scientific_group'];
        //
        ?>
        <!--                                    </td>-->
        <!--                                    <td>-->
        <!--                                        --><?php
        //                                        echo $mag_info['mag_type'];
        //
        ?>
        <!--                                    </td>-->
        <!--                                    <td>-->
        <!--                                        --><?php
        //                                        echo $mag_info['publication_period'];
        //
        ?>
        <!--                                    </td>-->
        <!--                                    <td>-->
        <!--                                        <button type="button" class="btn btn-primary" data-toggle="modal"-->
        <!--                                                onclick="getInfo(--><?php //echo $mag_info['id']
        ?>//)"
        // data-target="#editModal">
        // جزئیات و ویرایش
        //                                        </button>
        //
        <button type="button" class="btn btn-danger d-inline-block" data-toggle="modal"
        // data-mag-id="<?php //echo $mag_info['id']
        ?><!--"-->
        <!--                                                data-target="#deleteMagModal" id="deleteMag">-->
        <!--                                            حذف-->
        <!--                                        </button>-->
        <!--                                        <form id="editMagForm">-->
        <!--                                            <div class="modal fade" id="editModal" tabindex="-1"-->
        <!--                                                 aria-labelledby="exampleModalLabel" aria-hidden="true">-->
        <!--                                                <div class="modal-dialog">-->
        <!--                                                    <div class="modal-content" style="width: 800px">-->
        <!--                                                        <div class="modal-header">-->
        <!--                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">ویرایش-->
        <!--                                                                اطلاعات نشریه</h1>-->
        <!--                                                            <button type="button" class="btn-close"-->
        <!--                                                                    data-bs-dismiss="modal"-->
        <!--                                                                    aria-label="Close"></button>-->
        <!--                                                        </div>-->
        <!--                                                        <div class="modal-body">-->
        <!--                                                            <table style="width: 100%" class="table table-bordered">-->
        <!--                                                                <tr>-->
        <!--                                                                    <th colspan="2"-->
        <!--                                                                        style="text-align: center;background-color: #dee2e6">-->
        <!--                                                                        اطلاعات نشریه-->
        <!--                                                                    </th>-->
        <!--                                                                </tr>-->
        <!--                                                                <tr>-->
        <!--                                                                    <th>نام نشریه*</th>-->
        <!--                                                                    <td>-->
        <!--                                                                        <input type="text" class="form-control"-->
        <!--                                                                               id="editedName"-->
        <!--                                                                               placeholder="نام نشریه را وارد کنید"-->
        <!--                                                                               name="name">-->
        <!--                                                                    </td>-->
        <!--                                                                </tr>-->
        <!--                                                                <tr>-->
        <!--                                                                    <th>رتبه علمی مجله*</th>-->
        <!--                                                                    <td>-->
        <!--                                                                        <select name="science_rank"-->
        <!--                                                                                id="editedScienceRank"-->
        <!--                                                                                class="form-control select2"-->
        <!--                                                                                title="نسخه نشریه را انتخاب کنید">-->
        <!--                                                                            <option disabled>انتخاب کنید</option>-->
        <!--                                                                            <option value="علمی پژوهشی">علمی پژوهشی-->
        <!--                                                                            </option>-->
        <!--                                                                            <option value="علمی ترویجی">علمی ترویجی-->
        <!--                                                                            </option>-->
        <!--                                                                        </select>-->
        <!--                                                                    </td>-->
        <!--                                                                </tr>-->
        <!--                                                                <tr>-->
        <!--                                                                    <th>گروه علمی*</th>-->
        <!--                                                                    <td>-->
        <!--                                                                        <select class="form-control select2"-->
        <!--                                                                                multiple="multiple"-->
        <!--                                                                                title="گروه علمی نشریه را انتخاب کنید (با گرفتن کلید ctrl می توانید چند گروه علمی انتخاب نمایید)"-->
        <!--                                                                                style="width: 100%;text-align: right"-->
        <!--                                                                                name="scientific_group[]"-->
        <!--                                                                                id="editedScientificGroup">-->
        <!--                                                                            --><?php
        //                                                                            $query = mysqli_query($connection_maghalat, 'select * from scientific_group order by name asc');
        //                                                                            foreach ($query as $group_items):
        //
        ?>
        <!--                                                                                <option-->
        <!--                                                                                    value="-->
        <?php //echo $group_items['name']
        ?><!--">--><?php //echo $group_items['name'];
        ?><!--</option>-->
        <!--                                                                            --><?php //endforeach;
        ?>
        <!--                                                                        </select>-->
        <!--                                                                    </td>-->
        <!--                                                                </tr>-->
        <!--                                                                <tr>-->
        <!--                                                                    <th>جایگاه بین المللی*</th>-->
        <!--                                                                    <td>-->
        <!--                                                                        <select id="editedInternationalPosition"-->
        <!--                                                                                name="international_position[]"-->
        <!--                                                                                class="form-control select2"-->
        <!--                                                                                multiple="multiple"-->
        <!--                                                                                title="جایگاه بین المللی را انتخاب کنید (با گرفتن کلید ctrl می توانید چند جایگاه بین المللی انتخاب نمایید)">-->
        <!--                                                                            --><?php
        //                                                                            $query = mysqli_query($connection_variables, 'select * from international_position order by subject asc');
        //                                                                            foreach ($query as $international_position_items):
        //
        ?>
        <!--                                                                                <option-->
        <!--                                                                                    value="-->
        <?php //echo $international_position_items['subject']
        ?><!--">--><?php //echo $international_position_items['subject'];
        ?><!--</option>-->
        <!--                                                                            --><?php //endforeach;
        ?>
        <!--                                                                        </select>-->
        <!--                                                                    </td>-->
        <!--                                                                </tr>-->
        <!--                                                                <tr>-->
        <!--                                                                    <th>نوع نشریه*</th>-->
        <!--                                                                    <td>-->
        <!--                                                                        <select class="form-control select2"-->
        <!--                                                                                id="editedMagType"-->
        <!--                                                                                name="type"-->
        <!--                                                                                title="نوع نشریه را انتخاب کنید">-->
        <!--                                                                            <option selected disabled>انتخاب کنید-->
        <!--                                                                            </option>-->
        <!--                                                                            <option>دانشگاهی</option>-->
        <!--                                                                            <option>حوزوی</option>-->
        <!--                                                                        </select>-->
        <!--                                                                    </td>-->
        <!--                                                                </tr>-->
        <!--                                                                <tr>-->
        <!--                                                                    <th>دوره انتشار*</th>-->
        <!--                                                                    <td>-->
        <!--                                                                        <select class="form-control select2"-->
        <!--                                                                                id="editedPublicationPeriod"-->
        <!--                                                                                name="publication_period"-->
        <!--                                                                                title="دوره انتشار نشریه را انتخاب کنید">-->
        <!--                                                                            <option selected disabled>انتخاب کنید-->
        <!--                                                                            </option>-->
        <!--                                                                            --><?php
        //                                                                            $query = mysqli_query($connection_variables, 'select * from publication_period order by subject asc');
        //                                                                            foreach ($query as $publication_period_items):
        //
        ?>
        <!--                                                                                <option-->
        <!--                                                                                    value="-->
        <?php //echo $publication_period_items['subject']
        ?><!--">--><?php //echo $publication_period_items['subject'];
        ?><!--</option>-->
        <!--                                                                            --><?php //endforeach;
        ?>
        <!--                                                                        </select>-->
        <!--                                                                    </td>-->
        <!--                                                                </tr>-->
        <!--                                                                <tr>-->
        <!--                                                                    <th>شاپا*</th>-->
        <!--                                                                    <td>-->
        <!--                                                                        <input type="text" class="form-control"-->
        <!--                                                                               id="editedISSN"-->
        <!--                                                                               placeholder="شاپا را وارد کنید"-->
        <!--                                                                               name="ISSN">-->
        <!--                                                                    </td>-->
        <!--                                                                </tr>-->
        <!--                                                                <tr>-->
        <!--                                                                    <th>استان*</th>-->
        <!--                                                                    <td>-->
        <!--                                                                        <input type="text" class="form-control"-->
        <!--                                                                               id="editedMagState"-->
        <!--                                                                               placeholder="استان را وارد کنید"-->
        <!--                                                                               name="mag_state">-->
        <!--                                                                    </td>-->
        <!--                                                                </tr>-->
        <!--                                                                <tr>-->
        <!--                                                                    <th>شهر*</th>-->
        <!--                                                                    <td>-->
        <!--                                                                        <input type="text" class="form-control"-->
        <!--                                                                               id="editedMagCity"-->
        <!--                                                                               placeholder="شهر را وارد کنید"-->
        <!--                                                                               name="mag_city">-->
        <!--                                                                    </td>-->
        <!--                                                                </tr>-->
        <!--                                                                <tr>-->
        <!--                                                                    <th>آدرس کامل</th>-->
        <!--                                                                    <td>-->
        <!--                                                                        <textarea class="form-control" rows="3"-->
        <!--                                                                                  placeholder="آدرس کامل را وارد نمایید"-->
        <!--                                                                                  id="editedMagAddress"-->
        <!--                                                                                  name="mag_address"></textarea>-->
        <!--                                                                    </td>-->
        <!--                                                                </tr>-->
        <!--                                                                <tr>-->
        <!--                                                                    <th>تلفن ثابت*</th>-->
        <!--                                                                    <td>-->
        <!--                                                                        <input type="text" class="form-control"-->
        <!--                                                                               id="editedMagPhone"-->
        <!--                                                                               placeholder="تلفن ثابت را وارد کنید"-->
        <!--                                                                               name="mag_phone">-->
        <!--                                                                    </td>-->
        <!--                                                                </tr>-->
        <!--                                                                <tr>-->
        <!--                                                                    <th>دورنگار</th>-->
        <!--                                                                    <td>-->
        <!--                                                                        <input type="text" class="form-control"-->
        <!--                                                                               id="editedMagFax"-->
        <!--                                                                               placeholder="دورنگار را وارد کنید"-->
        <!--                                                                               name="mag_fax">-->
        <!--                                                                    </td>-->
        <!--                                                                </tr>-->
        <!--                                                                <tr>-->
        <!--                                                                    <th>ایمیل*</th>-->
        <!--                                                                    <td>-->
        <!--                                                                        <input type="email" class="form-control"-->
        <!--                                                                               id="editedMagEmail"-->
        <!--                                                                               placeholder="ایمیل را وارد کنید"-->
        <!--                                                                               name="mag_email">-->
        <!--                                                                    </td>-->
        <!--                                                                </tr>-->
        <!--                                                                <tr>-->
        <!--                                                                    <th>پایگاه اینترنتی</th>-->
        <!--                                                                    <td>-->
        <!--                                                                        <input type="" class="form-control"-->
        <!--                                                                               id="editedWebsite"-->
        <!--                                                                               placeholder="پایگاه اینترنتی را وارد کنید"-->
        <!--                                                                               name="mag_website">-->
        <!--                                                                    </td>-->
        <!--                                                                </tr>-->
        <!--                                                                <tr>-->
        <!--                                                                    <th>نوع کاربری صاحب امتیاز*</th>-->
        <!--                                                                    <td>-->
        <!--                                                                        <select class="form-control select2"-->
        <!--                                                                                title="نوع کاربری صاحب امتیاز را انتخاب کنید"-->
        <!--                                                                                style="width: 100%;text-align: right"-->
        <!--                                                                                name="editedConcessionaireType"-->
        <!--                                                                                id="editedConcessionaireType">-->
        <!--                                                                            <option disabled>انتخاب کنید</option>-->
        <!--                                                                            <option value="حقیقی">حقیقی</option>-->
        <!--                                                                            <option value="حقوقی">حقوقی</option>-->
        <!--                                                                        </select>-->
        <!--                                                                    </td>-->
        <!--                                                                </tr>-->
        <!--                                                                <tr>-->
        <!--                                                                    <th>صاحب امتیاز*</th>-->
        <!--                                                                    <td>-->
        <!--                                                                        <input type="text" class="form-control"-->
        <!--                                                                               id="editedConcessionaire"-->
        <!--                                                                               placeholder="اطلاعات صاحب امتیاز را وارد کنید"-->
        <!--                                                                               name="concessionaire">-->
        <!--                                                                    </td>-->
        <!--                                                                </tr>-->
        <!--                                                            </table>-->
        <!--                                                            <div class="card-body">-->
        <!--                                                                <div class="card-header"-->
        <!--                                                                     style="background-color: #dee2e6;text-align: center; color: #212529; font-weight: bold ">-->
        <!--                                                                    اطلاعات مدیر مسئول-->
        <!--                                                                </div>-->
        <!--                                                                <table style="width: 100%" class="table table-bordered">-->
        <!---->
        <!--                                                                    <tr>-->
        <!--                                                                        <th>عنوان*</th>-->
        <!--                                                                        <td>-->
        <!--                                                                            <select class="form-control select2"-->
        <!--                                                                                    title="عنوان مدیر مسئول را انتخاب کنید"-->
        <!--                                                                                    style="width: 100%;text-align: right"-->
        <!--                                                                                    name="responsible_manager_owner_subject"-->
        <!--                                                                                    id="editedResponsibleManagerOwnerSubject">-->
        <!--                                                                                <option disabled selected>انتخاب کنید-->
        <!--                                                                                </option>-->
        <!--                                                                                --><?php
        //                                                                                $query = mysqli_query($connection_variables, 'select * from person_subjects order by subject asc');
        //                                                                                foreach ($query as $person_subjects_items):
        //
        ?>
        <!--                                                                                    <option-->
        <!--                                                                                        value="-->
        <?php //echo $person_subjects_items['subject']
        ?><!--">--><?php //echo $person_subjects_items['subject'];
        ?><!--</option>-->
        <!--                                                                                --><?php //endforeach;
        ?>
        <!--                                                                            </select>-->
        <!--                                                                        </td>-->
        <!--                                                                    </tr>-->
        <!--                                                                    <tr>-->
        <!--                                                                        <th>نام و نام خانوادگی*</th>-->
        <!--                                                                        <td>-->
        <!--                                                                            <input type="text"-->
        <!--                                                                                   style="width: 49%; display: inline-block"-->
        <!--                                                                                   class="form-control"-->
        <!--                                                                                   id="editedResponsibleManagerOwnerName"-->
        <!--                                                                                   placeholder="نام"-->
        <!--                                                                                   name="responsible_manager_owner_name">-->
        <!--                                                                            <input type="text"-->
        <!--                                                                                   style="width: 49%; display: inline-block"-->
        <!--                                                                                   class="form-control"-->
        <!--                                                                                   id="editedResponsibleManagerOwnerFamily"-->
        <!--                                                                                   placeholder="نام خانوادگی"-->
        <!--                                                                                   name="responsible_manager_owner_family">-->
        <!--                                                                        </td>-->
        <!--                                                                    </tr>-->
        <!--                                                                    <tr>-->
        <!--                                                                        <th>مدرک*</th>-->
        <!--                                                                        <td>-->
        <!--                                                                            <select class="form-control"-->
        <!--                                                                                    title="مدرک مدیر مسئول را انتخاب کنید"-->
        <!--                                                                                    id="editedResponsibleManagerOwnerDegree"-->
        <!--                                                                                    name="responsible_manager_owner_degree">-->
        <!--                                                                                <option selected disabled>انتخاب کنید-->
        <!--                                                                                </option>-->
        <!--                                                                                --><?php
        //                                                                                $query = mysqli_query($connection_variables, 'select * from degree order by subject asc');
        //                                                                                foreach ($query as $degree_items):
        //
        ?>
        <!--                                                                                    <option-->
        <!--                                                                                        value="-->
        <?php //echo $degree_items['subject']
        ?><!--">--><?php //echo $degree_items['subject'];
        ?><!--</option>-->
        <!--                                                                                --><?php //endforeach;
        ?>
        <!--                                                                            </select>-->
        <!--                                                                        </td>-->
        <!--                                                                    </tr>-->
        <!--                                                                    <tr>-->
        <!--                                                                        <th>تلفن ثابت*</th>-->
        <!--                                                                        <td>-->
        <!--                                                                            <input type="text" class="form-control"-->
        <!--                                                                                   id="editedResponsibleManagerOwnerPhone"-->
        <!--                                                                                   placeholder="تلفن ثابت مدیر مسئول را وارد کنید"-->
        <!--                                                                                   name="responsible_manager_owner_phone">-->
        <!--                                                                        </td>-->
        <!--                                                                    </tr>-->
        <!--                                                                    <tr>-->
        <!--                                                                        <th>تلفن همراه*</th>-->
        <!--                                                                        <td>-->
        <!--                                                                            <input type="text" class="form-control"-->
        <!--                                                                                   id="editedResponsibleManagerOwnerMobile"-->
        <!--                                                                                   placeholder="تلفن همراه مدیر مسئول را وارد کنید"-->
        <!--                                                                                   name="responsible_manager_owner_mobile">-->
        <!--                                                                        </td>-->
        <!--                                                                    </tr>-->
        <!--                                                                    <tr>-->
        <!--                                                                        <th>آدرس</th>-->
        <!--                                                                        <td>-->
        <!--                                                                <textarea class="form-control" rows="3"-->
        <!--                                                                          placeholder="آدرس مدیر مسئول را وارد نمایید"-->
        <!--                                                                          id="editedResponsibleManagerOwnerAddress"-->
        <!--                                                                          name="responsible_manager_owner_address"></textarea>-->
        <!--                                                                        </td>-->
        <!--                                                                    </tr>-->
        <!--                                                                </table>-->
        <!--                                                                <br/>-->
        <!--                                                                <div class="card-header"-->
        <!--                                                                     style="background-color: #dee2e6;text-align: center; color: #212529; font-weight: bold ">-->
        <!--                                                                    اطلاعات سردبیر-->
        <!--                                                                </div>-->
        <!--                                                                <table style="width: 100%" class="table table-bordered">-->
        <!--                                                                    <tr>-->
        <!--                                                                        <th>عنوان*</th>-->
        <!--                                                                        <td>-->
        <!--                                                                            <select class="form-control select2"-->
        <!--                                                                                    title="عنوان سردبیر را انتخاب کنید"-->
        <!--                                                                                    style="width: 100%;text-align: right"-->
        <!--                                                                                    name="chief_editor_subject"-->
        <!--                                                                                    id="editedChiefEditorSubject">-->
        <!--                                                                                <option disabled selected>انتخاب کنید-->
        <!--                                                                                </option>-->
        <!--                                                                                --><?php
        //                                                                                $query = mysqli_query($connection_variables, 'select * from person_subjects order by subject asc');
        //                                                                                foreach ($query as $person_subjects_items):
        //
        ?>
        <!--                                                                                    <option-->
        <!--                                                                                        value="-->
        <?php //echo $person_subjects_items['subject']
        ?><!--">--><?php //echo $person_subjects_items['subject'];
        ?><!--</option>-->
        <!--                                                                                --><?php //endforeach;
        ?>
        <!--                                                                            </select>-->
        <!--                                                                        </td>-->
        <!--                                                                    </tr>-->
        <!--                                                                    <tr>-->
        <!--                                                                        <th>نام و نام خانوادگی*</th>-->
        <!--                                                                        <td>-->
        <!--                                                                            <input type="text"-->
        <!--                                                                                   style="width: 49%; display: inline-block"-->
        <!--                                                                                   class="form-control"-->
        <!--                                                                                   id="editedChiefEditorName"-->
        <!--                                                                                   placeholder="نام"-->
        <!--                                                                                   name="chief_editor_name">-->
        <!--                                                                            <input type="text"-->
        <!--                                                                                   style="width: 50%; display: inline-block"-->
        <!--                                                                                   class="form-control"-->
        <!--                                                                                   id="editedChiefEditorFamily"-->
        <!--                                                                                   placeholder="نام خانوادگی"-->
        <!--                                                                                   name="chief_editor_family">-->
        <!--                                                                        </td>-->
        <!--                                                                    </tr>-->
        <!--                                                                    <tr>-->
        <!--                                                                        <th>مدرک*</th>-->
        <!--                                                                        <td>-->
        <!--                                                                            <select class="form-control"-->
        <!--                                                                                    title="مدرک سردبیر را انتخاب کنید"-->
        <!--                                                                                    id="editedChiefEditorDegree"-->
        <!--                                                                                    name="chief_editor_degree">-->
        <!--                                                                                <option selected disabled>انتخاب کنید-->
        <!--                                                                                </option>-->
        <!--                                                                                --><?php
        //                                                                                $query = mysqli_query($connection_variables, 'select * from degree order by subject asc');
        //                                                                                foreach ($query as $degree_items):
        //
        ?>
        <!--                                                                                    <option-->
        <!--                                                                                        value="-->
        <?php //echo $degree_items['subject']
        ?><!--">--><?php //echo $degree_items['subject'];
        ?><!--</option>-->
        <!--                                                                                --><?php //endforeach;
        ?>
        <!--                                                                            </select>-->
        <!--                                                                        </td>-->
        <!--                                                                    </tr>-->
        <!--                                                                    <tr>-->
        <!--                                                                        <th>تلفن ثابت*</th>-->
        <!--                                                                        <td>-->
        <!--                                                                            <input type="text" class="form-control"-->
        <!--                                                                                   id="editedChiefEditorPhone"-->
        <!--                                                                                   placeholder="تلفن ثابت سردبیر را وارد کنید"-->
        <!--                                                                                   name="chief_editor_phone">-->
        <!--                                                                        </td>-->
        <!--                                                                    </tr>-->
        <!--                                                                    <tr>-->
        <!--                                                                        <th>تلفن همراه*</th>-->
        <!--                                                                        <td>-->
        <!--                                                                            <input type="text" class="form-control"-->
        <!--                                                                                   id="editedChiefEditorMobile"-->
        <!--                                                                                   placeholder="تلفن همراه سردبیر را وارد کنید"-->
        <!--                                                                                   name="chief_editor_mobile">-->
        <!--                                                                        </td>-->
        <!--                                                                    </tr>-->
        <!--                                                                    <tr>-->
        <!--                                                                        <th>آدرس</th>-->
        <!--                                                                        <td>-->
        <!--                                                                <textarea class="form-control" rows="3"-->
        <!--                                                                          placeholder="آدرس سردبیر را وارد نمایید"-->
        <!--                                                                          id="editedChiefEditorAddress"-->
        <!--                                                                          name="chief_editor_address"></textarea>-->
        <!--                                                                        </td>-->
        <!--                                                                    </tr>-->
        <!--                                                                </table>-->
        <!--                                                                <br/>-->
        <!--                                                                <div class="card-header"-->
        <!--                                                                     style="background-color: #dee2e6;text-align: center; color: #212529; font-weight: bold ">-->
        <!--                                                                    اطلاعات مدیر اجرایی-->
        <!--                                                                </div>-->
        <!--                                                                <table style="width: 100%" class="table table-bordered">-->
        <!--                                                                    <tr>-->
        <!--                                                                        <th>عنوان*</th>-->
        <!--                                                                        <td>-->
        <!--                                                                            <select class="form-control select2"-->
        <!--                                                                                    title="عنوان مدیر اجرایی را انتخاب کنید"-->
        <!--                                                                                    style="width: 100%;text-align: right"-->
        <!--                                                                                    name="administration_manager_subject"-->
        <!--                                                                                    id="editedAdministrationManagerSubject">-->
        <!--                                                                                <option disabled selected>انتخاب کنید-->
        <!--                                                                                </option>-->
        <!--                                                                                --><?php
        //                                                                                $query = mysqli_query($connection_variables, 'select * from person_subjects order by subject asc');
        //                                                                                foreach ($query as $person_subjects_items):
        //
        ?>
        <!--                                                                                    <option-->
        <!--                                                                                        value="-->
        <?php //echo $person_subjects_items['subject']
        ?><!--">--><?php //echo $person_subjects_items['subject'];
        ?><!--</option>-->
        <!--                                                                                --><?php //endforeach;
        ?>
        <!--                                                                            </select>-->
        <!--                                                                        </td>-->
        <!--                                                                    </tr>-->
        <!--                                                                    <tr>-->
        <!--                                                                        <th>نام و نام خانوادگی*</th>-->
        <!--                                                                        <td>-->
        <!--                                                                            <input type="text"-->
        <!--                                                                                   style="width: 49%; display: inline-block"-->
        <!--                                                                                   class="form-control"-->
        <!--                                                                                   id="editedAdministrationManagerName"-->
        <!--                                                                                   placeholder="نام"-->
        <!--                                                                                   name="administration_manager_name">-->
        <!--                                                                            <input type="text"-->
        <!--                                                                                   style="width: 50%; display: inline-block"-->
        <!--                                                                                   class="form-control"-->
        <!--                                                                                   id="editedAdministrationManagerFamily"-->
        <!--                                                                                   placeholder="نام خانوادگی"-->
        <!--                                                                                   name="administration_manager_family">-->
        <!--                                                                        </td>-->
        <!--                                                                    </tr>-->
        <!--                                                                    <tr>-->
        <!--                                                                        <th>مدرک*</th>-->
        <!--                                                                        <td>-->
        <!---->
        <!--                                                                            <select class="form-control"-->
        <!--                                                                                    title="مدرک مدیر اجرایی را انتخاب کنید"-->
        <!--                                                                                    id="editedAdministrationManagerDegree"-->
        <!--                                                                                    name="administration_manager_degree">-->
        <!--                                                                                <option selected disabled>انتخاب کنید-->
        <!--                                                                                </option>-->
        <!--                                                                                --><?php
        //                                                                                $query = mysqli_query($connection_variables, 'select * from degree order by subject asc');
        //                                                                                foreach ($query as $degree_items):
        //
        ?>
        <!--                                                                                    <option-->
        <!--                                                                                        value="-->
        <?php //echo $degree_items['subject']
        ?><!--">--><?php //echo $degree_items['subject'];
        ?><!--</option>-->
        <!--                                                                                --><?php //endforeach;
        ?>
        <!--                                                                            </select>-->
        <!--                                                                        </td>-->
        <!--                                                                    </tr>-->
        <!--                                                                    <tr>-->
        <!--                                                                        <th>تلفن ثابت*</th>-->
        <!--                                                                        <td>-->
        <!--                                                                            <input type="text" class="form-control"-->
        <!--                                                                                   id="editedAdministrationManagerPhone"-->
        <!--                                                                                   placeholder="تلفن ثابت مدیر اجرایی را وارد کنید"-->
        <!--                                                                                   name="administration_manager_phone">-->
        <!--                                                                        </td>-->
        <!--                                                                    </tr>-->
        <!--                                                                    <tr>-->
        <!--                                                                        <th>تلفن همراه*</th>-->
        <!--                                                                        <td>-->
        <!--                                                                            <input type="text" class="form-control"-->
        <!--                                                                                   id="editedAdministrationManagerMobile"-->
        <!--                                                                                   placeholder="تلفن همراه مدیر اجرایی را وارد کنید"-->
        <!--                                                                                   name="administration_manager_mobile">-->
        <!--                                                                        </td>-->
        <!--                                                                    </tr>-->
        <!--                                                                    <tr>-->
        <!--                                                                        <th>آدرس</th>-->
        <!--                                                                        <td>-->
        <!--                                                                <textarea class="form-control" rows="3"-->
        <!--                                                                          placeholder="آدرس مدیر اجرایی را وارد نمایید"-->
        <!--                                                                          id="editedAdministrationManagerAddress"-->
        <!--                                                                          name="administration_manager_address"></textarea>-->
        <!--                                                                        </td>-->
        <!--                                                                    </tr>-->
        <!--                                                                </table>-->
        <!--                                                            </div>-->
        <!--                                                        </div>-->
        <!---->
        <!--                                                        <input type="hidden" value="" id="postID">-->
        <!--                                                        <div class="modal-footer">-->
        <!--                                                            <button type="button" class="btn btn-secondary"-->
        <!--                                                                    aria-hidden="true" id="closeModal"-->
        <!--                                                                    data-bs-dismiss="modal">بستن-->
        <!--                                                            </button>-->
        <!--                                                            <button type="button" id="updateJournal"-->
        <!--                                                                    class="btn btn-primary">-->
        <!--                                                                ذخیره تغییرات-->
        <!--                                                            </button>-->
        <!--                                                        </div>-->
        <!--                                                    </div>-->
        <!--                                                </div>-->
        <!--                                            </div>-->
        <!--                                        </form>-->
        <!--                                    </td>-->
        <!--                                </tr>-->
        <!--                            --><?php //endforeach;
        ?>
        <!--                        </table>-->
        <!--                    </div>-->
        <!--                    <!-- /.card-body -->-->
        <!--                </div>-->
        <!--                <!-- /.card -->-->
        <!--            </div>-->
        <!--        </div>-->
        <!-- /.card -->

    </section>
    <!-- /.content -->
    </div>

    <!-- /.content-wrapper -->
    <script>
        $(document).ready(function () {
            $('.modal-toggle').click(function () {
                $('#editModal').modal('toggle');
            });
        });
    </script>

    <script src="build/js/SearchInMagManagerTable.js"></script>
    <script src="build/js/PostsManagerScripts.js"></script>
    <script src="build/js/GetMagInfo.js"></script>
    <!--    <script src="build/js/UpdateMagInfo.js"></script>-->
    <!--    <script src="build/js/Delete_Mag.js"></script>-->
<?php
endif;
include_once __DIR__ . '/footer.php'; ?>
