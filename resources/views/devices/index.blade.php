@extends('layouts.main')

@section('content')
    <section class="container">
        <h1>Dispositivos Conectados</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>IP</th>
                    <th>MAC</th>
                    <th>Fabricante</th>
                    <th>Última Vez Visto</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($devices as $device)
                    <tr>
                        <td>{{ $device->ip }}</td>
                        <td>{{ $device->mac ?? '-' }}</td>
                        <td>{{ $device->manufacturer ?? '-' }}</td>
                        <td>{{ $device->last_seen_time }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>
@endsection