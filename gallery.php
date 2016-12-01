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
		echo "<td>".$row['postname']."<form method='post' action='".str_replace( '%7E', '~', $_SERVER['REQUEST_URI'])."'><input type='text' name='gal' value='".$row['postname']."' hidden='true'></td>";
		echo "<td><input type='submit' value='Update' name='Update'></form></td>";
		$name = mysqli_fetch_assoc(mysqli_query($link,'select * from pics where postname="'.$row["postname"].'" and first="yes";'));
	echo "<td>".get_permalink($name['caption'])."</td>";
		echo "</tr>";
}




//table ends
echo "</table>";

if(isset($_POST['gal']))
{
	$post = $_POST['gal'];
	
	
					//retrieving the gallery
				$query = "select * from pics where postname='".$post."';";
				$queryresult = mysqli_query($link,$query);
				$query2 = "select * from pics where postname='".$post."';";
				$queryresult2 = mysqli_query($link,$query2);
				$query3 = "select * from pics where postname='".$post."';";
				$queryresult3 = mysqli_query($link,$query3);

				//editing post
				$row3 = mysqli_fetch_assoc($queryresult3);
				$row3 = mysqli_fetch_assoc($queryresult3);
				$row2 = mysqli_fetch_assoc($queryresult2);
				
				
				
				$ctr=1;
				while(1)
				{
					$row = mysqli_fetch_assoc($queryresult);
					$row2 = mysqli_fetch_assoc($queryresult2);
					$row3 = mysqli_fetch_assoc($queryresult3);
					if($ctr==1 && $row && $row2)
					{
						$my_post = array('ID'=> $row['caption'],'post_content' => '<a href="'.get_permalink($row2['caption']).'">NEXT</a>',);
						wp_update_post( $my_post );
						$id = $row['caption'];
						mysqli_query($link,'update pics set first="yes" where caption="'.$id.'";');
						$ctr=$ctr+1;
					}
					if($row && $row2 && $row3)
					{
						$my_post = array('ID'=> $row2['caption'],
						'post_content' => '<a href="'.get_permalink($row['caption']).'">BACK</a><t><a href="'.get_permalink($row3['caption']).'">NEXT</a>',);
						wp_update_post( $my_post );
					}
					else
					if($row && $row2 && $row3['caption'] == null)
					{
						$my_post = array('ID'=> $row2['caption'],
						'post_content' => '<a href="'.get_permalink($row['caption']).'">BACK</a>',);
						wp_update_post( $my_post );
					}
					if($row==null)
						break;
					
				}
					
	
	
	
	
}

?>