<div class="container">
		<div class="row">
			
			
			<div class="col s12 m4 offset-m4 login" style="margin-top: 10%;">
				<div class="col s12">
					<div class="col s12">
						<i class="fa fa-user" style="font-size: 4em"></i>
						<img src="/assets/img/logo.png" alt="" style="display: block; width: 79%; float: right; margin-top: -16px; ">
					</div>
					<div class="col s12">
						<h2 class="center" style="width: 34%;font-size: 22px;"> Acceso Central de Apuntes </h2>	
					</div>
						
					
				</div>
				<form action="<?=base_url()?>index.php/Usuarios/iniciar_sesion_post" method="post">
					<div class="col s12">
						<label for="">Usuario</label>
						<h1></h1>
						<input type="text" name="RUT" id="RUT" style="width: 40%" placeholder="Ej: 12345678">
					</div>
					<div class="col s12">
						<label for="">Clave</label>
						<h1></h1>
						<input type="password" name="CLAVE" id="CLAVE" style="width: 40%" placeholder="********">
					</div>
					<div class="col s12">
						<input type="submit" value="Ingresar" class="btn UCM " style="width: 40%; margin-bottom: 25px;">
					</div>
				</form>
				<p class="center"><i class="fa fa-phone" style="font-size: 1.6rem"></i> Soporte:  <span style="font-weight: normal; width:40%">(071) 263-</span>3555</label></p>
			</div>
		</div>
	</div>