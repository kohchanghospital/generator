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
            /* สำคัญ */
        }

        th,
        td {
            border: 1px solid #000;
            padding: 6px;
            text-align: center;
            word-wrap: break-word;
        }

        th {
            background: #eee;
        }

        /* กำหนดความกว้างแต่ละคอลัมน์ */
        .col-no {
            width: 10%;
            text-align: center;
        }

        /* ลำดับ เล็กลง */
        .col-code {
            width: 20%;
        }

        .col-date {
            width: 20%;
        }

        .col-user {
            width: 20%;
        }

        .col-remark {
            width: 30%;
        }
    </style>
</head>

<body>

    <h2>รายงานการตรวจเช็คเครื่องปั่นไฟ</h2>

    <table>
        <thead>
            <tr>
                <th class="col-no">ลำดับ</th>
                <th class="col-code">เลขที่ตรวจ</th>
                <th class="col-date">วันที่ตรวจ</th>
                <th class="col-user">ผู้บันทึก</th>
                <th class="col-remark">หมายเหตุ</th>
            </tr>
        </thead>
        <tbody>
            @foreach($inspections as $i => $row)
            <tr>
                <td>{{ $i+1 }}</td>
                <td>{{ $row->inspection_no }}</td>
                <td>{{ \Carbon\Carbon::parse($row->inspection_date)->addYears(543)->format('d/m/Y') }} {{ \Carbon\Carbon::parse($row->inspection_time)->format('H:i') }}</td>
                <td>{{ $row->user->name ?? '-' }}</td>
                <td>{{ $row->remark ?? '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>