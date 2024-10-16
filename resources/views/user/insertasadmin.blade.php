@extends('template.layout')
@section('title', 'Registrar usuario')
@section('generalBody')
<div class="nav-tabs-custom">
	<div class="tab-content">
		<form id="frmInsertAsAdminUser" action="{{url('user/insertasadmin')}}" method="post" enctype="multipart/form-data">
			<div class="row">
				<div class="form-group col-md-4">
					<label for="txtFirstName">Nombre*</label>
					<input type="text" id="txtFirstName" name="txtFirstName" class="form-control" value="{{old('txtFirstName')}}">
				</div>
				<div class="form-group col-md-4">
					<label for="txtSurName">Apellido*</label>
					<input type="text" id="txtSurName" name="txtSurName" class="form-control" value="{{old('txtSurName')}}">
				</div>
				<div class="form-group col-md-4">
					<label for="txtEmail">Correo electrónico*</label>
					<input type="text" id="txtEmail" name="txtEmail" class="form-control" value="{{old('txtEmail')}}">
				</div>
			</div>
			<div class="row">
				<div class="form-group col-md-4">
					<label for="passPassword">Contraseña*</label>
					<input type="password" id="passPassword" name="passPassword" class="form-control" value="{{old('passPassword')}}">
				</div>
				<div class="form-group col-md-4">
					<label for="passRetypePassword">Repita contraseña*</label>
					<input type="password" id="passRetypePassword" name="passRetypePassword" class="form-control" value="{{old('passRetypePassword')}}">
				</div>
			</div>
			<hr>
			<div class="row">
				<div class="col-md-12">
					<label for="selectRole">Rol</label>
					<select id="selectRole" name="selectRole[]" class="form-control selectStatic" multiple style="width: 100%;">
						<option value="Administrador">Administrador</option>
						<option value="Normal">Normal</option>
					</select>
				</div>
			</div>
			<hr>
			<div class="row">
				{!!csrf_field()!!}
				<div class="form-group col-md-12 text-right">
					<input type="button" class="btn btn-primary" value="Registrar datos ingresados" onclick="sendFrmInsertAsAdminUser();">
				</div>
			</div>
		</form>
	</div>
</div>
@endsection
@section('jsSection')
<script src="{{asset('viewResources/user/insertasadmin.js?x='.config('var.CACHE_LAST_UPDATE'))}}"></script>
@endsection