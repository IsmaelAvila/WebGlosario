<?php

require 'General.php';
session_start();
echo "<form method='post' name='form' id='form'>";
echo "<table frame='void' rules='rows' align='center' id='tableAdmi'>
                   <tr class='header'>
                      <th style='width:10%;'><a href=''>ID </a></th>
		              <th style='width:30%;'><a href=''>Nombre Concepto </a></th>
                      <th style='width:20%;'><a href=''>Seleccionar </a></th>
                  </tr>";
if (isset($_POST['query'])) {
  
    $rows = General::searchText($_POST['query']);
    
    foreach ($rows as $row)
      {
        echo "<tr><form method='post' name='form' id='form'> ";

            echo "<td>".$row['idConcepto']."</td>";
            echo "<td>".$row['nombreConcepto']."</td>";
       
            echo "<td><input type='checkbox' name='concepto[]' value='".$row['idConcepto']."' /></td>";


        echo "</tr>";
      }
      echo "<tr class='footer'> <th colspan= '6' style=' text-align: right;'>";
        echo "</tr> </table>";
     echo "<input type='submit' name='Confirmar' value='Confirmar'/></form>";
   
}else{
    
    $rowGeneral = General::getConceptoGene();
    foreach ($rowGeneral as $row)
      {
        echo "<tr>";

            echo "<td>".$row['idConcepto']."</td>";
            echo "<td>".$row['nombreConcepto']."</td>";
            echo "<td><input type='checkbox' name='concepto[]' value='".$row['idConcepto']."' /></td>";


        echo "</tr>";
      }
    echo "<tr class='footer'> <th colspan= '6' style=' text-align: right;'>";
    echo "</tr> </table>";
    echo "<input type='submit' name='Confirmar' value='Confirmar'/></form>";
   
}


?>