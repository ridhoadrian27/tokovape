@extends('layouts.member.layout')
@section('header', 'Dashboard')

@section('content')
  <table class="table table-bordered">
			<tbody><tr>
				<th colspan="2">Detail Member</th>
			</tr>
			<tr>
				<td width="15%">Nama</td>
				<td><b>{{ Auth::guard('member')->user()->name }}</b></td>
			</tr>
			<tr>
				<td>Email</td>
				<td><b>{{ Auth::guard('member')->user()->email }}</b></td>
			</tr>	
		</tbody>
  </table>
@endsection
