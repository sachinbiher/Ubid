<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>UBID</title>
  <!--Bootstrap-->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
  <!--font-awesome-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
  <link rel="icon" href="images/favicon.ico">
  <!--custom css-->
  <style>
    @font-face {
      font-family: Century Gothic;
      src: url('app-assets/fonts/fontfamily/fonts/GOTHIC.TTF');
    }

    body {
      background-color: #151515;
      font-family: Century Gothic;
    }

    .container {
      max-width: 1280px;
    }

    .m0-auto {
      margin: 0 auto;
      text-align: center;
    }

    .header-info {
      color: #eaeaea;
      margin-right: 1.2rem;
    }

    .navbar-nav {
      align-items: center !important;
    }

    @media (max-width: 768px) {
      .navbar-nav {
        align-items: baseline !important;
      }
    }

    .button1 {
      font-size: 20px;
      color: #212529 !important;
      text-decoration: underline;
      border: 1px solid white;
      padding: 5px 30px;
      border-radius: 20px;
      background: #eaeaea;
    }

    .v-row {
      display: flex;
      align-items: center;
      vertical-align: middle;
      justify-content: center;
    }

    .title-head {
      color: #eaeaea;
      font-size: 2.8rem;
    }

    .margin-left {
      margin-left: 100px;
    }

    /* input boxes */
    input[type="email"],
    input[type="password"] {
      width: 100%;
      border: none;
      background: #eaeaea;
      margin: 0px 0 5px 0;
      padding: 5px;
    }

    input[type="email"]:focus,
    input[type="password"]:focus {
      background-color: #eaeaea;
      outline: none;
    }

    #form label,
    #form .label-note {
      color: #eaeaea;
    }

    #form .label-note,
    #form .label-note a {
      color: #eaeaea;
      font-size: 1.1rem;
      font-weight: lighter;
      text-decoration: underline;
      cursor: pointer;
    }

    .button2 {
      font-size: 20px;
      margin: 15px 0px;
      text-align: center;
      padding: 3px 50px;
      border: none;
      border-radius: 20px;
      background: #2eeab7;
    }

    .button2:focus {
      outline: none;
    }

    .styled-checkbox {
      display: inline-block;
      vertical-align: text-top;
      width: 20px;
      height: 20px;
      background: white;
      cursor: pointer;
      margin-right: 5px;
    }

    @media (max-width: 768px) {
      .title-head {
        margin: 0%;
        font-size: 1.5rem;
        text-align: center;
      }

      .image {
        width: 350px;
      }
    }

    /*Hamburg Menu*/
    .navbar-toggler {
      border: 2px solid #9e5a0d;
      padding: 8px;
    }

    #navMenu>span {
      display: block;
      width: 28px;
      height: 2px;
      border-radius: 9999px;
      background-color: white;
    }

    #navMenu>span:not(:last-child) {
      margin-bottom: 10px;
    }

    #navMenu,
    #navMenu>span {
      transition: all 0.4s ease-in-out;
    }

    #navMenu.active {
      transition-delay: 0.8s;
      transform: rotate(180deg);
    }

    /* Terms and conditions */
    .terms-container {
      font-family: Century Gothic;
      color: #262626;
      margin: 0 auto;
      width: 90%;
    }

    .terms-title h1 {
      font-size: 30px;
      text-align: center;
      font-weight: 500;
    }

    .terms-body h3 {
      text-align: left;
      font-size: 20px;
      color: black;
      font-weight:600;
    }

    .terms-body p {
      font-size: 18px;
      line-height: 30px;
      margin-bottom: 15px;
      color: #666;
      padding: 4px 0;
      letter-spacing: 1px;
    }

    .terms-body ul {
      padding: 0;
    }

    .terms-body ul li,
    ol li,
    .contact-info {
      font-size: 18px;
      color: #666;
      line-height: 30px;
      letter-spacing: 1px;
      padding: 4px 0;
    }

    @media (max-width:768px) {
      .terms-container {
        margin: 0;
        width: 100%;
      }
    }

    @media (max-width:600px) {

      .terms-body p,
      .terms-body ul li,
      ol li {
        font-size: 16px;
      }
    }
  </style>
</head>

<body style="background-color: #fff;">
  <header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container-fluid">
        <a class="navbar-brand" href="{{route('login')}}">
          <img src="{{url('app-assets\images\logo\UBID-Logo-1X.png')}}" alt="" height="60" /> &nbsp; <img src="{{url('app-assets\images\logo\ubid-text-logo.png')}}" alt="" height="50" />
        </a>
        <button class="navbar-toggler menu" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation" data-menu="2">
          <div id="navMenu">
            <span></span>
            <span></span>
            <span></span>
          </div>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <div class="navbar-nav ml-auto">
          </div>
        </div>
      </div>
    </nav>
  </header>
  <!-- START content section-->
  <section>
    <div class="py-3"></div>
    <div class="container-fluid">
      <div class="terms-container">
        <div class="row">
          <div class="col-sm-12">
            <section class="terms-title">
              <h1>Terms &amp; Conditions</h1>
              <hr>
            </section>
            <div class="terms-body">
              <div class="content">
                <h3>Welcome to UBID !</h3>
                <p><strong><em>PLEASE READ THE FOLLOWING TERMS OF SERVICE AGREEMENT CAREFULLY. BY ACCESSING OR USING OUR SITES AND OUR SERVICES, YOU HEREBY AGREE TO BE BOUND BY THE TERMS AND ALL TERMS INCORPORATED HEREIN BY REFERENCE. IT IS THE RESPONSIBILITY OF YOU, THE USER, CREATIVE BUSINESS PARTNERS, OR PROSPECTIVE CREATIVE BUSINESS PARTNERS, TO READ THE TERMS AND CONDITIONS BEFORE PROCEEDING TO USE THIS SITE. IF YOU DO NOT EXPRESSLY AGREE TO ALL OF THE TERMS AND CONDITIONS, THEN PLEASE DO NOT ACCESS OR USE OUR SITES OR OUR SERVICES.</em></strong></p>
                <div>
                  <p>The following Terms of Use Agreement (the "TOU") is a legally binding agreement that shall govern the relationship with our users and others who may interact or interface with UBID owned and operated by UBID India Private Limited, located at, Plot No. C-2/B,C-2/C,C-2/E & C-2/F Puppalguda, Gandipet, Hyderabad, Rangareddy Telangana - 500089, Indiaand our subsidiaries and affiliates, in association with the use of the website, which includes&nbsp;<a href="https://www.ubidindia.com" target="_blank">www.ubidindia.com</a>,&nbsp;its mobile applications (the "Site"), and its Services, which shall be defined below.</p>
                  <p>Using&nbsp;<a href="https://www.ubidindia.com" target="_blank">www.ubidindia.com</a>&nbsp;in any way means that you agree to all of these Terms, and these Terms will remain in effect while you use&nbsp;<a href="https://www.ubidindia.com" target="_blank">www.ubidindia.com</a>.&nbsp;If you do not agree to all of the following, you may not use or access&nbsp;<a href="https://www.ubidindia.com" target="_blank">www.ubidindia.com</a>&nbsp;or its mobile applicationsin any manner.</p>
                  <p>You represent and warrant that you are of legal age to form a binding contract (or if not, that you have received your parent’s or guardian’s permission to use the siteand that your parent or guardian agrees to these Terms on your behalf).</p>
                  <p>If you’re agreeing to these Terms on behalf of an organization or entity, you represent and warrant that you are authorized to agree to these Terms on that organization or entity’s behalf and bind them to these Terms (in which case, the references to “you” and “your” throughout this document refer to that organization or entity).</p>
                </div>
                <div>
                  <h3>Creating an Account on the UBID Platform (owned by UBID India Private Limited)</h3>
                  <p>The Site is a professional services website which has the following description:</p>
                  <p>To help the Creative Business Partners <strong>(‘CBP’)</strong> present and enable users to discover their services and engage with customers, we at UBID, through our platform provide Interior Designers/Architects/Freelancers/Home Decor suppliers and Others who are in the business of Home Decor access to customers(requirements).The website provides description of the services offered by each CBP. The website is a platform to connect the customer and the Creative Business Partners according to their needs, interests and budgets.</p>
                  <p>Any and all visitors to our site shall be deemed as "Users" of the herein contained Services provided for the purpose of this TOU, where the term “Users” shall include all Creative Business Partners who are willing to offer their services.</p>
                  <p>The user acknowledges and agrees that the Service of connecting Creative Business Partners and Customer, provided and made available through our website,&nbsp;<a href="https://www.ubidindia.com" target="_blank">www.ubidindia.com</a>,&nbsp;and applications shall include some mobile applications.Those applications,that may be made available on various social media networking sites and numerous other platforms and downloadable programs, are the sole property of UBID India Private Limited. The user also acknowledges and agrees that other than the Service of connecting Creative Business Partners and Customer, provided and made available through our site, all other services are provided by Third -Partyand UBID India Private Limitedassumes no responsibility for the delivery of such services.</p>
                  <p>At its discretion, UBIDmay offer additional website Services and/or products, or update, modify or revise any current content and Services, and this Agreement shall apply to any and all additional Services and/or products and any and all updated, modified or revised Services unless otherwise stipulated. UBIDdoes hereby reserve the right to cancel and cease offering any of the aforementioned Services and/or products. You, as the end user, acknowledge, accept and agree that UBIDshall not be held liable for any such updates, modifications, revisions, suspensions or discontinuance of any of our Services and/or products. Should you not agree to the updated, revised or modified terms, you must stop using the provided Services forthwith.</p>
                  <p>Furthermore, the user understands, acknowledges and agrees that the Services offered shall be provided "AS IS" and as suchUBID shall not assume any responsibility or obligation for the timeliness, missed delivery, deletion and/or any failure to store user content, communication or personalization settings.</p>
                  <p>You may be required to sign up for an account on the site. You promise to provide us with accurate, complete, and up-to-date registration information about yourself.</p>
                  <p>You agree that you will only use the site for your own personal or organizational use, and not on behalf of or for the benefit of any third party. You may not transfer your account to anyone else without our prior written permission.</p>
                  <p>You may not select as your UBIDaccount name a name that you don’t have the right to use, or another person’s name with the intent to impersonate that person. UBID reserves the right to refuse registration of or cancel a UBID account name at its discretion.UBIDreserves the right to share your information on our website, without your address/phone number/email addresses.</p>
                </div>
                <div>
                  <h3>Operating your account on the Site.</h3>
                  <p>As a User, you have the option of creating an account or simply browsing the website or downloading a mobile application.</p>
                </div>
                <div>
                  <h3>Creative Business Partner</h3>
                  <p>Once you visit the website, you may select the ‘Creative Business Partner’ option and register by by providing specific information about yourself and your work and create a profile page on the Company website. The information you will need to provide shall include</p>
                  <ol type="i">
                    <li>Name.</li>
                    <li>Phone Number.</li>
                    <li>Email Id.</li>
                    <li>Address.</li>
                    <li>Proof of Identity (Government approved).</li>
                    <li>CIN (in case of a registered firm as CBP).</li>
                    <li>Highest qualification document (from freelance\individual).</li>
                    <li>GST number.</li>
                    <li>Service being offered on the Platform.</li>
                  </ol>
                  <p>You have the option of writing about your work and uploading your work images to attract the customer. On your profile page, there are several things you may do. Besides listing the services/products you offer, you may upload your work images, write information about yourself, view all listed projects. In order to place bids on the projects to win them and view contact details of customers you will need to subscribe.</p>
                  <p>Thereafter, as a CBP,you may subscribe to a Free Plan which allows you to view customer requirements but does not allow you to place a bid. To bid you have to subscribe to Beginner or Go-Pro Plans on the payment of the respective monthly or annual subscription fee. The ‘Beginner’ Plan allows you to see contact details of customers only when your bid is acceptedwhile the ‘Go-Pro’ Plan allows you to view the contact details just after placing the bid and you wont need to wait for the bid to be accepted.The type of plan and amount of such Subscription Fees shall be at the discretion of UBID. Provided further that UBID may decide to waive the subscription fee either in part or in full at it’s sole discretion.</p>
                  <p>Bids may be accepted or rejected at the customers discretion. In case your bid is rejected you may choose to put in a fresh bid. Customer requirements remain visible for up to 60 days and your fresh bid will need to be put up within that time.</p>
                  <p>We encourage users to ensure they do all the required verification before placing a bid. While UBID insists that all registered partners provide quality service and product, UBID accepts no liability for any fault in service/payment/quality/warranty/delays/promises made by either party.You agree thatUBID will not be responsible for any kind of damages, loss, dispute or discrepancies arising out of any bid accepted or any promise made. You also agree to hold UBIDIndia Private Limited blameless and not liable or responsible for any kind of withdrawal of contract or breach of contract by the User.</p>
                </div>
                <div>
                  <h3>Posts</h3>
                  <p>Anything posted, uploaded, shared, stored, or otherwise provided to us to share on&nbsp;<a href="https://www.ubidindia.com" target="_blank">www.ubidindia.com</a>&nbsp;or through any third-party website or social networking sites on the UBID account or a page owned or managed by UBID, is referred to as a “Post” in these Terms. There are a few rules that apply to all Posts.</p>
                  <p>UBID&nbsp;(<a href="https://www.ubidindia.com" target="_blank">www.ubidindia.com</a>)&nbsp;will publish information shared with us by Users, relating to User information including any information and images provided by you. We try to ensure that the information posted or published is verified to best of our knowledge, but we do not guarantee that the information on the website is up-to-date, accurate or complete, nor do we guarantee the authenticity of the information. We make best efforts to compile the content of the website and try to ensure that the information posted is genuine, however, there is possibility that the information put up is not genuine. We do not guarantee the quality, safety or legality of the content posted on the website.</p>
                  <p><em>Limited License to Us:</em>&nbsp;You hereby grant UBID license to translate, modify, reproduce, and otherwise act with respect to your Posts to enable us to provide, improve, and notify you about new features within&nbsp;<a href="https://www.ubidindia.com" target="_blank">www.ubidindia.com</a>.&nbsp;You understand and agree that we may need to make changes to your Posts to conform and adapt those Posts to the technical requirements of networks, devices, services, or media, and this license includes the rights to do so. For example, we may need to modify your Post to make sure it is viewable on an iPhone as well as a computer. You understand and agree that you grant UBID the license to use and UBID may also use posts for promotional uses.</p>
                  <p>If you would like us to share your Post with other users on &nbsp;<a href="https://www.ubidindia.com" target="_blank">www.ubidindia.com</a>,&nbsp; then you grant us the license as mentioned in the paragraph above, as well as a license to display, perform, and distribute your Post. Also, you grant all other users of &nbsp;<a href="https://www.ubidindia.com" target="_blank">www.ubidindia.com</a>&nbsp; a license to access the Post, and to use and exercise all rights in it, as permitted by the functionality of &nbsp;<a href="https://www.ubidindia.com" target="_blank">www.ubidindia.com</a>&nbsp;. We reserve the right to remove any content from &nbsp;<a href="https://www.ubidindia.com" target="_blank">www.ubidindia.com</a>&nbsp;at any time, for any reason (including, but not limited to, if someone alleges you contributed that content in violation of these Terms), in our sole discretion, and without notice.</p>
                  <p>Term of License: You agree that the licenses you grant are royalty-free, perpetual, irrevocable, and worldwide. This is a license only – your ownership in Posts is not affected.</p>
                </div>
                <div>
                  <h3>Intellectual Property and Reporting Infringement</h3>
                  <p>We respect others’ intellectual property rights, and we reserve the right to delete or disable content alleged to be infringing, and to terminate the accounts of repeat alleged infringers. You promise to abide by copyright notices, trademark rules, information, and other restrictions you may receive from us or that are posted on &nbsp;<a href="https://www.ubidindia.com" target="_blank">www.ubidindia.com</a>&nbsp;.</p>
                  <p>You understand that we own &nbsp;<a href="https://www.ubidindia.com" target="_blank">www.ubidindia.com</a>&nbsp;. These Terms do not grant you any right, title or interest in UBID India Private Limited, UBID or &nbsp;<a href="https://www.ubidindia.com" target="_blank">www.ubidindia.com</a>,&nbsp; or our trademarks, logos, and other intellectual property.</p>
                </div>
                <div>
                  <h3>Acceptable Use Policy</h3>
                  <p>You are responsible for all your activity in connection with &nbsp;<a href="https://www.ubidindia.com" target="_blank">www.ubidindia.com</a>.&nbsp;Due to the global nature of the internet, through the use of our network, you hereby agree to comply with all local rules relating to online conduct and that which is considered acceptable Content. Make sure that you use &nbsp;<a href="https://www.ubidindia.com" target="_blank">www.ubidindia.com</a>&nbsp;in a manner that complies with the law. If your use of &nbsp;<a href="https://www.ubidindia.com" target="_blank">www.ubidindia.com</a>&nbsp; is prohibited by applicable laws, then you aren’t authorized to use &nbsp;<a href="https://www.ubidindia.com" target="_blank">www.ubidindia.com</a>.&nbsp; We cannot and won’t be responsible for you using &nbsp;<a href="https://www.ubidindia.com" target="_blank">www.ubidindia.com</a>&nbsp;in a way that breaks the law.</p>
                  <p>You also agree that you will not contribute any Post or otherwise use &nbsp;<a href="https://www.ubidindia.com" target="_blank">www.ubidindia.com</a>&nbsp;in a manner that:</p>
                  <ul class="ml-4">
                    <li>Is fraudulent or threatening.</li>
                    <li>Jeopardizes the security of your &nbsp;<a href="https://www.ubidindia.com" target="_blank">www.ubidindia.com</a>&nbsp;account or anyone else’s (such as allowing someone else to log into &nbsp;<a href="https://www.ubidindia.com" target="_blank">www.ubidindia.com</a>&nbsp;as you, or sharing your account or password with someone);</li>
                    <li>Attempts, in any manner, to obtain the password, account, or other security information of any other user;</li>
                    <li>Violates the security of any computer network, or cracks any passwords or security encryption codes;</li>
                    <li>Runs any form of auto-responder or “spam” on &nbsp;<a href="https://www.ubidindia.com" target="_blank">www.ubidindia.com</a>,&nbsp; or any processes that run or are activated while you are not logged into &nbsp;<a href="https://www.ubidindia.com" target="_blank">www.ubidindia.com</a>,&nbsp; or that otherwise interferes with the proper working of &nbsp;<a href="https://www.ubidindia.com" target="_blank">www.ubidindia.com</a>&nbsp;(including placing an unreasonable load on &nbsp;<a href="https://www.ubidindia.com" target="_blank">www.ubidindia.com</a>&nbsp;infrastructure);</li>
                    <li>“Crawls,” “scrapes,” or “spiders” any page, data, or portion of &nbsp;<a href="https://www.ubidindia.com" target="_blank">www.ubidindia.com</a>&nbsp;(through use of manual or automated means);</li>
                    <li>Copies or stores any significant portion of the content on &nbsp;<a href="https://www.ubidindia.com" target="_blank">www.ubidindia.com</a>&nbsp;;</li>
                    <li>Decompiles, reverse engineers, or otherwise attempts to obtain the source code or underlying ideas or information of or relating to &nbsp;<a href="https://www.ubidindia.com" target="_blank">www.ubidindia.com</a>.&nbsp;</li>
                    <li>Replicates, duplicates, copies, trades, sells, resells nor exploits for any commercial reason any part, use of, or access to &nbsp;<a href="https://www.ubidindia.com" target="_blank">www.ubidindia.com</a>&nbsp; sites.</li>
                  </ul>
                </div>
                <div>
                  <h3>Other Users and Third-Parties</h3>
                  <p>Posts posted to &nbsp;<a href="https://www.ubidindia.com" target="_blank">www.ubidindia.com</a>.&nbsp;comare the sole responsibility of the person or organization from whom such content originated. You access all such content at your own risk. We aren’t liable for any errors or omissions in any post and you hereby release us from any damages or loss you might suffer in connection with a Post.</p>
                  <p><strong>Others Users on</strong>&nbsp;<a href="https://www.ubidindia.com" target="_blank">www.ubidindia.com</a>:&nbsp;</p>
                  <p>Your interactions with organizations and individuals found on or through &nbsp;<a href="https://www.ubidindia.com" target="_blank">www.ubidindia.com</a>&nbsp; and any other terms, conditions, warranties or representations associated with such dealings, are solely between you and such organizations and individuals. You agree that &nbsp;<a href="https://www.ubidindia.com" target="_blank">www.ubidindia.com</a>&nbsp;shall not be responsible or liable for any loss or damage of any sort incurred as the result of any such dealings. We cannot guarantee the identity of any Users with access to &nbsp;<a href="https://www.ubidindia.com" target="_blank">www.ubidindia.com</a>&nbsp;and are not responsible for which Users gain access to our products and services.</p>
                </div>
                <div>
                  <h3>Third-Party Content:</h3>
                  <p>&nbsp;<a href="https://www.ubidindia.com" target="_blank">www.ubidindia.com</a>&nbsp;may contain links or connections to third party websites or services that are not owned or controlled by us. UBID has no control over, and assumes no responsibility for, the content, accuracy, privacy policies, or practices of or opinions expressed in any third-party websites. You release and hold us harmless from any and all liability arising from your use of any third-party website or service.</p>
                  <p>In the event that you have a dispute with one or more other users of &nbsp;<a href="https://www.ubidindia.com" target="_blank">www.ubidindia.com</a>&nbsp;or with a third party, you release us, our officers, employees, agents, and successors from claims, demands, and damages of every kind or nature, known or unknown, suspected or unsuspected, disclosed or undisclosed, arising out of or in any way related to such disputes and/or UBID.</p>
                </div>
                <div>
                  <h3>Indemnity</h3>
                  <p>All users herein agree to insure and hold UBID India Private Limited, it’s Directors, our subsidiaries, affiliates, agents, employees, officers, partners and/or licensors blameless or not liable for any claim or demand, which may include, but is not limited to, reasonable attorney fees made by any third party which may arise from any content a user of our site may submit, post, modify, transmit or otherwise make available through our Services, the use of Services or your connection with these Services, your violations of the Terms of Use and/or your violation of any such rights of another person.</p>
                </div>
                <div>
                  <h3>Terminating Your Account</h3>
                  <p>Failure to follow any of these Terms shall constitute a breach of these Terms, which may result in immediate termination of your account. UBID has the sole right to decide whether you are in violation of any of the restrictions set forth in these Terms.</p>
                  <p>UBID is free to terminate (or suspend access to) your use of &nbsp;<a href="https://www.ubidindia.com" target="_blank">www.ubidindia.com</a>,&nbsp; or your account, for any reason at our discretion. We will try to provide advance notice to you prior to our terminating your account, but we may not do so if we determine it would be impractical, illegal, not in the interest of someone’s safety or security, or otherwise harmful to the rights or property of UBID.</p>
                  <p>UBID also allows you to deleteor deactivate your account or terminate your subscription at any time. In order to delete or deactivate your account or cancel any subscription, you will have to raise a ticket from support page or drop an email at <a href="mailto:contact@ubidindia.com">contact@ubidindia.com</a>. To cancel any subscription, you will need to raise a ticket from support page or drop an email at <a href="mailto:contact@ubidindia.com">contact@ubidindia.com</a> at least three days prior to the period of your subscription coming to an end. You need to remember that in the event that such intimation is not sent then your subscription shall be auto-renewed. When you delete your account, any Posts associated with that account will also be deleted. However, any Post that you have made public may remain available.</p>
                  <p>You understand and agree that it may not be possible to completely delete your content from records or backups, and that your Posts may remain viewable elsewhere to the extent that they were copied or stored by other users. Please refer to our Privacy Policy to understand how we treat information you provide to us after you have stopped using &nbsp;<a href="https://www.ubidindia.com" target="_blank">www.ubidindia.com</a>.&nbsp;</p>
                  <p>You agree that some of the obligations in these Terms will be in force even after you terminate your account. All of the following terms will survive termination: any obligation you have to pay us or indemnify us, any limitations on our liability, any terms regarding ownership or intellectual property rights, terms regarding disputes between us, and any other terms that, by their nature, should survive termination of these Terms.</p>
                  <p>If you have deleted your account by mistake, contact us immediately at <a href="mailto:contact@ubidindia.com">contact@ubidindia.com</a> – we will try to help, but unfortunately, we can’t promise that we can recover or restore anything.</p>
                </div>
                <div>
                  <h3>Privacy on UBID</h3>
                  <p>UBID takes your privacy very seriously. For the current UBID Privacy Policy, please <a href="{{route('privacypolicy')}}">click here</a>.</p>
                  <p>Every registered User's registration data and various other personal information are strictly protected by the UBID’s Privacy Policy. As a registered User, you herein consent to the collection and use of the information provided, including the transfer of information within India and/or other countries for storage, processing or use by UBIDand/or our subsidiaries and affiliates.</p>
                </div>
                <div>
                  <h3>Proprietary Rights</h3>
                  <p>You do hereby acknowledge and agree that UBID’s Services and any essential software that may be used in connection with our Services shall contain proprietary and confidential material that is protected by applicable intellectual property rights and other laws. Furthermore, you herein acknowledge and agree that any Content which may be contained in any advertisements or information presented by and through our Services or by advertisers is protected by copyrights, trademarks, patents or other proprietary rights and laws. Therefore, except for that which is expressly permitted by applicable law or as authorized by UBIDor such applicable licensor, you agree not to alter, modify, lease, rent, loan, sell, distribute, transmit, broadcast, publicly perform and/or created any plagiaristic works which are based on UBIDServices (e.g. Content or Software), in whole or part.</p>
                  <p>UBID here in has granted you personal, non-transferable and non-exclusive rights and/or license to make use of our Software, as long as you do not, and shall not, allow any third party to duplicate, alter, modify, create or plagiarize work from, reverse engineer, reverse assemble or otherwise make an attempt to locate or discern any source code, sell, assign, sublicense, grant a security interest in and/or otherwise transfer any such right in the Software. Furthermore, you do herein agree not to alter or change the Software in any manner, nature or form, and as such, not to use any modified versions of the Software, including and without limitation, for the purpose of obtaining unauthorized access to our Services. Lastly, you also agree not to access or attempt to access our Services through any means other than through the interface which is provided by UBIDfor use in accessing our Services.</p>
                  <p>You herein acknowledge, understand and agree that all of the UBIDtrademarks, copyright, trade name, service marks, and other UBIDlogos and any brand features, and/or product and service names are trademarks and as such, are and shall remain the property of UBIDIndia Private Limited. You herein agree not to display and/or use in any manner the UBIDlogo or marks without obtaining UBID’s prior written consent.</p>
                </div>
                <div>
                  <h3>Changes to the Terms</h3>
                  <p>We are constantly trying to improve our products and services, so these Terms may need to change along with UBID. We reserve the right to change the Terms at any time. Your continued use of the Services provided, after such posting of any updates, changes, and/or modifications shall constitute your acceptance of such updates, changes and/or modifications, and as such, frequent review of this Agreement and any and all applicable terms and policies should be made by you to ensure you are aware of all terms and policies currently in effect.</p>
                  <p>If you don’t agree with the new Terms, you are free to reject them; unfortunately, that means you will no longer be able to use the UBID Platform or its mobile applications or any of its services. If you use UBID in any way after a change to the Terms is effective, that means you agree to all of the changes.</p>
                  <p>Except for changes by us as described here, no other amendment or modification of these Terms will be effective unless in writing and signed by both you and us.</p>
                </div>
                <div>
                  <h3>No Warranties</h3>
                  <p>&nbsp;<a href="https://www.ubidindia.com" target="_blank">www.ubidindia.com</a>&nbsp; is provided to you on an “as-is” basis. This means we provide it to you without any express or implied warranties of any kind. That includes any implied warranties of merchantability, fitness for a particular purpose, non-infringement, or any warranty that the use of &nbsp;<a href="https://www.ubidindia.com" target="_blank">www.ubidindia.com</a>&nbsp;will be uninterrupted or error-free. </p>
                  <p>Any information or material downloaded or otherwise obtained by way of UBIDservices or software shall be accessed at your sole discretion and sole risk, and as such you shall be solely responsible for and hereby waive any and all claims and causes of action with respect to any damage to your computer and/or internet access, downloading and/or displaying, or for any loss of data that could result from the download of any such information or material.</p>
                  <p>Products purchased or offered through UBID, are provided without any warranty of any kind from UBID India Private Limited. </p>
                </div>
                <div>
                  <h3>Limitation of Liability</h3>
                  <p>To the fullest extent allowed by applicable law, under no circumstances and under no legal theory shall UBID, its licensors, or its suppliers be liable to you or to any other person for:</p>
                  <ol type="1">
                    <li>Any indirect, special, incidental, or consequential damages of any kind, or</li>
                    <li>Any amount, in the aggregate, in excess of the greater of INR 10,000/- (INR ten thousand only)</li>
                    <p>or</p>
                  </ol>
                  <p>In case of a failed or incomplete service that may result in damage to User asset, Liabilities of the company is going to be limited to a maximum of INR 15,000/- only.</p>
                </div>
                <div>
                  <h3>Assignment</h3>
                  <p>You may not assign, delegate or transfer these Terms or your rights or obligations hereunder, or your &nbsp;<a href="https://www.ubidindia.com" target="_blank">www.ubidindia.com</a>&nbsp; account, in any way (by operation of law or otherwise) without our prior written consent. We may transfer, assign, or delegate these Terms and our rights and obligations without consent.</p>
                </div>
                <div>
                  <h3>Choice of Law</h3>
                  <p>These Terms are governed by and will be construed under applicable laws of India, without regard to the conflicts of law provisions thereof.</p>
                </div>
                <div>
                  <h3>Dispute Resolution and Arbitration</h3>
                  <p>Any dispute arising from or relating to the subject matter of these Terms shall be resolved through following methods:</p>
                  <ol type="1">
                    <li>An escalation that will be addressed by company representative</li>
                    <li>Executive escalation that will be addressed by a senior executive of company</li>
                    <li>Consumer court at customer discretion within jurisdiction of Rangareddy, Telangana.</li>
                  </ol>
                  <p>Any dispute that remains unresolved through the above mechanism shall be finally settled by arbitration in Rangareddi, Telangana, India, in accordance with the Indian Arbitration and Conciliation Act, 1996. For all purposes of these Terms, you consent to exclusive jurisdiction of the courts in Rangareddy, Telangana, India.</p>
                </div>
                <div>
                  <h3>No Third-Party Beneficiaries</h3>
                  <p>As a User, you agree there is no third-party beneficiaries intended under these Terms. </p>
                </div>
                <div>
                  <h3>No Joint Venture</h3>
                  <p>You hereby acknowledge and agree that you are not an employee, agent, or joint venture of UBID India Private Limited, and you do not have any authority of any kind to bind us in any respect whatsoever.</p>
                </div>
                <div>
                  <h3>Waiver</h3>
                  <p>The failure of either you or us to exercise, in any way, any right herein shall not be deemed a waiver of any further rights hereunder. </p>
                </div>
                <div>
                  <h3>Severability</h3>
                  <p>If any provision of these Terms is found to be unenforceable or invalid, that provision will be limited or eliminated, to the minimum extent necessary, so that these Terms shall otherwise remain in full force and effect and enforceable.</p>
                </div>
                <div>
                  <h3>Entire Agreement</h3>
                  <p>You agree that these Terms are the complete and exclusive statement of the mutual understanding between you and us, and that it supersedes and cancels all previous written and oral agreements, communications and other understandings relating to the subject matter of these Terms.</p>
                </div>
                <div>
                  <h3>Violations</h3>
                  <p>Please report any and all violations of this TOU to UBID as follows:</p>
                </div>
                <div class="contact-info">
                  <p><b>Mailing Address:</b></p> B-118, Greenspace The Hive,<br> Road-13, Alkapur Township,<br> Puppalguda, Hyderabad,<br> Telangana, India- 500089<br>
                  <strong>Telephone:</strong> +91 807 288 6122<br>
                  <strong>E-mail:</strong> contact@ubidindia.com <br>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
  </section>
  <!-- END content section-->
  <!-- TogglerMenu JS-->
  <script>
    const navMenu = document.querySelector("#navMenu");
    navMenu.addEventListener("click", () => {
      navMenu.classList.toggle("active");
    });
  </script>
  <!-- Bootstrap JS -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>