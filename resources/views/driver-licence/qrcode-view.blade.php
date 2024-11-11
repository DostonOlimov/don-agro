<style>
    body{
        font-family: Arial;
    }
    .page_header {
        display: flex;
        flex-direction: row;
        margin-bottom: 25px;
        align-items: center;
        justify-content: center;
        padding: 15px;
        box-shadow: rgba(0, 0, 0, 0.04) 0px 3px 5px;
    }

    .inform_part {
        padding-bottom: 15px;
        position: relative;
    }

    .transparent_img {
        width: 300px;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        opacity: 0.2;
    }

    .flex_card {
        display: flex;
        flex-direction: row;
        margin-bottom: 10px;
    }

    .text_class {
        width: 50%;
        border-bottom: 1px solid grey;
        margin: 7px;
        padding: 5px;
        text-align: left;
    }

    .text_class_category {
        width: 50%;
        border-bottom: 1px solid grey;
        margin: 7px;
        padding: 5px;
        text-align: left;
    }

    .badge-success {
        color: #fff;
        background-color: #28a745;
        padding: 5px;
        border-radius: 7px;
    }

    .badge-danger {
        color: #fff;
        background-color: red;
        padding: 5px;
        border-radius: 7px;
    }

    .status_icon {
        font-weight: bold;
        font-size: 20px;
        margin-left: 60px;
    }

    p {
        font-size: 9px;
        font-weight: bold;
        font-family: "Montserrat", sans-serif;
        position: absolute;
    }
</style>
<div class="container-fluid" style="background-color: #fff">
    <div class="page_header">
        <div>
            <img
                style="width: 145px"
                src="https://upload.wikimedia.org/wikipedia/commons/thumb/7/77/Emblem_of_Uzbekistan.svg/800px-Emblem_of_Uzbekistan.svg.png"
            />
        </div>
        <div style="margin-left: 30px; text-align: center; margin-bottom: 10px">
            <div style="font-size: 22px">
                O'ZBEKISTON RESPUBLIAKSI QISHLOQ XO'JALIGI VAZIRLIGI HUZURIDAGI<br/>AGROSANOAT
                MAJMUI USTIDAN NAZORAT QILISH INSPEKSIYASI
            </div>
            <div style="font-size: 18px">
                100020, Toshkent shahri, Obinazir ko'chasi, 109-uy. Tel: (998 71)
                202-12-01; Fax: (998 71) 202-12-01
            </div>
            <div style="color: blue; font-size: 18px">
                e-mail: info@agroin.uz, agroinspeksiya@exat.uz, www.agroinspeksiya.uz
            </div>
        </div>
    </div>
    <div style="color: black" class="inform_part">
        <img
            class="transparent_img"
            src="https://api.tm.uzagroteh.uz/media/images/files/license/ff808181861aafbd71889e99.png"
        />
        <div style="margin: 7px; font-size: 25px; color: black; font-weight: bold; text-align: center;">
            <i class="fas fa-user" style="margin-right: 15px"></i
            ><span>Guvohnoma:</span>
        </div>
        <div style="display: flex; flex-direction: row">
            <div class="text_class">
                <b>Seriya raqam: </b>{{ $data->license_num }}
            </div>
            <div class="text_class">
                <b>Holati: </b>
                <span
                    class="{{$data->state==2 ? 'status_icon badge badge-success' : 'status_icon badge badge-danger'}}">
                    {{ $data->state == 2 ? "Faol" : "Faolmas" }}</span>
            </div>
        </div>
        @foreach($licences as $licence)
            <div style="display: flex; flex-direction: row">
                <div class="text_class_category">
                    <b>Toifa: </b>{{ $licence->name }}
                </div>
                <div class="text_class_category">
                    <b>Berilgan sana: </b>{{ $licence->given_date }}
                </div>
            </div>
        @endforeach
        <div style="margin: 20px 7px 7px 7px;
          font-size: 25px;
          color: black;
          font-weight: bold;
          text-align: center;">
            <i class="fas fa-address-card" style="margin-right: 15px"></i
            ><span>Egasi haqida ma'lumotlar:</span>
        </div>
        <div class="flex_card">
            <div class="text_class">
                <b>Egasining ismi: </b>{{ $data->full_name }}
            </div>
            <div class="text_class">
                <b>Tug'ilgan sana: </b>{{ $data->birth_date }}
            </div>
        </div>
        <div class="flex_card">
            <div class="text_class">
                <b>Viloyat: </b>{{ $data->region }}
            </div>
            <div class="text_class">
                <b>Tuman/Shahar: </b>{{ $data->district }}
            </div>
        </div>
        <div class="flex_card">
            <div class="text_class">
                <b>JS SHIR: </b
                >{{ $data->pinfl ? $data->pinfl : "-" }}
            </div>
            <div class="text_class">
                <b>Pasport ma'lumoti: </b>{{ $data->passport }}
            </div>
        </div>
    </div>
</div>

