@extends('layouts.app_nakes')

@section('title', 'Data Wali')

@section('content')
            <!-- Table -->
            @include('pages.nakes.table_wali')

            <!-- Pagination -->
            @if($dataWali->hasPages())
            <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
                {{ $dataWali->appends(['search' => request('search')])->links() }}
            </div>
            @endif
        </div>
    </div>
</div>

<!-- Modal -->
@include('pages.nakes.modal_wali')
@endsection
