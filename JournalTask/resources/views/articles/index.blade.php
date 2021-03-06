@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between">
      <h2>List of Articles</h2>
      <div>
        <a href="{{ route('articles.create') }}" class="btn btn-primary btn-sm">Create an Article</a>
        @if (auth()->user()->is_admin === 1)
        <a href="{{ route('articles.notApproved') }}" class="btn btn-primary btn-sm">Not Apptoved Articles</a>
        @endif
      </div>
    </div>
      @if ($articles->count() > 0)
        <table class="table table-stripped table-hover mt-4">
          <thead>
            <tr>
              <th>Id</th>
              <th>Title</th>
              <th>decription</th>
              <th>Name of The Author</th>
              @if (auth()->user()->is_admin === 1)
              <th>Action</th>
              @endif
            </tr>
          </thead>
  
        @foreach ($articles as $index=>$article)
          <tbody>
            <tr>
              <td>{{ $index + 1}}</td>
              <td>{{$article->title}}</td>
              <td>{{Str::limit(strip_tags($article->description), 200)}}</td>
              <td>{{ $article->user->name }}</td>
              @if (auth()->user()->is_admin === 1)
              <td>
                <form action="{{ route('articles.destroy', $article->id) }}" method="POST">
                  @csrf
                  @method("DELETE")
  
                  <button type="submit" class="btn btn-danger delete btn-sm"><i class="fa fa-trash"></i> Delete</button>
                </form><!-- end of form -->
              </td>
              @endif
            </tr>
          </tbody>
        @endforeach
        </table>
      @else
        <h4 class="mt-4">No Articles yet.</h4>
      @endif
@endsection