<x-app-layout>
    @push('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @endpush
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
               
                    <div class="container py-5">
                
                    
                        <div class="row">

                            <x-charts.chart-device-status :device-status="$deviceStatus" />

                            <x-charts.chart-device-manufacturer :devices-by-manufacturer="$devicesByManufacturer" />

                            <x-charts.chart-device-day :devices-by-day-data="$devicesByDay" />
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>

