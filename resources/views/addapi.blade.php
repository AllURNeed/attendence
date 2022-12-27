@extends('layouts.master')

@section('title','Add Api Details ')
@section('page-heading','Add Api Page')

@section('main-section')
    
  <div class="row">
      <div class="col-6">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Add Api details</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            @if(session()->has('message'))
                <div class="alert alert-success" role="alert">
                    {{session('message')}}
                </div>
            @endif
           
            <form method='POST' action="{{route('add_api')}}">
                    @csrf()
                    <div class="card-body">
                    <div class="form-group">
                        <label>Api Type</label>
                        
                        <select class="form-control select2 " name="type" required>
                            <option value=''>Select</option>
                            <option value='in'>In Api</option>
                            <option value='Out'>Out Api</option>
                            <option value='Late'>Late Api</option>
                            <option value='Absent'>Absent Api</option>
                            <option value='Other'>Other</option>
                        </select>
                        @error('type')
                            <div class='alert alert-danger'>{{$message}}</div>
                        @enderror
                    </div>
                    

                    <div class="form-group">
                        <label>Enter Api {#var#}</label>
                        <input type='text' placeholder="Ex:- Your OTP is {#var#}" class="form-control " required name='api'>
                        @error('api')
                            <div class='alert alert-danger'>{{$message}}</div>
                        @enderror
                    </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary btn-block">Add Now</button>
                    </div>
                </form>
        </div>
      </div>
  </div>
@endsection
