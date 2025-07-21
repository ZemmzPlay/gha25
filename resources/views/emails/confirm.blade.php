<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title></title>

  <style type="text/css">
    .main-title
    {
      font-size: 3rem;
      color: #3EA651;
      font-weight: 700;
    }
    .text-gray
    {
      color: #6e667b;
    }
    .info-title
    {
      background-color: #3EA651;
      color: #ffffff;
      padding: 10px;
    }
    .info
    {
      background-color: #e5f6ec;
      padding: 10px;
    }
  </style>
</head>
<body style="background-color: #eceff3; font-family: arial;">
  <div style="width: 50%; background-color: #ffffff; margin: 0 auto; margin-top: 5rem; padding: 50px;">
    {{-- {!! $qrcode !!} --}}
    {{-- <img src="{{ QrCode::format('png')->generate('Embed me into an e-mail!') }}"> --}}
    <img src="{!!$message->embedData($qrCode, 'QrCodeCheckIn.png', 'image/png')!!}">
    {{-- <table>
      <tbody>
        <tr>
          <td>
            <div>
              <img src="{{asset('images/GHA-emailAsset3.png')}}" style="margin: 0 auto;">
            </div>
          </td>
        </tr>
        <tr>
          <td style="padding: 20px 0;">
            <label class="main-title">Registration Confirmation</label>
          </td>
        </tr>
        <tr>
          <td style="font-size: 2rem;">Dear <strong>{{ $registration->first_name }}!</strong></td>
        </tr>
        <tr>
          <td class="text-gray" style="padding: 20px 0;">
            We are pleased to welcome you to the 15th Gulf Heart Association Meeting in Collaboration with the Kuwait Heart Foundation held in Kuwait on December 13-16 2023.
          </td>
        </tr>
        <tr>
          <td class="text-gray" style="padding: 20px 0;">
            The meeting will be held at the Grand Hyatt Hotel, Kuwait. <a href="https://www.google.com/maps/place/The+Regency+Kuwait/@29.316642,48.0869963,17z/data=!3m1!4b1!4m5!3m4!1s0x3fcf75fd1fddcdcd:0xa103f04ef540450f!8m2!3d29.316642!4d48.089185?shorturl=1" style="color: #3EA651;">Click here</a> to get directions to the venue.
          </td>
        </tr>
        <tr>
          <td class="text-gray" style="">
            You can find your registration details below:
          </td>
        </tr>
        <tr>
          <td class="text-gray" style="padding: 20px 0;">
          </td>
        </tr>
        <tr>
          <td>
            <div>
              <table width="">
                <tbody>
                  <tr>
                    <td class="info-title" width="20%">
                      Name:
                    </td>
                    <td class="info" style="">
                      {{ $registration->first_name . ' ' . $registration->last_name }}
                    </td>
                  </tr>
                  <tr>
                    <td class="info-title" width="20%">
                      Email:
                    </td>
                    <td class="info" style="">
                      {{ $registration->email }}
                    </td>
                  </tr>
                  <tr>
                    <td class="info-title" width="20%">
                      Phone:
                    </td>
                    <td class="info" style="">
                      {{ $registration->mobile }}
                    </td>
                  </tr>
                  <tr>
                    <td class="info-title" width="20%">
                      Conference ID:
                    </td>
                    <td class="info" style="">
                      {{ str_pad($registration->id, 6, '0', STR_PAD_LEFT) }}
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
        </td>
        </tr>
      </tbody>
    </table> --}}

  </div>
</body>
</html>