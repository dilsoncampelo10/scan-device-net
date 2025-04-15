
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dispositivos Conectados') }}
        </h2>
    </x-slot>
    <section class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3">
                <i class="fa-solid fa-house-signal"></i> Dispositivos Conectados
            </h1>
            <span class="text-muted">{{ now()->format('d/m/Y H:i') }}</span>
        </div>
    
        @if($devices->isEmpty())
            <div class="alert alert-info">Nenhum dispositivo encontrado.</div>
        @else
            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Tipo</th>
                            <th>IP</th>
                            <th>MAC</th>
                            <th>Fabricante</th>
                            <th>Última vez visto</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($devices as $device)
                            <tr>
                                <td class="text-center" title="{{ $device->device_icon[1] }}"><i class="{{ $device->device_icon[0] }}"></i></td>
                                <td><code>{{ $device->ip }}</code></td>
                                <td>{{ $device->mac ?? 'Desconhecido' }}</td>
                                <td>{{ $device->manufacturer ?? 'Desconhecido' }}</td>
                                <td>{{ \Carbon\Carbon::parse($device->last_seen_time)->format('d/m/Y H:i') }}</td>
                                <td>{!! $device->status_badge !!}</td>
                            
    
    
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </section>
</x-app-layout>
