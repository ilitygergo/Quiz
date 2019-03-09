<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="stylesheet" type="text/css" href="w3css.css"/>
    <title>INSERT GENERATOR</title>
    <style>
        .closebtn {
            margin-left: 15px;
            color: white;
            font-weight: bold;
            float: right;
            font-size: 22px;
            line-height: 20px;
            cursor: pointer;
            transition: 0.3s;
        }
        .closebtn:hover {
            color: black;
        }
    </style>
</head>
<body><?php
if(isset($_GET['err'])){
    if($_GET['err'] == 1 ){
        $e = "Please fill out every cell!";
        echo '<div class="alert w3-red w3-margin w3-padding-24">';
        echo '<span class="closebtn" onclick="this.parentElement.style.display=`none`;">&times;</span>';
        echo $e;
        echo '</div>';
    }
}
?>
<div class="w3-container">
  <div class="w3-card-4">
    <div class="w3-container w3-black">
      <h2>Question Insert Generator</h2>
    </div>

    <form class="w3-container" method="post" action="submit.php">
      <p>
          <input class="w3-input" type="text" name="qu">
          <label>QUESTION</label>
      </p>

      <p>
          <input class="w3-input" type="text" name = "ra">
          <label>Right Answer</label>
      </p>

      <p>
          <input class="w3-input" type="text" name= "wa1">
          <label>Wrong Answer</label>
      </p>

      <p>
          <input class="w3-input" type="text" name = "wa2">
          <label>Wrong Answer</label>
      </p>

      <p>
          <input class="w3-input" type="text" name = "wa3">
          <label>Wrong Answer</label>
      </p>

      <select class="w3-select" name="tp">
          <option value="" disabled selected></option>
          <option value="history">History</option>
          <option value="geography">Geography</option>
          <option value="technology">Technology</option>
          <option value="literature">Literature</option>
          <option value="nature">Nature</option>
      </select>
      <label>Topic</label>

        <p>
          <h5>Hardness</h5>
          <input class="w3-radio" type="radio" name="ha" value="0" checked>
          <label>Easy</label>

          <input class="w3-radio" type="radio" name="ha" value="1">
          <label>Hard</label>
      </p>

      <input type="submit" class="w3-bar w3-button w3-green"/>

    </form>
  </div>
</div>

</body>
</html>


</body>
</html>