@extends('frontend.master')
@section('title', 'sms')
@section('main')

<br>

	<style type="text/css">
	.body {
	    width:80%;
	}
	</style>

<style>
.button {
    background-color: #4CAF50; /* Green */
    border: none;
    color: black;
    padding: 16px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    -webkit-transition-duration: 0.4s; /* Safari */
    transition-duration: 0.4s;
    cursor: pointer;
}

.button1 {
    background-color: white; 
     
    border: 2px solid #4CAF50;
}

.button1:hover {
    background-color: #4CAF50;
    color: white;
}

.button2 {
    background-color: white; 
   
    border: 2px solid #008CBA;
}

.button2:hover {
    background-color: #008CBA;
    color: white;
}

</style>
<style>
    @media print
{
    #pager,
    form,
    .no-print
    {
        display: none !important;
        height: 0;
    }


    .no-print, .no-print *{
        display: none !important;
        height: 0;
    }
}
@page {

  margin: 0.25in 0.25in;

}
</style>

<style>
  body {
   background: white;
}
page {
  background: white;
  display: block;
  margin: 0 auto;
  padding:20px;
  border-style: solid dotted ;
}
page[size="A4"] {  
  width: 21cm;
}
page[size="A4"][layout="portrait"] {
  width: 29.7cm;
  height: 21cm;  
}
page[size="A3"] {
  width: 29.7cm;
  height: 42cm;
}
page[size="A3"][layout="portrait"] {
  width: 42cm;
  height: 29.7cm;  
}
page[size="A5"] {
  width: 14.8cm;
  height: 21cm;
}
page[size="A5"][layout="portrait"] {
  width: 21cm;
  height: 14.8cm;  
}
@media print {
  body, page 
  {
    margin: 0;
    box-shadow: 0;
  }
}.style1 {
	color: #FFFFFF;
	font-size: 36px;
}
  .style2 {color: #FFFFFF; font-size: 16px; }
  </style>
<style>
table {
    border-collapse: collapse;
    border-spacing: 0;
    width: 100%;
    border: 1px solid #ddd;
}

th{
    border: none;
    text-align: center;
  

}

td

{
    border: black solid 1px;
    
	
}

tr:nth-child(even){background-color: #f2f2f2}
.style3 {color: #000000}
  </style>

<page size="A4">
<section>

<h2 style="text-align: center;"><span style="text-decoration: underline;"><strong>Terms And Conditions</strong></span></h2>

<p style="text-align: center; color:red">সঠিকভাবে সম্পূর্ন কন্ডিশনস্ গুলো পড়ুন, অন্যাথায় কোনো কারনে আপনার অ্যাকাউন্ট সাসপেন্ড হলে কোনো রকম অাপত্ত্বি/অনুরোধ গ্রহন করা হবে না ।</p>


<ul>
	<li style="text-align: justify;">* <span id="result_box2" lang="en">Your sent SMS will not be stored on our servers for a long time</span>.</li>
	<li style="color: red; text-align: justify;">(আপনার পাঠানো এসএমএস আমাদের সার্ভার এ বেশিদিন জমা রাখা হয় না)</li>
	<li><span id="result_box" lang="en">* If the new SMS   package is recharged before the old SMS package expires, the remaining   SMS in the account will be added to the new package.
	  But after the expiration of the recharge, the old SMS will not be added to the accoun</span>t.<br /></li>
<li style="color: red; text-align: justify;"> (পুরাতন এসএমএস প্যাকেজ মেয়াদ উত্তীর্ন হবার পূর্বে যদি নতুন এসএমএস প্যাকেজ রিচার্জ করা হয় তবে অ্যাকাউন্টে থাকা অবশিষ্ট এসএমএস নতুন প্যাকেজের সাথে যুক্ত হবে । মেয়াদ শেষ হবার পর রিচার্জ করিলে পুরাতন এসএমএস অ্যাকাউন্টে যুক্ত হবে না।)</li>
	<li style="text-align: justify;">* <span id="result_box3" lang="en">Massage can not be used for any abuse, threats, or anti-national activities. You can not use our SMS for any illegal activities. If you do,  will take action against the law. And the account will be closed.</span></li>
	<li style="color: red; text-align: justify;">(ম্যাসেজ কোনো গালিগালাজ, হুমকি, বা দেশ বিরোধী কোন কাজে পাঠাতে পারবেন না। আমাদের এসএমএস কোন বেআইনি কাজে ব্যাবহার করতে পারবেন না। করিলে আপনার বিরুদ্ধে আইন আনুক ব্যবস্থা গ্রহন করা হবে। এবং অ্যাকাউন্ট বন্ধ করে দেয়া হবে। )</li>
	<li>* You are not allowed to abuse our service thus you can not send threat/love/slang/Adult/any kinds of personal SMS using our SMS service. If anyone do it we will take immediate action against him/her and his/her service will be canceled parmanently.<br />
	<li style="color: red; text-align: justify;">(অাপনি এসএমএস সার্ভিস পার্সোনাল ব্যবহার যেমন বান্ধবীকে যোকোনো ধরনের ভালোবাসা সম্পর্কিত, অ্যাডাল্ট ম্যাসেজ  পাঠাতে পারবেন না । যদি পাঠান সাথে সাথে অ্যাকাউন্ট সাসপেন্ড করে দেওয়া হবে এবং এ ক্ষেত্রে কোনো ধরনের রিকোয়েস্ট গ্রহনযোগ্য হবে না ।)</li>
    	<li><span id="result_box5" lang="en">* No fraudulent promotion sms can be sent (for example, winning the lottery)</span></li>
<li  style="color:red"> (কোন রকম প্রতারনা মূলক প্রচারনার এসএমএস পাঠানো যাবে না (যেমন , লটারী  জেতা)</li>
	<li>* <span id="result_box4" lang="en">No adult  product can be marketed</span></li>
	<li style="color: red; text-align: justify;">(কোনো অ্যাডাল্ট প্রোডাক্টের মার্কেটিং করা যাবে না )</li>
	<li style="text-align: justify;">* SMS Sending speed maximum instant, but some time it take long for big volume. We request you to be patient and wait for sending complete.</li>
	<li style="text-align: justify;">* <span id="result_box6" lang="en">You have to bear all the SMS responsibilities sent from your account. availtrade.com will not be liable in any way for this. The action will be taken to bring a law against you for using any bad purpose. And the account will be closed.</span><br />
	<span style="color: red; text-align: justify;">(আপনার অ্যাকাউন্ট থেকে পাঠানো সকল এসএমএস আর দ্বায়ভার আপনাকে বহন করতে হবে। এর জন্য availtrade.com কোনো ভাবে দায়ী থাকবে না </span>)</li>

<li>অ্যাকাউন্ট সাসপেন্ড হলে কোনোরকম টাকা ফেরত দেওয়া হবে না, আমরা প্রতিটি এসএমএস মনিটর করি এবং যে কোনো ধরনের বেআইনী কনটেন্ট এর জন্য অ্যাকাউন্ট সাসপেন্ড করা সহ কোন খারাপ উদ্দেশ্য ব্যাবহার করিলে আপনার বিরুদ্ধে আইন আনুক ব্যবস্থা গ্রহন করা হবে।</li>

</ul>


<p style="text-align: center;"><strong><span style="color:#008000;">I have read the above terms and conditions properly and i agree with each and every rule mentioned above, i will not break any of these terms and conditions.</span></strong></p>

<div style="background: rgb(238, 238, 238) none repeat scroll 0% 0%; border: 1px solid rgb(204, 204, 204); padding: 5px 10px; text-align: center;"><span style="font-family:lucida sans unicode,lucida grande,sans-serif;"><span style="font-size: 36px;"><a class='button button2'  href=""><span ><strong>I AGREE</strong></span></a></span></span></div>
</section>
</page>       
</div>
@endsection