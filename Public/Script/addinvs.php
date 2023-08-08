<?php

session_start(); 
require_once ('../../Models/connexion2.php');
$db = getConnexion();
   
$order_total_before_tax = 0;
$order_total_tax1 = 0;
$order_total_tax = 0;
$order_total_after_tax = 0;

$invoice_number=htmlspecialchars(strip_tags(isset($_GET['invoice_numbers'])?$_GET['invoice_numbers']:1));
$invoice_date=htmlspecialchars(strip_tags($_GET['invoice_dates']));
$invoice_type="FN";
$customer_id=htmlspecialchars(strip_tags($_GET['customer_names']));
$order_total_before_tax=$order_total_before_tax;
$order_total_tax1=$order_total_tax1;
$order_total_tax=$order_total_tax;
$order_total_after_tax=$order_total_after_tax;
$invoice_datetime=time();
$invoice_signature=htmlspecialchars(strip_tags($_GET['invoice_signature']));
$payment_type=htmlspecialchars(strip_tags($_GET['payment_type']));
$statut=0;
$annuler=0;
$iduser=htmlspecialchars(strip_tags($_GET['user']));

$details=array();
$datOp=$_GET['invoice_dates'].' '.date('h:i:s');
     
$query ="INSERT INTO tbl_inv_order(invoice_number, invoice_date,invoice_type, customer_id, order_total_before_tax, 
order_total_tax1,order_total_tax, order_total_after_tax, order_datetime,invoice_signature,payment_type,statut	,annuler,iduser) 
VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
$req = $db->prepare($query);  

$re = $req->execute([$invoice_number,$invoice_date,$invoice_type,$customer_id,$order_total_before_tax,$order_total_tax1,$order_total_tax,
$order_total_after_tax,$invoice_datetime,$invoice_signature,$payment_type,$statut,$annuler,$iduser]);
    
$statement = $db->query("SELECT LAST_INSERT_ID()");
$order_id = $statement->fetchColumn();
 
for($count=0; $count<$_GET["total_items"]; $count++){

     $order_total_before_tax = $order_total_before_tax + floatval(trim($_GET["order_item_actual_amounts"][$count]));
     $order_total_tax1 = $order_total_tax1 + floatval(trim($_GET["order_item_tax1_amounts"][$count]));
     $order_total_after_tax = $order_total_after_tax + floatval(trim($_GET["order_item_final_amounts"][$count]));
  
     $statement = $db->prepare("
            INSERT INTO tbl_inv_order_item 
            (order_id, item_name, order_item_quantity, order_item_price, order_item_actual_amount, order_item_tax1_rate, order_item_tax1_amount,  order_item_final_amount)
            VALUES (:order_id, :item_name, :order_item_quantity, :order_item_price, :order_item_actual_amount, :order_item_tax1_rate, :order_item_tax1_amount, :order_item_final_amount)
          ");
          $statement->execute(
            array(
              ':order_id'               =>  $order_id,
              ':item_name'              =>  trim($_GET["item_names"][$count]),
              ':order_item_quantity'          =>  trim($_GET["order_item_quantitys"][$count]),
              ':order_item_price'           =>  trim($_GET["order_item_prices"][$count]),
              ':order_item_actual_amount'       =>  trim($_GET["order_item_actual_amounts"][$count]),
              ':order_item_tax1_rate'         =>  trim($_GET["order_item_tax1_rates"][$count]),
              ':order_item_tax1_amount'       =>  trim($_GET["order_item_tax1_amounts"][$count]),
              ':order_item_final_amount'        =>  trim($_GET["order_item_final_amounts"][$count])
            )
          );
          
          $details[$count]['item_designation']=$_GET["item_names"];
          $details[$count]['item_quantity']=$_GET["order_item_quantitys"];
          $details[$count]['item_price']=$_GET["order_item_prices"];
          $details[$count]['item_ct']=0;
          $details[$count]['item_tl']=0;
          $details[$count]['item_price_nvat']=$_GET["order_item_actual_amounts"];
          $details[$count]['vat']=$_GET["order_item_tax1_rates"];
          $details[$count]['item_price_wvat']=$_GET["order_item_tax1_amounts"];
          $details[$count]['item_total_amount']=$_GET["order_item_final_amounts"];
    }
    
    $soc = "SELECT * FROM tbl_society where tp_id=?";
    $socstatement = $db->prepare($soc);
    $socstatement->execute(
        array("1")
    );
    $society= $socstatement->fetch();
    
    $cust = "SELECT * FROM tbl_customer where customer_id=?";
    $custstatement = $db->prepare($cust);
    $custstatement->execute(array($customer_id));    
    $customer = $custstatement->fetch();

   $signature=$society['tp_TIN'].'/'.$_SESSION['user'].'/'.date('Ymdhis',strtotime($invoice_date.date('h:i:s'))).'/'.$invoice_number;
  //  print_r(json_encode($details));die();

   $infos='
    {
    "invoice_number": "'.$invoice_number.'",
    "invoice_date": "'.$datOp.'",
    "tp_type":"'.$society['tp_type'].'",
    "tp_name": "'.$society['tp_name'].'",
    "tp_TIN": "'.$society['tp_TIN'].'",
    "tp_trade_number": "'.$society['tp_trade_number'].'",
    "tp_postal_number": "'.$society['tp_postal_number'].'",
    "tp_phone_number": "'.$society['tp_phone_number'].'",
    "tp_address_province": "'.$society['tp_address_province'].'",
    "tp_address_commune": "'.$society['tp_address_commune'].'",
    "tp_address_quartier": "'.$society['tp_address_quartier'].'",
    "tp_address_avenue": "'.$society['tp_address_avenue'].'",
    "tp_address_rue": "'.$society['tp_address_rue'].'",
    "tp_address_number": "'.$society['tp_address_number'].'",
    "vat_taxpayer": "'.$society['vat_taxpayer'].'",
    "ct_taxpayer": "'.$society['ct_taxpayer'].'",
    "tl_taxpayer": "'.$society['tl_taxpayer'].'",
    "tp_fiscal_center": "'.$society['tp_fiscal_center'].'",
    "tp_activity_sector": "'.$society['tp_activity_sector'].'",
    "tp_legal_form": "'.$society['tp_TIN'].'",
    "payment_type": 1,
    "customer_name": "'.$customer['customer_name'].'",
    "customer_TIN": "'.$customer['customer_TIN'].'",
    "customer_address": "'.$customer['customer_address'].'",
    "vat_customer_payer": "'.$customer['vat_customer_payer'].'",
    "cancelled_invoice_ref": "",
    "invoice_signature": "'.$signature.'",
    "invoice_signature_date": "'.$datOp.'",
    "invoice_items":'.json_encode($details).'
    }';

    
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => $_SESSION['ebmsLogin'],
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{"username": '.$_SESSION['user'].',"password":'.$_SESSION['pswd'].'}',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json'
  ),
));

$response = curl_exec($curl);
curl_close($curl); 

$login=json_decode($response,true);
// print_r($response);die();
if($login['success']) 
  {
$login['result']['token'];

$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => $_SESSION['addInvoice'],
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>$infos,
  CURLOPT_HTTPHEADER => array(
    'Authorization: Bearer '.$login['result']['token'].'',
    'Content-Type: application/json'
  ),
));

$response = curl_exec($curl);

curl_close($curl);

$manage=json_decode($response,true);
// print_r($manage);die();
$suc=0;
if($manage['success']) 
  {
    $suc=1;
    
$up = "UPDATE tbl_inv_order SET invoice_signature=?,statut='1' where order_id=?"; 
$upsign = $connect->prepare($up);  
$upsign->execute(array($signature,$id));
  }

echo "<div class='alert alert-success' style='margin-top:15px'>".$manage['msg']."</div>";
echo "<h3><a href='invoice.php'>Cliquer Ici</a> pour aller à la page d'Accueil</h3>";
}
else
{
  echo "<div class='alert alert-danger' style='margin-top:15px'>". $login['msg']."</div><br>";
  echo "<a href='invoice.php' class='btn btn-primary'>Cliquer Ici</a> pour aller à la page d'Accueil";
}

    
  
?>