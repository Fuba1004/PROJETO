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
                                        <input type="hidden" name="produtosId" <?php if ($SUBPAGINA_ACAO == "editar") {
                                                                                    echo "value='" . $produto["produtosId"] . "'";
                                                                                } ?>>

                                        <div class="form-group">
                                            <label for="nomeInput">Categoria</label>
                                            <select type="text" class="form-control" id="nomeInput" name="categoriaId">
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
                                            <input type="text" name="produtosNome" class="form-control" id="nomeInput" placeholder="Nome" <?php if ($SUBPAGINA_ACAO == "editar") {
                                                                                                                                                echo "value='" . $produto["produtosNome"] . "'";
                                                                                                                                            } ?>>
                                        </div>

                                        <div class="form-group">
                                            <label for="permarlinkinput">produtosPermalink</label>
                                            <input type="text" name="produtosPermalink" class="form-control" id="permarlinkinput" placeholder="Permalink" <?php if ($SUBPAGINA_ACAO == "editar") {
                                                                                                                                                                echo "value='" . $produto["produtosPermalink"] . "'";
                                                                                                                                                            } ?>>
                                        </div>

                                        <div class="form-group">
                                            <label for="descricaoinput">Descrição</label>
                                            <textarea type="text" name="produtosDescricao" class="form-control" id="descricaoinput" placeholder="Descrição"><?php if ($SUBPAGINA_ACAO == "editar") {
                                                                                                                                                                echo $produto["produtosDescricao"];
                                                                                                                                                            } ?></textarea>
                                        </div>

                                        <div class="form-group">
                                            <label for="capainput">Capa</label>
                                            <?php if ($SUBPAGINA_ACAO == "editar") {
                                                echo "<br><img style='max-width: 200px;' src='" . $SITE . "/themes/images/ladies/" . $produto["produtosCapa"] . "'>";
                                            } ?>
                                            <?php if ($SUBPAGINA_ACAO == "editar") {
                                                echo '<input type="hidden" name="produtosCapa" value="' . $produto["produtosCapa"] . '">';
                                            } ?>
                                            <input type="file" name="produtosCapaFile" accept=".gif,.jpg,.jpeg,.png" class="form-control" id="capainput" style="width: auto;">
                                        </div>
                                        <div style="
    display: grid;
    grid-template-columns: auto auto;
">
                                            <div class="form-group ">
                                                <label for="precoinput">Preço</label>
                                                <input type="number" step="0.1" name="produtosPreco" class="form-control" id="precoinput" <?php if ($SUBPAGINA_ACAO == "editar") {
                                                                                                                                                echo "value='" . $produto["produtosPreco"] . "'";
                                                                                                                                            } ?> style="width: auto;">
                                            </div>

                                            <div class="form-group ">
                                                <label for="pesoinput">Peso Médio por Unidade em Gramas</label>
                                                <input type="number" step="0.1" name="produtosGramasUni" class="form-control" id="pesoinput" <?php if ($SUBPAGINA_ACAO == "editar") {
                                                                                                                                                    echo "value='" . $produto["produtosGramasUni"] . "'";
                                                                                                                                                } ?> style="width: auto;">
                                            </div>
                                        </div>

                                        <div style="width: 100%;display: flex;justify-content: space-between;">
                                            <a onclick="history.back()" class="btn btn-primary">Voltar</a>
                                            <?php

                                            if ($SUBPAGINA_ACAO == "editar") {
                                                echo '<a href="' . $BASEURL . ($PAGINA_REQ != "" ? $PAGINA_REQ : "") . ($SUBPAGINA_REQ != "" ? "/" . $SUBPAGINA_REQ : "") . '/delete/' . $produto["produtosId"] . '" class="btn btn-danger">Remover</a>';
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
                                                <th>Imagem</th>
                                                <th>Nome</th>
                                                <th>Preço</th>
                                                <th>Ação</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if (count($produtos) > 0) {
                                                for ($i = 0; $i < count($produtos); $i++) {
                                                    echo '<tr>';
                                                    echo '    <td>' . $produtos[$i]["produtosId"] . '</td>';
                                                    echo '    <td><img style="width: 60px;" src="' . $SITE . '/themes/images/ladies/' . $produtos[$i]["produtosCapa"] . '"></td>';
                                                    echo '    <td>' . $produtos[$i]["produtosNome"] . '</td>';
                                                    echo '    <td>' . $produtos[$i]["produtosPreco"] . '</td>';
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