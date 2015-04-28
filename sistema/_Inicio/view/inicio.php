<h1 class="hb" align="center">
	<strong>ARES</strong>
</h1>
<div id='LoginBlock' align="center">
	<div class="ppa mb">
		<p align="center">
			<strong>Seja bem vindo!</strong>
		</p>
	</div>
	<?php Control::view()->showUserMessages(E_USER_ERROR);?>
	<?php Control::view()->showUserMessages(E_USER_WARNING);?>
	<?php Control::view()->showUserMessages(E_USER_NOTICE);?>
	<form method='POST' name='form_login' class="form_login">
		<div class="mb ppt">
			<label>Usu&aacute;rio <input type='text' name='st_username'
				id='st_username' class="big">
			</label>
		</div>
		<div class="mb">
			<label>Senha <input type='password' name='st_password'
				id='st_password' class="big">
			</label><input type="hidden" name="action" value="login">
		</div>
		<div align="center" class="ppt">
			<input type='hidden' name="action" value="acessar">
			<button type='submit' class='bt_blue bt_grande'>Entrar</button>
		</div>
	</form>
	<p>.</p>
	<p>
		<small>Acesso ao Sistema de Gerenciamento de Conteúdo</small>
	</p>
</div>
