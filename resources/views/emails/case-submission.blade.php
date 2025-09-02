<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Case Submission Confirmation</title>

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
    <div>
      <img src="{{asset('images/GHA-emailAsset3.png')}}" style="margin: 0 auto;">
    </div>
    
    <div style="padding: 20px 0;">
      <label class="main-title">Case Submission Confirmation</label>
    </div>
    
    <div style="font-size: 2rem;">Dear <strong>{{ $caseSubmission->name }}!</strong></div>
    
    <div class="text-gray" style="padding: 20px 0;">
      Thank you for submitting your case. We can confirm that it has been successfully received and is now being prepared for review.
    </div>
    
    <div class="text-gray" style="padding: 20px 0;">
      Your submission is important to us, and we appreciate you taking the time to share it with our team. The details you've provided will be forwarded to the review committee for their careful consideration. We will be in touch with you as soon as the review process is complete.
    </div>
    
    <div class="text-gray" style="padding: 20px 0;">
      Thank you once again for your contribution.
    </div>
    
    <div class="text-gray" style="padding: 20px 0;">
      <strong>Best regards,<br>
      The GHA SCAI Shock Middle East Meeting Team</strong>
    </div>
  </div>
</body>
</html>
