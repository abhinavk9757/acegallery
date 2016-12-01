<div class="wrap">
    <?php    echo "<h2>" . __( 'Ace Gallery', 'ace_trdom' ) . "</h2>"; ?>
     
    <form name="ace_form" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
        <input type="hidden" name="ace_hidden" value="Y">
        <?php    echo "<h4>" . __( 'Ace Gallery Database Settings', 'ace_trdom' ) . "</h4>"; ?>
        <p><?php _e("Database host: " ); ?><input type="text" name="ace_dbhost" value="<?php echo $dbhost; ?>" size="20"><?php _e(" ex: localhost" ); ?></p>
        <p><?php _e("Database name: " ); ?><input type="text" name="ace_dbname" value="<?php echo $dbname; ?>" size="20"><?php _e(" ex: wordpress" ); ?></p>
        <p><?php _e("Database user: " ); ?><input type="text" name="ace_dbuser" value="<?php echo $dbuser; ?>" size="20"><?php _e(" ex: root" ); ?></p>
        <p><?php _e("Database password: " ); ?><input type="text" name="ace_dbpwd" value="<?php echo $dbpwd; ?>" size="20"><?php _e(" ex: secretpassword" ); ?></p>
        <hr />
     
        <p class="submit">
        <input type="submit" name="Submit" value="<?php _e('Update Options', 'ace_trdom' ) ?>" />
        </p>
    </form>
</div>

<?php

	if(isset($_POST['Submit']))
	{
		$uid = $_POST['ace_dbuser'];
		$pwd = $_POST['ace_dbpwd'];
		$host = $_POST['ace_dbhost'];
		$database = $_POST['ace_dbname'];
		
		$link = mysqli_connect($host,$uid,$pwd) or die("Couldnt Connect to MYSQL Database. <br>Hostname or Username or Password maybe wrong.");
		if($link)
		{
				if(!mysqli_select_db($link,$database))
					echo "No Database as such.";
				else
				{
					$a = '$';
					mysqli_query($link," CREATE TABLE `pics` ( `postname` tinytext,`address` text,`caption` text,`first` tinytext)");
					mkdir($_SERVER['DOCUMENT_ROOT']."/attachment/".$_POST["postname"],0777,TRUE);
					$data = "<?php
								
								$a"."link = mysqli_connect('$host','$uid','$pwd');
								if (!$a"."link) 
								{
									die('Could not connect: ' . mysqli_error"."());
								}
	
								mysqli_select_db"."($a"."link,'$database');
								?>";
					file_put_contents("link.php",$data);
					echo "Everything seems Correct";
					
				}
		}
	}

?>