@extends('layouts.app')

@section('content')
<div class="container">  
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">你是管理员</div>

                <div class="panel-body">

                    <a href="{{ url('admin/staff') }}" class="btn btn-lg btn-success col-xs-12">管理职员</a>

                </div>
                <div class="panel-body">

                    <a href="{{ url('admin/inspactor') }}" class="btn btn-lg btn-success col-xs-12">管理稽查员</a>

                </div>
                <div class="panel-body">

                    <a href="{{ url('admin/electrician') }}" class="btn btn-lg btn-success col-xs-12">管理电工</a>

                </div>
                
            </div>
        </div>
    </div>
</div>  
@endsection