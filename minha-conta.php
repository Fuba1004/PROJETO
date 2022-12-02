			<img class="pageBanner" src="themes/images/pageBanner.png" alt="New products">
			<h4><span>Minha Conta</span></h4>
			</section>
			<section class="main-content">
				<div class="row">

					<div class="span9">
						<h4 class="title"><span class="text"><strong>Meus</strong> Dados</span></h4>
						<form action="/criar-conta" method="post" class="form-stacked">
							<fieldset>
								<div class="control-group">
									<label class="control-label">Nome/Email</label>
									<div class="controls">
										<input type="text" placeholder="Seu Nome" value="<?php echo $SYS["data"]["usuario"]["usuarioNome"] ?>" name="usuarioNome" class="input-xlarge">
										<input type="email" placeholder="Seu Email" value="<?php echo $SYS["data"]["usuario"]["usuarioEmail"] ?>" name="usuarioEmail" class="input-xlarge">
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">RG</label>
									<div class="controls">
										<input type="text" placeholder="RG" value="<?php echo $SYS["data"]["usuario"]["usuarioRg"] ?>" name="usuarioRg" class="input-xlarge">
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">Nova Senha/Confirmação de Nova Senha:</label>
									<div class="controls">
										<input type="password" placeholder="Senha" name="usuarioSenha" class="input-xlarge">
										<input type="password" placeholder="Confirmação de Senha" name="usuarioConfirmacaoSenha" class="input-xlarge">
									</div>
								</div>

								<div class="control-group">
									<label class="control-label">Confirmação de Senha atual para atualizar:</label>
									<div class="controls">
										<input type="password" placeholder="Senha" name="usuarioSenha" class="input-xlarge">
									</div>
								</div>

								<div class="control-group">
									<label class="control-label">Endereço/Número</label>
									<div class="controls">
										<input type="text" value="<?php echo $SYS["data"]["usuario"]["usuarioLogradouro"] ?>" placeholder="Endereço" name="usuarioLogradouro">
										<input type="text" value="<?php echo $SYS["data"]["usuario"]["usuarioNumero"] ?>" placeholder="Número" name="usuarioNumero">
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">CEP/Cidade/Estado</label>
									<div class="controls">
										<input type="text" value="<?php echo $SYS["data"]["usuario"]["usuarioCep"] ?>" placeholder="CEP" name="usuarioCep">
										<input type="text" value="<?php echo $SYS["data"]["usuario"]["usuarioCidade"] ?>" placeholder="Cidade" name="usuarioCidade">
										<input type="text" value="<?php echo $SYS["data"]["usuario"]["usuarioEstado"] ?>" placeholder="Estado" name="usuarioEstado">
									</div>
								</div>

								<div class="control-group">
									<p>Para alterar seus dados é preciso vonfirmar a sua senha.</p>
								</div>
								<hr>
								<div class="actions"><input tabindex="9" class="btn btn-inverse large" type="submit" value="Atualizar meus Dados"></div>
							</fieldset>
						</form>
					</div>

					<div class="span3 col">
						<div class="block">
							<ul class="nav nav-list">
								<li class="nav-header">MENU</li>
								<li class="active"><a style="color: #fff;text-shadow: 0 -1px 0 rgb(0 0 0 / 20%);background-color: #08c;" href="./minhaconta">Meus Dados</a></li>
								<li class="active"><a href="./minhascompras">Minhas Compras</a></li>
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