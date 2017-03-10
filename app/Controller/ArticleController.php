<?php
namespace Controller;

use W\Controller\Controller;
use Model\Db\DBFactory;
use Model\Shortcut;

class ArticleController extends Controller
{
    /**
     * Affiche et Ajoute un Article dans la Base de Données
     */
    public function add() {
        
        # Connexion à la BDD
        DBFactory::start();
        
        # Vérification de $_POST
        if(!empty($_POST)) :
            
            // -- Récupération des Données POST
            extract($_POST);
        
            // -- Récupération de l'image
            $handle = new \upload($_FILES['FEATUREDIMAGEARTICLE']);
            if ($handle->uploaded) {
                $handle->file_new_name_body   = Shortcut::generateSlug($TITREARTICLE);
                $handle->image_resize         = true;
                $handle->image_x              = 1000;
                $handle->image_y              = 550;
	            $handle->image_ratio_crop      = true;
                $handle->process('assets/images/product/');
                if ($handle->processed) {
                    $FEATUREDIMAGEARTICLE = $handle->file_dst_name;
                    $handle->clean();
                } else {
                    $FEATUREDIMAGEARTICLE = 'default.jpg';
                    echo 'error : ' . $handle->error;
                }
            }
            
            // -- Ajout en BDD
            $article = \ORM::for_table('article')->create();
        
            $article->IDAUTEUR              = $IDAUTEUR;
            $article->IDCATEGORIE           = $IDCATEGORIE;
            $article->TITREARTICLE          = $TITREARTICLE;
            $article->CONTENUARTICLE        = $CONTENUARTICLE;
            $article->SPECIALARTICLE        = $SPECIALARTICLE;
            $article->SPOTLIGHTARTICLE      = $SPOTLIGHTARTICLE;
            $article->FEATUREDIMAGEARTICLE  = $FEATUREDIMAGEARTICLE;
            
            // -- Insertion
            $article->save();
            
            // -- Redirection
            $this->redirectToRoute('default_article', ['id' => $article->IDARTICLE, 'slug' => Shortcut::generateSlug($TITREARTICLE)]);  
        
        endif;
        
        # Récupérer la Liste des Auteurs
        $auteurs = \ORM::for_table('auteur')->find_result_set();
        
        # Récupérer les Catégories
        $categories = \ORM::for_table('categorie')->find_result_set();
        
        # Transmission à la Vue
        $this->show('article/add', ['auteurs' => $auteurs, 'categories' => $categories]);
    }
}


















