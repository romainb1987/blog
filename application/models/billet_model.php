<?php
  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class billet_model extends CI_Model{
    
    protected $table = 'billet';
    
    public function __construct() {
        parent::__construct();
    }
    
    //fonction qui compte le nombre de billet
    public function count(){
        return $this->db->count_all($this->table);
        
    }
    
    
    //recupération des billets -> param $nb = nombre billets par page (lib pagination) 
    //$debut initialisé a zero si rien en variable $_GET 
    
    public function liste_comm($nb = null, $debut = null){
        
        $nb = (int)$nb;
        
        //si nb = null et $debut = null alors on extrait tout les billets
        if($nb == null AND $debut == null){
            
            return $this->db->select('*')
            ->from($this->table)
            ->order_by('titre','asc')
            ->get()
            ->result();
        }
        
        //controle des param
        if(!is_integer($nb) OR $nb < 1 OR !is_integer($debut) OR $debut < 0){
         
            return false;
            
        }
        
        //si $nb =1 on veut un billet precis --> recherche par id donc $debut sera un id
        if($nb == 1){
            
            return $this->db->select('*')
            ->from($this->table)
            ->where('id',$debut)
            ->get()
            ->result();
        }
        
        
        else{
        //retourne le resultat de la requete SELECT * FROM billet en fonction d'un param de nombre de billet (pagination)
        // et d'un param de debut n° de billet 
            return $this->db->select('*')
            ->from($this->table)
            ->order_by('id','desc')
            ->limit($nb, $debut)
            ->get()
            ->result();
      
        }
           
    }
    
    public function add_billet($titre, $commentaire,$date){
        
        
        //si le titre ou le commentaire ou les deux ne sont pas initialisé alors retourne faux
        if(!isset($titre) OR !isset($commentaire)){
            
            return false;
        }
        
        //sinon tout est bon --> on mes dans un tableau les données
        $data['titre'] = $titre;
        $data['commentaire'] = $commentaire;
        $data['date'] = $date;
        
        //et on les insère en retournant vrai
        $this->db->insert($this->table, $data);
        
        return true;
        }
        
    public function update_billet($id,$titre,$commentaire,$date){
       
                
        
        //si le titre ou le commentaire ou les deux ne sont pas initialisé alors retourne faux
        if(!isset($titre) OR !isset($commentaire) OR !isset($id) OR !isset($date)){
            
            return false;
        }
        
        //sinon tout est bon --> on met dans un tableau les données
        $data['titre'] = $titre;
        $data['commentaire'] = $commentaire;
        $data['date'] = $date;       
        $this->db->where('id', $id);
        $this->db->replace($this->table, $data);
        
        return true;
        

    }
    
    public function delete_billet($id){
        
      if(!isset($id) OR !is_numeric($id)){
            
            return false;
        }
        
        //sinon tout est bon --> supprime le commentaire
        $archive = $this->db->select('*')
                ->from($this->table)
                ->where('id',$id)
                ->get()
                ->result();
        
        foreach ($archive as $billet){
         
        $data['titre'] = $billet->titre;
        $data['commentaire'] = $billet->commentaire;
        $data['date'] = $billet->date;
        
        //et on les insère en retournant vrai
        $this->db->insert('archive', $data);
        }
        
        //on supprime le billet en question
        $this->db->where('id', $id);
        $this->db->delete($this->table);
        
        return true;
        

    }  
    

    
    
        
        

    
}

