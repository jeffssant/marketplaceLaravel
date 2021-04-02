@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-12">
            <a href="{{route('admin.notifications.read.all')}}" class="btn btn-lg btn-success">Marcar todas como lidas!</a>
            <hr>
        </div>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Notificação</th>
                <th>Criado em</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @forelse($Notifications as $n)                
                <tr class="@if ($n->read_at) text-muted @endif">
                    <td>{{$n->data['message']}}</td>
                    <td>{{$n->created_at->locale('pt')->diffForHumans()}}</td>
                    <td>
                        <div class="btn-group">
                            @if ($n->read_at)
                                Nenhuma ação.
                            @else
                                <a href="{{route('admin.notifications.read', ['notification' => $n->id])}}" class="btn btn-sm btn-primary ">Marcar como lida</a>
                            @endif                            
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">
                        <div class="alert alert-warning">Nenhuma notificação encontrada!</div>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection