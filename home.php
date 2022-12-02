<section class="homepage-slider" id="home-slider">
	<div class="flexslider">
		<ul class="slides">
			<?php
			for ($i = 0; $i < count($SYS["data"]["banners"]); $i++) {
				echo '<li>';
				echo '	<img src="themes/images/carousel/' . $SYS["data"]["banners"][$i]["bannersCapa"] . '" alt="" />';
				echo '	<div class="intro">';
				if ($SYS["data"]["banners"][$i]["bannersTitulo"] != "") echo '		<h1>' . $SYS["data"]["banners"][$i]["bannersTitulo"] . '</h1>';
				if ($SYS["data"]["banners"][$i]["bannersSubTitulo"] != "") echo '		<p><span>' . $SYS["data"]["banners"][$i]["bannersSubTitulo"] . '</span></p>';
				if ($SYS["data"]["banners"][$i]["bannersParagrafo"] != "") echo '		<p><span>' . $SYS["data"]["banners"][$i]["bannersParagrafo"] . '</span></p>';
				echo '	</div>';
				echo '</li>';
			}
			?>
		</ul>
	</div>
</section>
<section class="main-content">
	<div class="row">
		<div class="span12">
			<div class="row feature_box">
				<?php
				for ($i = 0; $i < count($SYS["data"]["breadcrumps"]); $i++) {
					echo '<div class="span4">';
					echo '	<div class="service">';
					echo '		<div class="responsive">';
					echo '			<img src="themes/images/' . $SYS["data"]["breadcrumps"][$i]["breadcrumpsIcone"] . '" alt="" />';
					echo '			<h4>' . explode(" ", $SYS["data"]["breadcrumps"][$i]["breadcrumpsTitulo"])[0] . ' <strong>' . explode(" ", $SYS["data"]["breadcrumps"][$i]["breadcrumpsTitulo"])[1] . '</strong></h4>';
					echo '			<p>' . $SYS["data"]["breadcrumps"][$i]["breadcrumpsParagrafo"] . '</p>';
					echo '		</div>';
					echo '	</div>';
					echo '</div>';
				}
				?>
			</div>
			<div class="row">
				<div class="span12">
					<h4 class="title">
						<span class="pull-left"><span class="text"><span class="line">Nossos <strong>Produtos</strong></span></span></span>
						<?php
						if (count($SYS["data"]["produtos"]) > 4){
						?>
						<span class="pull-right">
							<a class="left button" href="#myCarousel" data-slide="prev"></a><a class="right button" href="#myCarousel" data-slide="next"></a>
						</span>
						<?php } ?>
					</h4>
					<div id="myCarousel" class="myCarousel carousel slide">
						<div class="carousel-inner">
							<?php
							if (count($SYS["data"]["produtos"]) > 4) {
								$quantidade = floor(count($SYS["data"]["produtos"]) / 4);
								for ($i = 0; $i < $quantidade; $i++) {
									echo '	<div class="' . ($i == 0 ? 'active' : '') . ' item"><ul class="thumbnails">';
									for ($i2 = ((($i * 4) - 4) < 0 ? 0 : $i * 4); $i2 < ((($i * 4) + 4) > count($SYS["data"]["produtos"]) ? count($SYS["data"]["produtos"]) : (($i * 4) + 4)); $i2++) {
										echo $this->templateProduto(
											$SYS["data"]["produtos"][$i2]['categoriaNome'],
											$SYS["data"]["produtos"][$i2]['produtosNome'],
											$SYS["data"]["produtos"][$i2]['produtosCapa'],
											$SYS["data"]["produtos"][$i2]["produtosPermalink"],
											$SYS["data"]["produtos"][$i2]['produtosPreco'],
											$SYS["data"]["produtos"][$i2]["produtosGramasUni"]
										);
									}
									echo "</ul></div>";
								}
							} else if (count($SYS["data"]["produtos"]) > 0) {
								echo '<ul class="thumbnails">';
								for ($i = 0; $i < count($SYS["data"]["produtos"]); $i++) {
									echo $this->templateProduto(
										$SYS["data"]["produtos"][$i]['categoriaNome'],
										$SYS["data"]["produtos"][$i]['produtosNome'],
										$SYS["data"]["produtos"][$i]['produtosCapa'],
										$SYS["data"]["produtos"][$i]["produtosPermalink"],
										$SYS["data"]["produtos"][$i]['produtosPreco'],
										$SYS["data"]["produtos"][$i]["produtosGramasUni"]
									);
								}
								echo "</ul>";
							} else {
								echo "<h2>Sem Produtos</h2>";
							}
							?>
						</div>
					</div>
				</div>
			</div>
			<br />
		</div>
	</div>
</section>