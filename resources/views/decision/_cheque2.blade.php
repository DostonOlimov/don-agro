<div id="invoice-cheque" class="py-4 col-12 {{$classes ?? ''}}">
    <h4 class="text-center">Oʼzbekiston Respublikasi Qishloq xo'jaligi vazirligi huzuridagi Аgrosanoat majmui ustidan
        nazorat qilish Inspektsiya qoshidagi <br> “Qishloq xo'jaligi mahsulotlarini sifatini baholash markazi” davlat muassasining<br>
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
    <h4 class="text-center">Sertifikatlashtirishni oʼtkazish uchun berilgan ariza boʼyicha<br>
        <span id="application-year"></span> &nbsp yil &nbsp “<span id="application-month"></span>”&nbsp <span id="application-day"></span> &nbsp<span id="application-id"></span>-sonli</h4>
    <h1 class="text-center">QAROR</h1></b>
    <table class="table table-bordered align-left">
        <tr>
            <td colspan="4" class="align-left">
                <h4 class=" text-left">
                    Buyurtmachi  <span id="application-organization"></span> <br>
                    mahsulot &nbsp <span id="crop-name"></span> &nbsp <span id="crop-amount"></span> <span id="measure-type"></span> , &nbsp mahsulotini sertifikatlashtirish uchun berilgan arizasini koʼrib chiqib quyidagilarni ma'lum qilamiz:
                </h4>
            </td>
        </tr>
        <tr>
            <td colspan="4" class="align-left">
                <h4 class=" text-left">
                    1. Sertifikatlashtirish ishlari _____<span id="sceme"></span>______ - sxemasi bo‘yicha o‘tkaziladi;</h4>
            </td>
        </tr>
        <tr>
            <td colspan="4" class="align-left">
                <h4 class=" text-left">
                    2.      <span id="laboratory-name"></span>da (akkreditatsiya guvohnomasi
                    <span id="laboratory-certificate"></span>, manzil:      <span id="laboratory-address"></span> ) amalga oshirilsin;
                </h4>
            </td>
        </tr>
        <tr>
            <td colspan="4" class="align-left">
                <h4 class=" text-left">
                    3. Sertifikatlashtirish &nbsp;<span id="nds"></span>
                    davlat standarti talablarga muvofiq amalga oshiriladi.
                </h4>
            </td>
        </tr>
        <tr>
            <td colspan="4" class="align-left">
                <h4 class=" text-left">
                    4. Mahsulotni identifikatsiyalash va namuna tanlab olish buyurtmachining omborida amalga oshiriladi;
                </h4>
            </td>
        </tr>
        <tr>
            <td colspan="4" class="align-left">
                <h4 class=" text-left">
                    5. To‘lov turi: Shartnoma asosida pul o‘tkazish yo‘li bilan .
                </h4>
            </td>
        </tr>
        <tr>
            <td colspan="4" class="align-left">
                <h4 class=" text-left">
                    6. Sertifikatlashtirish uchun talab etiladi: <span id="requirement"></span>
                </h4>
            </td>
        </tr>
    </table>
</div>

<script>
    function printCheque() {
        $('#invoice-cheque').print({
            NoPrintSelector: '.no-print',
            title: '',
        })
    }

    function fillCheque() {
        $('#director-name').text((currentInvoice.director.name.charAt(0)).concat(".",currentInvoice.director.display_name.charAt(0),".",currentInvoice.director.lastname))
        $('#application-date').text(moment(currentInvoice.application.date).format('DD.MM.YYYY'))
        $('#application-year').text(moment(currentInvoice.application.date).format('YYYY'))
        $('#application-month').text(moment(currentInvoice.application.date).format('MM'))
        $('#application-day').text(moment(currentInvoice.application.date).format('DD'))
        $('#application-id').text(currentInvoice.app_id)
        $('#application-organization').text(currentInvoice.application.organization.name)
        $('#crop-name').text(currentInvoice.application.crops.name.name)
        // $('#crop-type').text(currentInvoice.application.crops.type.name)
        $('#crop-party').text(currentInvoice.application.crops.party_number)
        $('#measure-type').text(measure_type)
        $('#crop-amount').text(currentInvoice.application.crops.amount)
        $('#sceme').text(currentInvoice.application.crops.sxeme_number)

        $('#laboratory-address').text(currentInvoice.laboratory.address)
        $('#laboratory-certificate').text(currentInvoice.laboratory.certificate)
        $('#laboratory-name').text(currentInvoice.laboratory.name)

        // $('#nds-name').text(currentInvoice.application.crops.name.nds.name)
        // $('#nds-number').text(currentInvoice.application.crops.name.nds.number)
        // $('#nds-type').text(nds_type)
        $('#nds').text(nds)

        $('#requirement').text(currentInvoice.requirement)
    }
</script>
