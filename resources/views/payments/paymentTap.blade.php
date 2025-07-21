<html>
<head>
    <meta charset="utf-8">
    <title>Payment</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
    <link rel="shortcut icon" href="https://goSellJSLib.b-cdn.net/v2.0.0/imgs/tap-favicon.ico" />
    <link href="https://goSellJSLib.b-cdn.net/v2.0.0/css/gosell.css" rel="stylesheet" />
    <style type="text/css">
        .loader {
            width: 100%;
            height: 100%;
            position: fixed;
            background: rgba(0,0,0,0.5);
            left: 0px;
            top: 0px;
        }
        .lds-dual-ring {
            position: absolute;
            left: 50%;
            top: 50%;
            margin-left: -40px;
            margin-top: -40px;
            display: inline-block;
            width: 80px;
            height: 80px;
        }
        .lds-dual-ring:after {
            content: " ";
            display: block;
            width: 64px;
            height: 64px;
            margin: 8px;
            border-radius: 50%;
            border: 6px solid #fff;
            border-color: #fff transparent #fff transparent;
            animation: lds-dual-ring 1.2s linear infinite;
        }
        @keyframes lds-dual-ring {
          0% {
            transform: rotate(0deg);
          }
          100% {
            transform: rotate(360deg);
          }
        }
    </style>
</head>
<body>
    <script type="text/javascript" src="{{asset('js/jquery-3.7.0.min.js')}}"></script>
    <script type="text/javascript" src="https://goSellJSLib.b-cdn.net/v2.0.0/js/gosell.js"></script>

    <div class="loader">
        <div class="lds-dual-ring"></div>
    </div>

    <div id="root"></div>
    <button id="openPage" style="opacity: 0;"  onclick="goSell.openPaymentPage()">open goSell Page</button>
    <script type="text/javascript">
        // https://www.tap.company/kw/en/developers
        // https://github.com/Tap-Payments/goSell-JSLib-Documentation/blob/master/goSellCheckout/README.md
        // testing cards
        // https://developers.tap.company/reference/testing-cards
        goSell.config({
          containerID: "root",
          gateway: {
            publicKey: "{{$public_key}}",
            merchantId: "{{$merchantID}}",
            language: "en",
            contactInfo: true,
            supportedCurrencies: "all",
            supportedPaymentMethods: "all",
            saveCardOption: false,
            customerCards: true,
            notifications: "standard",
            callback: (response) => {
              console.log("response", response);
            },
            onClose: () => {
              console.log("onClose Event");
            },
            onLoad: () => {
                setTimeout(function() {
                    $(".loader").hide();
                    $("#openPage").click();
                }, 200);
            },
            backgroundImg: {
              url: "imgURL",
              opacity: "0.5",
            },
            labels: {
              cardNumber: "Card Number",
              expirationDate: "MM/YY",
              cvv: "CVV",
              cardHolder: "Name on Card",
              actionButton: "Pay",
            },
            style: {
              base: {
                color: "#535353",
                lineHeight: "18px",
                fontFamily: "sans-serif",
                fontSmoothing: "antialiased",
                fontSize: "16px",
                "::placeholder": {
                  color: "rgba(0, 0, 0, 0.26)",
                  fontSize: "15px",
                },
              },
              invalid: {
                color: "red",
                iconColor: "#fa755a",
              },
            },
          },
          customer: {
            id: null,
            first_name: "{{$first_name}}",
            middle_name: "",
            last_name: "{{$last_name}}",
            email: "{{$email}}",
            phone: {
              country_code: "{{$countryCode}}",
              number: "{{$mobile}}",
            },
          },
          order: {
            amount: {{$total}},
            currency: "KWD",
            items: [
                @foreach($items as $item)
                {
                    id: {{$item['id']}},
                    name: "{{$item['name']}}",
                    quantity: "{{$item['quantity']}}",
                    amount_per_unit: "{{$item['price']}}",
                    total_amount: "{{$item['total']}}",
                },
                @endforeach
            ],
            shipping: null,
            taxes: null,
          },
          transaction: {
            mode: "charge",
            charge: {
              saveCard: false,
              threeDSecure: true,
              // description: "Test Description",
              // statement_descriptor: "Sample",
              // reference: {
              //   transaction: "txn_0001",
              //   order: "ord_0001",
              // },
              hashstring:"",
              metadata: {},
              receipt: {
                email: false,
                sms: true,
              },
              redirect: "{{ url('/register/payment/'. Crypt::encrypt($paymentID)) }}",
              post: null,
            },
          },
        });
    </script>
</body>
</html>