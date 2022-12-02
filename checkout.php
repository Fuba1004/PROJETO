<div style="display: flex;    justify-content: space-around;position: relative;">


    <?php
    if (!isset($_SESSION["usuario"])) {
    ?>
        <div class="span5" style="position: absolute;background-color: #ffffffe0;width: 100%;height: 100%;display: flex;align-items: center;flex-direction: column;">
            <h4 class="title"><span class="text"><strong>Login</strong> Form</span></h4>
            <form action="/login" method="post">
							<fieldset>
								<div class="control-group">
									<label class="control-label">Seu email</label>
									<div class="controls">
										<input type="text" name="usuarioEmail" placeholder="Seu email" id="username" class="input-xlarge">
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">Sua senha</label>
									<div class="controls">
										<input name="usuarioSenha" type="password" placeholder="Sua senha" id="password" class="input-xlarge">
									</div>
								</div>
								<div class="control-group">
									<input tabindex="3" class="btn btn-inverse large" type="submit" value="Entrar">
								</div><hr>
							</fieldset>
						</form>
        </div>
    <?php } ?>

    <div class="span7">
        <h4 class="title"><span class="text"><strong>Lista</strong> Produtos</span></h4>
        <div>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Unit Price</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <input type="hidden" name="acao" value="atualizar">
                    <?php

                    for ($i = 0; $i < count($SYS["data"]["produtosCarrinho"]); $i++) {
                        echo '<tr>';
                        echo '	<td><a href="product_detail.html"><img style="width: 50px;" alt="" src="themes/images/ladies/' . $SYS["data"]["produtosCarrinho"][$i]["produtosCapa"] . '"></a></td>';
                        echo '	<td>' . $SYS["data"]["produtosCarrinho"][$i]["produtosNome"] . '</td>';
                        echo '	<td>' . $SYS["data"]["produtosCarrinho"][$i]["quantidade"] . '</td>';
                        echo '	<td>R$' . number_format($SYS["data"]["produtosCarrinho"][$i]["produtosPreco"],2,",",".") . '</td>';
                        echo '	<td>R$' . number_format($SYS["data"]["produtosCarrinho"][$i]["produtosPrecoTotal"],2,",",".") . '</td>';
                        echo '</tr>			  ';
                    }
                    ?>
                </tbody>
            </table>

        </div>
    </div>


    <div class="span5">
        <h4 class="title"><span class="text"><strong>Fechamento</strong> Pedido</span></h4>

        <div class="span3 col" style="width: 90%;">
            <div class="block">
                <h4 class="title"><strong>Valores</strong> Pagar</h4>
                <strong>Sub-Total</strong>: R$<?php echo number_format($SYS["data"]["checkout"]["subtotal"],2,",","."); ?><br>
                <strong>Peso Total</strong>: <?php echo $SYS["data"]["checkout"]["peso-total"]; ?> gramas<br>
                <strong>Entrega</strong>: <?php echo number_format($SYS["data"]["checkout"]["taxa-entrega"],2,",",".") ?><br>
                <strong>Total</strong>: <?php echo number_format($SYS["data"]["checkout"]["total"],2,",","."); ?><br>
                    <p>Entregas acima de 1kg será cobrado o valor de entrega!</p>
            </div>
        </div>
        <div class="span4 col" style="width: 90%;">
            <div class="block">
                <h4 class="title"><strong>Dados do </strong> Cartão</h4>


                <div>
                    <label class="control-label">Número do cartão</label>
                    <div>
                        <input style="width: auto;" type="text" class="input-xlarge">
                    </div>

                    <div style="display: flex;">
                        <div style="display: flex;width: 50%;align-items: center;gap: 7px;"><span>Válidade: </span><input style="width: inherit;" type="text"></div>
                        <div style="display: flex;width: 50%;align-items: center;gap: 7px;"><span>Cód Seg: </span><input style="width: inherit;" type="text"></div>
                    </div>
                    <form action="/checkout-finalizar" method="POST">
                    <button style="margin: 10px;" class="btn btn-inverse">Pagar</button>
                    </form>
                </div>


            </div>
        </div>
    </div>


</div>