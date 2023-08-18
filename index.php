<?php
return;
$config_use_sessions = TRUE;  
session_start();

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
  sajax_export("save_ajax_check"); 
  sajax_handle_client_request();  

  /*  
  $te_fname='111';
  $te_paddress='2222';
  $te_email='abc@abc.com';
  $te_cno='3333';
  $te_checked='checked';
  */
  
  
if(isset($_POST['save']))
{
 $te_cusnam  = $_POST['fname'];
 $te_cusadd  = $_POST['paddress'];
 $te_cusemail = $_POST['email'];
 $te_custel   = $_POST['cno'];
 $te_cusq01yn = $_POST['cusq01yn'];
 $te_cusq02yn = $_POST['cusq02yn'];
 $te_cusq03yn = $_POST['cusq03yn'];
 $te_cusq04yn = $_POST['cusq04yn'];
 
 if(isset($_POST['cusq05_01_yn'])) 
 {
  $te_cusq05_01_yn='y';
 }
 else
 {
  $te_cusq05_01_yn='n';	 
 }
 
 if(isset($_POST['cusq05_02_yn'])) 
 {
  $te_cusq05_02_yn='y';
 }
 else
 {
  $te_cusq05_02_yn='n';	 
 }

 if(isset($_POST['cusq05_03_yn'])) 
 {
  $te_cusq05_03_yn='y';
 }
 else
 {
  $te_cusq05_03_yn='n';	 
 }
 if(isset($_POST['cusq05_04_yn'])) 
 {
  $te_cusq05_04_yn='y';
 }
 else
 {
  $te_cusq05_04_yn='n';	 
 }
 
 
 
 if( !isset($_SESSION["scustel"] ))
 {
  $_SESSION["scustel"] = "";
 }
 $_SESSION["scustel"] = $te_custel;
 
 $sql_cus = "SELECT cussno FROM cusmast WHERE custel='$te_custel'";    
 $result_cus = mysql_query($sql_cus);
 if(!mysql_num_rows($result_cus))
 {
  $te_cusenttime= strftime('%H:%M:%S');
  $te_cusentddt = strftime ("%Y-%m-%d");
  	 
  $sql_add = "INSERT INTO cusmast
    		      (cusnam,cusadd,cusemail,custel,
    		       cusq01yn,cusq02yn,cusq03yn,cusq04yn,
    		       cusq05_01_yn,cusq05_02_yn,cusq05_03_yn,cusq05_04_yn,
    		       cusentddt,cusenttime) 	
    		      VALUES 
    		      ('$te_cusnam','$te_cusadd','$te_cusemail','$te_custel',
    		       '$te_cusq01yn','$te_cusq02yn','$te_cusq03yn','$te_cusq04yn',
    		       '$te_cusq05_01_yn','$te_cusq05_02_yn','$te_cusq05_03_yn','$te_cusq05_04_yn',
    		       '$te_cusentddt','$te_cusenttime')";
  //echo "$sql_add<br>"; 		      
  $result_add = mysql_query($sql_add) or die("<h5>Could not Insert</h5>");
  
  header("Location: spin.php");
  return;

 }
 
 /*
 if( !isset($_SESSION["scustel"] ))
 {
  $_SESSION["scustel"] = "";
 }
 $_SESSION["scustel"] = $te_custel;
 
 $te=$_SESSION["scustel"];
 die('aaaa '.$te);
 header("Location: spin.php");
 return;
 */
}  
  
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spinning Wheel</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
        crossorigin="anonymous">
<script type="text/JavaScript" src="formvalidation.js"></script>        
<script language="JavaScript">
<?php
 sajax_show_javascript();
?>

function save_click()
{
 var fld =document.fn.fname
 if (chkBlank(fld,'Name') == false)
 {
  fld.focus();
  return false;
 }
 
 var fld =document.fn.paddress
 if (chkBlank(fld,'Address') == false)
 {
  fld.focus();
  return false;
 }

 var fld =document.fn.email
 if (chkBlank(fld,'Email') == false)
 {
  fld.focus();
  return false;
 }

 var fld =document.fn.cno
 if (chkBlank(fld,'Contact Number') == false)
 {
  fld.focus();
  return false;
 }
 
 
 
 var minlen = 10;
 var maxlen = 10;
 if (chklen(fld,minlen,maxlen) == false)	
 {
  fld.focus();	 
  return false;
 }

 
 
 var fld =document.fn.exampleCheck1
 if (fld)
 {
  if (fld.checked)
  {
  }	 
  else
  {
   alert("Pls tick terms")	  
   return false;
  }
 }
 
 if( document.getElementById('cusq01yn_y').checked == false && document.getElementById('cusq01yn_n').checked == false ) 
 {
  alert("Pls tick Qustion 1")	  
  return false;
 }
 
 if( document.getElementById('cusq02yn_y').checked == false && document.getElementById('cusq02yn_n').checked == false ) 
 {
  alert("Pls tick Qustion 2")	  
  return false;
 }
 
 if( document.getElementById('cusq03yn_y').checked == false && document.getElementById('cusq03yn_n').checked == false ) 
 {
  alert("Pls tick Qustion 3")	  
  return false;
 }
 
 if( document.getElementById('cusq04yn_y').checked == false && document.getElementById('cusq04yn_n').checked == false ) 
 {
  alert("Pls tick Qustion 4")	  
  return false;
 }
 
 
 
 
 
 save_ajax_check()
 alert('Checking The Contact Number ....Press enter')
 te_saveajax=document.fn.saveajax.value

 if(te_saveajax=='n')
 {
  alert('Contact Number Already in the System')
  document.fn.cno.focus()
  //return false;	  
 }
 
 return true;
}

//-------------- [ save_ajax_check() ] ---------------------------------//
function save_ajax_check() 
{
 var frm  = document.forms[0];
 var te_custel = document.fn.cno.value
 x_save_ajax_check(te_custel,save_ajax_check_x)

}

function save_ajax_check_x(str_)
{
 //alert(str_)
 //document.getElementById('debug').innerHTML = str_  // not working
 var frm = document.fn
 
 if(str_ == 'n')
 {
  document.fn.saveajax.value='n'
 }
 else
 {
  document.fn.saveajax.value='y'
 }
}

</script>        


        
</head>

<body>


    <!-- Modal -->
    <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <!-- <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"aria-hidden="true"> -->
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
    <h5 class="modal-title text-info" id="exampleModalLongTitle">
        Get ready for some great news! 🎉 To share the exciting win with you, we just need your contact details:
        <span style="color: red;">(Please provide a valid contact number and email address)</span>
    </h5>
</div>
                <div class="modal-body">
                    <form action="index.php" name="fn" method="post">

                        <div class="form-group">
                            <label id='debug'></label>
                            <label for="fName">Name with initials</label>
                            <input type="text" name="fname" class="form-control" aria-describedby="emailHelp"
                                placeholder="Enter the name with initials"
                                value="<?php echo $te_fname?>"
                             >
                                
                            <small id="emailHelp" class="form-text text-muted">We'll never share your Personal Data
                                with anyone else.</small>
                        </div>
                        <div class="form-group">
                            <label for="address">Permanent Address</label>
                            <input type="text" name="paddress" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" placeholder="Enter Permanent Address"
                                value="<?php echo $te_paddress?>"
                                >
                            <small id="emailHelp" class="form-text text-muted">We'll never share your Personal Data
                                with anyone else.</small>
                        </div>
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" name="email" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" placeholder="Enter email"
                                value="<?php echo $te_email?>"
                                >
                            <small id="emailHelp" class="form-text text-muted">We'll never share your Personal Data
                                with anyone else.</small>
                        </div>
                        <div class="form-group">
                            <label for="email">Contact Number</label>
                            <input type="number" name="cno" class="form-control" id=""
                                aria-describedby="emailHelp" placeholder="Enter contact number"
                                value="<?php echo $te_cno?>"
                                >
                            <small id="" class="form-text text-muted">We'll never share your Personal Data with
                                anyone else.</small>
                        </div>
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" name="exampleCheck1" id="exampleCheck1"
                            <?php echo $te_checked?>
                            >
                            <label class="form-check-label"
                                for="exampleCheck1">By checking this box I acknowledge that I wish to know about New
                                Anthoney's Products and Promotions via E-mail or SMS in the future.</label>
                        </div>
                        <hr>
                        <p class="text-info">Questionnaire</p>
                        <hr>
                        <!-- Question 1 -->
                            <div class="form-group">
                                <label>1. Do you know about New Anthony's Chicken? ඔබ නිව් ඇන්තනීස් චිකන් ගැන දන්නවාද?</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="cusq01yn" id="cusq01yn_y" value="yes">
                                    <label class="form-check-label">Yes</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="cusq01yn" id="cusq01yn_n" value="no">
                                    <label class="form-check-label">No</label>
                                </div>
                            </div>
                            <!-- Question 2 -->
                            <div class="form-group">
                                <label>2. Did you know that our products are free of antibiotics, hormones and chemicals? අප නිශ්පාදන ප්‍රතිජීවක, හෝර්මෝන්ස් හා රසායන ද්‍රව්‍ය වලින් තොර බව දන්නවාද ?</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="cusq021yn" id="cusq02yn_y" value="yes">
                                    <label class="form-check-label">Yes</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="cusq02yn" id="cusq02yn_n" value="no">
                                    <label class="form-check-label">No</label>
                                </div>
                            </div>
                            <!-- Question 3 -->
                            <div class="form-group">
                                <label>3. "GHG certificate" and "fed with sustainable US SOY" Did you know that New Anthony's Chicken is equipped with the above status certificates? ඉහත සඳහන් තත්ව සහතික වලින් නිව් ඇන්තනීස් චිකන් සමන්විත බව ඔබ දන්නවාද?</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="cusq03yn" id="cusq03yn_y" value="yes">
                                    <label class="form-check-label">Yes</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="cusq03yn" id="cusq03yn_n" value="no">
                                    <label class="form-check-label">No</label>
                                </div>
                            </div>
                            <!-- Question 4 -->
                            <div class="form-group">
                                <label>4. Did you know that we use the latest technology available in the world for our products? අප නිශ්පාදන සඳහා ලෝකයේ දැනට පවතින නවීනම තාක්ෂණිය භාවිතා කරන බව ඔබ දන්නවාද?</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="cusq04yn" id="cusq04yn_y" value="yes">
                                    <label class="form-check-label">Yes</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="cusq04yn" id="cusq04yn_n" value="no">
                                    <label class="form-check-label">No</label>
                                </div>
                            </div>

                            <!-- Multi-choice question 5 -->
                            <div class="form-group">
                                <label for="productTaste">5. Which of these products brought you the closest taste? මේ අතුරින් ඔබට වඩාත් සමීප රසයක් ගෙන දුන් නිශ්පාදන මොනවාද?</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" name="cusq05_01_yn">
                                        <label class="form-check-label" for="defaultCheck1">
                                            CRIZZPY'S
                                        </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" name="cusq05_02_yn" >
                                        <label class="form-check-label" for="defaultCheck2">
                                            CRUSTYS
                                        </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" name="cusq05_03_yn">
                                        <label class="form-check-label" for="defaultCheck1">
                                            FRENCHYS
                                        </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" name="cusq05_04_yn" >
                                        <label class="form-check-label" for="defaultCheck2">
                                        CHICO
                                        </label>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <div class="form-check">
                                    <label class="form-check-label" for="acceptTerms">By submitting,<a href="#" data-toggle="modal" data-target="#termsModal"> I accept the game terms and conditions.</a></label>
                                </div>
                                <button type="submit" name="save" class="btn btn-primary" onClick="return save_click();">Submit</button>
                                <input type='hidden' name='saveajax' value=''></input>
                            </div>
                    </form>
                    <br>

                </div>
            </div>
        </div>
    </div>

 <div class="modal fade" id="termsModal" tabindex="-1" role="dialog" aria-labelledby="termsModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        
                    </button>
                </div>
                <div class="modal-body">
                    
                    <p>1. Eligibility:</p>
                    <p>The Game is open to anyone. But employees, affiliates, agents, and immediate family members of  New Anthoney's Farms (Pvt) Ltd. are not eligible to participate.</p>

                    <p>2. Prizes:</p>
                    <p> Please provide a valid contact number and email address that belong to you. This is important for prize redemption.</p>

                    <p>3. Prizes:</p>
                    <p>Prizes are awarded based on chance and luck. Prizes include discount vouchers from Dorakadapaliya, Meetlary, and Airpod. </p>
                    
                    <p>4. Prize Redemption:</p>
                    <p>Winners will be notified on-screen immediately after the spin. To claim a prize, winners must follow the instructions provided during the notification. Prizes are non-transferable and cannot be exchanged for cash or other alternatives.</p>
                
                    <p>5. Termination or Modification:</p>
                    <P>We reserve the right to modify, suspend, or terminate the Game at any time, without notice. We also reserve the right to disqualify participants who violate these Terms and Conditions or engage in fraudulent or abusive behavior.</p>
                    
                    <p>6. Limitation of Liability:</p>
                    <p>We are not responsible for any technical malfunctions, errors, or omissions related to the Game. Participants acknowledge that participation is at their own risk, and We are not liable for any losses, damages, or injuries arising from participation in the Game.</p>
                    
                    <p>7. Intellectual Property:</p>
                        <P>All content and materials related to the Game, including but not limited to graphics, text, and software, are protected by copyright and other intellectual property laws. You may not reproduce, distribute, or modify any part of the Game without Our prior written consent.</p>
                    
                    <p>8. Changes to Terms:</p>
                        <p>We reserve the right to update or modify these Terms and Conditions at any time. It is your responsibility to review these terms periodically for changes.Last updated: [04/08/2023]</p>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="closeModalAndGoBack()">Close</button>
                </div>
            </div>
    </div>
 </div>
 
 
  

  <!-- SweetAlert2 library -->

 

 
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
      integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
      crossorigin="anonymous"></script>
      
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"
      integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
      crossorigin="anonymous"></script>
  
  <!-- Separate JavaScript file for custom code -->
  <!-- importing the js  -->
  <script src="script.js"></script>
  <script>
      $(document).ready(function () {
          $('#exampleModalLong').modal('show');
      });
  </script>
  
</div>
</body>

</html>

<?php
function save_ajax_check($te_custel)
{
 $te_return = ""; 	 	
 $te_flg = 'y';
 $sql_ = "select cussno from cusmast where custel='$te_custel' ";
 //return "$sql_"; 
 $result_ = mysql_query($sql_) or die("SQL Error : sql_ <br>".mysql_error());
 if(mysql_num_rows($result_))
 {
  $te_flg = 'n';
 }
 return $te_flg;
}
?>
