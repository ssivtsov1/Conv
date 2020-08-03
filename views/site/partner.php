<div class="container">
<?php



echo '<table class="table">';
  echo "<thead>";
   echo "<tr>";
   echo  '<th scope="col">Структура</th>';
   echo   '<th scope="col">oldkey</th>';
   echo   '<th scope="col">тип помилки</th>';
   echo   '<th scope="col">рес</th>';
  echo "</tr>";
 echo "</thead>";
foreach ($sql_ab as $value) {
	echo "<tr>";
	foreach ($value as $data)
		echo "<td scope='col'>".$data."</td>";
	echo "</tr>";
}
echo "</table>"


?>
   
 <hr>    
<span class="label label-default">  
    <?php echo $col;  ?>       
</span>
    
    
    
</div>
