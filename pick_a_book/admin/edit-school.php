<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {

    if (isset($_POST['update'])) {
        $name = $_POST['name'];
        $status = $_POST['status'];
        $class = $_POST['class'];
        $class_type_select = $_POST['class-type-select'];

        $schoolid = intval($_GET['id']);

        //echo "id: ".$schoolid." name: ".$name." class: ".sizeof($class)." class types: ".$class_type_select."<br>";


        $sql = "update schools set name=:name, class_type=:class_type, updated_date=NOW() where id=:id_school";
        $query = $dbh->prepare($sql);
        $query->bindParam(':name', $name, PDO::PARAM_STR);
        $query->bindParam(':class_type', $class_type_select, PDO::PARAM_STR);
        $query->bindParam(':id_school', $schoolid, PDO::PARAM_STR);
        $query->execute();

        $sql = "delete from classes WHERE id_school=:id_school";
        $query = $dbh->prepare($sql);
        $query->bindParam(':id_school', $schoolid, PDO::PARAM_STR);
        $query->execute();

        for ($i = 0; $i < sizeof($class); $i++) {
            echo "class: ".$class[$i];
            $sql = "INSERT INTO classes(id_school,class_name) VALUES(:id_school,:class_name)";
            $query = $dbh->prepare($sql);
            $query->bindParam(':class_name', $class[$i], PDO::PARAM_STR);
            $query->bindParam(':id_school', $schoolid, PDO::PARAM_STR);
            $query->execute();
        }

        $_SESSION['msg'] = "School info updated successfully";
        header('location:manage-school.php');


    }
    ?>
    <!DOCTYPE html>
    <html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
        <meta name="description" content=""/>
        <meta name="author" content=""/>
        <title>Pick a Book | Edit School</title>
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
                    <h4 class="header-line">Edit School</h4>

                </div>

            </div>
            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            School Info
                        </div>
                        <div class="panel-body">
                            <form role="form" method="post">
                                <?php
                                $schoolid = intval($_GET['id']);
                                $sql = "SELECT * from schools where id=:schoolid";
                                $query = $dbh->prepare($sql);
                                $query->bindParam(':schoolid', $schoolid, PDO::PARAM_STR);
                                $query->execute();
                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                $cnt = 1;
                                if ($query->rowCount() > 0) {
                                    foreach ($results as $result_main) { ?>

                                        <div class="form-group">
                                            <label>School Name<span style="color:red;">*</span></label>
                                            <input class="form-control" type="text" name="name"
                                                   value="<?php echo htmlentities($result_main->name); ?>" required/>
                                        </div>

                                        <div class="form-group">
                                            <label> Type<span style="color:red;">*</span></label>
                                            <select class="form-control" name="class-type-select"
                                                    onchange="selectClassType()"
                                                    id="class-type-select">
                                                <option value="Primary" <?php if (htmlentities($result_main->class_type == "Primary")) {
                                                    echo "selected";
                                                } ?>>Primary (1 - 5)
                                                </option>
                                                <option value="Middle" <?php if (htmlentities($result_main->class_type == "Middle")) {
                                                    echo "selected";
                                                } ?>>Middle (1 - 8)
                                                </option>
                                                <option value="High" <?php if (htmlentities($result_main->class_type == "High")) {
                                                    echo "selected";
                                                } ?>>High (1 - 10)
                                                </option>
                                                <option value="Custom" <?php if (htmlentities($result_main->class_type == "Custom")) {
                                                    echo "selected";
                                                } ?>>Custom
                                                </option>
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
                                    <?php }
                                } ?>
                                <button type="submit" name="update" class="btn btn-info">Update</button>

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
        window.onload = function () {
            console.log("doc is ready");


            createClasses();

        };
    </script>
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

    </html>
<?php } ?>
