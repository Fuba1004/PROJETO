			<img class="pageBanner" src="themes/images/pageBanner.png" alt="New products">
			<h4><span>Minha Conta</span></h4>
			</section>
			<section class="main-content">
				<div class="row">

					<div class="span9">

						<h4 class="title"><span class="text"><strong>Minhas</strong> Compras</span></h4>


						
						

						<table class="table table-striped">
							<thead>
								<tr>
									<th>Image</th>
									<th>Product Name</th>
									<th>Preço</th>
									<th>Data</th>
									<th>Status</th>
								</tr>
							</thead>
							<tbody>
								<input type="hidden" name="acao" value="atualizar">
								<?php
								for ($i=0; $i < count($SYS["data"]["minhasCompras"]); $i++) { 
									echo'<tr>';
									echo '	<td><a href="./produto?produto='.$SYS["data"]["minhasCompras"][$i]["produtosPermalink"].'"><img style="width: 50px;" alt="" src="themes/images/ladies/' . $SYS["data"]["minhasCompras"][$i]["produtosCapa"] . '"></a></td>';
									echo'	<td>'.$SYS["data"]["minhasCompras"][$i]["produtosNome"].'</td>';
									echo'	<td>R$'.$SYS["data"]["minhasCompras"][$i]["produtosPreco"].'</td>';
									echo'	<td>'.$SYS["data"]["minhasCompras"][$i]["vendaIdData"].'</td>';
									echo'	<td>'.$SYS["data"]["minhasCompras"][$i]["tiposVendaNome"].'</td>';
									echo'</tr>';
								}
								?>
				
							</tbody>
						</table>



					</div>

					<div class="span3 col">
						<div class="block">
							<ul class="nav nav-list">
								<li class="nav-header">MENU</li>
								<li class="active"><a href="./minhaconta">Meus Dados</a></li>
								<li class="active"><a style="color: #fff;text-shadow: 0 -1px 0 rgb(0 0 0 / 20%);background-color: #08c;" href="./minhascompras">Minhas Compras</a></li>
							</ul>
						</div>
						<div class="block">
							<h4 class="title">
								<span class="pull-left"><span class="text">Visitados</span></span>
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
										echo '		<a href="products.html" class="category">' . $SYS["data"]["produtosRelacionados"][$i]['categoriaNome'] . '</a>';
										echo '		<p class="price">R$' . $SYS["data"]["produtosRelacionados"][$i]['produtosPreco'] . '</p>';
										echo '	</div>';
										echo '</li>';

										echo "</ul></div>";
									}
									?>

								</div>
							</div>
						</div>

					</div>
				</div>
			</section>