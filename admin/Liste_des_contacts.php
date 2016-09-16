<?
include_once 'inc/connexion.php';
include_once 'inc/session.php';

//# id du droit utilisateur qui permet d'accéder à cete page 
$_droit_acces_page = 4;
include("inc/verifier_droit.php");

$current = 4;


if (isset($_GET['supp'])) {
    $id_user = $_GET['supp'];
    //# vérifier si cet client existe
    $sql_verif = 'SELECT id FROM personne WHERE id = "' . $id_user . '" ';
    $req_verif = mysql_query($sql_verif) or die(mysql_error());
    if (mysql_num_rows($req_verif) == 0) {
        header("location:Liste_des_contacts.php");
        exit();
    }
//# suppression de client
    $sql_delete_user = 'DELETE FROM personne WHERE id = ' . $_GET['supp'];
    mysql_query($sql_delete_user) or die(mysql_error());

}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Interface Administration</title>
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
        <script type="text/javascript" src="js/plugins/jquery-1.7.min.js"></script>
        <script type="text/javascript" src="js/plugins/jquery-ui-1.8.16.custom.min.js"></script>
        <script type="text/javascript" src="js/plugins/jquery.validate.min.js"></script>
        <script type="text/javascript" src="js/plugins/jquery.colorbox-min.js"></script>
        <script type="text/javascript" src="js/plugins/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="js/plugins/jquery.alerts.js"></script>
        <script type="text/javascript" src="js/custom/general.js"></script>
        <script type="text/javascript" src="js/plugins/jquery.flot.min.js"></script>
        <script type="text/javascript">
            jQuery(document).ready(function() {
                jQuery('#datatable').dataTable( {
                    "bAutoWidth": false,
                    "oLanguage": {
                        "sUrl": "js/plugins/dataTables.french.txt"
                    },
                    "aoColumnDefs": [{ 
                            "bSortable": false, "aTargets": [ 4  ] 
                        }] ,
                    "sPaginationType": "full_numbers"
                });
                jQuery('.lien-suppression').click(function(e){
                    e.preventDefault();
                    var targetUrl = jQuery(this).attr("href");
                    var user = jQuery(this).attr("name");
                    jQuery.alerts.okButton = "Valider";
                    jQuery.alerts.cancelButton = "Annuler";
                    jConfirm("Vous êtes sur le point de supprimer l’utilisateur <b>"+ user +"</b>, cette action est définitive.", 'Attention !', 
                    function(r) {
                        if (r == true) {
                            jQuery(location).attr('href',targetUrl);
                        }
                    });
                });
                 jQuery('#envoyer-mail').click(function(e) {
                    e.preventDefault();
                    var id_user = jQuery(this).attr("name");
                 
                    jQuery.ajax({
                        url: 'ajax/mail_compte_utilisateur.php',
                        type: 'POST',
                        data: {
                            id : id_user        
                        },
                        success: function(result){
                            
                            if (result == 'true') {
                                jAlert("Un mail récapitulatif vient d'être envoyé à cet utilisateur.", 'Email envoyé!');
                            }
                            if (result == 'false') {
                                jAlert("L'envoi du mail a échoué.", 'Erreur!');
                            }                  
                        }
                    });
                });
                
            });
        </script>
        <script language="javascript" type="text/javascript">
            function exporter(){
                window.open("exporter/base.csv");
            }
        </script>
    </head>
    <body class="bodygrey">
        <? include 'inc/header.php'; ?>
        <? include 'inc/menu_droite.php'; ?>
        <div class="maincontent">
            <div class="breadcrumbs">
                <a href="">Accueil</a>
                <span>Gestion des personnes</span>
            </div>
            <div class="left">
                <h1 class="pageTitle">Liste des personnes</h1>
                <div class="table-options">
                    <a class="iconlink" href="export/liste_contact.php">
                        <img class="mgright5" alt="" src="images/icons/small/white/document.png" />
                        <span>Exporter</span>
                    </a>
                </div>
                  <div class="content">
              
                <table cellpadding="0" cellspacing="0" border="0" class="dyntable" id="datatable" width="100%">
                    <thead>
                        <tr>
                            <th class="head0">N°</th>        
                            <th class="head0">Nom</th>
                            <th class="head1">Prénom</th>
                            <th class="head0">Cin</th>
                            <th class="head1">Supprimer</th>
                        </tr>
                    </thead>
                    <colgroup>
                        <col class="con0" />
                        <col class="con1" />
                        <col class="con0" />
                        <col class="con1" />
                        <col class="con0" />
                       
                    </colgroup>
                    <tbody>
                        <?
                        $sql_magasin = 'SELECT * FROM personne';
                        $req_magasin = mysql_query($sql_magasin) or die(mysql_error());
                        $i = 1;
                        while ($res = mysql_fetch_array($req_magasin)) {
                            
                            ?>
                            <tr class="gradeX ">
                                <td class="center con1"><?= $res['id'] ?></td>                       
                                <td class="center con0"><?= $res['Nom'] ?></td>
                                <td class="center con1"><?= $res['Prenom'] ?></td>
                                <td class="center con0"><?= $res['cin'] ?></td>
                                    <td class="center con1"  style="text-align: center">   <a class="iconlink lien-suppression" href="Liste_des_contacts.php?supp=<?= $res["id"] ?>" name="<?= $res["Nom"] . ' ' . $res["Prenom"] ?>">
                                               <img alt="" src="images/icons/small/white/close.png" />
                                            </a></td>
                            </tr> 
                            <?
                        }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                           <th class="head0">N°</th>        
                            <th class="head0">Nom</th>
                            <th class="head1">Prénom</th>
                            <th class="head0">Cin</th>
                            <th class="head1">Supprimer</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            </div>
            <br clear="all" />
        </div>
        <? include 'inc/copyright.php'; ?>
    </body>
</html>
