<div id="invoice-cheque" class="py-4 col-12 {{ $classes ?? '' }}">
    <h4 class="text-center">Oʼzbekiston Respublikasi Qishloq xo'jaligi vazirligi huzuridagi Аgrosanoat majmui ustidan
        nazorat qilish Inspektsiya qoshidagi <br> “Qishloq xo'jaligi mahsulotlarini sifatini baholash markazi” davlat
        muassasining<br>
        Don va uni qayta ishlashdan olingan mahsulotlarni sertifikatlashtirish organi<br>
        Toshkent shahar, Shayxontohur tumani Markaz-14, 27-uy.</h4>
    <h4 class="text-right">
        <b> «TАSDIQLАYMАN» </b><br>
        Don va uni qayta ishlashda<br>
        olingan mahsulotlarni sertifikatlashtirish<br>
        boʼlimi boshligʼi<br>
        <span id="director-name"></span><br>
        <span id="application-date"></span> yil
        <div class="text-center"> {!! $qrCode !!}</div>
    </h4>
    <b>
        <h4 class="text-center"> Don va uni qayta ishlashdan olingan mahsulotlarni sertifikatlashtirish boʼyicha<br></h4>
        <h2 class="text-center">SINOV DASTURI</h2>
    </b>
    <div>
        <h4>
            1. {{ $decision->application->crops->year }}- yil xosilidan ,
            {{ $decision->application->crops->type ? $decision->application->crops->type->name . ' - navli,' : '' }}
            {{-- {{$decision->application->crops->generation->name}} - avlodli &nbsp; --}}
            {{-- {{ $decision->application->crops->pre_name }} urugʼlik &nbsp; --}}
            {{ $decision->application->crops->name->name }}
            &nbsp; mahsuloti &nbsp;
            {{ $nds }}
            talablariga muvofiq, sifat koʼrsatkichlarini sinovdan oʼtkazish quyidagi standartlardagi usullarni qoʼllagan
            xolda amalga oshirilsin.
        </h4>
    </div>
    <h4>2.Namunaning identifikatsiya raqami: {{ $app_id->id }}</h4>
    @php
        // $k = 1;
        // $count = $decision->count;
    @endphp
    <div>
        @php
            // $number = $decision->count; // Replace with your actual number
            // $columns = 5;
            // $rows = ceil($number / $columns);
        @endphp

        {{-- <table class="table table-bordered align-middle first-table">
            @for ($row = 1; $row <= $rows; $row++)
                <tr>
                    @for ($col = 1; $col <= $columns; $col++)
                        @php
                            $cellValue = ($row - 1) * $columns + $col;
                        @endphp
                        <td>
                            @if ($cellValue <= $number)
                                {{ $decision->application->app_number . '/' . $cellValue }}
                            @endif
                        </td>
                    @endfor
                </tr>
            @endfor
            <tr>
                <td colspan="5"> Har bir sinov na'munasining vazni
                    &nbsp;&nbsp;{{ $decision->weight }} -
                    &nbsp;{{ $measure_type }}
                </td>
            </tr>
        </table> --}}
    </div>

    <h4>3.Sifat ko‘rsatkichlari bo‘yicha me’yoriy hujjatlar:</h4>
    @foreach ($indicators as $key => $box)
        @php $t = 1; @endphp
        <table style="font-weight: bold" class="table table-bordered align-middle">
            <br>
            <tr>{{ $key ? \App\Models\Nds::getType($key) : '' }}</tr>
            @foreach ($box as $k => $indicator)
                <tr>
                    <td>
                        @if (!$indicator->indicator->parent_id)
                            {{ $t }}
                        @endif
                    </td>
                    <td>{{ $indicator->indicator->name }}</td>
                    <td>{!! nl2br($indicator->indicator->nd_name) !!}</td>
                    <td>
                        @if ($indicator->indicator->nd_name)
                            +
                        @endif
                    </td>
                </tr>
                @if (!$indicator->indicator->parent_id)
                    @php $t=$t+1; @endphp
                @endif
            @endforeach
        </table>
    @endforeach
    <div>
        Aloxida yozuvlar : &nbsp;{{ $decision->extra_data }}
    </div>

</div>
<script>
    function printCheque() {
        $('#invoice-cheque').print({
            NoPrintSelector: '.no-print',
            title: '',
        })
    }
</script>
