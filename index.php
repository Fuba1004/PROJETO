<?php

class app
{

    function init()
    {
        session_start();

        $SYS["SITE"] = "localhost";
        $SYS["BASE_URL"] = "http://localhost";
        $SYS["BASE_URL_MIDIA"] = "http://localhost/themes/ladies/";

        $SITE = "localhost";
        $BASEURL = "http://localhost/themes/ladies/";
        $ROTALIMPA = explode("?", $_SERVER["REQUEST_URI"])[0];
        $SYS["PAGINA"]["REQUISICAO"] = explode("/", $ROTALIMPA)[1] == "" ? "home" : explode("/", $ROTALIMPA)[1];

        $ROTAS = [
            ["metodo" => "GET", "url" => "sair", "funcao" => "SairOperacoes"],

            ["metodo" => "POST", "url" => "login",  "funcao" => "LoginOperacoes"],
            ["metodo" => "POST", "url" => "carrinho",  "funcao" => "CarrinhoOperacoes"],
            ["metodo" => "POST", "url" => "checkout-finalizar", "funcao" => "CheckoutOperacoes"],
            ["metodo" => "POST", "url" => "criar-conta",  "funcao" => "CriarContaOperacoes"],

        ];

        for ($i = 0; $i < count($ROTAS); $i++) {
            if ($ROTAS[$i]["metodo"] == $_SERVER["REQUEST_METHOD"] && $ROTAS[$i]["url"] == $SYS["PAGINA"]["REQUISICAO"]) {
                $this->_remap_requisicao($ROTAS[$i]["funcao"], $SYS);
                break;
            }
        }

        if (!isset($_SESSION["carrinho"])) {
            $_SESSION["carrinho"] = array();
        }
        $conn = $this->getConn();
        $stmt = $conn->prepare("SELECT * FROM paginas WHERE paginasPermalink = ?");
        $stmt->bind_param(
            "s",
            $SYS["PAGINA"]["REQUISICAO"]
        );
        $stmt->execute();
        $paginaRes = $this->fetch_quaquer_statement($stmt);

        if (count($paginaRes) > 0) {
            $SYS["PAGINA"]["BD"]["paginasId"] = $paginaRes[0]["paginasId"];
            $SYS["PAGINA"]["BD"]["paginasNome"] = $paginaRes[0]["paginasNome"];
            $SYS["PAGINA"]["BD"]["paginasPermalink"] = $paginaRes[0]["paginasPermalink"];
            $SYS["PAGINA"]["BD"]["paginasArquivo"] = $paginaRes[0]["paginasArquivo"];
        }

        $SYS = $this->_remap_pagina($SYS["PAGINA"]["REQUISICAO"], $SYS);

        if (array_key_exists("redirect", $SYS)) {
            if ($SYS["redirect"] != "") {
                header("Location: " . $SYS["redirect"]);
            }
        }

        if ($this->validarPagina($SYS)) {
            $this->view("header.php", $SYS);
            $this->view($SYS["PAGINA"]["BD"]["paginasArquivo"], $SYS);
            $this->view("footer.php", $SYS);
        } else {
            echo "404";
        }
    }
    private function view($arquivo, $SYS)
    {
        include $arquivo;
    }
    private function validarPagina($SYS)
    {
        if (isset($SYS["PAGINA"]["BD"])) {
            if (isset($SYS["PAGINA"]["BD"]["paginasArquivo"])) {
                return true;
            }
        }
        return true;
    }
    public function _remap_requisicao($method, $params)
    {
        if (method_exists($this, $method)) {
            return $this->{$method}($params);
        }
    }
    public function _remap_pagina($method, $params)
    {
        $method =  $method . "Pagina";
        if (method_exists($this, $method)) {
            return $this->{$method}($params);
        }
        return $params;
    }

    //PAGANAS
    function homePagina($SYS)
    {
        $resultProdutos = $this->getConn()->query("SELECT * FROM produtos,relcatprod,categoria WHERE produtosStatus = 'A' and relCatProdIdProd = produtosId and categoriaId = relCatProdIdCat GROUP BY produtosId;");
        $SYS["data"]["produtos"] = $resultProdutos->fetch_all(MYSQLI_ASSOC);


        $resultBreadcrumps = $this->getConn()->query("SELECT * FROM breadcrumps");
        $SYS["data"]["breadcrumps"] = $resultBreadcrumps->fetch_all(MYSQLI_ASSOC);

        $resultBanners = $this->getConn()->query("SELECT * FROM banners");
        $SYS["data"]["banners"] = $resultBanners->fetch_all(MYSQLI_ASSOC);

        $resultParceiros = $this->getConn()->query("SELECT * FROM parceiros");
        $SYS["data"]["parceiros"] = $resultParceiros->fetch_all(MYSQLI_ASSOC);

        $resultEmpresa = $this->getConn()->query("SELECT * FROM empresa ORDER BY empresaId ASC LIMIT 1");
        $empresaPre = $resultEmpresa->fetch_all(MYSQLI_ASSOC);
        $SYS["data"]["empresa"] = $empresaPre[0];

        $resultCategorias = $this->getConn()->query("SELECT * FROM categoria");
        $SYS["data"]["categorias"] = $resultCategorias->fetch_all(MYSQLI_ASSOC);

        //$SYS["redirect"] = "/teste";
        return $SYS;
    }
    function produtosPagina($SYS)
    {
        //if($_GET["busca"] || $_GET["categoria"] || $_GET["pagina"])
        if (isset($_GET["busca"]) && $_GET["busca"] != "") {
            $SYS["data"]["resultProdutos"] = $this->getConn()->query("SELECT * FROM produtos,relcatprod,categoria WHERE produtosNome like '%" . $_GET["busca"] . "%' and relCatProdIdProd = produtosId and categoriaId = relCatProdIdCat GROUP BY produtosId;");
            $SYS["data"]["produtos"] = $SYS["data"]["resultProdutos"]->fetch_all(MYSQLI_ASSOC);
        } else if (isset($_GET["categoria"]) && $_GET["categoria"] != "") {
            $SYS["data"]["resultProdutos"] = $this->getConn()->query("SELECT * FROM produtos,relcatprod,categoria WHERE produtosStatus = 'A' and relCatProdIdProd = produtosId and categoriaId = relCatProdIdCat and categoriaPermalink = '" . $_GET["categoria"] . "' GROUP BY produtosId;");
            $SYS["data"]["produtos"] = $SYS["data"]["resultProdutos"]->fetch_all(MYSQLI_ASSOC);
        } else {
            $SYS["data"]["resultProdutos"] = $this->getConn()->query("SELECT * FROM produtos,relcatprod,categoria WHERE produtosStatus = 'A' and relCatProdIdProd = produtosId and categoriaId = relCatProdIdCat GROUP BY produtosId;");
            $SYS["data"]["produtos"] = $SYS["data"]["resultProdutos"]->fetch_all(MYSQLI_ASSOC);
        }

        $resultProdutosRelacionados = $this->getConn()->query("SELECT * FROM produtos,relcatprod,categoria WHERE produtosStatus = 'A' and relCatProdIdProd = produtosId and categoriaId = relCatProdIdCat GROUP BY produtosId;");
        $SYS["data"]["produtosRelacionados"] = $resultProdutosRelacionados->fetch_all(MYSQLI_ASSOC);

        $resultProdutosRandomizados = $this->getConn()->query("SELECT * FROM produtos,relcatprod,categoria WHERE produtosStatus = 'A' and relCatProdIdProd = produtosId and categoriaId = relCatProdIdCat GROUP BY produtosId;");
        $SYS["data"]["produtosRandomizados"] = $resultProdutosRandomizados->fetch_all(MYSQLI_ASSOC);

        $resultProdutosMaisVendidos = $this->getConn()->query("SELECT * FROM produtos,relcatprod,categoria WHERE produtosStatus = 'A' and relCatProdIdProd = produtosId and categoriaId = relCatProdIdCat GROUP BY produtosId limit 3;");
        $SYS["data"]["produtosMaisVendidos"] = $resultProdutosMaisVendidos->fetch_all(MYSQLI_ASSOC);

        $resultBreadcrumps = $this->getConn()->query("SELECT * FROM breadcrumps");
        $SYS["data"]["breadcrumps"] = $resultBreadcrumps->fetch_all(MYSQLI_ASSOC);

        $resultBanners = $this->getConn()->query("SELECT * FROM banners");
        $SYS["data"]["banners"] = $resultBanners->fetch_all(MYSQLI_ASSOC);

        $resultParceiros = $this->getConn()->query("SELECT * FROM parceiros");
        $SYS["data"]["parceiros"] = $resultParceiros->fetch_all(MYSQLI_ASSOC);

        $resultEmpresa = $this->getConn()->query("SELECT * FROM empresa ORDER BY empresaId ASC LIMIT 1");
        $empresaPre = $resultEmpresa->fetch_all(MYSQLI_ASSOC);
        $SYS["data"]["empresa"] = $empresaPre[0];

        $resultCategorias = $this->getConn()->query("SELECT * FROM `categoria`");
        $SYS["data"]["categorias"] = $resultCategorias->fetch_all(MYSQLI_ASSOC);
        return $SYS;
    }
    function carrinhoPagina($SYS)
    {
        $conn = $this->getConn();
        $produtosCarrinho = array();
        $checkout["subtotal"] = 0;

        if (count($_SESSION["carrinho"]) > 0) {
            for ($i = 0; $i < count($_SESSION["carrinho"]); $i++) {
                $stmt = $conn->prepare("SELECT * FROM produtos,relcatprod,categoria WHERE produtosStatus = 'A' and produtosId = ?");
                $stmt->bind_param("i", $_SESSION["carrinho"][$i]["produtosId"]);
                $stmt->execute();
                $stmtProduto = $this->fetch_quaquer_statement($stmt);
                if (count($stmtProduto) > 0) {
                    $prodRes = $stmtProduto[0];
                    $prodRes["produtosPrecoTotal"] = $prodRes["produtosPreco"] * $_SESSION["carrinho"][$i]["quantidade"];
                    $prodRes["quantidade"] = $_SESSION["carrinho"][$i]["quantidade"];
                    $checkout["subtotal"] = $checkout["subtotal"] + $prodRes["produtosPrecoTotal"];
                    array_push($produtosCarrinho, $prodRes);
                }
            }
        }
        $SYS["data"]["produtosCarrinho"] = $produtosCarrinho;

        $checkout["taxa-entrega"] = "0";
        $checkout["total"] = $checkout["subtotal"] > 0 ? $checkout["taxa-entrega"] + $checkout["subtotal"] : 0;
        $SYS["data"]["checkout"] = $checkout;

        $resultBreadcrumps = $this->getConn()->query("SELECT * FROM breadcrumps");
        $SYS["data"]["breadcrumps"] = $resultBreadcrumps->fetch_all(MYSQLI_ASSOC);

        $resultBanners = $this->getConn()->query("SELECT * FROM banners");
        $SYS["data"]["banners"] = $resultBanners->fetch_all(MYSQLI_ASSOC);

        $resultParceiros = $this->getConn()->query("SELECT * FROM parceiros");
        $SYS["data"]["parceiros"] = $resultParceiros->fetch_all(MYSQLI_ASSOC);

        $resultEmpresa = $this->getConn()->query("SELECT * FROM empresa ORDER BY empresaId ASC LIMIT 1");
        $empresaPre = $resultEmpresa->fetch_all(MYSQLI_ASSOC);
        $SYS["data"]["empresa"] = $empresaPre[0];

        $resultCategorias = $this->getConn()->query("SELECT * FROM `categoria`");
        $SYS["data"]["categorias"] = $resultCategorias->fetch_all(MYSQLI_ASSOC);

        return $SYS;
    }
    function minhacontaPagina($SYS)
    {
        if (!isset($_SESSION["usuario"])) {
            header("Location: /login");
            die;
        }

        $resultUsuario = $this->getConn()->query("SELECT * FROM usuario WHERE usuarioId = " . $_SESSION["usuario"]["usuarioId"]);
        $suarioArray = $resultUsuario->fetch_all(MYSQLI_ASSOC);
        $SYS["data"]["usuario"] = $suarioArray[0];

        $resultProdutosRelacionados = $this->getConn()->query("SELECT * FROM produtos,relcatprod,categoria WHERE produtosStatus = 'A' and relCatProdIdProd = produtosId and categoriaId = relCatProdIdCat GROUP BY produtosId;");
        $SYS["data"]["produtosRelacionados"] = $resultProdutosRelacionados->fetch_all(MYSQLI_ASSOC);

        $resultProdutos = $this->getConn()->query("SELECT * FROM produtos,relcatprod,categoria WHERE produtosStatus = 'A' and relCatProdIdProd = produtosId and categoriaId = relCatProdIdCat GROUP BY produtosId;");
        $SYS["data"]["produtos"] = $resultProdutos->fetch_all(MYSQLI_ASSOC);

        $resultBreadcrumps = $this->getConn()->query("SELECT * FROM breadcrumps");
        $SYS["data"]["breadcrumps"] = $resultBreadcrumps->fetch_all(MYSQLI_ASSOC);

        $resultBanners = $this->getConn()->query("SELECT * FROM banners");
        $SYS["data"]["banners"] = $resultBanners->fetch_all(MYSQLI_ASSOC);

        $resultParceiros = $this->getConn()->query("SELECT * FROM parceiros");
        $SYS["data"]["parceiros"] = $resultParceiros->fetch_all(MYSQLI_ASSOC);

        $resultEmpresa = $this->getConn()->query("SELECT * FROM empresa ORDER BY empresaId ASC LIMIT 1");
        $empresaPre = $resultEmpresa->fetch_all(MYSQLI_ASSOC);
        $SYS["data"]["empresa"] = $empresaPre[0];

        $resultCategorias = $this->getConn()->query("SELECT * FROM categoria");
        $SYS["data"]["categorias"] = $resultCategorias->fetch_all(MYSQLI_ASSOC);

        return $SYS;
    }

    function minhascomprasPagina($SYS)
    {
        if (!isset($_SESSION["usuario"])) {
            header("Location: /login");
            die;
        }

        $resultMinhasCompras = $this->getConn()->query("SELECT *  FROM venda,tiposvenda,estoque,produtos WHERE vendaIdUsuario = " . $_SESSION["usuario"]["usuarioId"] . " and tiposVendaId = vendaIdTipo and estoque.estoqueIdProd = vendaIdEstoqueProduto and produtos.produtosId = estoque.estoqueIdProd;");
        $SYS["data"]["minhasCompras"] = $resultMinhasCompras->fetch_all(MYSQLI_ASSOC);

        $resultUsuario = $this->getConn()->query("SELECT * FROM usuario WHERE usuarioId = " . $_SESSION["usuario"]["usuarioId"]);
        $suarioArray = $resultUsuario->fetch_all(MYSQLI_ASSOC);
        $SYS["data"]["usuario"] = $suarioArray[0];

        $resultProdutosRelacionados = $this->getConn()->query("SELECT * FROM produtos,relcatprod,categoria WHERE produtosStatus = 'A' and relCatProdIdProd = produtosId and categoriaId = relCatProdIdCat GROUP BY produtosId;");
        $SYS["data"]["produtosRelacionados"] = $resultProdutosRelacionados->fetch_all(MYSQLI_ASSOC);

        $resultProdutos = $this->getConn()->query("SELECT * FROM produtos,relcatprod,categoria WHERE produtosStatus = 'A' and relCatProdIdProd = produtosId and categoriaId = relCatProdIdCat GROUP BY produtosId;");
        $SYS["data"]["produtos"] = $resultProdutos->fetch_all(MYSQLI_ASSOC);

        $resultBreadcrumps = $this->getConn()->query("SELECT * FROM breadcrumps");
        $SYS["data"]["breadcrumps"] = $resultBreadcrumps->fetch_all(MYSQLI_ASSOC);

        $resultBanners = $this->getConn()->query("SELECT * FROM banners");
        $SYS["data"]["banners"] = $resultBanners->fetch_all(MYSQLI_ASSOC);

        $resultParceiros = $this->getConn()->query("SELECT * FROM parceiros");
        $SYS["data"]["parceiros"] = $resultParceiros->fetch_all(MYSQLI_ASSOC);

        $resultEmpresa = $this->getConn()->query("SELECT * FROM empresa ORDER BY empresaId ASC LIMIT 1");
        $empresaPre = $resultEmpresa->fetch_all(MYSQLI_ASSOC);
        $SYS["data"]["empresa"] = $empresaPre[0];

        $resultCategorias = $this->getConn()->query("SELECT * FROM categoria");
        $SYS["data"]["categorias"] = $resultCategorias->fetch_all(MYSQLI_ASSOC);

        return $SYS;
    }
    function LoginPagina($SYS)
    {
        if (isset($_SESSION["usuario"])) {
            header("Location: /minhaconta");
            die;
        }
        $resultBreadcrumps = $this->getConn()->query("SELECT * FROM breadcrumps");
        $SYS["data"]["breadcrumps"] = $resultBreadcrumps->fetch_all(MYSQLI_ASSOC);

        $resultBanners = $this->getConn()->query("SELECT * FROM banners");
        $SYS["data"]["banners"] = $resultBanners->fetch_all(MYSQLI_ASSOC);

        $resultParceiros = $this->getConn()->query("SELECT * FROM parceiros");
        $SYS["data"]["parceiros"] = $resultParceiros->fetch_all(MYSQLI_ASSOC);

        $resultEmpresa = $this->getConn()->query("SELECT * FROM empresa ORDER BY empresaId ASC LIMIT 1");
        $empresaPre = $resultEmpresa->fetch_all(MYSQLI_ASSOC);
        $SYS["data"]["empresa"] = $empresaPre[0];

        $resultCategorias = $this->getConn()->query("SELECT * FROM `categoria`");
        $SYS["data"]["categorias"] = $resultCategorias->fetch_all(MYSQLI_ASSOC);

        return $SYS;
    }

    function CheckoutOperacoes()
    {
        $mensagens = array();
        //percorre itens carrinho
        if (count($_SESSION["carrinho"]) > 0) {
            $soma = 0;
            $produtoComprado = 0;
            $produtoSemEstoque = 0;
            //verifica se o item está disponível no estoque
            for ($i = 0; $i < $_SESSION["carrinho"][$i]["quantidade"]; $i++) {
                $resultProdutoEstoque = $this->getConn()->query("SELECT * FROM estoque,produtos where estoqueIdProd = " . $_SESSION["carrinho"][$i]["produtosId"] . " and produtosId = estoqueIdProd");
                $produtoEstoque = $resultProdutoEstoque->fetch_all(MYSQLI_ASSOC);

                $kgtotalDoProduto = 0;
                if (count($produtoEstoque) > 0) {
                    for ($i2 = 0; $i2 < count($produtoEstoque); $i2++) {
                        //echo "<br>total em estoque ".$kgtotalDoProduto." Loop: ".$i2." de: ".count($produtoEstoque)." item do estoque: ".$produtoEstoque[$i2]["estoqueId"]." quantidade: ".$produtoEstoque[$i2]["estoqueKiloGrama"]." gramas <br>";
                        $kgtotalDoProduto = intval($produtoEstoque[$i2]["estoqueKiloGrama"]) + intval($kgtotalDoProduto);
                    }
                }
                
                if ($kgtotalDoProduto >= $_SESSION["carrinho"][$i]["quantidade"] * $produtoEstoque[0]["produtosGramasUni"]) {

                    $valorAserSubtraido = $_SESSION["carrinho"][$i]["quantidade"] * $produtoEstoque[0]["produtosGramasUni"];
                    for ($i2 = 0; $i2 < count($produtoEstoque); $i2++) {
                        if ($valorAserSubtraido == 0) {
                            break;
                        }
                        if ($valorAserSubtraido <= $produtoEstoque[$i2]["estoqueKiloGrama"]) {
                            $valorAserSubtraido = intval($produtoEstoque[$i2]["estoqueKiloGrama"]) - intval($valorAserSubtraido);
                            //echo "Subtraido ".$valorAserSubtraido."gm do item: ".$produtoEstoque[$i2]["estoqueId"];
                            $this->getConn()->query("UPDATE estoque SET estoqueKiloGrama = '" . $valorAserSubtraido . "' WHERE estoqueId = " . $produtoEstoque[$i2]["estoqueId"]);
                            break;
                        } else {
                            $valorAserSubtraido = intval($valorAserSubtraido) - intval($produtoEstoque[$i2]["estoqueKiloGrama"]);
                            $this->getConn()->query("UPDATE estoque SET estoqueKiloGrama = '0' WHERE estoqueId = " . $produtoEstoque[$i2]["estoqueId"]);
                        }
                    }
                } else {
                    array_push($mensagens, ["titulo" => "Erro", "menssagem" => "Ops não temos " . $produtoEstoque[0]["produtosNome"] . " mais em nosso estoque e não será cobrado!"]);
                    $produtoSemEstoque++;
                }

                

                if ($kgtotalDoProduto >= $_SESSION["carrinho"][$i]["quantidade"] * $produtoEstoque[0]["produtosGramasUni"]) {
                    //inserindo a compra
                    $this->getConn()->query("INSERT INTO venda VALUES (NULL, 
                 " . $_SESSION["carrinho"][$i]["produtosId"] . ",
                 " . $_SESSION["usuario"]["usuarioId"] . ",
                 '" . $_SESSION["carrinho"][$i]["quantidade"] . "',
                 '" . ($_SESSION["carrinho"][$i]["quantidade"] * $produtoEstoque[0]["produtosGramasUni"]) . "',
                 '3',
                 NOW());");
                    $soma += $produtoEstoque[0]["produtosPreco"];
                    array_push($mensagens, ["titulo" => "Erro", "menssagem" => "Foi inserido em seu pagamento o produto " . $produtoEstoque[0]["produtosNome"] . " COD interno: " . $produtoEstoque[0]["estoqueSKU"] . " no valor de " . $produtoEstoque[0]["produtosPreco"]]);
                    $produtoComprado++;
                } else {
                    array_push($mensagens, ["titulo" => "Erro", "menssagem" => "Ops não temos " . $produtoEstoque[0]["produtosNome"] . " mais em nosso estoque e não será cobrado!"]);
                    $produtoSemEstoque++;
                }
            }
            array_push($mensagens, ["titulo" => "Aviso", "menssagem" => "Foi cobrado em seu cartão o valor de R$" . $soma . " por " . $produtoComprado . ($produtoSemEstoque > 0 ? " e " . $produtoComprado . " retirados da compra por indiponibilidade de estoque!" : "")]);
        }
        $_SESSION["mensagens"] = $mensagens;
        unset($_SESSION["carrinho"]);
        header('Location: /carrinho');
    }
    function CarrinhoOperacoes()
    {
        switch ($_POST["acao"]) {
            case 'adicionar':
                if (count($_SESSION["carrinho"]) == 0) {
                    $_SESSION["carrinho"] = [["produtosId" => $_POST["produtosId"], "quantidade" => $_POST["quantidade"]]];
                } else {
                    $produtos = $_SESSION["carrinho"];
                    $add = true;
                    for ($i = 0; $i < count($produtos); $i++) {
                        if ($produtos[$i]["produtosId"] == $_POST["produtosId"]) {
                            $produtos[$i]["quantidade"] = $_POST["quantidade"];
                            $add = false;
                            break;
                        }
                    }
                    if ($add == true) {
                        array_push($produtos, ["produtosId" => $_POST["produtosId"], "quantidade" => $_POST["quantidade"]]);
                    }
                    $_SESSION["carrinho"] = $produtos;
                }
                break;
            case 'ajax':
                if ($_POST["funcao"] == "remove") {
                    $temp = array();
                    if (count($_SESSION["carrinho"])) {
                        for ($i = 0; $i < count($_SESSION["carrinho"]); $i++) {
                            if ($_SESSION["carrinho"][$i]["produtosId"] != $_POST["id"]) {
                                array_push($temp, $_SESSION["carrinho"][$i]);
                            }
                        }
                        $_SESSION["carrinho"] = $temp;
                    }
                    echo 200;
                    die;
                } else if ($_POST["funcao"] == "somar") {
                    $temp = array();
                    if (count($_SESSION["carrinho"])) {
                        for ($i = 0; $i < count($_SESSION["carrinho"]); $i++) {
                            $t = $_SESSION["carrinho"][$i];
                            if ($_SESSION["carrinho"][$i]["produtosId"] == $_POST["id"]) {
                                $t["quantidade"] = $_POST["quantidade"];
                            }
                            array_push($temp, $t);
                        }
                        $_SESSION["carrinho"] = $temp;
                    }
                    echo 200;
                    die;
                }
                break;
        }

        header('Location: /carrinho');
        die;
    }
    function SairOperacoes()
    {

        unset($_SESSION["usuario"]);
        header('Location: /login');
    }
    function LoginOperacoes($SYS)
    {
        $conn = $this->getConn();
        $mensagens = array();
        if (
            $_POST["usuarioEmail"] != "" &&
            $_POST["usuarioSenha"] != ""
        ) {
            $stmt = $conn->prepare("SELECT * FROM usuario WHERE usuarioSenha = ? AND usuarioEmail = ?");
            $stmt->bind_param(
                "ss",
                $_POST["usuarioSenha"],
                $_POST["usuarioEmail"]
            );

            $stmt->execute();
            $stmtUsuario = $this->fetch_quaquer_statement($stmt);
            //print_r($stmtUsuario);
            //die;
            if (count($stmtUsuario) > 0) {
                $_SESSION["usuario"]["usuarioId"] = $stmtUsuario[0]["usuarioId"];
                $_SESSION["usuario"]["usuarioNome"] = $stmtUsuario[0]["usuarioNome"];
                $_SESSION["usuario"]["usuarioEmail"] = $stmtUsuario[0]["usuarioEmail"];
                array_push($mensagens, ["titulo" => "Pronto", "menssagem" => "Login efetuado com sucesso!"]);
                $_SESSION["mensagens"] = $mensagens;
                header('Location: /minhaconta');
                die;
            } else {
                array_push($mensagens, ["titulo" => "Erro", "menssagem" => "Usuário não encontrado!"]);
                $_SESSION["mensagens"] = $mensagens;
                header('Location: /Login');
            }
        }
        $_SESSION["mensagens"] = $mensagens;
        header('Location: /Login');
    }
    function CriarContaOperacoes()
    {
        $conn = $this->getConn();
        $mensagens = array();
        if (
            $_POST["usuarioNome"] != "" &&
            $_POST["usuarioEmail"] != "" &&
            $_POST["usuarioRg"] != "" &&
            $_POST["usuarioSenha"] != "" &&
            $_POST["usuarioConfirmacaoSenha"] != "" &&
            $_POST["usuarioLogradouro"] != "" &&
            $_POST["usuarioNumero"] != "" &&
            $_POST["usuarioCep"] != "" &&
            $_POST["usuarioCidade"] != ""  &&
            $_POST["usuarioEstado"] != "" &&
            $_POST["usuarioConfirmacaoSenha"] == $_POST["usuarioSenha"]
        ) {

            $stmt = $conn->prepare("SELECT * FROM usuario WHERE usuarioEmail = ?");
            $stmt->bind_param(
                "s",
                $_POST["usuarioEmail"]
            );

            $stmt->execute();
            $stmtUsuario = $this->fetch_quaquer_statement($stmt);

            if (count($stmtUsuario) > 0) {
                array_push($mensagens, ["titulo" => "Erro", "menssagem" => "Email já cadastrado!"]);
            } else {
                $stmt = $conn->prepare("INSERT INTO `usuario` (`usuarioId`,
         usuarioNome,
         usuarioSenha,
         usuarioEmail,
         usuarioRg,
         usuarioLogradouro,
         usuarioNumero,
         usuarioCep,
         usuarioCidade,
         usuarioEstado) VALUES (NULL,
         ?,
         ?,
         ?,
         ?,
         ?,
         ?,
         ?,
         ?,
         ? 
          );");
                $stmt->bind_param(
                    "sssssssss",
                    $_POST["usuarioNome"],
                    $_POST["usuarioSenha"],
                    $_POST["usuarioEmail"],
                    $_POST["usuarioRg"],
                    $_POST["usuarioLogradouro"],
                    $_POST["usuarioNumero"],
                    $_POST["usuarioCep"],
                    $_POST["usuarioCidade"],
                    $_POST["usuarioEstado"],
                );
                $stmt->execute();
                array_push($mensagens, ["titulo" => "Pronto", "menssagem" => "Cadastrado com sucesso!"]);
            }
        } else {
            if ($_POST["usuarioNome"] == "") array_push($mensagens, ["titulo" => "Erro", "menssagem" => "Campo Nome é obrigatório!"]);
            if ($_POST["usuarioEmail"] == "") array_push($mensagens, ["titulo" => "Erro", "menssagem" => "Campo Email é obrigatório!"]);
            if ($_POST["usuarioRg"] == "") array_push($mensagens, ["titulo" => "Erro", "menssagem" => "Campo RG é obrigatório!"]);
            if ($_POST["usuarioSenha"] == "") array_push($mensagens, ["titulo" => "Erro", "menssagem" => "Campo Senha é obrigatório!"]);
            if ($_POST["usuarioConfirmacaoSenha"] == "") array_push($mensagens, ["titulo" => "Erro", "menssagem" => "Campo Confirmação de Senha é obrigatório!"]);
            if ($_POST["usuarioLogradouro"] == "") array_push($mensagens, ["titulo" => "Erro", "menssagem" => "Campo Endereço é obrigatório!"]);
            if ($_POST["usuarioNumero"] == "") array_push($mensagens, ["titulo" => "Erro", "menssagem" => "Campo Número é obrigatório!"]);
            if ($_POST["usuarioCep"] == "") array_push($mensagens, ["titulo" => "Erro", "menssagem" => "Campo CEP é obrigatório!"]);
            if ($_POST["usuarioCidade"] == "") array_push($mensagens, ["titulo" => "Erro", "menssagem" => "Campo Cidade é obrigatório!"]);
            if ($_POST["usuarioEstado"] == "") array_push($mensagens, ["titulo" => "Erro", "menssagem" => "Campo Estado é obrigatório!"]);
            if ($_POST["usuarioConfirmacaoSenha"] != $_POST["usuarioLogradouro"]) array_push($mensagens, ["titulo" => "Erro", "menssagem" => "Senhas precisam serem iguais!"]);
        }
        $_SESSION["mensagens"] = $mensagens;

        header("Location: /login");
        die;
    }




    function CheckoutPagina($SYS)
    {

        $conn = $this->getConn();

        $produtosCarrinho = array();
        $subtotal = 0;
        $total = 0;
        $taxaEntrega = 15;
        $pesoTotal = 0;
        if (count($_SESSION["carrinho"]) > 0) {
            for ($i = 0; $i < count($_SESSION["carrinho"]); $i++) {
                $stmt = $conn->prepare("SELECT * FROM produtos,relcatprod,categoria WHERE produtosStatus = 'A' and produtosId = ?");
                $stmt->bind_param("i", $_SESSION["carrinho"][$i]["produtosId"]);
                $stmt->execute();
                $stmtProduto = $this->fetch_quaquer_statement($stmt);
                if (count($stmtProduto) > 0) {
                    $prodRes = $stmtProduto[0];
                    $prodRes["produtosPrecoTotal"] = $prodRes["produtosPreco"] * $_SESSION["carrinho"][$i]["quantidade"];
                    $prodRes["quantidade"] = $_SESSION["carrinho"][$i]["quantidade"];
                    $subtotal = $subtotal + $prodRes["produtosPrecoTotal"];
                    $pesoTotal = $pesoTotal + ($prodRes["produtosGramasUni"] * $_SESSION["carrinho"][$i]["quantidade"]);
                    array_push($produtosCarrinho, $prodRes);
                }
            }
        }
        $SYS["data"]["produtosCarrinho"] = $produtosCarrinho;
        $SYS["data"]["checkout"]["peso-total"] = $pesoTotal;
        $SYS["data"]["checkout"]["taxa-entrega"] = $pesoTotal > 1000 ? $taxaEntrega : 0;
        $SYS["data"]["checkout"]["subtotal"] = $subtotal;
        $SYS["data"]["checkout"]["total"] = $subtotal > 0 ? ($pesoTotal > 1000 ? $taxaEntrega + $subtotal : $subtotal) : $subtotal;

        $resultBreadcrumps = $conn->query("SELECT * FROM breadcrumps");
        $SYS["data"]["breadcrumps"] = $resultBreadcrumps->fetch_all(MYSQLI_ASSOC);

        $resultBanners = $conn->query("SELECT * FROM banners");
        $SYS["data"]["banners"] = $resultBanners->fetch_all(MYSQLI_ASSOC);

        $resultParceiros = $conn->query("SELECT * FROM parceiros");
        $SYS["data"]["parceiros"] = $resultParceiros->fetch_all(MYSQLI_ASSOC);

        $resultEmpresa = $conn->query("SELECT * FROM empresa ORDER BY empresaId ASC LIMIT 1");
        $empresaPre = $resultEmpresa->fetch_all(MYSQLI_ASSOC);
        $SYS["data"]["empresa"] = $empresaPre[0];

        $resultCategorias = $conn->query("SELECT * FROM `categoria`");
        $SYS["data"]["categorias"] = $resultCategorias->fetch_all(MYSQLI_ASSOC);

        return $SYS;
    }



    function produtoPagina($SYS)
    {
        $conn = $this->getConn();

        if (!isset($_GET["produto"]) || $_GET["produto"] == "") header('Location: /');

        $stmt = $conn->prepare("SELECT * FROM produtos WHERE produtosPermalink = ? AND produtosStatus = 'A'");
        $stmt->bind_param("s", $_GET["produto"]);
        $stmt->execute();
        $stmtProduto = $this->fetch_quaquer_statement($stmt);
        $SYS["data"]["produto"] = $stmtProduto[0];

        $resultProdutosRelacionados = $conn->query("SELECT * FROM produtos,relcatprod,categoria WHERE produtosStatus = 'A' and relCatProdIdProd = produtosId and categoriaId = relCatProdIdCat GROUP BY produtosId;");
        $SYS["data"]["produtosRelacionados"] = $resultProdutosRelacionados->fetch_all(MYSQLI_ASSOC);

        $resultProdutosRandomizados = $conn->query("SELECT * FROM produtos,relcatprod,categoria WHERE produtosStatus = 'A' and relCatProdIdProd = produtosId and categoriaId = relCatProdIdCat GROUP BY produtosId;");
        $SYS["data"]["produtosRandomizados"] = $resultProdutosRandomizados->fetch_all(MYSQLI_ASSOC);

        $resultProdutosMaisVendidos = $conn->query("SELECT * FROM produtos,relcatprod,categoria WHERE produtosStatus = 'A' and relCatProdIdProd = produtosId and categoriaId = relCatProdIdCat GROUP BY produtosId limit 3;");
        $SYS["data"]["produtosMaisVendidos"] = $resultProdutosMaisVendidos->fetch_all(MYSQLI_ASSOC);

        $resultBreadcrumps = $conn->query("SELECT * FROM breadcrumps");
        $SYS["data"]["breadcrumps"] = $resultBreadcrumps->fetch_all(MYSQLI_ASSOC);

        $resultBanners = $conn->query("SELECT * FROM banners");
        $SYS["data"]["banners"] = $resultBanners->fetch_all(MYSQLI_ASSOC);

        $resultParceiros = $conn->query("SELECT * FROM parceiros");
        $SYS["data"]["parceiros"] = $resultParceiros->fetch_all(MYSQLI_ASSOC);

        $resultEmpresa = $conn->query("SELECT * FROM empresa ORDER BY empresaId ASC LIMIT 1");
        $empresaPre = $resultEmpresa->fetch_all(MYSQLI_ASSOC);
        $SYS["data"]["empresa"] = $empresaPre[0];

        $resultCategorias = $conn->query("SELECT * FROM `categoria`");
        $SYS["data"]["categorias"] = $resultCategorias->fetch_all(MYSQLI_ASSOC);

        return $SYS;
    }














    private function fetch_quaquer_statement($result)
    {
        $array = array();

        if ($result instanceof mysqli_stmt) {
            $result->store_result();

            $variables = array();
            $data = array();
            $meta = $result->result_metadata();

            while ($field = $meta->fetch_field())
                $variables[] = &$data[$field->name];

            call_user_func_array(array($result, 'bind_result'), $variables);

            $i = 0;
            while ($result->fetch()) {
                $array[$i] = array();
                foreach ($data as $k => $v)
                    $array[$i][$k] = $v;
                $i++;
            }
        } elseif ($result instanceof mysqli_result) {
            while ($row = $result->fetch_assoc())
                $array[] = $row;
        }

        return $array;
    }

    private function getConn()
    {
        $servername = "localhost";
        $username = "admin";
        $password = "admin";
        $dbname = "juliana";

        return new mysqli($servername, $username, $password, $dbname);
        /*
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        return $conn;*/
    }


    function templateProduto($categoriaNome, $nome, $capa, $permalink, $preco, $gramas)
    {
        $html = '<li class="span3">';
        $html .= '	<div class="product-box">';
        $html .= '		<span class="sale_tag"></span>';
        $html .= '		<p><a href="./produto?produto=' . $permalink . '"><img src="themes/images/ladies/' . $capa . '" alt="" /></a></p>';
        $html .= '		<a href="./produto?produto=' . $permalink . '" class="title">' . $nome . '</a><br />';
        $html .= '		<a href="./produto?produto=' . $permalink . '" class="category">' . $categoriaNome . '</a>';
        $html .= '		<p class="price">R$' . $preco . ' <span style="font-size: 10px;">uni</span><br ><span style="font-size: 10px;">Unidade / ' . $gramas . ' gramas </span></p>';
        $html .= '	</div>';
        $html .= '</li>';
        return $html;
    }
}
$app = new app();
$app->init();
die;
