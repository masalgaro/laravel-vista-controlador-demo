@extends('layouts.app')
@section('title',$title)
@section('subtitle',$subtitle)
@section('content')
<div class="container">
	<div class="row">
		<div class="col-lg-4 ms-auto">
			<p class="lead">{{ $authorName }}</p>
		</div>
		<div class="col-lg-4 ms-auto">
			<p class="lead">{{ $authorAddress }}</p>
		</div>
		<div class="col-lg-4 ms-auto">
			<p class="lead">{{ $authorPhone }}</p>
		</div>
	</div>
</div>
@endsection

