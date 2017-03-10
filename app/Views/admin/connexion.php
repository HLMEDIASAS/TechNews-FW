<?php 
    $this->layout('layoutfull', ['title' => 'Connexion', 'current' => '']);
?>

<?php $this->start('css'); ?>
	
<?php $this->stop('css'); ?>

<?php $this->start('contenu'); ?>

	<div class="row">
		<div class="col-md-12">
			<form class="form-horizontal" method="POST">
				
				<h3>Connexion</h3>
				
				<!-- Titre de l'Article -->
				<div class="form-group">
				  <label class="col-md-3 control-label">Email</label>  
				  <div class="col-md-7">
				      <input name="EMAILAUTEUR" type="email" placeholder="Email" class="form-control">
				  </div>
                </div>
                
                <!-- Mot de Passe -->
				<div class="form-group">
				  <label class="col-md-3 control-label">Mot de Passe</label>  
				  <div class="col-md-7">
				      <input name="MDPAUTEUR" type="password" placeholder="********" class="form-control">
				  </div>
                </div>
				
				<!-- Bouton d'Envoi -->
				<div class="form-group">
					<div class="col-xs-9 col-xs-offset-3">
						<button type="submit" class="btn btn-primary" value="Connexion">Connexion	</button>
					</div>
				</div>
				
			</form>
		</div>

<?php $this->stop('contenu'); ?>

<?php $this->start('script') ?>
    <script>
    	$(function() {
        	console.log('jQuery is ready !')

        	// -- Requete AJAX HTTP GET avec getJSON
        	$.getJSON('http://ip-api.com/json?callback=', function(resultat) {

				console.log(resultat);
				$('<p>Votre IP est surveill&eacute;e : ' + resultat.query + ' ' + resultat.isp +'<p>').appendTo($('form'));
            	
        	});
    	});
    </script>
<?php $this->stop('script') ?>




















