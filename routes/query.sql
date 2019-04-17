/*Challenge 1: Please provide me a list of account IDs that meet the following criteria:*/

SELECT ACCT_ID FROM PEDW_SECURED_CUST_SUMRY_NP WHERE CLS_DT = '2018-10-1' AND SVC_OWNR_CD = 000099

/*Challenge 2: Add the primary customer's name to your results from Challenge 1. This will require joining to a 
secure enterprise table (pedw_secured.ec_cust_sumry_np).*/

SELECT PEDW_SECURED_CUST_SUMRY_NP.ACCT_ID,pedw_secured.ec_cust_sumry_np.name FROM PEDW_SECURED_CUST_SUMRY_NP
INNER JOIN pedw_secured.ec_cust_sumry_np ON pedw_secured.ec_cust_sumry_np.ACCT_ID = pedw_secured.ec_cust_sumry_np.ACCT_ID
 WHERE CLS_DT = '2018-10-1' AND SVC_OWNR_CD = 000099
 
 /*Challenge 3: Add the billing cycle day to the results from Challenge 2. The billing cycle day is in a field 
 called billg_cyc_day_num in the 
 other "common" table I called out to you, the one with "snap" in its name.*/
 
 SELECT PEDW_SECURED_CUST_SUMRY_NP.ACCT_ID,pedw_secured.ec_cust_sumry_np.name,snap.billg_cyc_day_num FROM PEDW_SECURED_CUST_SUMRY_NP
INNER JOIN pedw_secured.ec_cust_sumry_np ON pedw_secured.ec_cust_sumry_np.ACCT_ID = pedw_secured.ec_cust_sumry_np.ACCT_ID
INNER JOIN snap ON snap.sor_id = pedw_secured.ec_cust_sumry_np.sor_id
 WHERE CLS_DT = '2018-10-1' AND SVC_OWNR_CD = 000099
 
 /*Challenge 4: Start from scratch. Provide me a list of account IDs that meet the following criteria:*/
 SELECT ACCT_ID FROM PEDW_SECURED_CUST_SUMRY_NP WHERE OPEN_DT >= '2018-10-1' AND (SVC_OWNR_CD = 000097 OR SVC_OWNR_CD = 000098
SVC_OWNR_CD = 000093 SVC_OWNR_CD = 000094 )

SELECT ACCT_ID as actID , email_adr_txt FROM PEDW_SECURED_CUST_SUMRY_NP WHERE OPEN_DT >= '2018-10-1' AND (SVC_OWNR_CD = 000097 OR SVC_OWNR_CD = 000098
SVC_OWNR_CD = 000093 SVC_OWNR_CD = 000094 ) AND (email_adr_txt LIKE '%@gmail.com')

SELECT ACCT_ID as actID ,Balance,email_adr_txt FROM PEDW_SECURED_CUST_SUMRY_NP WHERE OPEN_DT >= '2018-10-1' AND (SVC_OWNR_CD = 000097 OR SVC_OWNR_CD = 000098
SVC_OWNR_CD = 000093 SVC_OWNR_CD = 000094 ) AND (email_adr_txt LIKE '%@gmail.com')


 