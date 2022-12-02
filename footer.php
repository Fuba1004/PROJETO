		<section class="our_client">
			<h4 class="title"><span class="text">Parceiros</span></h4>
			<div class="row">
				<?php
				for ($i = 0; $i < count($SYS["data"]["parceiros"]); $i++) {
					echo '<div class="span2">';
					echo '	<a href="' . $SYS["data"]["parceiros"][$i]["parceirosLink"] . '"><img alt="" src="themes/images/clients/' . $SYS["data"]["parceiros"][$i]["parceirosImagem"] . '"></a>';
					echo '</div>';
				}
				?>
			</div>
		</section>
		<section id="footer-bar">
			<div class="row">
				<div class="span3">
					<h4>Navegação</h4>
					<ul class="nav">
						<li><a href="/">Home</a></li>
						<li><a href="/produtos">Categorias</a></li>
						<li><a href="/carrinho">Carrinho</a></li>
						<li><a href="/carrinho">Contate-nos</a></li>
					</ul>
				</div>
				<div class="span4">
					<h4>Minha Conta</h4>
					<ul class="nav">
						<li><a href="/login">Login</a></li>
						<li><a href="/minhaconta">Minha Conta</a></li>
						<li><a href="/minhascompras">Minhas Compras</a></li>
					</ul>
				</div>
				<div class="span5">
					<p class="logo"><img src="themes/<?php echo $SYS["data"]["empresa"]["empresaLogo"] ?>" class="site_logo" alt=""></p>
					<p><?php echo $SYS["data"]["empresa"]["empresaResumoQuemSomos"] ?></p>
					<br />
					<span class="social_icons">
						<a class="facebook" href="#">Facebook</a>
						<a class="twitter" href="#">Twitter</a>
						<a class="skype" href="#">Skype</a>
						<a class="vimeo" href="#">Vimeo</a>
					</span>
				</div>
			</div>
		</section>
		<section id="copyright">
			<span>Copyright 2013 bootstrappage template All right reserved. Uso educacional, preservado todos os direitos.</span>
		</section>
		</div>
		<script src="themes/js/common.js"></script>
		<script src="themes/js/jquery.flexslider-min.js"></script>
		<script type="text/javascript">
			$(function() {
				$(document).ready(function() {
					$('.flexslider').flexslider({
						animation: "fade",
						slideshowSpeed: 4000,
						animationSpeed: 600,
						controlNav: false,
						directionNav: true,
						controlsContainer: ".flex-container" // the container that holds the flexslider
					});
				});
			});
		</script>
		<?php
		
		if (isset($_SESSION["mensagens"])) {
			if (count($_SESSION["mensagens"]) > 0) {
				echo '<script type="text/javascript">';
				echo 'var mensagens = ' . json_encode($_SESSION["mensagens"]) . ';';
				echo 'if(mensagens.length > 0){';
				echo '	for (let x = 0; x < mensagens.length; x++) {';
				echo '		alert(mensagens[x].titulo + " - "+mensagens[x].menssagem);';
				echo '	}';
				echo '}';
				echo '</script>';
				$_SESSION["mensagens"] = array();
			}
		}
		?>
		</body>

		</html>