
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
		<head>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
			<title>Welcome to Cloe</title>
			<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
			<link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
			<style type="text/css">
				body, #body_style {
					width: 100% !important;
					font-family: 'Open Sans', Arial, Helvetica, sans-serif;
					background: #f7f7f7;
					line-height: 1;
				}

				.ExternalClass {
					width: 100%;
				}
				.ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div {
					line-height: 100%;
				}

				body {
					-webkit-text-size-adjust: none;
					-ms-text-size-adjust: none;
				}

				body, img, div, p, ul, li, span, strong, a {
					margin: 0;
					padding: 0;
				}

				table {
					border-spacing: 0;
				}

				table td {
					border-collapse: collapse;
				}

				a {
					color: #ffd204;
					text-decoration: underline;
					outline: none;
				}
				a:hover {
					text-decoration: none !important;
				}

				a[href^="tel"], a[href^="sms"] {
					text-decoration: none;
					color: #ffd204;
				}

				img {
					display: block;
					border: none;
					outline: none;
					text-decoration: none;
				}

				table {
					border-collapse: collapse;
					mso-table-lspace: 0pt;
					mso-table-rspace: 0pt;
				}

				/*Style for Page design Start Here*/
				@media screen and (max-width: 599px) {
					body[yahoo] .wrapper-section-one, .content-block img {
						width: 100% !important;
					}
					body[yahoo] .menu-space {
						width: auto !important;
					}
					body[yahoo] .content-block {
						width: 100% !important;
						display: block;
					}

					body[yahoo] .content-block2 {
						max-width: 100% !important;
					}

				}

				/* Figure out where the breaks happen and use that in the media query */
				@media (max-width: 400px) {
				  table.wrapper-section-one{
				  	width: 340px !important;
				  }
				}

			</style>

		</head>

		<body style="font-family: 'Open Sans',Arial,Helvetica,sans-serif; font-size: 12px; color: margin: 0; width:100% !important;background: #f7f7f7;" yahoo="fix">


			<table align="center" border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" bgcolor="#f7f7f7" class="wrap-body">
				<tr>
					<td>
						<table width="600" border="0" cellspacing="0" cellpadding="0" align="center" class="wrapper-section-one" >
							<tr>
								<table cellpadding="0" cellspacing="0" border="0" width="100%">
									<tr>
										<td height="50"><!-- <img src="http://office.codigo.id/netportal-email/images/spacer.gif" height="1" width="1" alt=" " /> --></td>
									</tr>
									<tr>
										<td align="center" class="editable" style="font-size:36px; font-family: 'Open Sans',Arial,Helvetica,sans-serif;color:#ffffff; font-weight:300; text-align: center; text-transform: uppercase;"> <a href="http://zulu.id" style="color:#ffffff;">  <img style="display:block;margin: 0 auto;" src="{{env('CMS_BASE_URL')}}uploads/email/logo.png" height="60.6" width="200" alt=""/></a></td>
									</tr>
									<tr>
										<td height="40"><!-- <img src="http://office.codigo.id/netportal-email/images/spacer.gif" height="1" width="1" alt=" " /> --></td>
									</tr>
									<tr>
										<td height="50" align="center" class="editable" style="font-size:36px; font-family: 'Open Sans',Arial,Helvetica,sans-serif;color:#000; font-weight:300; text-align: center; text-transform: uppercase;">
											HELLO
										</td>
									</tr>
									<tr>
										<td align="center" class="editable" style="font-size:18px; font-family: 'Open Sans',Arial,Helvetica,sans-serif;color:#000; font-weight:300; text-align: center; text-transform: none;">
											Please verify your account
										</td>
									</tr>
									<tr>
										<td height="50"><!-- <img src="http://office.codigo.id/netportal-email/images/spacer.gif" height="1" width="1" alt=" " /> --></td>
									</tr>
								</table>
							</tr>
						</table>

						<table width="600" border="0" cellspacing="0" cellpadding="0" align="center" class="wrapper-section-one" style="border-top-right-radius:5px;border-top-left-radius:5px;">
							<tbody style="background:#14232C;margin-left:15px;margin-right:15px;display:block;border-top-left-radius:5px;border-top-right-radius:5px; color:#ffffff; box-shadow: 0px 2px 20px 5px rgba(0,0,0,0.32);">
								<tr>
									<td>
									<table cellspacing="0" cellpadding="0" border="0" width="100%" >
										<tr>
											<td width="24"><img src="{{env('CMS_BASE_URL')}}uploads/email/blank.gif" width="1" height="1" alt=""/></td>
											<td>
											<table cellspacing="0" cellpadding="0" border="0" width="100%"  >
												<tr>
													<td height="55"><img src="{{env('CMS_BASE_URL')}}uploads/email/blank.gif" width="1" height="1" alt=""/></td>
												</tr>
												<tr>
													<td class="editable" style="font-size: 16px; line-height: 1.2; text-align: center;font-family: 'Open Sans',Arial,Helvetica,sans-serif;color:#ffffff"><?php
                                                            $name = explode('@', $user->email);
                                                            echo "Dear ".$name[0].",";
                                                        ?></td>
												</tr>
												<tr>
													<td height="30"><img src="{{env('CMS_BASE_URL')}}uploads/email/blank.gif" width="1" height="1" alt=""/></td>
												</tr>
												<tr>
													<td class="editable" style="font-size: 16px; line-height: 1.5; text-align:center; font-family: 'Open Sans',Arial,Helvetica,sans-serif;color:#ffffff">We found that your registerd email is not verified, please do re-verification to activate your <a style="color:#0BA5C5;" href="http://zulu.id" target="_blank">Zulu.id</a> account. Click the button below to confirm that we’ve got the correct e-mail.</td>
												</tr>
												<tr>
													<td height="32"><img src="{{env('CMS_BASE_URL')}}uploads/email/blank.gif" width="1" height="1" alt=""/></td>
												</tr>
												<tr>
													<td>
														<table cellpadding="0" cellspacing="0" border="0" style="background:#ededed;" align="center">
															<tr>
																<td style="text-align: center; background:#14232C;">
																	<a href="{{env('WEB_BASE_URL')}}user/activate/{{$register->activation_token}}" class="editable " style="font-size:14px; font-family: 'Open Sans',Arial,Helvetica,sans-serif;letter-spacing: 1.2px;text-align:center;text-transform:uppercase;color:#FFF;text-decoration: none;display:block; vertical-align: middle;padding: 15px 35px;background-image: linear-gradient(90deg, #0ECDDF 0%, #0093E8 100%); box-shadow: 0px 4px 8px 0px rgba(0,161,233,0.76); border-radius: 100px;">RE-VERIFY MY EMAIL </a>
																</td>
															</tr>
														</table>
													</td>
												</tr>
												<tr>
													<td height="30"><img src="{{env('CMS_BASE_URL')}}uploads/email/blank.gif" width="1" height="1" alt=""/></td>
												</tr>
												<tr>
													<td class="editable" style="font-size: 16px; line-height: 1.5; text-align: center;font-family: 'Open Sans',Arial,Helvetica,sans-serif;color:#ffffff">Or paste this link into your browser: <a style="color:#0BA5C5;" href="{{env('WEB_BASE_URL')}}user/activate/{{$user->activation_key}}" target="_blank">{{env('WEB_BASE_URL')}}user/activate/{{$user->activation_key}}</a></td>
												</tr>
												<tr>
													<td height="30"><img src="{{env('CMS_BASE_URL')}}uploads/email/blank.gif" width="1" height="1" alt=""/></td>
												</tr>
												<tr>
													<td height="50"><img src="{{env('CMS_BASE_URL')}}uploads/email/blank.gif" width="1" height="1" alt=""/></td>
												</tr>
												<tr>
													<td class="editable" style="font-size: 16px; line-height: 1.5; text-align: center;font-family: 'Open Sans',Arial,Helvetica,sans-serif;color:#ffffff">Enjoy,<br /> <b>Zulu ID Team</b></td>
												</tr>
												<tr>
													<td height="50"><img src="{{env('CMS_BASE_URL')}}uploads/email/blank.gif" width="1" height="1" alt=""/></td>
												</tr>
											</table></td>
											<td width="24"><img src="{{env('CMS_BASE_URL')}}uploads/email/blank.gif" width="1" height="1" alt=""/></td>
										</tr>
									</table></td>
								</tr>
							</tbody>
						</table>

						<table width="600" border="0" cellspacing="0" cellpadding="0" align="center" class="wrapper-section-one">
							<tbody align="center" style="background: rgba(0,0,0,0.70);margin-left:15px;margin-right:15px;margin-bottom: 25px;display:block;border-bottom-left-radius:5px;border-bottom-right-radius:5px">
								<tr>
									<td width="24"><img src="{{env('CMS_BASE_URL')}}uploads/email/blank.gif" width="1" height="1" alt=""/></td>
									<td>
									<table cellspacing="0" cellpadding="0" border="0" width="100%" >
										<tr>
											<td height="30"><img src="{{env('CMS_BASE_URL')}}uploads/email/blank.gif" width="1" height="1" alt=""/></td>
										</tr>
										<tr>
											<td>
											<table cellspacing="0" cellpadding="0" border="0" width="100%" >
												<tr>
													<td align="center">
														<table cellspacing="0" cellpadding="0" border="0" width="275" >
															<tr>
																<td width="100" align="center" style="color:#fff; font-size: 18px;">Follow Us</td>
																<td width="26" align="center"><a href="https://www.facebook.com/profile.php?id=100012335313891" class="editable-lni"><img src="{{env('CMS_BASE_URL')}}uploads/email/ic-fb.png" alt="" width="26" height="26" border="0" style="display: block;" /></a></td>
																<td width="26" align="center"><a href="https://twitter.com/zuluid/" class="editable-lni"><img src="{{env('CMS_BASE_URL')}}uploads/email/ic-tw.png" alt="" width="26" height="26" border="0" style="display: block;" /></a></td>
																<td width="26" align="center"><a href="https://instagram.com/zuluid" class="editable-lni"><img src="{{env('CMS_BASE_URL')}}uploads/email/ic-ig.png" alt="" width="26" height="26" border="0" style="display: block;" /></a></td>
																<!-- <td width="26" align="center"><a href="#" class="editable-lni"><img src="http://office.codigo.id/netportal-email/images/ic-go.png" alt="" width="26" height="26" border="0" style="display: block;" /></a></td> -->
																<td width="26" align="center"><a href="https://www.youtube.com/channel/UC1JZGpaUoJwu9rQTMWoOeUg" class="editable-lni"><img src="{{env('CMS_BASE_URL')}}uploads/email/ic-ytb.png" alt="" width="26" height="26" border="0" style="display: block;" /></a></td>
															</tr>
														</table>
														<table>
															<tr>
																<td height="10"><img src="{{env('CMS_BASE_URL')}}uploads/email/blank.gif" width="1" height="1" alt=""/></td>
															</tr>
														</table>

													</td>
												</tr>
											</table></td>
										</tr>
										<tr>
											<td height="25"><img src="{{env('CMS_BASE_URL')}}uploads/email/blank.gif" width="1" height="1" alt=""/></td>
										</tr>
									</table></td>
									<td width="24"><img src="{{env('CMS_BASE_URL')}}uploads/email/blank.gif" width="1" height="1" alt=""/></td>
								</tr>
							</tbody>
							<td width="24"><img src="{{env('CMS_BASE_URL')}}uploads/email/blank.gif" width="1" height="1" alt=""/></td>
						</table>

						<table width="600" border="0" cellspacing="0" cellpadding="0" align="center" class="wrapper-section-one">
							<tbody align="center" style="margin-left:15px;margin-right:15px;margin-bottom: 25px;display:block;border-bottom-left-radius:5px;border-bottom-right-radius:5px">
								<tr>
									<td width="24"><img src="{{env('CMS_BASE_URL')}}uploads/email/blank.gif" width="1" height="1" alt=""/></td>
									<td>
									<table cellspacing="0" cellpadding="0" border="0" width="100%" >
										<tr>
											<td height="20"><img src="{{env('CMS_BASE_URL')}}uploads/email/blank.gif" width="1" height="1" alt=""/></td>
										</tr>
										<tr>
											<td>
											<table cellspacing="0" cellpadding="0" border="0" width="100%" >
												<tr>
													<td align="center">
														<table cellspacing="0" cellpadding="0" border="0">
                                                                                                                        <tr>
																<td colspan="4" class="editable" style="font-size: 14px; line-height: 1.5; text-align: center;font-family: &#39;Open Sans&#39;,Arial,Helvetica,sans-serif;color:#000"><a style="color:#000;text-decoration:none" href="http://zulu.id">You are receiving this email because you signed up for Zulu.id.<br>If you did not make this request, please contact </a><a style="color:#000;text-decoration:none" href="mailto:support@zulu.id">support@zulu.id</a></td>
															</tr>
															<tr>
																<td colspan="4" class="editable" style="font-size: 14px; line-height: 1.5; text-align: center;font-family: 'Open Sans',Arial,Helvetica,sans-serif;color:#000"><a style="color:#000;text-decoration:none" href="http://zulu.id/privacy-and-policy">Privacy Policy </a> | <a style="color:#000;text-decoration:none" href="http://zulu.id/term-of-use">Terms & Conditions</a> </td>
															</tr>
															<tr>
																<td height="10"><img src="{{env('CMS_BASE_URL')}}uploads/email/blank.gif" width="1" height="1" alt=""/></td>
															</tr>
															<tr>
																<td colspan="4" class="editable" style="font-size: 12px; line-height: 1.5; text-align: center;font-family: 'Open Sans',Arial,Helvetica,sans-serif;color:#000">&copy; 2017 zulu.id All Rights Reserved.  </td>
															</tr>
															<tr>
																<td height="5"><img src="{{env('CMS_BASE_URL')}}uploads/email/blank.gif" width="1" height="1" alt=""/></td>
															</tr>
															<tr>
																<td colspan="4" class="editable" style="font-size: 14px; line-height: 1.5; text-align: center;font-family: 'Open Sans',Arial,Helvetica,sans-serif;color:#000"><a style="color:#000;text-decoration:none" href="http://zulu.id">www.zulu.id </a>  </td>
															</tr>
														</table>
														<table>
															<tr>
																<td height="10"><img src="{{env('CMS_BASE_URL')}}uploads/email/blank.gif" width="1" height="1" alt=""/></td>
															</tr>
														</table>

													</td>
												</tr>
											</table></td>
										</tr>
										<tr>
											<td height="25"><img src="{{env('CMS_BASE_URL')}}uploads/email/blank.gif" width="1" height="1" alt=""/></td>
										</tr>
									</table></td>
									<td width="24"><img src="{{env('CMS_BASE_URL')}}uploads/email/blank.gif" width="1" height="1" alt=""/></td>
								</tr>
							</tbody>
							<td width="24"><img src="{{env('CMS_BASE_URL')}}uploads/email/blank.gif" width="1" height="1" alt=""/></td>
						</table>
					</td>
					<td width="24"><img src="{{env('CMS_BASE_URL')}}uploads/email/blank.gif" width="1" height="1" alt=""/></td>
				</tr>
			</table>

		</body>
	</html>
