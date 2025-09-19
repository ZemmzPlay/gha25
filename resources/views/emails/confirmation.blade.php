<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Thank You for Registering</title>

  <style type="text/css">
    body {
      margin: 0;
      padding: 0;
      background-color: #f4f4f4;
      font-family: Arial, sans-serif;
      line-height: 1.6;
    }

    .email-container {
      max-width: 600px;
      width: 100%;
      margin: 0 auto;
      background-color: #ffffff;
      padding: 20px;
    }

    .header {
      text-align: center;
      margin-bottom: 30px;
      padding-bottom: 20px;
      border-bottom: 2px solid #4779A9;
    }

    .header h1 {
      color: #4779A9;
      font-size: 24px;
      margin: 0;
    }

    .content {
      color: #333333;
      font-size: 16px;
      line-height: 1.8;
    }

    .greeting {
      font-weight: bold;
      margin-bottom: 20px;
    }

    .paragraph {
      margin-bottom: 20px;
    }

    .contact-info {
      background-color: #f8f9fa;
      padding: 15px;
      border-left: 4px solid #4779A9;
      margin: 20px 0;
    }

    .footer {
      margin-top: 30px;
      padding-top: 20px;
      border-top: 1px solid #e0e0e0;
      text-align: center;
      color: #666666;
      font-size: 14px;
    }

    .signature {
      margin-top: 20px;
      font-style: italic;
    }
  </style>
</head>

<body>
  <div class="email-container">
    <div class="header">
      <h1>Thank You for Registering</h1>
    </div>

    <div class="content">
      <div class="greeting">
        Dear {{ $registration->first_name }} {{ $registration->last_name }},
      </div>

      <div class="paragraph">
        Thank you for registering for the 3rd GHA SCAI Shock Middle East Meeting. We are looking forward to hosting you
        at the Regency, Kuwait, on January 9th and 10th, 2026.
      </div>

      <div class="paragraph">
        We are excited to bring together leading experts and professionals to share the latest advancements in critical
        care. We are confident that this meeting will provide a valuable platform for networking and collaboration.
      </div>

      <div class="contact-info">
        <strong>Registration Details:</strong><br>
        Registration ID: {{ str_pad($registration->id, 6, '0', STR_PAD_LEFT) }}<br>
        Email: {{ $registration->email }}<br>
        Phone: {{ $registration->mobile }}<br>
        Registration Type:
        {{ $registration->onlyWorkshop == 1 ? 'Workshop Only' : (count($registration->Workshops) > 0 ? 'Meeting and Workshop' : 'Meeting Only') }}
        @if (count($registration->Workshops) > 0)
          <br><br><strong>You have successfully registered to:</strong><br>
          <br><strong>January 9</strong><br>
          @foreach ($registration->Workshops as $workshop)
            {{ $workshop->title }}<br>
          @endforeach
        @endif
        @if ($registration->onlyWorkshop == 0)
          <br><strong>January 10</strong><br>
          09:00 - 17:30 GHA-SCAI Shock Middle East Meeting<br>
        @endif
      </div>

      <div class="paragraph">
        If you have any questions or need further information, please don't hesitate to reach out to our team at <a
          href="mailto:conferences@zawaya.me" style="color: #4779A9;">conferences@zawaya.me</a>.
      </div>

      <div class="paragraph">
        We look forward to seeing you there.
      </div>

      <div class="signature">
        Sincerely,<br>
        3rd GHA SCAI Shock Middle East Meeting
      </div>
    </div>

    <!-- <div class="footer">
            <p>GHA SCAI Shock Middle East Meeting<br>
            Regency, Kuwait | January 9-10, 2026</p>
        </div> -->
  </div>
</body>

</html>
