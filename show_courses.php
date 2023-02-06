<?php require_once 'database/connection.php'; ?>

<?php
$title = 'Show Courses';
$sql = "SELECT * FROM `courses`";
$result = $conn->query($sql);

$courses = $result->fetch_all(MYSQLI_ASSOC);

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
                            <h1 class="h3 mb-3">Courses</h1>
                        </div>
                        <div class="col-6 text-end">
                            <a href="add_course.php" class="btn btn-primary">Add Course</a>
                        </div>
                    </div>

					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title mb-0">Courses</h5>
								</div>
								<div class="card-body">
                                <?php
                                    if (count($courses) > 0) { ?>

                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Created At</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                foreach ($courses as $course) {
                                                ?>
                                                    <tr>
                                                        <td><?php echo $course['name']; ?></td>
                                                        <td><?php echo $course['created_at']; ?></td>
                                                        <td>
                                                            <a href="./edit_course.php?id=<?php echo $course['id']; ?>" class="btn btn-primary">Edit</a>
                                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" onclick="deleteCourse(<?php echo $course['id']; ?>)">
                                                                Delete
                                                            </button>

                                                        </td>
                                                    </tr>
                                                <?php
                                                }
                                                ?>

                                            </tbody>
                                        </table>

                                    <?php
                                    } else {
                                        echo "No students Found!";
                                    }
                                    ?>
								</div>
							</div>
						</div>
					</div>

				</div>
			</main>

			<?php require_once 'includes/footer.php'; ?>
		</div>
	</div>

    <!-- Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h1 class="modal-title fs-5 text-white" id="deleteModalLabel">Delete User</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure to delete this?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <a href="" class="btn btn-danger" id="btn-delete">Delete</a>
                </div>
            </div>
        </div>
    </div>

	<script src="./assets/js/app.js"></script>

    <script>
        function deleteCourse (id) {
            btnDelete = document.getElementById('btn-delete');
            btnDelete.setAttribute('href', 'delete_course.php?id=' + id);
        }
    </script>

</body>

</html>