<?php
class reservations_model extends CI_Model {
    public $datedebut;
    public $datefin;
    public $idclient;
    public $nbclient;


    public function insertReserv()
    {
        $this->datedebut = $_POST['date'];
        $this->datefin = $this->date($_POST['date']);
        $this->idclient = $_POST['id'];
        $this->nbclient = $_POST['nbPersonne'];
        $this->db->insert('reservation',$this);
        
    }  
    public function list($id){
        $query = $this->db->query('SELECT * FROM reservation WHERE idclient = '.$id);
        return $query->result();
    }
    public function date($datedebut){
        return date( "Y-m-d", strtotime( $datedebut." +7 days" ));
    }
}


