@extends('layouts.app')

@section('content')
<div class="container">  
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">职员管理</div>
                <div class="panel-body">
                    <!--@if (count($errors) > 0)
                        <div class="alert alert-danger">
                            {!! implode('<br>', $errors->all()) !!}
                        </div>
                    @endif-->

                    <a href="{{ url('admin/staff/create') }}" class="btn btn-lg btn-primary">新增</a>

                    <!--@foreach ($staffs as $staff)
                        <hr>
                        <div class="staff">
                            <h4>{{ $staff->name }}</h4>
                        </div>
                        <a href="{{ url('admin/staff/'.$staff->id.'/edit') }}" class="btn btn-success">编辑</a>
                        <form action="{{ url('admin/staff/'.$staff->id) }}" method="POST" style="display: inline;">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger">删除</button>
                        </form>
                    @endforeach-->

                </div>
            </div>
        </div>
    </div>
</div>  
@endsection