<?php 
if(isset($_SESSION['id'])){
    if($_SESSION['admin']){
        if(isset($idres)){
?>
    <table class="table">
        <tr>
            <thead class="thead-dark"><th>Id</th><th>Prénom</th><th>Nom</th><th>Date de début</th> <th>Date de fin</th> <th>Tarif</th> <th>État de la réservation</th> <th>Nombre de personne</th> <th>Validation</th><th>Modification</th><th>Suppression</th></thead>
        </tr>
<?php
        for($i = 0; $i<count($idres);$i++){
            echo '<tr><td>'.$idclient[$i].'</td><td>'.$prenom[$i].'</td><td>'.$nom[$i].'</td> <td>'.$datedebut[$i].'</td> <td>'.$datefin[$i].'</td> <td>'.$tarif[$i].'</td>';
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
                    echo form_open('/Reservation/validation')
                    .'<td>';
                    switch($etatres[$i]){
                        case 1:
                        echo '<button type="submit" class="btn btn-primary" disabled>Valider</button>'
                        .'<input type="hidden" name="id" value="'.$idres[$i].'" />';
                        break;
                        default:
                        echo '<button type="submit" class="btn btn-primary">Valider</button>'
                        .'<input type="hidden" name="id" value="'.$idres[$i].'"/>';
                    }
                    echo'</td>'
                    .form_close()
                    .form_open('/Reservation/modification')
                    .'<td>'
                        .'<button type="submit" class="btn btn-primary">Modifier</button>'
                        .'<input type="hidden" name="id" value="'.$idres[$i].'"/>'
                    .'</td>'
                    .form_close()
                    .form_open('/Reservation/annulation')
                    .'<td>'
                        .'<button type="submit" class="btn btn-danger">Supprimer</button>'
                        .'<input type="hidden" name="id" value="'.$idres[$i].'"/>'
                    .'</td>'
                    .form_close();
        }
        echo '</tr></table>';
        }
        else{
            echo "Aucun réservation";
        }
    }
}
?>
