<!-- Main content -->
<section class="content">
    <div class="card card-success">
        <div class="card-header">
            <h3 class="card-title">فهرست آثار برای ارزیابی (برای نمایش اثر، بر روی عنوان کلیک نمایید)</h3>
            <!-- /.card-tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table class="table table-bordered table-striped text-center" id="myTable">
                <tr style="font-size: 15px;">
                    <th>ردیف</th>
                    <th>عنوان اثر</th>
                    <th>قالب اثر</th>
                    <th>گروه علمی</th>
                    <th>زبان</th>
                    <th>توضیحات</th>
                    <th>عملیات ارزیابی</th>
                </tr>
                <?php
                $a = 1;
                $MyGroup = $_SESSION['group'];
                $Me = $_SESSION['id'];
                $query = mysqli_query($connection_book, "select * from ssmp_bookfestival.posts rate inner join book_festival_signup.posts signup on signup.id = rate.post_id WHERE signup.sorting_classification_id is not null and rate.rate_status='اجمالی' and (rate.ejmali1_ratercode_g1='$Me' or rate.ejmali2_ratercode_g1='$Me' or rate.ejmali3_ratercode_g1='$Me') order by signup.id");
                foreach ($query as $Ejmali_list):
                    ?>
                    <tr>
                        <td>
                            <?php echo $a;
                            $a++; ?>
                        </td>
                        <td>
                            <?php
                            if ($Ejmali_list['post_delivery_method'] == 'نسخه دیجیتال') {
                                ?>
                                <a href="<?php
                                if (str_starts_with($Ejmali_list['file_src'], "Files")) {
                                    echo $Ejmali_list['file_src'];
                                } else {
                                    echo $signup_url . '/' . $Ejmali_list['file_src'];
                                }
                                ?>" target="_blank"
                                   id='no-link' style="color: #0a53be">
                                    <?php
                                    echo $Ejmali_list['title'];
                                    ?>
                                </a>
                            <?php } else {
                                echo "<label>" . $Ejmali_list['title'] . "</label>";
                            }
                            ?>
                        </td>
                        <td>
                            <?php echo $Ejmali_list['post_format'] ?>
                        </td>
                        <td>
                            <?php
                            echo $groupID = $Ejmali_list['scientific_group_v1'];
                            ?>
                        </td>
                        <td>
                            <?php
                            echo $Ejmali_list['language'];
                            ?>
                        </td>
                        <td>
                            <?php
                            if ($Ejmali_list['post_format']=='کتاب'){
                                echo 'وضعیت نشر: '.$Ejmali_list['publish_status']."<br>";
                                echo 'تعداد جلد: '.$Ejmali_list['number_of_covers']."<br>";
                                echo 'قطع: '.$Ejmali_list['book_size']."<br>";
                                echo 'تیراژ: '.$Ejmali_list['circulation']."<br>";
                            }elseif ($Ejmali_list['post_format']=='پایان نامه'){
                                if ($Ejmali_list['thesis_certificate_number']==0){
                                    $Ejmali_list['thesis_certificate_number']='بدون شماره ثبت شده';
                                }
                                echo 'شماره گواهی دفاع پایان نامه: '.$Ejmali_list['thesis_certificate_number']."<br>";
                                echo 'محل دفاع: '.$Ejmali_list['thesis_defence_place']."<br>";
                                echo 'امتیاز پایان نامه: '.$Ejmali_list['thesis_grade']."<br>";
                            }
                            ?>
                        </td>
                        <td>
                            <form action="Rate.php" method="post">
                                <input type="hidden" name="id" value="<?php echo $Ejmali_list['id']; ?>">
                                <input type="hidden" name="rate_status"
                                       value="<?php
                                       if ($Ejmali_list['ejmali1_ratercode_g1'] == $Me and $Ejmali_list['ejmali1_g1_done'] == 0) {
                                           echo 'ej1g1';
                                       } elseif ($Ejmali_list['ejmali2_ratercode_g1'] == $Me and $Ejmali_list['ejmali2_g1_done'] == 0) {
                                           echo 'ej2g1';
                                       } elseif ($Ejmali_list['ejmali3_ratercode_g1'] == $Me and $Ejmali_list['ejmali3_g1_done'] == 0) {
                                           echo 'ej3g1';
                                       }
                                       ?>"
                                >
                                <button class="btn btn-primary" name="ej">
                                    ارزیابی اجمالی
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php
                endforeach;
                $query = mysqli_query($connection_book, "select * from ssmp_bookfestival.posts rate inner join book_festival_signup.posts signup on signup.id = rate.post_id WHERE signup.sorting_classification_id is not null and rate.rate_status='اجمالی' and (rate.ejmali1_ratercode_g2='$Me' or rate.ejmali2_ratercode_g2='$Me' or rate.ejmali3_ratercode_g2='$Me') order by signup.id");
                foreach ($query as $Ejmali_list):
                    ?>
                    <tr>
                        <td>
                            <?php echo $a;
                            $a++; ?>
                        </td>
                        <td>
                            <?php
                            if ($Ejmali_list['post_delivery_method'] == 'نسخه دیجیتال') {
                                ?>
                                <a href="<?php
                                if (str_starts_with($Ejmali_list['file_src'], "Files")) {
                                    echo $Ejmali_list['file_src'];
                                } else {
                                    echo $signup_url . '/' . $Ejmali_list['file_src'];
                                }
                                ?>" target="_blank"
                                   id='no-link' style="color: #0a53be">
                                    <?php
                                    echo $Ejmali_list['title'];
                                    ?>
                                </a>
                            <?php } else {
                                echo "<label>" . $Ejmali_list['title'] . "</label>";
                            }
                            ?>
                        </td>
                        <td>
                            <?php echo $Ejmali_list['post_format'] ?>
                        </td>
                        <td>
                            <?php
                            echo $groupID = $Ejmali_list['scientific_group_v2'];
                            ?>
                        </td>
                        <td>
                            <?php
                            echo $Ejmali_list['language'];
                            ?>
                        </td>
                        <td>
                            <?php
                            if ($Ejmali_list['post_format']=='کتاب'){
                                echo 'وضعیت نشر: '.$Ejmali_list['publish_status']."<br>";
                                echo 'تعداد جلد: '.$Ejmali_list['number_of_covers']."<br>";
                                echo 'قطع: '.$Ejmali_list['book_size']."<br>";
                                echo 'تیراژ: '.$Ejmali_list['circulation']."<br>";
                            }elseif ($Ejmali_list['post_format']=='پایان نامه'){
                                if ($Ejmali_list['thesis_certificate_number']==0){
                                    $Ejmali_list['thesis_certificate_number']='بدون شماره ثبت شده';
                                }
                                echo 'شماره گواهی دفاع پایان نامه: '.$Ejmali_list['thesis_certificate_number']."<br>";
                                echo 'محل دفاع: '.$Ejmali_list['thesis_defence_place']."<br>";
                                echo 'امتیاز پایان نامه: '.$Ejmali_list['thesis_grade']."<br>";
                            }
                            ?>
                        </td>
                        <td>
                            <form action="Rate.php" method="post">
                                <input type="hidden" name="id" value="<?php echo $Ejmali_list['id']; ?>">
                                <input type="hidden" name="rate_status"
                                       value="<?php
                                       if ($Ejmali_list['ejmali1_ratercode_g2'] == $Me and $Ejmali_list['ejmali1_g2_done'] == 0) {
                                           echo 'ej1g2';
                                       } elseif ($Ejmali_list['ejmali2_ratercode_g2'] == $Me and $Ejmali_list['ejmali2_g2_done'] == 0) {
                                           echo 'ej2g2';
                                       } elseif ($Ejmali_list['ejmali3_ratercode_g2'] == $Me and $Ejmali_list['ejmali3_g2_done'] == 0) {
                                           echo 'ej3g2';
                                       }
                                       ?>"
                                >
                                <button class="btn btn-primary" name="ej">
                                    ارزیابی اجمالی
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php
                endforeach;

                $query = mysqli_query($connection_book, "select * from ssmp_bookfestival.posts rate inner join book_festival_signup.posts signup on signup.id = rate.post_id WHERE signup.sorting_classification_id is not null and rate.rate_status='تفصیلی' and (rate.tafsili1_ratercode='$Me' or rate.tafsili2_ratercode='$Me' or rate.tafsili3_ratercode='$Me') order by signup.id");
                foreach ($query as $Tafsili_list):
                    ?>
                    <tr>
                        <td>
                            <?php echo $a;
                            $a++; ?>
                        </td>
                        <td>
                            <?php
                            if ($Ejmali_list['post_delivery_method'] == 'نسخه دیجیتال') {
                                ?>
                                <a href="<?php
                                if (str_starts_with($Ejmali_list['file_src'], "Files")) {
                                    echo $Ejmali_list['file_src'];
                                } else {
                                    echo $signup_url . '/' . $Ejmali_list['file_src'];
                                }
                                ?>" target="_blank"
                                   id='no-link' style="color: #0a53be">
                                    <?php
                                    echo $Ejmali_list['title'];
                                    ?>
                                </a>
                            <?php } else {
                                echo "<label>" . $Ejmali_list['title'] . "</label>";
                            }
                            ?>
                        </td>
                        <td>
                            <?php echo $Ejmali_list['post_format'] ?>
                        </td>
                        <td>
                            <?php
                            echo $groupID = $Ejmali_list['scientific_group_v1'];
                            ?>
                        </td>
                        <td>
                            <?php
                            echo $Ejmali_list['language'];
                            ?>
                        </td>
                        <td>
                            <?php
                            if ($Ejmali_list['post_format']=='کتاب'){
                                echo 'وضعیت نشر: '.$Ejmali_list['publish_status']."<br>";
                                echo 'تعداد جلد: '.$Ejmali_list['number_of_covers']."<br>";
                                echo 'قطع: '.$Ejmali_list['book_size']."<br>";
                                echo 'تیراژ: '.$Ejmali_list['circulation']."<br>";
                            }elseif ($Ejmali_list['post_format']=='پایان نامه'){
                                if ($Ejmali_list['thesis_certificate_number']==0){
                                    $Ejmali_list['thesis_certificate_number']='بدون شماره ثبت شده';
                                }
                                echo 'شماره گواهی دفاع پایان نامه: '.$Ejmali_list['thesis_certificate_number']."<br>";
                                echo 'محل دفاع: '.$Ejmali_list['thesis_defence_place']."<br>";
                                echo 'امتیاز پایان نامه: '.$Ejmali_list['thesis_grade']."<br>";
                            }
                            ?>
                        </td>
                        <td>
                            <form action="Rate.php" method="post">
                                <input type="hidden" name="id" value="<?php echo $Ejmali_list['id']; ?>">
                                <input type="hidden" name="rate_status"
                                       value="<?php
                                       if ($Ejmali_list['tafsili1_ratercode_g2'] == $Me and $Ejmali_list['tafsili1_g2_done'] == 0) {
                                           echo 'ta1g2';
                                       } elseif ($Ejmali_list['tafsili2_ratercode_g2'] == $Me and $Ejmali_list['tafsili2_g2_done'] == 0) {
                                           echo 'ta2g2';
                                       } elseif ($Ejmali_list['tafsili3_ratercode_g2'] == $Me and $Ejmali_list['tafsili3_g2_done'] == 0) {
                                           echo 'ta3g2';
                                       }
                                       ?>"
                                >
                                <button class="btn btn-primary" name="ta">
                                    ارزیابی تفصیلی
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->