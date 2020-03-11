<?php 
if(!isset($_SESSION['co'])){

}
else{
    if($null == 1){
?>
    <table class="table">
        <tr>
            <thead class="thead-dark"><th>Date de début</th> <th>Date de fin</th> <th>Tarif</th> <th>État de la réservation</th> <th>Nombre de personne</th></thead>
        </tr>
<?php
    for($i = 0; $i<count($idres);$i++){
        echo '<tr> <td>'.$datedebut[$i].'</td> <td>'.$datefin[$i].'</td> <td>'.$tarif[$i].'</td>';
        switch($etatres[$i]){
            case 0: 
                echo"<td>En attente</td>"; 
            break; 
            case 1: 
                echo"<td>Valider</td>"; 
            break; 
            case 3: 
                echo"<td>Non disponible</td>"; 
            break;}
        echo'<td>'.$nbclient[$i].'</td> </tr>';
    }
    echo '</table>';
    }
    else{
        echo "Vous n'avez pas de réservation de faite";
    }
    
}
?>
