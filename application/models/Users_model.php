<?php
class users_model extends CI_Model {
    public $identifiant;
    public $nom;
    public $prenom;
    public $courriel;
    public $mdp;
    public $Ville;
    public $codepostal;
    public $telephone;

    public function insertUser()
    {
        $this->identifiant = $_POST['user'];
        $this->nom = $_POST['nom'];
        $this->prenom = $_POST['prenom'];
        $this->courriel = $_POST['email'];
        $this->mdp = $this->verifMdp($_POST['mdp'],$_POST['mdp2']);
        $this->Ville = $_POST['ville'];
        $this->codepostal = $_POST['cp'];
        $this->telephone = $_POST['telephone'];

        $this->db->insert('client',$this);
    }  
    
    public function verifMdp($mdp,$mdp2){
        if($mdp==$mdp2){
            return md5($mdp);
        }
    }
    public function connexion(){
        $query = $this->db->query('SELECT * FROM client WHERE  mdp=? AND courriel =?', array(md5($_POST['mdp']), $_POST['email']));
        /*if($query){
            $this->session;
            $_SESSION['id']= $query->result();
        }*/
        if(isset($query)){
            $this->session;
            $this->session->userdata();
            foreach($query->result() as $row){
                if($row==""){
                    echo "error";
                    $this->load->view('connexion');
                }
                $this->session->set_userdata('id', $row->idclient);
                
            }
            $this->session->set_userdata('co', true);
            $r= $this->db->query('SELECT * FROM reservation WHERE idclient=?', array($_SESSION['id']));
            $i=0;
            foreach($r->result() as $row){
                echo($row->datedebut + ' ' + $row->datefin + ' ' + $row->etatres + ' ' + $row->nbclient);
                
                $i++;
            }
            $this->session->set_userdata('reserv',$tab);
        }
    }
}