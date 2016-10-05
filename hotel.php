<?php
	$user = 'root';
	$pwd = '';
	$db1=mysql_connect('localhost',$user,$pwd) or die('unable to connect to database');
	mysql_select_db('canteen') or die(mysql_error());
	$query = "select * from menu_list_cost";
	$resultset = mysql_query($query) or die(mysql_error());
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
<script src='//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js'></script> 
<!-- 
ajax
 -->
<script>
function Price(str,amt,coun) {
    if (str.length == 0) { 
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById(coun).innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "price.php?co="+str+"&pr="+amt, true);
        xmlhttp.send();
       
    }
}
function total_cal(var1){
$count =0 ;
$total = 0 ;
 while($count < var1)
 {
   $va = document.getElementById($count).innerHTML;
   $total = +$total + +$va ;
   $count = $count + 1;
 }
document.getElementById('total_val').innerHTML=$total;
}
</script>


</head>>

<style>
body,h1,h2,h3,h4,h5,h6 {font-family: "Lato", sans-serif}
.w3-navbar,h1,button {font-family: "Montserrat", sans-serif}
.fa-anchor,.fa-coffee {font-size:200px}
table {
    border-collapse: collapse;    
    width: 100%;
}
table, th, td {
    border: 1px solid black;
}
tr{
    height: 30px;
}
th, td {
    padding: 15px;
    text-align: left;
}
</style>
<!-- navbar
 -->
<body>
 <ul class="w3-navbar w3-red w3-card-2 w3-top w3-left-align w3-large">
 <li class="w3-hide-medium w3-hide-large w3-opennav w3-right">
  <a class="w3-padding-large w3-hover-white w3-large w3-red" href="javascript:void(0);" onclick="myFunction()" title="Toggle Navigation Menu"><i class="fa fa-bars"></i></a>
  </li>
  <li><a href="#" class="w3-padding-large w3-white">Home</a></li>
  <li class="w3-hide-small"><a href="#" class="w3-padding-large w3-hover-white">Link 1</a></li>
  <li class="w3-hide-small"><a href="#" class="w3-padding-large w3-hover-white">Link 2</a></li>
  <li class="w3-hide-small"><a href="#" class="w3-padding-large w3-hover-white">Link 3</a></li>
  <li class="w3-hide-small"><a href="#" class="w3-padding-large w3-hover-white">Link 4</a></li>
</ul>
<br><br><br>
      <table >
        <thead>
          <tr>
              <th data-field="id">Item Name</th>
              <th data-field="name">Item price</th>
              <th data-field="price">No_Of_Items</th>
              <th data-field="total">Totals</th>
          </tr>
        </thead>
        <tbody>

        <?php
        $counter = 0;
        while($row = mysql_fetch_array($resultset)){
        $item = $row["item"];
        $price = $row["price"];
        echo "<tr><td name=$item>$item</td><td>$price</td><td><input type='number' onkeyup='Price(this.value,$price,$counter)' min ='0'></td><td id=$counter>0</td></tr>";
        $counter = $counter +1;	
        }
        ?>
        <tr><td></td><td></td><td>
       <button onclick="total_cal(<?php echo $counter ?>)"> calculate_total:</button>
         </td><td><p id='total_val'></p></td></tr>
        </tbody>
      </table>

    <div id="page-wrap">
</div>
</body>
</html>
