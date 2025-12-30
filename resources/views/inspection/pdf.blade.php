<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="utf-8">

    <style>
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

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 6px;
        }

        th {
            background: #f0f0f0;
            font-weight: bold;
        }
    </style>
</head>

<body>

    <h2 style="text-align:center;">รายงานตรวจเช็คเครื่องปั่นไฟ</h2>

    <p><b>เลขที่ใบตรวจ:</b> {{ $inspection->inspection_no }}</p>
    <p><b>วันที่:</b> {{ \Carbon\Carbon::parse($inspection->inspection_date)->format('d/m/Y') }}</p>
    <p><b>เวลา:</b> {{ \Carbon\Carbon::parse($inspection->inspection_time)->format('H:i')}} น.</p>
    <p><b>เครื่อง:</b> {{ $inspection->generator->machine_code }} | {{ $inspection->generator->asset_name }}</p>
    <p><b>ผู้ตรวจ:</b> {{ $inspection->user->name }}</p>

    <table>
        <thead>
            <tr>
                <th width="5%">ลำดับ</th>
                <th width="45%">รายการตรวจ</th>
                <th width="20%">สถานะ</th>
                <th width="30%">หมายเหตุ</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($inspection->checklistResults as $i => $row)
            <tr>
                <td align="center">{{ $i + 1 }}</td>
                <td>{{ $row->checklist->checklist_name }}</td>
                <td align="center">
                    @if($row->status == 1) ผ่าน
                    @elseif($row->status == 2) ไม่ผ่าน
                    @else ไม่ได้ตรวจ
                    @endif
                </td>
                <td>{{ $row->remark ?? '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>