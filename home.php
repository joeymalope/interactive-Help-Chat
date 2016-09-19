<!DOCTYPE html>
<?php 
	header( 'Cache-Control: no-store, no-cache, must-revalidate' ); 
	header( 'Cache-Control: post-check=0, pre-check=0', false ); 
	header( 'Pragma: no-cache' );
    
	session_start();
	require "config.php";
    
	if ((isset($_POST["reply"]) && !empty($_POST["reply"]) ) && (isset($_POST["qid"]) && !empty($_POST["qid"]))){
    $conn=$_SESSION["conn"];
    $reply=mysqli_real_escape_string($conn,trim($_POST["reply"]));
	$qid=$_POST["qid"];
    $staff_id=$_SESSION['staff_id'];    
    $currentUser=$_SESSION["currentUser"];  

	if (!$conn)
		die("Connection failed: " . mysqli_connect_error());
    if(isset($staff_id) ){
        $sql= "select * from helpdesktbl where staff_id=".$staff_id;
        if($result=mysqli_query($conn,$sql)){
            $row = mysqli_fetch_assoc($result);
            $name= $row["name"];
		 }
		 else { 
		 	echo "<h3>Error match not found!! ".mysqli_error($conn)."</h3>";
//		 	unset($_POST);
		 }    
        
        
	   $sql="INSERT INTO replytbl (user_,staff_id,qid,answer)"
		  ."VALUES ('$name',$staff_id,$qid,'$reply')";
		 if(mysqli_query($conn,$sql)){
		 	unset($_POST);
		 }


        $update="update pendingqueriestbl set replied=true where qid='$qid'";
        if(mysqli_query($conn,$update)){
		 	unset($_POST);
		 }
		 else { 
		 	echo "<h3>Error updating!! ".mysqli_error($conn)."</h3>";
		 	unset($_POST);
		 }
	 }    
        
    }

                    function loadPendingQueries(){
                    $conn=$_SESSION["conn"];   
                    $sql="SELECT p.* FROM pendingqueriestbl p inner join helpdesktbl h on p.staff_id = h.staff_id where p.staff_id = h.staff_id AND p.staff_id=".$_SESSION['staff_id']." AND replied=false Order by qid asc";
                        if($result = mysqli_query($conn,$sql)){ 
										if (mysqli_num_rows($result)> 0) {
											echo " <ul class='list-group'>";
										    while($row = mysqli_fetch_assoc($result)) {
										    		echo "<li class='none '>";
                                                    echo "<div class='triangle-isosceles right border-none tleft'>";
                                                    echo "<span class='bold float-left'>".$row["qid"]."#</span>";
                                                    echo "<span class='float-right bold'><span style='color:#000;margin-right:5px'class='glyphicon glyphicon-user'> </span>".$row["user"].
                                                        "</span> <br />"."</span><br />".
                                                        $row["query"]."??";
                                                    echo "</div>";
										  		 	echo "	</li>";
										    }
											echo "</ul>";
										}
                                        else  
                                            echo "<h3 class='alert alert-success'> YOU HAVE NO PENDING QUERIES </h3>";
                                        
                        }
                    }
                function loadOptions(){
                    $conn=$_SESSION["conn"];   
                    $sql="SELECT p.* FROM pendingqueriestbl p inner join helpdesktbl h on p.staff_id = h.staff_id where p.staff_id = h.staff_id AND p.staff_id=".$_SESSION['staff_id']." AND replied=false Order by qid desc";
                        if($result = mysqli_query($conn,$sql)){ 
										if (mysqli_num_rows($result)> 0) {
											echo "<div class='form-group'> <select  name='qid' class='form-control col-xs-3' form='reply'>";
										    while($row = mysqli_fetch_assoc($result)) {
                                                    echo "<option value='".$row["qid"]."'>".$row["qid"]."</option>";
										    }
										  echo "	</select>";
										}
   
                        }
                    }
	
?>
<html>	
	<head> 
		<meta name="author"  content="Pappi Malope">
		<title>
			
		</title>
		<meta charset="UTF-8" />
		<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
		<meta name="viewport" content="width=device-width, initial-scale=1">
        		<link rel="stylesheet" type="text/css" href="styles/speechBubble.css">
		<link rel="stylesheet" type="text/css" href="styles/styles.css">
		<script src="bootstrap/js/jquery-2.1.3.min.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>
        <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip(); 
        });
           // location.reload(true); 
        </script>
	</head>
	<body>
		<div class="container-fluid">
            <div class="col-md-10 col-md-offset-1">
                <ul class="nav navbar-nav" style="color:white;">
                          <li ><a href="#">About Us</a></li>
                          <li><a href="#"><span class="glyphicon glyphicon-calendar"></span> Book Online</a></li>
                          <li><a href="#"><span class="glyphicon glyphicon-search"></span> Find a Store</a></li> 
                          <li><a href="#"><span class="glyphicon glyphicon-comment"></span> Contact us</a></li> 
                          <li><a href="#"><span class="glyphicon glyphicon-home"></span> Franchise</a></li> 
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                          <li><a href="#"><span class="glyphicon glyphicon-question-sign"></span> Help</a></li>
                          <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                        </ul>
            </div>

			<div class="box">
                <div class="row">
                    <div class="col-md-12">
                            <div class="form col-md-6 col-md-offset-3"> 
                                <form action="home.php" method="post" id="reply">
                                    <div class="form-group">
                                        <span> </span>    <input type="text" class="form-control" name="reply" placeholder="Type reply here" require />    
                                    </div>				
                                    <div class="form-group" data-toggle="" data-placement="bottom" title="Enter index of query you would like to reply">
                                        <?php loadOptions(); ?>
                                    </div>		    
                                    <br />
                                    <div class="form-group">
                                        <br />
                                        <button type="submit" name="submit" class="btn btn-default" id="submitQ">
                                            <span class="glyphicon glyphicon-send"></span> Send reply
                                        </button>
                                    </div>
                                </form>    
                            </div>    
                    </div>
                </div>
				<div class="ads row col-md-6 col-md-offset-3 col-xs-12">
				<?php	
                    loadPendingQueries();
                ?>
				</div>
			</div>	
		</div>
	</body>
</html>