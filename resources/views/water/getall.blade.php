@extends('template.layout')
@section('title', 'Lista de calidad')
@section('generalBody')
<div class="nav-tabs-custom">
	<div class="tab-content">
		<div id="divSearch" class="row">
			<div class="col-md-5">
				<div class="input-group">
					<div class="input-group-addon">
						<i class="fa fa-search"></i>
					</div>
					<input type="text" id="txtSearch" name="txtSearch" class="form-control pull-right" placeholder="Información para búsqueda (Enter)" autofocus onkeyup="searchWater(this.value, '{{url('water/getall/1')}}', event);" value="{{$searchParameter}}">
				</div>
			</div>
			<div class="col-md-2">
				<button type="button" class="btn btn-success btn-block" onclick="exportWater($('#txtSearch').val(), '{{url('water/export')}}');">Exportar</button>
			</div>
			<div class="col-md-5">
				{!!ViewHelper::renderPagination('water/getall', $quantityPage, $currentPage, $searchParameter)!!}
			</div>
		</div>
		<hr>
		<div class="table-responsive">
			<table id="tableCollege" class="table table-striped table-bordered" style="min-width: 777px;">
				<thead>
					<tr>
						<th>Institución</th>
						<th>Provincia</th>
						<th>Distrito</th>
						<th class="text-center">Periodo</th>
						<th class="text-center">MCR S. 1</th>
						<th class="text-center">MCR S. 2</th>
						<th class="text-center">MCR S. 3</th>
						<th class="text-center">MCR S. 4</th>
						<th class="text-center">MCR S. 5</th>
						<th class="text-center">Promedio</th>
					</tr>
				</thead>
				<tbody>
					@foreach($listTWater as $value)
						<tr>
							<td>
								{{$value->tinstitution->name}}
								<div><small style="color: #999999;font-weight: bold;">{{$value->tinstitution->lender}}</small></div>
							</td>
							<td>{{$value->tinstitution->tdistrict->tprovince->name}}</td>
							<td>{{$value->tinstitution->tdistrict->name}}</td>
							<td class="text-center">
								<div>{{$value->month}}</div>
								{{substr($value->created_at, 0, 4)}}
							</td>
							<td class="text-center" style="color: {{$value->resultW1==-1 ? '#000000' : (($value->resultW1<0.5 || $value->resultW1>1) ? 'red' : '#009e00')}};">{{$value->resultW1!=-1 ? number_format($value->resultW1, 1, '.') : '-'}}</td>
							<td class="text-center" style="color: {{$value->resultW2==-1 ? '#000000' : (($value->resultW2<0.5 || $value->resultW2>1) ? 'red' : '#009e00')}};">{{$value->resultW2!=-1 ? number_format($value->resultW2, 1, '.') : '-'}}</td>
							<td class="text-center" style="color: {{$value->resultW3==-1 ? '#000000' : (($value->resultW3<0.5 || $value->resultW3>1) ? 'red' : '#009e00')}};">{{$value->resultW3!=-1 ? number_format($value->resultW3, 1, '.') : '-'}}</td>
							<td class="text-center" style="color: {{$value->resultW4==-1 ? '#000000' : (($value->resultW4<0.5 || $value->resultW4>1) ? 'red' : '#009e00')}};">{{$value->resultW4!=-1 ? number_format($value->resultW4, 1, '.') : '-'}}</td>
							<td class="text-center" style="color: {{$value->resultW5==-1 ? '#000000' : (($value->resultW5<0.5 || $value->resultW5>1) ? 'red' : '#009e00')}};">{{$value->resultW5!=-1 ? number_format($value->resultW5, 1, '.') : '-'}}</td>
							<td class="text-center" style="color: {{($value->average<0.5 || $value->average>1) ? 'red' : '#009e00'}};font-weight: bold;">
								{{$value->average}}
								<div><small>{{($value->average<0.5 || $value->average>1) ? 'Inadecuado' : 'Bueno'}}</small></div>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
	</div>
</div>
@endsection
@section('jsSection')
<script src="{{asset('viewResources/water/getall.js?x='.config('var.CACHE_LAST_UPDATE'))}}"></script>
@endsection