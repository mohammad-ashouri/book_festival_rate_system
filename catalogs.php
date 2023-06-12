<?php include_once __DIR__ . '/header.php';
if ($_SESSION['head'] == 3 or $_SESSION['head'] == 4):

    ?>
    <!-- Main content -->
    <section class="content">
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">کاتالوگ ها</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table class="table table-bordered">
                    <tr style="text-align: center">
                        <th style="width: 10px">ردیف</th>
                        <th>نام کاتالوگ</th>
                        <th>مقادیر تعریف شده کاتالوگ</th>
                        <th>عملیات</th>
                    </tr>
                    <tr>
                        <th>
                            1
                        </th>
                        <th>
                            ناشران
                        </th>
                        <td style="width: 40%">
                            <select name="publishersSubject" class="form-control" multiple
                                    id="publishersSubject" style="width: 100%; height: 450px">
                            </select>
                        </td>
                        <td style="width: 40%">
                            <div class="card card-primary">
                                <div class="card card-info">
                                    <div class="card-header">
                                        <h3 id="publishersCardTitle" class="card-title">تعریف ناشر</h3>
                                    </div>
                                    <div class="card-body text-center publisherBody">
                                        <input type="hidden" value="" id="publisherIDForUpdate">
                                        <div class="d-flex align-items-center mb-3">
                                            <label id="publisherNameForDisplayLabel" for="publisherNameForDisplay"
                                                   hidden="hidden" style="margin-left: 10px;">
                                                از
                                            </label>
                                            <input disabled class="form-control" hidden="hidden"
                                                   id="publisherNameForDisplay" value="">
                                        </div>
                                        <div class="d-flex align-items-center mb-2">
                                            <label id="publisherNameLabel" hidden="hidden" for="publisherName"
                                                   style="margin-left: 10px;">
                                                به
                                            </label>
                                            <input type="text" class="form-control" id="publisherName"
                                                   style="display: inline-block"
                                                   placeholder="نام نشریه را وارد کنید."
                                                   name="publisherName">
                                        </div>
                                        <p id="alertForCheckPublisher"></p>
                                        <button id="addPublisher" type="submit" class="btn btn-primary mt-2">اضافه
                                            کردن
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="card card-warning">
                                <div class="card-header">
                                    <h3 class="card-title">ناشران فعال</h3>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <select name="activePublisherSubject" class="form-control"
                                                id="activePublisherSubject" style="width: 100%"> </select>
                                        <button id="deactivePublisher" type="submit" class="btn btn-danger mr-2">
                                            غیرفعال
                                            کردن
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="card card-danger">
                                <div class="card-header">
                                    <h3 class="card-title">ناشران غیرفعال</h3>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <select name="deactivePublisherSubject" class="form-control"
                                                id="deactivePublisherSubject" style="width: 100%"> </select>
                                        <button id="activePublisher" type="submit" class="btn btn-success mr-2">فعال
                                            کردن
                                        </button>
                                    </div>
                                </div>
                            </div>


                        </td>
                    </tr>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
    </div>

    <!-- /.content-wrapper -->
    <script src="build/js/Catalogs.js"></script>
<?php
endif;
include_once __DIR__ . '/footer.php'; ?>
