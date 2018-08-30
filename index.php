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
$query_rsClass = "SELECT * FROM sclass ORDER BY sort ASC";
$rsClass = mysql_query($query_rsClass, $cnStore) or die(mysql_error());
$row_rsClass = mysql_fetch_assoc($rsClass);
$totalRows_rsClass = mysql_num_rows($rsClass);

mysql_select_db($database_cnStore, $cnStore);
$query_rsHot = "SELECT hot.sid, shirt.name, shirt.img FROM hot, shirt WHERE hot.sid = shirt.sid ORDER BY hot.sort";
$rsHot = mysql_query($query_rsHot, $cnStore) or die(mysql_error());
$row_rsHot = mysql_fetch_assoc($rsHot);
$totalRows_rsHot = mysql_num_rows($rsHot);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Tshirts Kingdom</title>
<link href="website.css" rel="stylesheet" type="text/css">
</head>

<body>
<div id="main">
  <div id="header"> <img src="images/header.gif" width="834" height="60" />
    <div id="topmenu"> <a href=".">回首頁</a>　 <a href="#">付款與配送方式</a>　 <a href="#">Ｔ恤質料與尺寸</a>　 <a href="#">我的購物車</a></div>
    <form action="catalog.php" method="get" name="search" target="tsFrame" id="search">
      <input name="key" type="text" class="type1" id="key" size="40" maxlength="40" />
      <input name="button" type="submit" class="type1" id="button" value="搜尋" />
    </form>
    <div class="clearboth"></div>
  </div>
  <div id="containleft">
    <div class="leftboard"> <img src="images/board_top1.gif" width="166" height="57" />
      <ul>
        <li><a href="special.php" target="tsFrame">今日好康</a></li>
        <?php do { ?>
          <li><a href="catalog.php?cid=<?php echo $row_rsClass['cid']; ?>" target="tsFrame"><?php echo $row_rsClass['cname']; ?></a></li>
          <?php } while ($row_rsClass = mysql_fetch_assoc($rsClass)); ?>
      </ul>
      <div class="bottom"><img src="images/board_bottom.gif" width="166" height="26" /></div>
    </div>
    <div class="leftboard">
      <div align="center"> <img src="images/board_top2.gif" width="166" height="63" /> 
        <?php do { ?>
          <img src="imgshirt/<?php echo $row_rsHot['img']; ?>s.jpg" width="109" height="91" title="<?php echo $row_rsHot['name']; ?>" />
          <?php } while ($row_rsHot = mysql_fetch_assoc($rsHot)); ?>
        <div class="bottom"><img src="images/board_bottom.gif" width="166" height="26" /></div>
      </div>
    </div>
  </div>
  <div id="containright"><iframe src="special.php" name="tsFrame" width="100%" height="900px" scrolling="no" frameborder="0"></iframe></div>
  <div class="clearboth"></div>
</div>
</body>
</html>
<?php
mysql_free_result($rsClass);

mysql_free_result($rsHot);
?>
