@extends('layout.app')
@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>ITSTEP MAD LARAVEL PROJECT</h2>
            </div>
            <div class="pull-right">
                @if (isset($articles))
                <a class="btn btn-success" href="{{ route('articles.create') }}"> Create New Product</a>
                @endif
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>Title</th>
            <th>Description</th>
        </tr>
        @if (isset($articles))
        @foreach ($articles as $post)
        <tr>
            <td>{{ $post->header }}</td>
            <td>{{ $post->short_text }}</td>
            <td>
                <a class="btn btn-info" href="{{ route('articles.show',$post->id) }}">Show</a>
                <a class="btn btn-primary" href="{{ route('articles.edit',$post->id) }}">Edit</a>
                <form action="{{ route('articles.destroy',$post->id) }}" method="POST">

                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
        @else
            <p>Нет переменнной</p>
        @endif
    </table>

@endsection
