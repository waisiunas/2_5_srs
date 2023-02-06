<?php require_once 'database/connection.php'; ?>
<?php 

session_start();
if(isset($_SESSION['admin_id']) && !empty($_SESSION['admin_id'])) {
    $admin_id = $_SESSION['admin_id'];
    $sql = "SELECT * FROM `admins` WHERE `id` = $admin_id";
    $result = $conn->query($sql);
    $admin = $result->fetch_assoc();
} else {
    header('location: ./sign-in.php');
}

?>
<nav class="navbar navbar-expand navbar-light navbar-bg">
    <a class="sidebar-toggle js-sidebar-toggle">
        <i class="hamburger align-self-center"></i>
    </a>

    <div class="navbar-collapse collapse">
        <ul class="navbar-nav navbar-align">
            <li class="nav-item dropdown">
                <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
                    <i class="align-middle" data-feather="settings"></i>
                </a>

                <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
                    <span class="text-dark"><?php echo $admin['name']; ?></span>
                </a>
                <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="./signout.php">Sign out</a>
                </div>
            </li>
        </ul>
    </div>
</nav>