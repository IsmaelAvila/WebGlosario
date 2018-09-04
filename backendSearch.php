<?php

require 'General.php';
session_start();
echo "<table frame='void' rules='rows' align='center' id='tableAdmi'>
    
                   <tr class='header'>
                      <th style='width:10%;'><a>ID </a></th>
		              <th style='width:40%;'><a>Nombre Materia </a></th>
		              <th style='width:30%;'><a>Nombre Concepto </a></th>
                    
                  </tr>";
if (isset($_POST['query'])) {
  
    $rows = General::searchText($_POST['query']);
    foreach ($rows as $row)
      {
        echo "<tr>";

            echo "<td>".$row['idConcepto']."</td>";
            echo "<td>". General::getMateriaTextLang($row['idMateria'], $_POST['lang']) ."</td>";
            echo "<td>". General::getConceptoTextLang($row['idNombreConcepto'],$_POST['lang']) ."</td>";
            
        echo "</tr>";
      }
   echo "</tr>";
    echo "</table>";
    
}else{
    $page = $_POST['page'];
    $rowGeneral = General::getConceptoMateria($page,0);
   
    foreach ($rowGeneral as $row)
      {
        echo "<tr>";

            echo "<td>".$row['idConcepto']."</td>";
            echo "<td>". General::getMateriaTextLang($row['idMateria'], $_POST['lang']) ."</td>";
            echo "<td>". General::getConceptoTextLang($row['idNombreConcepto'],$_POST['lang']) ."</td>";

        echo "</tr>";
      }
   
    echo "<tr class='footer'> <th colspan= '6' style=' text-align: center;'>";

    $totalRecods = General::getCountGeneral($method);
    $total_pages = ceil($totalRecods/10);
    $pageLink = "<div class='pagination'>[ ";
     for($i=1; $i<=$total_pages;$i++){
        $pageLink .= "<a href='Buscador.php?page=".$i."'>".$i."&nbsp;</a>";
     }
     echo $pageLink . "</div>]";
   
    echo "</tr>
     </table>";
}


?>