<?php 
if(isset($_SESSION['id'])){
    if($_SESSION['admin']){
        if(isset($idres)){
?>
    <table class="table">
        <tr>
            <thead class="thead-dark"><th>Date de début</th> <th>Date de fin</th> <th>Tarif</th> <th>État de la réservation</th> <th>Nombre de personne</th> <th>Action</th></thead>
        </tr>
<?php
            echo form_open('/Reservation/modification').'<tr> 
            <td><input type="date" name"datedebut" value="'.$datedebut.'"></td> 
            <td><input type="date" name"datefin" value="'.$datefin.'"></td> 
            <td><input type="text" name"tarif" value="'.$tarif.'"></td>';
            switch($etatres){
                case 0: 
                    echo'<td><select name="etatres"><option value="0" selected>En attente</option><option value="1">Valider</option><option value="2"> Non disponible</option></td>'; 
                break; 
                case 1: 
                    echo'<td><select name="etatres"><option value="0">En attente</option><option value="1" selected>Valider</option><option value="2"> Non disponible</option></td>'; 
                break; 
                case 2: 
                    echo'<td><select name="etatres"><option value="0">En attente</option><option value="1">Valider</option><option value="2" selected> Non disponible</option></td>'; 
                break;
            }
            echo '<td><input type="number" name"nbclient" value="'.$nbclient.'"></td><td><input type="hidden" name="idclient" value="'.$idclient.'">
            <input type="hidden" name="idres" value"'.$idres.'">
            <button type="submit" class="btn btn-primary">Modifier</button></td>'.form_close();
        echo '</tr></table>';
        }
        else{
            echo "Vous n'avez pas de réservation de faite";
        }
    
    }
}
?>
