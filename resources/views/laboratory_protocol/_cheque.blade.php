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
                    “Qishloq xo‘jaligi ekinlari urug‘lari va
                    ko‘chatlarining ekinbopligini, GMO va
                    havfsizligini aniqlash markaziy
                    laboratoriyasi” boshlig‘i
                    <span style="padding: 5px;display: block"> U.Xasanov</span>
                    <span style="padding: 5px;" id="application-date"></span> yil
            </h2>
        </div>
    </div>



        <h1 style="padding-top: 30px" class="text-center"><b>EKILADIGAN URUG‘LARNI SIFAT KO‘RSATKICHLARI TO‘G‘RISIDA</b><br></h1>
    <h1 class="text-center"><b>{{optional($test->laboratory_results)->number}} - sonli SINOV BAYONNOMA </b></h1>
    <div>
        <h2 style="text-align: center;  text-decoration: underline;" ><b>
        Oʼzbekiston Respublikasi Qishloq xo'jaligi vazirligi huzuridagi Аgrosanoat majmui ustidan
            nazorat qilish Inspektsiyasi qoshidagi<br> “Qishloq xo'jaligi mahsulotlari sifatini baholash markazi” davlat muassasasi.<br>
            "Qishloq xo‘jaligi ekinlari urug‘lari va
            ko‘chatlarining ekinbopligini, GMO va
            havfsizligini aniqlash markaziy
            laboratoriyasi".<br>
        Toshkent viloyati, Qibray tumani,Bobur MFY, Bobur koʼchasi 1-uy. tel:(91) 111-49-93. urugsert@agroxizmat.uz.<br>Akkreditatsiya guvohnomasi O'ZAK.SL.0271.
            </b>
        </h2>
        <h2> Namunalar Markaziy laboratoriyaga Sertifikatlashtirish idorasi tomonidan {{ $start_date }} yilda
            № {{ $test->id }}/1 @if ($test->count > 1)
                -{{ $test->id }}/{{ $test->count }}
            @endif -sonli raqamlar bilan kodlangan holda urug'lik
            {{ $test->application->crops->name->name }} namunalari taqdim etilgan.</h2>
        <h2><b style="text-decoration: underline;">Urug'lik me'yoriy hujjati:</b> <span
                style="text-decoration: underline;">{{ $nds_type }}
                {{ $test->application->crops->name->nds->number }}&nbsp;{{ $test->application->crops->name->nds->name }}.</span>
        </h2>
        <h2><b style="text-decoration: underline;"> Namuna ro'yxatga oligan raqam :</b>
            {{ $test->laboratory_numbers->first()->number }} @if ($test->count > 1)
                - {{ $test->laboratory_numbers->last()->number }}
            @endif. Namuna og'irligi :
            {{ $test->count * $test->weight }}-{{ \App\Models\CropData::getMeasureType($test->measure_type) }}.</h2>
        <h2><b style="text-decoration: underline;">Mahsulot to'g'risida ma'lumot :</b>
            @if ($test->application->crops->pre_name == 'tuksiz')
                tuksizlantirilgan
            @else
                {{ $test->application->crops->pre_name }}
            @endif urug'lik {{ $test->application->crops->name->name }}
            {{ $test->application->crops->year }}-hosilidan tayyorlangan.
        </h2>
        <h2><b style="text-decoration: underline;">Sinov o'tkazish maqsadi:</b> sertifikatlash. Subpodryad bo'yicha
            o'tkazilgan sinovlar : yo'q.</h2>
        <h2><b style="text-decoration: underline;">Sinov o'tkazish sharoiti : </b> harorati -
            {{ $test->laboratory_results->harorat }} °C va nisbiy namligi - {{ $test->laboratory_results->namlik }} %.
        </h2>
        <h1 style="text-align: center"><b>{{ $nds_type }} {{ $test->application->crops->name->nds->number }}
                bo'yicha SINOV NATIJALARI:</b></h1>
        @php $t = 1; @endphp
        <table class="align-middle " style="border: 1px solid black ;text-align: center;font-size: 18px;">
            <tr style=" height: 40px;">
                <th style="font-weight: bold; font-size: 20px; width: 40px;">T\r</th>
                <th style="font-weight: bold; font-size: 20px;"> Ekish sifat ko'rsatkichlari</th>
                <th style="font-weight: bold; font-size: 20px;">Sinov usullarining me'yoriy hujjatlari</th>
                <th style="font-weight: bold; font-size: 20px;">MH bo'yicha me'yorlar</th>
                <th style="font-weight: bold; font-size: 20px;">Sinov natijasi /U</th>
                <th style="font-weight: bold; font-size: 20px;">Ko'rsatkichlar muvofiqligi</th>
            </tr>
            @foreach ($indicators as $k => $indicator)
                <tr>
                    <td style="font-weight: bold">
                        @if (!$indicator->indicator->parent_id)
                            {{ $t }}
                        @endif
                    </td>
                    <td style="text-align: left;font-weight: bold;padding-left: 10px;">
                        {{ $indicator->indicator->name }} @if ($indicator->indicator->measure_type == 1)
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
                            {{ $indicator->indicator->default_value }}
                        @endif
                    </td>
                    <td>

                        @if($indicator->indicator->nd_name)
                            @if($indicator->result != 0)
                                {{ number_format( $indicator->result, 1, '.', ' ') }}
                            @else
                                @if($indicator->indicator->measure_type==1 || $indicator->indicator->measure_type==2)
                                    {{'aniqlanmadi'}}
                                @else
                                    {{'uchramadi'}}
                                @endif
                            @endif
                        @endif
                    </td>
                    <td>
                        @if(($indicator->result == 0 and $indicator->indicator->measure_type==1) || ($indicator->result == 0 and $indicator->indicator->measure_type==2))
                        @else
                            @if($indicator->indicator->nd_name)
                                {{($indicator->type == 1)? 'Muvofiq' : 'Nomuvofiq'}}
                            @endif
                        @endif
                    </td>
                </tr>
                @if(!$indicator->indicator->parent_id) @php $t=$t+1; @endphp @endif
            @endforeach
        </table>
        <h2 style="padding-top: 15px;padding-left: 50px;"><span style="text-decoration: underline; font-weight: 700">Sinov o'tkazilgan muddat :</span> {{$start_date}} dan  {{$end_date}} gacha</h2>
        <h2><span style="text-decoration: underline; font-weight: 700">Qo'shimcha ma'lumotlar: </span>Mazkur urug'lik {{$test->application->crops->name->name}} partiyasining avlodi sinov dasturiga muvofiq {{$test->application->crops->generation->name}} reproduksiyaga mansub.<br>

        </h2>
        <h2>Ushbu urug'lik  {{$test->application->crops->name->name}}  {{$test->application->crops->pre_name}} @if($test->application->crops->pre_name) holda @endif
            @foreach($production_type as $type)
                @if($type->type_id == 8)
                {{ optional($type->type)->name  }}.
                @endif
            @endforeach
         1000 dona vazni o'rtacha <span style="font-weight: 700">{{optional($test->indicators->where('indicator_id',124)->first())->result}} gr </span> . ni tashkil etadi.</h2>
        <h2>Sinov natijalari bo'yicha qaror qabul qilish uchun asos Muvofiqlik xulosasi №4, o'lchovlarning noaniqligi (U) buyurtmachining talabiga asosan ko'rsatiladi.</h2>
        <h2 style="padding-left: 50px; font-weight: 700">Xulosa : <span style="text-decoration: underline;"> <b>{{ $test->laboratory_results->data }}</b></span></h2>
        <h4>Natijalar sinovdan o'tkazilgan na'munalarga tegishli.</h4>
        <div style="display: flex; ">
            <h2><b> Sinov muxandisi:  U.Quziyev</b> {!! QrCode::size(50)->generate(route('show.user', 55)) !!}</h2>
            <h2 style="margin-left: 2%"><b>Bosh mutaxassis</b>  {{(substr($test->laboratory_results->users->name, 1, 1)=='h')? substr(optional($test->laboratory_results->users)->name, 0, 2) : substr(optional($test->laboratory_results->users)->name, 0, 1)}}. {{optional($test->laboratory_results->users)->lastname}}</b> {!! QrCode::size(50)->generate(route('show.user', $test->laboratory_results->users->id)) !!}</h2>
        </div>
        <h2>Sinov mutaxassislar: </h2>
        <div style="display: flex;">
            @foreach($test->laboratory_results->result_users as $key => $result_user)

                <h2 style="margin-right: 2%"><b>{{ ++$key }}. {{ (substr($result_user->users->name, 1, 1)=='h')? substr($result_user->users->name, 0, 2):substr($result_user->users->name, 0, 1) }}. {{ optional($result_user->users)->lastname }}</b> {!! QrCode::size(50)->generate(route('show.user', $result_user->users->id)) !!}</h2>
            @endforeach
        </div>
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
