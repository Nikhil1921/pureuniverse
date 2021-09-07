<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>
<body>
    <table width="750" border="0" align="center" cellpadding="0" cellspacing="0">
        <tbody>
            <tr>
                <td align="left" valign="top" style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#373737;background-color:#fff;padding:20px;border:solid 1px #bcc2cf">
                    <h2>You are successfully registered with IMVS!</h2> <br>	<br>	
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tbody>
                        <tr>
                            <td align="left" valign="top" style="background-color:#fff;padding:15px 20px;border:solid 1px #dbdfe6">
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tbody>
                                    <tr>
                                        <td height="25" colspan="4" align="left" valign="top" style="font-family:Arial,Helvetica,sans-serif;font-size:15px;color:#0072c6;border-bottom:solid 1px #dbdfe6">Here are your examination details:</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" align="left" valign="top">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td width="412" align="left" valign="top">
                                            <table width="100%" border="0" cellspacing="0" cellpadding="4">
                                            <tbody>
                                                <tr>
                                                    <td width="23%" align="left" valign="top" style="font-family:Arial,Helvetica,sans-serif;font-size:11px;color:#373737"><strong>Date: </strong></td>
                                                    <td width="77%" align="left" valign="top" style="font-family:Arial,Helvetica,sans-serif;font-size:11px;color:#373737"><?= date('d-m-Y', strtotime($data['e_date'])) ?></td>
                                                </tr>
                                                <tr>
                                                    <td align="left" valign="top" style="font-family:Arial,Helvetica,sans-serif;font-size:11px;color:#373737"><strong>Time: </strong></td>
                                                    <td align="left" valign="top" style="font-family:Arial,Helvetica,sans-serif;font-size:11px;color:#373737"><?= date('h:i A', strtotime($data['e_time'])) ?></td>
                                                </tr>
                                                <tr>
                                                    <td align="left" valign="top" style="font-family:Arial,Helvetica,sans-serif;font-size:11px;color:#373737"><strong>Level: </strong></td>
                                                    <td align="left" valign="top" style="font-family:Arial,Helvetica,sans-serif;font-size:11px;color:#373737"><?= $category['cat_name'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td align="left" valign="top" style="font-family:Arial,Helvetica,sans-serif;font-size:11px;color:#373737"><strong>Language: </strong></td>
                                                    <td align="left" valign="top" style="font-family:Arial,Helvetica,sans-serif;font-size:11px;color:#373737"><?= $data['language'] ?></td>
                                                </tr>
                                            </tbody>
                                            </table>
                                        </td>
                                        <td width="244" align="right" valign="top">
                                            <table width="244" border="0" cellspacing="0" cellpadding="10">
                                            <tbody>
                                                <tr>
                                                    <td align="left" valign="top" style="background-color:#f7f7f7;border:solid 1px #e4e6eb">
                                                        <table width="244" border="0" cellspacing="0" cellpadding="0">
                                                        <tbody>
                                                            <tr>
                                                                <td width="51%" height="19" align="right" valign="top" style="font-family:Arial,Helvetica,sans-serif;font-size:11px;color:#373737">Fees Amount :</td>
                                                                <td width="16%" height="19" align="center" valign="top" style="font-family:Arial,Helvetica,sans-serif;font-size:11px;color:#373737">INR</td>
                                                                <td width="33%" height="19" align="right" valign="top" style="font-family:Arial,Helvetica,sans-serif;font-size:11px;color:#373737"><?= $category['price'] ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="51%" height="19" align="right" valign="top" style="font-family:Arial,Helvetica,sans-serif;font-size:11px;color:#373737">GST :</td>
                                                                <td width="16%" height="19" align="center" valign="top" style="font-family:Arial,Helvetica,sans-serif;font-size:11px;color:#373737">INR</td>
                                                                <td width="33%" height="19" align="right" valign="top" style="font-family:Arial,Helvetica,sans-serif;font-size:11px;color:#373737"><?= round($category['price'] * 0.18) ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="51%" height="19" align="right" valign="top" style="font-family:Arial,Helvetica,sans-serif;font-size:11px;color:#373737">Physical Certificate :</td>
                                                                <td width="16%" height="19" align="center" valign="top" style="font-family:Arial,Helvetica,sans-serif;font-size:11px;color:#373737">INR</td>
                                                                <td width="33%" height="19" align="right" valign="top" style="font-family:Arial,Helvetica,sans-serif;font-size:11px;color:#373737"><?= $category['extra'] ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td height="22" align="right" valign="bottom" style="font-family:Arial,Helvetica,sans-serif;font-size:11px;color:#373737"><strong>Net Payable :</strong></td>
                                                                <td height="20" align="center" valign="bottom" style="font-family:Arial,Helvetica,sans-serif;font-size:11px;color:#373737"><strong>INR</strong></td>
                                                                <td height="20" align="right" valign="bottom" style="font-family:Arial,Helvetica,sans-serif;font-size:11px;color:#373737"><strong><?= round($category['price'] * 1.18 + $category['extra']) ?></strong></td>
                                                            </tr>
                                                        </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                                </table>
                                <br>	      <br>	      
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tbody>
                                    <tr>
                                        <td height="25" align="left" valign="top" style="font-family:Arial,Helvetica,sans-serif;font-size:15px;color:#0072c6;border-bottom:solid 1px #dbdfe6">Note:</td>
                                    </tr>
                                    <tr>
                                        <td align="left" valign="top">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td width="412" align="left" valign="top">
                                            <table width="100%" border="0" cellspacing="0" cellpadding="4">
                                            <tbody>
                                                <tr>
                                                    <td width="16%" align="left" valign="middle" style="font-family:Arial,Helvetica,sans-serif;font-size:11px;color:#373737"><strong>The candidates who have registered with IMVS have to log in with <a href="https://pureuniverse.live/" target="_blank">https://pureuniverse.live/</a>  atleast before 5 minutes of the mentioned time.</strong></td>
                                                </tr>
                                            </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                                </table>
                                <br>	<br>	
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tbody>
                                    <tr>
                                        <td width="74%" align="left" valign="top" style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#373737"><strong>CUSTOMER CARE<br></strong><a href="https://pureuniverse.live/" target="_blank">https://pureuniverse.live/</a><br> Email : info@pureuniverse.live<br> Contact Info : 1800 202 2002</td>
                                        <td width="26%" align="right" valign="bottom"><img src="https://pureuniverse.live/test/assets/img/pure_uni.png" width="300" height="100" border="0" class="CToWUd"></td>
                                    </tr>
                                </tbody>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
        </table>
</body>
</html>