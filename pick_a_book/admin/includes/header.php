<div class="navbar navbar-inverse set-radius-zero">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand">

                <img src="assets/img/logo-header.png" width="105">
            </a>

        </div>

        <div class="right-div">
            <a href="logout.php" class="btn btn-danger pull-right">LOG ME OUT</a>
        </div>
    </div>
</div>
<!-- LOGO HEADER END-->
<section class="menu-section">
    <div class="container">
        <div class="row ">
            <div class="col-md-12">
                <div class="navbar-collapse collapse ">
                    <ul id="menu-top" class="nav navbar-nav navbar-right">
                        <li><a href="dashboard.php" class="menu-top-active">DASHBOARD</a></li>

                        <li>
                            <a href="#" class="dropdown-toggle" id="ddlmenuItem" data-toggle="dropdown"> SCHOOLS <i
                                        class="fa fa-angle-down"></i></a>
                            <ul class="dropdown-menu" role="menu" aria-labelledby="ddlmenuItem">
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="add-school.php">Add
                                        School</a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="manage-school.php">Manage
                                        Schools</a></li>
                            </ul>
                        </li>

                        <li>
                            <a href="#" class="dropdown-toggle" id="ddlmenuItem" data-toggle="dropdown"> Syllabus <i
                                        class="fa fa-angle-down"></i></a>
                            <ul class="dropdown-menu" role="menu" aria-labelledby="ddlmenuItem">
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="add-book.php">Manage
                                        Syllabus</a></li>
                                <!--<li role="presentation"><a role="menuitem" tabindex="-1" href="manage-books.php">Manage
                                        Syllabus</a></li>-->
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="manage-book-requests.php">Manage
                                        Book Requests</a></li>
                            </ul>
                        </li>

                        <li><a href="reg-students.php">Users</a></li>

                        <li><a href="change-password.php">Update Profile</a></li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
</section>