<?php require_once 'database/connection.php'; ?>

<?php
$error = $success = '';
$sql = "SELECT * FROM `students`";
$result = $conn->query($sql);
$students = $result->fetch_all(MYSQLI_ASSOC);

$sql = "SELECT * FROM `courses`";
$result = $conn->query($sql);
$courses = $result->fetch_all(MYSQLI_ASSOC);

if (isset($_POST['submit'])) {
    $student_id = htmlspecialchars($_POST['student']);
    $course_id = htmlspecialchars($_POST['course']);

    if (empty($student_id)) {
        $error = "Please select the student!";
    } elseif (empty($course_id)) {
        $error = "Please select the course!";
    } else {
        $sql = "SELECT * FROM `registrations` WHERE `student_id` = $student_id AND `course_id` = $course_id";
        $result = $conn->query($sql);
        if($result->num_rows == 0) {
            $sql = "INSERT INTO `registrations`(`student_id`, `course_id`) VALUES ('$student_id', '$course_id')";
            if($conn->query($sql)) {
                $success = "Magic has been spelled!";
                $student_id = $course_id = '';
            } else {
                $error = "Magic has failed to spell!";
            }
        } else {
            $error = "Student is already registered in this course!"; 
        }
        
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<?php
$title = "Add Registration";
require_once 'includes/head.php';
?>

<body>
    <div class="wrapper">
        <?php require_once 'includes/sidebar.php'; ?>
        <div class="main">

            <?php require_once 'includes/navbar.php'; ?>
            <main class="content">
                <div class="container-fluid p-0">

                    <div class="row">
                        <div class="col-6">
                            <h1 class="h3 mb-3">Add Registration</h1>
                        </div>
                        <div class="col-6 text-end">
                            <a href="./show_registrations.php" class="btn btn-primary">Registrations</a>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                                        <div class="text-danger"><?php echo $error; ?></div>
                                        <div class="text-success"><?php echo $success; ?></div>

                                        <div class="mb-3">
                                            <label for="student">Students</label>
                                            <select name="student" id="student" class="form-select">
                                                <option value="">Please select the student</option>
                                                <?php
                                                foreach ($students as $student) {
                                                    if ($student['id'] == $student_id) { ?>
                                                        <option value="<?php echo $student['id']; ?>" selected><?php echo $student['name']; ?></option>
                                                    <?php
                                                    } else { ?>
                                                        <option value="<?php echo $student['id']; ?>"><?php echo $student['name']; ?></option>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label for="course">Courses</label>
                                            <select name="course" id="course" class="form-select">
                                                <option value="">Please select the course</option>
                                                <?php
                                                foreach ($courses as $course) {
                                                    if ($course['id'] == $course_id) { ?>
                                                        <option value="<?php echo $course['id']; ?>" selected><?php echo $course['name']; ?></option>
                                                    <?php
                                                    } else { ?>
                                                        <option value="<?php echo $course['id']; ?>"><?php echo $course['name']; ?></option>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <input type="submit" value="Submit" class="btn btn-primary" name="submit">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </main>

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row text-muted">
                        <div class="col-6 text-start">
                            <p class="mb-0">
                                <a class="text-muted" href="https://adminkit.io/" target="_blank"><strong>AdminKit</strong></a> - <a class="text-muted" href="https://adminkit.io/" target="_blank"><strong>Bootstrap Admin Template</strong></a> &copy;
                            </p>
                        </div>
                        <div class="col-6 text-end">
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <a class="text-muted" href="https://adminkit.io/" target="_blank">Support</a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="text-muted" href="https://adminkit.io/" target="_blank">Help Center</a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="text-muted" href="https://adminkit.io/" target="_blank">Privacy</a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="text-muted" href="https://adminkit.io/" target="_blank">Terms</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <script src="./assets/js/app.js"></script>

</body>

</html>