-----------------------------------------------------------------------------------------
前置作業
-----------------------------------------------------------------------------------------
需要取得apple憑證檔案
*.crt.pem
*.key.pem

*注意憑證檔案請勿放在網頁公用目錄，以免遭竊取

-----------------------------------------------------------------------------------------
資料流程
-----------------------------------------------------------------------------------------
checkout.php -> verify_vendor.php -> payment_gateway.php

-----------------------------------------------------------------------------------------
程式介紹
-----------------------------------------------------------------------------------------
checkout.php 			產生applepay按鈕
verify_vendor.php		驗證廠商驗證
payment_gateway.php		傳送payment token 等交易資訊給綠界，進行信用卡授權

ECPay.Payment.Applepay.php 	SDK V1.0.10603
applepay_button.css 		apple pay 按鈕CSS定義檔
applepay_button.js 		apple pay javascript前端程式
jquery-1.11.1.js 		jquery



