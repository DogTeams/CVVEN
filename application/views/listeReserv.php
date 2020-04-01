<?php 
if(isset($_SESSION['id'])){
    if(isset($idres)){
?>
    <table class="table">
        <tr>
            <thead class="thead-dark"><th>Date de début</th> <th>Date de fin</th> <th>Tarif</th> <th>État de la réservation</th> <th>Nombre de personne</th> <th>Annulation</th></thead>
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
            case 2: 
                echo"<td>Non disponible</td>"; 
            break;}
        echo'<td>'.$nbclient[$i].'</td>';
        switch($etatres[$i]){
            case 1:
                echo'<td><button type="button" class="btn btn-danger" disabled>Annuler</button></td>';
            break;
            default:
                echo'<td>'.form_open('/Formulaire/annulation')
                .'<button type="submit" class="btn btn-danger" >Annuler</button>'
                .'<input type="hidden" name="id" value="'.$idres[$i].'"/>'
                .form_close()
                .'</td>';
        }
    }
    echo '</tr></table>';
    }
    else{
        echo "Vous n'avez pas de réservation de faite";
    }
    
}
?>
