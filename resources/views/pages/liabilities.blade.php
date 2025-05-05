@extends('layout.app')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Liabilities</h1>

    {{-- Loan Input Form --}}
    <div class="max-w-md mx-auto bg-white p-6 rounded shadow">
        <form action="{{ route("liabilitie.store") }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2" for="person">Person/Source</label>
                <input type="text" name="liabilities_name" id="person" class="w-full border rounded px-3 py-2" placeholder="Ex: Rahim, Bank">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2" for="amount">Amount</label>
                <input type="number" name="liabilities_amount" id="amount" class="w-full border rounded px-3 py-2" placeholder="Ex: 1000">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2" for="date">Date</label>
                <input type="date" name="liabilities_date" id="date" class="w-full border rounded px-3 py-2">
            </div>
            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Add Liability</button>
        </form>
    </div>



    <div class="mt-8 max-w-md mx-auto bg-white p-4 rounded shadow">
        <table class="w-full text-left">
            <thead>
                <tr>
                    <th class="py-2 px-3 border-b">Date</th>
                    <th class="py-2 px-3 border-b">From</th>
                    <th class="py-2 px-3 border-b">Amount</th>
                    <th class="py-2 px-3 border-b">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($liabilities as $liability)
                    <tr>
                        <td class="py-2 px-3">{{ $liability->liabilities_date }}</td>
                        <td class="py-2 px-3">{{ $liability->liabilities_name }}</td>
                        <td class="py-2 px-3 text-red-600 font-semibold">- ${{ $liability->liabilities_amount }}</td>
                        <td class="py-2 px-3">
                            <button class="delete-btn bg-red-500 text-white px-4 py-2 rounded" data-id="{{ $liability->id }}">
                                Delete
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>

        </table>
    </div>
@endsection




@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).on('click', '.delete-btn', function () {
        var liabilityId = $(this).data('id');

        if (confirm("Are you sure you want to delete this liability?")) {
            $.ajax({
                url: "/liabilities/delete/" + liabilityId,
                method: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}' // CSRF token
                },
                success: function(response) {
                    if(response.success) {
                        $("button[data-id='" + liabilityId + "']").closest('tr').remove();
                        alert("Liability deleted successfully!");
                    } else {
                        alert("Failed to delete liability.");
                    }
                },
                error: function() {
                    alert("Something went wrong!");
                }
            });
        }
    });
</script>

@endpush
