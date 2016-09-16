<?php
include_once 'connexion.php';
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */if (isset($_POST['submit'])) {
  $sql_insert_user = 'INSERT INTO personne (nom, prenom, cin) VALUES("' . $_POST["nom"] . '","' . $_POST["prenom"] . '","' . $_POST["cin"] . '") ';
        mysql_query($sql_insert_user) or die(mysql_error());
        $message_succes="Merci pour votre aide !! ";
 }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        	<link rel="stylesheet" href="style.css" />
        <title>C'est à vous de changer Bizerte</title>
         </head>
      <script type="text/javascript" src="jquery-1.7.min.js"></script>
    <script type="text/javascript">
        function delette(){
            $("#message-succes").hide();
        }
    </script>
    <body>
        <center>
            <img src="banner.jpg" />
            <br /><br /> <br />
				
        <img src='image.png' />
        <br /> <br />
        </center>
        <? if(!empty($message_succes)){ ?>
       
       <div id="message-succes" class="g_12"><div class="success iDialog " onclick="delette()"><?= $message_succes; ?></div></div>
        <?}?>
       <form action="" method="post">
				<div class="g_12">
					<div class="widget_header">
						<h4 class="widget_header_title wwIcon i_16_valid" style="color: #3F3838">Svp remplir les champs</h4>
					</div>
					<div class="widget_contents noPadding">
						
							<div class="line_grid">
								<div class="g_3"><span class="label" style="color: #3F3838">Nom <span class="must">*</span></span></div>
								<div class="g_9">
									<input type="text" placeholder="Ben Hammed" name="nom" class="simple_field" required />
								</div>
							</div>
                                                     <div class="line_grid">
								<div class="g_3"><span class="label" style="color: #3F3838">Prénom<span class="must">*</span></span></div>
								<div class="g_9">
									<input type="text" placeholder="Bechir" name="prenom" class="simple_field" required />
								</div>
							</div>
                                                    <div class="line_grid">
								<div class="g_3"><span class="label" style="color: #3F3838">Cin <span class="must">*</span></span></div>
								<div class="g_9">
									<input type="text" placeholder="12345678" name="cin" class="simple_field" required />
								</div>
							</div>
							<div class="line_grid">
								<div class="g_3"></div>
								<div class="g_9" style="color: #332B2B">
									<input type="submit" value="Valider" name="submit" class="submitIt simple_buttons" style="color: #332B2B"/>
								</div>
							</div>
						
					</div>
				</div>
            </form>
        <br />
        <br />
        <br />
        <div id="footer">
			<p>Copyright © 2013 <a href="https://www.facebook.com/pages/BM-Web-Creation/251598055005310" style="color:#ffffff">B&M Web Creation</a>. All Rights Reserved.</p>
		</div>
    </body>
</html>
