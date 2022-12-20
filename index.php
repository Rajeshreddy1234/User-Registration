<?php
	include("includes/config.php");
	if(!$_SESSION['id'])
		header("Location:login.php");
	$get_data = $dbcon->prepare("SELECT * FROM users WHERE id=?");
	$get_data->bind_param("i", $_SESSION['id']);
	$get_data->execute();
	$result = $get_data->get_result();
	$user_data = $result->fetch_assoc();
    $image = mysqli_fetch_assoc(mysqli_query($dbcon, "SELECT * FROM users WHERE id='".$_SESSION['id']."'"));
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title> myHCMS </title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta content="Nex Title" name="description" />
        <meta content="Nex Title" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <link rel="shortcut icon" href="assets/images/favicon.ico">
          <link href="plugins/daterangepicker/daterangepicker.css" rel="stylesheet" />
        <link href="plugins/select2/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.css" rel="stylesheet" type="text/css" />
        <link href="plugins/timepicker/bootstrap-material-datetimepicker.css" rel="stylesheet">
        <link href="plugins/bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css" rel="stylesheet" />

		<link href="plugins/dropify/css/dropify.min.css" rel="stylesheet">
        <!-- jvectormap -->
		<link rel="stylesheet" href="plugins/jquery-steps/jquery.steps.css">
        <link href="plugins/jvectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet">
        <link href="plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" /> 
        <!-- App css -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/jquery-ui.min.css" rel="stylesheet">
        <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/metisMenu.min.css" rel="stylesheet" type="text/css" />
       
        <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" />
        <style>
        .heart {
            color: #EB5E28;
            -webkit-animation: hearthing 1s ease infinite;
            animation: hearthing 1s ease infinite;
        }
        </style>
    </head>
    <body>
        
		<div class="leftbar-tab-menu">
            <div class="main-icon-menu">
                <a href="index.php" class="logo logo-metrica d-block text-center">
                </a>
                <nav class="nav">
                    <a href="#MetricsAdminSettings" class="nav-link <?php if($_GET['page'] == "view_profile" || $_GET['page'] == "child" || $_GET['page'] == "calendar" || $_GET['page'] == "attachements") echo 'active'; ?>" data-toggle="tooltip-custom" data-placement="right" title="" data-original-title="Settings" data-trigger="hover">
                        <i data-feather="settings" class="align-self-center menu-icon icon-dual"></i>
                    </a>
                </nav>
            </div>
            <div class="main-menu-inner">
                <div class="topbar-left">
                    <a href="index.php" class="logo">
                       <h3>myHCMS</h3>
                    </a>
                </div>
                <div class="menu-body slimscroll">
                    <div id="MetricsAdminSettings" class="main-icon-menu-pane <?php if($_GET['page'] == "view_profile" || $_GET['page'] == "articles") echo 'active'; ?>" >
                        <div class="title-box">
                        <h6 class="menu-title"> Settings </h6>
                        </div>
                        <ul class="nav metismenu"> 
                            <li class="nav-item"><a class="nav-link <?php if($_GET['page'] == "view_profile") echo 'active' ;?>" href="index.php?page=view_profile"> Profile </a></li>
                            <li class="nav-item"><a class="nav-link <?php if($_GET['page'] == "articles") echo 'active' ;?>" href="index.php?page=articles"> Articles </a></li>
                        </ul>
                    </div>
            </div>
        </div>
         <div class="topbar">
            <nav class="navbar-custom">    
                <ul class="list-unstyled topbar-nav float-right mb-0"> 
                    <li class="dropdown">
                        <a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-toggle="dropdown" href="#" role="button"
                            aria-haspopup="false" aria-expanded="false">
                            
                            <span class="ml-1 nav-user-name hidden-sm"> <img src="data:<?php echo $image['imagetype'];?>;base64,<?php echo base64_encode($image['image']); ?>" class="rounded-circle " /> <i class="mdi mdi-chevron-down"></i> </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="logout.php"><i class="dripicons-exit text-muted mr-2"></i> Logout </a>
                        </div>
                    </li>
                </ul>
            </nav>
        </div>
        <!-- Top Bar End -->

        <div class="page-wrapper">
            <div class="page-content-tab">
				<?php
					$pagename = '';
                    $pageget= $_GET['page'];
                    $replace= str_replace("_"," ","$pageget");
					if(!isset($_GET['subpage']))
						$_GET['subpage'] = '';
					
					if(@$_GET['page'] && !$_GET['subpage'])
						include('includes/'.$_GET['page'].'.php');
					else if(@$_GET['page'] && $_GET['subpage'])
						include('includes/'.$_GET['subpage'].'.php');
					else
                    if($_SESSION['user_type_id'] == 1) {
                        include('includes/dashboard_patient.php');
                    }
                    else if($_SESSION['user_type_id'] == 2) {
                        include('includes/dashboard_home_visit_doctor.php');
                    }
                    else if($_SESSION['user_type_id'] == 3) {
                        include('includes/dashboard_clinic_visit_doctor.php');
                    }
                    else if ($_SESSION['user_type_id'] == 4) {
                        include('includes/dashboard_admin.php');
                    }
                    else if ($_SESSION['user_type_id'] == 5) {
                        include('includes/dashboard_ambulance.php');
                    }
                    else if ($_SESSION['user_type_id'] == 6) {
                        include('includes/dashboard_pharmacy.php');
                    }
                    else if ($_SESSION['user_type_id'] == 7) {
                        include('includes/dashboard_nurse.php');
                    }
                    else if ($_SESSION['user_type_id'] == 8) {
                        include('includes/dashboard_technician.php');
                    }
                    else if ($_SESSION['user_type_id'] == 9) {
                        include('includes/dashboard_receptionist.php');
                    }
                    else if ($_SESSION['user_type_id'] == 10) {
                        include('includes/dashboard_accountant.php');
                    }
                    else if ($_SESSION['user_type_id'] == 11) {
                        include('includes/dashboard_insurance.php');
                    }
                        
				?>

                <footer class="footer text-center text-sm-left">
                    <div class="boxed-footer">
                        &copy; <?php echo date("Y");?> myHCMS <span class="text-muted d-none d-sm-inline-block float-right"> Maintained by <a href="#" target="blank"> G Bhargav </a></span>
                   </div>                    
                </footer>
               
            </div>
            <!-- end page content -->
        </div>
        <!-- end page-wrapper -->
        <!-- jQuery  -->
        
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/jquery-ui.min.js"></script>
        <script src="assets/js/bootstrap.bundle.min.js"></script>
        <script src="assets/js/metismenu.min.js"></script>
        <script src="assets/js/waves.js"></script>
        <script src="assets/js/feather.min.js"></script>
        <script src="assets/js/jquery.slimscroll.min.js"></script> 
        <script src="plugins/apexcharts/apexcharts.min.js"></script>
         
        <script src="plugins/jvectormap/jquery-jvectormap-2.0.2.min.js"></script>
        <script src="plugins/jvectormap/jquery-jvectormap-us-aea-en.js"></script>
        
        <script src="assets/pages/jquery.analytics_dashboard.init.js"></script>
        <!-- App js -->
		 <!-- Parsley js -->
        <script src="plugins/parsleyjs/parsley.min.js"></script>
        <script src="assets/pages/jquery.validation.init.js"></script>
         <!-- Required datatable js -->
        <script src="plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="plugins/datatables/dataTables.bootstrap4.min.js"></script>
        <!-- Buttons examples -->
        <script src="plugins/datatables/dataTables.buttons.min.js"></script>
        <script src="plugins/datatables/buttons.bootstrap4.min.js"></script>
        <script src="plugins/datatables/jszip.min.js"></script>
        <script src="plugins/datatables/pdfmake.min.js"></script>
        <script src="plugins/datatables/vfs_fonts.js"></script>
        <script src="plugins/datatables/buttons.html5.min.js"></script>
        <script src="plugins/datatables/buttons.print.min.js"></script>
        <script src="plugins/datatables/buttons.colVis.min.js"></script>
        <!-- Responsive examples -->
        <script src="plugins/datatables/dataTables.responsive.min.js"></script>
        <script src="plugins/datatables/responsive.bootstrap4.min.js"></script>
       <!--  <script src="assets/pages/jquery.datatable.init.js"></script> -->
		<script src="plugins/dropify/js/dropify.min.js"></script>
        <script src="assets/pages/jquery.form-upload.init.js"></script>
        <!-- App js -->
        <script src="plugins/moment/moment.js"></script>
        <script src="plugins/daterangepicker/daterangepicker.js"></script>
        <script src="plugins/select2/select2.min.js"></script>
        <script src="plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
        <script src="plugins/timepicker/bootstrap-material-datetimepicker.js"></script>
        <script src="plugins/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>
		<script src="plugins/jquery-steps/jquery.steps.min.js"></script>
        <script src="assets/pages/jquery.form-wizard.init.js"></script>
		<script src="plugins/repeater/jquery.repeater.min.js"></script>
        <script src="assets/pages/jquery.form-repeater.js"></script>
        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/app.js"></script>
        <script src="assets/pages/jquery.forms-advanced.js"></script>
        <script>
			function Ajax(Type, URL, URLData)
			{
				var Responses = "";
				$.ajax(
				{
					type: Type,
					async: false,
					cache: false,
					url: URL,
					data: URLData,
					dataType: 'html',
					success:function(result, Response, jqXHR)
					{
						Responses = result;
					}
				});
				return Responses;
			}
			$(document).ready(function() {
				$('#datatable').DataTable();
				$('#datatable2').DataTable();

  //Buttons examples
  var table = $('#datatable-buttons').DataTable({

      lengthChange: false,
       buttons: [

            {
                extend: 'copy',
                
            },
            
            {
                extend: 'excel',
                title: '<?php echo ucwords($replace);?>'
            },
            {
                extend: 'pdf',
                title: '<?php echo ucwords($replace);?>'
            },
             {
               extend: 'colvis',
                
            },
           
           
        ]
      
  });

  table.buttons().container()
      .appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');

      $('#row_callback').DataTable( {
        "createdRow": function ( row, data, index ) {
            if ( data[5].replace(/[\$,]/g, '') * 1 > 150000 ) {
                $('td', row).eq(5).addClass('highlight');
            }
        }
    } );
    
} );

/* Formatting function for row details - modify as you need */
function format ( d ) {
    // `d` is the original data object for the row
    return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
        '<tr>'+
            '<td>Full name:</td>'+
            '<td>'+d.name+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Extension number:</td>'+
            '<td>'+d.extn+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Extra info:</td>'+
            '<td>And any further details here (images etc)...</td>'+
        '</tr>'+
    '</table>';
}
 
$(document).ready(function() {
    var table = $('#child_rows').DataTable( {
        // "ajax": "../../plugins/datatables/objects.txt",
        "data": testdata.data,
        select:"single",
        "columns": [
            {
                "className":      'details-control',
                "orderable":      false,
                "data":           null,
                "defaultContent": ''
            },
            { "data": "name" },
            { "data": "position" },
            { "data": "office" },
            { "data": "salary" }
        ],
        "order": [[1, 'asc']]
    } );
     
    // Add event listener for opening and closing details
    $('#child_rows tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = table.row( tr );
 
        if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            // Open this row
            row.child( format(row.data()) ).show();
            tr.addClass('shown');
        }
    } );
} );

var testdata = {
    "data": [
    {
    "name": "Tiger Nixon",
    "position": "System Architect",
    "salary": "$320,800",
    "start_date": "2011/04/25",
    "office": "Edinburgh",
    "extn": "5421"
    },
    {
    "name": "Garrett Winters",
    "position": "Accountant",
    "salary": "$170,750",
    "start_date": "2011/07/25",
    "office": "Tokyo",
    "extn": "8422"
    },
    {
    "name": "Ashton Cox",
    "position": "Junior Technical Author",
    "salary": "$86,000",
    "start_date": "2009/01/12",
    "office": "San Francisco",
    "extn": "1562"
    },]}
</script>
    </body>
</html>