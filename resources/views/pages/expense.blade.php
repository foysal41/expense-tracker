@extends('layout.app')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Expense</h1>

    <div class="max-w-md mx-auto bg-white p-6 rounded shadow">
        <form method="POST" action="{{ route('expense.store') }}">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2" for="name">Income Name</label>
                <input type="text" name="expense_name" id="name" class="w-full border rounded px-3 py-2" placeholder="Enter Name">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2" for="amount">Expenses Amount</label>
                <input type="number" name="expense_amount" id="amount" class="w-full border rounded px-3 py-2" placeholder="Enter amount">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2" for="date">Date</label>
                <input type="date" name="expense_date" id="date" class="w-full border rounded px-3 py-2">
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Add Expenses</button>
        </form>
    </div>



    <div class="mt-8 max-w-md mx-auto bg-white p-4 rounded shadow">
        <table class="w-full text-left">
            <thead>
                <tr>
                    <th class="py-2 px-3 border-b">Date</th>
                    <th class="py-2 px-3 border-b">Amount</th>
                </tr>
            </thead>
            <tbody>
                @foreach($expenses as $expense)
                    <tr>
                        <td class="py-2 px-3">{{ $expense->expense_date}}</td>
                        <td class="py-2 px-3 text-red-600 font-semibold">+ ${{ $expense->expense_amount }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>


@endsection
