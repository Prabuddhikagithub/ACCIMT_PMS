<html>
<head>
<link rel="shortcut icon" href="images/logo.ico" type="image/x-icon" />
<title>Districts</title>
<?php
session_start();
if (!isset($_SESSION['proclogin_type']))
{
header('Location: lgin.php');
}
require_once ("phpfncs/Database.php");
require_once ("phpfncs/Funcs.php");
$db =new DBOperations();
$fncs= new FRMOperations();
$divitionlist="new";
$BudYerLst="new";

if (isset($_POST['divitionlist']))
{
	$divitionlist=$_POST['divitionlist'];
}


?>
<script language="javascript" src="jss/Js_Funcs.js">
</script>
<link href="css/Css_file.css" rel="stylesheet" type="text/css">
</head>
<body onLoad="sessSet('DivBugReqRepo.php')" onClick="mytstfunc()">
<div id="wrapp">
 <form id="form1" name="form1" method="post" action="" >
  <table id="wrapped2" align="center" width="95%"  border="0" cellpadding="10" cellspacing="1">
   <caption>
   <h1>Buget Request From Divisions</h1>
   </caption>
   <tr>
    <td><table border="0" align="center">
      <tr>
       <th align="left">Divition</th>
       <th>:</th>
       <td><select name="divitionlist" id = "divitionlist" onChange="document.form1.submit()" >
	   <?php 
	   echo'<option value="new">Please Select a Divition</option>';
		$ress = $db->Exe_Qry("select * from division_tbl");
		while ($roww = $db->Next_Record($ress))
	    {
	        echo "<OPTION VALUE=".$roww["DivisionCode"].">".$roww["Division"]."</OPTION>";
		}
	   ?>
       <script language="javascript" type="text/javascript">
document.getElementById("divitionlist").value="<?php  echo $divitionlist;?>";
</script>
       </select></td>
      </tr>
      
   </table></td>
   </tr>
  </table>
  <br />
  <br />
  <table id="wrapped" align="center" cellspacing="3" cellpadding="5">
   <tr>
    <th>
    <table id="tbl_district" border="1"  align="center" style="font-size:16px;" >
    <tr>
    
    
    <th>Description</th>
    <th>Required Value</th>
    <th>Allowed Value</th>
    <th>Select </th>
    <th></th>
    
        </tr>
    <?php
	if($divitionlist=="new" && $BudYerLst=="new")
	{
		$ress=($db->Exe_Qry("SELECT * FROM div_budg_tbl;"));
	}
	else if($divitionlist!="new" && $BudYerLst=="new")
	{
		$ress=($db->Exe_Qry("SELECT * FROM div_budg_tbl WHERE div_code='$divitionlist';"));
	}
	else if($divitionlist=="new" && $BudYerLst!="new")
	{
		$ress=($db->Exe_Qry("SELECT * FROM div_budg_tbl WHERE budg_year='$BudYerLst';"));
	}
	else if($divitionlist!="new" && $BudYerLst!="new")
	{
		$ress=($db->Exe_Qry("SELECT * FROM div_budg_tbl WHERE div_code='$divitionlist' AND budg_year='$BudYerLst';"));
	}
	while ($roww = $db->Next_Record($ress))
	    {
			$rrrr=($db->Exe_Qry("SELECT Division FROM division_tbl WHERE DivisionCode='".$roww["div_code"]."';"));
			$rrrrr = $db->Next_Record($rrrr);
	        echo "<tr>

			<th>".$roww["user_descrip"]."</th>
			<th>".$roww["req_value"]."</th>
			<th>".$roww["all_value"]."</th>
			<th>".$roww["select"]."</th>
			<th>".$roww[""]."</th>
			
			</tr>";
		}
	?>
	</table>
    </th>
   </tr>
  </table>
 </form>
 <script language="javascript" type="text/javascript">
				document.getElementById("BudCodeLst").value = "<?php  echo $BudCodeLst;?>";
				if (document.getElementById("BudCodeLst").value != "<?php  echo $BudCodeLst;?>" || document.getElementById("BudCodeLst").value=="")
				{
					document.getElementById("BudCodeLst").value= "new";
					document.getElementById("Descript").value= "";
					document.getElementById("ReqAmunt").value= "";
					document.getElementById("btnAdd").disabled=false;
					document.getElementById("btnEdi").disabled=true;
					document.getElementById("btnDel").disabled=true;
				}
		</script>
 <br />
 <br />
</div>
</body>
</html>
