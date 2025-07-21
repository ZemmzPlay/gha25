<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!--[if !mso]><!-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!--<![endif]-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title></title>
    <style>
        .ReadMsgBody { width: 100%; background-color: #ffffff; }
        .ExternalClass { width: 100%; background-color: #ffffff; }
        .ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div { line-height: 100%; }
        html { width: 100%; }
        body { -webkit-text-size-adjust: none; -ms-text-size-adjust: none; margin: 0; padding: 0; }
        table { border-spacing: 0; table-layout: fixed; margin: 0 auto; font-family: arial, sans-serif !important; }
        table table table { table-layout: auto; }
        .yshortcuts a { border-bottom: none !important; }
        img:hover { opacity: 0.9 !important; }
        a { color: #c86e6e; text-decoration: none; }
        .textbutton a { font-family: arial, 'open sans', arial, sans-serif !important;}
        .btn-link a { color:#FFFFFF !important;}

        @media only screen and (max-width: 640px) {
            body { width: auto !important; }
            /* image */
            img[class="img1"] { width: 100% !important; height: auto !important; }
        }

        @media only screen and (max-width: 480px) {
            body { width: auto !important; }
            /* image */
            img[class="img1"] { width: 100% !important; }
        }
    </style>
</head>

<body style="background: #eceff3">
    @php
    if(!isset($configuration)) $configuration = App\Configuration::first();
    @endphp
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
        <td bgcolor="#eceff3" style="background-size:100% auto; background-position:top; background-repeat:repeat-x" valign="top">
            <table align="center" border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td align="center" width="550">
                        <table align="center" width="90%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td height="50"></td>
                            </tr>
                            <tr>
                                <td align="center" style="font-family: arial, 'Open sans', Arial, sans-serif; color:#95a5a6; font-size:12px;font-style: italic;"></td>
                            </tr>
                            <tr>
                                <td height="10"></td>
                            </tr>
                        </table>
                        <table bgcolor="#FFFFFF" style="border-radius:6px;" width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                            <tr>
                                <td height="30"></td>
                            </tr>
                            <!--logo-->
                            <tr>
                                <td align="center">
                                    <table align="center" width="90%" border="0" cellspacing="0" cellpadding="0">
                                        <tbody>
                                            <tr>
                                                <td align="left">
                                                    <a href="{{route('pages.index')}}" target="_blank"><img width="300" style="display:block; line-height:0px; font-size:0px; border:0px;" src="{{ asset('images/'.$configuration->logo) }}"{{--  src="{{asset('images/GHA-emailAsset3.png')}}" --}} alt="img" /></a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <!--end logo-->
                            <tr>
                                <td height="10"></td>
                            </tr>
                            <!--image-->
                            <tr>
                                <td align="center" style="line-height: 0px; border-width: 4px; border-style: solid; /*border-image: linear-gradient(to right, #439659 , #44716f) 1;*/ border-color: #3EA651;"></td>
                            </tr>
                            <!--end image-->
                            <tr>
                                <td height="10"></td>
                            </tr>
                            <tr>
                                <td align="center">
                                    <table align="center" width="90%" border="0" cellspacing="0" cellpadding="0">

                                        <tr>
                                            <td align="left" style="font-family: arial, 'Century Gothic', Arial, sans-serif; color:#6e667b; font-size:22px;font-weight: bold; text-transform: uppercase">
                                                <br/>
                                                <span style="color: #3EA651;">Virtual Access Steps</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td height="5"></td>
                                        </tr>
                                        <tr>
                                            <td align="left" style="font-family: arial, 'Century Gothic', Arial, sans-serif; color:#6e667b; font-size:16px;font-weight: bold;line-height: 1.3;">
                                                <span style="color: #3EA651;">Dear {{$name}}, here are the instructions to access the conference online.</span>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td height="30"></td>
                                        </tr>

                                        <tr>
                                            <td align="left" style="font-family: arial, 'Century Gothic', Arial, sans-serif; color:#00000; font-size:18px;">
                                                <p style="font-size: 15px; line-height:24px;">
                                                    <b>Go to the Login Page:</b> Visit the event's website and navigate to the login section.
                                                </p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td height="5"></td>
                                        </tr>
                                        <tr>
                                            <td align="center">
                                                <table align="center" width="100%" border="0" cellspacing="0" cellpadding="0">
                                                    <tbody>
                                                        <tr>
                                                            <td align="left">
                                                                <img width="100%" style="display:block; line-height:0px; font-size:0px; border:0px;" src="{{asset('images/virtual/1.png')}}" alt="img" />
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td height="20"></td>
                                        </tr>


                                        <tr>
                                            <td align="left" style="font-family: arial, 'Century Gothic', Arial, sans-serif; color:#00000; font-size:18px;">
                                                <p style="font-size: 15px; line-height:24px;">
                                                    <b>Sign In:</b> Use your email, phone number, and the ID provided in the email to log in.
                                                </p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td height="5"></td>
                                        </tr>
                                        <tr>
                                            <td align="center">
                                                <table align="center" width="100%" border="0" cellspacing="0" cellpadding="0">
                                                    <tbody>
                                                        <tr>
                                                            <td align="left">
                                                                <img width="100%" style="display:block; line-height:0px; font-size:0px; border:0px;" src="{{asset('images/virtual/2.png')}}" alt="img" />
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td height="20"></td>
                                        </tr>



                                        <tr>
                                            <td align="left" style="font-family: arial, 'Century Gothic', Arial, sans-serif; color:#00000; font-size:18px;">
                                                <p style="font-size: 15px; line-height:24px;">
                                                    <b>Access the "Watch Here" Page:</b> Upon successful login, you'll be directed to the "Watch Here" page. Here, you can watch the event live, ask direct questions, and explore session details.
                                                </p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td height="5"></td>
                                        </tr>
                                        <tr>
                                            <td align="center">
                                                <table align="center" width="100%" border="0" cellspacing="0" cellpadding="0">
                                                    <tbody>
                                                        <tr>
                                                            <td align="left">
                                                                <img width="100%" style="display:block; line-height:0px; font-size:0px; border:0px;" src="{{asset('images/virtual/3.png')}}" alt="img" />
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td height="20"></td>
                                        </tr>

                                        <tr>
                                            <td align="left" style="font-family: arial, 'Century Gothic', Arial, sans-serif; color:#00000; font-size:18px;">
                                                <span style="font-size: 15px; line-height:24px;">Do not hesitate to contact us by email on <span><a href="mailto:conferences@zawaya.me" style="color: green; text-decoration: underline">conferences@zawaya.me</a></span> or by phone on <span class="phone"><a href="tel:+96522467780" style="color: green; text-decoration: underline">+96522467780</a></span>.</span>

                                                <br>
                                                <hr />

                                                <span style="font-size: 15px; line-height:24px;">Zawaya Project Management W.L.L © 2023 - All Rights Reserved</span>

                                                <br>

                                                <span style="font-size: 15px; line-height:24px;"><a href="www.zawaya.me" style="color: green; text-decoration: underline">www.zawaya.me</a></span>
                                            </td>
                                        </tr>

                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td height="40"></td>
                            </tr>
                        </table>
                        <table align="center" width="90%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td height="25"></td>
                            </tr>

                            <tr>
                                <td align="center">
                                    <table border="0" align="center" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td align="center" style="font-family: arial, 'Century Gothic', Arial, sans-serif; color:#6e667b; font-size:14px;">
                                                Do not hesitate to contact us at any time on +96522467780<br>
                                                Zawaya © 2023 - All rights reserved.<br>
                                                <a href="http://zawaya.me" style="color: green; text-decoration: underline">www.zawaya.me</a>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td height="20"></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>

</html>
