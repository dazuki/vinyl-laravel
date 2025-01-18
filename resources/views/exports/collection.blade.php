@php
    $char = "";
@endphp
<table style="border-collapse: collapse;">
    <thead>
        <tr>
            <th style="text-align: left; font-size: 16pt;">{{ $collections->count() }} ARTISTER</th>
            <th style="text-align: left; font-size: 16pt;">{{ $collections_records }} VINYLER</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($collections as $collection)
            @if (empty($char) || $char != mb_substr($collection->name, 0, 1))
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td style="text-align: left; font-size: 36pt; font-weight: bold; border-bottom: 1px solid #000;">
                        {{ mb_substr($collection->name, 0, 1) }}</td>
                    <td style="border-bottom: 1px solid #000;">&nbsp;</td>
                </tr>
            @endif
            @php
                $char = mb_substr($collection->name, 0, 1);
            @endphp
            @foreach ($collection->records as $record)
                @if ($loop->first)
                    <tr>
                        <td style="text-align: left; font-size: 16pt; font-weight: bold;">{{ trim($collection->name) }}
                        </td>
                        <td style="text-align: left; font-size: 12pt; white-space: nowrap;">
                            {{ trim(mb_strtoupper($record->record_name)) }}
                        </td>
                    </tr>
                    @if ($loop->count <= 1)
                        <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                    @endif
                @elseif ($loop->last)
                    <tr>
                        <td style="text-align: left; font-size: 16pt;"></td>
                        <td style="text-align: left; font-size: 12pt;">{{ trim(mb_strtoupper($record->record_name)) }}
                        </td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                @else
                    <tr>
                        <td style="text-align: left; font-size: 16pt;">&nbsp;</td>
                        <td style="text-align: left; font-size: 12pt;">{{ trim(mb_strtoupper($record->record_name)) }}
                        </td>
                    </tr>
                @endif
            @endforeach
        @endforeach
    </tbody>
</table>
