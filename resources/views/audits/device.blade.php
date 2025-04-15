<x-app-layout>
    <div class="container my-5">
        <h1 class="mb-4"><i class="fa-solid fa-user-secret"></i> Auditoria de Dispositivos</h1>
    
        <div class="table-responsive shadow-sm rounded">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th scope="col"><i class="fa-regular fa-calendar"></i> Data</th>
                        <th scope="col"><i class="fa-solid fa-gear"></i> Ação</th>
                        <th scope="col"><i class="fa-solid fa-globe"></i> IP</th>
                        <th scope="col"><i class="fa-solid fa-lock"></i> MAC</th>
                        <th scope="col"><i class="fa-solid fa-tag"></i> Fabricante</th>
                        <th scope="col"><i class="fa-solid fa-pen"></i> Alterações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($audits as $audit)
                        <tr>
                            <td>{{ $audit->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                <span class="badge 
                                    @if($audit->event === 'created') bg-success 
                                    @elseif($audit->event === 'updated') bg-warning text-dark
                                    @elseif($audit->event === 'deleted') bg-danger
                                    @else bg-secondary 
                                    @endif">
                                    {{ ucfirst($audit->event) }}
                                </span>
                            </td>
                            <td>{{ $audit->auditable->ip ?? '-' }}</td>
                            <td>{{ $audit->auditable->mac ?? '-' }}</td>
                            <td>{{ $audit->auditable->manufacturer ?? '-' }}</td>
                            <td>
                                @php $changes = $audit->getModified(); @endphp
                                @if($changes)
                                    <ul class="mb-0 list-unstyled">
                                        @foreach($changes as $attribute => $change)
                                            <li>
                                                <strong>{{ ucfirst($attribute) }}</strong>: 
                                                <span class="text-muted">{{ $change['old'] ?? '-' }}</span> 
                                                <i class="bi bi-arrow-right mx-1"></i> 
                                                <span class="text-dark fw-bold">{{ $change['new'] ?? '-' }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <span class="text-muted">Sem alterações</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">Nenhuma auditoria registrada.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    
        <div class="mt-4">
            {{ $audits->links() }}
        </div>
    </div>
</x-app-layout>
