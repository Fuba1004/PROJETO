    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Produtos</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?php echo $BASEURL ?>">Painel</a></li>
                            <li class="breadcrumb-item active">Produtos</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <?php
                                    if ($SUBPAGINA_ACAO == "editar") {
                                        echo "Editar Produto";
                                    } else if ($SUBPAGINA_ACAO == "adicionar") {
                                        echo "Adicionar Produto";
                                    } else {
                                        echo "Produtos cadastrados";
                                    }
                                    ?>
                                </h3>

                            </div>

                            <div class="card-body">


                                <?php
                                if ($SUBPAGINA_ACAO == "editar" || $SUBPAGINA_ACAO == "adicionar") {
                                ?>
                                    <form action="<?php echo $BASEURL . ($PAGINA_REQ != "" ? $PAGINA_REQ : "") . ($SUBPAGINA_REQ != "" ? "/" . $SUBPAGINA_REQ : "") . ($SUBPAGINA_ACAO == "editar" ? "/update" : "") . ($SUBPAGINA_ACAO == "adicionar" ? "/insert" : "") ?>" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="produtosId" <?php if ($SUBPAGINA_ACAO == "editar") {
                                                                                    echo "value='" . $produto["produtosId"] . "'";
                                                                                } ?>>

                                        <div class="form-group">
                                            <label for="nomeInput">Nome</label>
                                            <input type="text" disabled name="produtosNome" class="form-control" id="nomeInput" placeholder="Nome" <?php if ($SUBPAGINA_ACAO == "editar") {
                                                                                                                                                        echo "value='" . $produto["produtosNome"] . "'";
                                                                                                                                                    } ?>>
                                        </div>

                                        <div>
                                            <button style="margin-bottom: 20px;" type="button" onclick="adicionarSKU()" class="btn btn-success">Novo</button>
                                        </div>



                                        <div id="SKU-container">



                                        </div>


                                        <script>
                                            var produtoEstoque = JSON.parse('<?php echo json_encode($produtoEstoque) ?>');

                                            function removerSKU(btn) {
                                                btn.parentElement.querySelector('[name="acao[]"]').value = "remover";
                                                btn.parentElement.style.display = "none";
                                            }

                                            function adicionarSKU() {
                                                let d = document.createElement("div");
                                                document.querySelector("#SKU-container").append(d);
                                                d.innerHTML = itemSKU("adicionar", -1, "", 0)
                                            }

                                            function alteracaoSKU(btn) {
                                                btn.parentElement.querySelector('[name="acao[]"]').value = "atualizar";
                                            }

                                            function itemSKU(acao, id, sku,estoqueKiloGrama) {
                                                let funcoes = ''
                                                if(id != "-1"){
                                                    funcoes = 'onchange="alteracaoSKU(this)" onpaste="alteracaoSKU(this)" onkeyup="alteracaoSKU(this)"'
                                                }
                                                html = '<div class="form-group" style="display: flex;gap: 10px;">';
                                                html += '    <input type="hidden" name="acao[]" value="' + acao + '">';
                                                html += '    <input type="hidden" name="estoqueId[]" value="' + id + '">';
                                                html += 'Caixa: <input '+funcoes+' type="text" name="estoqueSKU[]" class="form-control" placeholder="Número lote ou breve descrição do agrupamento" value="' + sku + '">';
                                                html += 'Quantidade: <input '+funcoes+' type="number" name="estoqueKiloGrama[]" class="form-control" placeholder="SKU" value="' + estoqueKiloGrama + '">Gramas';

                                                html += '    <button type="button" onclick="removerSKU(this)" class="btn btn-danger">remover</button>';
                                                html += '</div>';
                                                return html;
                                            }

                                            if (produtoEstoque.length > 0) {
                                                for (let x = 0; x < produtoEstoque.length; x++) {
                                                    let d = document.createElement("div");
                                                    document.querySelector("#SKU-container").append(d);
                                                    d.innerHTML = itemSKU("nada", produtoEstoque[x].estoqueId, produtoEstoque[x].estoqueSKU,produtoEstoque[x].estoqueKiloGrama)
                                                }
                                            }
                                        </script>





                                        <div style="width: 100%;display: flex;justify-content: space-between;">
                                            <a onclick="history.back()" class="btn btn-primary">Voltar</a>

                                            <button type="submit" class="btn btn-warning">Salvar</button>
                                        </div>


                                    </form>

                                    <script>
                                        document.addEventListener("submit", function(event) {
                                            event.preventDefault();
                                            let a = confirm("Clique em sim para confirmar a operação!")
                                            if (a) {
                                                event.target.submit();
                                            }
                                        })
                                    </script>

                                <?php
                                } else {
                                ?>
                                    <table id="tabela-simples" class="table table-bordered table-hover">

                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Imagem</th>
                                                <th>Nome</th>
                                                <th>Disponível</th>
                                                <th>Ação</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if (count($produtos) > 0) {
                                                for ($i = 0; $i < count($produtos); $i++) {
                                                    echo '<tr>';
                                                    echo '    <td>' . $produtos[$i]["produtosId"] . '</td>';
                                                    echo '    <td><img style="width: 60px;" src="'.$SITE.'/themes/images/ladies/' . $produtos[$i]["produtosCapa"] . '"></td>';
                                                    echo '    <td>' . $produtos[$i]["produtosNome"] . '</td>';
                                                    echo '    <td>' . $produtos[$i]["disponivel"] . ' gramas</td>';
                                                    echo '    <td><a href="' . $BASEURL . ($PAGINA_REQ != "" ? $PAGINA_REQ : "") . ($SUBPAGINA_REQ != "" ? "/" . $SUBPAGINA_REQ : "") . '/editar/' . $produtos[$i]["produtosId"] . '">Editar</a></td>';
                                                    echo '</tr>';
                                                }
                                            }
                                            ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Id</th>
                                                <th>Imagem</th>
                                                <th>Nome</th>
                                                <th>Preço</th>
                                                <th>Ação</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                <?php
                                }
                                ?>


                            </div>

                        </div>

                    </div>

                </div>
            </div>
        </section>

        <!-- /.content-header -->
    </div>