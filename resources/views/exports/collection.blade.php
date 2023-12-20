@php
    $char = '';
@endphp
<table>
    <thead>
        <tr>
            <th style="text-align: left; font-size: 16px; font-weight: bold;">ARTIST</th>
            <th style="text-align: left; font-size: 16px; font-weight: bold;">VINYLER</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($collections as $collection)
            @if (empty($char) || $char != mb_substr($collection->name, 0, 1))
                <tr>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <th style="text-align: left; font-size: 24px;">{{ mb_substr($collection->name, 0, 1) }}</th>
                    <th></th>
                </tr>
            @endif
            @php
                $char = mb_substr($collection->name, 0, 1);
            @endphp
            @foreach ($collection->records as $record)
                @if ($loop->first)
                    <tr>
                        <td style="text-align: left; font-size: 14px;">{{ $collection->name }}</td>
                        <td style="text-align: left;">{{ $record->record_name }}</td>
                    </tr>
                @else
                    <tr>
                        <td style="text-align: left;"></td>
                        <td style="text-align: left;">{{ $record->record_name }}</td>
                    </tr>
                @endif
            @endforeach
        @endforeach
    </tbody>
</table>
