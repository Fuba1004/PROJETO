    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Categorias</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?php echo $BASEURL ?>">Painel</a></li>
                            <li class="breadcrumb-item active">Categorias</li>
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
                                    Categorias
                                </h3>

                            </div>

                            <div class="card-body">



                                <form action="<?php echo $BASEURL . ($PAGINA_REQ != "" ? $PAGINA_REQ : "") . ($SUBPAGINA_REQ != "" ? "/" . $SUBPAGINA_REQ : "") . ($SUBPAGINA_ACAO == "editar" ? "/update" : "") . ($SUBPAGINA_ACAO == "adicionar" ? "/insert" : "") ?>" method="post" enctype="multipart/form-data">

                                    <div>
                                        <button style="margin-bottom: 20px;" type="button" onclick="adicionarCategoria()" class="btn btn-success">Novo</button>
                                    </div>



                                    <div id="SKU-container">



                                    </div>


                                    <script>
                                        var tiposDisponibilidade = []
                                        var produtoEstoque = <?php echo json_encode($categorias) ?>

                                        function removerCategoria(btn) {
                                            btn.parentElement.querySelector('[name="acao[]"]').value = "remover";
                                            btn.parentElement.style.display = "none";
                                        }

                                        function adicionarCategoria() {
                                            let d = document.createElement("div");
                                            document.querySelector("#SKU-container").append(d);
                                            d.innerHTML = itemCategoria("adicionar", -1, "", "","")
                                        }

                                        function alteracaoCategoria(btn) {
                                            btn.parentElement.querySelector('[name="acao[]"]').value = "atualizar";
                                        }

                                        function itemCategoria(acao, categoriaId, categoriaNome,categoriaDescricao,categoriaPermalink) {
                                            let funcoes = ''
                                            if (categoriaId != "-1") {
                                                funcoes = 'onchange="alteracaoCategoria(this)" onpaste="alteracaoCategoria(this)" onkeyup="alteracaoCategoria(this)"'
                                            }
                                            html = '<div class="form-group" style="display: flex;gap: 10px;">';
                                            html += '    <input type="hidden" name="acao[]" value="' + acao + '">';
                                            html += '    <input type="hidden" name="categoriaId[]" value="' + categoriaId + '">';
                                            html += 'Nome: <input ' + funcoes + ' type="text" name="categoriaNome[]" class="form-control" placeholder="Categoria" value="' + categoriaNome + '">';
                                            html += 'Descriçao: <input ' + funcoes + ' type="text" name="categoriaDescricao[]" class="form-control" placeholder="Descrição" value="' + categoriaDescricao + '">';
                                            html += 'Permalink: <input ' + funcoes + ' type="text" name="categoriaPermalink[]" class="form-control" placeholder="Permalink" value="' + categoriaPermalink + '">';


                                            html += '    <button type="button" onclick="removerCategoria(this)" class="btn btn-danger">remover</button>';
                                            html += '</div>';
                                            return html;
                                        }

                                        if (produtoEstoque.length > 0) {
                                            for (let x = 0; x < produtoEstoque.length; x++) {
                                                let d = document.createElement("div");
                                                document.querySelector("#SKU-container").append(d);
                                                d.innerHTML = itemCategoria("nada", produtoEstoque[x].categoriaId, produtoEstoque[x].categoriaNome, produtoEstoque[x].categoriaDescricao, produtoEstoque[x].categoriaPermalink)
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




                            </div>

                        </div>

                    </div>

                </div>
            </div>
        </section>

        <!-- /.content-header -->
    </div>