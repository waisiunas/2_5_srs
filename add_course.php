<?php require_once 'database/connection.php'; ?>

<?php
$title = 'Add Course';
$error = $success = $name = '';

if (isset($_POST['submit'])) {
    $name = htmlspecialchars($_POST['name']);

    if (empty($name)) {
        $error = "Name please";
    } else {
        $sql = "INSERT INTO `courses`(`name`) VALUES ('${name}')";
        if ($conn->query($sql)) {
            $success = 'Added!';
        } else {
            $error = 'Failed to add!';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<?php require_once 'includes/head.php'; ?>

<body>
    <div class="wrapper">
        <?php require_once 'includes/sidebar.php'; ?>
        <div class="main">

            <?php require_once 'includes/navbar.php'; ?>
            <main class="content">
                <div class="container-fluid p-0">

                    <div class="row">
                        <div class="col-6">
                            <h1 class="h3 mb-3">Students</h1>
                        </div>
                        <div class="col-6 text-end">
                            <a href="show_courses.php" class="btn btn-primary">Courses</a>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="text-danger"><?php echo $error; ?></div>
                                    <div class="text-success"><?php echo $success; ?></div>
                                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                                        <div class="mb-2">
                                            <label for="name">Name</label>
                                            <input type="text" class="form-control" name="name" id="name" value="<?php echo $name ?>" placeholder="Name please">
                                        </div>

                                        <div class="mb-2">
                                            <input type="submit" value="Submit" name="submit" class="btn btn-primary">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </main>

            <?php require_once 'includes/footer.php'; ?>
        </div>
    </div>

    <script src="./assets/js/app.js"></script>

</body>

</html>