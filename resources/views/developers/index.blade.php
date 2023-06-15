<x-layout title="Developers">
    <a href="{{ route('developers.create') }}">Create new developer</a>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($developers as $developer)
                <tr>
                    <td>
                        <a href="{{ route('developers.show', $developer->id) }}">
                            {{ $developer->name }}
                        </a>
                    <td>
                        <a href="{{ route('developers.edit', $developer->id) }}">Edit</a>
                        <form action="{{ route('developers.destroy', $developer->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-layout>