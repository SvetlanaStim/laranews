@extends('layout.app')
@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Show Post</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('articles.index') }}"> Back</a>
		<br>
		<a class="btn btn-primary" href="{{ route('articles.edit',$article->id) }}">Edit</a>
            </div>
        </div>
    </div>

    <div class="row">

        <h3>{{ $article->header }}</h3>


        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                {{ $article->article }}
            </div>
        </div>
	<div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
		<img src="{{ $article->image }}"/>
            </div>
        </div>

    </div>
@endsection
