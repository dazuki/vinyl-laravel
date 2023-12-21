@php
    $char = '';
@endphp
<table>
    <thead>
        <tr>
            <th style="text-align: left; font-size: 16pt; text-decoration: underline;">ARTISTER</th>
            <th style="text-align: left; font-size: 16pt; text-decoration: underline;">VINYLER</th>
            <th style="text-align: left; font-size: 16pt; text-decoration: underline;">VINYLER PER ARTIST</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td style="text-align: left; font-size: 14pt;">{{ $collections->count() }} st</td>
            <td style="text-align: left; font-size: 14pt;">{{ $collections_records }} st</td>
            <td style="text-align: left; font-size: 14pt;"></td>
        </tr>
        @foreach ($collections as $collection)
            @if (empty($char) || $char != mb_substr($collection->name, 0, 1))
                <tr>
                    <td style="text-align: left; font-size: 16pt;"></td>
                    <td style="text-align: left; font-size: 12pt;"></td>
                    <td style="text-align: left; font-size: 12pt;"></td>
                </tr>
                <tr>
                    <th style="text-align: left; font-size: 28pt; font-weight: bold; text-decoration: underline;">
                        {{ mb_substr($collection->name, 0, 1) }}</th>
                    <td></td>
                    <td></td>
                </tr>
            @endif
            @php
                $char = mb_substr($collection->name, 0, 1);
            @endphp
            @foreach ($collection->records as $record)
                @if ($loop->first)
                    <tr>
                        <td style="text-align: left; font-size: 16pt;">{{ $collection->name }}
                        </td>
                        <td style="text-align: left; font-size: 12pt;">{{ $record->record_name }}</td>
                        <td style="text-align: left; font-size: 14pt;">{{ $loop->count }} st
                        </td>
                    </tr>
                @else
                    <tr>
                        <td style="text-align: left; font-size: 16pt;"></td>
                        <td style="text-align: left; font-size: 12pt;">{{ $record->record_name }}</td>
                        <td style="text-align: left; font-size: 12pt;"></td>
                    </tr>
                @endif
            @endforeach
        @endforeach
    </tbody>
</table>
