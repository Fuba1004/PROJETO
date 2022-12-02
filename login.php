	
			<section class="header_text sub">
			<img class="pageBanner" src="themes/images/pageBanner.png" alt="New products" >
				<h4><span>Login ou Cadastrar</span></h4>
			</section>			
			<section class="main-content">				
				<div class="row">
					<div class="span5">					
						<h4 class="title"><span class="text"><strong>Login</strong> Àrea</span></h4>
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
					<div class="span7">					
						<h4 class="title"><span class="text"><strong>Cadastro</strong> Àrea</span></h4>
						<form action="/criar-conta" method="post" class="form-stacked">
							<fieldset>
								<div class="control-group">
									<label class="control-label">Nome/Email</label>
									<div class="controls">
										<input type="text" placeholder="Seu Nome" name="usuarioNome" class="input-xlarge">
										<input type="email" placeholder="Seu Email" name="usuarioEmail" class="input-xlarge">
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">RG</label>
									<div class="controls">
										<input type="text" placeholder="RG" name="usuarioRg" class="input-xlarge">
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">Senha/Confirmação de Senha:</label>
									<div class="controls">
										<input type="password" placeholder="Senha" name="usuarioSenha" class="input-xlarge">
										<input type="password" placeholder="Confirmação de Senha" name="usuarioConfirmacaoSenha" class="input-xlarge">
									</div>
								</div>	

								<div class="control-group">
									<label class="control-label">Endereço/Número</label>
									<div class="controls">
										<input type="text" placeholder="Endereço" name="usuarioLogradouro">
										<input type="text" placeholder="Número" name="usuarioNumero">
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">CEP/Cidade/Estado</label>
									<div class="controls">
										<input type="text" placeholder="CEP" name="usuarioCep">
										<input type="text" placeholder="Cidade" name="usuarioCidade">
										<input type="text" placeholder="Estado" name="usuarioEstado">
									</div>
								</div>
	
								<div class="actions"><input tabindex="9" class="btn btn-inverse large" type="submit" value="Criar conta"></div>

								<hr>
							</fieldset>
						</form>					
					</div>				
				</div>
			</section>			
	