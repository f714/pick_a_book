<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {
    if (isset($_GET['del'])) {
        $id = $_GET['del'];
        $sql = "DELETE from book_requests WHERE id =:id";
        $query = $dbh->prepare($sql);
        $query->bindParam(':id', $id, PDO::PARAM_STR);
        $query->execute();
        $_SESSION['delmsg'] = "Book request deleted successfully ";
        header('location:manage-book-requests.php');

    }
    if (isset($_GET['status-id'])) {
        $id = $_GET['status-id'];
        $status = $_POST['status'];
        //echo "status: ".$status;
        $sql = "UPDATE book_requests set status=:status, updated_date = NOW() where id=:id";
        //echo "<br> sql: ".$sql;
        $query = $dbh->prepare($sql);
        $query->bindParam(':id', $id, PDO::PARAM_STR);
        $query->bindParam(':status', $status, PDO::PARAM_STR);
        $query->execute();
        $_SESSION['updatemsg'] = "Book request status has been changed ";
        header('location:manage-book-requests.php');

    }


    ?>
    <!DOCTYPE html>
    <html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
        <meta name="description" content=""/>
        <meta name="author" content=""/>
        <title>Pick a Book | Manage Book Requests</title>
        <!-- BOOTSTRAP CORE STYLE  -->
        <link href="assets/css/bootstrap.css" rel="stylesheet"/>
        <!-- FONT AWESOME STYLE  -->
        <link href="assets/css/font-awesome.css" rel="stylesheet"/>
        <!-- DATATABLE STYLE  -->
        <link href="assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet"/>
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
                    <h4 class="header-line">Manage Book Requests</h4>
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
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Books Listing
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Request ID</th>
                                        <th>User Name</th>
                                        <th>Book Name</th>
                                        <th>Publisher</th>
                                        <th>School</th>
                                        <th>Class</th>
                                        <th>Request Date</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $sql = "SELECT br.*, b.BookName, u.FullName, s.name as school_name, c.class_name, p.PublisherName from book_requests br 
                                                JOIN tblbooks b ON b.id = br.id_book
                                                JOIN tblstudents u ON u.id = br.id_user
                                                JOIN schools s ON s.id = b.id_school
                                                JOIN classes c ON c.id = b.id_class
                                                JOIN publishers p ON p.id = b.id_publisher
                                                ORDER BY id DESC";
                                    $query = $dbh->prepare($sql);
                                    $query->execute();
                                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                                    $cnt = 1;
                                    $new_request = "";
                                    if ($query->rowCount() > 0) {
                                        foreach ($results as $result) {
                                            if (htmlentities($result->status) == 'NEW') {
                                                $new_request = "bg-warning";
                                            } else {
                                                $new_request = "";
                                            } ?>
                                            <tr class="odd gradeX <?php echo $new_request ?>">
                                                <td class="center"><?php echo htmlentities($cnt); ?></td>
                                                <td class="center"><?php echo htmlentities($result->id); ?></td>
                                                <td class="center"><?php echo htmlentities($result->FullName); ?></td>
                                                <td class="center"><?php echo htmlentities($result->BookName); ?></td>
                                                <td class="center"><?php echo htmlentities($result->PublisherName); ?></td>
                                                <td class="center"><?php echo htmlentities($result->school_name); ?></td>
                                                <td class="center"><?php echo htmlentities($result->class_name); ?></td>
                                                <td class="center"><?php echo htmlentities($result->created_date); ?></td>
                                                <td class="center">
                                                    <form role="form" method="post"
                                                          action="manage-book-requests.php?status-id=<?php echo htmlentities($result->id); ?>">
                                                        <div class="col-sm-12">
                                                            <div class="col-sm-8">
                                                                <select class="form-control" name="status" id="status">
                                                                    <option value="NEW" <?php if (htmlentities($result->status) == 'NEW') {
                                                                        echo "selected";
                                                                    } ?>>NEW
                                                                    </option>
                                                                    <option value="ACCEPT" <?php if (htmlentities($result->status) == 'ACCEPT') {
                                                                        echo "selected";
                                                                    } ?>>ACCEPT
                                                                    </option>
                                                                    <option value="REJECT" <?php if (htmlentities($result->status) == 'REJECT') {
                                                                        echo "selected";
                                                                    } ?>>REJECT
                                                                    </option>
                                                                </select>
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <button class="btn btn-xs btn-success "
                                                                        type="submit"><i class="fa fa-check"></i></button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </td>
                                                <td class="center">
                                                    <a href="manage-book-requests.php?del=<?php echo htmlentities($result->id); ?>"
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
                    <!--End Advanced Tables -->
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
    <!-- DATATABLE SCRIPTS  -->
    <script src="assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
    <!-- CUSTOM SCRIPTS  -->
    <script src="assets/js/custom.js"></script>
    </body>
    </html>
<?php } ?>
