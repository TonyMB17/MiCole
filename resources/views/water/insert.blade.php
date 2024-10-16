@extends('template.layoutpublic')
@section('generalBody')
<div class="paddingLayoutBodyInternal">
	<div class="pageTitle">Mi cole' con agua segura</div>
	<div class="row">
		<div class="col-lg-4 col-md-4 col-sm-12 text-center">
			<img src="{{asset('img/viewResources/water/insert/water.png')}}" alt="" style="border-radius: 10px;box-shadow: 0px 0px 4px rgba(0, 0, 0, 0.7);width: 100%;">
		</div>
		<div class="col-lg-8 col-md-8 col-sm-12">
			<form id="frmInsertWater" action="{{url('water/insert')}}" method="post">
				<div class="row">
					<div class="form-group col-md-4">
						<label for="txtInstitution">Institución*</label>
						<div class="input-group readonly">
							<div class="input-group-addon">
								<i class="fa fa-i-cursor"></i>
							</div>
							<input type="text" id="txtInstitution" name="txtInstitution" class="form-control pull-right" value="{{$tUser->tinstitutiontuser[0]->tinstitution->name}}" readonly="readonly">
						</div>
					</div>
					<div class="form-group col-md-4">
						<label for="txtProvince">Provincia*</label>
						<div class="input-group readonly">
							<div class="input-group-addon">
								<i class="fa fa-i-cursor"></i>
							</div>
							<input type="text" id="txtProvince" name="txtProvince" class="form-control pull-right" value="{{$tUser->tinstitutiontuser[0]->tinstitution->tdistrict->tprovince->name}}" readonly="readonly">
						</div>
					</div>
					<div class="form-group col-md-4">
						<label for="txtDistrict">Distrito*</label>
						<div class="input-group readonly">
							<div class="input-group-addon">
								<i class="fa fa-i-cursor"></i>
							</div>
							<input type="text" id="txtDistrict" name="txtDistrict" class="form-control pull-right" value="{{$tUser->tinstitutiontuser[0]->tinstitution->tdistrict->name}}" readonly="readonly">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="form-group col-md-4">
						<label for="txtLender">Prestador*</label>
						<div class="input-group readonly">
							<div class="input-group-addon">
								<i class="fa fa-i-cursor"></i>
							</div>
							<input type="text" id="txtLender" name="txtLender" class="form-control pull-right" value="{{$tUser->tinstitutiontuser[0]->tinstitution->lender}}" readonly="readonly">
						</div>
					</div>
					<div class="form-group col-md-4">
						<label for="txtWeek">Periodo*</label>
						<div class="input-group readonly">
							<div class="input-group-addon">
								<i class="fa fa-i-cursor"></i>
							</div>
							<input type="text" id="txtWeek" name="txtWeek" class="form-control pull-right" value="{{$currentMonth}} - Semana {{$currentWeek}}" readonly="readonly">
						</div>
					</div>
					<div class="form-group col-md-4">
						<label for="txtDate">Fecha*</label>
						<div class="input-group readonly">
							<div class="input-group-addon">
								<i class="fa fa-i-cursor"></i>
							</div>
							<input type="text" id="txtDate" name="txtDate" class="form-control pull-right" value="{{$currentDate}}" readonly="readonly">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="form-group col-md-4">
						<label for="txtResult">Resultado*</label>
						<div class="input-group">
							<div class="input-group-addon">
								<i class="fa fa-i-cursor"></i>
							</div>
							<input type="text" id="txtResult" name="txtResult" class="form-control pull-right">
						</div>
					</div>
					<div class="form-group col-md-4"></div>
					<div class="form-group col-md-4">
						<label for="">&nbsp;</label>
						{!!csrf_field()!!}
						<input type="button" class="btn btn-primary btn-block" value="Registrar datos ingresados" onclick="sendFrmInsertWater();">
					</div>
				</div>
			</form>
		</div>
	</div>
	<hr>
	<div class="row">
		<div class="col-md-4">
			<div class="chart" style="margin-top: 15px;">
			<canvas id="barChart" style="height: 230px;"></canvas>
		</div>
		</div>
		<div class="col-md-8">
			<div class="row">
				<div class="col-md-4">
					<div style="border: 1px solid #999999;margin-top: 20px;padding: 2px;">
						<div>
							<table style="opacity: {{$listDataToGraphic[count($listDataToGraphic)-1]>=0.5 ? '1' : '0.07'}};">
								<tr>
									<td><img src="{{asset('img/viewResources/water/insert/goodWater.png')}}" alt="" style="float: left;margin: 10px;width: 35px;"></td>
									<td style="color: blue;">Calidad del agua muy buena ¡Felicidades!</td>
								</tr>
							</table>
						</div>
						<hr>
						<div>
							<table style="opacity: {{$listDataToGraphic[count($listDataToGraphic)-1]<0.5 ? '1' : '0.07'}};">
								<tr>
									<td><img src="{{asset('img/viewResources/water/insert/badWater.png')}}" alt="" style="float: left;margin: 10px;width: 35px;"></td>
									<td style="color: red;">Calidad de agua muy mala. Comunicarse con el prestador.</td>
								</tr>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('jsSection')
<script>
	var labelsGraphic='{{implode(',', $listMonthToGraphic)}}';
	var dataGraphic='{{implode(',', $listDataToGraphic)}}';
</script>
<script src="{{asset('viewResources/water/insert.js?x='.config('var.CACHE_LAST_UPDATE'))}}"></script>
@endsection