@extends('layouts.html-layout')

@section('title', 'User')
@section('content')

    <form id="payment-form">

        <div id="google-pay-button"></div>
        <div id="card-container"></div>
        <button id="card-button" type="button">Pay $1.00</button>

    </form>
    <div id="payment-status-container"></div>

    <script src="https://pay.google.com/gp/p/js/pay.js"></script>
    <script type="module">

        const appId = {{ env('SQUARE_APP_ID', null)}};
        const locationId = {{ env('SQUARE_LOCATION_ID', null)}};
        const payments = Square.payments(appId, locationId);


        const paymentRequest = payments.paymentRequest((

            countryCode: 'ES',
            currencyCode: 'EUR',
            total: {

                amount: '1.00',
                label: 'Total'

            }

        ));

        const googlePay = await payments.googlePay(paymentRequest);

        await googlePay.attach('#google-pay-button');

    </script>

@endsection
