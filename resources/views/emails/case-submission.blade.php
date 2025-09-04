<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Case Submission Confirmation</title>

  <style type="text/css">
    /* Base styles */
    body {
      margin: 0;
      padding: 0;
      background-color: #eceff3;
      font-family: Arial, sans-serif;
      line-height: 1.6;
    }
    
    .email-container {
      max-width: 600px;
      width: 100%;
      background-color: #ffffff;
      margin: 0 auto;
      padding: 30px 20px;
      box-sizing: border-box;
    }
    
    .main-title {
      font-size: 2.5rem;
      color: #4779A9;
      font-weight: 700;
      text-align: center;
      margin: 20px 0;
      line-height: 1.2;
    }
    
    .greeting {
      font-size: 1.5rem;
      margin: 20px 0;
      line-height: 1.3;
    }
    
    .text-gray {
      color: #6e667b;
      margin: 15px 0;
      font-size: 16px;
    }
    
    .closing {
      margin: 25px 0;
      font-weight: bold;
    }
    
    /* Responsive design */
    @media only screen and (max-width: 600px) {
      .email-container {
        padding: 20px 15px;
        margin: 0;
        width: 100%;
      }
      
      .main-title {
        font-size: 1.8rem;
        margin: 15px 0;
      }
      
      .greeting {
        font-size: 1.2rem;
        margin: 15px 0;
      }
      
      .text-gray {
        font-size: 14px;
        margin: 12px 0;
      }
    }
    
    @media only screen and (max-width: 480px) {
      .email-container {
        padding: 15px 10px;
      }
      
      .main-title {
        font-size: 1.5rem;
        margin: 12px 0;
      }
      
      .greeting {
        font-size: 1.1rem;
        margin: 12px 0;
      }
      
      .text-gray {
        font-size: 13px;
        margin: 10px 0;
      }
    }
    
    @media only screen and (max-width: 320px) {
      .main-title {
        font-size: 1.3rem;
      }
      
      .greeting {
        font-size: 1rem;
      }
      
      .text-gray {
        font-size: 12px;
      }
    }
  </style>
</head>
<body>
  <div class="email-container">
    <div style="text-align: center; padding: 20px 0;">
      <h1 class="main-title">Case Submission Confirmation</h1>
    </div>
    
    <div class="greeting">Dear <strong>{{ $caseSubmission->name }}!</strong></div>
    
    <div class="text-gray">
      Thank you for submitting your case. We can confirm that it has been successfully received and is now being prepared for review.
    </div>
    
    <div class="text-gray">
      Your submission is important to us, and we appreciate you taking the time to share it with our team. The details you've provided will be forwarded to the review committee for their careful consideration. We will be in touch with you as soon as the review process is complete.
    </div>
    
    <div class="text-gray">
      Thank you once again for your contribution.
    </div>
    
    <div class="text-gray closing">
      <strong>Best regards,<br>
      3rd GHA SCAI Shock Middle East Meeting</strong>
    </div>
  </div>
</body>
</html>
