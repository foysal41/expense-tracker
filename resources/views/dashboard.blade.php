@extends('layout.app')


@section('content')
    <!-- Main Content -->
    <div class="flex-1 p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Card 1: Total Balance -->
            <div class="bg-indigo-600 text-white p-6 rounded-lg shadow-lg flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-semibold">Current Balance</h3>
                    <p class="text-2xl font-bold">{{ $balance }} TK</p>
                </div>
                <div class="bg-indigo-800 p-4 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M10 2a2 2 0 012 2v12a2 2 0 01-2 2H4a2 2 0 01-2-2V4a2 2 0 012-2h6z" clip-rule="evenodd" />
                    </svg>
                </div>
            </div>

            <!-- Card 2: Total Expense -->
            <div class="bg-green-600 text-white p-6 rounded-lg shadow-lg flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-semibold">Total Expense</h3>
                    <p class="text-2xl font-bold">{{ $totalExpense }} TK</p>
                </div>
                <div class="bg-green-800 p-4 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M16 4a2 2 0 10-4 0v10a2 2 0 104 0V4zM8 4a2 2 0 10-4 0v10a2 2 0 104 0V4z" clip-rule="evenodd" />
                    </svg>
                </div>
            </div>

            <!-- Card 3: Liabilities -->
            <div class="bg-blue-600 text-white p-6 rounded-lg shadow-lg flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-semibold">Liabilities</h3>
                    <p class="text-2xl font-bold">{{ $totalLiabilitie }} TK</p>
                </div>
                <div class="bg-blue-800 p-4 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M10 18l6-6H4l6 6z" clip-rule="evenodd" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Welcome Message -->
        <div class="mt-6 text-center">
            <p class="text-lg text-gray-600">Welcome to your dashboard! Here you can manage all the activities.</p>
        </div>
    </div>


<!-- Filter Form -->
<div class="mb-4 flex gap-3">
    <select id="filterMonth" class="border px-8 py-2 rounded">
        <option value="">Select Month</option>
        @for ($i = 1; $i <= 12; $i++)
            <option value="{{ $i }}">{{ DateTime::createFromFormat('!m', $i)->format('F') }}</option>
        @endfor
    </select>

    <select id="filterYear" class="border px-8 py-2 rounded">
        <option value="">Select Year</option>
        @for ($year = 2022; $year <= now()->year; $year++)
            <option value="{{ $year }}">{{ $year }}</option>
        @endfor
    </select>

    <button id="filterBtn" class="bg-blue-600 text-white px-4 py-2 rounded">Filter</button>
</div>

<!-- Filtered Result will appear here -->
<div id="resultArea">
    <p>Select filter to see result</p>
</div>





@endsection
@push('scripts')  <!-- Push script into the 'scripts' stack -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $('#filterBtn').on('click', function () {
        let month = $('#filterMonth').val();
        let year = $('#filterYear').val();

        $.ajax({
            url: "{{ route('filter.report') }}", // ✅ Blade variable
            method: "GET",
            data: {
                month: month,
                year: year
            },
            success: function (response) {
                let html = '';

                // Income Table
                html += '<h3 class="text-lg font-semibold mt-4">Income</h3>';
                html += '<table class="w-full border mb-4 text-sm">';
                html += '<tr class="bg-gray-100"><th class="py-2 px-3 text-left">Date</th><th class="py-2 px-3 text-right">Amount</th></tr>';
                response.income.forEach(item => {
                    html += `<tr>
                        <td class="py-1 px-3">${item.income_date}</td>
                        <td class="py-1 px-3 text-green-600 text-right">+ ${item.income_amount} Tk</td>
                    </tr>`;
                });
                html += '</table>';

                // Expense Table
                html += '<h3 class="text-lg font-semibold mt-4">Expense</h3>';
                html += '<table class="w-full border mb-4 text-sm">';
                html += '<tr class="bg-gray-100"><th class="py-2 px-3 text-left">Date</th><th class="py-2 px-3 text-right">Amount</th></tr>';
                response.expense.forEach(item => {
                    html += `<tr>
                        <td class="py-1 px-3">${item.expense_date}</td>
                        <td class="py-1 px-3 text-red-600 text-right">- ${item.expense_amount} Tk</td>
                    </tr>`;
                });
                html += '</table>';

                // Liability Table
                html += '<h3 class="text-lg font-semibold mt-4">Liability</h3>';
                html += '<table class="w-full border text-sm">';
                html += '<tr class="bg-gray-100"><th class="py-2 px-3 text-left">Date</th><th class="py-2 px-3 text-right">Amount</th></tr>';
                response.liability.forEach(item => {
                    html += `<tr>
                        <td class="py-1 px-3">${item.liabilities_date}</td>
                        <td class="py-1 px-3 text-yellow-600 text-right">${item.liabilities_amount} Tk</td>
                    </tr>`;
                });
                html += '</table>';

                $('#resultArea').html(html);
            }
        });
    });
</script>

@endpush



