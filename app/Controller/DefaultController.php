<?php

namespace Controller;

use \W\Controller\Controller;
use Model\Db\DBFactory;

class DefaultController extends Controller
{

	/**
	 * Page d'accueil par d�faut
	 */
	public function home() {
	    
	    # Connexion a la BDD
	    DBFactory::start();
	    
	    # R�cup�ration des Articles en SPOTLIGHT
	    $spotlights = \ORM::for_table('view_articles')->where('SPOTLIGHTARTICLE', 1)->find_result_set();
	    
	    # R�cup�rations des Articles de la Page d'Accueil
	    $articles = \ORM::for_table('view_articles')->find_result_set();
	    
	    # Transmettre � la Vue
	    $this->show('default/home', ['spotlights' => $spotlights, 'articles' => $articles]);
	}
	
	/**
	 * Permet d'afficher les articles d'une cat�gorie
	 * @param STRING $categorie
	 */
	public function categorie($categorie) {
	    # Connexion a la BDD
	    DBFactory::start();
	    
	    # R�cup�rations des Articles de la Cat�gorie
	    $articles  = \ORM::for_table('view_articles')->where('LIBELLECATEGORIE', ucfirst($categorie))->find_result_set();
	    $nbarticles = $articles->count();
	
	    # Transmettre � la Vue
	    $this->show('default/categorie', ['articles' => $articles, 'categorie' => $categorie, 'nbarticles' => $nbarticles]);
	    
	}

	/**
	 * Permet d'afficher un Article
	 * @param Entier $id IDARTICLE
	 * @param String $slug SLUGARTICLE
	 */
	public function article($id, $slug) {
	    
	    # Connexion a la BDD
	    DBFactory::start();
	    
	    # R�cup�ration des Donn�es de l'Article
	    $article = \ORM::for_table('view_articles')->find_one($id);
	    
	    # Suggestions
	    $suggestions = \ORM::for_table('view_articles')->where('IDCATEGORIE', $article->IDCATEGORIE)->where_not_equal('IDARTICLE', $id)->limit(3)->order_by_desc('IDARTICLE')->find_result_set();
	    
	    # Transmettre � la Vue
	    $this->show('default/article', ['article' => $article, 'suggestions' => $suggestions, 'categorie' => $article->LIBELLECATEGORIE]);
	    
	}
	
	/**
	 * Ajout d'une adresse email dans la BDD
	 */
	public function newsletteradd() {
	    
	    if(!empty($_POST)) {
	        
	       # Initialisation de la BDD
	        DBFactory::start();
	        
	        // -- V�rification si l'adresse email existe en BDD
	        $isEmail = \ORM::for_table('newsletter')->where('EMAILNEWSLETTER', $_POST['EMAILNEWSLETTER'])->count();
	        
	        if(!$isEmail) :
	           # Elle n'existe pas donc on l'ajoute � la BDD
	           $news = \ORM::for_table('newsletter')->create();
	           $news->EMAILNEWSLETTER = $_POST['EMAILNEWSLETTER'];
	           $news->save();
	           # On renvoie true
	           $result = ['response' => true];
	        else :
	           # L'adresse Email existe d�j�, on renvoie false;
	           $result = ['response' => false];
	        endif;
	        
	        $this->showJson($result);
	        
	    }
	    
	}

}












