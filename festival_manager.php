<?php include_once __DIR__ . '/header.php';
if ($_SESSION['head'] == 4):
    if (isset($_GET['NewFestival'])):
        ?>
        <div class="card card-success">
            <div class="card-header">
                <center>
                    <h3 class="card-title">فراخوان <?php echo $_GET['name'] ?> با موفقیت تعریف شد</h3>
                </center>
            </div>
            <!-- /.card-header -->
        </div>
    <?php
    elseif (isset($_GET['WrongPassword'])):
        ?>
        <div class="card card-danger">
            <div class="card-header">
                <center>
                    <h3 class="card-title">رمز عبور اشتباه می باشد.</h3>
                </center>
            </div>
            <!-- /.card-header -->
        </div>
    <?php
    elseif (isset($_GET['FestivalFounded'])):
        ?>
        <div class="card card-danger">
            <div class="card-header">
                <center>
                    <h3 class="card-title">جشنواره با این نام وجود دارد.</h3>
                </center>
            </div>
            <!-- /.card-header -->
        </div>
    <?php endif; ?>
    <!-- Main content -->
    <section class="content">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">فراخوان جدید</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <center>
                    <table style="width: 70%" class="table table-bordered">
                        <tr>
                            <th>شماره دوره</th>
                            <td>
                                <input type="number" class="form-control" id="festival_id" disabled
                                       value="<?php $last = last_festival_id($connection_book_signup);
                                       echo $last + 1; ?>">
                            </td>
                        </tr>
                        <tr>
                            <th>نام فارسی دوره*</th>
                            <td>
                                <input type="text" class="form-control" id="festival_name"
                                       placeholder="نام فارسی دوره (شماره دوره به حروف) مثلا سیزدهم"
                                       name="festival_name">
                                <p style="padding-top: 10px" id="acceptFestivalName"></p>
                            </td>
                        </tr>
                        <tr>
                            <th>تاریخ شروع فراخوان*</th>
                            <td>
                                <div class="input-group" style="width: 100%">
                                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="fa fa-calendar"></i>
                      </span>
                                    </div>
                                    <input class="festival_start_date form-control" name="start_date" id="start_date"
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>رمز عبور خود را وارد کنید*</th>
                            <td>
                                <input type="password" class="form-control" id="password"
                                       placeholder="رمز عبور خود را وارد کنید" name="password">
                            </td>
                        </tr>
                    </table>
                </center>

            </div>
            <!-- /.card-body -->
            <center>
                <div class="card-footer">
                    <button id="New_Festival" type="submit" class="btn btn-primary">تعریف فراخوان جدید</button>
                </div>
            </center>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">نمایش و مدیریت جشنواره های برگزار شده (به ترتیب دوره از آخرین به
                            اولین)</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-bordered table-striped" id="myTable">
                            <tr>
                                <th>ردیف</th>
                                <th>دوره</th>
                                <th>شروع فراخوان</th>
                                <th>راهبر سیستم</th>
                                <th>اتمام فراخوان</th>
                                <th>کاربر پایان دهنده</th>
                                <th>وضعیت</th>
                                <th>عملیات</th>
                            </tr>
                            <?php
                            $a = 1;
                            $SelectAllUsers = mysqli_query($connection_book_signup, "select * from festivals order by id");
                            foreach ($SelectAllUsers as $festivals):
                                ?>
                                <tr>
                                    <td><?php echo $a;
                                        $a++; ?></td>
                                    <td><?php echo $festivals['title']; ?></td>
                                    <td><?php echo substr($festivals['start_date'], 0, 10) ?></td>
                                    <td>
                                        <?php
                                        $starter = $festivals['starter'];
                                        $query = mysqli_query($connection_book, "select * from users where id='$starter'");
                                        foreach ($query as $starter) {
                                        }
                                        echo @$starter['name'] . ' ' . @$starter['family'];
                                        ?>
                                    </td>
                                    <td><?php echo substr($festivals['finish_date'], 0, 10) ?></td>
                                    <td>
                                        <?php
                                        $finisher = $festivals['finisher'];
                                        if ($finisher) {
                                            $query = mysqli_query($connection_book, "select name,family from users where id='$finisher'");
                                            foreach ($query as $finisher) {
                                            }
                                            echo @$finisher['name'] . ' ' . @$finisher['family'];
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        if ($festivals['active'] == 1) {
                                            echo 'فعال';
                                        } else {
                                            echo 'غیر فعال';
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        if ($festivals['active'] == 1):
                                            ?>
                                            <button class="btn btn-block btn-danger" id="finishFestival">
                                                اتمام فراخوان
                                            </button>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
    </div>

    <!-- /.content-wrapper -->

    <script src="build/js/FestivalManager.js"></script>

<?php
endif;
include_once __DIR__ . '/footer.php'; ?>
