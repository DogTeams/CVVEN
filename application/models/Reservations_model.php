<?php
class reservations_model extends CI_Model {
    public $datedebut;
    public $datefin;
    public $tarif;
    public $etatres;
    public $idclient;
    public $nbclient;
    public $idtypeheb;
    public $idheb;

    public function __construct(){
        $this->tarif = null;
        $this->etatres = 0;
        $this->idtypeheb = null;
        $this->idheb = null;
    }
    public function insertReserv()
    {
        $this->datedebut = $_POST['date'];
        $this->datefin = $this->date($_POST['date']);
        $this->idclient = $_POST['id'];
        $this->nbclient = $_POST['nbPersonne'];
        $this->db->insert('reservation',$this);
    }  
    public function getRes($id){
        $query = $this->db->query('SELECT * FROM reservation WHERE idres = '.$id);
        foreach($query->result() as $res){
            $this->datedebut = $res->datedebut;
            $this->datefin = $res->datefin;
            $this->tarif = $res->tarif;
            $this->etatres = $res->etatres;
            $this->idclient = $res->idclient;
            $this->nbclient = $res->nbclient;
            $this->idtypeheb = $res->idtypeheb;
            $this->idheb = $res->idheb;
        }
        return $query->result();
    }
    public function list($id){
        $query = $this->db->query('SELECT * FROM reservation WHERE idclient = '.$id);
        return $query->result();
    }
    public function date($datedebut){
        return date( "Y-m-d", strtotime( $datedebut." +7 days" ));
    }
    public function annulation(){
        $this->db->delete('reservation', array('idres' => $_POST['id']));
    }
    public function listAll(){
        if($_SESSION['admin']){
            $query = $this->db->query('SELECT * FROM reservation, client where reservation.idclient = client.idclient');
            return $query->result();
        }
        else{
            return false;
        }
    }
    public function validation($id){
        if($_SESSION['admin']){
            $this->getRes($id);
            $this->etatres = 1;
            $this->db->update('reservation',$this,'idres ='.$id);
        }
        else{
            return false;
        }

    }

    public function update(){
        if($_SESSION['admin']){
            $this->datedebut = $_POST['datedebut'];
            $this->datefin = $_POST['datefin'];
            $this->tarif = $_POST['tarif'];
            $this->etatres = $_POST['etatres'];
            $this->idclient = $_POST['idclient'];
            $this->nbclient = $_POST['nbclient'];
            $this->db->update('reservation',$this,'idres ='.$_POST['idres']);
        }
        else{
            return false;
        }
    }
}


