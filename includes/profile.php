<?php
$email = ($_POST['email'] == "" ? NULL : $_POST['email']);
$username = ($_POST['username'] == "" ? NULL : $_POST['username']);
$password = ($_POST['password'] == "" ? NULL : $_POST['password']);
$name = ($_POST['name'] == "" ? NULL : $_POST['name']);
$gender = $_POST['gender'];
$martial_status = ($_POST['martial_status'] == "" ? NULL : $_POST['martial_status']);
$phone = ($_POST['phone'] == "" ? NULL : $_POST['phone']);
$primary_address = ($_POST['primary_address'] == "" ? NULL : $_POST['primary_address']);
$country_id = ($_POST['country_id'] == "" ? NULL : $_POST['country_id']);
$state_id = ($_POST['state_id'] == "" ? NULL : $_POST['state_id']);
$city_id = ($_POST['city_id'] == "" ? NULL : $_POST['city_id']);
$pincode = ($_POST['pincode'] == "" ? NULL : $_POST['pincode']);
$aadhaar_number = ($_POST['aadhaar_number'] == "" ? NULL : $_POST['aadhaar_number']);
$dob = ($_POST['dob'] == "" ? NULL : $_POST['dob']);
$age = ($_POST['age'] == "" ? NULL : $_POST['age']);
$blood_group = ($_POST['blood_group'] == "" ? NULL : $_POST['blood_group']);
$father_name = ($_POST['father_name'] == "" ? NULL : $_POST['father_name']);
$mother_name = ($_POST['mother_name'] == "" ? NULL : $_POST['mother_name']);
$height = ($_POST['height'] == "" ? NULL : $_POST['height']);
$weight = ($_POST['weight'] == "" ? NULL : $_POST['weight']);
$hsp_no = ($_POST['hsp_no'] == "" ? NULL : $_POST['hsp_no']);
$education = ($_POST['education'] == "" ? NULL : $_POST['education']);
$experience = ($_POST['experience'] == "" ? NULL : $_POST['experience']);
$datetime = date('Y-m-d H:i:s');
if($_POST['Update']) {
    $stmt = $dbcon->prepare("SELECT * FROM users WHERE (username=? || email=?) && id!=?");
    $stmt->bind_param("ssi", $username, $email, $_SESSION['id']);
    $stmt->execute();
    $get_totalcount = $stmt->get_result();
    if(!$get_totalcount->num_rows) {
        if ($_FILES['image']['name']) {
                $filename = addslashes($_FILES['image']['name']);
				$file_name = $_FILES['image']['name'];
				$tmpname = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));
				$array = array("jpeg","jpg","png","gif");
				$filesize = addslashes($_FILES["image"]["size"]);
				$ext = pathinfo($filename,PATHINFO_EXTENSION);
				$null = "NULL";
				if(in_array($ext,$array)===true) {
					$file_type = addslashes($_FILES["image"]["type"]);
                                            
					$file = fopen($_FILES['image']['tmp_name'], "r");

                    $stmt1 = $dbcon->prepare("UPDATE users SET `email`=?, `username`=?, `password`=?, `name`=?, `gender`=?, `martial_status`=?, `phone`=?, `primary_address`=?, `country_id`=?, `state_id`=?, `city_id`=?, `pincode`=?, `aadhaar_number`=?, `dob`=?, `age`=?, `blood_group`=?, `father_name`=?, `mother_name`=?, `height`=?, `weight`=?, `updated_at`=?, `image`=?, `imagetype`=?, `education`=?, `experience`=? WHERE id=?");
                    $stmt1->bind_param("ssssiissiiisssiissiisbsssi", $email, $username, $password, $name, $gender, $martial_status, $phone, $primary_address, $country_id, $state_id, $city_id, $pincode, $aadhaar_number, $dob, $age, $blood_group, $father_name, $mother_name, $height, $weight, $datetime, $tmpname, $file_type, $education, $experience, $_SESSION['id']);
                    $stmt1->send_long_data(21, fread($file, filesize($_FILES['image']['tmp_name'])));
                    if($stmt1->execute())
                    if ($_FILES['image']['name']) {
                        $filename = addslashes($_FILES['image']['name']);
                        $file_name = $_FILES['image']['name'];
                        $tmpname = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));
                        $array = array("jpeg","jpg","png","gif");
                        $filesize = addslashes($_FILES["image"]["size"]);
                        $ext = pathinfo($filename,PATHINFO_EXTENSION);
                        $null = "NULL";
                        if(in_array($ext,$array)===true) {
                            $file_type = addslashes($_FILES["image"]["type"]);
                                                    
                            $file = fopen($_FILES['image']['tmp_name'], "r");

                            $stmt2 = $dbcon->prepare("UPDATE child SET `name`=?, `aadhaar_no`=?, `age`=?, `dob`=?, `blood_group`=?, `father_name`=?, `mother_name`=?, `gender`=?, `email`=?, `phone`=?, `updated_at`=?, `image`=?, `imagetype`=?, `education`=?, `experience`=? WHERE `hospital_no`=?");
                            $stmt2->bind_param("ssisississsbssss", $name, $aadhaar_number, $age, $dob, $blood_group, $father_name, $mother_name, $gender, $email, $phone, $datetime, $tmpname, $file_type, $education, $experience, $hsp_no);
                            $stmt2->send_long_data(11, fread($file, filesize($_FILES['image']['tmp_name'])));

                            if($stmt2->execute()) {
                                $query_response = "Profile updated";
                            }
                            else {
                                $query_response = "<span style='color:#fff'> Failed to update profile </span>";
                            }
                        }
                        else
				            $query_response = "<span style='color:#fff'> Error uploading document. Only jpg, png, jpeg allowed </span>";
                    }
                }
                else
				$query_response = "<span style='color:#fff'> Error uploading document. Only jpg, png, jpeg allowed </span>";
            }
            else {
                $stmt1 = $dbcon->prepare("UPDATE users SET `email`=?, `username`=?, `password`=?, `name`=?, `gender`=?, `martial_status`=?, `phone`=?, `primary_address`=?, `country_id`=?, `state_id`=?, `city_id`=?, `pincode`=?, `aadhaar_number`=?, `dob`=?, `age`=?, `blood_group`=?, `father_name`=?, `mother_name`=?, `height`=?, `weight`=?, `updated_at`=?, `education`=?, `experience`=? WHERE id=?");
                $stmt1->bind_param("ssssiissiiiissiissiisssi", $email, $username, $password, $name, $gender, $martial_status, $phone, $primary_address, $country_id, $state_id, $city_id, $pincode, $aadhaar_number, $dob, $age, $blood_group, $father_name, $mother_name, $height, $weight, $datetime, $education, $experience, $_SESSION['id']);
                if($stmt1->execute())
                    $stmt2 = $dbcon->prepare("UPDATE child SET `name`=?, `aadhaar_no`=?, `age`=?, `dob`=?, `blood_group`=?, `father_name`=?, `mother_name`=?, `gender`=?, `email`=?, `phone`=?, `updated_at`=?, `education`=?, `experience`=? WHERE `hospital_no`=?");
                    $stmt2->bind_param("ssisississssss", $name, $aadhaar_number, $age, $dob, $blood_group, $father_name, $mother_name, $gender, $email, $phone, $datetime, $education, $experience, $hsp_no);
                    if($stmt2->execute()) {
                        $query_response = "Profile updated";
                    }
                    else {
                        $query_response = "<span style='color:#fff'> Failed to update profile </span>";
                    }
			}
    }
    else 
        $query_response = "<span style='color:#fff'> Image must be uploaded </span>";
}

$stmt = $dbcon->prepare("SELECT * FROM users WHERE id=?");
$stmt->bind_param("i", $_SESSION['id']);
$stmt->execute();
$get_totalcount = $stmt->get_result();
$user_detail = $get_totalcount->fetch_assoc();
$countryid = $user_detail['country_id'];
$stateid = $user_detail['state_id'];

$user_type = mysqli_fetch_assoc(mysqli_query($dbcon, "SELECT * FROM user_types WHERE id=".$user_detail['user_type_id']))['usertype_name'];
?>
<style>
    .text-gray-800 {
        color: #5a5c69!important;
        margin-left:10px;
        margin-top:15px;
    }
    .mb-4, .my-4 {
        margin-bottom: 1.5rem!important;
    }
    .h3, h3 {
        font-size: 1.75rem;
    }
    .row {
    display: flex;
    flex-wrap: wrap;
    margin-left: 1px;
    margin-right: 10px;
    }
    .row1 {
    display: flex;
    flex-wrap: wrap;
    margin-top: -10px;
    margin-left: 10px;
    margin-right: 10px;
    }
    .row2 {
    display: flex;
    flex-wrap: wrap;
    margin-top: 10px;
    margin-left: 10px;
    margin-right: 10px;
    }
</style>
<div class="h3 mb-4 text-gray-800"> Profile </div>
<?php
    if($_POST['Add'] || $_POST['Update'])
        echo '<div class="alert alert-secondary border-0 text-center" role="alert">
            <strong>Status!</strong>'.$query_response.'
        </div>';
?>
<form action="index.php?page=profile" method="post" id="validate_form" enctype="multipart/form-data">
    <input type="hidden" id="token" name="token" value="<?php echo $_SESSION['token']; ?>"/>
    <input type="hidden" id="id" name="id" value="<?php echo $_GET['id']; ?>"/>
    <?php
    if($_SESSION['user_type_id'] == 1 || $_SESSION['user_type_id'] == 5 || $_SESSION['user_type_id'] == 9 || $_SESSION['user_type_id'] == 10 || $_SESSION['user_type_id'] == 11) {
        ?>
        <div class="row mb-2">
            <div class="col-md-6">
                <?php
                if($user_detail['image'] != NULL){?>
                    <label class="mb-1"> Profile Image </label>
                    <input type="file" id="image" name="image" class="dropify" data-height="100"/>
                    <br>
                    <button class="btn btn-info btn-sm btn-gradient a1" style="margin-top:-10px;" type="button" id="<?php echo $user_detail['id']?>" class="view" onclick="viewpdf(this)">View Profile Image</button>
                <?php }else {
                    ?>
                    <label class="mb-1"> Profile Image </label>
                    <input type="file" id="image" name="image" class="dropify" data-height="100"/>
                <?php }?>
            </div>
        </div>
        <div class="row2 form-group">
            <label class="mb-1"> Email ID </label>
            <input autofocus type="text" class="form-control" value="<?php echo $user_detail['email'];?>" id="email" name="email" placeholder="Enter Email Id" maxlength="255" data-parsley-type="^[ a-zA-Z\d-@.#]+$" data-parsley-trigger="keyup">
        </div>
        <div class="row1 form-group">
            <label class="mb-1"> User Name </label>
            <input type="text" class="form-control" value="<?php echo $user_detail['username'];?>" id="username" name="username" maxlength="255" placeholder="Enter User Name" data-parsley-pattern="^[ a-zA-Z\d-@.#]+$" data-parsley-trigger="keyup">
        </div>
        <div class="row1 form-group">
            <label class="mb-1"> Password </label>
            <input type="text" class="form-control" value="<?php echo $user_detail['password'];?>" id="password" name="password" maxlength="255" placeholder="Enter Password" data-parsley-pattern="^[ a-zA-Z\d-@.#]+$" data-parsley-trigger="keyup">
        </div>
        <div class="row1 form-group">
            <label class="mb-1"> Full Name </label>
            <input type="text" class="form-control" value="<?php echo $user_detail['name'];?>" id="name" name="name" maxlength="255" placeholder="Enter Full Name" data-parsley-pattern="^[ a-zA-Z\d-@.#]+$" data-parsley-trigger="keyup">
        </div>
        <div class="row1 form-group">
            <label class="mb-1"> Gender </label>
            <select class="form-control" name="gender" id="gender">
                <option value="">Select Gender</option>
                <?php
                    $user_stmt = $dbcon->prepare("SELECT * FROM gender WHERE is_active = 1");
                    $user_stmt->execute();
                    $result = $user_stmt->get_result();
                    if($result->num_rows)
                    {
                        while($users = $result->fetch_assoc())
                            echo '<option '.($user_detail['gender'] == $users['id'] ? "selected" : "").' value="'.$users['id'].'">'.$users['gender_name'].'</option>';
                    }
                ?>
            </select>
        </div>
        <div class="row1 form-group">
            <label class="mb-1"> Martial Status </label>
            <select class="form-control" name="martial_status" id="martial_status">
                <option value="">Select Martial Status</option>
                <?php
                    $user_stmt = $dbcon->prepare("SELECT * FROM martial_status WHERE is_active = 1");
                    $user_stmt->execute();
                    $result = $user_stmt->get_result();
                    if($result->num_rows)
                    {
                        while($users = $result->fetch_assoc())
                            echo '<option '.($user_detail['martial_status'] == $users['id'] ? "selected" : "").' value="'.$users['id'].'">'.$users['status'].'</option>';
                    }
                ?>
            </select>
        </div>
        <div class="row1 form-group">
            <label class="mb-1"> Contact Number </label>
            <input type="number" class="form-control" value="<?php echo $user_detail['phone'];?>" id="phone" name="phone" placeholder="Enter Contact Number" onKeyPress="if(this.value.length==10) return false;" data-parsley-pattern="^[ a-zA-Z\d-@.#]+$" data-parsley-trigger="keyup">
        </div>
        <div class="row1 form-group">
            <label class="mb-1"> Primary Address </label>
            <textarea placeholder="Primary Address" name="primary_address" class="form-control" rows="4"><?php echo $user_detail['primary_address']; ?></textarea>
        </div>
        <div class="row1 form-group">
            <label class="mb-1"> Country </label>
            <select class="form-control" name="country_id" id="country_id">
                <option value=""> Select Country </option>
                <?php
                    $user_stmt = $dbcon->prepare("SELECT * FROM `country` WHERE `is_active`=1");
                    $user_stmt->execute();
                    $result = $user_stmt->get_result();
                    if($result->num_rows)
                    {
                        while($users = $result->fetch_assoc())
                            echo '<option '.($user_detail['country_id'] == $users['id'] ? "selected" : "").' value="'.$users['id'].'">'.$users['country_name'].'</option>';
                    }
                ?>
            </select>
        </div>
        <div class="row1 form-group">
            <label class="mb-1"> State </label>
            <select class="form-control" name="state_id" id="state_id">
            <?php
                if($_SESSION['id'])
                {
                    if($user_detail['state_id'] == NULL) {
                        ?>
                            <option> Select Country First </option>
                        <?php
                    }
                    else {
                        $record_query = "SELECT * FROM `state` WHERE `country_code`=?";
                        $record = $dbcon->prepare($record_query);
                        $record->bind_param("i", $countryid);
                        $record->execute();
                        $record_result = $record->get_result();
                            while($data = $record_result->fetch_assoc())
                                echo '<option '.(($user_detail['state_id'] == $data['id']) ? "selected" : "").' value="'.$data['id'].'">'.$data['state_name'].'</option>';
                    }
                }
                else
                {
                    ?>
                        <option> Select Country First </option>
                    <?php
                }
            ?>
            </select>
        </div>
        <div class="row1 form-group">
            <label class="mb-1"> City </label>
            <select class="form-control" name="city_id" id="city_id">
            <?php
                if($_SESSION['id'])
                {
                    if($user_detail['city_id'] == NULL) {
                        ?>
                            <option> Select State First </option>
                        <?php
                    }
                    else {
                        $record_query = "SELECT * FROM `city` WHERE `state_id`=?";
                        $record = $dbcon->prepare($record_query);
                        $record->bind_param("i", $stateid);
                        $record->execute();
                        $record_result = $record->get_result();
                            while($data = $record_result->fetch_assoc())
                                echo '<option '.(($user_detail['city_id'] == $data['id']) ? "selected" : "").' value="'.$data['id'].'">'.$data['city_name'].'</option>';
                    }
                }
                else
                {
                    ?>
                        <option> Select State First </option>
                    <?php
                }
            ?>
            </select>
        </div>
        <div class="row1 form-group">
            <label class="mb-1"> PIN Code </label>
            <input type="text" class="form-control" value="<?php echo $user_detail['pincode'];?>" id="pincode" name="pincode" placeholder="Enter PIN Code" maxlength="7" data-parsley-pattern="^[ a-zA-Z\d-@.#]+$" data-parsley-trigger="keyup">
        </div>
        <div class="row1 form-group">
            <label class="mb-1"> Hospital Number </label>
            <input readonly type="text" class="form-control" value="<?php echo $user_detail['hsp_no'];?>" id="hsp_no" name="hsp_no" placeholder="Enter Hospital Number" maxlength="255" data-parsley-pattern="^[ a-zA-Z\d-@.#]+$" data-parsley-trigger="keyup">
        </div>
        <div class="row1 form-group">
            <label class="mb-1"> User Type </label>
            <input readonly type="text" class="form-control" value="<?php echo $user_type;?>" id="user_type_id" name="user_type_id" placeholder="Enter User Type Id" maxlength="255" data-parsley-pattern="^[ a-zA-Z\d-@.#]+$" data-parsley-trigger="keyup">
        </div>
        <div class="row1 form-group">
            <label class="mb-1"> Aadhaar Number </label>
            <input type="text" class="form-control" value="<?php echo $user_detail['aadhaar_number'];?>" id="aadhaar_number" name="aadhaar_number" placeholder="Enter Aadhaar Number" maxlength="14" data-parsley-pattern="^[ a-zA-Z\d-@.#]+$" data-parsley-trigger="keyup">
        </div>
        <div class="row1 form-group">
            <label class="mb-1"> Date of Birth </label>
            <input type="date" class="form-control" value="<?php echo $user_detail['dob'];?>" id="dob" name="dob" data-parsley-trigger="keyup">
        </div>
        <div class="row1 form-group">
            <label class="mb-1"> Age </label>
            <input type="number" class="form-control" value="<?php echo $user_detail['age'];?>" id="age" name="age" placeholder="Enter Age" onKeyPress="if(this.value.length==3) return false;" data-parsley-pattern="^[ a-zA-Z\d-@.#]+$" data-parsley-trigger="keyup">
        </div>
        <div class="row1 form-group">
            <label class="mb-1"> Blood Group </label>
            <select class="form-control" name="blood_group" id="blood_group">
                <option value="">Select Blood Group</option>
                <?php
                    $user_stmt = $dbcon->prepare("SELECT * FROM blood_group WHERE is_active = 1");
                    $user_stmt->execute();
                    $result = $user_stmt->get_result();
                    if($result->num_rows)
                    {
                        while($users = $result->fetch_assoc())
                            echo '<option '.($user_detail['blood_group'] == $users['id'] ? "selected" : "").' value="'.$users['id'].'">'.$users['bloodgroup_name'].'</option>';
                    }
                ?>
            </select>
        </div>
        <div class="row1 form-group">
            <label class="mb-1"> Father Name </label>
            <input type="text" class="form-control" value="<?php echo $user_detail['father_name'];?>" id="father_name" name="father_name" maxlength="255" placeholder="Enter Father Name" data-parsley-pattern="^[ a-zA-Z\d-@.#]+$" data-parsley-trigger="keyup">
        </div>
        <div class="row1 form-group">
            <label class="mb-1"> Mother Name </label>
            <input type="text" class="form-control" value="<?php echo $user_detail['mother_name'];?>" id="mother_name" name="mother_name" maxlength="255" placeholder="Enter Mother Name" data-parsley-pattern="^[ a-zA-Z\d-@.#]+$" data-parsley-trigger="keyup">
        </div>
        <div class="row1 form-group">
            <label class="mb-1"> Height (in cms) </label>
            <input type="number" class="form-control" value="<?php echo $user_detail['height'];?>" id="height" name="height" placeholder="Enter Height" onKeyPress="if(this.value.length==4) return false;" data-parsley-pattern="^[ a-zA-Z\d-@.#]+$" data-parsley-trigger="keyup">
        </div>
        <div class="row1 form-group">
            <label class="mb-1"> Weight (in kgs) </label>
            <input type="number" class="form-control" value="<?php echo $user_detail['weight'];?>" id="weight" name="weight" placeholder="Enter Weight" onKeyPress="if(this.value.length==4) return false;" data-parsley-pattern="^[ a-zA-Z\d-@.#]+$" data-parsley-trigger="keyup">
        </div>
        <?php
    }
    else if($_SESSION['user_type_id'] == 2 || $_SESSION['user_type_id'] == 3 || $_SESSION['user_type_id'] == 6 || $_SESSION['user_type_id'] == 7 || $_SESSION['user_type_id'] == 8) {
        ?>
        <div class="row mb-2">
            <div class="col-md-6">
                <?php
                if($user_detail['image'] != NULL){?>
                    <label class="mb-1"> Profile Image </label>
                    <input type="file" id="image" name="image" class="dropify" data-height="100"/>
                    <br>
                    <button style="margin-top:-10px;" class="btn btn-info btn-sm btn-gradient" type="button" id="<?php echo $user_detail['id']?>" class="view" onclick="viewpdf(this)">View Profile Image</button>
                <?php }else {
                    ?>
                    <label class="mb-1"> Profile Image </label>
                    <input type="file" id="image" name="image" class="dropify" data-height="100"/>
                <?php }?>
            </div>
        </div>
        <div class="row2 form-group">
            <label class="mb-1"> Email ID </label>
            <input type="text" class="form-control" value="<?php echo $user_detail['email'];?>" id="email" name="email" placeholder="Enter Email Id" maxlength="255" data-parsley-type="^[ a-zA-Z\d-@.#]+$" data-parsley-trigger="keyup">
        </div>
        <div class="row1 form-group">
            <label class="mb-1"> User Name </label>
            <input type="text" class="form-control" value="<?php echo $user_detail['username'];?>" id="username" name="username" maxlength="255" placeholder="Enter User Name" data-parsley-pattern="^[ a-zA-Z\d-@.#]+$" data-parsley-trigger="keyup">
        </div>
        <div class="row1 form-group">
            <label class="mb-1"> Password </label>
            <input type="text" class="form-control" value="<?php echo $user_detail['password'];?>" id="password" name="password" maxlength="255" placeholder="Enter Password" data-parsley-pattern="^[ a-zA-Z\d-@.#]+$" data-parsley-trigger="keyup">
        </div>
        <div class="row1 form-group">
            <label class="mb-1"> Full Name </label>
            <input type="text" class="form-control" value="<?php echo $user_detail['name'];?>" id="name" name="name" maxlength="255" placeholder="Enter Full Name" data-parsley-pattern="^[ a-zA-Z\d-@.#]+$" data-parsley-trigger="keyup">
        </div>
        <div class="row1 form-group">
            <label class="mb-1"> Gender </label>
            <select class="form-control" name="gender" id="gender">
                <option value="">Select Gender</option>
                <?php
                    $user_stmt = $dbcon->prepare("SELECT * FROM gender WHERE is_active = 1");
                    $user_stmt->execute();
                    $result = $user_stmt->get_result();
                    if($result->num_rows)
                    {
                        while($users = $result->fetch_assoc())
                            echo '<option '.($user_detail['gender'] == $users['id'] ? "selected" : "").' value="'.$users['id'].'">'.$users['gender_name'].'</option>';
                    }
                ?>
            </select>
        </div>
        <div class="row1 form-group">
            <label class="mb-1"> Martial Status </label>
            <select class="form-control" name="martial_status" id="martial_status">
                <option value="">Select Martial Status</option>
                <?php
                    $user_stmt = $dbcon->prepare("SELECT * FROM martial_status WHERE is_active = 1");
                    $user_stmt->execute();
                    $result = $user_stmt->get_result();
                    if($result->num_rows)
                    {
                        while($users = $result->fetch_assoc())
                            echo '<option '.($user_detail['martial_status'] == $users['id'] ? "selected" : "").' value="'.$users['id'].'">'.$users['status'].'</option>';
                    }
                ?>
            </select>
        </div>
        <div class="row1 form-group">
            <label class="mb-1"> Education </label>
            <input type="text" class="form-control" value="<?php echo $user_detail['education'];?>" id="education" name="education" maxlength="255" placeholder="Enter Education" data-parsley-pattern="^[ a-zA-Z\d-@.#]+$" data-parsley-trigger="keyup">
        </div>
        <div class="row1 form-group">
            <label class="mb-1"> Experience (in Years) </label>
            <input type="text" class="form-control" value="<?php echo $user_detail['experience'];?>" id="experience" name="experience" maxlength="255" placeholder="Enter Experience" data-parsley-pattern="^[ a-zA-Z\d-@.#]+$" data-parsley-trigger="keyup">
        </div>
        <div class="row1 form-group">
            <label class="mb-1"> Contact Number </label>
            <input type="number" class="form-control" value="<?php echo $user_detail['phone'];?>" id="phone" name="phone" placeholder="Enter Contact Number" onKeyPress="if(this.value.length==10) return false;" data-parsley-pattern="^[ a-zA-Z\d-@.#]+$" data-parsley-trigger="keyup">
        </div>
        <div class="row1 form-group">
            <label class="mb-1"> Primary Address </label>
            <textarea placeholder="Primary Address" name="primary_address" class="form-control" rows="4"><?php echo $user_detail['primary_address']; ?></textarea>
        </div>
        <div class="row1 form-group">
            <label class="mb-1"> Country </label>
            <select class="form-control" name="country_id" id="country_id">
                <option value=""> Select Country </option>
                <?php
                    $user_stmt = $dbcon->prepare("SELECT * FROM `country` WHERE `is_active`=1");
                    $user_stmt->execute();
                    $result = $user_stmt->get_result();
                    if($result->num_rows)
                    {
                        while($users = $result->fetch_assoc())
                            echo '<option '.($user_detail['country_id'] == $users['id'] ? "selected" : "").' value="'.$users['id'].'">'.$users['country_name'].'</option>';
                    }
                ?>
            </select>
        </div>
        <div class="row1 form-group">
            <label class="mb-1"> State </label>
            <select class="form-control" name="state_id" id="state_id">
            <?php
                if($_SESSION['id'])
                {
                    if($user_detail['state_id'] == NULL) {
                        ?>
                            <option> Select Country First </option>
                        <?php
                    } else {
                        $record_query = "SELECT * FROM `state` WHERE `country_code`=?";
                        $record = $dbcon->prepare($record_query);
                        $record->bind_param("i", $countryid);
                        $record->execute();
                        $record_result = $record->get_result();
                            while($data = $record_result->fetch_assoc())
                                echo '<option '.(($user_detail['state_id'] == $data['id']) ? "selected" : "").' value="'.$data['id'].'">'.$data['state_name'].'</option>';
                    }
                }
                else
                {
                    ?>
                        <option> Select Country First </option>
                    <?php
                }
            ?>
            </select>
        </div>
        <div class="row1 form-group">
            <label class="mb-1"> City </label>
            <select class="form-control" name="city_id" id="city_id">
            <?php
                if($_SESSION['id'])
                {
                    if($user_detail['city_id'] == NULL) {
                        ?>
                            <option> Select State First </option>
                        <?php
                    } else {
                        $record_query = "SELECT * FROM `city` WHERE `state_id`=?";
                        $record = $dbcon->prepare($record_query);
                        $record->bind_param("i", $stateid);
                        $record->execute();
                        $record_result = $record->get_result();
                            while($data = $record_result->fetch_assoc())
                                echo '<option '.(($user_detail['city_id'] == $data['id']) ? "selected" : "").' value="'.$data['id'].'">'.$data['city_name'].'</option>';
                    }
                }
                else
                {
                    ?>
                        <option> Select State First </option>
                    <?php
                }
            ?>
            </select>
        </div>
        <div class="row1 form-group">
            <label class="mb-1"> PIN Code </label>
            <input type="text" class="form-control" value="<?php echo $user_detail['pincode'];?>" id="pincode" name="pincode" placeholder="Enter PIN Code" maxlength="7" data-parsley-pattern="^[ a-zA-Z\d-@.#]+$" data-parsley-trigger="keyup">
        </div>
        <div class="row1 form-group">
            <label class="mb-1"> Hospital Number </label>
            <input readonly type="text" class="form-control" value="<?php echo $user_detail['hsp_no'];?>" id="hsp_no" name="hsp_no" placeholder="Enter Hospital Number" maxlength="255" data-parsley-pattern="^[ a-zA-Z\d-@.#]+$" data-parsley-trigger="keyup">
        </div>
        <div class="row1 form-group">
            <label class="mb-1"> User Type </label>
            <input readonly type="text" class="form-control" value="<?php echo $user_type;?>" id="user_type_id" name="user_type_id" placeholder="Enter User Type Id" maxlength="255" data-parsley-pattern="^[ a-zA-Z\d-@.#]+$" data-parsley-trigger="keyup">
        </div>
        <div class="row1 form-group">
            <label class="mb-1"> Aadhaar Number </label>
            <input type="text" class="form-control" value="<?php echo $user_detail['aadhaar_number'];?>" id="aadhaar_number" name="aadhaar_number" placeholder="Enter Aadhaar Number" maxlength="14" data-parsley-pattern="^[ a-zA-Z\d-@.#]+$" data-parsley-trigger="keyup">
        </div>
        <div class="row1 form-group">
            <label class="mb-1"> Date of Birth </label>
            <input type="date" class="form-control" value="<?php echo $user_detail['dob'];?>" id="dob" name="dob" data-parsley-trigger="keyup">
        </div>
        <div class="row1 form-group">
            <label class="mb-1"> Age </label>
            <input type="number" class="form-control" value="<?php echo $user_detail['age'];?>" id="age" name="age" placeholder="Enter Age" onKeyPress="if(this.value.length==3) return false;" data-parsley-pattern="^[ a-zA-Z\d-@.#]+$" data-parsley-trigger="keyup">
        </div>
        <div class="row1 form-group">
            <label class="mb-1"> Blood Group </label>
            <select class="form-control" name="blood_group" id="blood_group">
                <option value="">Select Blood Group</option>
                <?php
                    $user_stmt = $dbcon->prepare("SELECT * FROM blood_group WHERE is_active = 1");
                    $user_stmt->execute();
                    $result = $user_stmt->get_result();
                    if($result->num_rows)
                    {
                        while($users = $result->fetch_assoc())
                            echo '<option '.($user_detail['blood_group'] == $users['id'] ? "selected" : "").' value="'.$users['id'].'">'.$users['bloodgroup_name'].'</option>';
                    }
                ?>
            </select>
        </div>
        <div class="row1 form-group">
            <label class="mb-1"> Father Name </label>
            <input type="text" class="form-control" value="<?php echo $user_detail['father_name'];?>" id="father_name" name="father_name" maxlength="255" placeholder="Enter Father Name" data-parsley-pattern="^[ a-zA-Z\d-@.#]+$" data-parsley-trigger="keyup">
        </div>
        <div class="row1 form-group">
            <label class="mb-1"> Mother Name </label>
            <input type="text" class="form-control" value="<?php echo $user_detail['mother_name'];?>" id="mother_name" name="mother_name" maxlength="255" placeholder="Enter Mother Name" data-parsley-pattern="^[ a-zA-Z\d-@.#]+$" data-parsley-trigger="keyup">
        </div>
        <div class="row1 form-group">
            <label class="mb-1"> Height (in cms) </label>
            <input type="number" class="form-control" value="<?php echo $user_detail['height'];?>" id="height" name="height" placeholder="Enter Height" onKeyPress="if(this.value.length==4) return false;" data-parsley-pattern="^[ a-zA-Z\d-@.#]+$" data-parsley-trigger="keyup">
        </div>
        <div class="row1 form-group">
            <label class="mb-1"> Weight (in kgs) </label>
            <input type="number" class="form-control" value="<?php echo $user_detail['weight'];?>" id="weight" name="weight" placeholder="Enter Weight" onKeyPress="if(this.value.length==4) return false;" data-parsley-pattern="^[ a-zA-Z\d-@.#]+$" data-parsley-trigger="keyup">
        </div>
        <?php
    }
    ?>
    <div class="row mb-2">
        <div class="form-group">
            <div class="col-sm-12 text-center">
                <input type="submit" class="btn btn-gradient-primary" value="<?php if($_SESSION['id']) echo "Update"; else echo "Submit"; ?>" name="<?php if($_SESSION['id']) echo "Update"; else echo "Add"; ?>">
            </div>
        </div>
    </div>
</form>
<div id="pdfview"></div>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/css/datepicker.min.css" rel="stylesheet">
<script src="assets/js/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/js/bootstrap-datepicker.min.js"></script>
<script src="https://netdna.bootstrapcdn.com/bootstrap/2.3.2/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function(){
        $('#validate_form').parsley();
    });
    function viewpdf(e){
		var pdfid4 = $(e).attr('id');
		var sessiontoken = $('#token').val();
		$.ajax({
			type: 'POST',
			url: 'includes/pdfview.php',
			data: {Pdfid4:pdfid4,token: sessiontoken},
			success: function(html) {
				$('#pdfview').html(html);
				$('#mymodal').modal('show');				
			}
		});
	}
</script>
<script>
$(document).ready(function(){
    $('#country_id').on('change', function(){
        
        var countryID1 = $(this).val();
        var token = $("#token").val();
        if(countryID1)
		{
            $.ajax({
                type:'POST',
                url:'includes/overall_ajax_data.php',
                data:'countryID1='+countryID1+'&token='+token,
                success:function(html){
                    $('#state_id').html(html);
                }
            }); 
        }
		else
		{
            $('#state_id').html('<option value=""> Select Country First </option>');   
        }
    });
    $('#state_id').on('change', function(){
        
        var stateID1 = $(this).val();
        var token = $("#token").val();
        if(stateID1)
        {
            $.ajax({
                type:'POST',
                url:'includes/overall_ajax_data.php',
                data:'stateID1='+stateID1+'&token='+token,
                success:function(html){
                    $('#city_id').html(html);
                }
            }); 
        }
        else
        {
            $('#city_id').html('<option value="">Select State first</option>');   
        }
    });
});
</script>
<script>
    document.getElementById('aadhaar_number').addEventListener('input', function (e) {
        e.target.value = e.target.value.replace(/[^\dA-Z]/g, '').replace(/(.{4})/g, '$1 ').trim();
    });
</script>
<script>
    document.getElementById('pincode').addEventListener('input', function (e) {
        e.target.value = e.target.value.replace(/[^\dA-Z]/g, '').replace(/(.{3})/g, '$1 ').trim();
    });
</script>