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
            echo "<td>". General::getMateriaTextLang($row['idMateria'], 1) ."</td>";
            echo "<td>". General::getConceptoTextLang($row['idNombreConcepto'],1) ."</td>";
            
        echo "</tr>";
      }
   
   echo "<tr class='footer'> <th colspan= '6' style=' text-align: right;'>";

    $totalRecods = count($rows);
    $total_pages = ceil($totalRecods/10);
    $pageLink = "<div class='pagination'>";
    for($i; $i<=$total_pages;$i++){
        $pageLink .= "<a href='Adminis.php?page=".$i."'>".$i."</a>";
        echo $pageLink . "</div>";
    }
   
    echo "</tr> </table>";
    
}else{
    
    $rowGeneral = General::getConceptoMateria(1,0);
   
    foreach ($rowGeneral as $row)
      {
        echo "<tr>";

            echo "<td>".$row['idConcepto']."</td>";
           echo "<td>". General::getMateriaTextLang($row['idMateria'], 1) ."</td>";
            echo "<td>". General::getConceptoTextLang($row['idNombreConcepto'],1) ."</td>";

        echo "</tr>";
      }
   
    echo "<tr class='footer'> <th colspan= '6' style=' text-align: right;'>";

    $totalRecods = General::getCountGeneral(0);
    $total_pages = ceil($totalRecods/10);
    $pageLink = "<div class='pagination'>";
    for($i; $i<=$total_pages;$i++){
        $pageLink .= "<a href='Adminis.php?page=".$i."'>".$i."</a>";
        echo $pageLink . "</div>";
    }
   
    echo "</tr>
     </table>";
}


?>