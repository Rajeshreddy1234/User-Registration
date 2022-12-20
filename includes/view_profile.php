<?php
$email = ($_POST['email'] == "" ? NULL : $_POST['email']);
$username = ($_POST['username'] == "" ? NULL : $_POST['username']);
$password = ($_POST['password'] == "" ? NULL : $_POST['password']);
$role = ($_POST['role'] == "" ? NULL : $_POST['role']);
if($_POST['Update']) {
    $stmt = $dbcon->prepare("SELECT * FROM users WHERE (username=? || email=?) && id!=?");
    $stmt->bind_param("ssi", $username, $email, $_SESSION['id']);
    $stmt->execute();
    $get_totalcount = $stmt->get_result();
    if(!$get_totalcount->num_rows) {
        $stmt1 = $dbcon->prepare("UPDATE users SET `email`=?, `username`=?, `password`=?, `role_id`=? WHERE id=?");
        $stmt1->bind_param("sssii", $email, $username, $password, $role, $_SESSION['id']);
        if($stmt1->execute()) {
            $query_response = "Profile updated";
        } else {
            $query_response = "<span style='color:#fff'> Failed to update profile </span>";
        }
    }
}

$stmt = $dbcon->prepare("SELECT * FROM users WHERE id=?");
$stmt->bind_param("i", $_SESSION['id']);
$stmt->execute();
$get_totalcount = $stmt->get_result();
$user_detail = $get_totalcount->fetch_assoc();
$countryid = $user_detail['country_id'];
$stateid = $user_detail['state_id'];

$user_type = mysqli_fetch_assoc(mysqli_query($dbcon, "SELECT * FROM user_types WHERE id=".$user_detail['role_id']))['usertype_name'];
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
<form action="" id="profile_form" method="post" enctype="multipart/form-data" novalidate>
    <input type="hidden" id="token" name="token" value="<?php echo $_SESSION['token']; ?>"/>
    <input type="hidden" id="id" name="id" value="<?php echo $_GET['id']; ?>"/>
    
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
        <label class="mb-1"> Role </label>
        <select class="form-control" name="role" id="role">
            <option value="">Select Role</option>
            <?php
                $user_stmt = $dbcon->prepare("SELECT * FROM user_types WHERE is_active = 1");
                $user_stmt->execute();
                $result = $user_stmt->get_result();
                if($result->num_rows)
                {
                    while($users = $result->fetch_assoc())
                        echo '<option '.($user_detail['role_id'] == $users['id'] ? "selected" : "").' value="'.$users['id'].'">'.$users['usertype_name'].'</option>';
                }
            ?>
        </select>
    </div>
    <div class="row mb-2">
        <div class="form-group">
            <div class="col-sm-12 text-center">
                <input type="submit" class="btn btn-gradient-primary" value="<?php if($_SESSION['id']) echo "Update"; else echo "Submit"; ?>" name="<?php if($_SESSION['id']) echo "Update"; else echo "Add"; ?>">
            </div>
        </div>
    </div>
</form>
<div id="pdfview"></div>
<script src="assets/js/jquery.min.js"></script>
<script>
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