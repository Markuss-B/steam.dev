<x-app-layout title="Purchase history" :basiclayout='true'>
    <div>
        <p class="text-gray-600">Your purchase history</p>
        <table class="table-auto w-full">
            <thead>
                <tr>
                    <th class="px-4 py-2">Date</th>
                    <th class="px-4 py-2">Game</th>
                    <th class="px-4 py-2">Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($games as $game)
                <tr>
                    <td class="border px-4 py-2">{{ $game->pivot->acquisition_date }}</td>
                    <td class="border px-4 py-2">{{ $game->name }}</td>
                    <td class="border px-4 py-2">{{ $game->pivot->purchase_cost / 100 }}€</td>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>