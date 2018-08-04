<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Tshirts Kingdom</title>
<link href="website.css" rel="stylesheet" type="text/css">
</head>

<body>
<table border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="350"><div id="detail"> <img src="imgshirt/013rl.jpg" width="350" height="294" class="type2" />
        <form action="cart.php" method="post" enctype="multipart/form-data" name="buy">
          <table width="250" border="0" cellpadding="5" cellspacing="1" bgcolor="#C6C6C6">
            <tr>
              <td width="34" align="left" bgcolor="#FFFFFF">品名</td>
              <td width="193" align="left" bgcolor="#FFFFFF">一個人的音樂&nbsp;&nbsp;(T-59)</td>
            </tr>
            <tr>
              <td align="left" bgcolor="#FFFFFF">尺寸</td>
              <td align="left" bgcolor="#FFFFFF"><label>
                  <select name="size" class="type1" id="size">
                    <option selected="selected">S</option>
                    <option>M</option>
                    <option>L</option>
                    <option>XL</option>
                  </select>
                </label>
                X
                <input name="qty" type="text" class="type1" id="qty" value="1" size="2" maxlength="2" />
                件 </td>
            </tr>
            <tr>
              <td align="left" bgcolor="#FFFFFF">顏色</td>
              <td align="left" bgcolor="#FFFFFF">紅色</td>
            </tr>
            <tr>
              <td align="left" bgcolor="#FFFFFF">價格</td>
              <td align="left" bgcolor="#FFFFFF">NT699</td>
            </tr>
            <tr>
              <td height="130" align="left" bgcolor="#FFFFFF">簡介 </td>
              <td height="130" align="left" bgcolor="#FFFFFF"><p>什麼都不想，什麼都不做，就這樣任隨音樂在耳邊流洩放送著，心也跟著一啟飄散到無止盡的邊境去吧！</p></td>
            </tr>
          </table>
          <br />
          <table width="250" border="0">
            <tr>
              <td width="50%"><div align="right">
                  <input type="image" name="tobuy" id="tobuy" src="images/button_buy1.gif" alt="確定購買" />
              </div></td>
              <td><div align="right"><img src="images/button_back.gif" alt="回到上一頁" width="98" height="28" border="0" align="bottom" /></div></td>
            </tr>
          </table>
        </form>
      </div></td>
  </tr>
  <tr>
    <td><div> 　其他同款式的Ｔ恤：</div>
      <div class="picklist">
        <div class="box"><img src="imgshirt/013rz.jpg" width="98" height="82" /></div>
        NT699 </div></td>
  </tr>
</table>
</body>
</html>