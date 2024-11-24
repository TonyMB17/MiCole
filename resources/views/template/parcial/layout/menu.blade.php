<ul class="sidebar-menu" data-widget="tree">
	<li class="header">Opciones de acceso de la plataforma</li>
	@if(Session::has('idUser'))
		<li id="mControlPanel" class="treeview">
			<a href="#">
				<i class="fa fa-dashboard"></i> <span>Panel de control</span>
				<span class="pull-right-container">
					<i class="fa fa-angle-left pull-right"></i>
				</span>
			</a>
			<ul class="treeview-menu">
				<li id="miHome"><a href="{{url('index/indexadmin')}}"><i class="fa fa-circle-o"></i> Página de inicio</a></li>
				<li><a href="{{url('/')}}"><i class="fa fa-circle-o"></i> Ir al sitio web</a></li>
				@if(ViewHelper::hasMainRole('Súper usuario'))
					<li id="miConfigurationManagement" style="border-top: 1px solid #555555;"><a href="{{url('configuration/management')}}"><i class="fa fa-circle-o"></i> Configuración general</a></li>
				@endif
				@if(ViewHelper::hasMainRole('Súper usuario') || ViewHelper::hasMainRole('Administrador'))
					<li id="miGeneralBackup"><a href="#" onclick="confirmDialog(function(){ window.location.href='{{url('general/backup')}}'; });"><i class="fa fa-circle-o"></i> Backup de datos</a></li>
					<li id="miExceptionGetAll"><a href="{{url('exception/getall')}}"><i class="fa fa-circle-o"></i> Lista de excepciones</a></li>
				@endif
			</ul>
		</li>
	@endif
	@if(ViewHelper::hasMainRole('Súper usuario') || ViewHelper::hasMainRole('Administrador'))
		<li id="mUserModule" class="treeview">
			<a href="#">
				<i class="fa fa-users"></i> <span>Módulo de usuarios</span>
				<span class="pull-right-container">
					<i class="fa fa-angle-left pull-right"></i>
				</span>
			</a>
			<ul class="treeview-menu">
				<li id="miUserInsertAsAdmin"><a href="{{url('user/insertasadmin')}}"><i class="fa fa-circle-o"></i> Registrar usuario</a></li>
				<li id="miUserGetAll"><a href="{{url('user/getall/1')}}"><i class="fa fa-circle-o"></i> Lista de usuarios</a></li>
			</ul>
		</li>
	@endif
	@if(ViewHelper::hasMainRole('Súper usuario') || ViewHelper::hasMainRole('Administrador'))
		<li id="mInstitutionModule" class="treeview">
			<a href="#">
				<i class="fa fa-university"></i> <span>Módulo de instituciones</span>
				<span class="pull-right-container">
					<i class="fa fa-angle-left pull-right"></i>
				</span>
			</a>
			<ul class="treeview-menu">
				<li id="miInstitutionModuleGetAll"><a href="{{url('institution/getall/1')}}"><i class="fa fa-circle-o"></i> Lista de instituciones</a></li>
			</ul>
		</li>
	@endif
	@if(ViewHelper::hasMainRole('Súper usuario') || ViewHelper::hasMainRole('Administrador'))
		<li id="mWaterModule" class="treeview">
			<a href="#">
				<i class="fa fa-life-saver"></i> <span>Módulo de agua</span>
				<span class="pull-right-container">
					<i class="fa fa-angle-left pull-right"></i>
				</span>
			</a>
			<ul class="treeview-menu">
				<li id="miWaterModuleGetAll"><a href="{{url('water/getall')}}"><i class="fa fa-circle-o"></i> Lista de calidad</a></li>
			</ul>
		</li>
	@endif
</ul>