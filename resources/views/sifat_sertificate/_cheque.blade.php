
<div class="border-image">
    <img src="{{ asset('/img/dashboard/bg_don2.jpg') }}" alt="">
</div>
<div id="invoice-cheque" class="py-4 col-12 invoice-cheque ">
    <div class="content">
        <div class="head_image">
            <img src="{{ asset('/img/dashboard/gerb_bg.png') }}" alt="image">
        </div>

        <h2 class="header__title">
            <div style="font-family: serif">
                O‘zbekiston Respublikasi Vazirlar Mahkamasi huzuridagi Agrosanoat majmui ustidan nazorat qilish<br> Inspeksiyasi
                qoshidagi “Qishloq xo'jaligi mahsulotlari sifatini baholash markazi” davlat muassasasi<br>
            </div>
            <div style="padding-top:2px;font-size: 11px">
                Государственное учреждение «Центр оценки качества сельскохозяйственной продукции» <br>при Инспекции по
                контролю за агропромышленным комплексом при Кабинете Министров <br> Республики Узбекистан <br>
            </div>
            <div style="padding-top:2px;font-family: serif">
                State company “Center for evaluation of the quality of agricultural products” under the Inspectionon the control of<br>
                agro-industrial complex under the Cabinet of Ministers of the Republic of Uzbekistan
            </div>
        </h2>

        <h1 class="main__title" style="font-size: 14px">
            SIFAT SERTIFIKATI <br>СЕРТИФИКАТ КАЧЕСТВА / CERTIFICATE OF QUALITY
        </h1>
        {{-- <h2 class="header__intro" style="font-weight: bold;">Reestr raqami: {{ $app->prepared->region->series }}{{ $sert_number }}</h2>--}}
        {{-- @else--}}
        {{-- <h1 class="header__intro text-center" style="color:#f3775b; font-size: 24px"><b>Nomuvofiqlik bayonnomasi</b></h1>--}}
        {{-- @endif--}}
        <div class="main__section">
            <div class="row__section">
                <div class="row__items">
                    <span class="row__labels">Berildi<br> Выдан /Issued</span>
                </div>
                <div class="row__notes">
                    <span style="font-weight: bold">{{$formattedDate}} yilda/года/year </span>
                </div>
                <div class="row__notes" style="width: 45%; text-align: center;">
                    <span style="font-weight: bold">@if(isset($sert_number)) S1-{{optional(optional($app->user)->region)->series}}-25/{{substr($sert_number, 2)}} @endif</span>
                </div>
            </div>

            <div class="row__section">
                <div class="row__items" style="padding-right: 20px;">
                    <span class="row__labels">DON TURI<br> Род зерна /Type of grain</span>
                </div>
                <div class="row__notes" style="width: 60%;">
                    <span style="font-weight: bold">{{$app->crops->name->name}} - {{ optional($nds)->name }} </span>
                </div>
            </div>

            {{-- <h2 class="main__intro"><b>KOD TN VED :</b> {{$app->crops->name->kodtnved}}</h2>--}}
            <div class="row__section">
                <div class="row__notes">
                    <span class="row__labels">KELIB CHIQISHI<br> Происхождение / Origin</span>
                </div>
                <div class="row__notes">
                    <span style="font-weight: bold">{{$app->crops->country->name}}</span>
                </div>
                <div class="row__items">
                    <span class="row__labels">HOSIL<br> Урожай / Harvest</span>
                </div>
                <div class="row__items">
                    <span style="font-weight: bold">{{$app->crops->year }} yil</span>
                </div>
            </div>
            {{-- line 3 data about transport--}}
            <div class="row__section">
                <div class="row__items">
                    <span class="row__labels">TRANSPORT TURI <br> Вид транспорта <br> Type of transport<br> </span>
                </div>
                <div class="small__row__items">
                    <span style="font-weight: bold" >{{ optional($app->client_data)->transport_type == 1 ? 'vagon' : 'avtotransport' }}</span>
                </div>
                <div class="small__row__items" style="width: 8%">
                    <span class="row__labels">№</span>
                </div>
                <div class="row__notes" style="width: 55%">
                    <span  style="font-weight: bold">{{ str_replace(',', ', ', optional($app->client_data)->vagon_number)  }}</span>
                </div>
            </div>
            {{-- 4 line data about yuk--}}
            <div class="row__section">
                <div class="row__items" style="width: 12%">
                    <span class="small__row__items">YUK XATI №№ <br> Накладная <br>Invoice<br></span>
                </div>
                <div class="small__row__items" style="width: 38%">
                    <span  style="font-weight: bold">{{ str_replace(',', ', ', optional($app->client_data)->yuk_xati)  }}</span>
                </div>
                <div class="row__items" style="width: 16%" >
                    <span class="row__labels">JOYLAR SONI <br> Количество мест <br> Number of seats<br></span>
                </div>
                <div class="small__row__items"  style="width: 10%">
                    <span  style="font-weight: bold">{{ optional($app->crops)->joy_soni }}</span>
                </div>
                <div class="row__items" style="width: 8%">
                    <span class="row__labels">VAZNI <br> Вес <br> Weight<br></span>
                </div>
                <div class="small__row__items" style="width: 12%">
                    <span  style="font-weight: bold">{{ optional($app->crops)->amount }} kg</span>
                </div>
            </div>
            {{-- 5- line data about sender--}}
            <div class="row__section">
                <div class="row__items">
                    <span class="row__labels">JO‘NATUVCHI <br> Отправитель /Sender <br></span>
                </div>
                <div class="row__notes">
                    <span  style="font-weight: bold">{{ optional($app->client_data)->sender_name }}</span>
                </div>
                <div class="row__items">
                    <span class="row__labels">OLUVCHI <br> Получатель /Recipient<br></span>
                </div>
                <div class="row__notes">
                    <span  style="font-weight: bold">{{ optional($app->organization)->name }}</span>
                </div>
            </div>
            {{-- 6- line data about address--}}
            <div class="row__section">
                <div class="row__notes">
                    <span class="row__labels">MANZILI <br> Местонахождение предприятия <br> Location of the company<br></span>
                </div>
                <div class="row__items">
                    <span  style="font-weight: bold">{{ optional($app->client_data)->sender_address }}</span>
                </div>
                <div class="row__items">
                    <span class="row__labels">MANZILI <br> Адрес получателя <br> Recipient's address <br></span>
                </div>
                <div class="row__notes">
                    <span  style="font-weight: bold">{{ optional($app->organization)->full_address }}</span>
                </div>
            </div>

            {{-- 7- line data about stations--}}
            <div class="row__section">
                <div class="row__items">
                    <span class="row__labels">JO‘NATISH STANSIYASI <br>Станция отправителя <br>Sender's station <br></span>
                </div>
                <div class="row__notes">
                    <span  style="font-weight: bold">{{ optional($app->client_data)->sender_station }}</span>
                </div>
                <div class="row__notes">
                    <span class="row__labels">OLUVCHINING STANSIYASI (porti) <br>Станция назначения<br> Destination station<br></span>
                </div>
                <div class="row__items">
                    <span  style="font-weight: bold">{{ optional($app->client_data)->reciever_station }}</span>
                </div>
            </div>
            {{-- 8- line data about company marker--}}
            <div class="row__section">
                <div class="row__items" style="width: 50%">
                    <span class="row__labels">KORXONANING TAMG‘ASI <br> Маркировка предприятия /Marking of the enterprise <br></span>
                </div>
                <div class="row__notes">
                    <span  style="font-weight: bold"> {{ \App\Models\ClientData::getMarkerExist( optional($app->client_data)->company_marker ) }}</span>
                </div>
            </div>

            <h1 class="main__title">
                SIFAT KO‘RSATKICHLARI<br>
                ПОКАЗАТЕЛИ КАЧЕСТВА /QUALITY INDICATORS<br>
            </h1>
            {{-- 1 line sifat ko'rsatkichalari--}}
            <div class="row__section">
                <div class="small__row__items">
                    <span class="row__labels">SINFI <br> Класс /Class <br> </span>
                </div>
                <div class="small__row__items">
                    <span  style="font-weight: bold">{{ optional(optional($app->crops)->type)->name }} </span>
                </div>
                <div class="small__row__items">
                    <span class="row__labels">TURI <br> Тип /Type<br></span>
                </div>
                <div class="small__row__items">
                    <span  style="font-weight: bold"> @if(optional($app->laboratory_result)->type) {{ \App\Models\LaboratoryResult::getType(optional($app->laboratory_result)->type) }} @endif </span>
                </div>
                <div class="row__items">
                    <span class="row__labels">KICHIK TURI <br> Подтип /Subtype<br></span>
                </div>
                <div class="small__row__items">
                    <span  style="font-weight: bold">{{ optional($app->laboratory_result)->subtype }} </span>
                </div>
            </div>
            {{-- 2 line sifat ko'rsatkichalari--}}
            <div class="row__section">
                <div class="row__items">
                    <span class="row__labels">HAJMIY OG‘IRLIGI <br> Натура /Nature<br></span>
                </div>
                <div class="small__row__items">
                    <span  style="font-weight: bold">{{ optional($app->laboratory_result)->nature }} г/л</span>
                </div>
                <div class="row__items">
                    <span class="row__labels">NAMLIGI <br> Влажность /Humidity<br></span>
                </div>
                <div class="small__row__items"  style="width: 8%">
                    <span  style="font-weight: bold">{{ optional($app->laboratory_result)->humidity }} % </span>
                </div>
                <div class="row__notes">
                    <span class="row__labels">TUSHISH SONI <br> Число падений /Number of falls<br></span>
                </div>
                <div class="small__row__items" style="width: 8%">
                    <span  style="font-weight: bold">{{ optional($app->laboratory_result)->falls_number }} sec </span>
                </div>
            </div>

            {{-- 3 line sifat ko'rsatkichalari--}}
            <div class="row__section" style="padding-top:7px;">
                <div class="row__notes">
                    <span class="row__labels">KLEYKOVINANING VAZN ULUSHI<br> Массовая доля клейковины <br> Mass fraction of gluten</span>
                </div>
                <div class="small__row__items">
                    <span  style="font-weight: bold">{{ optional($app->laboratory_result)->kleykovina }} % </span>
                </div>
                <div class="small__row__items" style="width: 20%">
                    <span class="row__labels">SIFATI <br> Качество /Quality</span>
                </div>
                <div class="small__row__items" style="width: 9%">
                    <span  style="font-weight: bold">{{ optional($app->laboratory_result)->quality }} </span>
                </div>
                <div class="small__row__items" style="width: 18%">
                    <span class="row__labels">Guruh <br>Группа /Group</span>
                </div>
                <div class="small__row__items" style="width: 9%">
                    <span  style="font-weight: bold">@if(optional($app->laboratory_result)->class){{ \App\Models\LaboratoryResult::getGroup(optional($app->laboratory_result)->class) }} @endif</span>
                </div>
            </div>
            {{-- 4 line sifat ko'rsatkichalari--}}
            <div class="row__section" style="padding-top:0 !important; margin-top:0;">
                <div class="small__row__items" style="text-align: center; vertical-align: center">
                    <span  style="font-weight: bold">{{ optional($app->laboratory_result)->elak_number }}</span>
                </div>
                <div class="row__items" style="width: 50%">
                    <span class="row__labels">raqamli ELAKDAN O’TISH <br>Проход через сита размером /Pass through sieves</span>
                </div>
                <div class="small__row__items" style="vertical-align: center">
                    <span  style="font-weight: bold">{{ optional($app->laboratory_result)->elak_result}} </span>
                </div>
            </div>
            {{-- line sifat ko'rsatkichalari--}}
            <div class="row__section">
                <div class="row__items" style="width: 49%">
                    <span class="row__headers">DONNI IFLOSLANTIRUVCHI ARALASHMALAR<br>Сорная примесь /Weed impurity</span>
                </div>
                <div class="row__items" style="width: 49%">
                    <span class="row__headers">DONLI ARALASHMALAR<br>Зерновая примесь /Grain admixture</span>
                </div>
            </div>
            {{-- 6 line sifat ko'rsatkichalari--}}
            <div class="row__section" style="padding: 0">
                <div class="row__items">
                    <span class="row__labels">JAMI<br> Всего /Total</span>
                </div>

                <div class="small__row__items" style="width: 8%">
                    @if(isset($result_data1[0]))
                        <span  style="font-weight: bold">{{ optional($result_data1[0])->value }} %</span>
                    @endif
                </div>
                <div class="row__items">
                    <span class="row__labels">shu jumladan:<br>в том числе /including</span>
                </div>
                <div class="row__items">
                    <span class="row__labels">JAMI<br> Всего /Total </span>
                </div>

                <div class="small__row__items" style="width: 8%">
                    @if(isset($result_data2[0]))
                        <span  style="font-weight: bold">{{ optional($result_data2[0])->value }} %</span>
                    @endif
                </div>
                <div class="row__items">
                    <span class="row__labels">shu jumladan:<br>в том числе /including</span>
                </div>
            </div>
            {{-- 6 line sifat ko'rsatkichalari--}}
            <div class="row__section" style="padding: 0">
                <div class="row__items">
                    <span class="row__labels">Ma'danli <br>минеральная /mineral</span>
                </div>
                <div class="small__row__items" style="width: 8%">
                    @if(isset($result_data1[1]))
                        <span  style="font-weight: bold">{{ optional($result_data1[1])->value }} %</span>
                    @endif
                </div>

                <div class="row__items"></div>
                <div class="row__items">
                    @if(isset($result_data2[1]))
                        <span class="row__labels">{{ optional($result_data2[1])->name }} </span>
                    @endif
                </div>
                <div class="small__row__items" style="width: 8%">
                    @if(isset($result_data2[1]))
                        <span  style="font-weight: bold" class="row__labels">{{ optional($result_data2[1])->value }} %</span>
                    @endif
                </div>
                <div class="row__items"></div>
            </div>
            {{-- 6 line sifat ko'rsatkichalari--}}
            <div class="row__section" style="padding: 0">
                <div class="row__items">
                    <span class="row__labels">Zararli <br>вредная /harmful</span>
                </div>
                <div class="small__row__items" style="width: 8%">
                    @if(isset($result_data1[2]))
                        <span  style="font-weight: bold">{{ optional($result_data1[2])->value }} %</span>
                    @endif
                </div>
                <div class="row__items"></div>
                <div class="row__items">
                    @if(isset($result_data2[2]))
                        <span class="row__labels">{{ optional($result_data2[2])->name }} </span>
                    @endif
                </div>
                <div class="small__row__items" style="width: 8%">
                    @if(isset($result_data2[2]))
                        <span  style="font-weight: bold" class="row__labels">{{ optional($result_data2[2])->value }} %</span>
                    @endif
                </div>
                <div class="row__items"></div>
            </div>
            {{-- 6 line sifat ko'rsatkichalari--}}
            <div class="row__section" style="padding: 0">
                <div class="row__items">
                    @if(isset($result_data1[3]))
                        <span class="row__labels">{{ optional($result_data1[3])->name }}<br></span>
                    @endif
                </div>
                <div class="small__row__items" style="width: 8%">
                    @if(isset($result_data1[3]))
                        <span  style="font-weight: bold">{{ optional($result_data1[3])->value }} %</span>
                    @endif
                </div>
                <div class="row__items"></div>

                <div class="row__items">
                    @if(isset($result_data2[3]))
                        <span class="row__labels">{{ optional($result_data2[3])->name }} </span>
                    @endif
                </div>
                <div class="small__row__items" style="width: 8%">
                    @if(isset($result_data2[3]))
                        <span  style="font-weight: bold" class="row__labels">{{ optional($result_data2[3])->value }} %</span>
                    @endif
                </div>
                <div class="row__items"></div>
            </div>
            {{-- 6 line sifat ko'rsatkichalari--}}
            <div class="row__section" style="padding: 0">
                <div class="row__notes" style="width:75%">
                    <span class="row__labels">{{ optional($director)->name}} boshlig'i :{{ optional(optional($director)->director)->lastname. ' '. optional(optional($director)->director)->name }}</span>
                </div>

                <div class="row__notes" style="width:20%; text-align: center">
                    @if(!isset($t))
                    <img style="height: 60px;" alt="QR Code" src="data:image/png;base64,{{ $qrCode }}"><br>
                    @endif
                </div>

            </div>
        </div>
    </div>
</div>

