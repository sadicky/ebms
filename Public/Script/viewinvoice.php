<?php

session_start(); 
require_once('../../Models/Invoice.php');
require_once('../../Models/connexion.php');
require_once('../../Language/config.php');
$database = new Database();
$database = $database->getConnexion();
$invoice = new Invoice($database);
$output = '';
// $id=$_POST['id'];
$id=1;

$output .= '
<div class="widget-content nopadding">
   <table class="table table-bordered">    
   <tr>
   <td colspan="2" style="font-size:18px">
   <div class="pull-left"> <img src="magasin.png" width="80"></div>
   <div class="pull-right"><b>Facture N° 1<br> du 15/6/2022</b></div></td>
  </tr>
  <tr>
   <td colspan="2">
    <table width="100%">
     <tr>
      <td width="50%">
      <h6>Emetteur</h6>
      <div style="background-color:#e7e3e3; padding:5px; font-size:x-small"">
        <b>name comp</b><br /> avenu,quartier,<br /> commune<br />
        NIF: <b>NIF</b> &nbsp; RC:<b>RC</b><br>               
       Tél : <b>tel</b><br />       
       Assujetti à la TVA:<b>Oui</b><br />       
       Centre Fiscal : <b>centre</b><br />
       Secteur d\'activité : <b>sector actvt</b><br />
       Compte Bancaire: <b>bank</b><br />
       </div>
      </td>
      <td width="50%">
      <div style="margin:10px">
      <h6>Adressé à</h6>
      <div class="table table-bordered" style="padding:5px; font-size:small"">        
      Noms ou Raison sociale : <b>client</b><br /> 
      NIF :<b> nif</b><br />
      Résidant à :<b>adresse</b><br />
      Assujetti à la TVA:<b>assujetti</b><br/><br/>      
        </div>
        </div>
      </td>
     </tr>
     </tr>
    </table>
    <br />
    <table width="100%" border="1" style="font-size:small">
     <tr>
      <th width="5%"><center>S/N</th>
      <th width="35%"><center>Articles</center></th>
      <th width="5%"><center>QTE</center></th>
      <th width="15%"><center>PU</center></th>
      <th width="15%"><center>PV HTVA</center></th>
      <th width="30%"><center>TVA</center></th>
     </tr>';
//   $statement = $connect->prepare("SELECT * FROM inv_order_item WHERE order_id = :order_id");
//   $statement->execute(
//    array(
//     ':order_id'       =>  $_SESSION['id']
//    )
//   );
//   $item_result = $statement->fetchAll();
//   $count = 0;

//   foreach($item_result as $sub_row)
//   {
//    $count++;
   $output .= '
   <tr>
    <td>count</td>
    <td>itemname</td>
    <td>qty</td>
    <td>'.number_format(100,0," ",'.').' Fbu</td>
    <td>'.number_format(100,0," ",'.').' Fbu</td>
    <td>'.number_format(100,0," ",'.').' Fbu</td>
   </tr>
   ';
  //}
  $output .= '
  <tr>
   <td colspan="6">&nbsp;</td>
  </tr>
  <tr>
   <td colspan="5"><b>Total HTVA :</b></td>
   <td align="right"><b>'.number_format(100,0," ",'.').' Fbu</b></td>
  </tr>
  <tr>
   <td colspan="5">TVAC(18%) :</td>
   <td align="right">'.number_format(100,0," ",'.').' Fbu</td>
  </tr>
  <tr style="background: #2196f3; color: #fff">
   <td colspan="5"><b>Total TTC :</b></td>
   <td align="right"><b>'.number_format(100,0," ",'.').' Fbu</b></td>
  </tr>  
  <tr>
   <td style="padding-top:20" align="right" colspan="6">Signature: &nbsp;&nbsp;&nbsp;<b>sign</b></td>
  </tr> 
  <tr>
   <td style="padding-top:20" align="left" colspan="6">Mode de Paiement: &nbsp;&nbsp;&nbsp;<b>mode</b></td>
  </tr>
  <tr>
   <td style="padding-top:20" align="left" colspan="6">Ajouté(e) par: &nbsp;&nbsp;&nbsp;<b>by</b></td>
  </tr>
  ';
  $output .= '
  </table>
 </td>
</tr>
   </table>
   </div>
  ';
 echo $output;

?>
