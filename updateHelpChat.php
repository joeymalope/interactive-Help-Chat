<?php
require "config.php";
/*load conversation between client and consultant*/
function loadConversation(){
$conn=$_SESSION["conn"];
    if(isset($_POST["staff_id"]) && isset($_POST["name"])){
        if(!empty($_POST["name"]))
        {
        $sql="SELECT user,b.answer,a.query,a.staff_id,a.qid,user_ FROM pendingqueriestbl a inner join replytbl b on a.qid = b.qid where a.staff_id=".$_POST["staff_id"]." AND a.user='".$_POST["name"]."'";    

            if($result = mysqli_query($conn,$sql)){ 
                if (mysqli_num_rows($result)> 0) {
                   echo " <ul class='list-group'>";
                    while($row = mysqli_fetch_assoc($result)) {
                            
                     		echo "<li class='none'>";
                            echo "<div class='triangle-isosceles right border-none'>";
                            echo "<span class='bold float-right' style='color:#000;margin-right:2px'>".$row["qid"]."#</span>";
                            echo "<span class='float-left bold'><span style='color:#000;margin-right:5px'class='glyphicon glyphicon-user'> </span>".$row["user"].
                            "</span> <br />"."</span><br />".
                            $row["query"]."??";
                            echo "</div>";
						    echo "	</li>";
                            
                            echo "<li class='none tleft'>";
                            echo "<div class='triangle-isosceles left border-none green'>";
                            echo "<span class='bold'>".$row["qid"]."#</span>";
                            echo "<span class='float-right bold'><span style='color:#000;margin-right:2px'class='glyphicon glyphicon-user'> </span>".$row["user_"].
                            "</span> <br />"."</span><br />".
                            $row["answer"];
                            echo "</div>";
						    echo "	</li>";       
                    }
                    echo "</ul>";
                }
            }
        }
    }
}
loadConversation();
?>
