<x-layouts.app>
    <x-includes.page_header>Content</x-includes.page_header>

    @foreach ($collections as $collection)
    <table class="table">
        <thead>
            <tr>
                <th scope="col">{{ $collection['name'] }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($collection->posts as $content)
            <tr>
                <td><a href="/edit/{{$content->id}}">{{ $content->title }}</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endforeach

</x-layouts.app>