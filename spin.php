<?php
$config_use_sessions = TRUE;  
session_start();

  $te_custel=$_SESSION["scustel"];
  
  $te_sDatabase = 'ctecomco_spinwheel';
  $te_sHostname = 'localhost';
  $te_sPort     = 3306;
  $te_sUsername = 'root';
  $te_sPassword = 'mypass';

  
  $rConn = mysql_connect("$te_sHostname:$te_sPort", $te_sUsername, $te_sPassword)
         or die("Could not connect : ".mysql_error());  
  $rDB=mysql_select_db($te_sDatabase,$rConn) or die("Could not select database");


require("sajax.php");     // before user rights
sajax_init();
//$sajax_debug_mode = 1;
sajax_export("calc_count"); 
sajax_export("save_spin"); 
sajax_handle_client_request();  

 $te_cussno=0;
 $sql_cus = "SELECT cussno FROM cusmast WHERE custel='$te_custel'";    
 $result_cus = mysql_query($sql_cus);
 if(mysql_num_rows($result_cus))
 {
  $fields_cus = mysql_fetch_array($result_cus, MYSQL_BOTH);
  $te_cussno  = $fields_cus['cussno'];
 }
 
 $te_enttime= strftime('%H:%M:%S');
 $te_entddt = strftime ("%Y-%m-%d");
 
 $sql_spin = "SELECT spinsno FROM spinmast WHERE spincussno='$te_cussno'";    
 $result_spin = mysql_query($sql_spin);
 if(mysql_num_rows($result_spin))
 {
  //header("Location: index.php");
  //return;	 
 }



$te_enttime= strftime('%H:%M:%S');
$te_entddt = strftime ("%Y-%m-%d");

$te_spinentddt = $te_entddt;
$te_spinenttime = substr($te_enttime,0,5);

$te_spinenttime = substr($te_enttime,0,2);

$te_spinentddt='2023-08-06';
$te_spinenttime='18:30';

/*
$te_spinitem='Air Pod';
$sql_spin = "SELECT count(spinsno) count_airpod from spinmast 
             where spinentddt='$te_spinentddt' and spinenttime>='$te_spinenttime' 
             and spinitem='$te_spinitem' ";    
             
//echo "$sql_spin <br>";

$te_count_airpod=0;
$result_spin = mysql_query($sql_spin);
if(mysql_num_rows($result_spin))
{
 $fields_spin = mysql_fetch_array($result_spin, MYSQL_BOTH);
 $te_count_airpod = $fields_spin['count_airpod'];
}
//echo "Air Pod Count: $te_count_airpod <br>";

$te_spinitem='Voucher 1';
$sql_spin = "SELECT count(spinsno) count_voucher_1 from spinmast 
             where spinentddt='$te_spinentddt' and spinenttime>='$te_spinenttime' 
             and spinitem='$te_spinitem' ";    
             
$result_spin = mysql_query($sql_spin);
if(mysql_num_rows($result_spin))
{
 $fields_spin = mysql_fetch_array($result_spin, MYSQL_BOTH);
 $te_count_voucher_1 = $fields_spin['count_voucher_1'];
}

$te_spinitem='Voucher 2';
$sql_spin = "SELECT count(spinsno) count_voucher_2 from spinmast 
             where spinentddt='$te_spinentddt' and spinenttime>='$te_spinenttime' 
             and spinitem='$te_spinitem' ";    
             
$result_spin = mysql_query($sql_spin);
if(mysql_num_rows($result_spin));
{
 $fields_spin = mysql_fetch_array($result_spin, MYSQL_BOTH);
 $te_count_voucher_2 = $fields_spin['count_voucher_2'];
}


$te_spinitem='Voucher 3';
$sql_spin = "SELECT count(spinsno) count_voucher_3 from spinmast 
             where spinentddt='$te_spinentddt' and spinenttime>='$te_spinenttime' 
             and spinitem='$te_spinitem' ";    
             
$result_spin = mysql_query($sql_spin);
if(mysql_num_rows($result_spin))
{
 $fields_spin = mysql_fetch_array($result_spin, MYSQL_BOTH);
 $te_count_voucher_3 = $fields_spin['count_voucher_3'];
}

$te_spinitem='Voucher 4';
$sql_spin = "SELECT count(spinsno) count_voucher_4 from spinmast 
             where spinentddt='$te_spinentddt' and spinenttime>='$te_spinenttime' 
             and spinitem='$te_spinitem' ";    
             
$result_spin = mysql_query($sql_spin);
if(mysql_num_rows($result_spin))
{
 $fields_spin = mysql_fetch_array($result_spin, MYSQL_BOTH);
 $te_count_voucher_4 = $fields_spin['count_voucher_4'];
}
*/


//


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Anthoney's</title>
    <!---------------  CSS  --------------------->
    <link rel="stylesheet" href="spin_style.css">
    <!---------------  Font Aewsome  --------------------->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" 
    integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!---------------  Chart JS  --------------------->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    <!---------------  Chart JS Plugin  --------------------->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-datalabels/2.1.0/chartjs-plugin-datalabels.min.js"></script> 
    
<script language="JavaScript">
<?php
 sajax_show_javascript();
?>

//-------------- [ calc_count() ] ---------------------------------//
function calc_count() 
{
 
 x_calc_count(calc_count_x)
}

function calc_count_x(str_)
{
 //alert(str_)
 //document.getElementById('debug').innerHTML = str_  // not working
 
 var the_array = str_.split("####")
 document.fn.count_airpod.value=the_array[0];
 
 document.fn.count_voucher_1.value=the_array[1];
 document.fn.count_voucher_2.value=the_array[2];
 document.fn.count_voucher_3.value=the_array[3];
 document.fn.count_voucher_4.value=the_array[4];
}


//-------------- [ save_ajax_check() ] ---------------------------------//
function save_spin() 
{
 te_custel='<?php echo $te_custel?>';
 
 te_spinitem = document.fn.spinitem.value
 te_spinitem_org = document.fn.spinitem_org.value
 if(te_spinitem==te_spinitem_org)
 {
  te_spinitem_org='';	 
 }
 
 te_spinrem  = document.fn.spinrem.value
 
 x_save_spin(te_custel,te_spinitem,te_spinitem_org,te_spinrem,save_spin_x)
}

function save_spin_x(str_)
{
 //alert(str_)
 //document.getElementById('debug').innerHTML = str_  // not working
 
 

}



</script>
        
    
    
</head>
<body>
  <h1>New Anthoneys</h1>
  <div class="container">
     <div id="text"><p>Wheel Of Fortune</p></div>
     <button id="close_btn">Close</button>
     
     <div class="wheel_box">
      
      
      <canvas id="spinWheel"></canvas>
      <button id="spin_btn">Spin</button>
      <i class="fa-solid fa-location-arrow"></i>
     </div> 
    
  </div>
  <!---------------  SCRIPT  --------------------->
  <script src="script.js"></script>  
  
  <form action="" name="fn" method="post">  
    <input type='hidden' name='randomDegree' value=''></input>
    <input type='hidden' name='spinitem' value=''></input>
    <input type='hidden' name='spinitem_org' value=''></input>
    <input type='hidden' name='spinrem' value=''></input>
    
    <input type='text' name='count_airpod' id='count_airpod'   value='<?=$te_count_airpod?>'></input>
    <input type='hidden' name='count_voucher_1' value='<?=$te_count_voucher_1?>'></input>
    <input type='hidden' name='count_voucher_2' value='<?=$te_count_voucher_2?>'></input>
    <input type='hidden' name='count_voucher_3' value='<?=$te_count_voucher_3?>'></input>
    <input type='hidden' name='count_voucher_4' value='<?=$te_count_voucher_4?>'></input>
  </form>

  <!-- <audio id="spinSound" src="music/crizzpysong.mp3" preload="auto"></audio>
  <audio id="spinSound" src="music/clapping.mp3" preload="auto"></audio> -->

</body>   
</html>

<?php
function save_spin($te_custel,$te_spinitem,$te_spinitem_org,$te_spinrem)
{
 $te_return = ""; 	 	
 $te_cussno=0;
 $sql_cus = "SELECT cussno FROM cusmast WHERE custel='$te_custel'";    
 $result_cus = mysql_query($sql_cus);
 if(mysql_num_rows($result_cus))
 {
  $fields_cus = mysql_fetch_array($result_cus, MYSQL_BOTH);
  $te_cussno  = $fields_cus['cussno'];
 }
 
 $te_enttime= strftime('%H:%M:%S');
 $te_entddt = strftime ("%Y-%m-%d");
 
 $sql_spin = "SELECT spinsno FROM spinmast WHERE spincussno='$te_cussno'";    
 $result_spin = mysql_query($sql_spin);
 if(!mysql_num_rows($result_spin))
 {
  $sql_add = "INSERT INTO spinmast
    		      (spincussno,spinitem,spinitem_org,spinrem,
    		       spinentddt,spinenttime) 	
    		      VALUES 
    		      ('$te_cussno','$te_spinitem','$te_spinitem_org','$te_spinrem',
    		       '$te_entddt','$te_enttime')";
  //return $sql_add; 		      
  $result_add = mysql_query($sql_add) or die("<h5>Could not Insert</h5>");
 
  return 'Saved';
 }
}

function calc_count()
{
	
 $te_enttime= strftime('%H:%M:%S');
 $te_entddt = strftime ("%Y-%m-%d");
	
 $te_spinentddt = $te_entddt;
 $te_spinenttime = substr($te_enttime,0,5);
 
 $te_spinenttime = substr($te_enttime,0,2);
 
 $te_spinentddt='2023-08-06';
 $te_spinenttime='18:30';
 
 $te_spinitem='Air Pod';
 $sql_spin = "SELECT count(spinsno) count_airpod from spinmast 
              where spinentddt='$te_spinentddt' and spinenttime>='$te_spinenttime' 
              and spinitem='$te_spinitem' ";    
              
 //echo "$sql_spin <br>";
 
 $te_count_airpod=0;
 $result_spin = mysql_query($sql_spin);
 if(mysql_num_rows($result_spin))
 {
  $fields_spin = mysql_fetch_array($result_spin, MYSQL_BOTH);
  $te_count_airpod = $fields_spin['count_airpod'];
 }
 //echo "Air Pod Count: $te_count_airpod <br>";
 
 $te_spinitem='Voucher 1';
 $sql_spin = "SELECT count(spinsno) count_voucher_1 from spinmast 
              where spinentddt='$te_spinentddt' and spinenttime>='$te_spinenttime' 
              and spinitem='$te_spinitem' ";    
              
 $result_spin = mysql_query($sql_spin);
 if(mysql_num_rows($result_spin))
 {
  $fields_spin = mysql_fetch_array($result_spin, MYSQL_BOTH);
  $te_count_voucher_1 = $fields_spin['count_voucher_1'];
 }
 
 $te_spinitem='Voucher 2';
 $sql_spin = "SELECT count(spinsno) count_voucher_2 from spinmast 
              where spinentddt='$te_spinentddt' and spinenttime>='$te_spinenttime' 
              and spinitem='$te_spinitem' ";    
              
 $result_spin = mysql_query($sql_spin);
 if(mysql_num_rows($result_spin));
 {
  $fields_spin = mysql_fetch_array($result_spin, MYSQL_BOTH);
  $te_count_voucher_2 = $fields_spin['count_voucher_2'];
 }
 
 
 $te_spinitem='Voucher 3';
 $sql_spin = "SELECT count(spinsno) count_voucher_3 from spinmast 
              where spinentddt='$te_spinentddt' and spinenttime>='$te_spinenttime' 
              and spinitem='$te_spinitem' ";    
              
 $result_spin = mysql_query($sql_spin);
 if(mysql_num_rows($result_spin))
 {
  $fields_spin = mysql_fetch_array($result_spin, MYSQL_BOTH);
  $te_count_voucher_3 = $fields_spin['count_voucher_3'];
 }
 
 $te_spinitem='Voucher 4';
 $sql_spin = "SELECT count(spinsno) count_voucher_4 from spinmast 
              where spinentddt='$te_spinentddt' and spinenttime>='$te_spinenttime' 
              and spinitem='$te_spinitem' ";    
              
 $result_spin = mysql_query($sql_spin);
 if(mysql_num_rows($result_spin))
 {
  $fields_spin = mysql_fetch_array($result_spin, MYSQL_BOTH);
  $te_count_voucher_4 = $fields_spin['count_voucher_4'];
 }
 $te_return=$te_count_airpod.'####'.$te_count_voucher_1.'####'.$te_count_voucher_2.'####'.$te_count_voucher_3.'####'.$te_count_voucher_4;
 return $te_return;
}
?>