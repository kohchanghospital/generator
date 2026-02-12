<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Dashboard Report</title>
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

        p {
            margin: 3px 0;
        }

        h2 {
            margin-bottom: 10px;
            font-size: 18pt;
        }

        .summary-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .summary-table td {
            border: 1px solid #999;
            text-align: center;
            padding: 10px;
            width: 20%;
        }

        .summary-title {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .summary-number {
            font-size: 18px;
            font-weight: bold;
        }

        .info-table {
            width: 100%;
        }

        .info-table td {
            padding: 3px 0;
        }

        .inspection-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            font-size: 14pt;
        }

        .inspection-table th,
        .inspection-table td {
            border: 1px solid #444;
            padding: 6px;
        }

        .inspection-table th {
            background: #eee;
            text-align: center;
        }

        .text-center {
            text-align: center;
        }

        .footer {
            position: fixed;
            bottom: 10px;
            right: 15px;
            font-size: 12pt;
            border-top: 1px solid #999;
            padding-top: 5px;
        }

        .page-number:before {
            content: counter(page);
        }
    </style>
</head>

<body>

    <h2>Dashboard Report</h2>

    {{-- SUMMARY --}}
    <table class="summary-table">
        <tr>
            <td>
                <div class="summary-title">เดือนนี้</div>
                <div class="summary-number">{{ $monthCount }}</div>
            </td>
            <td>
                <div class="summary-title">ทั้งหมด</div>
                <div class="summary-number">{{ $allCount }}</div>
            </td>
            <td>
                <div class="summary-title">ผ่าน</div>
                <div class="summary-number">{{ $passCount }}</div>
            </td>
            <td>
                <div class="summary-title">ไม่ผ่าน</div>
                <div class="summary-number">{{ $failCount }}</div>
            </td>
            <td>
                <div class="summary-title">ไม่ได้ตรวจ</div>
                <div class="summary-number">{{ $notCheckedCount }}</div>
            </td>
        </tr>
    </table>

    {{-- การตรวจล่าสุด --}}
    @if($latestInspection)

    <h2>รายการตรวจล่าสุด</h2>

    <table class="info-table">
        <tr>
            <td><strong>เลขที่ใบตรวจ:</strong> {{ $latestInspection->inspection_no }}</td>
            <td align="right">
                <strong>วันที่:</strong>
                {{ \Carbon\Carbon::parse(
                    $latestInspection->inspection_date.' '.$latestInspection->inspection_time
                )->addYears(543)->format('d/m/Y H:i') }} น.
            </td>
        </tr>
    </table>

    <p><strong>เครื่องปั่นไฟ:</strong>
        {{ $latestInspection->generator->machine_code }}
        | {{ $latestInspection->generator->asset_name }}
    </p>

    <p><strong>ผู้บันทึก:</strong> {{ $latestInspection->user->name }}</p>
    <p><strong>หมายเหตุ:</strong> {{ $latestInspection->remark ?? '-' }}</p>

    <table class="inspection-table">
        <thead>
            <tr>
                <th width="5%">#</th>
                <th width="65%">รายการตรวจ</th>
                <th width="30%">สถานะ</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($latestInspection->checklistResults ?? [] as $i)
            <tr>
                <td class="text-center">{{ $loop->iteration }}</td>
                <td>{{ $i->checklist->checklist_name }}</td>
                <td class="text-center">
                    @if($i->status == 1)
                    ผ่าน
                    @elseif($i->status == 2)
                    ไม่ผ่าน
                    @else
                    ไม่ได้ตรวจ
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    @else

    <h2>รายการตรวจล่าสุด</h2>
    <p style="text-align:center; margin-top:20px;">
        ยังไม่มีข้อมูลการตรวจ
    </p>

    @endif

    <div class="footer">
        ข้อมูล ณ วันที่ {{ now()->addYears(543)->format('d/m/Y H:i') }} น.
        | หน้า <span class="page-number"></span>
    </div>

</body>

</html>