<?PHP

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/x-icon" href="../../src/style/resources/favicon.ico        ">
  <link rel="stylesheet" href="style.css">
  <script src="script.js"></script>
  <title>VTA | Unit converter</title>
</head>

<body>
  <div class="logo"><img src="logoNavBar.png" height="25px" width="auto"></div>
  <div class="converter-wrapper">
    <h1>ENGINEERING <br>UNIT CONVERTER</h1>
    <form name="property_form">
      <span>
        <select class="select-property" name="the_menu" size=1
          onChange="UpdateUnitMenu(this, document.form_A.unit_menu); UpdateUnitMenu(this, document.form_B.unit_menu)">
        </select>
      </span>
    </form>
    <div class="container">
      <div class="converter-side-a">
        <form name="form_A" onSubmit="return false">
          <input type="text" class="numbersonly" name="unit_input" maxlength="20" value="0"
            onKeyUp="CalculateUnit(document.form_A, document.form_B)">
          <span>
            <select name="unit_menu" onChange="CalculateUnit(document.form_B, document.form_A)">
            </select>
          </span>
        </form>
      </div> <!-- /converter-side-a -->
      <div class="converter-equals">
        <p>=</p>
      </div> <!-- /converter-side-a -->
      <div class="converter-side-b">
        <form name="form_B" onSubmit="return false">
          <input type="text" class="numbersonly" name="unit_input" maxlength="20" value="0"
            onkeyup="CalculateUnit(document.form_B, document.form_A)">
          <span>
            <select name="unit_menu" onChange="CalculateUnit(document.form_A, document.form_B)">
            </select>
          </span>
        </form>
      </div> <!-- /converter-side-b -->
    </div>
  </div><!-- /converter-wrapper -->
  <div class="link_container">
    <div class="back">
      <a class="link_back" href="../../src/content/login.php">&lt;&nbsp;&nbsp;Back to menu</a>
    </div>
  </div>
</body>

</html>