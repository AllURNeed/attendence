@extends('layouts.master')

@section('title','Add Api Details ')
@section('page-heading','Add Api Page')

@section('main-section')
    
  <div class="row">
      <div class="col-12">
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
           
            <table class="table" id="table_id">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Sr.</th>
                        <th scope="col">Type</th>
                        <th scope="col">Api</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php 
                        $i=1;
                    @endphp
                   @foreach($data as $k=>$v)
                    <tr>
                            <th scope="row">{{$i}}</th>
                            <td>{{$v->api_type}}</td>
                            <td>{{urldecode($v->api)}}</td>
                            <td>
                                <?php 
                                        if($v->status==0){
                                            ?>
                                                <a href="{{URL::to('/status/'.$v->id.'/1')}}" class="btn btn-sm btn-danger">Inactive</a>
                                            <?php
                                        }else{
                                            ?>
                                                <a href="{{URL::to('/status/'.$v->id.'/0')}}" class="btn btn-sm btn-success">Active</a>
                                            <?php
                                        }
                                    ?>
                            </td>
                            <td>
                                <a href="{{URL::to('/delete/'.$v->id)}}" class="btn btn-sm btn-danger">Delete</a>
                            </td>
                            
                        </tr>

                        <?php $i++;?>
                   @endforeach
                </tbody>
            </table>
        </div>
      </div>
  </div>
@endsection
