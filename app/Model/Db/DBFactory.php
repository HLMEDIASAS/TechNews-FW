<?php
namespace Model\Db;
use ORM;

/* --
 * Le fait de déclarer des propriétés ou des méthodes comme 
 * statiques vous permet d'y accéder sans avoir besoin d'instancier 
 * la classe. On ne peut accéder à une propriété déclarée comme statique 
 * avec l'objet instancié d'une classe (bien que ce soit possible pour 
 * une méthode statique).
 * Docs : http://php.net/manual/fr/language.oop5.static.php
 */
class DBFactory
{   
    public static function start() {
        
        // -- Récupération des Données de l'App
        $app = getApp();
        
        // -- Initialisation de Idiorm
        ORM::configure('mysql:host='.$app->getConfig('db_host').';dbname='.$app->getConfig('db_name'));
        ORM::configure('username', $app->getConfig('db_user'));
        ORM::configure('password', $app->getConfig('db_pass'));

        // -- Configuration de la clé primaire de chaque table
        // : Cette configuration n'est nécessaire que si les clé primaires sont différentes de 'id'
        ORM::configure('id_column_overrides', array(
            'article'       => 'IDARTICLE',
            'auteur'        => 'IDAUTEUR',
            'categorie'     => 'IDCATEGORIE',
            'tags'          => 'IDTAGS',
            'view_articles' => 'IDARTICLE',
            'view_tags'     => 'IDARTICLE',
            'newsletter'    => 'IDNEWSLETTER'
        ));
    }
    
}

















