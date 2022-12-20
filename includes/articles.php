<?php
    $user_id = $_SESSION['id'];
	$title = ($_POST['title'] == "" ? NULL : $_POST['title']);
    $post = ($_POST['post'] == "" ? NULL : $_POST['post']);
	if($_POST['Add'])
	{
		$stmt = $dbcon->prepare("SELECT * FROM articles WHERE title=?");
		$stmt->bind_param("s", $title);
		$stmt->execute();
		$get_totalcount = $stmt->get_result();
		if(!$get_totalcount->num_rows)
		{
			$stmt = $dbcon->prepare("INSERT INTO articles (`title`, `post`, `user_id`) VALUES (?, ?, ?)");
			$stmt->bind_param("ssi", $title, $post, $user_id);
			if($stmt->execute())
				$query_response = "Articles Added successfully";
			else
				$query_response = "<span style='color:#fff'> Failed to Add Articles </span>";
		}
		else
			$query_response = "<span style='color:#fff'> Unique Title </span>";
	}
	else if($_POST['Update'])
	{
		$stmt = $dbcon->prepare("SELECT * FROM articles WHERE title=? && id!=?");
		$stmt->bind_param("si", $title, $_POST['id']);
		$stmt->execute();
		$get_totalcount = $stmt->get_result();
		if(!$get_totalcount->num_rows)
		{
			$stmt = $dbcon->prepare("UPDATE articles SET `title`=?, `post`=?, `user_id` WHERE id=?");
			$stmt->bind_param("ssii", $title, $post, $user_id, $_POST['id']);
			if($stmt->execute())
				$query_response = "Articles updated successfully";
			else
				$query_response = "<span style='color:#fff'> Failed to update Articles </span>";
		}
		else
			$query_response = "<span style='color:#fff'> Unique Title </span>";
	}
	if($_GET['id'])
	{
		$stmt = $dbcon->prepare("SELECT * FROM articles WHERE id=?");
		$stmt->bind_param("i", $_GET['id']);
		$stmt->execute();
		$get_totalcount = $stmt->get_result();
		$user_detail = $get_totalcount->fetch_assoc();
	}
?>
<div class="mt-1 container-fluid">
	<div class="row">
		<div class="col-md-12 col-lg-12 col-xl-12">
			<div class="card">
				<div class="card-body" style="padding: .5rem;">
					<h4 class="text-center page-title"> Articles </h4>
					<?php
							if($_POST['Add'] || $_POST['Update'])
								echo '<div class="alert alert-secondary border-0 text-center" role="alert">
									<strong>Status!</strong>'.$query_response.'
								</div>';
						?>
						<?php if($_GET['action'] == "add" || $_GET['id'])
                      {?>
					  <div class="mb-0">
						<form action="index.php?page=articles" method="post" id="validate_form">
							<input type="hidden" id="token" name="token" value="<?php echo $_SESSION['token']; ?>"/>
							<input type="hidden" id="id" name="id" value="<?php echo $_GET['id']; ?>"/>
							<div class="row mb-2">
                                <div class="col-md-3">
									<label class="mb-1"> Title <span style="color:red;">&nbsp;*<span></label>
									<input required type="text" class="form-control" value="<?php echo $user_detail['title'];?>" 
									id="title" name="title" placeholder="Enter title" maxlength="255" 
									data-parsley-pattern="^[ a-zA-Z0-9]+$" data-parsley-trigger="keyup">
								</div>

                                <div class="col-md-3">
									<label class="mb-1"> Post <span style="color:red;">&nbsp;*<span></label>
									<input required type="text" class="form-control" value="<?php echo $user_detail['post'];?>" 
									id="post" name="post" placeholder="Enter Post" maxlength="30" 
									data-parsley-pattern="^[ a-zA-Z0-9-/#]+$" data-parsley-trigger="keyup">
								</div>
								
                            </div>

                            <div class="row mb-2">
								<div class="form-group">
									<div class="col-sm-12 text-center">
										<input type="submit" class="btn btn-gradient-primary" value="<?php if($_GET['id']) echo "Update"; else echo "Submit"; ?>" name="<?php if($_GET['id']) echo "Update"; else echo "Add"; ?>">
										<a href="index.php?page=articles" class="btn btn-danger"> Cancel</a>
									</div>
								</div>
							</div>
                            
						</form>
					</div>
					<?php }else{?>
						<a href="index.php?page=articles&action=add" class="btn btn-gradient-primary float-right"> Add Articles </a>
						<table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
							<thead>
								<tr>
									<th> Sln. </th>
									<th> Title </th>
									<th> Post </th>
									<th> Action </th>
								</tr>
							</thead>
							<tbody>
								<?php
									$Sln = 1;
									$get_logs = $dbcon->prepare("SELECT * FROM articles WHERE user_id = '".$_SESSION['id']."' ORDER BY id ASC");
									$get_logs->execute();
									$get_totalcount = $get_logs->get_result();
									while($assigndatas = $get_totalcount->fetch_assoc())
									{
										echo '<tr>
											<td>'.$Sln.'</td>
											<td>'.$assigndatas['title'].'</td>
											<td>'.$assigndatas['post'].'</td>
											<td align="center"><a href="index.php?page='.$_GET['page'].'&id='.$assigndatas['id'].'"><i class="dripicons-pencil"></i></a></td>
										</tr>';
										$Sln++;
									}
									
								?>
							</tbody>
						</table>
                        <?php
                    }?>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="assets/js/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        $('#validate_form').parsley();
    });
</script>
<script>
    document.getElementById('zip').addEventListener('input', function (e) {
        e.target.value = e.target.value.replace(/[^\dA-Z]/g, '').replace(/(.{3})/g, '$1 ').trim();
    });
</script>