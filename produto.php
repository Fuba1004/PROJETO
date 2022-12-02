			<img class="pageBanner" src="themes/images/pageBanner.png" alt="New products">
			<h4><span>Detalhes</span></h4>
			</section>
			<section class="main-content">
				<div class="row">
					<div class="span9">
						
						<div class="row">
							<div class="span4">
								<a href="themes/images/ladies/<?php echo $SYS["data"]["produto"]["produtosCapa"]; ?>" class="thumbnail" data-fancybox-group="group1" title="Description 1"><img alt="" src="themes/images/ladies/<?php echo $SYS["data"]["produto"]["produtosCapa"]; ?>"></a>
								<ul class="thumbnails small" style="display:none;">
									<li class="span1">
										<a href="themes/images/ladies/2.jpg" class="thumbnail" data-fancybox-group="group1" title="Description 2"><img src="themes/images/ladies/2.jpg" alt=""></a>
									</li>
									<li class="span1">
										<a href="themes/images/ladies/3.jpg" class="thumbnail" data-fancybox-group="group1" title="Description 3"><img src="themes/images/ladies/3.jpg" alt=""></a>
									</li>
									<li class="span1">
										<a href="themes/images/ladies/4.jpg" class="thumbnail" data-fancybox-group="group1" title="Description 4"><img src="themes/images/ladies/4.jpg" alt=""></a>
									</li>
									<li class="span1">
										<a href="themes/images/ladies/5.jpg" class="thumbnail" data-fancybox-group="group1" title="Description 5"><img src="themes/images/ladies/5.jpg" alt=""></a>
									</li>
								</ul>
							</div>
							<div class="span5">
								<address>
									<h1><?php echo $SYS["data"]["produto"]["produtosNome"] ?></h1><br>

			
								</address>
								<h4><strong>Preço: R$ <?php echo $SYS["data"]["produto"]["produtosPreco"] ?> unidade</strong></h4>
								<p>Peso médio por unidade de <?php echo $SYS["data"]["produto"]["produtosGramasUni"] ?> gramas</p>
							</div>
							<div class="span5">
								<form class="form-inline" method="POST" action="/carrinho">
									<label>Quantidade:</label>
									<input type="hidden" class="span1" name="acao" value="adicionar">
									<input type="number" class="span1" value="1" name="quantidade"> unidades
									<input type="hidden" class="span1" value="<?php echo $SYS["data"]["produto"]["produtosId"] ?>" name="produtosId"><br>
									<button class="btn btn-inverse" type="submit">Adicionar ao carrinho</button>
								</form>
							</div>
						</div>
						<div class="row" style="margin-top: 10px;">
							<div class="span9">
								<ul class="nav nav-tabs" id="myTab">
									<li class="active"><a>Descrição</a></li>
								</ul>
								<div class="tab-content">
									<div class="tab-pane active" id="home"><?php echo $SYS["data"]["produto"]["produtosDescricao"] ?></div>
								</div>
							</div>
							<div class="span9">
								<br>
								<h4 class="title">
									<span class="pull-left"><span class="text"><strong>Produtos </strong> Relacionados</span></span>
									<span class="pull-right">
										<a class="left button" href="#myCarousel-1" data-slide="prev"></a><a class="right button" href="#myCarousel-1" data-slide="next"></a>
									</span>
								</h4>
								<div id="myCarousel-1" class="carousel slide">
									<div class="carousel-inner">

										<?php
										$quantidade = floor(count($SYS["data"]["produtosRelacionados"]) / 3);
										for ($i = 0; $i < $quantidade; $i++) {
											echo '	<div class="' . ($i == 0 ? 'active' : '') . ' item"><ul class="thumbnails">';
											for ($i2 = ((($i * 3) - 3) < 0 ? 0 : $i * 3); $i2 < ((($i * 3) + 3) > count($SYS["data"]["produtosRelacionados"]) ? count($SYS["data"]["produtosRelacionados"]) : (($i * 3) + 3)); $i2++) {
												echo '<li class="span3">';
												echo '	<div class="product-box">';
												echo '		<span class="sale_tag"></span>';
												echo '		<p><a href="./produto?produto=' . $SYS["data"]["produtosRelacionados"][$i2]["produtosPermalink"] . '"><img src="themes/images/ladies/' . $SYS["data"]["produtosRelacionados"][$i2]['produtosCapa'] . '" alt="" /></a></p>';
												echo '		<a href="./produto?produto=' . $SYS["data"]["produtosRelacionados"][$i2]["produtosPermalink"] . '" class="title">' . $SYS["data"]["produtosRelacionados"][$i2]['produtosNome'] . '</a><br />';
												echo '		<a href="products.html" class="category">' . $SYS["data"]["produtosRelacionados"][$i2]['categoriaNome'] . '</a>';
												echo '		<p class="price">R$' . $SYS["data"]["produtosRelacionados"][$i2]['produtosPreco'] . '</p>';
												echo '	</div>';
												echo '</li>';
											}
											echo "</ul></div>";
										}
										?>

									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="span3 col">
						<div class="block">
							<ul class="nav nav-list">
								<li class="nav-header">SUB CATEGORIAS</li>
								<?php
								for ($i = 0; $i < count($SYS["data"]["categorias"]); $i++) {
									echo '<li class="active"><a href="./produtos?categoria=' . $SYS["data"]["categorias"][$i]["categoriaPermalink"] . '">' . $SYS["data"]["categorias"][$i]["categoriaNome"] . '</a></li>';
								}
								?>
							</ul>
						</div>
						<div class="block">
							<h4 class="title">
								<span class="pull-left"><span class="text">VARIADOS</span></span>
								<span class="pull-right">
									<a class="left button" href="#myCarousel" data-slide="prev"></a><a class="right button" href="#myCarousel" data-slide="next"></a>
								</span>
							</h4>
							<div id="myCarousel" class="carousel slide">
								<div class="carousel-inner">

								
								<?php
										$quantidade = floor(count($SYS["data"]["produtosRelacionados"]) / 1);
										for ($i = 0; $i < count($SYS["data"]["produtosRelacionados"]); $i++) {
											echo '	<div class="' . ($i == 0 ? 'active' : '') . ' item"><ul class="thumbnails">';
											
												echo '<li class="span3">';
												echo '	<div class="product-box">';
												echo '		<span class="sale_tag"></span>';
												echo '		<p><a href="./produto?produto=' . $SYS["data"]["produtosRelacionados"][$i]["produtosPermalink"] . '"><img src="themes/images/ladies/' . $SYS["data"]["produtosRelacionados"][$i]['produtosCapa'] . '" alt="" /></a></p>';
												echo '		<a href="./produto?produto=' . $SYS["data"]["produtosRelacionados"][$i]["produtosPermalink"] . '" class="title">' . $SYS["data"]["produtosRelacionados"][$i]['produtosNome'] . '</a><br />';
												echo '		<a href="./produto?produto=' . $SYS["data"]["produtosRelacionados"][$i]["produtosPermalink"] . '" class="category">' . $SYS["data"]["produtosRelacionados"][$i]['categoriaNome'] . '</a>';
												echo '		<p class="price">R$' . $SYS["data"]["produtosRelacionados"][$i]['produtosPreco'] . '</p>';
												echo '	</div>';
												echo '</li>';
											
											echo "</ul></div>";
										}
										?>

								</div>
							</div>
						</div>
						<div class="block">
							<h4 class="title"><strong>MELHORES</strong> VENDAS</h4>
							<ul class="small-product">
								<?php
								for ($i=0; $i < count($SYS["data"]["produtosMaisVendidos"]); $i++) { 
									echo '<li>';
									echo '	<a href="./produto?produto=' . $SYS["data"]["produtosMaisVendidos"][$i]["produtosPermalink"] . '" title="' . $SYS["data"]["produtosMaisVendidos"][$i]["produtosNome"] . '">';
									echo '		<img src="themes/images/ladies/' . $SYS["data"]["produtosMaisVendidos"][$i]['produtosCapa'] . '" alt="' . $SYS["data"]["produtosMaisVendidos"][$i]["produtosNome"] . '">';
									echo '	</a>';
									echo '	<a href="./produto?produto=' . $SYS["data"]["produtosMaisVendidos"][$i]["produtosPermalink"] . '">' . $SYS["data"]["produtosMaisVendidos"][$i]["produtosNome"] . '</a>';
									echo '</li>';
								}
								?>
							</ul>
						</div>
					</div>
				</div>
			</section>