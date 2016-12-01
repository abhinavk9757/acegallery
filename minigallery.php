<?php
//include the database link file
include "link.php";

//query to take in all the gallery names
$query ="select distinct postname from pics;";
$queryresult = mysqli_query($link,$query);

//table starts

echo "<table border='0'>";

//1st row of table showing the heading --subsequent rows to be generated in loop
echo "<tr><th>Gallery Name</th></tr>";

//displaying the table of galleries created with view & caption buttons
while(($row=mysqli_fetch_assoc($queryresult)))
{
	echo "<tr>";
		echo "<td>".$row['postname']."<form method='post' action='".str_replace( '%7E', '~', $_SERVER['REQUEST_URI'])."'><input type='text' name='mgal' value='".$row['postname']."' hidden='true'></td>";
		echo "<td><input type='submit' value='Update' name='Update'></form></td>";
		$name = mysqli_fetch_assoc(mysqli_query($link,'select * from pics where postname="'.$row["postname"].'" and first="yes";'));
	echo "<td>".get_permalink($name['caption'])."</td>";
		echo "</tr>";
}




//table ends
echo "</table>";

if(isset($_POST['mgal']))
{
		//$tab stores the gallery
		$query ="select * from pics where postname='".$_POST['mgal']."';";
		$result = mysqli_query($link,$query);
		$ctr =1;
		$tab = "<table border='0'> <tr>";
		while(($row=mysqli_fetch_assoc($result)))
			{
				$tab =  $tab."<td><a href='".get_permalink($row['caption'])."'>".get_the_post_thumbnail($row['caption'],'thumbnail')."<br>".get_post_field('post_title',$row['caption'])."</a>";
				if($ctr%4==0)
				$tab= $tab."</tr><tr>";
	
				$ctr++;
			}
		$tab= $tab."</tr></table>";
	
		
		//adding the mini gallery into each post
		$result2 = mysqli_query($link,$query);
		
		while(($row=mysqli_fetch_assoc($result2)))
			{
				$content = get_post_field('post_content',$row['caption']);
				$my_post = array('ID'=> $row['caption'],'post_content' => $content."<br><br>".$tab,);
				wp_update_post( $my_post );
			}
}
?>