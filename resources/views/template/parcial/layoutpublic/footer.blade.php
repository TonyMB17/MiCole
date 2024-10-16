<footer>
	<div>
		<div class="paddingLayoutBody">
			<div class="row">
				<div class="form-group col-md-3 col-sm-3">
					<ul>
						<li><a href="{{url('/')}}">Inicio</a></li>
					</ul>
				</div>
				<div class="form-group col-md-5 col-sm-5">
					<div id="divMapFvT" style="background-color: #f5f5f5;border-radius: 5px;height: 250px; width: 100%;"></div>
				</div>
				<div class="form-group col-md-4 col-sm-4">
					<div><h3>Contacto</h3></div>
					<hr>
					<ul>
						<li>{{$tConfigurationFmMdl!=null ? $tConfigurationFmMdl->fullAddress : 'Urb. Santa Marta Mz. 2'}}</li>
						<li>{{$tConfigurationFmMdl!=null ? $tConfigurationFmMdl->contactEmail : 'contact@codideep.com'}}</li>
						<li>{{$tConfigurationFmMdl!=null ? $tConfigurationFmMdl->phoneContact : '+51 956 248 003'}}</li>
					</ul>
					<div>
						@if($tConfigurationFmMdl!=null && $tConfigurationFmMdl->linkedInUrl!='')
							<img src="{{asset('img/general/linkedIn.png')}}" alt="" class="generalIconSocialNetWork" onclick="window.open('{{$tConfigurationFmMdl->linkedInUrl}}', '_blank');">
						@endif
						@if($tConfigurationFmMdl!=null && $tConfigurationFmMdl->facebookUrl!='')
							<img src="{{asset('img/general/facebook.png')}}" alt="" class="generalIconSocialNetWork" onclick="window.open('{{$tConfigurationFmMdl->facebookUrl}}', '_blank');">
						@endif
						@if($tConfigurationFmMdl!=null && $tConfigurationFmMdl->youTubeUrl!='')
							<img src="{{asset('img/general/youTube.png')}}" alt="" class="generalIconSocialNetWork" onclick="window.open('{{$tConfigurationFmMdl->youTubeUrl}}', '_blank');">
						@endif
						@if($tConfigurationFmMdl!=null && $tConfigurationFmMdl->twitterUrl!='')
							<img src="{{asset('img/general/twitter.png')}}" alt="" class="generalIconSocialNetWork" onclick="window.open('{{$tConfigurationFmMdl->twitterUrl}}', '_blank');">
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>
	<div>
		<!-- <div class="paddingLayoutBody text-center">
			<b>Copyright © {{$tConfigurationFmMdl!=null ? $tConfigurationFmMdl->footerYear : '2024'}}-{{date('Y')}} <a href="{{$tConfigurationFmMdl!=null ? $tConfigurationFmMdl->footerUrl : 'https://eirl.codideep.com'}}" target="_blank">{{$tConfigurationFmMdl!=null ? $tConfigurationFmMdl->footerText : 'Codideep\'s developer'}}</a></b>. Todo los derechos reservados.
		</div> -->
		<div class="paddingLayoutBody text-center">
			<b>Copyright © {{$tConfigurationFmMdl!=null ? $tConfigurationFmMdl->footerYear : '2024'}}-{{date('Y')}} <a href="" target="_blank">Desarrollo Social - Gobierno Regional de Apurímac</a></b>. Todo los derechos reservados.
		</div>
	</div>
</footer>