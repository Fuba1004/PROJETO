    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dados da Empresa</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?php echo $BASEURL ?>">Painel</a></li>
                            <li class="breadcrumb-item active">Dados da Empresa</li>
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
                                   Dados da Empresa
                                </h3>
                                
                            </div>

                            <div class="card-body">


            
                                    <form action="<?php echo $BASEURL . ($PAGINA_REQ != ""?$PAGINA_REQ:""). ($SUBPAGINA_REQ != ""?"/".$SUBPAGINA_REQ:"").($SUBPAGINA_ACAO == "editar"?"/update":"").($SUBPAGINA_ACAO == "adicionar"?"/insert":"") ?>" method="post" enctype="multipart/form-data">
                                    



                                        <div class="form-group">
                                            <label for="nomeInput">Nome</label>
                                            <input type="text" name="empresaNome" class="form-control" id="nomeInput" placeholder="Nome" value="<?php echo $empresa["empresaNome"] ?>" >
                                        </div>

                                        <div class="form-group">
                                            <label for="logoInput">logo</label>
                                            <?php 
                                                if($empresa["empresaLogo"]!= ""){
                                                    echo '<br><img style="width: 200px;" src="/themes/'.$empresa["empresaLogo"].'"><br>';
                                                }
                                            ?>
                                            <input type="hidden" name="empresaLogo" class="form-control" id="logoInput" placeholder="Nome" value="<?php echo $empresa["empresaLogo"] ?>">
                                            <input type="file" name="empresaLogoFile">
                                        </div>

                                        <div class="form-group">
                                            <label for="quemsomosInput">Nome</label>
                                            <input type="text" name="empresaResumoQuemSomos" class="form-control" id="quemsomosInput" placeholder="Nome" value="<?php echo $empresa["empresaResumoQuemSomos"] ?>">
                                        </div>
              
                                        <div style="width: 100%;display: flex;justify-content: space-between;">
                                            <a onclick="history.back()" class="btn btn-primary">Voltar</a>
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



                            </div>

                        </div>

                    </div>

                </div>
            </div>
        </section>

        <!-- /.content-header -->
    </div>