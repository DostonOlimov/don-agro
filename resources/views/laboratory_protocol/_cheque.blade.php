@php
    use SimpleSoftwareIO\QrCode\Facades\QrCode;
    $y = $i + 1;
@endphp
<div>
    <div class="row">
        <div class="col-sm-4"></div>
        <div class="col-sm-4" style="display: flex; flex-direction: column; justify-content: end;">
            <div class="text-center"> {!! $qrCode !!}</div>
        </div>
        <div class="col-sm-4" style="display:block;">
            <span style="display: block" class="text-center"><b>ПСК 04:2024</b></span>
            <span style="display: block" class="text-center"><b>1/1</b></span>
            <h2 class="text-center">
                <b> «T A S D I Q L A Y M A N»<br>
                    “Don va don mahsulotlarining
                    sifatini tekshirish markaziy
                    laboratoriyasi” boshlig‘i
                    <span style="padding: 5px;display: block">Usmonov A.A</span>
                    <span style="padding: 5px;" id="application-date"></span> yil
            </h2>
        </div>
    </div>

    {{-- <h1 style="padding-top: 30px" class="text-center"><b>EKILADIGAN URUG‘LARINI SIFAT KO‘RSATKICHLARI TO‘G‘RISIDA</b><br></h1> --}}
    <h1 class="text-center"><b>SINOV BAYONNOMA – № {{ optional($test->laboratory_results)->number + $i }}
        </b></h1>
    <div>
        <h2 style="text-align: center;"><b>
                Oʼzbekiston Respublikasi Qishloq xo'jaligi vazirligi huzuridagi Аgrosanoat majmui ustidan
                nazorat qilish Inspektsiya qoshidagi<br> “Qishloq xo'jaligi mahsulotlarini sifatini baholash markazi”
                davlat muassasi.<br>
                “Don va don mahsulotlarining sifatini tekshirish”
                markaziy laboratoriyasi<br>
                <span style="text-decoration: underline;">Toshkent viloyati, Qibray tumani, Bobur MFY, Bobur koʼchasi
                    1-uy. tel:(71) 244 87 56. donsert@agroxizmat.uz.<br>Akkreditatsiya guvohnomasi №
                    O'ZAK.SL.0168</span>
            </b>
        </h2>
        <div style="padding-left: 50px;">
            <h2> Na'munalar Markaziy laboratoriyaga Sertifikatlashtirish idorasi tomonidan {{ $start_date }} yilda
                №
                {{-- {{$test->id}}/1 --}}
                {{-- @if ($test->count > 1) -{{$test->id}}/{{$test->count}} @endif --}}
                {{-- @php
                    $number = $test->akt[0]->party_number; // Replace with your actual number
                    $columns = 5;
                    $rows = ceil($number / $columns);
                @endphp
                @for ($row = 1; $row <= $rows; $row++)
                    <tr>
                        @for ($col = 1; $col <= $columns; $col++)
                            @php
                                $cellValue = ($row - 1) * $columns + $col;
                            @endphp
                            <td>
                                @if ($cellValue <= $number)
                                    {{ $test->application->app_number . '/' . $cellValue }}
                                @endif
                            </td>
                        @endfor
                    </tr>
                @endfor --}}
                {{ $test->application->app_number . '/' . $y }}

                -sonli raqamlar bilan kodlangan holda taqdim qilingan.
            </h2>
            {{-- start header doc --}}
            <h2>Namuna olish haqida ma’lumot: <span>-</span></h2>
            <h2>Namuna olishda laboratoriya mutaxassisining ishtiroki: <span style="text-decoration: underline">
                    Ishtirok etmagan</span></h2>
            <h2>Namuna olish vaqtida atrof-muhit holati: <span style="text-decoration: underline"> - ºС ,</span> nisbiy
                namlik: <span style="text-decoration: underline"> - %. </span></h2>
            <h2>Namuna kelib tushgan sana: <span
                    style="text-decoration: underline">{{ $test->updated_at->format('d-m-Y') }}
                    yil</span>. Mahsulot turi: <span
                    style="text-decoration: underline">{{ $test->application->crops->name->name }}.</span></h2>
            <h2>Mahsulotning me’yoriy xujjati:
                <span style="text-decoration: underline">
                    @foreach ($test->application->crops->name->nds as $value)
                        {{ \App\Models\Nds::getType($value->type_id) }}
                        {{ $value->number }}&nbsp;{{ $value->name }}
                    @endforeach
                </span>.
            </h2>
            <h2>Namunaning tavsifi: <span style="text-decoration: underline">Namuna laboratoriyaga polietelen xaltada
                    keltirildi.</span></h2>
            <h2>Namuna raqami: <span
                    style="text-decoration: underline; margin-right: 1%">{{ $y ? $y : optional($test->laboratory_results)->number }}
                </span> Namunaning vazni: <span
                    style="text-decoration: underline">{{ $test->akt[0]->simple_size . ' ' . \App\Models\CropData::getMeasureType($test->akt[0]->measure_type) }}.</span>
            </h2>
            <h2>Partiya raqami: (vagon) <span
                    style="text-decoration: underline">{{ $test->akt[0]->party_number }}.</span></h2>
            <h2>Namunaning ishlab chiqarilgan sanasi: <span
                    style="text-decoration: underline">{{ $test->application->crops->year }} hosili.</span></h2>
            <h2>Mahsulot nomi: <span
                    style="text-transform: lowercase; text-decoration: underline">{{ $test->akt[0]->use_goal . ' ' . $test->application->crops->name->name }}</span>
            </h2>
            <h2> Sinov o’tkazish talablari : harorati - <span> {{ $test->laboratory_results->harorat }} °C </span> va
                nisbiy namligi: <span style="text-decoration: underline">{{ $test->laboratory_results->namlik }}
                    %.</span> </h2>
            <h2>Sinovning maqsadi va vazifasi: <span
                    style="text-decoration: underline">{{ $test->application->crops->sxeme_number != 3 ? 'Sertifikatlash.' : 'Inspeksiya nazorati uchun.' }}</span>
            </h2>
            <h2>Subpudratchi tomonidan o’tkazilgan sinov: <span>-</span></h2>
            <h2>Sinov o’tkazdi: <span
                    style="text-decoration: underline">{{ $test->application->decision->laboratory->name }}.</span>
            </h2>
        </div>
        {{-- end  header doc --}}
        {{-- start header old doc --}}
        {{-- <h2><b style="text-decoration: underline;">Urug'lik me'yoriy hujjati:</b> <span
                style="text-decoration: underline;">
                @foreach ($test->application->crops->name->nds as $value)
                    {{ \App\Models\Nds::getType($value->type_id) }}
                    {{ $value->number }}&nbsp;{{ $value->name }}
                @endforeach
            </span>
        </h2>
        <h2><b style="text-decoration: underline;"> Namuna ro'yxatga oligan raqam :</b>
            {{ $test->laboratory_numbers->first()->number }} @if ($test->count > 1)
                - {{ $test->laboratory_numbers->last()->number }}
            @endif. Namuna og'irligi :
            {{ $test->count * $test->weight }}-{{ \App\Models\CropData::getMeasureType($test->akt[0]->measure_type) }}.
        </h2>
        <h2> Mahsulot to'g'risida ma'lumot : @if ($test->application->crops->pre_name == 'tuksiz')
                tuksizlantirilgan
            @else
                {{ $test->application->crops->pre_name }}
            @endif urug'lik {{ $test->application->crops->name->name }}
            -hosilidan tayyorlangan.</h2>
        <h2> Sinov o'tkazish maqsadi:sertifikatlash. Subpodryad bo'yicha o'tkazilgan sinovlar : yo'q.</h2>
        <h2> Sinov o'tkazish sharoiti : harorati - {{ $test->laboratory_results->harorat }} °C va nisbiy namligi -
            {{ $test->laboratory_results->namlik }} %.</h2> --}}
        {{-- end header old doc --}}

        <h1 style="text-align: center"><b>
                {{-- @foreach ($test->application->crops->name->nds as $item)
                    {{ \App\Models\Nds::getType($item->type_id) }}
                    {{ $item->number }}
                @endforeach --}}
                {{-- bo'yicha  --}}
                SINOV NATIJALARI:
            </b></h1>
        {{-- start table --}}
        @php
            $sanoq = 0;
        @endphp
        @foreach ($indicators as $key => $box)
            @php $t = 1; @endphp
            <h3 style="font-weight: 700">
                <?php
                $nds = $test->application->crops->name->nds;
                if ($key) {
                    echo \App\Models\Nds::getType($key) . '.';
                    foreach ($nds as $sanoq => $nd) {
                        if ($key == $nd->type_id) {
                            echo $nd->number; //.' '. $nd->name;
                        }
                    }
                }
                $sanoq++;
                ?>
            </h3>
            <table class="align-middle " style="border: 1px solid black ;text-align: center;font-size: 18px;">
                <tr style=" height: 40px;">
                    <th style="font-weight: bold; font-size: 20px; width: 40px;">T\r</th>
                    <th style="font-weight: bold; font-size: 20px;">Aniqlanuvchi ko’rsatgichlari</th>
                    <th style="font-weight: bold; font-size: 20px;">Sinov usullarining me’yoriy xujjatlari</th>
                    <th style="font-weight: bold; font-size: 20px;">Me’yoriy xujjat bo’yicha belgilangan me’yori</th>
                    <th style="font-weight: bold; font-size: 20px;">Sinov natijasi {{-- /U --}}</th>
                    <th style="font-weight: bold; font-size: 20px;">Ko’rsatgichning muvofiqligi</th>
                </tr>
                @foreach ($box as $k => $indicator)
                    {{-- <tr>
                    <td style="font-weight: bold" >@if (!$indicator->indicator->parent_id) {{$t}} @endif</td>
                    <td style="text-align: left;font-weight: bold;padding-left: 10px;">{{$indicator->indicator->name}}</td>
                    <td>{!! nl2br($indicator->indicator->nd_name) !!}</td>
                    <td>
                        @if ($indicator->indicator->nd_name)
                            {{$indicator->indicator->default_value}}
                        @endif
                    </td>
                    <td>
                        @if ($indicator->indicator->nd_name)
                            {{$indicator->result != 0 ? $indicator->result : 'uchramadi'}}
                        @endif
                    </td>
                    <td>
                        @if ($indicator->indicator->nd_name)
                            {{$indicator->type == 1 ? 'Muvofiq' : 'Nomuvofiq'}}
                        @endif
                    </td>
                </tr>
                @if (!$indicator->indicator->parent_id) @php $t=$t+1; @endphp @endif --}}

                    <tr>
                        <td style="font-weight: bold">
                            @if (!$indicator->indicator->parent_id)
                                {{ $t }}
                            @endif
                        </td>
                        <td style="text-align: left;font-weight: bold;padding-left: 10px;">
                            {{ $indicator->indicator->name }}
                            @if ($indicator->indicator->measure_type == 1)
                                , kamida, %
                            @elseif ($indicator->indicator->measure_type == 2)
                                , ko'pi bilan, %
                            @elseif ($indicator->indicator->measure_type == 4)
                                , %
                            @endif
                        </td>
                        <td>{!! nl2br($indicator->indicator->nd_name) !!}</td>
                        <td>
                            @if ($indicator->indicator->nd_name)
                                @if($indicator->indicator->comment)
                                    {{ $indicator->indicator->comment }}
                                @else
                                    @if($indicator->indicator->value != 0)
                                        {{ $indicator->indicator->value }}
                                    @else
                                        ruxsat etilmaydi
                                    @endif
                                @endif
                            @endif
                        </td>
                        <td>
                            @if ($indicator->indicator->nd_name)
                                @if($indicator->result != 0 || $indicator->indicator->value != 0)
                                    {{ $indicator->result }}
                                @else
                                    aniqlanmadi
                                @endif
                            @endif
                        </td>
                        <td>
{{--                            @if (--}}
{{--                                ($indicator->result == 0 and $indicator->indicator->measure_type == 1) ||--}}
{{--                                    ($indicator->result == 0 and $indicator->indicator->measure_type == 2))--}}
{{--                            @else--}}
                                @if ($indicator->indicator->nd_name)
                                    {{ $indicator->type == 1 ? 'Muvofiq' : 'Nomuvofiq' }}
                                @endif
{{--                            @endif--}}
                        </td>
                    </tr>
                    @if (!$indicator->indicator->parent_id)
                        @php $t=$t+1; @endphp
                    @endif
                @endforeach
            </table><br>
        @endforeach
        {{-- end table --}}

        <h2 style="padding-top: 15px;padding-left: 50px;">Sinov o'tkazilgan muddat : <span
                style="text-decoration: underline">{{ $start_date }} dan
                {{ $end_date }} gacha </span></h2>
        <h2 style="padding-left: 50px">Qo'shimcha ma'lumotlar:
            {{-- Mazkur urug'lik
            {{ $test->application->crops->name->name }} partiyasining avlodi sinov dasturiga muvofiq<br>

        </h2>
        <h2>Ushbu urug'lik  {{$test->application->crops->name->name}}  {{$test->application->crops->pre_name}} @if ($test->application->crops->pre_name) xolda @endif
            @foreach ($production_type as $type)
                @if ($type->type_id == 8)
                {{ optional($type->type)->name  }}.
                @endif
            @endforeach
         1000 dona vazni o'rtacha {{optional($test->indicators->where('indicator_id',124)->first())->result}} gr. ni tashkil etadi.</h2>
        <h2>Sinov natijalari bo'yicha qaror qabul qilish uchun asos Muvofiqlik xulosasi №4, o'lchovlarning noaniqligi (U) buyurtmachining talabiga asosan ko'rsatiladi. --}}
            <span style="text-decoration: underline">
                {{ $test->laboratory_results->data }}
            </span>
        </h2>
        <h2 style="padding-left: 50px">Olingan sinov natijasiga tegishli bayonnoma raqami : <span
                style="text-decoration: underline">№ {{ optional($test->laboratory_results)->number + $i }}</span></h2>
        {{-- <h2 style="padding-left: 50px;">Xulosa : <span style="text-decoration: underline;"> <b>{{ $test->laboratory_results->data }}</b></span></h2> --}}
        {{-- <h4>Natijalar sinovdan o'tkazilgan na'munalarga tegishli.</h4> --}}
        <h2 style="padding-left: 50px"> Bajaruvchi:
            {{ substr(optional($test->laboratory_results->users)->name, 0, 1) }}.
            {{ optional($test->laboratory_results->users)->lastname }} </h2>
        {{-- <h2><b>Sinov bo'yicha mutaxassislar</b> </h2>
        @foreach ($test->laboratory_results->result_users as $result_user)
            <h2><b>{{substr(optional($result_user->users)->name, 0, 1)}}. {{optional($result_user->users)->lastname}}</b> </h2>
        @endforeach --}}
        <h4 style="text-align: center">Sinov bayonnomasi yakuni.</h4>
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
