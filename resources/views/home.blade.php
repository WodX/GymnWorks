@extends('layouts.app')

@section('content')

  <div class="col-md-12 col-md-12 last-plans" data-aos="fade-in">
    <h1>Dashboard</h1>
    <hr>
    <a class="btn btn-primary" href="/posts/create">New Post</a><br><br>
    <h3>Your Posts</h3>
    <table class="table table-striped">
      <tr>
        <th>Title</th>
        <th>Actions</th>
      </tr>
      @foreach($posts as $post)
        <tr>
          <td><a class="nav-link" href="/posts/{{$post->id}}">{{$post->title}}</a></td>
          <td width="150px;">
            <div class="col-md-4 float-left"></div>
            <div class="col-md-4 float-left">
              <a class="" href="/posts/{{$post->id}}/edit" class=""><img width="20px" src="{{'../storage/_images/edit.png'}}"></a>
            </div>
            <div class="col-md-4 float-left">
              {{Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST', 'class' => ''])}}
              {{Form::hidden('_method', 'DELETE')}}
              {{Form::button('<img src='.'../storage/_images/delete.png'.' width=100%>' , ['type' => 'submit', 'class' => 'delete_button_icon'])}}
              {{Form::close()}}
           </div>
          </td>
        </tr>
      @endforeach
    </table>

    <hr>    
    @auth
      @if(auth()->user()->role == 'coach' || auth()->user()->role == 'admin')
        <a class="btn btn-primary" href="/plans/create">New Plan</a><br><br>
        <h3>Your Plans</h3>
        <table class="table table-striped">
          <tr>
              <th>Title</th>
              <th>Actions</th>
          </tr>
          @foreach($plans as $plan)
            <tr>
                <td><a class="nav-link" href="/plans/{{$plan->id}}">{{$plan->title}}</a></td>
                <td width="150px;">
                  <div class="col-md-4 float-left">
                    {{ Form::open(['route' => ['plans.duplicate', $plan->id], 'method' => 'POST', 'class' => ''])}}
                    {{Form::button('<img src='.'../storage/_images/plus.png'.' width=100%>' , ['type' => 'submit', 'class' => 'delete_button_icon'])}}
                    {{Form::close()}}
                  </div>
                  <div class="col-md-4 float-left">
                    <a href="/plans/{{$plan->id}}/edit" class=""><img width="20px" src="{{'../storage/_images/edit.png'}}"></a>
                  </div>
                  <div class="col-md-4 float-left">
                    {{Form::open(['action' => ['PlansController@destroy', $plan->id], 'method' => 'POST', 'class' => ''])}}
                    {{Form::hidden('_method', 'DELETE')}}
                    {{Form::button('<img src='.'../storage/_images/delete.png'.' width=100%>' , ['type' => 'submit', 'class' => 'delete_button_icon'])}}
                    {{Form::close()}}
                  </div>
                </td>
            </tr>
          @endforeach
        @endif
      @endauth
    </table>
  </div>

  @auth
    @if(auth()->user()->role == 'admin')
      <div class="col-md-12 col-md-12 last-plans" data-aos="fade-in">
        <h1>Admin Panel</h1>
        <hr>    
        <h3>All Users</h3>
        <table class="table table-striped">
          <tr>
              <th>Image</th>
              <th>Name</th>
              <th>Email</th>
              <th>Role</th>
              <th>Actions</th>
          </tr>
          @foreach($users as $user)
            <tr>
                <td><img class="dashimg" src="/storage/_profileimg/{{$user->image}}"></td>
                <td><a href="{{url('/user/'.$user->id.'/show')}}"> {{$user->name}}</a></td>
                <td>{{$user->email}}</td>
                <td>{{$user->role}}</td>
                <td width="150px;">
                  <div class="col-md-4 float-left">
                    <a href="/user/{{$user->id}}/edit"><img width="20px" src="{{'../storage/_images/edit.png'}}"></a>
                  </div>
                  <div class="col-md-4 float-left">
                    {{Form::open(['action' => ['UsersController@destroy', $user->id], 'method' => 'POST', 'class' => ''])}}
                    {{Form::hidden('_method', 'DELETE')}}
                    {{Form::button('<img src='.'../storage/_images/delete.png'.' width=100%>' , ['type' => 'submit', 'class' => 'delete_button_icon'])}}
                    {{Form::close()}}
                  </div>
                </td>
            </tr>
          @endforeach
        </table>
        <br>
        <hr>
        <br>
        @if($pendingCoach->count() >= 0)
        <h3>Pending Coach</h3>
        <table class="table table-striped">
          <tr>
              <th>Image</th>
              <th>Name</th>
              <th>Email</th>
              <th>Actions</th>
          </tr>
          @foreach($pendingCoach as $coach)
            <tr>
                <td><img class="dashimg" src="/storage/_profileimg/{{$coach->image}}"></td>
                <td><a href="{{url('/user/'.$coach->id.'/show')}}"> {{$coach->name}}</a></td>
                <td>{{$coach->email}}</td>
                <td width="150px;">
                  <form method="POST" action="/user/{{$coach->id}}/type">
                    <div class="col-md-4 float-left">
                      @csrf
                      @method('PATCH')
                        <button type="submit" name="type" value="accepted" class="delete_button_icon">
                            <img src="{{'../storage/_images/checked.png'}}" width=100%>
                        </button>
                    </div>
                    <div class="col-md-4 float-left">
                        <button type="submit" name="type" value="denided" class="delete_button_icon">
                                  <img src="{{'../storage/_images/delete.png'}}" width=100%>
                        </button>
                    </div>
                  </form>
                </td>
            </tr>
          @endforeach
        </table>
        @endif
      </div>

    @endif
  @endauth
  <br><br>
  <div class="text-right">
    <a href="/user/{{auth()->user()->id}}/edit" class="btn btn-primary">Editar Conta</a>&nbsp&nbsp&nbsp
    {{Form::open(['action' => ['UsersController@destroy', auth()->user()->id], 'method' => 'POST', 'class' => 'float-right'])}}
    {{Form::hidden('_method', 'DELETE')}}
    {{Form::button('Eliminar Conta' , ['type' => 'submit', 'class' => 'btn btn-danger'])}}
    {{Form::close()}}
  </div>

@endsection
