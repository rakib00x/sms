<table class="table table-striped" id="table-2">
    <thead>
    <th>Date</th>
    <th>Mobile</th>
    <th>Message</th>
    <th>Sent by</th>
    </thead>

    <tbody>
    @foreach($groups as $group)
        <tr>
            <td>{{ $group->created_at }}</td>
            <td>{{ $group->mobile }}</td>
            <td>{{ $group->content }}</td>
            <td>{{ $group->device }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
