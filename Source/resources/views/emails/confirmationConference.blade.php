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
        }

        .logo {
            width: 200px;
        }

        .footer-logo {
            display: flex;
            gap: 10px
        }

        img[alt="Talland-logo"],
        img[alt="B&B-logo"] {
            width: 100px;
            object-fit: contain;
            margin-top: 15px;
        }
    </style>
</head>

<body>
    <img class="logo" src="{{ asset('storage/logo.jpg') }}" alt="Logo">
    <br><br>
    <p>Heerhugowaard, {{ $mailData['checkInDate'] }}</p>
    <br><br>

    <p>Talland College</p>
    <p>{{ $mailData['firstName'] . ' ' . $mailData['lastName'] }}</p>
    @if (!empty($mailData['phoneNumber']))
        <p>{{ $mailData['phoneNumber'] }}</p>
    @endif
    @if (!empty($mailData['email']))
        <p>{{ $mailData['email'] }}</p>
    @endif

    <br>

    <p>
        Betreft: Bijeenkomst voor {{ $mailData['guestAmount'] }} personen op {{ $mailData['checkInDate'] }}
        <br><br>
        Geachte meneer/mevrouw {{ $mailData['lastName'] }}
        <br><br>
        Naar aanleiding van uw aanvraag stuur ik u de bevestiging voor het verzorgen van een bijeenkomst op
        {{ $mailData['checkInDate'] }} in Bed & Business voor {{ $mailData['guestAmount'] }} personen.
        <br><br>
        Op de volgende pagina vindt u een overzicht van de aangevraagde faciliteiten en het programma.
        <br><br>
        Het bijgaande voorstel is een richtlijn. Mocht u naar aanleiding daarvan nog vragen en/of aanvullende wensen
        hebben,
        dan verneem ik dat graag.
        <br><br>
        Wij kijken ernaar uit u te mogen ontvangen in Bed & Business.
        <br><br><br>

        Met vriendelijke groet,
        <br><br>
        {{ $mailData['causer'] }}
        <br>
        Student manager/ondernemer horecaopleiding
        <br>
        Frontoffice medewerker
        <br><br>
        Bed & Business Talland College
        <br>
        W,M. Dudokweg 45
        <br>
        1703 DA Heerhugowaard
    </p>

    <div style="margin-top:20px; margin-bottom:20px">
        {!! nl2br($mailData['extra_info']) !!}
    </div>

    <div class="footer-logo">
        <img src="{{ asset('storage/talland-logo.png') }}" alt="Talland-logo">
        <img src="{{ asset('storage/logo.jpg') }}" alt="B&B-logo">
    </div>
    <p>072-5476270</p>
    <a href="mailto:Bed-business@talland.nl">Bed-business@talland.nl</a>
    <br><br>
    <p><i>
            De parkeerfaciliteiten bij Bed & Business zijn beperkt. Wij verzoeken u vriendelijk om voor bijeenkomsten
            zoveel mogelijk samen te reizen. Achter het Talland College aan de Umbrielaan (via Westtangent) is voldoende
            parkeergelegenheid en slechts 10 minuten lopen naar Bed & Business.
        </i></p>
</body>

</html>
