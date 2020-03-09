<?php
class reservations_model extends CI_Model {
    public $datedebut;
    public $datefin;
    public $idclient;
    public $nbclient;


    public function insertReserv()
    {
        $this->datedebut = $_POST['date'];
        $this->datefin = $_POST['date'];
        $this->idclient = $_POST['id'];
        $this->nbclient = $_POST['nbPersonne'];
        $this->db->insert('reservation',$this);
        
    }  
}


