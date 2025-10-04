<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            padding-left: 30px;
            padding-right: 30px;
        }

        .logo {
            width: 300px;
            margin-top: 20px;
            margin-bottom: 80px;
        }

        .flex {
            display: flex;
        }

        .flex-col {
            flex-direction: column
        }

        .justify-between {
            justify-content: space-between;
        }

        .justify-center {
            justify-content: center;
        }

        .items-center {
            align-items: center;
        }

        .bg-lightgray {
            background-color: rgb(206, 206, 206)
        }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        footer {
            width: 100%;
            margin-top: 70px
        }

        .mt-50 {
            margin-bottom: 50px
        }

        .text-bold {
            font-weight: 600;
        }
    </style>
</head>

<body>
    <div class="flex justify-center">
        <img class="logo" src="{{ asset('storage/talland-logo.png') }}" alt="Talland logo">
    </div>

    <div class="flex justify-between mt-50">
        <div>
            <p>{{ $mailData['firstName'] . ' ' . $mailData['lastName'] }}</p>
        </div>

        <div>
            <p>
                Bed & Business Talland Collegebr>
                W.M Dudokweg 45<br>
                1703 DA Heerhugowaard<br>
                +31725476270<br>
                bed-business@talland.nl<br>
                <a href="https://bedenbusiness.nl/">https://bedenbusiness.nl/</a>
            </p>
        </div>
    </div>

    <div>
        <p>{{ $mailData['firstName'] . ' ' . $mailData['lastName'] }},</p>
        <br><br>
        <p>Met veel plezier bevestigen we uw reservering als volgt:</p>
        <br><br>

        <table>
            <tr class="bg-lightgray text-bold">
                <th>Aankomst</th>
                <th>Vertrek</th>
                <th>Nachten</th>
                <th>Kamertype</th>
                <th>Prijs</th>
            </tr>
            <tr>
                <td>{{ $mailData['checkInDate'] }}</td>
                <td>{{ $mailData['checkOutDate'] }}</td>
                <td>{{ $mailData['nights'] }}</td>
                <td>{{ $mailData['roomType'] }}</td>
                <td>€{{ $mailData['roomPrice'] }}</td>
            </tr>
        </table>
    </div>

    <div style="margin-top: 70px">
        <p>
            Hartelijk dank voor uw reservering. We begroeten u graag in ons hotel.
            <br><br>
            Mocht u verder nog vragen hebben of extra's toe willen voegen aan uw reservering, neemt u dan gerust contact
            met ons op.
            <br><br><br>
            Met hartelijke groet,
            <br>
            Bed & Business Talland College
        </p>
    </div>

    <footer class="flex flex-col items-center">
        <b>Bed & Business Talland College</b><br>
        <p><b>Bankgegevens:</b> IBAN: NL83INGB0005302195 | SWIFT/BIC: INGBNL2A</p><br>
        <p><b>KvK:</b> Talland College, (Bed & Business) | 41241789</p><br>
        <p><b>Btw-nummer:</b> NL805459418B01</p><br>
        <b>Op al onze diensten zijn de
            <a href="https://cdn.khn.nl/media/Tools/UVH/uniforme-voorwaarden-horeca-nederlands.pdf">
                Uniforme Voorwaarden Horeca (UVH)
            </a> van toepassing.</b><br>
    </footer>
</body>

</html>
