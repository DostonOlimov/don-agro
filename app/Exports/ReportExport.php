<?php

namespace App\Exports;


use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class ReportExport implements FromCollection,WithHeadings,WithStyles
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings():array{
        return[
            ['Don va uni qayta ishlashdan olingan mahsulotlarni sertifikatlashtirish organi'],
            [
            'Ariza raqami',
            'Ariza sanasi',
            'Na\'muna olingan viloyat',
            'Na\'muna olingan shahar yoki tuman',
            'Buyurtmachi korxona yoki tashkilot nomi',
            'Ishlab chiqaruvchi zavodning nomi',
            'Ishlab chiqargan davlat',
            'Mahsulot turi',
            'Mahsulot navi',
            'Toʼda raqami',
            'Mahsulot  miqdori',
            'Ishlab chiqarilgan sana',
            'Sinov bayonnoma raqami',

            ],

        ];
    }
    public function collection()
    {

        $apps = $this->data;
        $startingDataRow = 4;
        $firstRow = [
            'Ariza raqami' => '', // Set the desired value to 1
            'Sanasi' => '', // Adjust as needed
        ];
        return collect([$firstRow])->concat($apps->map(function ($app) {
            return [
                'Ariza raqami' => $app->app_number,
                'Sanasi' => $app->date,
                'City name' => optional($app->organization)->city->region->name ?? 'N/A',
                'Region name' => optional($app->organization)->city->name ?? 'N/A',
                'Organization name' => optional($app->organization)->name ?? 'N/A',
                'Prepared name' => optional($app->prepared)->name ?? 'N/A',
                'Country name' => optional($app->crops->country)->name  ?? 'N/A',
                'Crop name' => optional($app->crops->name)->name  ?? 'N/A',
                'Type name' => optional($app->crops->type)->name  ?? '-',
                'Party name' => optional($app->tests)->akt[0]->party_number  ?? 'N/A',
                'Amount' => optional($app->crops)->amount_name  ?? '-',
                'Year' => optional($app->crops)->year  ?? '-',
                'test_number' => optional(optional($app->tests)->result)->test_program->akt[0]->lab_bayonnoma[0]->number  ?? '',
                'reestr number' => optional(optional($app->tests)->result)->type == 2 ? optional(optional(optional($app->tests)->result)->certificate)->reestr_number : '',
                'date' => optional(optional($app->tests)->result)->type == 2 ? optional(optional(optional($app->tests)->result)->certificate)->given_date  : '',
                'sf1' => (isset($app->tests->akt[0]->lab_bayonnoma[0]->number))?$app->tests->akt[0]->lab_bayonnoma[0]->number:'',
                'sf2' => (isset($app->tests->akt[0]->lab_bayonnoma[0]->date))?$app->tests->akt[0]->lab_bayonnoma[0]->date:'',
                'sf3' =>  (isset($app->tests->akt[0]->lab_bayonnoma[0]->test_result))?$app->tests->akt[0]->lab_bayonnoma[0]->test_result:'',
                'comment' => (isset($app->tests->akt[0]->lab_bayonnoma[0]->description))?$app->tests->akt[0]->lab_bayonnoma[0]->description:'',
            ];
        })
    );

    }
     public function styles(Worksheet $sheet)
    {
        $sheet->mergeCells('A2:A3');
        $sheet->mergeCells('B2:B3');
        $sheet->mergeCells('C2:C3');
        $sheet->mergeCells('D2:D3');
        $sheet->mergeCells('F2:F3');
        $sheet->mergeCells('E2:E3');
        $sheet->mergeCells('G2:G3');
        $sheet->mergeCells('H2:H3');
        $sheet->mergeCells('I2:I3');
        $sheet->mergeCells('J2:J3');
        $sheet->mergeCells('K2:K3');
        $sheet->mergeCells('L2:L3');
        $sheet->mergeCells('M2:M3');
        $sheet->mergeCells('S2:S3');

        $sheet->mergeCells('A1:S1');

        $sheet->mergeCells('N2:O2');
        $sheet->setCellValue('N2', 'Sertifikat');
        $sheet->getStyle('N2')->getAlignment()->setHorizontal('center');

        $sheet->getCell('N3')->setValue('Reestr raqam');
        $sheet->getCell('O3')->setValue('Berilgan sana');

        $sheet->mergeCells('P2:R2');
        $sheet->setCellValue('P2', 'Tahlil natija');
        $sheet->getStyle('P2')->getAlignment()->setHorizontal('center');

        $sheet->getCell('P3')->setValue('Raqami');
        $sheet->getCell('Q3')->setValue('Berilgan sana');
        $sheet->getCell('R3')->setValue('Yaroqliligi');

        $sheet->getCell('S2')->setValue('Izoh');
        $sheet->getStyle('S2:S3')->getAlignment()->setHorizontal('center');

        $sheet->getStyle('A1:S3')->getFont()->setBold(true);
        $sheet->getStyle('A1:R1000')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('A1:S1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
        $sheet->getStyle('A1:S1')->getFill()->getStartColor()->setARGB('fcc203'); // You can replace 'FFA07A' with your desired color code

        $sheet->getRowDimension(1)->setRowHeight(50);
        $sheet->getRowDimension(2)->setRowHeight(30);
        $sheet->getRowDimension(3)->setRowHeight(20);

        $sheet->getRowDimension(4)->setRowHeight(20);

        $sheet->getColumnDimension('A')->setWidth(15);
        $sheet->getColumnDimension('B')->setWidth(30);
        $sheet->getColumnDimension('C')->setWidth(40);
        $sheet->getColumnDimension('D')->setWidth(40);
        $sheet->getColumnDimension('E')->setWidth(60);
        $sheet->getColumnDimension('F')->setWidth(60);
        $sheet->getColumnDimension('G')->setWidth(40);
        $sheet->getColumnDimension('H')->setWidth(20);
        $sheet->getColumnDimension('I')->setWidth(20);
        $sheet->getColumnDimension('J')->setWidth(15);
        $sheet->getColumnDimension('K')->setWidth(25);
        $sheet->getColumnDimension('L')->setWidth(25);
        $sheet->getColumnDimension('M')->setWidth(30);
        $sheet->getColumnDimension('N')->setWidth(20);
        $sheet->getColumnDimension('O')->setWidth(20);
        $sheet->getColumnDimension('P')->setWidth(20);
        $sheet->getColumnDimension('Q')->setWidth(20);
        $sheet->getColumnDimension('R')->setWidth(20);
        $sheet->getColumnDimension('S')->setWidth(30);
        $sheet->getDefaultColumnDimension()->setAutoSize(false);
    }
}
