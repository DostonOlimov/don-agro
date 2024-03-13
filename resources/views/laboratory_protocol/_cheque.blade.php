@php
    use SimpleSoftwareIO\QrCode\Facades\QrCode;
@endphp
<div id="invoice-cheque" class="py-4 col-12 {{ $classes ?? '' }}" style=" font-family: Times New Roman;">
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
                    <span style="padding: 5px;display: block">Nizamov D.B</span>
                    <span style="padding: 5px;" id="application-date"></span> yil
            </h2>
        </div>
    </div>


        {{-- <h1 style="padding-top: 30px" class="text-center"><b>EKILADIGAN URUG‘LARINI SIFAT KO‘RSATKICHLARI TO‘G‘RISIDA</b><br></h1> --}}
    <h1 class="text-center"><b>SINOV BAYONNOMA – № {{optional($test->laboratory_results)->number}} .</b></h1>
    <div>
        <h2 style="text-align: center;" ><b>
        Oʼzbekiston Respublikasi Qishloq xo'jaligi vazirligi huzuridagi Аgrosanoat majmui ustidan
            nazorat qilish Inspektsiya qoshidagi<br> “Qishloq xo'jaligi mahsulotlarini sifatini baholash markazi” davlat muassasi.<br>
            “Don va don mahsulotlarining sifatini tekshirish”
            markaziy laboratoriyasi<br>
        <span style="text-decoration: underline;">Toshkent viloyati, Qibray tumani, Bobur MFY, Bobur koʼchasi 1-uy. tel:(91) 111-49-93. donsert@agroxizmat.uz.<br>Akkreditatsiya guvohnomasi № O'ZAK.SL.0168</span>
            </b>
        </h2>
        <h2> Na'munalar Markaziy laboratoriyaga Sertifikatlashtirish idorasi tomonidan {{$start_date}} yilda
         № {{$test->id}}/1 @if($test->count > 1) -{{$test->id}}/{{$test->count}} @endif -sonli raqamlar bilan kodlangan xolda urug'lik {{$test->application->crops->name->name}} na'munalari taqdim etilgan.</h2>
         <h2><b style="text-decoration: underline;">Urug'lik me'yoriy hujjati:</b> <span
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
            {{ $test->count * $test->weight }}-{{ \App\Models\CropData::getMeasureType($test->akt[0]->measure_type) }}.</h2>
        <h2> Mahsulot to'g'risida ma'lumot : @if($test->application->crops->pre_name == 'tuksiz') tuksizlantirilgan @else {{$test->application->crops->pre_name}} @endif  urug'lik {{$test->application->crops->name->name}} {{$test->application->crops->year}}-hosilidan tayyorlangan.</h2>
        <h2> Sinov o'tkazish maqsadi:sertifikatlash. Subpodryad bo'yicha o'tkazilgan sinovlar : yo'q.</h2>
        <h2> Sinov o'tkazish sharoiti : harorati - {{$test->laboratory_results->harorat}} °C va nisbiy namligi - {{$test->laboratory_results->namlik}} %.</h2>
        <h1 style="text-align: center"><b>
                @foreach ($test->application->crops->name->nds as $item)
                {{ \App\Models\Nds::getType($item->type_id) }}
                    {{ $item->number }}
                @endforeach
                bo'yicha SINOV NATIJALARI:
            </b></h1>
        @php $t = 1; @endphp
        <table class="align-middle " style="border: 1px solid black ;text-align: center;font-size: 18px;">
            <tr style=" height: 40px;">
                <th style="font-weight: bold; font-size: 20px; width: 40px;">T\r</th>
                <th style="font-weight: bold; font-size: 20px;"> Ekish Sifat ko'rsatkichlari</th>
                <th style="font-weight: bold; font-size: 20px;">Sinov usullarining me'yoriy hujjatlari</th>
                <th style="font-weight: bold; font-size: 20px;">MH bo'yicha me'yorlar</th>
                <th style="font-weight: bold; font-size: 20px;">Sinov natijasi /U</th>
                <th style="font-weight: bold; font-size: 20px;">Ko'rsatkichlar muvofiqligi</th>
            </tr>
            @foreach($indicators as $k => $indicator)
                <tr>
                    <td style="font-weight: bold" >@if(!$indicator->indicator->parent_id) {{$t}} @endif</td>
                    <td style="text-align: left;font-weight: bold;padding-left: 10px;">{{$indicator->indicator->name}}</td>
                    <td>{!! nl2br($indicator->indicator->nd_name) !!}</td>
                    <td>
                        @if($indicator->indicator->nd_name)
                            {{$indicator->indicator->default_value}}
                        @endif
                    </td>
                    <td>
                        @if($indicator->indicator->nd_name)
                            {{$indicator->result != 0 ? $indicator->result : 'uchramadi'}}
                        @endif
                    </td>
                    <td>
                        @if($indicator->indicator->nd_name)
                            {{$indicator->type == 1 ? 'Muvofiq' : 'Nomuvofiq'}}
                        @endif
                    </td>
                </tr>
                @if(!$indicator->indicator->parent_id) @php $t=$t+1; @endphp @endif
            @endforeach
        </table>
        <h2 style="padding-top: 15px;padding-left: 50px;">Sinov o'tkazilgan muddat : {{$start_date}} dan  {{$end_date}} gacha</h2>
        <h2><span style="text-decoration: underline; font-weight: 700">Qo'shimcha ma'lumotlar: </span>Mazkur urug'lik
            {{ $test->application->crops->name->name }} partiyasining avlodi sinov dasturiga muvofiq<br>

        </h2>
        <h2>Ushbu urug'lik  {{$test->application->crops->name->name}}  {{$test->application->crops->pre_name}} @if($test->application->crops->pre_name) xolda @endif
            @foreach($production_type as $type)
                @if($type->type_id == 8)
                {{ optional($type->type)->name  }}.
                @endif
            @endforeach
         1000 dona vazni o'rtacha {{optional($test->indicators->where('indicator_id',124)->first())->result}} gr. ni tashkil etadi.</h2>
        <h2>Sinov natijalari bo'yicha qaror qabul qilish uchun asos Muvofiqlik xulosasi №4, o'lchovlarning noaniqligi (U) buyurtmachining talabiga asosan ko'rsatiladi.</h2>
        <h2 style="padding-left: 50px;">Xulosa : <span style="text-decoration: underline;"> <b>{{ $test->laboratory_results->data }}</b></span></h2>
        <h4>Natijalar sinovdan o'tkazilgan na'munalarga tegishli.</h4>
        <h2><b> Sinov muxandisi:  {{substr(optional($test->laboratory_results->users)->name, 0, 1)}}. {{optional($test->laboratory_results->users)->lastname}}</b> </h2>
        <h2><b>Sinov bo'yicha mutaxassislar</b> </h2>
        @foreach($test->laboratory_results->result_users as $result_user)
            <h2><b>{{substr(optional($result_user->users)->name, 0, 1)}}. {{optional($result_user->users)->lastname}}</b> </h2>
        @endforeach
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

