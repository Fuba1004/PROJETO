    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Parceiros</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?php echo $BASEURL ?>">Painel</a></li>
                            <li class="breadcrumb-item active">Parceiros</li>
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
                                        echo "Editar Parceiros";
                                    } else if ($SUBPAGINA_ACAO == "adicionar") {
                                        echo "Adicionar Produto";
                                    } else {
                                        echo "Parceiros Cadastrados";
                                    }
                                    ?>
                                </h3>
                                <a style="float: right;" href="<?php echo $BASEURL . ($PAGINA_REQ != ""?$PAGINA_REQ:""). ($SUBPAGINA_REQ != ""?"/".$SUBPAGINA_REQ:"")."/adicionar" ?>" class="btn btn-success">Novo</a>
                            </div>

                            <div class="card-body">


                                <?php
                                if ($SUBPAGINA_ACAO == "editar" || $SUBPAGINA_ACAO == "adicionar") {
                                ?>
                                    <form action="<?php echo $BASEURL . ($PAGINA_REQ != ""?$PAGINA_REQ:""). ($SUBPAGINA_REQ != ""?"/".$SUBPAGINA_REQ:"").($SUBPAGINA_ACAO == "editar"?"/update":"").($SUBPAGINA_ACAO == "adicionar"?"/insert":"") ?>" method="post" enctype="multipart/form-data">
                                    <input type="hidden" name="parceirosId" <?php if($SUBPAGINA_ACAO == "editar"){echo "value='".$parceiro["parceirosId"]."'";} ?>>

                        
                                        <div class="form-group">
                                            <label for="linkinput">Link</label>
                                            <textarea type="text" name="parceirosLink" class="form-control" id="linkinput" placeholder="Descrição"><?php if($SUBPAGINA_ACAO == "editar"){echo $parceiro["parceirosLink"];} ?></textarea>
                                        </div>

                                        <div class="form-group">
                                            <label for="capainput">Capa</label>
                                            <?php if($SUBPAGINA_ACAO == "editar"){echo "<br><img style='max-width: 200px;' src='".$SITE."/themes/images/clients/".$parceiro["parceirosImagem"]."'>";} ?>
                                                <?php if($SUBPAGINA_ACAO == "editar"){echo '<input type="hidden" name="parceirosImagem" value="'.$parceiro["parceirosImagem"].'">';} ?>
                                            <input type="file" name="parceirosImagemFile" accept=".gif,.jpg,.jpeg,.png" class="form-control" id="capainput" style="width: auto;" >
                                        </div>

                                        <div style="width: 100%;display: flex;justify-content: space-between;">
                                            <a onclick="history.back()" class="btn btn-primary">Voltar</a>
                                            <?php 
                                            
                                            if ($SUBPAGINA_ACAO == "editar"){
                                                echo '<a href="' . $BASEURL . ($PAGINA_REQ != ""?$PAGINA_REQ:""). ($SUBPAGINA_REQ != ""?"/".$SUBPAGINA_REQ:"").'/delete/'.$parceiro["parceirosId"].'" class="btn btn-danger">Remover</a>';
                                            } ?>
                                            <button type="submit" class="btn btn-warning">Salvar</button>
                                        </div>

                                    </form>

                                    <script>
                                        document.addEventListener("submit",function(event){
                                            event.preventDefault();
                                            let a = confirm("Clique em sim para confirmar a operação!")
                                            if(a){
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
                                                <th>Ação</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if (count($parceiros) > 0) {
                                                for ($i = 0; $i < count($parceiros); $i++) {
                                                    echo '<tr>';
                                                    echo '    <td>' . $parceiros[$i]["parceirosId"] . '</td>';
                                                    echo '    <td><img style="width: 60px;" src="'.$SITE.'/themes/images/clients/' . $parceiros[$i]["parceirosImagem"] . '"></td>';
                                                    echo '    <td><a href="'. $BASEURL . ($PAGINA_REQ != ""?$PAGINA_REQ:""). ($SUBPAGINA_REQ != ""?"/".$SUBPAGINA_REQ:"").'/editar/' . $parceiros[$i]["parceirosId"] . '">Editar</a></td>';
                                                    echo '</tr>';
                                                }
                                            }
                                            ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Id</th>
                                                <th>Imagem</th>
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