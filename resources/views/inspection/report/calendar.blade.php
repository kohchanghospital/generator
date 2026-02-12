<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="utf-8">
    <style>
        @page {
            size: A4 portrait;
            margin: 15mm;
        }

        @font-face {
            font-family: 'THSarabun';
            src: url("{{ storage_path('fonts/THSarabunIT.ttf') }}") format('truetype');
            font-weight: normal;
            font-style: normal;
        }

        @font-face {
            font-family: 'THSarabun';
            src: url("{{ storage_path('fonts/THSarabunIT-Bold.ttf') }}") format('truetype');
            font-weight: bold;
            font-style: normal;
        }

        @font-face {
            font-family: 'THSarabun';
            src: url("{{ storage_path('fonts/THSarabunIT-Italic.ttf') }}") format('truetype');
            font-weight: normal;
            font-style: italic;
        }

        @font-face {
            font-family: 'THSarabun';
            src: url("{{ storage_path('fonts/THSarabunIT-BoldItalic.ttf') }}") format('truetype');
            font-weight: bold;
            font-style: italic;
        }

        body {
            font-family: 'THSarabun', sans-serif;
            font-size: 16pt;
        }

        h2 {
            text-align: center;
            margin-bottom: 10px;
            font-size: 18pt;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        tbody tr {
            page-break-inside: avoid;
        }

        th,
        td {
            border: 1px solid #000;
            height: 85px;
            vertical-align: top;
            padding: 4px;
            font-size: 14pt;
        }

        th {
            background: #f0f0f0;
            text-align: center;
        }

        .date {
            font-weight: bold;
            text-align: right;
        }

        .event {
            background: #198754;
            color: #fff;
            margin-top: 2px;
            padding: 2px 4px;
            font-size: 12pt;
            border-radius: 3px;
            line-height: 1.2;
        }
    </style>
</head>

<body>

    <h2>ปฏิทินการตรวจเช็คเครื่องปั่นไฟ
        {{ $start->addYears(543)->translatedFormat('F Y') }}
    </h2>

    <table>
        <thead>
            <tr>
                <th>อา.</th>
                <th>จ.</th>
                <th>อ.</th>
                <th>พ.</th>
                <th>พฤ.</th>
                <th>ศ.</th>
                <th>ส.</th>
            </tr>
        </thead>
        <tbody>
            @php
            $day = $calendarStart->copy();
            @endphp

            @while ($day <= $end)
                <tr>
                @for ($i=0;$i<7;$i++)
                    <td>
                    @if ($day->month == $start->month)
                    <div class="date">{{ $day->day }}</div>

                    @foreach ($inspections[$day->day] ?? [] as $item)
                    <div class="event">
                        {{ $item->inspection_code }} | {{ $item->generator_code }}
                    </div>
                    @endforeach
                    @endif
                    </td>
                    @php $day->addDay(); @endphp
                    @endfor
                    </tr>
                    @endwhile
        </tbody>
    </table>

</body>

</html>