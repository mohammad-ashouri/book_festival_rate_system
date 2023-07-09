<?php include_once __DIR__ . '/header.php';
if ($_SESSION['head'] == 4 or $_SESSION['head'] == 3):
    ?>
    <!-- Main content -->
    <section class="content">

        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">اختصاص اثر به ارزیاب اجمالی</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table class="table table-bordered table-striped text-center" id="myTable">
                    <tbody>
                    <tr style="font-size: 15px">
                        <th>ردیف</th>
                        <th style="width: 200px;">عنوان مقاله</th>
                        <th>قالب اثر</th>
                        <th>گروه علمی ۱</th>
                        <th>گروه علمی ۲</th>
                        <th>بخش ویژه</th>
                        <th>نویسنده</th>
                        <th>نوع همکاری</th>
                        <th>همکاران</th>
                        <th>اختصاص به گروه علمی اول</th>
                        <th>اختصاص به گروه علمی دوم</th>
                    </tr>
                    <?php
                    $a = 1;
                    $query = mysqli_query($connection_book, "select * from ssmp_bookfestival.posts rate inner join book_festival_signup.posts signup on signup.id = rate.post_id WHERE signup.sorting_classification_id is not null and rate.rate_status='اجمالی' order by signup.id");
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
                                <?php
                                echo $Group1 = $Ejmali_list['post_format'];
                                ?>
                            </td>
                            <td>
                                <?php
                                echo $Group1 = $Ejmali_list['scientific_group_v1'];
                                ?>
                            </td>
                            <td>
                                <?php
                                echo $Group2 = $Ejmali_list['scientific_group_v2'];
                                ?>
                            </td>
                            <td>
                                <?php
                                $special_section = $Ejmali_list['special_section'];
                                $query = mysqli_query($connection_book_signup, "select * from special_sections where id='$special_section'");
                                foreach ($query as $Special_section_Detail) {
                                }
                                echo @$Special_section_Detail['subject'];
                                ?>
                            </td>
                            <td>
                                <?php
                                $query = mysqli_query($connection_book_signup, "select * from users where id=" . $Ejmali_list['user_id']);
                                foreach ($query as $author) {
                                }
                                echo $author['name'] . ' ' . $author['family'];
                                ?>
                            </td>
                            <td>
                                <?php
                                echo $Ejmali_list['activity_type'];
                                ?>
                            </td>
                            <td>
                                <ul>
                                    <?php
                                    if ($Ejmali_list['activity_type'] === 'مشترک') {
                                        $user_id = $Ejmali_list['user_id'];
                                        $cooperators = mysqli_query($connection_book_signup, "select * from participants where post_id='$user_id' order by participation_percentage desc ");
                                        echo "<ul style='list-style: square; margin-right: 10%'>";
                                        foreach ($cooperators as $cooperator) {
                                            echo "<li>" . $cooperator['name'] . ' ' . $cooperator['family'] . ' (' . $cooperator['participation_percentage'] . ' درصد)' . "</li>" . "<br>";
                                        }
                                        echo "</ul>";
                                    }
                                    ?>
                                </ul>
                            </td>
                            <td>
                                <p style="margin-bottom: -1px;margin-right: 5px;font-size: 14px">- ارزیاب اول</p>
                                <select onchange="SetEjmaliGroup1Rater1(this.value,<?php echo $id = $Ejmali_list['post_id']; ?>)"
                                        id="rater_group_1_1" name="rater_group_1_1" class="form-control select2"
                                        style="width: 100%;display: inline-block;margin-bottom: 8px"
                                    <?php if ($Ejmali_list['ejmali1_g1_done'] == 1) echo 'disabled'; ?>
                                >
                                    <option disabled selected>انتخاب کنید</option>
                                    <?php
                                    $ej2g1r = @$Ejmali_list['ejmali2_ratercode_g1'];
                                    $ej3g1r = @$Ejmali_list['ejmali3_ratercode_g1'];
                                    $query = mysqli_query($connection_book, "select * from users where type=1 and approved=1 and id!='$ej2g1r' and id!='$ej3g1r'");
                                    foreach ($query as $raters_info):
                                        ?>
                                        <option <?php
                                        $rater1 = $raters_info['id'];
                                        $query = mysqli_query($connection_book, "select * from posts where id='$id'");
                                        foreach ($query as $rater1_info) {
                                        }
                                        if ($raters_info['id'] == @$rater1_info['ejmali1_ratercode_g1']) {
                                            echo 'selected';
                                        }
                                        ?>
                                                value="<?php echo $raters_info['id']; ?>">
                                            <?php echo $raters_info['name'] . ' ' . $raters_info['family']; ?>
                                        </option>
                                    <?php endforeach;
                                    ?>
                                </select>
                                <br/>
                                <p style="margin-bottom: -1px;margin-right: 5px;font-size: 14px">- ارزیاب دوم</p>
                                <select onchange="SetEjmaliGroup1Rater2(this.value,<?php echo $id = $Ejmali_list['post_id']; ?>)"
                                        id="rater_group_1_2" name="rater_group_1_2" class="form-control select2"
                                        style="width: 100%;display: inline-block;margin-bottom: 8px" <?php if ($Ejmali_list['ejmali2_g1_done'] == 1) echo 'disabled'; ?>
                                >
                                    <option disabled selected>انتخاب کنید</option>
                                    <?php
                                    $ej1g1r = @$rater1_info['ejmali1_ratercode_g1'];
                                    $ej3g1r = @$rater1_info['ejmali3_ratercode_g1'];
                                    $query = mysqli_query($connection_book, "select * from users where type=1 and approved=1 and id!='$ej1g1r' and id!='$ej3g1r'");
                                    foreach ($query as $raters_info):
                                        ?>
                                        <option <?php
                                        $rater2 = $raters_info['id'];
                                        $query = mysqli_query($connection_book, "select * from posts where id='$id'");
                                        foreach ($query as $rater2_info) {
                                        }
                                        if ($raters_info['id'] == @$rater2_info['ejmali2_ratercode_g1']) {
                                            echo 'selected';
                                        }
                                        ?>
                                                value="<?php echo $raters_info['id']; ?>">
                                            <?php echo $raters_info['name'] . ' ' . $raters_info['family'];
                                            ?>
                                        </option>
                                    <?php endforeach;
                                    ?>
                                </select>
                                <br/>
                                <p style="margin-bottom: -1px;margin-right: 5px;font-size: 14px">- ارزیاب سوم</p>
                                <select onchange="SetEjmaliGroup1Rater3(this.value,<?php echo $id = $Ejmali_list['post_id'] ?>)"
                                        id="rater_group_1_3" name="rater_group_1_3" class="form-control select2"
                                        style="width: 100%;display: inline-block;margin-bottom: 8px" <?php if ($Ejmali_list['ejmali3_g1_done'] == 1) echo 'disabled'; ?>>
                                    <option disabled selected>انتخاب کنید</option>
                                    <?php
                                    $ej1g1r = @$rater1_info['ejmali1_ratercode_g1'];
                                    $ej2g1r = @$rater1_info['ejmali2_ratercode_g1'];
                                    $query = mysqli_query($connection_book, "select * from users where type=1 and approved=1 and id!='$ej1g1r' and id!='$ej2g1r'");
                                    foreach ($query as $raters_info):
                                        ?>
                                        <option <?php
                                        $rater3 = $raters_info['id'];
                                        $query = mysqli_query($connection_book, "select * from posts where id='$id'");
                                        foreach ($query as $rater3_info) {
                                        }
                                        if ($raters_info['id'] == @$rater3_info['ejmali3_ratercode_g1']) {
                                            echo 'selected';
                                        }
                                        ?>
                                                value="<?php echo $raters_info['id']; ?>">
                                            <?php echo $raters_info['name'] . ' ' . $raters_info['family'];
                                            ?>
                                        </option>
                                    <?php endforeach;
                                    ?>
                                </select>
                            </td>
                            <td>
                                <?php if ($Ejmali_list['scientific_group_v2'] != null or $Ejmali_list['scientific_group_v2'] != ''): ?>
                                    <p style="margin-bottom: -1px;margin-right: 5px;font-size: 14px">- ارزیاب اول</p>
                                    <select onchange="SetEjmaliGroup2Rater1(this.value,<?php echo $id = $Ejmali_list['post_id'] ?>)"
                                            id="rater_group_2_1" name="rater_group_2_1" class="form-control select2"
                                            style="width: 100%;display: inline-block;margin-bottom: 8px" <?php if ($Ejmali_list['ejmali1_g2_done'] == 1) echo 'disabled'; ?>>
                                        <option disabled selected>انتخاب کنید</option>
                                        <?php
                                        $query = mysqli_query($connection_book, "select * from users where type=1 and approved=1");
                                        foreach ($query as $raters_info):
                                            ?>
                                            <option <?php
                                            $rater1 = $raters_info['id'];
                                            $query = mysqli_query($connection_book, "select * from posts where id='$id'");
                                            foreach ($query as $rater1_info) {
                                            }
                                            if ($raters_info['id'] == @$rater1_info['ejmali1_ratercode_g2']) {
                                                echo 'selected';
                                            }
                                            ?>
                                                    value="<?php echo $raters_info['id']; ?>">
                                                <?php echo $raters_info['name'] . ' ' . $raters_info['family'];

                                                ?>
                                            </option>
                                        <?php endforeach;
                                        ?>
                                    </select>
                                    <br/>
                                    <p style="margin-bottom: -1px;margin-right: 5px;font-size: 14px">- ارزیاب دوم</p>
                                    <select onchange="SetEjmaliGroup2Rater2(this.value,<?php echo $id = $Ejmali_list['post_id'] ?>)"
                                            id="rater_group_2_2" name="rater_group_2_2" class="form-control select2"
                                            style="width: 100%;display: inline-block;margin-bottom: 8px" <?php if ($Ejmali_list['ejmali2_g2_done'] == 1) echo 'disabled'; ?>>
                                        <option disabled selected>انتخاب کنید</option>
                                        <?php
                                        $ej1g2r = $rater1_info['ejmali1_ratercode_g2'];
                                        $query = mysqli_query($connection_book, "select * from users where type=1 and approved=1 and id!='$ej1g2r'");
                                        foreach ($query as $raters_info):
                                            ?>
                                            <option <?php
                                            $rater2 = @$raters_info['id'];
                                            $query = mysqli_query($connection_book, "select * from posts where id='$id'");
                                            foreach ($query as $rater2_info) {
                                            }
                                            if ($raters_info['id'] == @$rater2_info['ejmali2_ratercode_g2']) {
                                                echo 'selected';
                                            }
                                            ?>
                                                    value="<?php echo $raters_info['id']; ?>">
                                                <?php echo $raters_info['name'] . ' ' . $raters_info['family'];
                                                ?>
                                            </option>
                                        <?php endforeach;
                                        ?>
                                    </select>
                                    <br/>
                                    <p style="margin-bottom: -1px;margin-right: 5px;font-size: 14px">- ارزیاب سوم</p>
                                    <select onchange="SetEjmaliGroup2Rater3(this.value,<?php echo $id = $Ejmali_list['post_id'] ?>)"
                                            id="rater_group_2_3" name="rater_group_2_3" class="form-control select2"
                                            style="width: 100%;display: inline-block;margin-bottom: 8px" <?php if ($Ejmali_list['ejmali3_g2_done'] == 1) echo 'disabled'; ?>>
                                        <option disabled selected>انتخاب کنید</option>
                                        <?php
                                        $ej1g2r = @$rater1_info['ejmali1_ratercode_g2'];
                                        $ej2g2r = @$rater1_info['ejmali2_ratercode_g2'];
                                        $query = mysqli_query($connection_book, "select * from users where type=1 and approved=1 and id!='$ej1g2r' and id!='$ej2g2r'");
                                        foreach ($query as $raters_info):
                                            ?>
                                            <option <?php
                                            $rater3 = $raters_info['id'];
                                            $query = mysqli_query($connection_book, "select * from posts where id='$id'");
                                            foreach ($query as $rater3_info) {
                                            }
                                            if ($raters_info['id'] == @$rater3_info['ejmali3_ratercode_g2']) {
                                                echo 'selected';
                                            }
                                            ?>
                                                    value="<?php echo $raters_info['id']; ?>">
                                                <?php echo $raters_info['name'] . ' ' . $raters_info['family'];
                                                ?>
                                            </option>
                                        <?php endforeach;
                                        ?>
                                    </select>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php
                        $rater1_info = null;
                        $rater2_info = null;
                        $rater3_info = null;
                        $raters_info['id'] = null;
                        $query = null;
                        $id = null;
                    endforeach; ?>
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
    </div>

    <!-- /.content-wrapper -->

    <script src="build/js/Set_Ejmali_Inc.js"></script>

<?php
endif;
include_once __DIR__ . '/footer.php'; ?>
