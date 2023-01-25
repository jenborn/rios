@extends('todos.layout')
 
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>To Dos</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('todos.create') }}"> Create New ToDo</a>
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
            <th>Name</th>

            <th width="280px">Action</th>
        </tr>
        @foreach ($todos as $todo)
        <tr>
            <td>{{ $todo->name }}</td>

            <td>
                <form action="{{ route('todos.destroy',$todo->id) }}" method="POST">
   
                    <a class="btn btn-info" href="{{ route('todos.show',$todo->id) }}">Show</a>
    
                    <a class="btn btn-primary" href="{{ route('todos.edit',$todo->id) }}">Edit</a>
   
                    @csrf
                    @method('DELETE')
      
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>

      
@endsection
