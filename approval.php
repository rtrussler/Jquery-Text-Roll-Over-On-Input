<?php require_once('Connections/con_vow.php'); ?>
<?php include('prehead_chk_level.php');
 include('selected.php'); ?>
<?php require ('PHPMailer/PHPMailerAutoload.php'); ?>
<?php include ('functions.php')?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

include ('includes/sql_update_referrals.php');

$thisPartner = $row_shwReferrals['partner'];

mysql_select_db($database_con_vow, $con_vow);
$query_selPartner = "SELECT * FROM partners WHERE partnerid = '$thisPartner'";
$selPartner = mysql_query($query_selPartner, $con_vow) or die(mysql_error());
$row_selPartner = mysql_fetch_assoc($selPartner);
$totalRows_selPartner = mysql_num_rows($selPartner);

$displayPartner = $row_selPartner['tier1'];

mysql_select_db($database_con_vow, $con_vow);
$query_gprimary = "SELECT * FROM `primary`";
$gprimary = mysql_query($query_gprimary, $con_vow) or die(mysql_error());
$row_gprimary = mysql_fetch_assoc($gprimary);
$totalRows_gprimary = mysql_num_rows($gprimary);


mysql_select_db($database_con_vow, $con_vow);
$query_prodlist = "SELECT * FROM products";
$prodlist = mysql_query($query_prodlist, $con_vow) or die(mysql_error());
$row_prodlist = mysql_fetch_assoc($prodlist);
$totalRows_prodlist = mysql_num_rows($prodlist);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="jquery/css/hot-sneaks/jquery-ui-1.10.3.custom.css" rel="stylesheet">
  <link rel="stylesheet" href="foundation-5.0.2/css/normalize.css">
  <link rel="stylesheet" href="foundation-5.0.2/css/foundation.css">
  <link rel="stylesheet" href="style/custom.css">
<script src="foundation-5.0.2/js/modernizr.js"></script>
<script src="jquery/js/jquery-1.9.1.js"></script>
<script src="jquery/js/jquery-ui-1.10.3.custom.js"></script>
<script src="jquery-lo.js"></script>
<script src="calcs/calcs.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/dojo/1.6.1/dojo/dojo.xd.js"  data-dojo-config="isDebug: true,parseOnLoad: true"></script>
<script type="text/javascript" src="parsley/parsley.js"></script>
<script type="text/javascript" src="jquery/jquery-timepicker-master/jquery.timepicker.js"></script>
<script type="text/javascript" src="autocomplete.js"></script>
<script src="jquery.uploadfile.min.js"></script>
<script src="edit_selector.js"></script>
<link href="uploadfile.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="jquery/jquery-timepicker-master/jquery.timepicker.css" />

    
    
<script>
	 $(function() {
    $( ".datepicker" ).datepicker({ dateFormat: "yy-mm-dd" });
  	});
	</script>
    

</head>
<body>
	<script src="foundation-5.0.2/js/foundation/foundation.js"></script>
	<script src="foundation-5.0.2/js/foundation/foundation.topbar.js"></script>
	<script>$(document).foundation();</script>
<!-- NAV BAR -->
<?php include('includes/navbar_inc.php');?>
<?php
$lp = $row_selPartner['logopath'];
$lo = $row_selPartner['logo'];
$flogo = $lp . $lo;
?>
<!-- Tabs -->
<div class="row">
	<div class="large-4 columns">
	<img width="150px" src="images/logo.png" style="float: left; padding-top: 2em;">
	</div>
	
	<div class="large-4 columns" id='partnerLogo' name='partnerLogo' align='center'>
	<?php if ($flogo != ''){?>
	<img src="uploads/<?php echo $flogo?>" width="250px" style="padding-left: auto; padding-right: auto; margin-top: 20px;">
	<?php }?>
	</div>
	
	
	<div class="large-4 columns">
	<h2 class="demoHeaders" style="float: right;">Create Referral</h2>
	</div>
	
</div>

<div class="row">
  <form action="<?php echo $editFormAction; ?>" method="POST" name="form1" id="form1" parsley-validate>
  
    <div id="tabs-1">
      <?php include('tabs/tab1app.php');?>
    </div>
    <div id="tabs-2">
      <?php include('tabs/tab2app.php');?>
    </div>
    <div id="tabs-3">
      <?php include('tabs/tab3app.php');?>
    </div>
    <div id="tabs-4">
      <?php include('tabs/tab4app.php');?>
    </div>
    <div id="tabs-5">
      <?php include('tabs/tab5app.php');?>
    </div>
    <div id="tabs-6">
      <?php include('tabs/tab6.php');?>
    </div> 
</div>

<div class="row">
    
    
    <div class="large-8 columns">
      <label>
      <h5>Customer Notes</h5>
      </label>
      <textarea rows="10" name ="notes" id="notes" placeholder="Enter Customer Notes Here"><?php echo $row_shwReferrals['notes']; ?></textarea>
    </div>
    
    
    
    
    <div class="large-4 columns" align="center" style="padding-top: 35px;">
      <input type="hidden" name="MM_insert" value="form1" />
      <div class="row">
       <div class="row">
       <div class"large-6 olumns">
      	<?php if ($level == 'officescapeadmin')
			{
			?>
			<div class='large-6 columns'><input <?php  if ($row_shwReferrals['noaction'] === 'yes') echo 'checked="checked"'; ?> type='checkbox' id='noaction' name='noaction' value='yes' /><label for='noaction'>No Further Action</label></div>
			<?php 
            }
			else
			{
				}
		?>
        </div>
        </div>
      	
                
      
      	 <div class="row">
         		
                
                
                
            	<div class="large-6 columns">
                <label for="datetocall">Date to Call<label>
            	<input type="text" id="datetocall" name="datetocall" class="in" placeholder="Date To Call" value="<?php echo $row_shwReferrals['datetocall']; ?>"/>
                </div>
                
                <div class="large-6 columns">
                <label for="timetocall">Time to Call<label>
                <input type="text" id="timetocall" name="timetocall" class="in" placeholder="Time To Call" value="<?php echo $row_shwReferrals['timetocall']; ?>">
                <input type="hidden" name="confemailsent" value="<?php echo $row_shwReferrals['confemailsent']; ?>">
                </div>
         		
      
        
        
        
        <?php
       	if ($level=='vowadmin')
			{
        	echo "<input type='hidden' id='vowconfirmed' name='vowconfirmed' value='yes'>";
			}
		else
			{
			echo "<input type='hidden' id='vowconfirmed' name='vowconfirmed' value='" . $row_shwReferrals['vowconfirmed'] . "'>";
			}
			
		if ($level=='officescapeadmin')
			{
			echo "<label for='officescapeconfirmed'>Ready for Approval?</label>
					<select id='officescapeconfirmed' name='officescapeconfirmed' onchange='buttonDisplay();'>
  						<option value='yes'>Yes - Send Approval Now</option>
  						<option value='no' selected='selected'>No - Save as Draft</option>
					</select>
				";
			}	
		else
			{
			echo "<input type='hidden' id='officescapeconfirmed' name='officescapeconfirmed' value='" . $row_shwReferrals['officescapeconfirmed'] . "'>";	
				}
		?>
        
        
		
        <input type="hidden" id="confdate" name="confdate" value="">
        
        <script>
		
		var d = new Date();
		var curr_date = d.getDate();
		var curr_month = d.getMonth();
		curr_month++;
		var curr_year = d.getFullYear();
		//var d1 = (curr_date + "/" + curr_month + "/" + curr_year);
		var d1 = (curr_year + "-" + curr_month + "-" + curr_date);
		
		var chkforDateEntryvow = document.getElementById('vowconfirmed').value;
		var chkforDateEntryos = document.getElementById('officescapeconfirmed').value;
		
		if (chkforDateEntryvow =='no' || chkforDateEntryos == 'no')
			{
			
			}
			else{
				document.getElementById('confdate').value = d1;
				}
		
		</script>
       
      </div>
      
      <div class="row">
      
      <div class="large-12 columns">
      
      
       <label for="partner">Select Partner</label>
			 
			<?php 
			if ($level == 'vowadmin')
			{
			?>
			<label for="partner">Partner</label>
			<input type="text" name='psalesdisplayvow' id=psalesdisplayvow class="hideme" value='<?php echo $row_selPartner['tier1'];?>'>
			<input type='hidden' name='psales' id='psales' class='hideme' value="<?php echo  $row_shwReferrals['partner']; ?>"">
			<input type='text' name='psales' id='psales' class='hideme' value="<?php echo  $row_shwReferrals['psales']; ?>"">
			<?php
			}
			else
			{
			?> 
			 <label for="partner">Select Partner</label>
			 <select name="partner" id ='partner' size="1">
			   <?php $ref_edit= $_GET['refid']; ?>
    		   <?php getTierOne($ref_edit); ?>
              <select>
            
            <input type='text' name='psales' id='psales' class='hideme' value="<?php echo  $row_shwReferrals['psales'] ?>"">
            <div class='row'>
             	<span id="wait_1" style="display: none;">
   			 	<img alt="Please Wait" src="ajax-loader.gif"/>
    			</span>
    		<span id="result_1" style="display: none;"></span> 
      
  			<?php }?>    
      
      
      
      
      
      
		</div>     
      </div>
      <!-- <input type="submit" value="Insert record" /> -->
      <div class="row">
      
      <?php
	  
	  $partemail = $row_shwReferrals['partneremailsent'];
      if ($partemail == 'no')
	  		{	
				
			
			
			?>
            
            <script>
			function buttonDisplay()
				{
				conf = document.getElementById('officescapeconfirmed').value
					
					if (conf =='yes')
						{
						
						document.getElementById('app').innerHTML = 'Approve'
						console.debug('confirmed value =' + conf)
						
						}
						
					else
					
						{
						document.getElementById('app').innerHTML = 'Save Draft'
						console.debug('confirmed value =' + conf)	
						}
				}
				
			buttonDisplay();
			</script>
           
            
                <div class="large-6 columns">
                
                <?php if ($level == 'vowadmin')
				
					{
					
					echo "<button id='app'>Approve</button>";
					
					}
					else
					{
						
						echo "<button id='app'>Save Draft</button>";
						}
					?>
                
                
                
                <input type="hidden" name="MM_update" value="form1" />
                </form>
                </div>  
	   		
			
			
			
			
			
			
			<?php
            }
			
			
			
			
			
			
		else {
			}
	  ?>
      
       
       <div class="large-6 columns"> 
 		<a href="archive.php"><img src="images/cancel.png"></a>
       </div> 
      </div>
      <!-- <a href="#" class="button [secondary success alert radius round]">Send</a> -->
    </div>
  </div>
</div>
<!-- NAV BAR BOTTOM -->
<?
if ($level == 'vowadmin')
	{
	echo ("<style>");
	echo (".showadmin {display: block;}");
	echo (".hideadmin {display: none;}");
	echo ("</style>");
	?>
	<script>
	$(':input').attr('readonly','readonly');
	</script>	
	<?
    }
	
	else
	{
	echo ("<style>");
	echo (".showadmin {display: none;}");
	echo (".hideadmin {display: block;}");
	echo ("</style>");			
	}
	
	 $attachid = $row_shwReferrals['attachmentid'];
     $logoname = $row_shwReferrals['logo'];
?>
<input type="hidden" name="attachmentid" id="attachmentid" value="<?php echo $attachid; ?>">

<script>

	
var attid = document.getElementById('attachmentid').value;
if (attid !=''){
	// document.getElementById('attachmentid').value = "<?php echo $attachid; ?>";
	// console.debug('Attachment Id has already been Set to = ' + "<?php echo $attachid; ?>" );
	uploadDir = attid;
	}
	else{
		uniqueId = new Date().getTime();
		uploadDir = uniqueId;
		document.getElementById('attachmentid').value = uniqueId;
		// console.debug("unique id =" + uploadDir);
		}
console.debug('logo name = ' + "<?php echo $logoname?>");
if ('<?php echo $logoname; ?>' !=''){
	document.getElementById('logofn').value = "<?php echo $logoname; ?>";
	// console.debug('Attachment Id has already been Set to = ' + "<?php echo $attachid; ?>" );
	}
	else{
		
		}
</script>

<script>
$(document).ready(function()
{
var settings = {
	//uploadDir = document.getElementById('attachmentid').value;
    url: "upload.php?uploadDir=" + uploadDir,
    dragDrop:true,
    fileName: "myfile",
    allowedTypes:"jpg,png,gif,doc,pdf,zip docx,xls,xlsx,csv,txt",	
    returnType:"json",
	onSuccess:function(files,data,xhr)
    {
       // alert((data));
    },
    showDelete:false,
    deleteCallback: function(data,pd)
	{
    for(var i=0;i<data.length;i++)
    {
        $.post("delete.php",{op:"delete",name:data[i]},
        function(resp, textStatus, jqXHR)
        {
            //Show Message  
            $("#status").append("<div>File Deleted</div>");      
        });
     }      
    pd.statusbar.hide(); //You choice to hide/not.

}
}
var uploadObj = $("#mulitplefileuploader").uploadFile(settings);


});

$(document).ready(function()
	{
		var logo = 
		{
			url: "upload.php?uploadDir=" + uploadDir + "/logo",
			dragDrop:true,
			fileName: "myfile",
			allowedTypes:"jpg,png,gif,jpeg",	
			returnType:"json",
			onSuccess:function(files,data,xhr)
			{
			   // alert((data));
			},
			showDelete:false,
			deleteCallback: function(data,pd)
			{
			for(var i=0;i<data.length;i++)
			{
				$.post("delete.php",{op:"delete",name:data[i]},
				function(resp, textStatus, jqXHR)
				{
					//Show Message  
					$("#status").append("<div>File Deleted</div>");      
				});
			 }      
			pd.statusbar.hide(); //You choice to hide/not.
		
		}
		
		
		
	}


var uploadObj = $("#logo").uploadFile(logo);

});


</script>
<script>
dopageload();
rwt1()
</script>
</body>
</html>
<?php
mysql_free_result($shwPartners);

mysql_free_result($shwReferrals);
?>

