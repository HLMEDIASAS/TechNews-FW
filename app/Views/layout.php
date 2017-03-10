<?php 
    use Model\News\CategorieModel;
    use Model\Db\DBFactory;
    
    $CM = new CategorieModel;
    $categories = $CM->findCategories();
    
    // --
    
    # Initialisation de la Connexion
    DBFactory::start();
    
    # Récupération des tags
    $tags = ORM::for_table('tags')->find_result_set();
    
    # Récupération des 5 derniers articles
    $lastFiveArticles = ORM::for_table('view_articles')->limit(5)->order_by_desc('DATECREATIONARTICLE')->find_result_set();
    
    # Récupération des Articles en Avant
    $specialArticles = ORM::for_table('view_articles')->where('SPECIALARTICLE', 1)->find_result_set();
    
    ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="congnd91">
    <title><?= $this->e($title) ?></title>
    <!-- Favicons -->
    <link rel="shortcut icon" href="<?= $this->assetUrl('images/favicon.png'); ?>">
    <link rel="apple-touch-icon" href="<?= $this->assetUrl('images/apple-touch-icon-57x57.png'); ?>">
    <link rel="apple-touch-icon" sizes="72x72" href="<?= $this->assetUrl('images/apple-touch-icon-72x72.png'); ?>">
    <link rel="apple-touch-icon" sizes="114x114" href="<?= $this->assetUrl('images/apple-touch-icon-114x114.png'); ?>">
    <!-- Online Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Oswald:300,400,700&subset=latin-ext" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:100,300,400,700" rel="stylesheet">
    <!-- Vender -->
    <link href="<?= $this->assetUrl('css/font-awesome.min.css'); ?>" rel="stylesheet" />
    <link href="<?= $this->assetUrl('css/bootstrap.min.css'); ?>" rel="stylesheet" />
    <link href="<?= $this->assetUrl('css/normalize.min.css'); ?>" rel="stylesheet" />
    <link href="<?= $this->assetUrl('css/owl.carousel.min.css'); ?>" rel="stylesheet" />
    <!-- Main CSS (SCSS Compile) -->
    <link href="<?= $this->assetUrl('css/main.css'); ?>" rel="stylesheet" />
    <?= $this->section('css') ?>
    <!-- JavaScripts -->
    <!--<script src="<?= $this->assetUrl('js/modernizr.js'); ?>"></script>-->
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    <!--preload-->
    <div class="loader" id="page-loader">
        <div class="loading-wrapper">
        </div>
    </div>
    <!--menu mobile-->
    <nav class="menu-res hidden-lg hidden-md ">
        <div class="menu-res-inner">
            <ul>
                <li <?php if($current == 'Accueil') { echo 'class="current"'; } ?> ><a href="<?= $this->url("default_home"); ?>">Accueil</a></li>
                    <?php foreach($categories as $categorie) : ?>
        				<li <?php if($current == $categorie->getLIBELLECATEGORIE()) { echo 'class="current"'; } ?> ><a href="<?= $this->url("default_categorie", ["categorie" => strtolower($categorie->getLIBELLECATEGORIE())]); ?>"><?= $categorie->getLIBELLECATEGORIE(); ?></a></li>
        			<?php endforeach; ?>
            </ul>
        </div>
    </nav>
    <div class="page">
        <div class="container">
            <!--header-->
            <header class="header">
                <div class="row">
                    <div class="col-md-3 col-sm-4 col-xs-12">
                        <a href="#" class="logo">
                            <img alt="Logo" src="<?= $this->assetUrl('images/logo.png'); ?>" />
                        </a>
                    </div>
                </div>
            </header>
            <!--menu-->
            <nav class="menu font-heading">
                <div class="menu-icon hidden-lg hidden-md">
                    <i class="fa fa-navicon"></i>
                    <span>MENU</span>
                </div>
                <ul class="hidden-sm hidden-xs">
                	<li <?php if($current == 'Accueil') { echo 'class="current"'; } ?> ><a href="<?= $this->url("default_home"); ?>">Accueil</a></li>
                    <?php foreach($categories as $categorie) : ?>
        				<li <?php if($current == $categorie->getLIBELLECATEGORIE()) { echo 'class="current"'; } ?> ><a href="<?= $this->url("default_categorie", ["categorie" => strtolower($categorie->getLIBELLECATEGORIE())]); ?>"><?= $categorie->getLIBELLECATEGORIE(); ?></a></li>
        			<?php endforeach; ?>
                </ul>
                <div class="search-icon">
                    <div class="search-icon-inner">
                        <i class="fa fa-search"></i>
                    </div>
                    <div class="search-box">
                        <input type="text" placeholder="Rechercher..." />
                        <button>Lancer</button>
                    </div>
                </div>
            </nav>

            <!-- CONTENU DU SITE -->
            <?= $this->section('contenu') ?>
			
			<!-- LAYOUT AVEC LA SIDEBAR -->
            <?php include_once 'sidebar.inc.php'; ?>
               
        </div></div>
        <!--footer-->
        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-4  col-sm-4 col-xs-12">
                        <div class="about">
                            <a href="#" class="logo">
                                <img alt="" src="<?= $this->assetUrl('images/logo_footer.png'); ?>" />
                            </a>
                            <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form</p>
                        </div>
                    </div>
                    <div class="col-md-3 col-md-offset-1 col-sm-4 col-xs-12">
                        <h3>NOS CATEGORIES</h3>
                        <ul class="list-category">
                            <?php foreach($categories as $categorie) : ?>
                				<li><a href="#"><?= $categorie->getLIBELLECATEGORIE(); ?></a></li>
                			<?php endforeach; ?>
                        </ul>
                    </div>
                    <div class="col-md-3 col-md-offset-1 col-sm-4 col-xs-12">
                        <h3>RECHERCHE PAR TAGS</h3>

                        <div class="list-tags">
                        	<?php foreach ($tags as $tag) {
                        	    echo '<a href="#">'.$tag->LIBELLETAGS.'</a>';
                        	}?>
                        </div>
                    </div>
                </div>
                <!--All right-->
                <div class="allright">
                    <div class="row">
                        <div class="col-sm-6 col-xs-12">
                            <p> &copy; 2017 <a href="#">TECH NEWS</a>. All rights reserved.</p>
                        </div>

                        <div class="col-sm-6 col-xs-12">
                            <ul class="list-social-icon list-social-icon-footer">
                                <li>
                                    <a href="#" class="facebook">
                                        <i class="fa fa-facebook"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="twitter">
                                        <i class="fa fa-twitter"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="google">
                                        <i class="fa fa-google"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="youtube">
                                        <i class="fa fa-youtube-play"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="pinterest">
                                        <i class="fa fa-pinterest-p"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="rss">
                                        <i class="fa fa-rss"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <!-- script file -->
    <script src="<?= $this->assetUrl('js/jquery.min.js'); ?>"></script>
    <script src="<?= $this->assetUrl('js/bootstrap.js'); ?>"></script>
    <script src="<?= $this->assetUrl('js/owl.carousel.min.js'); ?>"></script>
    <script src="<?= $this->assetUrl('js/main.js'); ?>"></script>
    <script>
		$(function() {

			// -------------------------- DEFINITION DES FONCTIONS -------------------------- //
			
			/**
			 * Validate email function with regualr expression
			 * 
			 * If email isn't valid then return false
			 * 
			 * @param email
			 * @return Boolean
			 */
			function validateEmail(email){
				var emailReg = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
				var valid = emailReg.test(email);

				if(!valid) {
			        return false;
			    } else {
			    	return true;
			    }
			}

			// -------------------------- VALIDATION NEWSLETTER -------------------------- //

			// -- Vérification de jQuery
			console.log('jQuery is Ready !');
		
			// -- 1. Ecoute le Formulaire Newsletter pour savoir a quel moment il est soumis.
			$('#newsletterForm').on('submit', function(e) {

				// -- Permet  de stopper la redirection du Submit
				e.preventDefault();
				console.log('newsletterForm is Submitted !');

				// -- 2. Je vérifie si l'adresse email est correct ...
				var email = $('#newsletterForm > input');

				// -- 3. Réinitialisation des Erreurs
				$('#newsletterForm .alert').remove();
				
				if(validateEmail(email.val())) {
					
					$.ajax({ cache : false,
						url: "<?= $this->url('default_newsletteradd'); ?>",
						type: "POST",
						data: { EMAILNEWSLETTER : email.val() }
					}).done(function(data) {

						if(data.response) {
							$('#newsletterForm').replaceWith($('<div class="alert alert-success"><strong><i class="fa fa-thumbs-up" aria-hidden="true"></i><br>Merci !</strong><br>Votre inscription est valide.</div>'));
							email.val('');
						} else {
							$('<div class="alert alert-danger"><strong><i class="fa fa-frown-o" aria-hidden="true"></i><br>D&eacute;sol&eacute; !</strong><br>Vous &egrave;tes d&eacute;j&agrave; inscrit.</div>').prependTo($('#newsletterForm'));
						}
						
					});
				     
				} else {
					$('<div class="alert alert-warning"><strong><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></br>Attention !</strong><br>V&eacute;rifiez le format de votre email.</div>').prependTo($('#newsletterForm'));
				}
				
			});
		});
    </script>
    <style>
        #newsletterForm .alert {
        	margin-bottom:0px;
        }
    </style>
    <?= $this->section('script') ?>
</body>
</html>






















