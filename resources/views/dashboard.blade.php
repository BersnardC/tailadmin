@extends('layouts.app')
@section('content')
	<div class="container mt-5">
		<h1 class="text-center" id="text-welcome"><img src="{{url('logo-tail.png')}}" width="50px" height="50px"><span style="color: red; font-weight: 800;">Tail</span>Admin</h1>
		<div class="row mt-5">
			<div class="col-md-4">
				<h4 class="text-center"><span class="far fa-user"></span> Nueva Persona</h4>
				<form action="{{url('api/items')}}" method="POST" id="form_peoples">
					<div>
						<div class="alert alert-primary" id="text_accions" role="alert" style="display: none;"></div>
					</div>	
					<input type="text" name="code" class="form-control mb-2" id="new_item_id" placeholder="Número">
					<input type="text" name="name" class="form-control mb-2" id="new_item_name" placeholder="Nombre">
					<select class="form-control mb-2" name="assignment" id="assignment">
						<option value="0">Automático</option>
						@foreach($tails as $tail)
							@if($tail->status == 1)
								<option value="{{$tail->id}}">Cola {{$tail->id}}</option>
							@endif()
						@endforeach()
					</select>
					<div class="d-grid gap-2">
						<button type="submit" class="btn btn-dark" id="bn-save">Guardar</button>
					</div>
				</form>
			</div>
			<div class="col-md-8">
				<h4 class="text-center"> <span class="far fa-list-alt"></span> Colas disponibles</h4>
				<div class="row">
					@foreach($tails as $tail)
						<div class="col-md-6 mb-3">
							<div class="card">
								<div class="card-header">
									<h6>Cola # {{$tail->id}} 
										<div class="header-info">
											<a href="#"><span class="far fa-user" title="Agente"></span> <span id="tail_user_{{$tail->id}}">{{$tail->agent}}</span></a> |
											<a href="#"><span class="fas fa-users" title="Personas en cola"></span> <span id="tail_peoples_{{$tail->id}}">({{count($tail->items)}})</span></a> | 
											<a href="#"><span class="fas fa-cogs" title="Configuración"></span></a>
										</div> 
									</h6>
								</div>
								<div class="card-body tails-item-box">
									<ul class="list-group" id="list_items_{{$tail->id}}">
										@if(count($tail->items))
											@foreach($tail->items as $item)
												<li class="list-group-item text-center {{$item->status == 1 ? 'active' : ''}}" data-process="{{$item->status == 1 ? '11' : '00'}}" id="li_item_{{$item->id}}"><b>{{$item->code}}</b> - {{$item->name}}
														<button class="tbtn btn" onclick="process_item('{{$item->id}}', '{{$tail->id}}')" title="{{$item->status == 1 ? 'Finalizar' : 'Atender'}}"><span class="fas fa-{{$item->status == 1 ? 'check' : 'clock'}}"></span></button>
												</li>
											@endforeach()
										@else
											@if($tail->status == 1)
												<li class="list-group-item text-center text-danger">Cola vacía</li>
											@else
												<li class="list-group-item text-center text-danger">Cola pausada</li>
											@endif()
										@endif()
									</ul>
								</div>
							</div>
						</div>
					@endforeach()
				</div>
			</div>
		</div>
	</div>
@endsection()
@section('scripts')
<script type="text/javascript" src="{{url('main.js')}}"></script>
@endsection()