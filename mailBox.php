<?php 
if(isset($_POST["query"]) && isset($_POST["name"])){
    if(trim($_POST["query"])!=="" && trim($_POST["name"])!=="" ){
        require "config.php";    

        $name=mysqli_real_escape_string($conn,trim($_POST["name"]));

        $staff_id=$_POST["staff_id"];
        $query=mysqli_real_escape_string($conn,$_POST["query"]);   
        $insert="INSERT INTO pendingqueriestbl (user,staff_id,query) VALUES ('$name',$staff_id,'$query')";
        if(mysqli_query($conn,$insert))
            echo "<div classs='alert alert-success'>Query successfully sent</div>";
        else 
            echo "error ".mysqli_error($conn);    


        $retrieve="SELECT * FROM pendingqueriestbl";
        if($result=mysqli_query($conn,$retrieve))
            echo "successful<br />";
        else echo "error ".mysqli_error($conn);    

        echo "<br />num rows ==".mysqli_num_rows($result);
        }
    else 
        echo "atleast u tried<br />";
}
else echo"didnt even go in (thats what she said)<br />";
?>