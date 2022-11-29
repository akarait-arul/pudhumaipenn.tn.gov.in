<?php
//Config Validations
define('AADHAR_VALIDATION', false);
define('NPCI_VALIDATION', false);
define('AADHAR_API_VALIDATION', false);

//limit for otp sending
define('OTP_LIMIT_TIME','1 HOUR');

//logout time for inactivity 
define("NON_ACTIVITY_LOGOUT","30 MINUTE");

//sms language type
define("SMS_LANGUAGE",true);

define('MAIL_HOST', 'smtp.gmail.com');
define('MAILL_SMTPAUTH', true);
define('MAIL_USERNAME','');
define('MAIL_PASSWORD', '');
define('MAIL_SMTPSECURE', 'tls');
define('MAIL_PORT', 587);
define('MAIL_ADMIN_MAIL', '');

// Define EMIS API URL
define('EMIS_API','https://emis1.tnschools.gov.in/api/PenkalviHigherEdu');
define('EMIS_API_KEY','dhyDNulWAg2NzBsLmw4Lc6Jl9EbQI37w5RWV39uF');

// Define EMIS SEARCH API URL 
define('EMIS_SEARCH','https://emis1.tnschools.gov.in/api/PenkalviStuVerify');
define('EMIS_SEARCH_KEY','EMIS_web@2019_api');

//OTP sending link 
define('SMS_OTP_SEND','https://digimate.airtel.in:15443/BULK_API/InstantJsonPush');

/*
// Define Aadhar Generate OTP
define('AADHAR_GENERATE_OTP','https://tnpreauth.tn.gov.in/clientgwapi/api/Aadhaar/GenerateOTP');
// Define API FOR Aadhar OTP Validation
define('AADHAR_VALIDATE_OTP','https://tnpreauth.tn.gov.in/clientgwapi/api/Aadhaar/KYCWithOTP');
define('AADHAR_API_KEY','JYTFE-OOBLM-PNKBE-ZXVWK');
*/
// Define Aadhar Generate OTP
define('AADHAR_GENERATE_OTP','https://tnauth.tn.gov.in/clientgwapi/api/Aadhaar/GenerateOTP');
define('AADHAR_VALIDATE_OTP','https://tnauth.tn.gov.in/clientgwapi/api/Aadhaar/KYCWithOTP');
define('AADHAR_API_KEY','HFYUO-GSBXB-GRRYI-PQQYP');

define('NPCI_API','https://nach.npci.org.in/Aadhaar/AadhaarQueryService');

define('NPCI_MSG_ACTIVE_WITH_BANK','Student Bank Details Fetched Successfully');
define('NPCI_MSG_ACTIVE_WITHOUT_BANK',"Please open account and link your aadhar in any one of the following banks.<br/>STATE BANK OF INDIA,​INDIAN OVERSEAS BANK,​INDIAN BANK,CANARA BANK");
define('NPCI_MSG_INACTIVE_WITH_BANK','Please link your aadhar card with account available in the bank ');
define('NPCI_MSG_INACTIVE_WITHOUT_BANK',"Please open account and link your aadhar in any one of the following banks.<br/>STATE BANK OF INDIA,​INDIAN OVERSEAS BANK,​INDIAN BANK,CANARA BANK");
define('NPCI_MSG_CANCEL',"You are not eligible for scholarship please check with helpdesk");


define('GET_STUDENT_LIST_API_KEY', 'gsq5oE2RbqF/oz?EG75Bh4F96=cfZj3UiGYnufInEwnLaJwYtOsAsZ7ApRu9qzNj');
define('GET_DISTRICT_LIST_API_KEY', 'gsTOZ/fv1KvDYSTBEOju!VU2aL1Fxkk6h4t0!LM6CuIwL-aICr58lbs9RM4nNVit');
define('POST_STUDENT_LIST_API_KEY', 'pslYMXAqsBmAi4II8Db!ZXcDd0RL8wGde/XQ2gNO?cIuwimwOHDlArOPsHD98wT/');       
?>
