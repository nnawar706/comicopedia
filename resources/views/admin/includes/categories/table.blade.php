<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">No of Items</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $item)
            <tr>
                <th scope="row">{{ $item['order'] }}</th>
                <td>{{ $item['name'] }}</td>
                <td>{{ $item['num_items'] }}</td>
                {{-- <td></td> --}}
            </tr>
        @endforeach
    </tbody>
</table>
