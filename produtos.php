<section class="header_text sub">
	<img class="pageBanner" src="themes/images/pageBanner.png" alt="New products">
	<h4><span>Produtos</span></h4>
</section>
<section class="main-content">

	<div class="row">
		<div class="span9">
			<ul class="thumbnails listing-products">

				<?php
				for ($i = 0; $i < count($SYS["data"]["produtos"]); $i++) {

					echo '<li class="span3">';
					echo '	<div class="product-box">';
					echo '		<span class="sale_tag"></span>';
					echo '		<a href="./produto?produto=' . $SYS["data"]["produtos"][$i]["produtosPermalink"] . '"><img alt="" src="themes/images/ladies/' . $SYS["data"]["produtos"][$i]['produtosCapa'] . '"></a><br />';
					echo '		<a href="./produto?produto=' . $SYS["data"]["produtos"][$i]["produtosPermalink"] . '" class="title">' . $SYS["data"]["produtos"][$i]['produtosNome'] . '</a><br />';
					echo '		<a href="#" class="category">' . $SYS["data"]["produtos"][$i]['categoriaNome'] . '</a>';
					echo '		<p class="price">R$' . $SYS["data"]["produtos"][$i]['produtosPreco'] . '</p>';
					echo '	</div>';
					echo '</li>';
				}
				?>



			</ul>
			<hr>

		</div>
		<div class="span3 col">
			<div class="block">
				<ul class="nav nav-list">
					<li class="nav-header">SUB CATEGORIAS</li>
					<?php
					for ($i = 0; $i < count($SYS["data"]["categorias"]); $i++) {
					$classPersonalizada = "";
						if(isset($_GET["categoria"])){
							if($_GET["categoria"] == $SYS["data"]["categorias"][$i]["categoriaPermalink"]){
								$classPersonalizada = "active";
							}
						}
						echo '<li class="active"><a class="'.$classPersonalizada.'" href="./produtos?categoria=' . $SYS["data"]["categorias"][$i]["categoriaPermalink"] . '">' . $SYS["data"]["categorias"][$i]["categoriaNome"] . '</a></li>';
					}
					?>
				</ul>
			</div>
			<div class="block">
				<h4 class="title">
					<span class="pull-left"><span class="text">ALEATÓRIOS</span></span>
					<span class="pull-right">
						<a class="left button" href="#myCarousel" data-slide="prev"></a><a class="right button" href="#myCarousel" data-slide="next"></a>
					</span>
				</h4>
				<div id="myCarousel" class="carousel slide">
					<div class="carousel-inner">


						<?php
						$quantidade = floor(count($SYS["data"]["produtosRelacionados"]) / 1);
						for ($i = 0; $i < count($SYS["data"]["produtosRelacionados"]); $i++) {
							echo '	<div class="' . ($i == 0 ? 'active' : '') . ' item"><ul class="thumbnails">';

							echo '<li class="span3">';
							echo '	<div class="product-box">';
							echo '		<span class="sale_tag"></span>';
							echo '		<p><a href="./produto?produto=' . $SYS["data"]["produtosRelacionados"][$i]["produtosPermalink"] . '"><img src="themes/images/ladies/' . $SYS["data"]["produtosRelacionados"][$i]['produtosCapa'] . '" alt="" /></a></p>';
							echo '		<a href="./produto?produto=' . $SYS["data"]["produtosRelacionados"][$i]["produtosPermalink"] . '" class="title">' . $SYS["data"]["produtosRelacionados"][$i]['produtosNome'] . '</a><br />';
							echo '		<a href="products.html" class="category">' . $SYS["data"]["produtosRelacionados"][$i]['categoriaNome'] . '</a>';
							echo '		<p class="price">R$' . $SYS["data"]["produtosRelacionados"][$i]['produtosPreco'] . '</p>';
							echo '	</div>';
							echo '</li>';

							echo "</ul></div>";
						}
						?>

					</div>
				</div>
			</div>
			<div class="block">
				<h4 class="title"><strong>Melhores</strong> Vendas</h4>
				<ul class="small-product">
					<?php
					for ($i = 0; $i < count($SYS["data"]["produtosMaisVendidos"]); $i++) {
						echo '<li>';
						echo '	<a href="./produto?produto=' . $SYS["data"]["produtosMaisVendidos"][$i]["produtosPermalink"] . '" title="' . $SYS["data"]["produtosMaisVendidos"][$i]["produtosNome"] . '">';
						echo '		<img src="themes/images/ladies/' . $SYS["data"]["produtosMaisVendidos"][$i]['produtosCapa'] . '" alt="' . $SYS["data"]["produtosMaisVendidos"][$i]["produtosNome"] . '">';
						echo '	</a>';
						echo '	<a href="./produto?produto=' . $SYS["data"]["produtosMaisVendidos"][$i]["produtosPermalink"] . '">' . $SYS["data"]["produtosMaisVendidos"][$i]["produtosNome"] . '</a>';
						echo '</li>';
					}
					?>
				</ul>
			</div>
		</div>
	</div>
</section>
<script>
	document.querySelector("[action='/produtos']").addEventListener("submit",function(){
		event.preventDefault();
		if(event.target.querySelector("[name]").value != ""){
			let eveProv = {preventDefault:function(){console.log("Falso prevent")},target:{tagName : "A",href:event.target.action+"?busca="+event.target.querySelector("[name]").value}}
			delegateEvent(eveProv)
		}else{
			alert("Preencha busca");
		}
	})
	document.addEventListener("click", function(event) {
		delegateEvent(event)
	})
	function delegateEvent(event){
		if (event.target.tagName == "A") {
			if (event.target.href.indexOf("categoria=") > 0 || event.target.href.indexOf("pagina=") > 0 || event.target.href.indexOf("busca=") > 0) {
				event.preventDefault();
				if (location.search.split("?").length > 1) {
					if (location.search.split("?")[1].split("&").length > 0) {
						let uris = location.search.split("?")[1].split("&");
						let uriEdited = [];
						for (let x = 0; x < uris.length; x++) {
							uriEdited.push({
								chave: uris[x].split("=")[0],
								valor: uris[x].split("=")[1]
							})
						}
						let add = true;
						for (let x = 0; x < uriEdited.length; x++) {
							if(event.target.href.split("?")[1].split("=")[0]==uriEdited[x].chave){
								add = false;
								break;
							}
						}if(add == true){
							uriEdited.push({
								chave: event.target.href.split("?")[1].split("=")[0],
								valor: event.target.href.split("?")[1].split("=")[1]
							});
						}
						
						for (let x = 0; x < uriEdited.length; x++) {
							if (uriEdited[x].chave == event.target.href.split("?")[1].split("=")[0]) {
								uriEdited[x].valor = event.target.href.split("?")[1].split("=")[1]
							}
						}
						let newUri = "?";
						for (let x = 0; x < uriEdited.length; x++) {
							newUri += (x!=0?"&":"") + uriEdited[x].chave+"="+uriEdited[x].valor;
						}
						location.href = location.href.split("?")[0]+newUri;
					}
				} else {
					location.href = event.target.href
				}
			}
		}
	}
</script>
<style>
	.nav-list>.active>a.active {
    color: #fff;
    text-shadow: 0 -1px 0 rgb(0 0 0 / 20%);
    background-color: #08c;
}
</style>