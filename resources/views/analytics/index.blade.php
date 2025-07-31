@extends('filament::layouts.app')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    <x-filament::card>
        <x-filament::stat heading="Total Number Of Indicators" :value="$totalIndi" />
    </x-filament::card>
    <x-filament::card>
        <x-filament::stat heading="Total Number of Intervention Achieved" :value="$totalI" />
    </x-filament::card>
    <x-filament::card>
        <x-filament::stat heading="Total Number Of Unique Interventions" :value="$totalUI" />
    </x-filament::card>
    <x-filament::card>
        <x-filament::stat heading="Total Intervention Cost" :value="'$' . number_format($totalInterventionCost)" />
    </x-filament::card>
    <x-filament::card>
        <x-filament::stat heading="Total Number Of Communities Reached" :value="$comm" />
    </x-filament::card>
    <x-filament::card>
        <x-filament::stat heading="Total Number Of Households Reached" :value="number_format($totalHouseholds)" />
    </x-filament::card>
    <x-filament::card>
        <x-filament::stat heading="Total Number Of Beneficiaries Reached" :value="number_format($totalBeneficiaries)" />
    </x-filament::card>
    <x-filament::card>
        <x-filament::stat heading="Total Number Of People Trained" :value="number_format($totalTrained)" />
        <div class="mt-2">
            <span class="badge bg-primary">Male: {{ number_format($maleTrained) }}</span>
            <span class="badge bg-pink">Female: {{ number_format($femaleTrained) }}</span>
        </div>
    </x-filament::card>
    <!-- Add more cards as needed -->
</div>
<!-- You can add Filament widgets or custom charts below -->
@endsection