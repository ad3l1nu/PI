<?php
include('src/functions.php');
include('src/config.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>MediCare Hub : Insert</title>
    <?php include('src/head.php') ?>
</head>

<body>

<?php include('src/preload.php') ?>
<!--=========== BEGIN HEADER SECTION ================-->
<?php include('src/header.php') ?>
<!--=========== END HEADER SECTION ================-->

<?php
include('src/session_check.php');
echo youAreHere("Insert");

$data = $_GET['data'];
if (isset($_POST['add'])) {
    $res;
    if ($data == 'test') {
        $testname = isset($_POST['testname']) ? $_POST['testname'] : "";
        $testfee = isset($_POST['testfee']) ? $_POST['testfee'] : "";
        $res = mysqli_query($con, "INSERT INTO test (test_name, test_cost) VALUES ('$testname','$testfee')");
    } else if ($data == "doctor") {
        $fname = isset($_POST['fname']) ? $_POST['fname'] : "";
        $lname = isset($_POST['lname']) ? $_POST['lname'] : "";
        $name = $fname . " " . $lname;
        $email = isset($_POST['mail']) ? $_POST['mail'] : "";
        $dob = isset($_POST['dob']) ? $_POST['dob'] : "";
        $gnd = isset($_POST['gnd']) ? $_POST['gnd'] : "";
        $addr = isset($_POST['addr']) ? $_POST['addr'] : "";
        $phno = isset($_POST['phno']) ? $_POST['phno'] : "";
        $pwd = isset($_POST['pwd']) ? $_POST['pwd'] : "";
        $fee = isset($_POST['fee']) ? $_POST['fee'] : "";
        $cat = isset($_POST['category']) ? $_POST['category'] : "";
        $res = mysqli_query($con, "INSERT INTO doctor (name, email, dob, gender, address, phone, password, Fees, Category) VALUES ('$name','$email','$dob','$gnd','$addr','$phno','$pwd','$fee','$cat')");
    }
    if ($res == 1) {
        alert_and_redirect("Insertion Successful", "update.php");
    } else {
        alert("Insertion Unucesssful");
    }
}
if ($data == 'test') {
    ?>
    <section id="service">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="service-area">
                        <!-- Start Service Title -->
                        <div class="section-heading">
                            <h2>Adaugă test</h2>
                            <div class="line"></div>
                        </div>
                        <div class="service-content">
                            <div class="row">
                                <div class="col-lg-12 col-md-12">
                                    <form class="appointment-form" method="post">
                                        <div class="row">
                                            <div class="col-lg-2 col-md-2"></div>
                                            <div class="col-lg-8 col-md-8 col-sm-6">
                                                <label class="control-label">Nume <span class="required">*</span></label>
                                                <input type="text" class="wp-form-control wpcf7-text" name="testname" required
                                                       value="<?= isset($_POST['testname']) ? $_POST['testname'] : "" ?>">
                                            </div>
                                            <div class="col-lg-2 col-md-2"></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-2 col-md-2"></div>
                                            <div class="col-lg-8 col-md-8 col-sm-6">
                                                <label class="control-label">Tarif <span class="required">*</span></label>
                                                <input type="number" class="wp-form-control wpcf7-text" name="testfee" required
                                                       value="<?= isset($_POST['testfee']) ? $_POST['testfee'] : "" ?>">
                                            </div>
                                            <div class="col-lg-2 col-md-2"></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-2 col-md-2"></div>
                                            <div class="col-lg-8 col-md-8 col-sm-6">
                                                <button class="wpcf7-submit button--itzel" name="add" type="submit">
                                                    <i class="button__icon fa fa-share"></i><span>Adauga</span>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php
} else if ($data == 'doctor') {
    ?>
    <section id="service">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="service-area">
                        <!-- Start Service Title -->
                        <div class="section-heading">
                            <h2>Adaugă medic</h2>
                            <div class="line"></div>
                        </div>
                        <div class="service-content">
                            <div class="row">
                                <div class="col-lg-12 col-md-12">
                                    <form class="appointment-form" method="post">
                                        <div class="row">
                                            <div class="col-lg-2 col-md-2"></div>
                                            <div class="col-lg-4 col-md-4 col-sm-6">
                                                <label class="control-label">Prenume <span class="required">*</span></label>
                                                <input type="text" class="wp-form-control wpcf7-text" placeholder="First name" name="fname"
                                                       required pattern="[A-Za-z-0-9]+" value="<?= isset($_POST['fname']) ? $_POST['fname'] : "" ?>">
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-6">
                                                <label class="control-label">Nume de familie <span class="required">*</span></label>
                                                <input type="text" class="wp-form-control wpcf7-text" placeholder="Last name" name="lname"
                                                       required pattern="[A-Za-z-0-9]+" value="<?= isset($_POST['lname']) ? $_POST['lname'] : "" ?>">
                                            </div>
                                            <div class="col-lg-2 col-md-2"></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-2 col-md-2"></div>
                                            <div class="col-lg-8 col-md-8 col-sm-6">
                                                <label class="control-label">Email <span class="required">*</span></label>
                                                <input type="email" class="wp-form-control wpcf7-text" placeholder="Email address" name="mail"
                                                       required value="<?= isset($_POST['mail']) ? $_POST['mail'] : "" ?>">
                                            </div>
                                            <div class="col-lg-2 col-md-2"></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-2 col-md-2"></div>
                                            <div class="col-lg-8 col-md-8 col-sm-6">
                                                <label class="control-label">Data nașterii <span class="required">*</span></label>
                                                <input type="date" class="wp-form-control wpcf7-text" placeholder="dd/mm/yy"
                                                       max="<?= date("Y-m-d") ?>" name="dob" required value="<?= isset($_POST['dob']) ? $_POST['dob'] : "" ?>">
                                            </div>
                                            <div class="col-lg-2 col-md-2"></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-2 col-md-2"></div>
                                            <div class="col-lg-8 col-md-8 col-sm-6">
                                                <label class="control-label">Gen <span class="required">*</span></label>
                                                <select class="wp-form-control wpcf7-text" name="gnd" required>
                                                    <option value="<?= isset($_POST['gnd']) ? $_POST['gnd'] : "" ?>"><?= isset($_POST['gnd']) ? $_POST['gnd'] : "" ?></option>
                                                    <option value="Male">Bărbat</option>
                                                    <option value="Female">Femeie</option>
                                                </select>
                                            </div>
                                            <div class="col-lg-2 col-md-2"></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-2 col-md-2"></div>
                                            <div class="col-lg-8 col-md-8 col-sm-6">
                                                <label class="control-label">Adresă <span class="required">*</span></label>
                                                <input type="text" class="wp-form-control wpcf7-text" placeholder="address" name="addr"
                                                       required value="<?= isset($_POST['addr']) ? $_POST['addr'] : "" ?>">
                                            </div>
                                            <div class="col-lg-2 col-md-2"></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-2 col-md-2"></div>
                                            <div class="col-lg-8 col-md-8 col-sm-6">
                                                <label class="control-label">Telefon <span class="required">*</span></label>
                                                <input type="number" class="wp-form-control wpcf7-text" placeholder="phone No" name="phno"
                                                       required value="<?= isset($_POST['phno']) ? $_POST['phno'] : "" ?>">
                                            </div>
                                            <div class="col-lg-2 col-md-2"></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-2 col-md-2"></div>
                                            <div class="col-lg-8 col-md-8 col-sm-6">
                                                <label class="control-label">Password <span class="required">*</span></label>
                                                <input type="password" class="wp-form-control wpcf7-text" placeholder="password" name="pwd"
                                                       required value="<?= isset($_POST['pwd']) ? $_POST['pwd'] : "" ?>">
                                            </div>
                                            <div class="col-lg-2 col-md-2"></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-2 col-md-2"></div>
                                            <div class="col-lg-8 col-md-8 col-sm-6">
                                                <label class="control-label">Tarif <span class="required">*</span></label>
                                                <input type="text" class="wp-form-control wpcf7-text" placeholder="Fees" name="fee" required
                                                       value="<?= isset($_POST['fee']) ? $_POST['fee'] : "" ?>">
                                            </div>
                                            <div class="col-lg-2 col-md-2"></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-2 col-md-2"></div>
                                            <div class="col-lg-8 col-md-8 col-sm-6">
                                                <label class="control-label">Categorie <span class="required">*</span></label>
                                                <input type="text" class="wp-form-control wpcf7-text" placeholder="Category" name="category"
                                                       required value="<?= isset($_POST['category']) ? $_POST['category'] : "" ?>">
                                            </div>
                                            <div class="col-lg-2 col-md-2"></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-2 col-md-2"></div>
                                            <div class="col-lg-8 col-md-8 col-sm-6">
                                                <button class="wpcf7-submit button--itzel" name="add" type="submit">
                                                    <i class="button__icon fa fa-share"></i><span>Adauga</span>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php
}
?>

<!--=========== Start Footer SECTION ================-->
<?php include('src/footer.php') ?>
<!--=========== End Footer SECTION ================-->

<?php include('src/incfooter.php') ?>
</body>

</html>
