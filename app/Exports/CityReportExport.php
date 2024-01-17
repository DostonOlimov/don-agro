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

class CityReportExport implements FromCollection,WithHeadings,WithStyles
{
    protected $data;
    protected $crop_name;
    protected $measure_type;

    public function __construct($data,$name,$measure_type)
    {
        $this->data = $data;
        $this->crop_name = $name;
        $this->measure_type = $measure_type;
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function headings():array{
        $name = $this->crop_name;
        $type = $this->measure_type;
        return[
            [" \"Qishloq xo'jaligi mahsulotlari sifatini baholash markazi\" DM 2023 yil hosilidan jamg'arilgan urug'lik $name mahsulotlarini sertifikatlanishi bo'yicha ma'lumot"],
            [
                'HUDUD NOMI',
                "EKISHGA TALAB ETILADIGAN URUG'LIK MIQDORI,$type",
                "",
                "",
                "SERTIFIKATLASHTIRILGAN URUG'LIK MIQDORI,$type",
                "SERTIFIKATLANGAN URUG'LIK MIQDORI,$type",
                "%",
                "SIFAT BO'YICHA NOMUVOFIQ DEB TOPILGAN URU'LIK MIQDORI,$type",
                "%",
                "TAHLILDA TURGAN URU'LIK MIQDORI,$type",
                "%",

            ],
        ];
    }
    public function collection()
    {

        $apps = $this->data;
        $firstRow = [
            'Ariza raqami' => '', // Set the desired value to 1
            'Sanasi' => '', // Adjust as needed
            // Fill in other fields for the first row as required
        ];
        return collect([$firstRow])->concat($apps->map(function ($app) {
            return [
                'Hudud nomi' => $app->state_name,
                'Talab etilgan miqdor' => $app->required_amount ?? '0',
                'Umumiy miqdor' => round($app->total_amount ?? 0,2) ?? 0,
                'Region name' =>  $app->required_amount ? round(100 * $app->total_amount / $app->required_amount).' %' : '100%' ?? '0',
                'Organization name' => round((($app->total_amount ?? 0) - $app->total_amount_type_3),2) ?? '0',
                'Prepared name' => round($app->total_amount_type_2,2) ?? 0,
                'Country name' => $app->required_amount ? round(100 * $app->total_amount_type_2 / $app->required_amount).' %' : '100%' ?? '0',
                'Crop name' =>round($app->total_amount_type_4,2) ?? 0,
                'Type name' => $app->required_amount ? round(100 * $app->total_amount_type_4 / $app->required_amount).' %' : '100%' ?? '0',
                'Generation name' => round($app->total_amount_type_3 ?? 0,2) ?? '0',
                'Party name' => $app->required_amount ? round(100 * $app->total_amount_type_3 / $app->required_amount).' %' : '100%' ?? '0',
            ];
        })
    );

    }
    public function styles(Worksheet $sheet)
    {
        $type = $this->measure_type;
        $sheet->mergeCells('A2:A3');
        $sheet->mergeCells('B2:B3');
        $sheet->mergeCells('F2:F3');
        $sheet->mergeCells('E2:E3');
        $sheet->mergeCells('G2:G3');
        $sheet->mergeCells('H2:H3');
        $sheet->mergeCells('I2:I3');
        $sheet->mergeCells('J2:J3');
        $sheet->mergeCells('K2:K3');

        $sheet->mergeCells('A1:K1');

        $sheet->mergeCells('C2:D2');
        $sheet->setCellValue('C2', "LABORATORIYA TAHLILLARI UCHUN KELGAN URUG'LIK MIQDORI,$type");
        $sheet->getStyle('C2')->getAlignment()->setHorizontal('center');

        $sheet->getCell('C3')->setValue("MIQDOR,$type");
        $sheet->getCell('D3')->setValue('%');

        $sheet->getStyle('A1:K3')->getFont()->setBold(true);
        $sheet->getStyle('A1:K20')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('A1:K1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
        $sheet->getStyle('A1:K1')->getFill()->getStartColor()->setARGB('fcc203'); // You can replace 'FFA07A' with your desired color code

        $sheet->getRowDimension(1)->setRowHeight(50);
        $sheet->getRowDimension(2)->setRowHeight(30);
        $sheet->getRowDimension(3)->setRowHeight(20);


        $sheet->getColumnDimension('A')->setWidth(30);
        $sheet->getColumnDimension('B')->setWidth(50);
        $sheet->getColumnDimension('C')->setWidth(50);
        $sheet->getColumnDimension('D')->setWidth(20);
        $sheet->getColumnDimension('E')->setWidth(50);
        $sheet->getColumnDimension('F')->setWidth(50);
        $sheet->getColumnDimension('G')->setWidth(20);
        $sheet->getColumnDimension('H')->setWidth(50);
        $sheet->getColumnDimension('I')->setWidth(20);
        $sheet->getColumnDimension('J')->setWidth(50);

        $sheet->getDefaultColumnDimension()->setAutoSize(false);
    }
}
