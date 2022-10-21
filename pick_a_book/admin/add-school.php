<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {

    if (isset($_POST['create'])) {
        $name = $_POST['name'];
        $status = $_POST['status'];
        $class = $_POST['class'];
        $class_type_select = $_POST['class-type-select'];
        $sql = "INSERT INTO schools(name, class_type) VALUES(:name, :class_type)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':name', $name, PDO::PARAM_STR);
        $query->bindParam(':class_type', $class_type_select, PDO::PARAM_STR);
        $query->execute();
        $id_school = $dbh->lastInsertId();

        for ($i = 0; $i < sizeof($class); $i++) {
            $sql = "INSERT INTO classes(id_school,class_name) VALUES(:id_school,:class_name)";
            $query = $dbh->prepare($sql);
            $query->bindParam(':class_name', $class[$i], PDO::PARAM_STR);
            $query->bindParam(':id_school', $id_school, PDO::PARAM_STR);
            $query->execute();
        }
        if ($id_school) {
            $_SESSION['msg'] = "school added successfully";
            header('location:manage-school.php');
        } else {
            $_SESSION['error'] = "Something went wrong. Please try again";
            header('location:manage-school.php');
        }

    }
    ?>
    <!DOCTYPE html>
    <html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
        <meta name="description" content=""/>
        <meta name="author" content=""/>
        <title>Pick a Book | Add School</title>
        <!-- BOOTSTRAP CORE STYLE  -->
        <link href="assets/css/bootstrap.css" rel="stylesheet"/>
        <!-- FONT AWESOME STYLE  -->
        <link href="assets/css/font-awesome.css" rel="stylesheet"/>
        <!-- CUSTOM STYLE  -->
        <link href="assets/css/style.css" rel="stylesheet"/>
        <!-- GOOGLE FONT -->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'/>

    </head>
    <body>
    <!------MENU SECTION START-->
    <?php include('includes/header.php'); ?>
    <!-- MENU SECTION END-->
    <div class="content-wrapper">
        <div class="container">
            <div class="row pad-botm">
                <div class="col-md-12">
                    <h4 class="header-line">Add school</h4>

                </div>

            </div>
            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3"
                ">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        School Info
                    </div>
                    <div class="panel-body">
                        <form role="form" method="post">
                            <div class="form-group">
                                <label>School Name</label>
                                <input class="form-control" type="text" name="name" autocomplete="off" required/>
                            </div>
                            <div class="form-group">
                                <label>Type</label>
                                <select class="form-control" name="class-type-select" onchange="selectClassType()"
                                        id="class-type-select">
                                    <option value="Primary">Primary (1 - 5)</option>
                                    <option value="Middle">Middle (1 - 8)</option>
                                    <option value="High">High (1 - 10)</option>
                                    <option value="Custom">Custom</option>
                                </select>
                            </div>
                            <div class="form-group" id="classes-from-to-div" style="display: none;">
                                <label>Classes From</label>
                                <input class="form-control" type="number" id="class-from" name="class-from"
                                       autocomplete="off" min="0"
                                       max="10"/>
                                <label>Classes To</label>
                                <input class="form-control" type="number" id="class-to" name="class-to"
                                       autocomplete="off" min="0"
                                       max="10"/>
                            </div>
                            <div class="col-sm-4">
                                <button class="btn btn-success" type="button" onclick="createClasses()"><i
                                            class="fa fa-plus"></i> CREATE
                                </button>
                            </div><br><br>
                            <div class="form-group" id="classes">
                                <!--<label>Class Name</label>
                                <input class="form-control" type="text" name="class[]" required>-->
                            </div>

                            <div class="col-sm-4">
                                <button type="submit" name="create" class="btn btn-info"><i class="fa fa-check"></i>
                                    SAVE
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>

        </div>

    </div>
    </div>
    <!-- CONTENT-WRAPPER SECTION END-->
    <?php include('includes/footer.php'); ?>
    <!-- FOOTER SECTION END-->
    <!-- JAVASCRIPT FILES PLACED AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
    <!-- CORE JQUERY  -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/js/bootstrap.js"></script>
    <!-- CUSTOM SCRIPTS  -->
    <script src="assets/js/custom.js"></script>
    </body>
    <script>
        let class_from = 0;
        let class_to = 0;

        function createClasses() {
            let selected_class_type = $('#class-type-select').val();
            if (selected_class_type === "Custom") {
                $("#classes-from-to-div").show();
                class_from = parseInt($("#class-from").val());
                class_to = parseInt($("#class-to").val());

                console.log("class_from: "+class_from);
                console.log("class_to: "+class_to);
            } else if (selected_class_type === "Primary") {
                $("#classes-from-to-div").hide();
                class_from = 1;
                class_to = 5;

            } else if (selected_class_type === "Middle") {
                $("#classes-from-to-div").hide();
                class_from = 1;
                class_to = 8;

            } else if (selected_class_type === "High") {
                $("#classes-from-to-div").hide();
                class_from = 1;
                class_to = 10;
            }
            $('#classes').empty();
            for (let i = class_from; i <= class_to; i++) {
                $('#classes').append(
                    "<div class='form-group' id='class_" + (i) + "'>" +
                    "<label>Class - " + (i) + " &nbsp&nbsp&nbsp&nbsp <i class='fa fa-2x fa-check' style='color: green'></i> </label>" +
                    "<input class='form-control hidden' type='text' name='class[]' value='Class - "+i+"'>" +
                    "</div>"
                );
            }
        }
    </script>
    <script>
        function selectClassType() {
            let selected_class_type = $('#class-type-select').val();
            if (selected_class_type === "Custom") {
                $("#classes-from-to-div").show();
                class_from = $("#class-from").val();
                class_to = $("#class-to").val();
            } else {
                $("#classes-from-to-div").hide();
            }
        }
    </script>

    </html>
<?php } ?>
