<html>
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/menustyle.css">
<link href="css/reportstyle.css" rel="stylesheet">
<link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">   
<script type="text/javascript" src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script type="text/javascript" src="http://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="http://cdn.datatables.net/1.10.2/css/jquery.dataTables.min.css"></style>


<!-- Next Control Focus !-->

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" type="text/javascript"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/knockout/knockout-2.2.1.js" type="text/javascript"></script>

<!-- Next Control Focus Ended !-->

<!-- Sweet Alert !-->

 <script src="js/sweetalert-dev.js"></script>
 <link rel="stylesheet" href="css/sweetalert.css">

<!-- Sweet Alert Ended!-->

<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script> 
<!-- <script src="js/snowfall.js"></script>  !-->

<!-- Filter Text Box !-->

<script type="text/javascript">
$(document).ready(function () {

    (function ($) {

        $('#filter').keyup(function () {

            var rex = new RegExp($(this).val(), 'i');
            $('.searchable tr').hide();
            $('.searchable tr').filter(function () {
                return rex.test($(this).text());
            }).show();

        })

    }(jQuery));

});
</script>

<!-- Filter Text Box Ended !-->
<script>

// JavaScript popup window function
	function basicPopup(url) {
popupWindow = window.open(url,'popUpWindow','height=600,width=900,left=25,top=20,resizable=yes,scrollbars=yes,toolbar=no,menubar=no,location=no,directories=no, status=yes')
	}
function parent_disable() {
if(popupWindow && !popupWindow.closed)
popupWindow.focus();
}
function PrintDiv() 
      {    
       var divToPrint = document.getElementById('divToPrint');
       var popupWin = window.open('', '_blank', 'width=800,height=600');
       popupWin.document.open();
       popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
       popupWin.document.close();
      }
</script>
<style>


<!-- Style is used for alert Messages !-->
<style>
.alert{
  -webkit-animation: seconds 1.0s forwards;
  -webkit-animation-iteration-count: 1;
  -webkit-animation-delay: 5s;
  animation: seconds 1.0s forwards;
  animation-iteration-count: 1;
  animation-delay: 5s;
    position: absolute;
    bottom: 0px;
    right: 25px;
  background: blue;
}
@-webkit-keyframes seconds {
  0% {
    opacity: 1;
  }
  100% {
    opacity: 0;
    left: -9999px; 
  }
}
@keyframes seconds {
  0% {
    opacity: 1;
  }
  100% {
    opacity: 0;
    left: -9999px; 
  }
}
</style>

<!-- Alert Style to be ended !-->
 <script type="text/javascript">     
function RefreshPage() {
    location.reload();
}
function confirm_edit() {
  return confirm('Would you Like to Edit ?');
}
function confirm_confirm() {
  return confirm('Would you Like to Confirm?');
}
function confirm_delete() {
  return confirm('Would you Like to Delete ?');
}


</script>
</html>
<?php
//INCLUDES
date_default_timezone_set('Asia/Calcutta');
include 'config.php';
include '../session.php';
/*
$now = time(); // Checking the time now when home page starts.
if ($now > $_SESSION['expire']) 
{ 
            session_destroy();
            echo "Your time limit expired!";
            echo  "<a href='../login.php'>Login here</a>";
}*/
$GLOBALS ['xEbName']='';
$GLOBALS ['xEbShortName']='';
$GLOBALS['xEmpDepartment']='';
$GLOBALS ['xMode']='';
$GLOBALS ['xCurrentDate']=date('Y-m-d');
$GLOBALS ['xCurrentDateTime']=date('Y-m-d H:i:s');
$GLOBALS['xEmpDepartment'] = '';

$GLOBALS['xExpGroupName'] = '';
$GLOBALS['xStockPointName']='';
$GLOBALS ['xItemCategoryNo']='';
$GLOBALS ['xItemGroupNo']='';
$GLOBALS ['xItemSubGroupNo']='';
$GLOBALS ['xDoctorName'] ='';
$GLOBALS ['xSingleEmployeeTotalFineAmount']=0;
$GLOBALS ['xCurrentUser'] =$_SESSION['login_user'];
$GLOBALS ['xCurrentUserRole'] =$_SESSION['login_user_role'];
$GLOBALS ['xCurrentUserDepartment'] =$_SESSION['login_department'];
$GLOBALS['xDepartmentColor']="#ffffff";//Default Color- White
ExecuteFilter();
getdepartmentno();
getconfigvalues();
getconfig_inventoryvalues();
getconfig_suppliervalues();
getconfig_ecgxrayvalues();
getconfig_datetime();
getconfig_purchase();
getconfig_sales();
getconfig_complaint();

/*      -------------------- General Messages ------------------------------*/

function ShowAlert($msg) 
{
    echo '<div class=alert>';
    echo '<font color=white>';
    echo '<b>';
    echo "Records " .$msg . " Succesfully";
    echo '</b>';
    echo '</font>';
    echo '</div>';
}

function fn_NoDataFound()
{
 echo '<tr bgcolor=red>';
 echo '<td colspan=3, > NO RESULTS WERE FOUND</td>';
 echo '</tr>';
}

/*       -------------------- Report Header ------------------------------*/

function ReportHeader($xTitle)
{
include '../session.php';
if($login_session=="admin")
{
$xFromDate= date('d/F/Y', strtotime($GLOBALS ['xFromDate']));   
$xToDate= date('d/F/Y ', strtotime($GLOBALS ['xToDate']));   
}
else
{
    //Current Date Changed - Bug - Find - 06 Oct 2019
    $xFromDate= date('d/F/Y', strtotime($GLOBALS ['xFromDate']));   
$xToDate= date('d/F/Y ', strtotime($GLOBALS ['xToDate']));  
//$xFromDate= date('d/F/Y', strtotime($GLOBALS ['xCurrentDate']));   
//$xToDate= date('d/F/Y ', strtotime($GLOBALS ['xCurrentDate']));   
}

echo '<pre>'; 
echo '<b>';
echo '<center>';
echo "Lakshmi Hospital,Udayarpatti,Tirunelveli" ;
echo '</br>'; 
echo "REPORT NAME ==>$xTitle   " ;
echo '</br>'; 

echo  "FROM DATE : $xFromDate              TO DATE :  $xToDate                   Printed At : ". date(" d/F/Y h:i A l");
echo '</center>';
echo '</pre>'; 
echo '</br>'; 
echo '</b>'; 
echo '</pre>'; 

}



function getdepartmentno() {
  $result = mysql_query("SELECT *  FROM config") or die(mysql_error());
  while ($row = mysql_fetch_array($result)) {
    $GLOBALS['xDepartmentNo'] = $row['departmentno'];
    $GLOBALS['xEmployeeNo'] = $row['employeeno'];
    $GLOBALS['xFromDate'] = $row['fromdate'];
    $GLOBALS['xToDate'] = $row['todate'];
    $GLOBALS['xStatus'] = $row['status'];
    $GLOBALS['xDays'] = $row['days'];
  }
}

/*       -------------------- Get Employe Name ------------------------------*/

function findempname($xNo) {
  $result = mysql_query("SELECT *  FROM employeedetails where txno=$xNo") or die(mysql_error());
  while ($row = mysql_fetch_array($result)) {
    $GLOBALS['xEmpName'] = $row['empname'];

  }
}

/*       -------------------- Get Employee Fine Amount ------------------------------*/

function getemployeefineamount($xNo,$xFrom,$xTo)
{
$xQry="SELECT sum(fineamount) as fineamount  FROM t_finedetails where employeeno=$xNo and date>='$xFrom' and date<='$xTo'";
  $result = mysql_query ($xQry) or die ( mysql_error () );
  while ( $row = mysql_fetch_array ( $result ) ) 
   {
     $GLOBALS ['xSingleEmployeeTotalFineAmount'] = $row ['fineamount'];
   }
}

/*       -------------------- Get Department Name ------------------------------*/

function finddepartmentname($xNo) {
  $result = mysql_query("SELECT *  FROM m_department where departmentno=$xNo") or die(mysql_error());
  while ($row = mysql_fetch_array($result)) {
    $GLOBALS['xEmpDepartment'] = $row['departmentname'];
    $GLOBALS['xDepartmentColor'] = $row['departmentcolor'];
  }
}

/*       -------------------- Maximum O/P ID ------------------------------*/

function GetMaxIdNoForOP() {
$result = mysql_query ( "SELECT  CASE WHEN max(txno)IS NULL OR max(txno)= '' THEN '1' ELSE max(txno)+1 END AS txno FROM outpatientdetails" ) or die ( mysql_error () );
while ( $row = mysql_fetch_array ( $result ) ) 
	{
	$GLOBALS ['xMaxIdForOp'] = $row ['txno'];
}
 }


/*       -------------------- Config Table Records ------------------------------*/

function ExecuteFilter()
{
$result = mysql_query ( "SELECT *  FROM config" ) or die ( mysql_error () );
while ( $row = mysql_fetch_array ( $result ) ) 
{
$GLOBALS ['xFromDate']=$row ['fromdate'];
$GLOBALS ['xToDate']=$row ['todate'];
$GLOBALS ['xAcNo']=$row ['acno'];
$GLOBALS ['xAcType']=$row ['actype'];
			}
}

function getconfigvalues()
{
  $result = mysql_query ( "SELECT *  FROM config" ) or die ( mysql_error () );
  while ( $row = mysql_fetch_array ( $result ) )
   {
    $GLOBALS ['xFromDate']=$row ['fromdate'];
    $GLOBALS ['xToDate']=$row ['todate'];
    $GLOBALS ['xEbNo']=$row ['ebno'];
    findebname($row ['ebno']);
    $GLOBALS ['xDoctorNo']=$row ['doctorno'];
    finddoctorname($row ['doctorno']);
    $GLOBALS ['xExGrpNo']=$row ['expgroupno'];
    findexpensesgroupname($row ['expgroupno']);
    finddepartmentname($row ['departmentno']);
    findempname($row ['employeeno']);
    $GLOBALS['xEmpNo']=$row ['employeeno'];
    $GLOBALS ['xItemCategoryNo']=$row ['itemcategoryno'];
    $GLOBALS ['xItemGroupNo']=$row ['itemgroupno'];
    $GLOBALS ['xItemSubGroupNo']=$row ['itemsubgroupno'];
    $GLOBALS ['xEcgXrayType']=$row ['ecgxraytype'];
    $GLOBALS ['xEcgFlimType']=$row ['ecgflimtype'];
    $GLOBALS ['xEcgSection']=$row ['ecgsection'];
    $GLOBALS ['xNoonType']=$row ['opnoontype'];
    $GLOBALS ['xCaseType']=$row ['opcasetype'];
    $GLOBALS ['xCaseType1']=$row ['opcasetype1'];
    $GLOBALS ['xOpStatus']=$row ['opstatus'];
    $GLOBALS ['xFromTokenNo']=$row ['fromtokenno'];
    $GLOBALS ['xToTokenNo']=$row ['totokenno'];
    $GLOBALS ['xTestTypeNo']=$row ['testtypeno'];
   }
}

/*       -------------------- Config Inventory Table Records ------------------------------*/

function getconfig_inventoryvalues()
{
  $result = mysql_query ( "SELECT *  FROM config_inventory" ) or die ( mysql_error () );
  while ( $row = mysql_fetch_array ( $result ) )
   {
    $GLOBALS ['xItemCategoryNo']=$row ['categoryno'];
    $GLOBALS ['xItemGroupNo']=$row ['groupno'];
    $GLOBALS ['xItemSubGroupNo']=$row ['subgroupno'];
    $GLOBALS ['xStockPointNo']=$row ['stockpointno'];
    $GLOBALS ['xSupplierNo']=$row ['supplierno'];
    $GLOBALS ['xViewStockPoint']=$row ['v_stockpoint'];
    $GLOBALS ['xViewCategory']=$row ['v_category'];
    $GLOBALS ['xViewGroup']=$row ['v_group'];
    $GLOBALS ['xViewSubGroup']=$row ['v_subgroup'];
    $GLOBALS ['xViewBrandNo']=$row ['v_brandno'];
    $GLOBALS ['xViewModelNo']=$row ['v_modelno'];
    $GLOBALS ['xViewSerialNo']=$row ['v_serialno'];
    $GLOBALS ['xViewFunctionOfWorks']=$row ['v_functionofworks'];
    $GLOBALS ['xViewAccessories']=$row ['v_accessories'];
    $GLOBALS ['xViewConditions']=$row ['v_conditions'];
    $GLOBALS ['xViewRemarks']=$row ['v_remarks'];
    $GLOBALS ['xViewAmcOnly']=$row ['v_amconly'];
    $GLOBALS ['xBetweenDateFilterBy']=$row ['filterdateby'];
    $GLOBALS ['xInvFromDate']=$row ['fromdate'];
    $GLOBALS ['xInvToDate']=$row ['todate'];
    $GLOBALS ['xItemNo']=$row ['itemno'];
    $GLOBALS ['xComplaintPaymentStatus']=$row ['complaintpaymentstatus'];
   }
}


/*       -------------------- Config Ecg-Xray Table Records ------------------------------*/


function getconfig_ecgxrayvalues()
{
  $result = mysql_query ( "SELECT *  FROM config_ecgxray" ) or die ( mysql_error () );
  while ( $row = mysql_fetch_array ( $result ) )
   {
    $GLOBALS ['xViewTxNo']=$row ['v_txno'];
    $GLOBALS ['xViewDate']=$row ['v_date'];
    $GLOBALS ['xViewSection']=$row ['v_section'];
    $GLOBALS ['xViewAge']=$row ['v_age'];
    $GLOBALS ['xViewEcgxRayDoctorNo']=$row ['v_doctorno'];
    $GLOBALS ['xViewFilmType']=$row ['v_filmtype'];

   }
}

/*       -------------------- Config Supplier Table Records ------------------------------*/

function getconfig_suppliervalues()
{
  $result = mysql_query ( "SELECT *  FROM config_supplier" ) or die ( mysql_error () );
  while ( $row = mysql_fetch_array ( $result ) )
   {
    $GLOBALS ['xViewAddress']=$row ['v_address'];
    $GLOBALS ['xViewMobileNo']=$row ['v_mobileno'];
    $GLOBALS ['xViewEmailId']=$row ['v_emailid'];
    $GLOBALS ['xViewTaxNo']=$row ['v_taxno'];
    $GLOBALS ['xViewRegisterNo']=$row ['v_registerno'];
   }
}

/*       -------------------- Config Date& Time Table Records ------------------------------*/

function getconfig_datetime()
{
  $result = mysql_query ( "SELECT *  FROM config_datetime" ) or die ( mysql_error () );
  while ( $row = mysql_fetch_array ( $result ) )
   {
    $GLOBALS ['xViewCreatedAsOn']=$row ['v_createdason'];
    $GLOBALS ['xViewUpdatedAsOn']=$row ['v_updatedason'];
   }
}

/*       -------------------- Config Purchase Table Records ------------------------------*/


function getconfig_purchase()
{
  $result = mysql_query ( "SELECT *  FROM config_purchase" ) or die ( mysql_error () );
  while ( $row = mysql_fetch_array ( $result ) )
   {
    $GLOBALS ['xViewPurInvoiceNo']=$row ['v_purchaseinvoiceno'];
    $GLOBALS ['xViewPurDate']=$row ['v_date'];
    $GLOBALS ['xViewPurCompanyInvoiceNo']=$row ['v_companyinvoiceno'];
    $GLOBALS ['xViewPurSupplierNo']=$row ['v_supplierno'];
    $GLOBALS ['xViewPurDateRecieved']=$row ['v_daterecieved'];
    $GLOBALS ['xViewPurDateExpired']=$row ['v_dateexpired'];
    $GLOBALS ['xViewPurBatchId']=$row ['v_batchid'];
    $GLOBALS ['xViewPurFreeQty']=$row ['v_freeqty'];
    $GLOBALS ['xViewPurSellingPrice']=$row ['v_sellingprice'];
    $GLOBALS ['xViewPurVat']=$row ['v_vat'];
    $GLOBALS ['xViewPurProfit']=$row ['v_profit'];
    $GLOBALS ['xViewPurTotal']=$row ['v_total'];
    $GLOBALS ['xTempPurchaseQty']=$row ['temppurchaseqty'];
   }
}

/*       -------------------- Config Sales Table Records ------------------------------*/


function getconfig_sales()
{
  $result = mysql_query ( "SELECT *  FROM config_sales" ) or die ( mysql_error () );
  while ( $row = mysql_fetch_array ( $result ) )
   {
   
    $GLOBALS ['xTempSalesQty']=$row ['tempsalesqty'];
   }
}

/*       -------------------- Config Complaint Table Records ------------------------------*/


function getconfig_complaint()
{
  $result = mysql_query ( "SELECT *  FROM config_complaint" ) or die ( mysql_error () );
  while ( $row = mysql_fetch_array ( $result ) )
   {
    $GLOBALS ['xViewStockPoint']=$row ['v_stockpoint'];
    $GLOBALS ['xViewComplaintDate']=$row ['v_date'];
    $GLOBALS ['xViewComplaintBy']=$row ['v_complaintby'];
    $GLOBALS ['xViewContactPerson']=$row ['v_contactperson'];
    $GLOBALS ['xViewStatus']=$row ['v_status'];
    $GLOBALS ['xViewRemarks']=$row ['v_remarks'];
    $GLOBALS ['xViewCompletedDate']=$row ['v_completeddate'];
    $GLOBALS ['xViewBillNo']=$row ['v_billno'];
    $GLOBALS ['xViewBillDetails']=$row ['v_billdetails'];
    $GLOBALS ['xViewPaymentStatus']=$row ['v_paymentstatus'];
    $GLOBALS ['xViewRequiredDateFilter']=$row ['v_requireddatefilter'];

   }
}

/*       -------------------- Get Expenses Group Name Records ------------------------------*/

function findexpensesgroupname($xNo)
{
  $result = mysql_query ( "SELECT *  FROM expenses_group where exgrpno=$xNo" ) or die ( mysql_error () );
  while ( $row = mysql_fetch_array ( $result ) ) 
   {
     $GLOBALS ['xExpGroupName'] = $row ['exgrpname'];
   }
}

/*       -------------------- Get Eb-Name ------------------------------*/

function findebname($xNo)
{
  $result = mysql_query ( "SELECT *  FROM m_eb where txno=$xNo" ) or die ( mysql_error () );
  while ( $row = mysql_fetch_array ( $result ) ) 
   {
     $GLOBALS ['xEbName'] = $row ['ebname'];
     $GLOBALS ['xEbShortName'] = $row ['shortname'];
   }
}

/*       -------------------- Get Test Name ------------------------------*/


function findtestname($xNo)
 {
  $result = mysql_query ( "SELECT *  FROM m_test where testno=$xNo" ) or die ( mysql_error () );
  while ( $row = mysql_fetch_array ( $result ) ) 
  {
    $GLOBALS ['xTestName'] = $row ['testname'];
  }
}

/*       -------------------- Get Test Type Name ------------------------------*/
function findtesttypename($xNo)
{
  $result = mysql_query ( "SELECT *  FROM m_testtype where testtypeno=$xNo" ) or die ( mysql_error () );
  while ( $row = mysql_fetch_array ( $result ) ) 
  {
  $GLOBALS ['xTestTypeName'] = $row ['testtypename'];
  }
}

/*       -------------------- Get Doctor Name ------------------------------*/

function finddoctorname($xNo)
 {
  $xQry="SELECT *  FROM m_doctor where doctorno=$xNo";
  $result = mysql_query ($xQry) or die ( mysql_error () );	
  while ( $row = mysql_fetch_array ( $result ) ) 
  {
   $GLOBALS ['xDoctorName'] = $row ['doctorname'];
   $GLOBALS ['xColor'] = $row ['color'];
  }
}

/*       -------------------- Get Supplier Name ------------------------------*/

function findsuppliername($xNo)
{
  $result = mysql_query ( "SELECT *  FROM inv_supplier where supplierid=$xNo" ) or die ( mysql_error () );
  while ( $row = mysql_fetch_array ( $result ) ) 
   {
     $GLOBALS ['xSupplierName'] = $row ['suppliername'];
     $GLOBALS ['xSupplierNo'] = $row ['supplierid'];
   }
}

/*       -------------------- Get Item Price ------------------------------*/


function finditemprice($xNo)
{
  $result = mysql_query ( "SELECT *  FROM inv_purchaseentry where itemno=$xNo" ) or die ( mysql_error () );
  while ( $row = mysql_fetch_array ( $result ) ) 
   {
     $GLOBALS ['xItemSellingPrice'] = $row ['sellingprice'];
   }
}

/*       -------------------- Get Item Name ------------------------------*/

function finditemname($xNo) {
  $result = mysql_query("SELECT *  FROM m_item where itemno=$xNo") or die(mysql_error());
  while ($row = mysql_fetch_array($result)) {
    $GLOBALS['xItemName'] = $row['itemname'];
    $GLOBALS['xItemNo'] = $row['itemno'];
    $GLOBALS['xStockPointNo'] = $row['stockpointno'];
    $GLOBALS['xItemCategoryNo'] = $row['itemcategoryno'];
    $GLOBALS['xItemGroupNo'] = $row['itemgroupno'];
    $GLOBALS['xItemSubGroupNo'] = $row['itemsubgroupno'];
  }
}

/*       -------------------- Get Item Group Name ------------------------------*/

function finditemgroupname($xNo) {
  $result = mysql_query("SELECT *  FROM m_itemgroup where itemgroupno=$xNo") or die(mysql_error());
  while ($row = mysql_fetch_array($result)) {
    $GLOBALS['xItemGroupName'] = $row['itemgroupname'];
  }
}


/*       -------------------- Get Item Sub Group Name ------------------------------*/

function finditemsubgroupname($xNo) {
  $result = mysql_query("SELECT *  FROM m_itemsubgroup where itemsubgroupno=$xNo") or die(mysql_error());
  while ($row = mysql_fetch_array($result)) {
    $GLOBALS['xItemSubGroupName'] = $row['itemsubgroupname'];
  }
}


/*       -------------------- Get Item Category Name ------------------------------*/

function finditemcategoryname($xNo) {
  $result = mysql_query("SELECT *  FROM m_itemcategory where itemcategoryno=$xNo") or die(mysql_error());
  while ($row = mysql_fetch_array($result)) {
    $GLOBALS['xItemCategoryName'] = $row['itemcategoryname'];
    $GLOBALS['xItemCategoryShortName'] = $row['itemcategoryshortname'];
    $GLOBALS['xItemCategoryColor'] = $row['itemcategorycolor'];
  }
}

/*       -------------------- Get Stock Point Name ------------------------------*/

function findstockpointname($xNo) {
  $result = mysql_query("SELECT *  FROM m_stockpoint where stockpointno=$xNo") or die(mysql_error());
  while ($row = mysql_fetch_array($result)) {
    $GLOBALS['xStockPointName'] = $row['stockpointname'];
    $GLOBALS['xStockPointShortName'] = $row['stockpointshortname'];
  }
}



/* -------------  Drop Down Function -----------------*/
function DropDownSupplier()
{
  $result = mysql_query("SELECT *  FROM inv_supplier where  supplierid!=0 order by suppliername");
  echo "<option value='0'>ALL</option>";
  while($row = mysql_fetch_array($result))
   {?>
    <option value = "<?php echo $row['supplierid']; ?>" 
     <?php
      if ($row['supplierid']== $GLOBALS ['xSupplierNo']){echo 'selected="selected"';} 
    ?> >
     <?php echo $row['suppliername']; ?> 
    </option>
    <? } 
}

function DropDownStockPoint()
{
  $result = mysql_query("SELECT *  FROM m_stockpoint");
  echo "<option value='0'>ALL</option>";
  while($row = mysql_fetch_array($result))
   {?>
    <option value = "<?php echo $row['stockpointno']; ?>" 
     <?php
      if ($row['stockpointno']== $GLOBALS ['xStockPointNo']){echo 'selected="selected"';} 
    ?> >
     <?php echo $row['stockpointname']; ?> 
    </option>
    <? } 
}

function DropDownCategory()
{
$result = mysql_query("SELECT *  FROM m_itemcategory");
  echo "<option value='0'>ALL</option>";
  while($row = mysql_fetch_array($result))
   {?>
    <option value = "<?php echo $row['itemcategoryno']; ?>" 
     <?php
      if ($row['itemcategoryno']== $GLOBALS ['xItemCategoryNo']){echo 'selected="selected"';} 
    ?> >
     <?php echo $row['itemcategoryname']; ?> 
    </option>
    <? } 
}

function DropDownGroup()
{
$result = mysql_query("SELECT *  FROM m_itemgroup");
  while($row = mysql_fetch_array($result))
   {?>
    <option value = "<?php echo $row['itemgroupno']; ?>" 
     <?php
      if ($row['itemgroupno']== $GLOBALS ['xItemGroupNo']){echo 'selected="selected"';} 
    ?> >
     <?php echo $row['itemgroupname']; ?> 
    </option>
    <? }
}
function DropDownSubGroup()
{
$result = mysql_query("SELECT *  FROM m_itemsubgroup");
  while($row = mysql_fetch_array($result))
   {?>
    <option value = "<?php echo $row['itemsubgroupno']; ?>" 
     <?php
      if ($row['itemsubgroupno']== $GLOBALS ['xItemSubGroupNo']){echo 'selected="selected"';} 
    ?> >
     <?php echo $row['itemsubgroupname']; ?> 
    </option>
    <? }
}
function DropDownItem()
{
  $result = mysql_query("SELECT *  FROM m_item where stockpointno=31 order by itemname");
  while($row = mysql_fetch_array($result))
   {
     ?>
    <option value = "<?php echo $row['itemno']; ?>" 
     <?php
      if ($row['itemno']== $GLOBALS ['xItemNo']){echo 'selected="selected"';} 
    ?> >
     <?php echo $row['itemname']; ?> 
    </option>
    <? } 
}

function DropDownEmployee()
{
  $result = mysql_query("SELECT *  FROM employeedetails order by empname");
  while($row = mysql_fetch_array($result))
   {
     ?>
    <option value = "<?php echo $row['txno']; ?>" 
     <?php
      if ($row['txno']== $GLOBALS ['xEmpNo']){echo 'selected="selected"';} 
    ?> >
     <?php echo $row['empname']; ?> 
    </option>
    <?php } 
}

?>