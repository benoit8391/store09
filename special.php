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

mysql_select_db($database_cnStore, $cnStore);
$query_rsSpecial = "SELECT * FROM special, shirt WHERE special.sid = shirt.sid ORDER BY special.sort";
$rsSpecial = mysql_query($query_rsSpecial, $cnStore) or die(mysql_error());
$row_rsSpecial = mysql_fetch_assoc($rsSpecial);
$totalRows_rsSpecial = mysql_num_rows($rsSpecial);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>今日好康</title>
<link href="website.css" rel="stylesheet" type="text/css">
</head>

<body>
<div align="left" class="style5">&nbsp;&nbsp;&nbsp;今日好康</div>
<?php do { ?>
  <div class="newcloth">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="110"><img src="imgshirt/<?php echo $row_rsSpecial['img']; ?>s.jpg" width="109" height="91" class="type2" /></td>
        <td><span class="style5"><?php echo $row_rsSpecial['title']; ?></span><br />
          <div class="titlebar"><?php echo $row_rsSpecial['name']; ?><span class="style6"> NT<?php echo $row_rsSpecial['price']; ?></span></div>
          <?php echo $row_rsSpecial['story']; ?></td>
      </tr>
    </table>
  </div>
  <?php } while ($row_rsSpecial = mysql_fetch_assoc($rsSpecial)); ?>
</body>
</html>
<?php
mysql_free_result($rsSpecial);
?>
