
<?php


setlocale(LC_TIME, "fr_FR", "French");
$date = strftime("%d %B %Y");

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Example 1</title>

    <style>
        .clearfix:after {
            content: "";
            display: table;
            clear: both;
        }

        a {
            color: #5D6975;
            text-decoration: underline;
        }

        body {
            position: relative;
            width: 18cm;
            height: 28cm;
            margin: 0 auto;
            color: #001028;
            background: #FFFFFF;
            font-family: Arial, sans-serif;
            font-size: 12px;
            font-family: Arial;
        }

        header {
            padding: 10px 0;
            margin-bottom: 30px;
        }

        #logo {
            text-align: center;
            margin-bottom: 10px;
        }

        #logo img {
            width: 90px;
        }

        h1 {
            border-top: 1px solid  #5D6975;
            border-bottom: 1px solid  #5D6975;
            color: #5D6975;
            font-size: 2.4em;
            line-height: 1.4em;
            font-weight: normal;
            text-align: center;
            margin: 0 0 20px 0;
        }

        #project {
            float: left;
        }

        #project span {
            color: #5D6975;
            text-align: right;
            width: 52px;
            margin-right: 10px;
            display: inline-block;
            font-size: 0.8em;
        }

        #company {
            text-align: right;
        }

        #project div,
        #company div {
            white-space: nowrap;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            margin-bottom: 20px;
        }

        table tr:nth-child(2n-1) td {
            background: #F5F5F5;
        }

        table th,
        table td {
            text-align: center;
        }

        table th {
            padding: 5px 20px;
            color: #5D6975;
            border-bottom: 1px solid #C1CED9;
            white-space: nowrap;
            font-weight: normal;
        }

        table .service,
        table .desc {
            text-align: left;
        }

        table td {
            padding: 20px;
            text-align: right;
        }

        table td.service,
        table td.desc {
            vertical-align: top;
        }

        table td.unit,
        table td.qty,
        table td.total {
            font-size: 1.2em;
        }

        table td.grand {
            border-top: 1px solid #5D6975;;
        }

        #notices .notice {
            color: #5D6975;
            font-size: 1.2em;
        }

        footer {
            color: #5D6975;
            width: 100%;
            height: 30px;
            position: absolute;
            bottom: 0;
            border-top: 1px solid #C1CED9;
            padding: 8px 0;
            text-align: center;
        }

        tr.reduction{
            border-top: 1px solid #000;
        }
    </style>

</head>
<body>
<header class="clearfix">
    <div id="logo">

    </div>
    <h1>INVOICE 3-2-1</h1>
    <div id="company" class="clearfix">
        <div>Work'n Share</div>
        <div>35 Rue de Bourbon,<br /> 75004 Paris, France</div>
        <div>01 23 45 67 89</div>
        <div><a href="/contact">contact@worknshare.com</a></div>
    </div>
    <div id="project">
        <div><span>CLIENT</span> {{ $user->first_name }} {{ $user->last_name }}</div>
        <div><span>ADRESSE</span>{{ $user->address }}</div>
        <div><span>EMAIL</span> <a href="mailto:{{ $user->email }}">{{ $user->email }}</a></div>
        <div><span>DATE</span> <?= $date ?></div>
    </div>
</header>
<main>
    <table>
        <thead>
        <tr>
            <th class="service">SERVICE</th>
            <th class="desc"></th>
            <th>PRIX</th>
            <th>QUANTITE</th>
            <th>TOTAL</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td class="service">Heures consommées</td>
            <td class="desc"></td>
            <td class="unit">$40.00</td>
            <td class="qty">26</td>
            <td class="total">$1,040.00</td>
        </tr>

        <tr>
            <td class="service"></td>
            <td class="desc"></td>
            <td class="unit"></td>
            <td class="qty"></td>
            <td class="total"></td>
        </tr>

        <tr>
            <td class="service"></td>
            <td class="desc"></td>
            <td class="unit"></td>
            <td class="qty"></td>
            <td class="total"></td>
        </tr>

        <tr>
            <td class="service"></td>
            <td class="desc"></td>
            <td class="unit"></td>
            <td class="qty"></td>
            <td class="total"></td>
        </tr>

        <tr class="reduction">
            <td colspan="4">REDUCTIONS</td>
            <td class="total">$5,200.00</td>
        </tr>
        <tr>
            <td colspan="4">SOUS-TOTAL</td>
            <td class="total">$5,200.00</td>
        </tr>
        <tr>
            <td colspan="4">TAXES</td>
            <td class="total">$1,300.00</td>
        </tr>
        <tr>
            <td colspan="4" class="grand total">TOTAL</td>
            <td class="grand total">$6,500.00</td>
        </tr>
        </tbody>
    </table>
    <div id="notices">
        <div>NOTICE:</div>
        <div class="notice">Si jamais la demande de facture ne vient pas de vous, veuillez contacter nos services.</div>
    </div>
</main>
<footer>
    La facture a été créé par un ordinateur et est valide sans la signature ni le cachet.
</footer>
</body>
</html>