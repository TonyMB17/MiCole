@extends('template.layout')
@section('title', 'Lista de instituciones')
@section('generalBody')
<div class="nav-tabs-custom">
	<div class="tab-content">
		<div id="divSearch" class="row">
			<div class="col-md-7">
				<div class="input-group">
					<div class="input-group-addon">
						<i class="fa fa-search"></i>
					</div>
					<input type="text" id="txtSearch" name="txtSearch" class="form-control pull-right" placeholder="Información para búsqueda (Enter)" autofocus onkeyup="searchInstitution(this.value, '{{url('institution/getall/1')}}', event);" value="{{$searchParameter}}">
				</div>
			</div>
			<div class="col-md-5">
				{!!ViewHelper::renderPagination('institution/getall', $quantityPage, $currentPage, $searchParameter)!!}
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
						<th></th>
					</tr>
				</thead>
				<tbody>
					@foreach($listTInstitution as $value)
						<tr>
							<td>
								{{$value->name}}
								<div><small style="color: #999999;font-weight: bold;">{{$value->lender}}</small></div>
							</td>
							<td>{{$value->tdistrict->tprovince->name}}</td>
							<td>{{$value->tdistrict->name}}</td>
							<td class="text-right" style="width: 45px;">
								<span class="btn btn-default btn-xs glyphicon glyphicon-user" data-toggle="tooltip" data-placement="left" title="Gestionar usuarios" onclick="ajaxDialog('generalDialog', null, '{{str_replace('\'', '&#39;', $value->name)}} (Gestión de usuarios)', { _token : '{{csrf_token()}}', idInstitution: '{{$value->idInstitution}}' }, '{{url('institution/usermanagement')}}', 'POST', null, null, false, true);"></span>
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
<script src="{{asset('viewResources/institution/getall.js?x='.config('var.CACHE_LAST_UPDATE'))}}"></script>
@endsection