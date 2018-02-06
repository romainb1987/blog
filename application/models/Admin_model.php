<?php
  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_model extends CI_Model{
    
    protected $table = 'billet';
    
    public function __construct() {
        parent::__construct();
    }
    
    
    
    
    
    //fonction qui verifie la connexion de l'admin
    public function verif_admin($pseudo, $mdp){
        
        //si pseudo ou mdp sont vides --> retourne false
        if(!isset($pseudo) AND !isset($mdp)){
            return false;
        }
        
        //recupération des données sur la table admin
        $admin = $this->db->select('*')
            ->from('admin')
            ->get()
            ->result();
        //comparaison des resultat et des données rentrée en formulaire
    foreach ($admin as $row){
        
        //si equivalence retour de true 
        if($row->pseudo == $pseudo AND $row->mdp == $mdp){
        
        return true;
        
        }
    }
        //si le foreach arrive à la fin sans resultat d'équivalence --> false
        return false;
        
    }
    
    
        
        

    
}

