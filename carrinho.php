			<section class="header_text sub">
				<img class="pageBanner" src="themes/images/pageBanner.png" alt="New products">
				<h4><span>Carrinho</span></h4>
			</section>
			<section class="main-content">
				<div class="row">
					<div class="span12">
						<h4 class="title"><span class="text"><strong>Seu </strong> Carrinho</span></h4>

						<table class="table table-striped">
							<thead>
								<tr>
									<th>Remover</th>
									<th>Imagem</th>
									<th>Nome</th>
									<th>Quantidade</th>
									<th>Gramas Uni</th>
									<th>Gramas</th>
									<th>Preço Uni</th>
									<th>Total</th>
								</tr>
							</thead>
							<tbody>
								<input type="hidden" name="acao" value="atualizar">
								<?php

								for ($i = 0; $i < count($SYS["data"]["produtosCarrinho"]); $i++) {
									echo '<tr>';
									//
									echo '	<td><input type="checkbox" onchange="descheck(this)">';
									echo '		<input type="hidden" name="acaoItem[]" value="atualizar">';
									echo '		<input type="hidden" name="produtosId[]" value="' . $SYS["data"]["produtosCarrinho"][$i]["produtosId"] . '"></td>';
									echo '	<td> <a href="./produto?produto='.$SYS["data"]["produtosCarrinho"][$i]["produtosPermalink"].'"><img style="width: 50px;" alt="" src="themes/images/ladies/' . $SYS["data"]["produtosCarrinho"][$i]["produtosCapa"] . '"></a></td>';
									echo '	<td>' . $SYS["data"]["produtosCarrinho"][$i]["produtosNome"] . '</td>';
									echo '	<td><input type="number" onchange="somaQuantidade(this)" name="produtosQuantidade[]" value="' . $SYS["data"]["produtosCarrinho"][$i]["quantidade"] . '" class="input-mini"></td>';
									echo '	<td>' . $SYS["data"]["produtosCarrinho"][$i]["produtosGramasUni"]. '</td>';
									echo '	<td>' . ($SYS["data"]["produtosCarrinho"][$i]["produtosGramasUni"] * $SYS["data"]["produtosCarrinho"][$i]["quantidade"]) . '</td>';
									echo '	<td>R$' . number_format($SYS["data"]["produtosCarrinho"][$i]["produtosPreco"],2,",",".") . '</td>';
									echo '	<td>R$' . number_format($SYS["data"]["produtosCarrinho"][$i]["produtosPrecoTotal"],2,",",".") . '</td>';
									echo '</tr>			  ';
								}
								?>

								<script>
									function descheck(btn) {
										if (btn.checked) {
											const xhttp = new XMLHttpRequest();
											xhttp.onload = function() {
												if(this.responseText == "200"){
													location.href =location.href
												}
											}
											xhttp.open("POST", "/carrinho");
											xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
											xhttp.send("acao=ajax&funcao=remove&id=" + btn.parentElement.querySelector("[name='produtosId[]']").value);
										}
									}
									function somaQuantidade(btn){
										document.querySelector("#checkout").disabled = true;
										document.querySelector("#btnatualizar").disabled = false;
										const xhttp = new XMLHttpRequest();
											xhttp.onload = function() {
											}
											xhttp.open("POST", "/carrinho");
											xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
											xhttp.send("acao=ajax&funcao=somar&id=" + btn.parentElement.parentElement.querySelector("[name='produtosId[]']").value+"&quantidade="+btn.value);
									}
								</script>
							</tbody>
						</table>

						<hr>
						<p class="cart-total right">
							<p>Obserção: não estão embutidos no preço as taxas, serão informadas na hora do fechamento!</p>
							<strong>Sub-Total</strong>: R$<?php echo number_format($SYS["data"]["checkout"]["subtotal"],2,",","."); ?><br>
							<strong>Total</strong>: <?php echo number_format($SYS["data"]["checkout"]["total"],2,",","."); ?><br>
						</p>
						<hr />
						<p class="buttons center">
							<button class="btn" onclick="location.href = location.href" type="submit" id="btnatualizar" disabled>Atualizar</button>
							<a class="btn" href="/">Continuar Comprando</a>
							<a class="btn btn-inverse"  id="checkout" <?php echo count($SYS["data"]["produtosCarrinho"]) == 0 ? "disabled":'href="/checkout"' ?>>Checkout</a>
						</p>

					</div>

				</div>
			</section>