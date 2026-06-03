<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Verify Your Email</title>

</head>

<body
    style="
        margin:0;
        padding:0;
        background:#f8f7f4;
        font-family:Arial,sans-serif;
    ">

    <table width="100%" cellpadding="0" cellspacing="0">

        <tr>

            <td align="center" style="padding:40px 20px;">

                <table width="100%" cellpadding="0" cellspacing="0"
                    style="
                        max-width:600px;
                        background:#ffffff;
                        border-radius:28px;
                        overflow:hidden;
                    ">

                    <!-- Top -->
                    <tr>

                        <td
                            style="
                                background:#111111;
                                padding:50px 40px;
                                text-align:center;
                            ">

                            <h1
                                style="
                                    margin:0;
                                    color:white;
                                    font-size:42px;
                                    letter-spacing:2px;
                                ">

                                OUTFIT

                            </h1>

                            <p
                                style="
                                    margin-top:14px;
                                    color:rgba(255,255,255,0.65);
                                    font-size:16px;
                                    line-height:28px;
                                ">

                                Premium fashion pieces crafted for modern lifestyle and timeless elegance.

                            </p>

                        </td>

                    </tr>

                    <!-- Content -->
                    <tr>

                        <td style="padding:50px 40px;">

                            <p
                                style="
                                    margin:0 0 18px;
                                    font-size:13px;
                                    letter-spacing:3px;
                                    text-transform:uppercase;
                                    color:#8b8175;
                                ">

                                Email Subscription

                            </p>

                            <h2
                                style="
                                    margin:0;
                                    font-size:36px;
                                    color:#111111;
                                ">

                                Confirm Your Subscription

                            </h2>

                            <p
                                style="
                                    margin-top:24px;
                                    color:#6f675d;
                                    line-height:32px;
                                    font-size:16px;
                                ">

                                Thank you for subscribing to the OUTFIT newsletter.

                                Please confirm your email address to start receiving exclusive offers, new arrivals,
                                seasonal collections and special updates directly in your inbox.

                            </p>

                            <!-- Button -->
                            <div style="margin-top:40px;">

                                <a href="{{ $link }}"
                                    style="
                                        display:inline-block;
                                        background:#111111;
                                        color:white;
                                        text-decoration:none;
                                        padding:16px 34px;
                                        border-radius:18px;
                                        font-size:15px;
                                        font-weight:bold;
                                    ">

                                    Confirm Subscription

                                </a>

                            </div>

                            <p
                                style="
                                    margin-top:40px;
                                    color:#9c948b;
                                    font-size:14px;
                                    line-height:28px;
                                ">

                                If you did not subscribe to our newsletter, you can safely ignore this email.
                            </p>

                        </td>

                    </tr>

                    <!-- Bottom -->
                    <tr>

                        <td
                            style="
                                border-top:1px solid #f1efea;
                                padding:24px 40px;
                                text-align:center;
                                color:#a29b92;
                                font-size:13px;
                            ">

                            © {{ date('Y') }} OUTFIT. All rights reserved.

                        </td>

                    </tr>

                </table>

            </td>

        </tr>

    </table>

</body>

</html>
