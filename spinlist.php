<?php
$config_use_sessions = TRUE;  
session_start();


$o = new HtmlFormsObjects;


  $te_sDatabase = 'ctecomco_spinwheel';

  $te_sHostname = 'localhost';

  $te_sPort     = 3306;

  $te_sUsername = 'root';

  $te_sPassword = 'mypass';

 

 

  $rConn = mysql_connect("$te_sHostname:$te_sPort", $te_sUsername, $te_sPassword)

         or die("Could not connect : ".mysql_error()); 

  $rDB=mysql_select_db($te_sDatabase,$rConn) or die("Could not select database");

  // $rConn = mysql_connect("$te_sHostname:$te_sPort", $te_sUsername, $te_sPassword)
  //   or die("Could not connect : ".mysql_error());  
  // $rDB=mysql_select_db($te_sDatabase,$rConn) or die("Could not select database");
  
$te_usdusd=$_SESSION["susdusd"];
$te_supinqA = "checked";
$te_supinqS = "";
$te_entddt= strftime("%d/%m/%Y");
$te_enttime=strftime('%H:%M:%S');
$te_usdusd = $_SESSION["susdusd"];
$te_usdnew = $te_usdusd;

 $te_attentddt  = strftime("%Y-%m-%d");
 $te_attenttime = strftime('%H:%M:%S');
 
 $te_frddt = strftime("01/%m/%Y");
 $te_frddt = strftime("%d/%m/%Y");
 $te_toddt = strftime("%d/%m/%Y");

 $te_frtime='00:00';
 $te_totime='23:59';


$te_sysddt = "var te_sysddt = '".$te_entddt."';\n"; 
  
  require("sajax.php");     // before user rights
 sajax_init();
 //$sajax_debug_mode = 1;
 //sajax_export("next_dno");
 sajax_handle_client_request(); 
  
//----------------------------------------------------------------------------------------

	

//-------------------------Check User Rights [BEGIN]-------------------------------------
//-------------------------Check User Rights [CLOSE]-------------------------------------
$val_key = "n";
if(isset($_POST['display'])||($_POST['excel2']))
{  
 $val_key          = "y";
 $te_spinitem     = $_POST['spinitem'];
 $te_spinitemauto = $_POST['spinitemauto'];

 $te_frddt          = $_POST['frddt'];
 $te_toddt          = $_POST['toddt'];
 
 $te_frddty          = dtoy($_POST['frddt']);
 $te_toddty          = dtoy($_POST['toddt']);

 $te_frtime=$_POST['frtime'];
 $te_frdttime   = $te_frddty.$te_frtime.":00";
 $te_totime=$_POST['totime'];
 $te_todttime   = $te_toddty.$te_totime.":59";



 
 if($te_spinitem>0)
 {
  $sql_cat="and spinitem='$te_spinitem'";
 }
}

if(isset($_POST['excel2']))
{
 $colarray=array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'); 
 $te_xllinecount = $_POST['xllinecount']; 
 
 /** Error reporting */
 error_reporting(E_ALL);
 ini_set('display_errors', TRUE);
 ini_set('display_startup_errors', TRUE);
 date_default_timezone_set('Asia/Kolkata');
 
 if (PHP_SAPI == 'cli')
  die('This example should only be run from a Web Browser');
 
 /** Include PHPExcel */
 require_once dirname(__FILE__) . '/../Classes/PHPExcel.php';
 
 
 // Create new PHPExcel object
 $objPHPExcel = new PHPExcel();
 $te_title1=' List';///============================Excel Tab name
 // Set document properties
 $objPHPExcel->getProperties()->setCreator($te_usdusd)
                ->setLastModifiedBy($te_usdusd)
                ->setTitle("Office 2007 XLSX Document")
                ->setSubject("Office 2007 XLSX Document")
                ->setDescription("Document for Office 2007 XLSX.")
                ->setKeywords("office 2007 openxml php")
                ->setCategory("Result file");
                             
 $objPHPExcel->getActiveSheet()->getStyle("A1:O1")->getFont()->setBold(true);
 $objPHPExcel->getActiveSheet()->getStyle("A3:O3")->applyFromArray
                                                    (
                                                     array(
                                                           'fill' => array(
                                                           'type' => PHPExcel_Style_Fill::FILL_SOLID,
                                                           'color' => array('rgb' => 'e5f9f8')
                                                                           )
                                                          )
                                                    );
 $objPHPExcel->setActiveSheetIndex(0);
 
 // set row height
 $objPHPExcel->getActiveSheet()->getRowDimension(1)->setRowHeight(23);
 
 
 $objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
 $objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
 $objPHPExcel->getActiveSheet()->getPageSetup()->setFitToPage(true);
 $objPHPExcel->getActiveSheet()->getPageSetup()->setFitToWidth(1);
 $objPHPExcel->getActiveSheet()->getPageSetup()->setFitToHeight(0);
 $objPHPExcel->getDefaultStyle()->getFont()->setName('Times New Roman');
 $objPHPExcel->getDefaultStyle()->getFont()->setSize(10);
 
 $objPHPExcel->getActiveSheet()->setTitle($te_title1);
 
 // $objPHPExcel->getActiveSheet()->setCellValue('A1', 'From Date');
 $objPHPExcel->getActiveSheet()->setCellValue('B1','List');
 
 // $objPHPExcel->getActiveSheet()->setCellValue('D1', 'To Date');
 // $objPHPExcel->getActiveSheet()->setCellValue('E1',$te_toddt);

 
 $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
 $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
 $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(40);
 $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(25);
 $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(25);
 $objPHPExcel->getActiveSheet()->setCellValue('A3', '#');
 $objPHPExcel->getActiveSheet()->setCellValue('B3', 'Code');
 $objPHPExcel->getActiveSheet()->setCellValue('C3', 'Name');
 $objPHPExcel->getActiveSheet()->setCellValue('D3', 'TIN Number');
 $objPHPExcel->getActiveSheet()->setCellValue('E3', 'SUPPLIER_GROUP_NAME');
 $objPHPExcel->getActiveSheet()->setCellValue('F3', 'Delivery Terms');
 $objPHPExcel->getActiveSheet()->setCellValue('G3', 'Delivery Method');
 $objPHPExcel->getActiveSheet()->setCellValue('H3', 'Packaging Terms');
 $objPHPExcel->getActiveSheet()->setCellValue('I3', 'Currency');
 $objPHPExcel->getActiveSheet()->setCellValue('J3', 'Payment Terms');
 $objPHPExcel->getActiveSheet()->setCellValue('K3', 'Payment Method Accounts Payable');
 $objPHPExcel->getActiveSheet()->setCellValue('L3', 'Country');
 $objPHPExcel->getActiveSheet()->setCellValue('M3', 'BANK_NAME');
 $objPHPExcel->getActiveSheet()->setCellValue('N3', 'BANK_CODE');
 $objPHPExcel->getActiveSheet()->setCellValue('O3', 'ACCOUNT_NO');

 $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
 // $objPHPExcel->getActiveSheet()->setCellValue('G3', 'Qty');
 // $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);

 $objPHPExcel->getActiveSheet()->freezePane('B4');
 $te_flg='n';
 $i=3;
 for($e=1;$e<$te_xllinecount;$e++)
 { 
  $i++;  
  $te_xlheader = $_POST['xlheader'][$e];
  //echo "$te_header<br>";
  $ar_Data   = explode('####',$te_xlheader);
  $te_1=count($ar_Data);
  //echo "$te_1<br>";
  $te_dt = count($ar_Data);
  
  $myArr = array();
  //-------------------------------------------------------------------------------------
  for($Data_fld=0; $Data_fld<count($ar_Data);$Data_fld++)
  {
   //echo "$Data_fld <br>";
   $fld     = $ar_Data[$Data_fld];
   //echo "$fld <br>";
   $col=$colarray[$Data_fld];
   //$objPHPExcel->getActiveSheet(0)->setCellValue($col.$i,$fld);    // working
   $myArr[$Data_fld] = $fld;



   if($col=='B' && $fld=='ITEM CODE')
   {
    $col1= $col;
    //echo "inside blank $col1.$i,$fld - $te_<br>";
    //getStyle('A'.$i.':'.'AG'.$i)
    #('A1:'.'A'.$i1)
    #getStyle($col1.$i)
    $objPHPExcel->getActiveSheet()->getStyle('A'.$i.':'.'F'.$i)->applyFromArray
                                               (
                                                array(
                                                       'fill' => array(
                                                       'type' => PHPExcel_Style_Fill::FILL_SOLID,
                                                       'color' => array('rgb' => '8B8000')
                                                                      )
                                                     )
                                              );
    }



  }  
  
  $objPHPExcel->getActiveSheet(0)->fromArray($myArr, NULL,'A'.$i);
  $objPHPExcel->getActiveSheet()->getRowDimension($i)->setRowHeight(23);
 }
 //$objPHPExcel->getActiveSheet(0)->setAutoFilter($objPHPExcel->getActiveSheet()->calculateWorksheetDimension());
 // Set active filters
 //$autoFilter = $objPHPExcel->getActiveSheet()->getAutoFilter();
 //$autoFilter->showHideRows(); 
 
 // $objPHPExcel->getActiveSheet()->setCellValue('A'.($i+1),'Total');
 // $objPHPExcel->getActiveSheet()->setCellValue('F'.($i+1),"=SUM(F4:F".($i).")");
 // $objPHPExcel->getActiveSheet()->getRowDimension($i+1)->setRowHeight(23);
 
 $objPHPExcel->getActiveSheet()->getStyle('A3:'.'A'.($i+1))->applyFromArray
                                                (
                                                 array(
                                                        'fill' => array(
                                                        'type' => PHPExcel_Style_Fill::FILL_SOLID,
                                                        'color' => array('rgb' => '95b9c7')
                                                                       )
                                                      )
                                                );
                                                
                                                
                                                
 // printing border around all the cells
 $styleArray = array(
      'borders' => array(
          'allborders' => array(
              'style' => PHPExcel_Style_Border::BORDER_THIN
          )
      )
  );
 $objPHPExcel->getActiveSheet()->getStyle('A3:'.'O'.($i+1))->applyFromArray($styleArray); 
 
 //CENTER TEXT VERTICAL==========================================================================================
 $objPHPExcel->getActiveSheet()->getStyle('A3:'.'O'.($i+1))->getAlignment()->applyFromArray(
         array(
             'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
             'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
             'rotation'   => 0,
             'wrap'       => true
         )
 );

 // Set active sheet index to the first sheet, so Excel opens this as the first sheet
 $objPHPExcel->setActiveSheetIndex(0);
 
 
 // Redirect output to a client’s web browser (Excel5)
 header('Content-Type: application/vnd.ms-excel');
 header('Content-Disposition: attachment;filename="SpiList.xlsx"');
 header('Cache-Control: max-age=0');
 // If you're serving to IE 9, then the following may be needed
 header('Cache-Control: max-age=1');
 
 // If you're serving to IE over SSL, then the following may be needed
 header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
 header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
 header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
 header ('Pragma: public'); // HTTP/1.0
 
 $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
 $objWriter->save('php://output');
 exit;
}

 
//-------------------------------END PRINT------------------------//
?>
<HTML>
<HEAD>
<TITLE></TITLE>
     
<link rel='stylesheet' href='mystyle.css' />
    <style>
      .freeze-table{
        border-spacing: 0;
        font-family: "Segoe UI", sans-serif,"Helvetica Neue";
        font-size: 14px;
        padding: 0;
        border: 1px solid #ccc;
      }
    thead th{
      top: 0;
      position: sticky;
      background-color: #666;
      color: #fff;
      z-index: 20;
      min-height: 30px;
      height: 30px;
      text-align: left;
    }
    tr:nth-child(even){
      background-color: #f2f2f2;
    }
    th ,td{
      padding: 0;
      outline: 1px solid #ccc;
      border: none;
      outline-offset: -1px;
      padding-left: 5px;
    }
    tr{
      min-height: 25px;
      height: 25px;
    }
    .col-id-no{
      left: 0;
      position: sticky;
    }
    .col-first-name{
      left: 80px;
      position: sticky;
    }
    .fixed-header{
      z-index: 50;
    }

    tr:nth-child(even) td[scope=row]{
      background-color: #f2f2f2;
    }
    tr:nth-child(odd) td[scope=row]{
      background-color: #fff;
    }
    </style>
    
<style type='text/css'>
body,table
{
  /*font-size:10px;*/
  font-family: Times New Roman;
}
div {
  background-color: inherit;
}
</style>

<script type="text/JavaScript" src="formvalidation.js"></script>
<SCRIPT LANGUAGE="JavaScript" SRC="autocomplete.js"></SCRIPT>
<script language="JavaScript" src="calendar2.js"></script> 
<!-- <script language="javascript" type="text/javascript" src="actb.js"></script><!-- External script -->
<script language="javascript" type="text/javascript" src="tablefilter.js"></script>

<!-- <script type="text/javascript" src="jquery-1.5.1.min.js"></script>
<script type="text/javascript" src="jquery.freezeheader.js"></script>  -->
<script type="text/javascript"> 
$(document).ready(function(){
  //$("#table2").freezeHeader({ top: true, left: false });
});
 
</script>


<SCRIPT LANGUAGE="JavaScript">
function valdata()
{
}

var frm = "";

//--------------------------------- [ enter() ] ---------------------------------//

function enter(nextfield)
{
 if(window.event && window.event.keyCode == 13)
 {
   nextfield.fosup();
   return false;
 }
 else
  return true; 
}

//--------------------------------- [ enter_opt() ] ---------------------------------//

function enter_opt()
{
 var supinqA = document.fn.supinq[0];
 var supinqS = document.fn.supinq[1];
 if(supinqS.checked)
 	nextfield = document.fn.supsctsno;
 else
 	nextfield = document.fn.display;
 	
 if(window.event && window.event.keyCode == 13)
 {
   nextfield.fosup();
   return false;
 }
 else
  return true; 
}  
//--------------------------------- [ window_onload() ] ---------------------------------//

function window_onload()
{
 // var frm = document.fn;
 // var supsctsno = frm.supsctsno;
 // supsctsno.value = '<?=$te_supsctsno?>';
 // document.fn.spinitemauto.fosup();

 frm = document.fn
 frm.frddt.focus();
}

function valkey()
{

 var fld = frm.frddt 
 if(chkBlank(fld)==false)
 {
  fld.focus();
  return false;   
 }
 if(isDate(fld.value)==false) 
 {
  fld.select();
  return false;
 }
 
 var fld = frm.toddt 
 if(chkBlank(fld)==false)
 {
  fld.focus();
  return false;   
 }
 if(isDate(fld.value)==false) 
 {
  fld.select();
  return false;
 }
 
 var fldf = frm.frddt 
 var fldt = frm.toddt 
 if(comparedates(fldf.value, fldt.value) == true)
 {
  alert("Date.. invalid range ..!")
  fld.select();
  return false;   
 }
 
 
 
 var fld = frm.empsno 
 if(chkBlank(fld)==false)
 {
  var fld = frm.empsnoauto   
  fld.focus();
  return false;   
 }
  
 return true;
}

</script>

<?php
  echo"$js_usdsno";
  echo"$js_inhtyp";
?>

<body onLoad="window_onload();">
<form name="fn" action='spinlist.php' method='post'>
<table width='100%' border='0' style='position:relative'>
<tr>
 <td width='50%'>
 <!-- <input TYPE='button' Value='MENU' onClick="window.location='menu.php'" class='submit'></input> -->
 <input type="button" name="reload" value="RELOAD" OnClick ="window.location='spinlist.php'" class='submit'></input>
 </td>
 <td class='lbl' align='center' width="100%">
 <font face='comicbd' color='#4581a4' size='3'>List</font>
 </td>
</tr>
</table>
<br>
<div name="divkey" class='myLayersClassv'> 
<table align="center" width="100%" border='0' style='position:relative'>
<FORM NAME="spinlist" METHOD="POST" ACTION="spinlist.php" RUNAT='SERVER'>

<tr style='position:relative'>

 <td width='10%'align="right" class='lbl'>Fr Date</td>
 <td width='15%'>:<input type='text' name='frddt' value='<?=$te_frddt?>' size='10' maxlength='10'
 <?=$te_ro?> onkeypress="return enter(document.fn.toddt)" onChange=""></input>
 <a href="javascript:cal.popup();"><img src="cal.gif" width="16" height="16" border="0"
 alt="Click Here to Pick up the date" ></a></input></td>
  <td class='lbl' align='right'>From Time:</td>
 <td><input type="text" name="frtime" id="frtime" size="8" maxlength="8" 
 value='<?=$te_frtime?>' onKeyPress="return enter(document.fn.display);"></input>
 </td>

 </tr>
 <tr>
 
 <td width='10%'align="right" class='lbl'>To Date</td>
 <td width='15%'>:<input type='text' name='toddt' value='<?=$te_toddt?>' size='10' maxlength='10'
 <?=$te_ro?> onkeypress="return enter(document.fn.ok)" onChange=""></input>
 <a href="javascript:cal1.popup();"><img src="cal.gif" width="16" height="16" border="0"
 alt="Click Here to Pick up the date" ></a></input></td>
  <td class='lbl' align='right'>To Time:</td>
 <td><input type="text" name="totime" id="totime" size="8" maxlength="8" 
 value='<?=$te_totime?>' onKeyPress="return enter(document.fn.display);"></input>
 </td> 
</tr>

<tr style='position:relative'> 
<td class='lbl' width='15%' align='right' >Select Item(Blank For All):</td>

<td width='50%' >
<?php
$t = 4;
$w = 250;
$sqlquery= "SELECT distinct spinitem  FROM spinmast 
	              WHERE 1
	              ORDER BY spinitem"; 
$result = mysql_query($sqlquery,$rConn) or die("no records spin");
 
$o->GenerateDropDownListauto("spinitem","$te_spinitem","spinitem","spinitem",
"this.form.spinitemauto.value=this.options[this.selectedIndex].text;",
"return enter(document.spinlist.display)","$w","$t");
$w-=20;
?>
<INPUT TYPE="text" NAME="spinitemauto" id="spinitemauto" VALUE="<?php echo $te_spinitemauto;?>" 
ONKEYUP="autoComplete(this,this.form.spinitem,'text',true);" 
style="position:absolute; top:<?php echo $t;?>; z-index:0; width:<?php echo $w;?>;" 
onkeypress="return enter(document.forms[0].display)" >     
</td> 
<td>
<input type="submit" name="display" value="DISPLAY" 
class='submit' onClick='return valkey();'></input>
</td>
</tr>
</table>
</div>
<br>
<?php

if(isset($_POST['display']))
{
  $sp_sql='';
 if($te_spinitem!='')
 {
  $sp_sql = "and spinitem='$te_spinitem'";
 }
  echo '<div style="width: 1300px; height: 450px; overflow: auto; margin-left: 10px; border: 1px solid;">
    <table class="freeze-table" width="1250px">';

 //echo "<table id='table2' cellspacing='3' cellpadding='1' style='border: 1 solid #ff0000' width='100%'>";
 echo "<THEAD  style='font-size:12px;'>";
 echo"<TR bgcolor='#ff8c00'>";
 echo "<TH>#</TH>";
 echo "<TH>Ent Date</TH>";
 echo "<TH>Ent Time</TH>";
 echo "<TH>Item</TH>";
 echo "<TH>Rem</TH>";
 echo "<TH>Name</TH>";
 echo "<TH>Address</TH>";
 echo "<TH>Tel</TH>";
 echo "<TH>Email</TH>";
 
 echo "<TH>Cus Sno</TH>";
 echo "<TH>Spin Sno</TH>";
 echo "</TR>";
 echo "</THEAD>";
 echo "<tbody id=\"myTbody1\" bgcolor=\"#ffffff\" align=\"center\">";
 
 $m=0;
 $te_header =" NO####Main Category####Item Code####Item Description####Unit";
 //echo "$te_header<br>";
 echo "<input type='hidden' value='$te_header' name='header[$m]' id='header[$m]' size='800'></input>";
 $m++;	


 $e=0;
  
 $te_xlheader ="CODE####Supplier####System Ref####POD Date####Remarks####POD. Qty";
 //echo "$te_xlheader<br>";
 echo "<input type='hidden' value='$te_xlheader' name='xlheader[$e]' id='xlheader[$e]' size='800'></input>";
 $e++;

  
 $sql_query = "SELECT spinsno,spinitem,spinentddt,spinenttime,spinitem,spinitem_org,spinrem,
                      cussno,cusnam,cusadd,custel,cusemail
                      from spinmast left join cusmast on spincussno=cussno

 				where 1  and spinentddt>='$te_frddty' and spinentddt<='$te_toddty' and concat(spinentddt,spinenttime)>='$te_frdttime' 
              and concat(spinentddt,spinenttime)<='$te_todttime' 
              $sp_sql
 				order by spinentddt desc,spinenttime desc";


 //echo "$sql_query<br>";				    
 $result = mysql_query($sql_query)or die('error display'.mysql_error());
 
 $j=0;
 $m=0;
 if(mysql_num_rows($result)) 
 {
  $te_sysmain   = "hgfh 54545";
  while ($fields = mysql_fetch_array($result, MYSQL_BOTH)) 
  {
   $te_spinsno   = $fields['spinsno'];	  
   $te_spinitem  = $fields['spinitem'];
   $te_spinentddt  = $fields['spinentddt'];
   $te_spinenttime = $fields['spinenttime'];
   $te_spinitem    = $fields['spinitem'];
   $te_spinitem_org = $fields['spinitem_org'];
   $te_spinrem   = $fields['spinrem'];
   
   $te_cussno    = $fields['cussno'];
   $te_cusnam    = $fields['cusnam'];
   $te_cusadd    = $fields['cusadd'];
   $te_custel    = $fields['custel'];
   $te_cusemail  = $fields['cusemail'];
   
   $j=$j+1;  
	   
   echo "<tr class='a".($j%2)."' align='left' style='font-size:12px;'>";
   echo "<th align='right'>$j.</th>";  
   echo "<td>$te_spinentddt</td>";
   echo "<td>$te_spinenttime</td>";
   echo "<td>$te_spinitem</td>";
   echo "<td>$te_spinrem $te_spinitem_org</td>";
   echo "<td>$te_cusnam</td>";
   echo "<td>$te_cusadd</td>";
   echo "<td>$te_custel</td>";
   echo "<td>$te_cusemail</td>";
   echo "<td>$te_cussno</td>";
   echo "<td>$te_spinsno</td>";
   echo "</tr>";

    $te_xlheader ="$j####$te_spinitem####$te_spincussno####$te_spinenttime####$te_supgrp####$te_supdlvterms####$te_supdlvmethod####$te_suppkgterms####$te_supcur####$te_suppmtterms####$te_suppmtmethod####$te_supcou####$te_supbnknam####$te_supbnkcode####$te_supbnkaccno####"; 
    //echo"$te_xlheader<br>";
    echo "<input type='hidden' value='$te_xlheader' name='xlheader[$e]' id='xlheader[$e]' size='800'></input>";
    $e++;

  }
  echo "<input type='hidden' value='$m' name='linecount' id='linecount'></input>";
  echo "<input type='hidden' value='$e' name='xllinecount' id='xllinecount'></input>";
  echo "</table>";
  echo "</div>";

  echo "<table>";
  echo "<tr class='a".($i%2)."' align='left' style='font-size:13px;'>";
  echo "</tr>";

  echo "<tr><td>";
  //echo "<input type='submit' value='EXCEL2' name='excel2' onClick='' class='submit'></input></td>";
  echo "</table>";
  echo "</div>";
 }
 else
 {
  echo "<center><font color='#ff0000'><br>No Records...!</font></center>";
 }
  
}
 
?>
<script language="javascript" type="text/javascript">
//<![CDATA[
	var table2_Props = 	{
							col_0: "none",
							col_1: "select",
							col_2: "select",
							col_3: "select",
							col_4: "select",
							col_5: "none",
					
							display_all_text: " [ Show all ] ",
							sort_select: true 
						};
	setFilterGrid( "table2",table2_Props );
//]]>
</script>

 <SCRIPT LANGUAGE="JavaScript">
  var cal = new calendar2(document.fn.frddt);
  cal.year_scroll = true;
  cal.time_comp = false;
  
  var cal1 = new calendar2(document.fn.toddt);
  cal1.year_scroll = true;
  cal1.time_comp = false;
 </script>

<hr/>
</form>		
</body>
</html>

<?php
function ytod($ddt)
{
 if ($ddt=="0000-00-00")
     return "";
 else
     {$year = substr($ddt, 0, 4);
     $month = substr($ddt, 5, 2);
     $day = substr($ddt, 8, 2);
     return  "$day/$month/$year";
     }
}

function dtoy($ddt)
{
if ($ddt) {
//$day = substr($ddt, 0, 2);
//$month = substr($ddt, 3, 2);
//$year = substr($ddt, 6, 4);
$vl=split('/',$ddt);
$day = $vl[0];
$month = $vl[1];
$year = $vl[2];
return "$year-$month-$day";
}
else
{return ""; }
}


Class HtmlFormsObjects {
	
  function GenerateDropDownListauto($HtmlObjectName,$HtmlObjectDefaultValue,$DBFieldToValue,$DBFieldToDescription,$action,$onkeyp,$w,$t)
  {
 	 // onClick='$action' 	    
   global $result;
     	
   $w1=$w-20; 	 
   echo "<select id='$HtmlObjectName' name='$HtmlObjectName' onChange='$action' Onkeypress='$onkeyp'style='position:absolute; top:$t;z-index:0; width:$w; clip:rect(0px,$w, 22px, $w1);'> \n";
    	
   mysql_data_seek($result,0);
   echo "<option></option> \n";
   while ($rec = mysql_fetch_array($result))
   {  
    if($HtmlObjectDefaultValue == $rec["$DBFieldToValue"])
    {
     echo "<option selected value='".$rec[$DBFieldToValue]."'>$rec[$DBFieldToDescription]</option> \n";
    }
    else
    {
     echo "<option value='".$rec[$DBFieldToValue]."'>$rec[$DBFieldToDescription]</option> \n";
    }
   }
   echo "</select> \n";
  }      
	
function GenerateDropDownList($HtmlObjectName,$HtmlObjectDefaultValue,$DBFieldToValue,$DBFieldToDescription,$action,$onkeyp){
         global $result;
	 	 
         echo "<select id='$HtmlObjectName' name='$HtmlObjectName' onChange='$action' Onkeypress='$onkeyp'> \n";
         echo"<option>----</option>";
  	 mysql_data_seek($result,0);
         while ($rec = mysql_fetch_array($result)){  

                    if ($HtmlObjectDefaultValue == $rec["$DBFieldToValue"]){
                         echo "<option selected value='".$rec[$DBFieldToValue]."'>$rec[$DBFieldToDescription]</option> \n";
                    }
                    else{
                         echo "<option value='".$rec[$DBFieldToValue]."'>$rec[$DBFieldToDescription]</option> \n";
                    }
         }
         echo "</select> \n";
	 
      }
}

function dtom($ddt)
{
if ($ddt) {
$vl=split('/',$ddt);
$day = $vl[0];
$month = $vl[1];
$year = $vl[2];
return "$month/$day/$year";
}
else
{return ""; }
}

function mtod($ddt)
{
if ($ddt) {
$vl=split('-',$ddt);
$month = $vl[0];
$day = $vl[1];
$year = $vl[2];
return "$day/$month/$year";
}
else
{return ""; }
}
?>