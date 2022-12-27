@extends('layouts.master')

@section('title','Setting Page')
@section('page-heading','Setting')

@section('main-section')
    
  <div class="row">
      <div class="col-6">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Add Setting Here</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            @if(session()->has('message'))
                <div class="alert alert-success" role="alert">
                    {{session('message')}}
                </div>
            @endif
           
            <form method='POST' action="{{route('setting')}}">
                    @csrf()
                    <div class="card-body">
                        <div class="form-group">
                            <label>School Name</label>                            
                            <input type='text' value="{{session('school')}}" name='school' class='form-control' required placeholder="Enter School Name">
                            @error('school')
                                <div class='alert alert-danger'>{{$message}}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label>Enter School Time</label>
                            <input type='text' value="{{session('school_time')}}" placeholder="Ex:- 07:00" class="form-control " required name='time'>
                            @error('time')
                                <div class='alert alert-danger'>{{$message}}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Username</label>
                            <input type='text' value="{{session('username')}}" class="form-control " required name='username'>
                            @error('username')
                                <div class='alert alert-danger'>{{$message}}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Update Password</label>
                            <input type='password' class="form-control"  name='password'>
                            @error('api')
                                <div class='alert alert-danger'>{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary btn-block">Add Now</button>
                    </div>
                </form>
        </div>
      </div>
  </div>
@endsection
