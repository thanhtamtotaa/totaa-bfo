<div>
    <!-- Filters and Add Buttons -->
    @include('totaa-bfo::livewire.support.filters')

    <!-- Incluce các modal -->
    @include('totaa-bfo::livewire.modal.add_edit_modal')
    @include('totaa-bfo::livewire.modal.set_bfo_team_modal')
    @include('totaa-bfo::livewire.modal.set_bfo_info_modal')

    <!-- Scripts -->
    @push('livewires')
        @include('totaa-bfo::livewire.support.script')
    @endpush

    <!-- Style -->
    @push('styles')
        @include('totaa-bfo::livewire.support.style')
    @endpush
</div>
