<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {

    if (isset($_POST['update'])) {
        $bookname = $_POST['bookname'];
        $id_school = $_POST['id_school'];
        $id_class = $_POST['id_class'];
        $id_publisher = $_POST['id_publisher'];

        $bookid = intval($_GET['id']);

 //echo "id: ".$bookid." name: ".$bookname." school: ".$id_school." class: ".$id_class." publisher: ".$id_publisher;


        $sql = "update tblbooks set BookName=:bookname,id_school=:id_school,id_class=:id_class,id_publisher=:id_publisher where id=:bookid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':bookname', $bookname, PDO::PARAM_STR);
        $query->bindParam(':id_school', $id_school, PDO::PARAM_STR);
        $query->bindParam(':id_class', $id_class, PDO::PARAM_STR);
        $query->bindParam(':id_publisher', $id_publisher, PDO::PARAM_STR);
        $query->bindParam(':bookid', $bookid, PDO::PARAM_STR);
        $query->execute();
        $_SESSION['msg'] = "Book info updated successfully";
        header('location:add-book.php');


    }
    ?>
    <!DOCTYPE html>
    <html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
        <meta name="description" content=""/>
        <meta name="author" content=""/>
        <title>Pick a Book | Edit Book</title>
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
                    <h4 class="header-line">Edit Book</h4>

                </div>

            </div>
            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            Book Info
                        </div>
                        <div class="panel-body">
                            <form role="form" method="post">
                                <?php
                                $bookid = intval($_GET['id']);
                                $sql = "SELECT * from tblbooks where id=:bookid";
                                $query = $dbh->prepare($sql);
                                $query->bindParam(':bookid', $bookid, PDO::PARAM_STR);
                                $query->execute();
                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                $cnt = 1;
                                if ($query->rowCount() > 0) {
                                    foreach ($results as $result_main) { ?>

                                        <div class="form-group">
                                            <label>Book Name<span style="color:red;">*</span></label>
                                            <input class="form-control" type="text" name="bookname"
                                                   value="<?php echo htmlentities($result_main->BookName); ?>" required/>
                                            <input class="form-control hidden" type="text" name="id_class_input" id="id_class_input"
                                                   value="<?php echo htmlentities($result_main->id_class); ?>"/>
                                        </div>

                                        <div class="form-group">
                                            <label> School<span style="color:red;">*</span></label>
                                            <select class="form-control" id="id_school" onchange="getClassesinEdit()" name="id_school"
                                                    required="required">
                                                <option value=""> Select School</option>
                                                <?php
                                                $id_school = htmlentities($result_main->id_school);
                                                $sql = "SELECT * from  schools";
                                                $query = $dbh->prepare($sql);
                                                $query->execute();
                                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                $cnt = 1;
                                                if ($query->rowCount() > 0) {
                                                    foreach ($results as $result) { ?>
                                                        <option value="<?php echo htmlentities($result->id); ?>" <?php if ($id_school == htmlentities($result->id)) {
                                                            echo "selected";
                                                        } ?>><?php echo htmlentities($result->name); ?></option>
                                                    <?php }
                                                } ?>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label> Class<span style="color:red;">*</span></label>
                                            <select class="form-control" id="id_class" name="id_class" required="required">
                                                <option value=""> Select Class</option>
                                                <!--Populated via ajax-->
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label> Publisher<span style="color:red;">*</span></label>
                                            <select class="form-control" name="id_publisher" required="required">
                                                <option value=""> Select Publisher</option>
                                                <?php
                                                $id_publisher = htmlentities($result_main->id_publisher);
                                                echo "publisher: ".$id_publisher;
                                                $sql = "SELECT * from  publishers ";
                                                $query = $dbh->prepare($sql);
                                                $query->execute();
                                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                $cnt = 1;
                                                if ($query->rowCount() > 0) {
                                                    foreach ($results as $result) { ?>
                                                        <option value="<?php echo htmlentities($result->id); ?>" <?php if ($id_publisher == htmlentities($result->id)) {
                                                            echo "selected";
                                                        } ?>><?php echo htmlentities($result->PublisherName); ?></option>
                                                    <?php }
                                                } ?>
                                            </select>
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


            getClassesinEdit();

        };
    </script>
    <script>
        function getClassesinEdit() {
            let id_school = $('#id_school').val();
            //alert(id_school);
            let id_class_from_get = $("#id_class_input").val();
            console.log("class id: "+id_class_from_get);

            //alert(id_class_from_get);
            $.get('ajax/get_class_on_school_based.php', {
                id_school: id_school,
                id_class_from_get: id_class_from_get
            }, function (data) {

                $('#id_class').html(data);
                console.log(data);

            });
        }
    </script>

    </html>
<?php } ?>
