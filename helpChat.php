<!DOCTYPE html>
<html>	
<head>
	<meta name="author"  content="Pappi Malope">
	<title>
		
	</title>
	<meta charset="UTF-8" />
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="styles/styles.css">
	<link rel="stylesheet" type="text/css" href="styles/speechBubbles.css">
	<script src="bootstrap/js/jquery-2.1.3.min.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/helpChat.js">

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

		<div class="row" id="messages">
			<div class="col-md-12">
            <!--    <form action="" id="myform" method="post"> -->
                    <div class="form col-md-6 col-md-offset-3"> 
                        <div class="form-group">
                            <label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="ENTER NAME HERE" required/>
                            </label>   
                        </div>				
                        <div class="form-group">
                            <textarea name="query" resize="none" class="form-control" id="query" placeholder="Enter Help Query" required>Enter Help Query </textarea>
                        </div>	
                        <div class="form-group">  
                            <?php
                                require "config.php";
                                $sql="select * from helpdesktbl";
                                $result=mysqli_query($_SESSION["conn"],$sql); 
                               if(mysqli_num_rows($result) > 0) {
                                        while($row = mysqli_fetch_assoc($result)) {
                                            $staff_id=$row["staff_id"];
                                    echo "<label>";
                                    echo  "<span> ".$row['name']."</span>";
                                    if($row['status']==false)        
                                        echo "<input type='radio' class='red' name='staff' value=".$row['staff_id']." required/></label>";  
                                }                                 
                            }
                            ?>    
                        </div>	    
                        <div class="form-group">
                            <button type="submit" name="submit" class="btn btn-default" id="submitQ">
                                <span class="glyphicon glyphicon-send"></span> Send Query
                            </button>
                        </div>
                    </div>    
          		<div class="chatarea col-md-6 col-md-offset-3 col-xs-12">
                  
				</div>
			</div>
		</div>
	</div>	
</body>
</html>