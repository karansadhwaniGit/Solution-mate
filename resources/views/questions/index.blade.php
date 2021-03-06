@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="d-flex justify-content-end mb-2">
                    <a href="{{ route('questions.create') }}" class="btn btn-outline-primary">Ask a Question!</a>
                </div>

                <div class="card">
                    <div class="card-header">All Questions</div>
                    @foreach ($questions as $question)
                        <div class="card-body">
                            <div class="media">
                                <div class="mr-4 statistics">
                                    <div class="text-center mb-3">
                                        <strong class="d-block">{{$question->votes_count}}</strong> Votes
                                    </div>
                                    <div class="text-center mb-3 answers {{$question->answer_style}}">
                                        <strong class="d-block">{{$question->answers_count}}</strong>Answers
                                    </div>
                                    <div class="views text-center mb-3">
                                        <strong class="d-block">{{$question->views_count}}</strong> Views
                                    </div>

                                </div>
                                <div class="media-body">
                                    <div class="d-flex">
                                        <div class="d-flex">
                                            <h4><a href="{{$question->url}}">{{$question->title}}</a></h4>
                                            &nbsp;
                                            &nbsp;
                                            @if($question->was_updated)
                                             <div class="bg-warning text-dark py-1 px-2 rounded-pill mb-3">Updated</div>
                                            @endif
                                        </div>
                                        <div class="d-flex ml-auto">
                                            <a href="{{route('questions.edit',$question->id)}}" style="height:30px" class="btn btn-sm btn-outline-info mb-1">Edit</a>
                                            <div class="ml-2">
                                                <form action="{{route('questions.destroy',$question->id)}}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete')">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <p>
                                        Asked By: <a href="#">{{$question->owner->name}}</a>
                                        <span class="text-muted">{{$question->created_date}}</span>
                                    </p>
                                    <p>{!! Str::limit($question->body,255) !!}...</p>
                                </div>
                            </div>
                        </div>
                        <hr>
                    @endforeach
                    <div class="card-footer">
                        {{ $questions->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
