<div id="invoice-cheque" class="invoice-cheque" >
    <img class="background_image" src="{{ asset('/img/dashboard/dm_logo.jpg') }}" alt="Background Image">

    <div class="content">
        @if(!isset($t))
            <div class="container head_image" >
                <img src="{{ public_path('/img/dashboard/t1.jpg') }}" alt="image" >
            </div>
        @else
            <div class="container head_image"  style="max-width:100%; height: 70px; padding:200px; 100px;" >
                <img src="{{ asset('/img/dashboard/t1.jpg') }}" alt="image" >
            </div>
        @endif

        <div class="header__title">O‘ZBEKISTON RESPUBLIKASI VAZIRLAR MAHKAMASI HUZURIDAGI
            AGROSANOAT MAJMUI USTIDAN NAZORAT QILISH INSPEKSIYASI
            QOSHIDAGI “QISHLOQ XO‘JALIGI MAHSULOTLARI SIFATINI
            BAHOLASH MARKAZI” DAVLAT MUASSASASI
        </div>

        <div class="analysis-section">
            <div class="section-title">DON SAQLASH SIG'IMLARINI BAHOLASH XULOSASI - {{$test->number}}</div>

            <table>
                <tr>
                    <td class="bold">Berilgan sanasi:</td>
                    <td>{{ $givenDate }} yil</td>
                    <td class="bold">Amal qilish sanasi:</td>
                    <td>{{ $validDate }}</td>
                </tr>
            </table>
            <table>
                <tr>
                    <td class="bold">Don saqlash sig'imlari turi:</td>
                    <td colspan="2" class="">{{ \App\Models\StorageCapacityConclusion::getType($test->type) }}</td>
                </tr>
                <tr>
                    <td class="bold">Don saqlash sig'imlari hajmi:</td>
                    <td colspan="2" class="">{{ $test->capacity .' ' . \App\Models\StorageCapacityConclusion::getMeasureType($test->measure_type) }}</td>
                </tr>
                <tr>
                    <td class="bold">Korxona nomi:</td>
                    <td colspan="2" class="defavu_font">{{ optional($test->organization)->name }}</td>
                </tr>
                <tr>
                    <td class="bold">Korxona manzili:</td>
                    <td colspan="2" class="defavu_font">{{ optional($test->organization)->full_address }}</td>
                </tr>
            </table>
        </div>
            <div class="analysis-section">
                <div class="section-title">Xulosa quyidagi hujjatlar asosida berildi</div>
                <table>
                    @foreach($test->documents as $document)
                        <tr>
                            <td class="bold">Hujjat berilgan:</td>
                            <td>{{ $document->getTypeByRegion() }}</td>
                            <td class="bold">Hujjat nomi:</td>
                            <td>{{ $document->name }}</td>
                            <td class="bold">Hujjat raqami:</td>
                            <td>{{ $document->number }}</td>
                            <td class="bold">Hujjat sanasi:</td>
                            <td>{{ $document->date }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>

        <div class="analysis-section">
            <table>
                <tr>
                    <td colspan="4"><b>Alohida yozuvlar:</b><span style="font-family: DejaVuSans; font-size: 12px;">
                        {{ $test->comment }}</span></td>

                </tr>
                <tr>
                    <td colspan="3">
                        <b>Masul xodim:</b>
                        <b>Direktor o'rinbosari:</b>
                            Sh.Pazilov
                        <br>
                        <b>Ijrochi:</b>
                            {{ substr($test->user->name, 1, 1) == 'h' ? substr($test->user->name, 0, 2) : substr($test->user->name, 0, 1) }}.
                            {{ $test->user->lastname }}
                    </td>
                    <td style="text-align: right; padding-right: 10px;"> @if(isset($t))<img src="data:image/png;base64,{{ $qrCode }}" style="height: 90px;" alt="QR Code">@endif</td>
                </tr>
            </table>
        </div>

    </div>
</div>
