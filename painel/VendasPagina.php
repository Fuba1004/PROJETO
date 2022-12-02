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
                                <a style="float: right;" href="<?php echo $BASEURL . ($PAGINA_REQ != "" ? $PAGINA_REQ : "") . ($SUBPAGINA_REQ != "" ? "/" . $SUBPAGINA_REQ : "") . "/adicionar" ?>" class="btn btn-success">Novo</a>
                            </div>

                            <div class="card-body">


                                <?php
                                if ($SUBPAGINA_ACAO == "editar" || $SUBPAGINA_ACAO == "adicionar") {
                                ?>
                                    <form action="<?php echo $BASEURL . ($PAGINA_REQ != "" ? $PAGINA_REQ : "") . ($SUBPAGINA_REQ != "" ? "/" . $SUBPAGINA_REQ : "") . ($SUBPAGINA_ACAO == "editar" ? "/update" : "") . ($SUBPAGINA_ACAO == "adicionar" ? "/insert" : "") ?>" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="vendaId" <?php if ($SUBPAGINA_ACAO == "editar") {
                                                                                    echo "value='" . $produto["vendaId"] . "'";
                                                                                } ?>>
                                        <fieldset>
                                            <legend>Produto</legend>
                                            <div class="row">
                                                <div class="col-12" style="display: grid;grid-template-columns: auto auto auto;gap: 10px;">

                                                    <div class="form-group">
                                                        <label for="nomeInput">Categoria</label>
                                                        <select type="text" class="form-control" id="nomeInput" name="categoriaId" disabled>
                                                            <option value="">Selecione uma categoria</option>
                                                            <?php
                                                            if ($SUBPAGINA_ACAO == "editar") {
                                                                echo "value='" . $produto["produtosNome"] . "'";
                                                            }
                                                            if (count($categorias) > 0) {
                                                                for ($i = 0; $i < count($categorias); $i++) {
                                                                    echo '<option value="' . $categorias[$i]["categoriaId"] . '"  ' . ($produto["categoriaId"] == $categorias[$i]["categoriaId"] ? "selected" : "") . '>' . $categorias[$i]["categoriaNome"] . '</option>';
                                                                }
                                                            }
                                                            ?>

                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="nomeInput">Nome</label>
                                                        <input disabled type="text" name="produtosNome" class="form-control" id="nomeInput" placeholder="Nome" <?php if ($SUBPAGINA_ACAO == "editar") {
                                                                                                                                                                    echo "value='" . $produto["produtosNome"] . "'";
                                                                                                                                                                } ?>>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="permarlinkinput">produtosPermalink</label>
                                                        <input disabled type="text" name="produtosPermalink" class="form-control" id="permarlinkinput" placeholder="Permalink" <?php if ($SUBPAGINA_ACAO == "editar") {
                                                                                                                                                                                    echo "value='" . $produto["produtosPermalink"] . "'";
                                                                                                                                                                                } ?>>
                                                    </div>

                                                </div>
                                            </div>


                                            <div class="row">
                                                <div class="col-12" style="display: grid;grid-template-columns: auto auto auto;gap: 10px;">

                                                    <?php
                                                    echo "<img style='max-width: 90px;' src='" . $SITE . "/themes/images/ladies/" . $produto["produtosCapa"] . "'>";
                                                    ?>

                                                    <div class="form-group">
                                                        <label for="descricaoinput">Descrição</label>
                                                        <textarea disabled type="text" name="produtosDescricao" class="form-control" id="descricaoinput" placeholder="Descrição"><?php if ($SUBPAGINA_ACAO == "editar") {
                                                                                                                                                                                        echo $produto["produtosDescricao"];
                                                                                                                                                                                    } ?></textarea>

                                                    </div>

                                                    <div class="form-group col-2">
                                                        <label for="precoinput">Preço</label>
                                                        <input disabled type="number" step="0.1" name="produtosPreco" class="form-control" id="precoinput" <?php if ($SUBPAGINA_ACAO == "editar") {
                                                                                                                                                                echo "value='" . $produto["produtosPreco"] . "'";
                                                                                                                                                            } ?> style="width: auto;">
                                                    </div>

                                                </div>
                                            </div>

                                        </fieldset>








                                        <fieldset>
                                            <legend>Usuário</legend>
                                            <div class="row">
                                                <div class="col-12" style="display: grid;grid-template-columns: auto auto;gap: 10px;">
                                                    <div class="form-group">
                                                        <label for="nomeInput">Nome</label>
                                                        <input disabled type="text" name="produtosNome" class="form-control" id="nomeInput" placeholder="Nome" <?php if ($SUBPAGINA_ACAO == "editar") {
                                                                                                                                                                    echo "value='" . $produto["usuarioNome"] . "'";
                                                                                                                                                                } ?>>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="nomeInput">Email</label>
                                                        <input disabled type="text" name="produtosNome" class="form-control" id="nomeInput" placeholder="Nome" <?php if ($SUBPAGINA_ACAO == "editar") {
                                                                                                                                                                    echo "value='" . $produto["usuarioEmail"] . "'";
                                                                                                                                                                } ?>>
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>




                                        <fieldset>
                                            <legend>Venda</legend>
                                            <div class="row">
                                                <div class="col-12" style="display: grid;grid-template-columns: auto auto auto;gap: 10px;">
                                                    <div class="form-group">
                                                        <label for="nomeInput">Preço</label>
                                                        <input disabled type="text" name="produtosNome" class="form-control" id="nomeInput" placeholder="Nome" <?php if ($SUBPAGINA_ACAO == "editar") {
                                                                                                                                                                    echo "value='" . $produto["vendaIdPreco"] . "'";
                                                                                                                                                                } ?>>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="nomeInput">Peso</label>
                                                        <input disabled type="text" name="produtosNome" class="form-control" id="nomeInput" placeholder="Nome" <?php if ($SUBPAGINA_ACAO == "editar") {
                                                                                                                                                                    echo "value='" . $produto["vendaIdPeso"] . "'";
                                                                                                                                                                } ?>>
                                                    </div>


                                                    <div class="form-group">
                                                        <label for="nomeInput">Status</label>
                                                        <select type="text" class="form-control" id="nomeInput" name="tiposVendaId">
                                                            <?php
                                                            if (count($tiposVendas) > 0) {
                                                                for ($i = 0; $i < count($tiposVendas); $i++) {
                                                                    echo '<option value="' . $tiposVendas[$i]["tiposVendaId"] . '"  ' . ($produto["tiposVendaId"] == $tiposVendas[$i]["tiposVendaId"] ? "selected" : "") . '>' . $tiposVendas[$i]["tiposVendaNome"] . '</option>';
                                                                }
                                                            }
                                                            ?>

                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>



                                        <div style="width: 100%;display: flex;justify-content: space-between;">
                                            <a onclick="history.back()" class="btn btn-primary">Voltar</a>
                                            <?php

                                            if ($SUBPAGINA_ACAO == "editar") {
                                                echo '<a href="' . $BASEURL . ($PAGINA_REQ != "" ? $PAGINA_REQ : "") . ($SUBPAGINA_REQ != "" ? "/" . $SUBPAGINA_REQ : "") . '/delete/' . $produto["vendaId"] . '" class="btn btn-danger">Remover</a>';
                                            } ?>
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
                                                <th>Capa</th>
                                                <th>Nome</th>
                                                <th>Usuário</th>
                                                <th>Email</th>
                                                <th>Preço</th>
                                                <th>Data</th>
                                                <th>Status</th>
                                                <th>Ação</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if (count($vendas) > 0) {
                                                for ($i = 0; $i < count($vendas); $i++) {
                                                    echo '<tr>';
                                                    echo '    <td>' . $vendas[$i]["vendaId"] . '</td>';
                                                    echo '    <td><img style="width: 60px;" src="/themes/images/ladies/' . $vendas[$i]["produtosCapa"] . '"></td>';
                                                    echo '    <td><a target="_blank" href="/produto?produto=' . $vendas[$i]["produtosPermalink"] . '">' . $vendas[$i]["produtosNome"] . '</a></td>';
                                                    echo '    <td>' . $vendas[$i]["usuarioNome"] . '</td>';
                                                    echo '    <td>' . $vendas[$i]["usuarioEmail"] . '</td>';
                                                    echo '    <td>' . $vendas[$i]["vendaIdPreco"] . '</td>';
                                                    echo '    <td>' . $vendas[$i]["vendaIdData"] . '</td>';
                                                    echo '    <td>' . $vendas[$i]["tiposVendaNome"] . '</td>';
                                                    echo '    <td><a href="' . $BASEURL . ($PAGINA_REQ != "" ? $PAGINA_REQ : "") . ($SUBPAGINA_REQ != "" ? "/" . $SUBPAGINA_REQ : "") . '/editar/' . $vendas[$i]["vendaId"] . '">Editar</a></td>';
                                                    echo '</tr>';
                                                }
                                            }
                                            ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Id</th>
                                                <th>Capa</th>
                                                <th>Nome</th>
                                                <th>Usuário</th>
                                                <th>Email</th>
                                                <th>Preço</th>
                                                <th>Data</th>
                                                <th>Status</th>
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