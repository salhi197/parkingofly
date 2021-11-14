@extends('beautymail::templates.minty')

@section('content')
	@include('beautymail::templates.minty.contentStart')
		<tr>
			<td class="title">
				Bienvenue Chez Parkingo Fly 
			</td>
		</tr>
		<tr>
			<td width="100%" height="10"></td>
		</tr>
		<tr>
			<td class="paragraph">
				Vous avez Effectuer une réservation dans notre site parkingofly avec 
			</td>
		</tr>
		<tr>
			<td width="100%" height="25"></td>
		</tr>

		<tr>
			<td width="100%" height="25"></td>
		</tr>
		<tr>
			<td>
				@include('beautymail::templates.minty.button', ['text' => 'Télécharger le Ticket', 'link' => env('APP_URL').'/storage/app/'.$data['ticket']])
			</td>
		</tr>
		<tr>
			<td width="100%" height="25"></td>
		</tr>
	@include('beautymail::templates.minty.contentEnd')

@stop
