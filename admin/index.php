<?

include_once 'inc/connexion.php';

if (isset($_GET["logout"])) {
    if (isset($_GET['admin'])) {
        $id_user = $_GET['admin'];
        $sql = 'UPDATE q3_admin SET logged_in = 0 WHERE id= "' . $id_user . '"';
        mysql_query($sql) or die(mysql_error());
    }
    
    session_start();
    session_unset();
    session_destroy();
}

$msg_erreur = '';
$msg_success = '';



//# validation formulaire de connexion
if (isset($_POST['submit'])) {
    if (!isset($_POST['username']) or strlen($_POST['username']) == 0)
        $msg_erreur = 'Mauvais login / mot de passe, merci d\'essayer à nouveau';
    elseif (!isset($_POST['password']) or strlen($_POST['password']) == 0)
        $msg_erreur = 'Mauvais login / mot de passe, merci d\'essayer à nouveau';
    else {
        //# vérification si compte administrateur
        $sql = "SELECT * FROM q3_admin WHERE login='" . mysql_real_escape_string($_POST['username']) . "' and password='" . mysql_real_escape_string($_POST['password']). "'" ;
        $req = mysql_query($sql) or die(mysql_error());
        $num_admin = mysql_num_rows($req);
         
        if ($num_admin == 1) {
            $res = mysql_fetch_array($req);
         //  echo'<pre>'; print_r($res);die();
            session_start();
           header('location:liste_des_contacts.php');
            exit();
        }
        $msg_erreur = 'Mauvais login / mot de passe, merci d\'essayer à nouveau';
    }
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title> Interface Administration</title>
        <link rel="stylesheet" media="screen" href="css/style.css" />
        <!--[if IE 9]>
            <link rel="stylesheet" media="screen" href="css/ie9.css"/>
        <![endif]-->
        <!--[if IE 8]>
            <link rel="stylesheet" media="screen" href="css/ie8.css"/>
        <![endif]-->
        <!--[if IE 7]>
            <link rel="stylesheet" media="screen" href="css/ie7.css"/>
        <![endif]-->
        <style type="text/css">
            label {
                vertical-align: middle; 
                padding: 0 0 0 2px;
            }
            #div_mot_passe_oublie {
                display: none;
            }
            #div_mot_passe_oublie .mail {
                margin: 0 10px;
                padding: 3px; 
                width: 200px; 
                border: 1px solid gray;
            }
            #div_mot_passe_oublie .submit_input {
                cursor: pointer;
                height: 23px;
                padding: 0 7px;
                vertical-align: middle;
            }
            .q3_brand_container { 
                margin-top: 40px;
                text-align: center;
            }
        </style>
        <script type="text/javascript" src="js/plugins/jquery-1.7.min.js"></script>
        <script type="text/javascript" src="js/custom/general.js"></script>
        <script type="text/javascript">
            jQuery(document).ready(function(){
                jQuery("#lien_mot_passe_oublie").click(function (e) {
                    e.preventDefault();
                    if (jQuery("#div_mot_passe_oublie").is(":hidden")) {
                        jQuery("#div_mot_passe_oublie").slideDown("normal");
                    } else {
                        jQuery("#div_mot_passe_oublie").hide();
                    }
                });
            });
        </script>
    </head>
    <body>
        <div class="loginlogo">
            <a href="https://www.facebook.com/changer.bizerte">
            <img src="images/logo14.jpg" alt="Logo" />
            </a>
        </div>
        <? if (!empty($msg_success)) { ?>
            <div class="notification notifySuccess loginNotify">
                <?php echo($msg_success); ?>
            </div>
        <? } ?>
        <? if (!empty($msg_erreur)) { ?>
            <div class="notification notifyError loginNotify">
                <?php echo($msg_erreur); ?>
            </div>
        <? } ?>
        <div class="loginbox">
            <div class="loginbox_inner">
                <div class="loginbox_content">
                    <form id="loginform" action="index.php" method="post">
                        <input type="text" name="username" class="username" placeholder="Nom d'utilisateur" />
                        <input type="password" name="password" class="password" placeholder="Mot de passe" />
                        <button name="submit" class="submit">Login</button>
                    </form>
                </div>
            </div>
        </div>
    
       
        <div class="q3_brand_container">
            <a href="https://www.facebook.com/pages/BM-Web-Creation/251598055005310">
                <img src="images/logo2.jpg"  width="100"/>
            </a>
        </div>
    </body>
</html>
