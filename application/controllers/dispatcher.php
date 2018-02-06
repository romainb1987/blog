<?php
  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dispatcher extends CI_controller{
    
    private $url = '';
    private $url_dispatch ='';
    


    public function __construct() {
        parent::__construct();
        
        $this->url = current_url();
        $this->url_dispatch =  base_url().'index.php/accueil/view/';
    }
    
    public function index(){
        $this->dispatch();
    }
    
    public function dispatch(){
        
        //on met l'url dans un tableau en retirant les /
        $params = explode('/',$this->url);
        
        //recup du dernier parametre du tableau
        $param = array_slice($params, -1,1);
        
        //si celui ci est un entier -> alors c'est un parametre
        if(is_integer((int)$param)){
            
            //on recupere donc l'avant dernier parametre du tebleau
            $function = array_slice($params, -2,1);
            
            //si c'est de la fonction view alors le parametre alors le parametre correspond au debut de l'affichage 
            if($function == view){
                
                //on redirige donc en conséquence
                redirect($this->url_dispatch.$param);
            
            //dans tout les autre cas on redirige vers l'index du site
            }else{
                
                redirect($this->url_dispatch);
                
            }
               
            
        }
        
    }
    
}