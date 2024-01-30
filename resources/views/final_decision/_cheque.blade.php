<div id="invoice-cheque" class="py-4 col-12 {{$classes ?? ''}}">
    <h4 class="text-center">Oʼzbekiston Respublikasi Qishloq xo'jaligi vazirligi huzuridagi Аgrosanoat majmui ustidan <br>
        nazorat qilish Inspektsiya qoshidagi “Qishloq xo'jaligi mahsulotlarini baholash markazi” davlat muassasining
        Don va uni qayta ishlashdan olingan mahsulotlarni sertifikatlashtirish organi<br>
        Toshkent shahar, Shayxontohur tumani Markaz-14, 27-uy.</h4>
    <h4 class="text-center">
       <b> Mahsulotni sertifikatlash natijasi bo'yicha <br>
           {{  date("Y", strtotime($decision->test_program->application->date))}}- yil &nbsp;
           "{{  date("d", strtotime($decision->test_program->application->date))}}" &nbsp;
           {{  date("m", strtotime($decision->test_program->application->date))}} &nbsp;
           {{$decision->test_program->application->app_number}}-sonli<br>
        <h1>Qaror</h1> </b>
    </h4>
    <div>
        <h4>
            &ensp; Buyurtmachi {{$decision->test_program->application->organization->name}} &ensp;
            {{$decision->test_program->application->date}} &nbsp;&nbsp; {{$decision->test_program->application->app_number}} - sonli
            ariza bo'yicha amalga oshirilgan sertifikatlash jarayonlarida jamlangan barcha ma'lumotlar va natijalarnni tahlili bo'yicha
            o'rnatilgan talablarga @if($decision->type == 2) {{'muvofiq'}} @else {{'nomuvofiq' }} @endif
            deb topildi, buning asosida Don va uni qayta ishlashdan olingan mahsulotlarni sertifikatlashtirish organing
            mustaqil baholash mutaxasisi sertifikatlash natijalari bo'yicha qaror qabul qildi: <br>
            Mahsulot turi &nbsp;{{$decision->test_program->application->crops->name->name}} {{($decision->test_program->application->crops->type)? "mahsulot navi ".$decision->test_program->application->crops->type->name : ''}},
            {{-- &nbsp; --}}
            {{-- &nbsp;{{$decision->test_program->akt[0]->party_number}} partiyasi, --}}
            &nbsp;{{($decision->test_program->application->crops->amount)? "miqdori ".$decision->test_program->application->crops->amount:""}}{{($decision->test_program->application->crops->measure_type)?\App\Models\CropData::getMeasureType($decision->test_program->application->crops->measure_type):""}}
            ishlab chiqarilgan sana &nbsp;{{$decision->test_program->akt[0]->make_date??''}}  bo'lgan mahsulotiga {{($decision->test_program->application->crops)?$decision->test_program->application->crops->sxeme_number:''}} - sxema bo'yicha
            @if($decision->type == 2) {{'Muvofiqlik sertifikati rasmiylashtirilsin.'}} @else {{'tahlil natijasida sertifikat rasmiylashtirishga rad etiladi' }} @endif

        </h4>
    </div>

    <div>
        <h4>Mustaqil baholovchi :</h4> &nbsp;<h4 class="text-right">{{optional($decision->decision_maker)->name}}</h4>
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

