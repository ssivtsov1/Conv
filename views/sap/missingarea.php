<div class="container">
<?php

echo '<table class="table">';
  echo "<thead>";
   echo "<tr>";
    echo  '<th scope="col">№</th>';
   echo  '<th scope="col">о/р</th>';
   echo  '<th scope="col">Назва споживача</th>';
    echo  '<th scope="col">Назва точки</th>';
    echo  '<th scope="col">EIC код</th>';
    echo  '<th scope="col">Код схеми</th>';
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