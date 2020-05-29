<div class="container">
    
    <h1 align="center">Відсутня категорія споживача</h1>
<?php

echo '<table class="table">';
  echo "<thead>";
   echo "<tr>";
   echo  '<th scope="col">о/р</th>';
   echo  '<th scope="col">Назва споживача</th>';
  echo "</tr>";
 echo "</thead>";
foreach ($s as $value) {
	echo "<tr>";
	foreach ($value as $data)
		echo "<td scope='col'>".$data."</td>";
	echo "</tr>";
}
echo "</table>"


?>
   
 <hr>    

    
    
    
</div>