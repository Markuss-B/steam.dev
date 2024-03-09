<x-app-layout title="Balance" :basiclayout='true'>
    <div>
        <h1 class="text-2xl font-semibold text-gray-900">Balance</h1>
        <p class="text-gray-600">Your current balance is <span class="font-semibold">{{ Auth::user()->balance / 100 }}€</span></p>
        <p class="text-gray-600">Add money to your balance</p>
        <form action="{{ route('balance.add') }}" method="post">
            @csrf
            <x-primary-button type="submit" name="amount" value="500">Add 5€</x-primary-button>
            <x-primary-button type="submit" name="amount" value="1000">Add 10€</x-primary-button>
            <x-primary-button type="submit" name="amount" value="1500">Add 15€</x-primary-button>
            <x-primary-button type="submit" name="amount" value="2000">Add 20€</x-primary-button>
            <x-primary-button type="submit" name="amount" value="2000">Add 25€</x-primary-button>
            <x-primary-button type="submit" name="amount" value="5000">Add 50€</x-primary-button>
            <x-primary-button type="submit" name="amount" value="10000">Add 100€</x-primary-button>
        </form>
    </div>
</x-app-layout>