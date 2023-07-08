<?php
include_once __DIR__ . '/header.php';
if ($_SESSION['head'] == 5 or $_SESSION['head'] == 4 or $_SESSION['head'] == 3):
    ?>
    <!-- Main content -->
    <section class="content">
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">فهرست آثار برای گونه بندی (برای دانلود اثر، بر روی عنوان کلیک فرمایید)</h3>
                <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <?php
                $query = mysqli_query($connection_book, "select * from ssmp_bookfestival.posts rate inner join book_festival_signup.posts signup on signup.id = rate.post_id WHERE signup.sorting_classification_id is null order by signup.id");
                if (!mysqli_fetch_assoc($query) > 0):
                    ?>
                    <h3 class="card-title">اثری برای گونه بندی یافت نشد.</h3>
                <?php
                else:
                    ?>
                    <table class="table table-bordered table-striped text-center" id="myTable">
                        <tr>
                            <th>ردیف</th>
                            <th>جشنواره</th>
                            <th>نام اثر</th>
                            <th>گروه علمی اول</th>
                            <th>گروه علمی دوم</th>
                            <th>تایید گونه بندی</th>
                        </tr>
                        <?php
                        $count = 1;
                        foreach ($query as $sortingPosts):
                            ?>
                            <tr>
                                <td style="width: 10px"><?php echo $count; ?></td>
                                <td style="width: 100px"><?php
                                    $query = mysqli_query($connection_book_signup, "select * from festivals where id=" . $sortingPosts['festival_id']);
                                    foreach ($query as $festivalInfo) {
                                    }
                                    echo $festivalInfo['title'];
                                    ?></td>
                                <td style="width: 350px">
                                    <?php
                                    if ($sortingPosts['post_delivery_method'] == 'نسخه دیجیتال') {
                                        ?>
                                        <a href="<?php
                                        if (str_starts_with($sortingPosts['file_src'], "Files")) {
                                            echo $sortingPosts['file_src'];
                                        } else {
                                            echo $signup_url . '/' . $sortingPosts['file_src'];
                                        }
                                        ?>" target="_blank"
                                           id='no-link' style="color: #0a53be">
                                            <?php
                                            echo $sortingPosts['title'];
                                            ?>
                                        </a>
                                    <?php } else {
                                        echo "<label>" . $sortingPosts['title'] . "</label>";
                                    }
                                    ?>
                                </td>
                                <td id="group1TD_<?php echo $count; ?>">
                                    <?php if ($sortingPosts['sorted'] == 0) { ?>
                                        <select class="form-control"
                                                onchange="sortingG1(<?php echo $sortingPosts['id']; ?>,this.value)"
                                                title="گروه علمی اول را انتخاب کنید"
                                                id="groupSelect1_<?php echo $count; ?>">
                                            <option selected disabled>انتخاب کنید</option>
                                            <?php
                                            $query = mysqli_query($connection_book_signup, 'select * from scientific_groups order by title');
                                            foreach ($query as $group_items):
                                                ?>
                                                <option <?php if ($sortingPosts['scientific_group_v1'] == $group_items['title']) echo 'selected'; ?>
                                                        value="<?php echo $group_items['title'] ?>"><?php echo $group_items['title']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <?php
                                    } else {
//                                    $query = mysqli_query($connection_book_signup, "select * from scientific_groups where title=" . $sortingPosts['scientific_group_v1']);
//                                    foreach ($query as $SG1) {
//                                    }
                                        echo "<label>" . $sortingPosts['scientific_group_v1'] . "</label>";
                                    }
                                    ?>
                                </td>
                                <td id="group2TD_<?php echo $count; ?>">
                                    <?php if ($sortingPosts['sorted'] == 0) { ?>
                                        <select class="form-control"
                                                onchange="sortingG2(<?php echo $sortingPosts['id']; ?>,this.value,<?php echo $count; ?>)"
                                                title="گروه علمی دوم را انتخاب کنید"
                                                id="groupSelect2_<?php echo $count; ?>">
                                            <option value="بدون گروه" selected>بدون گروه</option>
                                            <?php
                                            $query = mysqli_query($connection_book_signup, 'select * from scientific_groups order by title');
                                            foreach ($query as $group_items):
                                                ?>
                                                <option <?php if ($sortingPosts['scientific_group_v2'] == $group_items['title']) echo 'selected'; ?>
                                                        value="<?php echo $group_items['title'] ?>"><?php echo $group_items['title']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <?php
                                    } else {
                                        if ($sortingPosts['scientific_group_v2']) {
//                                        $query = mysqli_query($connection_book_signup, "select * from scientific_groups where title=" . $sortingPosts['scientific_group_v2']);
//                                        foreach ($query as $SG2) {
//                                        }
                                            echo "<label>" . $sortingPosts['scientific_group_v2'] . "</label>";
                                        }
                                    }
                                    ?>
                                </td>
                                <td id="buttonTD<?php echo $count; ?>">
                                    <?php if ($sortingPosts['sorted'] == 0) { ?>
                                        <button class="btn btn-block btn-warning forApprove"
                                                value="<?php echo $sortingPosts['id']; ?>"
                                                id="approveSort<?php echo $count; ?>">تایید گونه بندی
                                        </button>
                                    <?php } else {

                                        echo "<button class='btn btn-block btn-success'>تایید شده</button>";
                                    } ?>
                                </td>
                            </tr>
                            <?php $count++; endforeach;
                        ?>
                    </table>

                    <div class="card card-success mt-5">
                        <div class="card-header">
                            <h3 class="card-title">بایگانی صورتجلسه گونه بندی برای آثار تایید شده</h3>
                            <!-- /.card-tools -->
                        </div>
                        <form role="form" method="post" id="SortingClassificationForm" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="custom-file d-inline-block" style="width: 70%;">
                                    <input title="فایل صورتجلسه" accept="application/pdf,image/jpeg" type="file"
                                           class="custom-file-input" id="SortingClassificationFile"
                                           name="SortingClassificationFile">
                                    <label id="SortingClassificationFileLabel" class="custom-file-label">انتخاب
                                        فایل تاییدیه</label>
                                </div>
                                <div class="d-inline-block">
                                    <button class="btn btn-primary mt-2" type="submit"
                                            id="uploadSortingClassificationFile">
                                        بارگذاری فایل صورتجلسه
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
    </div>
    <script src="build/js/sorting.js"></script>
<?php
endif;
include_once __DIR__ . '/footer.php'; ?>