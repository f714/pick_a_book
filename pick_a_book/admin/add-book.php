<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {

    if (isset($_POST['add'])) {
        $bookname = $_POST['bookname'];
        $id_school = $_POST['id_school'];
        $id_class = $_POST['id_class'];
        $id_publisher = $_POST['id_publisher'];

        $sql = "INSERT INTO tblbooks(BookName,id_school,id_class,id_publisher) VALUES(:bookname,:id_school,:id_class,:id_publisher)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':bookname', $bookname, PDO::PARAM_STR);
        $query->bindParam(':id_school', $id_school, PDO::PARAM_STR);
        $query->bindParam(':id_class', $id_class, PDO::PARAM_STR);
        $query->bindParam(':id_publisher', $id_publisher, PDO::PARAM_STR);

        $query->execute();
        $lastInsertId = $dbh->lastInsertId();
        if ($lastInsertId) {
            $_SESSION['msg'] = "Book Listed successfully";
            header('location:add-book.php?id_school=' . $id_school . '&id_class=' . $id_class . '&id_publisher=' . $id_publisher);
        } else {
            $_SESSION['error'] = "Something went wrong. Please try again";
            header('location:add-book.php');
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
        <title>Pick a Book | Add Syllabus</title>
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
                    <h4 class="header-line">Add Syllabus</h4>

                </div>
                <div class="row">
                    <?php if ($_SESSION['error'] != "") {
                        ?>
                        <div class="col-md-6">
                            <div class="alert alert-danger">
                                <strong>Error :</strong>
                                <?php echo htmlentities($_SESSION['error']); ?>
                                <?php echo htmlentities($_SESSION['error'] = ""); ?>
                            </div>
                        </div>
                    <?php } ?>
                    <?php if ($_SESSION['msg'] != "") {
                        ?>
                        <div class="col-md-6">
                            <div class="alert alert-success">
                                <strong>Success :</strong>
                                <?php echo htmlentities($_SESSION['msg']); ?>
                                <?php echo htmlentities($_SESSION['msg'] = ""); ?>
                            </div>
                        </div>
                    <?php } ?>
                    <?php if ($_SESSION['updatemsg'] != "") {
                        ?>
                        <div class="col-md-6">
                            <div class="alert alert-success">
                                <strong>Success :</strong>
                                <?php echo htmlentities($_SESSION['updatemsg']); ?>
                                <?php echo htmlentities($_SESSION['updatemsg'] = ""); ?>
                            </div>
                        </div>
                    <?php } ?>


                    <?php if ($_SESSION['delmsg'] != "") {
                        ?>
                        <div class="col-md-6">
                            <div class="alert alert-success">
                                <strong>Success :</strong>
                                <?php echo htmlentities($_SESSION['delmsg']); ?>
                                <?php echo htmlentities($_SESSION['delmsg'] = ""); ?>
                            </div>
                        </div>
                    <?php } ?>

                </div>

            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            Syllabus Info
                        </div>
                        <div class="panel-body">
                            <form role="form" method="post">


                                <div class="form-group">
                                    <label> School<span style="color:red;">*</span></label>
                                    <select class="form-control" id="id_school" onchange="getClasses()" name="id_school"
                                            required="required">
                                        <option value=""> Select School</option>
                                        <?php
                                        $status = 1;
                                        $sql = "SELECT * from  schools ";
                                        $query = $dbh->prepare($sql);
                                        $query->execute();
                                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                                        $cnt = 1;
                                        if ($query->rowCount() > 0) {
                                            foreach ($results as $result) { ?>
                                                <option value="<?php echo htmlentities($result->id); ?>" <?php if (isset($_GET['id_school']) && $_GET['id_school'] == htmlentities($result->id)) {
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
                                    <label>Book Name<span style="color:red;">*</span></label>
                                    <input class="form-control" type="text" name="bookname" autocomplete="off"
                                           required/>
                                </div>

                                <div class="form-group">
                                    <label> Publisher<span style="color:red;">*</span></label>
                                    <select class="form-control" name="id_publisher" required="required">
                                        <option value=""> Select Publisher</option>
                                        <?php

                                        $sql = "SELECT * from  publishers ";
                                        $query = $dbh->prepare($sql);
                                        $query->execute();
                                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                                        $cnt = 1;
                                        if ($query->rowCount() > 0) {
                                            foreach ($results as $result) { ?>
                                                <option value="<?php echo htmlentities($result->id); ?>" <?php if (isset($_GET['id_publisher']) && $_GET['id_publisher'] == htmlentities($result->id)) {
                                                    echo "selected";
                                                } ?>><?php echo htmlentities($result->PublisherName); ?></option>
                                            <?php }
                                        } ?>
                                    </select>
                                </div>
                                <button type="submit" name="add" class="btn btn-info">Add</button>
                                <hr>

                            </form>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover"
                                       id="dataTables-example">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Book Name</th>
                                        <th>School</th>
                                        <th>Class</th>
                                        <th>Publisher</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $sql = "SELECT tblbooks.BookName,schools.name,classes.class_name,publishers.PublisherName,tblbooks.BookPrice,tblbooks.id as bookid from  tblbooks join schools on schools.id=tblbooks.id_school join classes on classes.id=tblbooks.id_class join publishers on publishers.id=tblbooks.id_publisher";
                                    $query = $dbh->prepare($sql);
                                    $query->execute();
                                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                                    $cnt = 1;
                                    if ($query->rowCount() > 0) {
                                        foreach ($results as $result) { ?>
                                            <tr class="odd gradeX">
                                                <td class="center"><?php echo htmlentities($cnt); ?></td>
                                                <td class="center"><?php echo htmlentities($result->BookName); ?></td>
                                                <td class="center"><?php echo htmlentities($result->name); ?></td>
                                                <td class="center"><?php echo htmlentities($result->class_name); ?></td>
                                                <td class="center"><?php echo htmlentities($result->PublisherName); ?></td>
                                                <td class="center">

                                                    <a href="edit-book.php?id=<?php echo htmlentities($result->bookid); ?>">
                                                        <button class="btn btn-primary"><i class="fa fa-edit "></i> Edit
                                                        </button>
                                                        <a href="manage-books.php?del=<?php echo htmlentities($result->id); ?>"
                                                           onclick="return confirm('Are you sure you want to delete?');">
                                                            <button class="btn btn-danger"><i class="fa fa-pencil"></i>
                                                                Delete
                                                            </button>
                                                </td>
                                            </tr>
                                            <?php $cnt = $cnt + 1;
                                        }
                                    } ?>
                                    </tbody>
                                </table>
                            </div>
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
    <!-- DATATABLE SCRIPTS  -->
    <script src="assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
    </body>

    <script>
        window.onload = function () {
            console.log("doc is ready");
            <?php
            if (isset($_GET['id_class'])){ ?>

            getClasses();
            <?php
            }
            ?>
        };
    </script>

    <script>
        function getClasses() {
            let id_school = $('#id_school').val();
            //alert(id_school);
            let id_class_from_get = '0';
            <?php
            if (isset($_GET['id_class'])){ ?>
            id_class_from_get = <?php echo $_GET['id_class'];?>;
            <?php
            }
            ?>
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
