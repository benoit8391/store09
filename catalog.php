<?php require_once('Connections/cnStore.php'); ?>
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

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_rsShirt = 10;
$pageNum_rsShirt = 0;
if (isset($_GET['pageNum_rsShirt'])) {
  $pageNum_rsShirt = $_GET['pageNum_rsShirt'];
}
$startRow_rsShirt = $pageNum_rsShirt * $maxRows_rsShirt;

$colname_rsShirt = "0";
if (isset($_GET['cid'])) {
  $colname_rsShirt = $_GET['cid'];
}
mysql_select_db($database_cnStore, $cnStore);
$query_rsShirt = sprintf("SELECT * FROM shirt WHERE cid = %s OR  0 = %s ORDER BY dsort  DESC,  sid DESC", GetSQLValueString($colname_rsShirt, "int"),GetSQLValueString($colname_rsShirt, "int"));
$query_limit_rsShirt = sprintf("%s LIMIT %d, %d", $query_rsShirt, $startRow_rsShirt, $maxRows_rsShirt);
$rsShirt = mysql_query($query_limit_rsShirt, $cnStore) or die(mysql_error());
$row_rsShirt = mysql_fetch_assoc($rsShirt);

if (isset($_GET['totalRows_rsShirt'])) {
  $totalRows_rsShirt = $_GET['totalRows_rsShirt'];
} else {
  $all_rsShirt = mysql_query($query_rsShirt);
  $totalRows_rsShirt = mysql_num_rows($all_rsShirt);
}
$totalPages_rsShirt = ceil($totalRows_rsShirt/$maxRows_rsShirt)-1;

$colname_rsClass = "-1";
if (isset($_GET['cid'])) {
  $colname_rsClass = $_GET['cid'];
}
mysql_select_db($database_cnStore, $cnStore);
$query_rsClass = sprintf("SELECT cname FROM sclass WHERE cid = %s", GetSQLValueString($colname_rsClass, "int"));
$rsClass = mysql_query($query_rsClass, $cnStore) or die(mysql_error());
$row_rsClass = mysql_fetch_assoc($rsClass);
$totalRows_rsClass = mysql_num_rows($rsClass);

$queryString_rsShirt = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_rsShirt") == false && 
        stristr($param, "totalRows_rsShirt") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_rsShirt = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_rsShirt = sprintf("&totalRows_rsShirt=%d%s", $totalRows_rsShirt, $queryString_rsShirt);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Tshirts Kingdom</title>
<link href="website.css" rel="stylesheet" type="text/css">
</head>

<body onLoad="parent.scroll(0,0)">
<table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="30%"><?php if ($totalRows_rsClass > 0) { // Show if recordset not empty ?>
        <div class="style3"> &nbsp;&nbsp;&nbsp;分類：<?php echo $row_rsClass['cname']; ?></div>
        <?php } // Show if recordset not empty ?>
      <?php if ($totalRows_rsClass == 0) { // Show if recordset empty ?>
        <div class="style4"> &nbsp;&nbsp;&nbsp;搜尋：簡單 </div>
        <?php } // Show if recordset empty ?>    </td>
    <td><div align="right" class="pagelink"> <a href="<?php printf("%s?pageNum_rsShirt=%d%s", $currentPage, 0, $queryString_rsShirt); ?>">第一頁</a><a href="<?php printf("%s?pageNum_rsShirt=%d%s", $currentPage, max(0, $pageNum_rsShirt - 1), $queryString_rsShirt); ?>">上一頁</a>&nbsp;<a href="<?php printf("%s?pageNum_rsShirt=%d%s", $currentPage, $totalPages_rsShirt, $queryString_rsShirt); ?>">下一頁</a>&nbsp;<a href="<?php printf("%s?pageNum_rsShirt=%d%s", $currentPage, $totalPages_rsShirt, $queryString_rsShirt); ?>">最後一頁</a>&nbsp;</div></td>
  </tr>
  <tr>
    <td colspan="2"><p>&nbsp;</p>
      <?php if ($totalRows_rsShirt == 0) { // Show if recordset empty ?>
        <p class="style4">&nbsp;&nbsp;抱歉！沒有相關產品。</p>
        <?php } // Show if recordset empty ?>    </tr>
  <tr>
    <td colspan="2"><?php do { ?>
      <?php if ($totalRows_rsShirt > 0) { // Show if recordset not empty ?>
        <div class="clothes"> <img src="imgshirt/<?php echo $row_rsShirt['img']; ?>m.jpg" width="155" height="130" /><br />
          <span class="style2"><?php echo $row_rsShirt['name']; ?></span> (NT<?php echo $row_rsShirt['price']; ?>) </div>
        <?php } // Show if recordset not empty ?>
      <?php } while ($row_rsShirt = mysql_fetch_assoc($rsShirt)); ?></td>
  </tr>
  <tr>
    <td colspan="2"><div align="right" class="pagelink"> &nbsp;&nbsp;&nbsp;</div></td>
  </tr>
</table>
</body>
</html>
<?php
mysql_free_result($rsShirt);

mysql_free_result($rsClass);
?>
