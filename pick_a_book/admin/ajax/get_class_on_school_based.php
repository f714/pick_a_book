<?php
include('../includes/config.php');
if (isset($_GET['id_school'])) {
    $id_class = $_GET['id_class_from_get'];

    ?>
    <option>Select Class</option>
    <?php
    $sql = "SELECT * from classes where id_school= '". $_GET['id_school'] ."' ";
    //echo $sql;
    $query = $dbh->prepare($sql);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    $cnt = 1;
    if ($query->rowCount() > 0) {
        foreach ($results as $result) { ?>
            <option value="<?php echo htmlentities($result->id); ?>"<?php if ($id_class !== '0' && $id_class == htmlentities($result->id)){echo "selected";}?>><?php echo htmlentities($result->class_name); ?></option>
        <?php }
    }
}
?>