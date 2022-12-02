<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require "../conn.php";

$SITE = "http://localhost";
$BASEURL = "http://localhost/painel/";
$ROTALIMPA = explode("?", $_SERVER["REQUEST_URI"])[0];
$ROTALIMPAEXPLODED = explode("/", $ROTALIMPA);
$PAGINA_REQ = isset($ROTALIMPAEXPLODED[2]) ? $ROTALIMPAEXPLODED[2] : "";
$SUBPAGINA_REQ = isset($ROTALIMPAEXPLODED[3]) ? $ROTALIMPAEXPLODED[3] : "";
$SUBPAGINA_ACAO = isset($ROTALIMPAEXPLODED[4]) ? $ROTALIMPAEXPLODED[4] : "";
$SUBPAGINA_ID = isset($ROTALIMPAEXPLODED[5]) ? $ROTALIMPAEXPLODED[5] : "";

$permalinkArea = "";
if ($SUBPAGINA_REQ != "") {
    $permalinkArea = $SUBPAGINA_REQ;
} else if ($PAGINA_REQ != "") {
    $permalinkArea = $PAGINA_REQ;
} else {
    $permalinkArea = "dashboard";
}

if (function_exists($permalinkArea . "Area")) {

    if (isset($_SESSION["administrador"])) {
        $funct = $permalinkArea . "Area";
        $funct();
    } else {
        loginArea();
        //include ('Location: /painel/login');

    }
} else {
    //não tem função  para página
}

function breadcrumbsArea()
{
    global $SITE;
    global $conn;
    global $BASEURL;
    global $PAGINA_REQ;
    global $SUBPAGINA_REQ;
    global $SUBPAGINA_ACAO;
    global $SUBPAGINA_ID;

    $breadcrumbsRes = $conn->query("SELECT * FROM `breadcrumps`");
    $breadcrumbs = $breadcrumbsRes->fetch_all(MYSQLI_ASSOC);

    if ($SUBPAGINA_ACAO != "") {
        $_SESSION["mensagens_painel"] = array();

        switch ($SUBPAGINA_ACAO) {
            case 'editar':
                $breadcrumbsRes2 = $conn->query("SELECT * FROM breadcrumps WHERE breadcrumpsId = " . $SUBPAGINA_ID);
                $breadcrumb = $breadcrumbsRes2->fetch_all(MYSQLI_ASSOC);
                $breadcrumb = $breadcrumb[0];
                break;
            case 'update':
                $target_file = "../themes/images/";
                $imagem = $_POST["breadcrumpsIcone"];
                if ($_FILES["breadcrumpsIconeFile"]["error"] == 0) {
                    $novoNome = explode(".", $_FILES["breadcrumpsIconeFile"]["name"]);
                    $imagem = uniqid() . "." . $novoNome[1];
                    move_uploaded_file($_FILES["breadcrumpsIconeFile"]["tmp_name"], $target_file . $imagem);
                }
                $stmt = $conn->prepare("UPDATE breadcrumps SET breadcrumpsTitulo = ?, breadcrumpsIcone = ?, breadcrumpsParagrafo = ? WHERE breadcrumpsId = ?;");
                $stmt->bind_param(
                    "sssi",
                    $_POST["breadcrumpsTitulo"],
                    $imagem,
                    $_POST["breadcrumpsParagrafo"],
                    $_POST["breadcrumpsId"]
                );
                $stmt->execute();
                array_push($_SESSION["mensagens_painel"], ["tipo" => "success", "menssagem" => "Breadcrumb atualizado com sucesso!"]);
                header("Location: " . $SITE . "/painel/site/breadcrumbs");
                break;
            case 'insert':
                $target_file = "../themes/images/";
                $imagem = "";
                if ($_FILES["breadcrumpsIconeFile"]["error"] == 0) {
                    $novoNome = explode(".", $_FILES["breadcrumpsIconeFile"]["name"]);
                    $imagem = uniqid() . "." . $novoNome[1];
                    move_uploaded_file($_FILES["breadcrumpsIconeFile"]["tmp_name"], $target_file . $imagem);
                }
                $stmt = $conn->prepare("INSERT INTO breadcrumps VALUES (NULL, ?, ?, ?);");
                $stmt->bind_param(
                    "sss",
                    $_POST["breadcrumpsTitulo"],
                    $imagem,
                    $_POST["breadcrumpsParagrafo"]


                );
                $stmt->execute();
                array_push($_SESSION["mensagens_painel"], ["tipo" => "success", "menssagem" => "Breadcrumb adicionado com sucesso!"]);
                header("Location: " . $SITE . "/painel/site/breadcrumbs");
                break;
            case 'delete':
                $conn->query("DELETE FROM breadcrumps WHERE `breadcrumps`.`breadcrumpsId` = " . $SUBPAGINA_ID);
                array_push($_SESSION["mensagens_painel"], ["tipo" => "success", "menssagem" => "Removido com sucesso!"]);
                header("Location: " . $SITE . "/painel/site/breadcrumbs");
                break;
        }
    }

    include "HeaderFragmento.php";
    include "BreadCrumpsPagina.php";
    include "FooterFragmento.php";
    die;
}
function parceirosArea()
{
    global $SITE;
    global $conn;
    global $BASEURL;
    global $PAGINA_REQ;
    global $SUBPAGINA_REQ;
    global $SUBPAGINA_ACAO;
    global $SUBPAGINA_ID;

    $parceirosRes = $conn->query("SELECT * FROM parceiros");
    $parceiros = $parceirosRes->fetch_all(MYSQLI_ASSOC);

    if ($SUBPAGINA_ACAO != "") {
        $_SESSION["mensagens_painel"] = array();

        switch ($SUBPAGINA_ACAO) {
            case 'editar':
                $parceirosRes = $conn->query("SELECT * FROM parceiros WHERE parceirosId = " . $SUBPAGINA_ID);
                $parceiro = $parceirosRes->fetch_all(MYSQLI_ASSOC);
                $parceiro = $parceiro[0];
                break;
            case 'update':
                $target_file = "../themes/images/clients/";
                $imagem = $_POST["parceirosImagem"];
                if ($_FILES["parceirosImagemFile"]["error"] == 0) {
                    $novoNome = explode(".", $_FILES["parceirosImagemFile"]["name"]);
                    $imagem = uniqid() . "." . $novoNome[1];
                    move_uploaded_file($_FILES["parceirosImagemFile"]["tmp_name"], $target_file . $imagem);
                }
                $stmt = $conn->prepare("UPDATE parceiros SET parceirosImagem = ?, parceirosLink = ? WHERE parceirosId = ?;");
                $stmt->bind_param(
                    "ssi",
                    $imagem,
                    $_POST["parceirosLink"],
                    $_POST["parceirosId"]
                );
                $stmt->execute();
                array_push($_SESSION["mensagens_painel"], ["tipo" => "success", "menssagem" => "Parceiro atualizado com sucesso!"]);
                header("Location: " . $SITE . "/painel/site/parceiros");
                break;
            case 'insert':
                $target_file = "../themes/images/clients/";
                $imagem = "";
                if ($_FILES["parceirosImagemFile"]["error"] == 0) {
                    $novoNome = explode(".", $_FILES["parceirosImagemFile"]["name"]);
                    $imagem = uniqid() . "." . $novoNome[1];
                    move_uploaded_file($_FILES["parceirosImagemFile"]["tmp_name"], $target_file . $imagem);
                }
                $stmt = $conn->prepare("INSERT INTO parceiros VALUES (NULL, ?, ?);");
                $stmt->bind_param(
                    "ss",
                    $imagem,
                    $_POST["parceirosLink"]

                );
                $stmt->execute();
                array_push($_SESSION["mensagens_painel"], ["tipo" => "success", "menssagem" => "Parceiro adicionado com sucesso!"]);
                header("Location: " . $SITE . "/painel/site/parceiros");
                break;
            case 'delete':
                $conn->query("DELETE FROM parceiros WHERE parceirosId = " . $SUBPAGINA_ID);
                array_push($_SESSION["mensagens_painel"], ["tipo" => "success", "menssagem" => "Removido com sucesso!"]);
                header("Location: " . $SITE . "/painel/site/parceiros");
                break;
        }
    }

    include "HeaderFragmento.php";
    include "ParceirosPagina.php";
    include "FooterFragmento.php";
    die;
}
function bannersArea()
{
    global $SITE;
    global $conn;
    global $BASEURL;
    global $PAGINA_REQ;
    global $SUBPAGINA_REQ;
    global $SUBPAGINA_ACAO;
    global $SUBPAGINA_ID;

    $bannersRes = $conn->query("SELECT * FROM banners");
    $banners = $bannersRes->fetch_all(MYSQLI_ASSOC);

    if ($SUBPAGINA_ACAO != "") {
        $_SESSION["mensagens_painel"] = array();

        switch ($SUBPAGINA_ACAO) {
            case 'editar':
                $bannersRes = $conn->query("SELECT * FROM banners WHERE bannersId = " . $SUBPAGINA_ID);
                $bannersArray = $bannersRes->fetch_all(MYSQLI_ASSOC);
                $bannersArray = $bannersArray[0];
                break;
            case 'update':
                $target_file = "../themes/images/carousel/";
                $imagem = $_POST["bannersCapa"];
                if ($_FILES["bannersCapaFile"]["error"] == 0) {
                    $novoNome = explode(".", $_FILES["bannersCapaFile"]["name"]);
                    $imagem = uniqid() . "." . $novoNome[1];
                    move_uploaded_file($_FILES["bannersCapaFile"]["tmp_name"], $target_file . $imagem);
                }
                $stmt = $conn->prepare("UPDATE banners SET bannersTitulo = ?, bannersSubTitulo = ?, bannersParagrafo = ?, bannersCapa = ?, bannersLink = ? WHERE bannersId = ?;");
                $stmt->bind_param(
                    "sssssi",
                    $_POST["bannersTitulo"],
                    $_POST["bannersSubTitulo"],
                    $_POST["bannersParagrafo"],
                    $imagem,
                    $_POST["bannersLink"],
                    $_POST["bannersId"]
                );
                $stmt->execute();
                array_push($_SESSION["mensagens_painel"], ["tipo" => "success", "menssagem" => "Banner atualizado com sucesso!"]);
                header("Location: " . $SITE . "/painel/site/banners");
                break;
            case 'insert':
                $target_file = "../themes/images/carousel/";
                $imagem = "";
                if ($_FILES["bannersCapaFile"]["error"] == 0) {
                    $novoNome = explode(".", $_FILES["bannersCapaFile"]["name"]);
                    $imagem = uniqid() . "." . $novoNome[1];
                    move_uploaded_file($_FILES["bannersCapaFile"]["tmp_name"], $target_file . $imagem);
                }
                $stmt = $conn->prepare("INSERT INTO banners VALUES (NULL, ?, ?, ?, ?, ?);");
                $stmt->bind_param(
                    "sssss",
                    $_POST["bannersTitulo"],
                    $_POST["bannersSubTitulo"],
                    $_POST["bannersParagrafo"],
                    $imagem,
                    $_POST["bannersLink"]
                );
                $stmt->execute();
                array_push($_SESSION["mensagens_painel"], ["tipo" => "success", "menssagem" => "Banner adicionado com sucesso!"]);
                header("Location: " . $SITE . "/painel/site/banners");
                break;
            case 'delete':
                $conn->query("DELETE FROM banners WHERE bannersId = " . $SUBPAGINA_ID);
                array_push($_SESSION["mensagens_painel"], ["tipo" => "success", "menssagem" => "Removido com sucesso!"]);
                header("Location: " . $SITE . "/painel/site/banners");
                break;
        }
    }

    include "HeaderFragmento.php";
    include "BannersPagina.php";
    include "FooterFragmento.php";
    die;
}
function empresaArea()
{
    global $SITE;
    global $conn;
    global $BASEURL;
    global $PAGINA_REQ;
    global $SUBPAGINA_REQ;
    global $SUBPAGINA_ACAO;
    global $SUBPAGINA_ID;

    $empresaRes = $conn->query("SELECT * FROM empresa");
    $empresa = $empresaRes->fetch_all(MYSQLI_ASSOC);
    $empresa = $empresa[0];



    if (isset($_POST["empresaNome"])) {
        $_SESSION["mensagens_painel"] = array();

        $target_file = "../themes/";
        $imagem = $_POST["empresaLogo"];
        if ($_FILES["empresaLogoFile"]["error"] == 0) {
            $novoNome = explode(".", $_FILES["empresaLogoFile"]["name"]);
            $imagem = uniqid() . "." . $novoNome[1];
            move_uploaded_file($_FILES["empresaLogoFile"]["tmp_name"], $target_file . $imagem);
        }

        $stmt = $conn->prepare("UPDATE empresa SET empresaNome = ?, empresaLogo = ?, empresaResumoQuemSomos = ? WHERE empresaId = 1;");
        $stmt->bind_param(
            "sss",
            $_POST["empresaNome"],
            $imagem,
            $_POST["empresaResumoQuemSomos"]
        );
        $stmt->execute();

        array_push($_SESSION["mensagens_painel"], ["tipo" => "success", "menssagem" => "Dados da empresa atualizado com sucesso!"]);

        header("Location: " . $SITE . "/painel/site/empresa");
    }


    include "HeaderFragmento.php";
    include "EmpresaPagina.php";
    include "FooterFragmento.php";
    die;
}
function dashboardArea()
{
    global $conn;
    global $BASEURL;

    $usuariostotalRes = $conn->query("SELECT count(usuarioId) as total FROM `usuario`;");
    $usuariostotal = $usuariostotalRes->fetch_all(MYSQLI_ASSOC);
    $usuariostotal = $usuariostotal[0];

    $produtosRes = $conn->query("SELECT count(produtosId) as total FROM produtos;");
    $produtototal = $produtosRes->fetch_all(MYSQLI_ASSOC);
    $produtototal = $produtototal[0];

    $estoquetotalValor = 0;
    $estoqueRes = $conn->query("SELECT * FROM `estoque`");
    $estoquetotal = $estoqueRes->fetch_all(MYSQLI_ASSOC);
    if(count($estoquetotal)>0){
        for ($i=0; $i < count($estoquetotal); $i++) { 
            $estoquetotalValor = $estoquetotalValor + $estoquetotal[$i]["estoqueKiloGrama"];
        }
    }

    $vendaRes = $conn->query("SELECT count(vendaId) as total  FROM venda WHERE vendaIdTipo = 1");
    $vendatotal = $vendaRes->fetch_all(MYSQLI_ASSOC);
    $vendatotal = $vendatotal[0];

    include "HeaderFragmento.php";
    include "PainelPagina.php";
    include "FooterFragmento.php";
    die;
}
function usuariosArea()
{
    global $SITE;
    global $conn;
    global $BASEURL;
    global $PAGINA_REQ;
    global $SUBPAGINA_REQ;
    global $SUBPAGINA_ACAO;
    global $SUBPAGINA_ID;


    $usuariosRes = $conn->query("SELECT * FROM usuario");
    $usuarios = $usuariosRes->fetch_all(MYSQLI_ASSOC);

    if (isset($_POST["usuarioId"])) {
        if (count($_POST["usuarioId"]) > 0) {
            $_SESSION["mensagens_painel"] = array();
            for ($i = 0; $i < count($_POST["usuarioId"]); $i++) {
                switch ($_POST["acao"][$i]) {
                    case 'remover':
                        $conn->query("DELETE FROM usuario WHERE usuarioId = " . $_POST["usuarioId"][$i]);
                        array_push($_SESSION["mensagens_painel"], ["tipo" => "success", "menssagem" => "Usuário \"" . $_POST["usuarioNome"][$i] . "\" removido!"]);
                        break;
                }
            }
            header("Location: " . $SITE . "/painel/gerenciamento-produtos/usuarios");
        }
    }

    include "HeaderFragmento.php";
    include "UsuariosPagina.php";
    include "FooterFragmento.php";
    die;
}

function vendasArea()
{
    global $SITE;
    global $conn;
    global $BASEURL;
    global $PAGINA_REQ;
    global $SUBPAGINA_REQ;
    global $SUBPAGINA_ACAO;
    global $SUBPAGINA_ID;
    $vendasRes = $conn->query("SELECT * FROM venda,usuario,tiposvenda,produtos where produtosId = vendaIdEstoqueProduto and usuarioId = vendaIdUsuario and tiposVendaId = vendaIdTipo");
    $tiposVendasRes = $conn->query("SELECT * FROM `tiposvenda`");
    $categoriasRes = $conn->query("SELECT * FROM categoria");

    $vendas = $vendasRes->fetch_all(MYSQLI_ASSOC);
    $tiposVendas = $tiposVendasRes->fetch_all(MYSQLI_ASSOC);
    $categorias = $categoriasRes->fetch_all(MYSQLI_ASSOC);



    if ($SUBPAGINA_ACAO != "") {
        $_SESSION["mensagens_painel"] = array();
        $target_file = "../themes/images/ladies/";
        switch ($SUBPAGINA_ACAO) {
            case 'editar':
                $produtoRes = $conn->query("SELECT * FROM venda,usuario,tiposvenda,produtos where vendaId = " . $SUBPAGINA_ID . " and produtosId = vendaIdEstoqueProduto and usuarioId = vendaIdUsuario and tiposVendaId = vendaIdTipo");
                $produtoArray = $produtoRes->fetch_all(MYSQLI_ASSOC);
                if (count($produtoArray) > 0) {
                    $produto = $produtoArray[0];

                    $catRes = $conn->query("SELECT * FROM relcatprod WHERE relCatProdIdProd = " . $produto["produtosId"]);
                    $catArray = $catRes->fetch_all(MYSQLI_ASSOC);
                    if (count($catArray) > 0) {
                        $produto["categoriaId"] = $catArray[0]["relCatProdIdCat"];
                    }
                }
                break;

            case 'update':
                $conn->query("UPDATE venda SET vendaIdTipo = '" . $_POST["tiposVendaId"] . "' WHERE vendaId = " . $_POST["vendaId"] . ";");

                array_push($_SESSION["mensagens_painel"], ["tipo" => "success", "menssagem" => "Venda atualizada com sucesso!"]);

                header('Location: /painel/' . ($PAGINA_REQ != "" ? $PAGINA_REQ . "/" : "") . 'vendas');
                die;
                break;
            case 'delete':
                $conn->query("DELETE FROM venda WHERE vendaId = " . $SUBPAGINA_ID);
                header('Location: /painel/' . ($PAGINA_REQ != "" ? $PAGINA_REQ . "/" : "") . 'vendas');
                array_push($_SESSION["mensagens_painel"], ["tipo" => "success", "menssagem" => "Venda removida com sucesso!"]);
                die;
                break;
        }
    }
    include "HeaderFragmento.php";
    include "VendasPagina.php";
    include "FooterFragmento.php";
    die;
}
function categoriasArea()
{
    global $SITE;
    global $conn;
    global $BASEURL;
    global $PAGINA_REQ;
    global $SUBPAGINA_REQ;
    global $SUBPAGINA_ACAO;
    global $SUBPAGINA_ID;


    $categoriaRes = $conn->query("SELECT * FROM categoria");
    $categorias = $categoriaRes->fetch_all(MYSQLI_ASSOC);

    if (isset($_POST["categoriaId"])) {
        if (count($_POST["categoriaId"]) > 0) {
            $_SESSION["mensagens_painel"] = array();
            for ($i = 0; $i < count($_POST["categoriaId"]); $i++) {
                switch ($_POST["acao"][$i]) {
                    case 'adicionar':
                        $permaVerificadoRes = $conn->query("SELECT * FROM categoria WHERE categoriaPermalink = '" . $_POST["categoriaPermalink"][$i] . "'");
                        $permaVerificado = $permaVerificadoRes->fetch_all(MYSQLI_ASSOC);
                        if (count($permaVerificado) == 0) {
                            $conn->query("INSERT INTO categoria VALUES (NULL, '" . $_POST["categoriaNome"][$i] . "', '" . $_POST["categoriaDescricao"][$i] . "', '" . $_POST["categoriaPermalink"][$i] . "');");
                            array_push($_SESSION["mensagens_painel"], ["tipo" => "success", "menssagem" => "Categoria \"" . $_POST["categoriaNome"][$i] . "\" adicionada!"]);
                        } else {
                            array_push($_SESSION["mensagens_painel"], ["tipo" => "error", "menssagem" => "Não foi adicionado a categoria \"" . $_POST["categoriaNome"][$i] . "\" pois o permlink já existe!"]);
                        }
                        break;
                    case 'atualizar':
                        $permaVerificadoRes = $conn->query("SELECT * FROM categoria WHERE categoriaPermalink = '" . $_POST["categoriaPermalink"][$i] . "'");
                        $permaVerificado = $permaVerificadoRes->fetch_all(MYSQLI_ASSOC);
                        if (count($permaVerificado) == 0) {
                            $conn->query("UPDATE categoria SET categoriaNome = '" . $_POST["categoriaNome"][$i] . "', categoriaDescricao = '" . $_POST["categoriaDescricao"][$i] . "', categoriaPermalink = '" . $_POST["categoriaPermalink"][$i] . "' WHERE categoriaId = " . $_POST["categoriaId"][$i] . ";");
                            array_push($_SESSION["mensagens_painel"], ["tipo" => "success", "menssagem" => "Categoria \"" . $_POST["categoriaNome"][$i] . "\" atualizada!"]);
                        } else {
                            array_push($_SESSION["mensagens_painel"], ["tipo" => "error", "menssagem" => "Não foi atualizada a categoria \"" . $_POST["categoriaNome"][$i] . "\" pois o permalink já existe!"]);
                        }
                        break;
                    case 'remover':
                        $conn->query("DELETE FROM categoria WHERE `categoria`.`categoriaId` = " . $_POST["categoriaId"][$i]);
                        array_push($_SESSION["mensagens_painel"], ["tipo" => "success", "menssagem" => "Categoria \"" . $_POST["categoriaNome"][$i] . "\" removida!"]);
                        break;
                }
            }
            header("Location: " . $SITE . "/painel/gerenciamento-produtos/categorias");
        }
    }

    include "HeaderFragmento.php";
    include "CategoriasPagina.php";
    include "FooterFragmento.php";
    die;
}
function estoqueArea()
{
    global $SITE;
    global $conn;
    global $BASEURL;
    global $PAGINA_REQ;
    global $SUBPAGINA_REQ;
    global $SUBPAGINA_ACAO;
    global $SUBPAGINA_ID;
    $produtosRes = $conn->query("SELECT * FROM produtos");
    $produtos = $produtosRes->fetch_all(MYSQLI_ASSOC);


    if (count($produtos) > 0) {
        for ($i = 0; $i < count($produtos); $i++) {

            $produtos[$i]["disponivel"] = 0;

            $produtosQuantidadesRes = $conn->query("SELECT * FROM estoque where estoqueIdProd = " . $produtos[$i]["produtosId"] . ";");
            $produtosQuantidadesArray = $produtosQuantidadesRes->fetch_all(MYSQLI_ASSOC);
            $kgDisponivel = 0;
            if (count($produtosQuantidadesArray) > 0) {
                for ($i2 = 0; $i2 < count($produtosQuantidadesArray); $i2++) {
                    $kgDisponivel += $produtosQuantidadesArray[$i2]["estoqueKiloGrama"];
                }
            }
            $produtos[$i]["disponivel"] = $kgDisponivel;
        }
    }
    if ($SUBPAGINA_ACAO != "") {
        $_SESSION["mensagens_painel"] = array();
        $target_file = "../themes/images/ladies/";
        switch ($SUBPAGINA_ACAO) {
            case 'editar':
                $produtoRes = $conn->query("SELECT * FROM produtos WHERE produtosId = " . $SUBPAGINA_ID);
                $produtoArray = $produtoRes->fetch_all(MYSQLI_ASSOC);
                if (count($produtoArray) > 0) {
                    $produto = $produtoArray[0];
                    $produtoEstoqueRes = $conn->query("SELECT * FROM estoque WHERE estoqueIdProd = " . $produto["produtosId"]);
                    $produtoEstoque = $produtoEstoqueRes->fetch_all(MYSQLI_ASSOC);
                }

                break;
            case 'update':
                if (count($_POST["acao"]) > 0) {
                    for ($i = 0; $i < count($_POST["acao"]); $i++) {
                        switch ($_POST["acao"][$i]) {
                            case 'adicionar':
                                if (
                                    $_POST["produtosId"] != "" &&
                                    $_POST["estoqueSKU"][$i] != ""
                                ) {
                                    $conn->query("INSERT INTO estoque VALUES (NULL, " . $_POST["produtosId"] . ", '" . $_POST["estoqueSKU"][$i] . "', '" . $_POST["estoqueKiloGrama"][$i] . "');");
                                    array_push($_SESSION["mensagens_painel"], ["tipo" => "success", "menssagem" => "Adicionado com sucesso!"]);
                                }

                                break;
                            case 'remover':
                                if ($_POST["estoqueId"][$i] != "") {
                                    $conn->query("DELETE FROM estoque WHERE estoqueId = " . $_POST["estoqueId"][$i]);
                                    array_push($_SESSION["mensagens_painel"], ["tipo" => "success", "menssagem" => "Removido com sucesso!"]);
                                }
                                break;
                            case 'atualizar':
                                $conn->query("UPDATE estoque SET estoqueKiloGrama = '" . $_POST["estoqueKiloGrama"][$i] . "', estoqueSKU = '" . $_POST["estoqueSKU"][$i] . "' WHERE estoqueId = " . $_POST["estoqueId"][$i] . ";");
                                array_push($_SESSION["mensagens_painel"], ["tipo" => "success", "menssagem" => "Atualizada com sucesso!"]);
                                break;
                        }
                    }
                }
                header('Location: /painel/' . ($PAGINA_REQ != "" ? $PAGINA_REQ . "/" : "") . 'estoque');
                die;
                break;
        }
    }

    include "HeaderFragmento.php";
    include "ProdutosEstoquePagina.php";
    include "FooterFragmento.php";
    die;
}
function produtosArea()
{
    global $SITE;
    global $conn;
    global $BASEURL;
    global $PAGINA_REQ;
    global $SUBPAGINA_REQ;
    global $SUBPAGINA_ACAO;
    global $SUBPAGINA_ID;
    $produtosRes = $conn->query("SELECT * FROM produtos");
    $categoriasRes = $conn->query("SELECT * FROM categoria");
    $produtos = $produtosRes->fetch_all(MYSQLI_ASSOC);
    $categorias = $categoriasRes->fetch_all(MYSQLI_ASSOC);



    if ($SUBPAGINA_ACAO != "") {
        $_SESSION["mensagens_painel"] = array();
        $target_file = "../themes/images/ladies/";
        switch ($SUBPAGINA_ACAO) {
            case 'editar':
                $produtoRes = $conn->query("SELECT * FROM produtos WHERE produtosId = " . $SUBPAGINA_ID);
                $produtoArray = $produtoRes->fetch_all(MYSQLI_ASSOC);
                if (count($produtoArray) > 0) {
                    $produto = $produtoArray[0];

                    $catRes = $conn->query("SELECT * FROM relcatprod WHERE relCatProdIdProd = " . $produto["produtosId"]);
                    $catArray = $catRes->fetch_all(MYSQLI_ASSOC);
                    if (count($catArray) > 0) {
                        $produto["categoriaId"] = $catArray[0]["relCatProdIdCat"];
                    }
                }
                break;
            case 'insert':

                $verificadorPermaRes = $conn->query("SELECT * FROM `produtos` WHERE `produtosPermalink` = '" . $_POST["produtosPermalink"] . "'");
                $verificadorPerma = $verificadorPermaRes->fetch_all(MYSQLI_ASSOC);
                if (count($verificadorPerma) == 0) {
                    if (
                        $_POST["produtosNome"] != "" &&
                        $_POST["produtosPermalink"] != "" &&
                        $_POST["produtosDescricao"] != "" &&
                        $_POST["produtosPreco"] != ""
                    ) {
                        $imagem = "";
                        if ($_FILES["produtosCapaFile"]["error"] == 0) {
                            $novoNome = explode(".", $_FILES["produtosCapaFile"]["name"]);
                            $imagem = uniqid() . "." . $novoNome[1];
                            move_uploaded_file($_FILES["produtosCapaFile"]["tmp_name"], $target_file . $imagem);
                        }
                        $conn->query("INSERT INTO produtos VALUES (NULL,
                     '" . $_POST["produtosNome"] . "',
                     '" . $_POST["produtosPermalink"] . "',
                     '" . $_POST["produtosDescricao"] . "',
                     '" . $imagem . "',
                     '" . $_POST["produtosPreco"] . "',
                     '" . $_POST["produtosGramasUni"] . "',
                     'A');");

                        $idadicionado = $conn->insert_id;
                        $conn->query("INSERT INTO relcatprod VALUES (NULL, " . $_POST["categoriaId"] . ", " . $idadicionado . ");");
                        array_push($_SESSION["mensagens_painel"], ["tipo" => "success", "menssagem" => "Produto \"" . $_POST["produtosNome"] . "\" adicionado com sucesso!"]);
                    }
                } else {
                    array_push($_SESSION["mensagens_painel"], ["tipo" => "success", "menssagem" => "Permalink existe tente outro permalink!"]);
                }
                header('Location: /painel/' . ($PAGINA_REQ != "" ? $PAGINA_REQ . "/" : "") . 'produtos');
                die;
                break;
            case 'update':
                $verificadorPermaRes = $conn->query("SELECT * FROM `produtos` WHERE `produtosPermalink` = '" . $_POST["produtosPermalink"] . "' and produtosId != ".$_POST["produtosId"]);
                $verificadorPerma = $verificadorPermaRes->fetch_all(MYSQLI_ASSOC);
                if (count($verificadorPerma) == 0) {
                    if (
                        $_POST["produtosId"] != "" &&
                        $_POST["produtosNome"] != "" &&
                        $_POST["produtosPermalink"] != "" &&
                        $_POST["produtosDescricao"] != "" &&
                        $_POST["produtosPreco"] != ""
                    ) {
                        $imagem = $_POST["produtosCapa"];
                        if ($_FILES["produtosCapaFile"]["error"] == 0) {
                            $novoNome = explode(".", $_FILES["produtosCapaFile"]["name"]);
                            $imagem = uniqid() . "." . $novoNome[1];
                            move_uploaded_file($_FILES["produtosCapaFile"]["tmp_name"], $target_file . $imagem);
                        }
   
                        $conn->query("UPDATE produtos SET 
                    produtosNome = '" . $_POST["produtosNome"] . "',
                     produtosPermalink = '" . $_POST["produtosPermalink"] . "',
                     produtosDescricao = '" . $_POST["produtosDescricao"] . "',
                     produtosCapa = '" . $imagem . "',
                     produtosPreco = " . $_POST["produtosPreco"] . ",
                     produtosGramasUni = " . $_POST["produtosGramasUni"] . "  
                     WHERE produtosId = " . $_POST["produtosId"] . ";");

                        $conn->query("DELETE FROM relcatprod WHERE relCatProdIdProd = " . $_POST["produtosId"]);
                        $conn->query("INSERT INTO relcatprod VALUES (NULL, " . $_POST["categoriaId"] . ", " . $_POST["produtosId"] . ");");

                        array_push($_SESSION["mensagens_painel"], ["tipo" => "success", "menssagem" => "Produto \"" . $_POST["produtosNome"] . "\" atualizado com sucesso!"]);
                    }
                } else {
                    array_push($_SESSION["mensagens_painel"], ["tipo" => "success", "menssagem" => "Permalink existe tente outro permalink!"]);
                }

                header('Location: /painel/' . ($PAGINA_REQ != "" ? $PAGINA_REQ . "/" : "") . 'produtos');
                die;
                break;
            case 'delete':
                $conn->query("DELETE FROM produtos WHERE produtosId = " . $SUBPAGINA_ID);
                header('Location: /painel/' . ($PAGINA_REQ != "" ? $PAGINA_REQ . "/" : "") . 'produtos');
                array_push($_SESSION["mensagens_painel"], ["tipo" => "success", "menssagem" => "Produto \"" . $_POST["produtosNome"] . "\" removido com sucesso!"]);
                die;
                break;
        }
    }
    include "HeaderFragmento.php";
    include "ProdutosPagina.php";
    include "FooterFragmento.php";
    die;
}

function loginArea()
{
    if (isset($_SESSION["administrador"]["administradorId"])) {
        header('Location: /painel');
        die;
    }

    global $conn;
    $mensagens = array();

    if (count($_POST) > 0) {

        if ($_POST["administradorEmail"] != "" && $_POST["administradorSenha"] != "") {
            $stmt = $conn->prepare("SELECT * FROM administrador WHERE administradorSenha = ? AND administradorEmail = ?");
            $stmt->bind_param(
                "ss",
                $_POST["administradorSenha"],
                $_POST["administradorEmail"]
            );

            $stmt->execute();
            $stmtAdministrador = fetch_quaquer_statement($stmt);

            if (count($stmtAdministrador) > 0) {
                $_SESSION["administrador"]["administradorId"] = $stmtAdministrador[0]["administradorId"];
                $_SESSION["administrador"]["administradorNome"] = $stmtAdministrador[0]["administradorNome"];
                $_SESSION["administrador"]["administradorEmail"] = $stmtAdministrador[0]["administradorEmail"];
                array_push($mensagens, ["titulo" => "Pronto", "menssagem" => "Login efetuado com sucesso!"]);
                header('Location: /painel');
            } else {
                if ($_POST["administradorEmail"] == "") array_push($mensagens, ["titulo" => "Erro", "menssagem" => "Usuário inválido!"]);
            }
        } else {
            if ($_POST["administradorEmail"] == "") {
                array_push($mensagens, ["titulo" => "Erro", "menssagem" => "Campo Email é obrigatório!"]);
            }
            if ($_POST["administradorSenha"] == "") {
                array_push($mensagens, ["titulo" => "Erro", "menssagem" => "Campo Senha é obrigatório!"]);
            }
        }
    }
    $_SESSION["mensagens_painel"] = $mensagens;
    include "LoginPagina.php";
}
function logoutArea()
{
    unset($_SESSION["administrador"]);
    header('Location: /painel/Login');
    die;
}







die;



function MenuLateralAreas()
{
    global $conn;
    global $ROTALIMPA;
    global $BASEURL;

    $rotaLimpaExploded = explode("/", $ROTALIMPA);

    $menuRes = $conn->query("SELECT * FROM painelareas where painelAreasIdParent IS NULL");
    $menu = $menuRes->fetch_all(MYSQLI_ASSOC);
    if (count($menu) > 0) {
        for ($i = 0; $i < count($menu); $i++) {
            $menu[$i]["subMenus"] = array();
            $subMenuRes = $conn->query("SELECT * FROM painelareas WHERE painelAreasIdParent = " . $menu[$i]["painelAreasId"]);
            $subMenu = $subMenuRes->fetch_all(MYSQLI_ASSOC);

            $ativo = false;
            if ($rotaLimpaExploded[2] == $menu[$i]["painelAreasPermalink"] || $i == 0 && $rotaLimpaExploded[2] == "" && $menu[$i]["painelAreasPermalink"] == "dashboard") {
                $ativo = true;
                $menu[$i]["ativo"] = true;
            }
            if (count($subMenu) > 0) {
                for ($i2 = 0; $i2 < count($subMenu); $i2++) {

                    if ($ativo == true) {
                        if ($subMenu[$i2]["painelAreasPermalink"] == $rotaLimpaExploded[3]) {
                            $subMenu[$i2]["ativo"] = true;
                        }
                    }
                    array_push($menu[$i]["subMenus"], $subMenu[$i2]);
                }
            }
        }
    }
    return $menu;
}
