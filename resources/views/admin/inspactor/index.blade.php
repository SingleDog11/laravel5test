@extends('layouts.app')
@section('content')
<div class="container">  
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">稽查员管理</div>
                <div class="panel-body">
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            {!! implode('<br>', $errors->all()) !!}
                        </div>
                    @endif

                    <a href="{{ url('admin/inspactor/create') }}" class="btn btn-lg btn-primary">新增</a>

                    @foreach ($inspactors as $inspactor)
                        <hr>
                        <div class="inspactor">
                            <h4>{{ $inspactor->name }}</h4>
                        </div>
                        <a href="{{ url('admin/inspactor/'.$inspactor->id.'/edit') }}" class="btn btn-success">编辑</a>
                        <form action="{{ url('admin/inspactor/'.$inspactor->id) }}" method="POST" style="display: inline;">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger">删除</button>
                        </form>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</div>  
@endsection