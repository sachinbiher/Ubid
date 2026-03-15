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
      font-weight: 600;
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
    ol li {
      font-size: 18px;
      color: #666;
      padding: 4px 0;
      letter-spacing: 1px;
    }

    @media (max-width:768px) {
      .terms-container {
        margin: 0;
        width: 100%;
      }
    }

    /* ol Styling */
    ol {
      list-style-type: none;
      counter-reset: item;
      margin: 0;
      padding: 0;
    }

    li {
      display: table;
      counter-increment: item;
      margin-bottom: 0.6em;
    }

    li:before {
      content: counters(item, ".") ". ";
      display: table-cell;
      padding-right: 0.6em;
    }

    li li {
      margin: 0;
    }

    li li:before {
      content: counters(item, ".") " ";
    }

    .scope p {
      margin-bottom: 0 !important;
    }

    table,
    th,
    td {
      border: 1px solid black;
      border-collapse: collapse;
      padding: 10px 50px;
      margin: 15px 0;
    }

    @media (max-width:600px) {

      .terms-body p,
      .terms-body ul li,
      ol li {
        font-size: 16px;
      }

      th,
      td {
        padding: 10px 15px;
      }
    }
  </style>
</head>

<body style="background-color: #fff;">
  <header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container-fluid">
        <a class="navbar-brand" href="{{route('login')}}" >
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
              <h1>CREATIVE BUSINESS PARTNER AGREEMENT</h1>
              <hr>
            </section>
            <div class="terms-body">
              <div class="content">
                <h3>Welcome to UBID !</h3>
                <p><strong><em>PLEASE READ THE FOLLOWING CREATIVE BUSINESS PARTNER AGREEMENT CAREFULLY. BY ACCESSING OR USING OUR PLATFORMS AND OUR SERVICES, YOU AGREE TO BE BOUND BY THE TERMS AND ALL CONDITIONS INCORPORATED HEREIN BY REFERENCE. IT IS YOUR RESPONSIBILITY AS, THE USER, OR PROSPECTIVE USER TO READ THE TERMS AND CONDITIONS BEFORE PROCEEDING TO USE THIS PLATFORM. IF YOU DO NOT EXPRESSLY AGREE TO ALL OF THE TERMS AND CONDITIONS, THEN PLEASE DO NOT ACCESS OR USE SERVICES.</em></strong></p>
                <p>This Agreement to Use the Services provided by UBID INDIA PRIVATE LIMITED (the “Agreement”) is entered into by and between (Kindly choose the relevant section and fill out the necessary details within the Blanks and click on _____ to submit the completed document):</p>
                <p>UBID INDIA PRIVATE LIMITED, a company incorporated under the Companies Act 2013, and having its registered office at Plot: C-2/B, C-2/C, C-2/E & C-2/F, Alkapur Township, Puppalaguda, Hyderabad, Telangana, India, 500089, also the owner of brand, website, mobile application and services under name <strong>UBID</strong> (<a href="https://www.ubidindia.com" target="_blank">www.ubidindia.com</a>) - hereinafter referred to as <strong>“Company”</strong>, (which expression shall, unless it be repugnant to the context or meaning thereof, be deemed to mean and include its successors and assigns) of the One Part;</p>
                <p>AND</p>
                <p><strong>Creative Business Partner</strong> here in after referred to as “CBP”, as the case may be, (which expression shall, unless it be repugnant to the context or meaning thereof, be deemed to mean and include its successors and permitted assigns) of the Other Part.</p>
                <p>Company and CBP are individually referred to as a <strong>“Party”</strong> and collectively as the <strong>“Parties”</strong>. </p>
                <div>
                  <h3>WHEREAS:</h3>
                  <ol type="A">
                    <li>UBID(Brand Name), has a Website (<a href="https://www.ubidindia.com" target="_blank">www.ubidindia.com</a>), mobile application and service solely owned and operated by UBID India Private Limited, is a platform of Home Decor suppliers for the purpose of enabling a potential customer interested in availing of such services to connect with suppliers;</li>
                    <li>The CBP (supplier) is engaged, inter-alia, in the business of home decor (“CBP Services”), and has represented to the Company that it has the required skills, expertise, resources and know-how to provide expert assistance and advice on the implementation of such CBPCBP Services;</li>
                    <li>The Company has agreed to generate possible home décor customer requirements (“projects”) that the CBP may bid for;</li>
                    <li>Based on the aforesaid representations, the Parties, intending to be legally bound, hereby agree to the following scope of services, payment terms and all other terms and conditions) contained in this Agreement.</li>
                  </ol>
                </div>
                <br>
                <div>
                  <ol>
                    <li>
                      <h3>DEFINITIONS</h3>
                      <div class="row definition">
                        <div class="col-sm-3">
                          <p>“Accepted Bid”</p>
                        </div>
                        <div class="col-sm-9">
                          <p>means acceptance of Services request for Products or Services by CBP resulting in a binding contract governed by the terms and conditions of the Agreement for the supply of the Services/Products to Customer (and where applicable resulting Deliverables) specified in such Customer Requirement;</p>
                        </div>
                        <div class="col-sm-3">
                          <p>“Applicable Law”</p>
                        </div>
                        <div class="col-sm-9">
                          <p>means all laws, legislation, regulations, binding codes of practice, or rules or requirements of any relevant government or governmental agency applicable to the Agreement, an Accepted Bid, Services/Products and Deliverables; and either Party, (as the context requires);</p>
                        </div>
                        <div class="col-sm-3">
                          <p>“Business Day”</p>
                        </div>
                        <div class="col-sm-9">
                          <p>means a normal working day other than a Saturday, Sunday or registered public holiday in the state in which delivery is to occur;</p>
                        </div>
                        <div class="col-sm-3">
                          <p>Creative Business Partners- <strong>CBP</strong></p>
                        </div>
                        <div class="col-sm-9">
                          <p>Means the vendors being those who are into the field of Interior/Exterior design, Architect, Freelancers & Home Décor suppliers and willing to offer/sell their services & products on the platform;</p>
                        </div>
                        <div class="col-sm-3">
                          <p>“Calendar Day”</p>
                        </div>
                        <div class="col-sm-9">
                          <p>means a period from midnight on a given day to midnight on the next day. Thus, a calendar day is a period of 24 hours starting from midnight;</p>
                        </div>
                        <div class="col-sm-3">
                          <p>“Change in Control”</p>
                        </div>
                        <div class="col-sm-9">
                          <p>means where a Person who Controls the Supplier ceases to do so;</p>
                        </div>
                        <div class="col-sm-3">
                          <p>“Control” and “Controlled”</p>
                        </div>
                        <div class="col-sm-9">
                          <p>means, the power of a Person to secure that the Supplier’s affairs are conducted in accordance with the wishes of that Person;</p>
                        </div>
                        <div class="col-sm-3">
                          <p>“Customer”</p>
                        </div>
                        <div class="col-sm-9">
                          <p>means (i) an end user customer of Company; or (ii) a subscriber to the services/products of any Company Network, using the Services/Products or Deliverables; </p>
                        </div>
                        <div class="col-sm-3">
                          <p>“Delivery Address”</p>
                        </div>
                        <div class="col-sm-9">
                          <p>means the address, and as applicable, the specific location (including the site of installation) to which Services/Products or Deliverables are to be supplied, as specified in the relevant Accepted Bid or otherwise designated by Customer in writing;</p>
                        </div>
                        <div class="col-sm-3">
                          <p>“Deliverables”</p>
                        </div>
                        <div class="col-sm-9">
                          <p>means any products resulting from the provision of the Services/Products including Documentation, as may be agreed by the Parties expressly in writing;</p>
                        </div>
                        <div class="col-sm-3">
                          <p>“Delivery Date”</p>
                        </div>
                        <div class="col-sm-9">
                          <p>means the date on which Services/Products or Deliverables are to be delivered to, or performed at, the Delivery Address, as agreed by the Parties in writing;</p>
                        </div>
                        <div class="col-sm-3">
                          <p>“Insolvency Event”</p>
                        </div>
                        <div class="col-sm-9">
                          <p>means:
                          <ol type="i">
                            <li>Entry into a voluntary arrangement with creditors.</li>
                            <li>Becoming subject to an administration order.</li>
                            <li>Going into liquidation (otherwise than for the purpose of bona fide solvent amalgamation or reconstruction).</li>
                            <li>Having an encumbrancer take possession of, or a receiver appointed over any assets.</li>
                            <li>Ceasing or is in the process to cease to carry on business or Any similar event in any relevant jurisdiction. </li>
                          </ol>
                          </p>
                        </div>
                        <div class="col-sm-3">
                          <p>“Intellectual Property Rights"</p>
                        </div>
                        <div class="col-sm-9">
                          <p>means: <br> intellectual property rights of any kind and rights, title and interest of a like nature wherever and whenever arising in respect of or in connection with, including, without limitation, any patents, copyright, trademarks, service marks, trade names, domain names, designs, computer software, database, and any other intellectual property rights however designated, in each case whether registered or unregistered, all registrations and recordings thereof, all applications in connection therewith, in any part of the world including trade secrets, know-how, all confidential and proprietary information with respect to a specific product or process and information, including but not limited to written materials, ideas, documentation, plans and policies, software, algorithms, programs (including source code, application graphic user interface), sales strategies, databases of customers, employees, marketing, business plan, financial and personnel information whether in oral, graphic or electronic form. </p>
                        </div>
                        <div class="col-sm-3">
                          <p>“Person”</p>
                        </div>
                        <div class="col-sm-9">
                          <p>means any individual, corporation, limited liability company, partnership, limited liability partnership, joint venture, joint stock company, trust, estate, company and association, whether organised for profit or otherwise;</p>
                        </div>
                        <div class="col-sm-3">
                          <p>“Product”</p>
                        </div>
                        <div class="col-sm-9">
                          <p>means any product which may include Hardware, Software, spares, components, and associated Documentation or as otherwise agreed between the Parties in writing; </p>
                        </div>
                        <div class="col-sm-3">
                          <p>“Schedule”</p>
                        </div>
                        <div class="col-sm-9">
                          <p>means a Schedule(s) to the Agreement;</p>
                        </div>
                        <div class="col-sm-3">
                          <p>“Customer Requirements” </p>
                        </div>
                        <div class="col-sm-9">
                          <p>means a request for services (together with any agreed document referred to in or associated with such customer requirements), posted on the Company website by the Customer for Services/Products and where applicable Deliverables;</p>
                        </div>
                        <div class="col-sm-3">
                          <p>“Specifications”</p>
                        </div>
                        <div class="col-sm-9">
                          <p>means collectively the Customer Requirements Specification and the Agreed Specification;</p>
                        </div>
                        <div class="col-sm-3">
                          <p>“Standards”</p>
                        </div>
                        <div class="col-sm-9">
                          <p>means any relevant standards promulgated, specified or otherwise published by any international, regional, governmental, industry wide or other bona fide standards setting organisation, governmental authority, consortium, trade association, special interest group or any other like forum or entity;</p>
                        </div>
                      </div>
                    </li>
                    <!-- 1 end-->
                    <li>
                      <h3>SCOPE OF SERVICES/PRODUCTS</h3>
                      <ol>
                        <li>The Company hereby engages CBP to provide the Services/Products in connection with the Project as shall be determined from time to time and such other services as may be assigned by the Company from time to time (“Services/Products”).</li>
                        <li>CBP will be providing door step services, for products and home décor services at customer location. They will be expected to have their own conveyance and travel from their residence or place of work to provide service/products to customers.</li>
                        <li class="scope">CBP will need to register by providing specific information about the CBP and create a profile page on the Company website. The information provided by CBP shall include <p>i. Name;</p>
                          <p>ii. Phone Number;</p>
                          <p>iii. Email Id;</p>
                          <p>iv. Address;</p>
                          <p>v. Proof of Identity (Government approved);</p>
                          <p>vi. GST number;</p>
                          <p>vii. CIN (in case of a registered firm as CBP);</p>
                          <p>viii. Highest qualification document (from freelance\individual);</p>
                          <p>ix. Service being offered on the Platform;</p>
                        </li>
                        <li>On its profile page, there are several things the CBP can do. Besides listing the services/products they offer, the CBP may upload their work images, write information about themselves, view at all listed projects, place bids on the projects to win them and view contact details of customers.</li>
                        <li>CBP will need to subscribe to a particular subscription plan as may be decided by the Company from time to time. The amount and period of subscription shall be at the discretion of the Company.</li>
                        <li>Presently the CBP may choose to subscribe to a Free Plan which permits one to see all the content on the site but does not permit one to place a Bid. In order to place a Bid, the CBP may also choose either Beginner or Go-Pro Plans on the payment of the respective monthly or annual subscription fee. The ‘Beginner’ Plan allows the subscriber to see contact details of customers only when his/her bid is accepted while the ‘Go-Pro’ Plan allows the subscriber to view the contact details just after placing the bid. He/she doesn’t need to wait for the bid to be accepted. The type of plan and amount of such Subscription Fees shall be at the discretion of the Company. Provided further that the Company may decide to waive the subscription fee either in part or in full at the Company’s sole discretion.</li>
                        <li>Freelancers may have to undergo a proctored test, to get registered as CBP. The Company may provide details of CBP to local Police Stations and also arrange for surveillance\background verifications to ensure safety of customers.</li>
                      </ol>
                    </li>
                    <!-- 2 end-->
                    <li>
                      <h3>BIDDING AND CUSTOMER REQUIREMENTS</h3>
                      <ol>
                        <li>The Company shall make available / visible to all registered CBP all customer requirements as may be posted by customers on the Company website. Customer requirements will include besides the requirements, the customer’s maximum budget.</li>
                        <li>On the Company making available/visible (list) customer requirements, the CBP shall place a ‘Bid’ against the listed project. CBP has to make his/her own judgment while placing the Bid against the listed project;</li>
                        <li>The Company shall keep available customer requirements for up to 60 hours. All bids will need to be placed within that time. Where Bids have been rejected, CBPs have the opportunity to place another Bid provided that Bids must be placed within the abovementioned 60 hours;</li>
                        <li>A Bid shall, upon Acceptance form a binding contract governed by the terms and conditions of the Agreement for the supply of the Services/Products (and where applicable resulting Deliverables) specified in such Bid (“Accepted Bid”). Any contract purported to be entered into between the Parties under the Agreement whether verbally, by e-mail or otherwise not in accordance with this Clause 3, shall not be binding.</li>
                        <li>Once the Bid is accepted, the CBP whose Bid is accepted can see the contact details of the customer. Thereafter, the aforementioned CBP can communicate directly with the customer in order to take the project further. Once contact between the CBP and the customer has been established, the CBP understands, acknowledges and accepts that the Company shall not bear any liability nor be responsible in any way for any in taking the project forward.</li>
                        <li>In the case of any complaint by Customer with respect to Service any discrepancy in the matter will be treated as customer being correct at all times, and any compensation provided to the customer will be charged to CBP.</li>
                        <li>The CBP agrees that the Company shall not bear any liability nor be responsible in any way for any fault in payment for service rendered, delays or promises made by CBP or customer.</li>
                      </ol>
                    </li>
                    <!-- 3 end-->
                    <li>
                      <h3>CUSTOMER FEEDBACK</h3>
                      <p>The CBP acknowledges, understands, and agrees that customer experience is the Company’s Priority and accordingly the Company takes feedback from customers seriously. The Company will take appropriate actions to ensure customer satisfaction. In the event of any complaints against any CBP, the Company shall take serious action against any such issues reported.</p>
                    </li>
                    <!-- 4 end-->
                    <li>
                      <h3>SUBSCRIPTION FEES</h3>
                      <ol>
                        <li>Subscription Fees shall be automatically charged on automatic renewal of the subscription. Provided that where the CBP chooses to discontinue the subscription, notice to the Company needs to be received by the Company three (3) days prior to the end of the subscription period. The BT understands and accepts that the Company shall not be responsible in the event that the notice to end the subscription has not been received by the Company up to 3 days prior to the end of the subscription and consequently the subscription has been renewed.</li>
                        <li>The payment to the Company shall be based on the subscription rates as shall be determined by the Company from time to time. All Subscription Fees are non-refundable. The payment will be made by the CBP to the company account. All payments shall be made by electronic transfer of funds.</li>
                        <li>The Fees is exclusive of Goods and Services Tax (“GST”) and is subject to deduction of applicable tax at source. CBP shall bear and pay all taxes, fees, expenses, charges, duties, etc., applicable on the Fees and any other payments under this Agreement.</li>
                        <li>All taxes (other than income tax), levies and duties, transport costs and similar charges from the delivery point shall be the responsibility of the CBP.</li>
                        <li>The Company shall at its discretion, change fee payment, with advance notice of at least 15 days, and such change shall apply to any Subscription raised post revision of Fees. The Company can set off and withhold any debt or sum owing to the Company by the CBP.</li>
                        <li>Terms applying to Fees: <ol>
                            <li>In the event that the CBP is required by law to make a withholding or deduction in respect of the Fees, the CBP will pay the Fees after deducting the required withholding or deduction to the Company. The CBP shall issue TDS / with-holding tax certificate / Form 16 for deposited tax with the government against such deductions;</li>
                            <li>If the Company has incorrectly charged any tax or information or documentation provided are not adequate, then the CBP shall reimburse equivalent amounts of the overpaid taxes/duties and penalties, within 15 days of such notice.</li>
                          </ol>
                        </li>
                      </ol>
                    </li>
                    <!-- 5 end-->
                    <li>
                      <h3>LIMITED LICENSE</h3>
                      <ol>
                        <li>The CBP hereby grants the Company a license to translate, modify, reproduce, and otherwise act with respect to CBP Posts or content. The CBP understands and agrees that the Company may need to make changes to such content to conform and adapt those Posts to the technical requirements of networks, devices, services, or media, and this license includes the rights to do so.</li>
                        <li>Any communications, content, video, photo, or other material of any kind that you e-mail, post, upload, store, or transmit through the Platform, including, videos, images, prompts, terms, replies, questions, tags, comments, recommendations, suggestions, top features, feature requests, product issues, testimonials, tips, and other data and information (your “Content”) will be treated as non-confidential and non-proprietary. The Company is free to use any ideas, concepts, techniques, know-how in your Content for any purpose not amounting to any commercial use.</li>
                        <li>If CBP shares a Post with other users on &nbsp;<a href="https://www.ubidindia.com" target="_blank">www.ubidindia.com</a>,&nbsp; then CBP grants the Company the license here in above, as well as a license to display, perform, and distribute said Post or content. Also, CBP grants all other users of &nbsp;<a href="https://www.ubidindia.com" target="_blank">www.ubidindia.com</a>&nbsp; a license to access the Post, and to use and exercise all rights in it, as permitted by the functionality of &nbsp;<a href="https://www.ubidindia.com" target="_blank">www.ubidindia.com</a>.&nbsp; The Company reserves the right to remove any content from &nbsp;<a href="https://www.ubidindia.com" target="_blank">www.ubidindia.com</a>&nbsp;at any time, for any reason (including, but not limited to, if someone alleges you contributed that content in violation of these Terms), in our sole discretion, and without notice.</li>
                      </ol>
                    </li>
                    <!-- 6 end-->
                    <li>
                      <h3>DELIVERY</h3>
                      <ol>
                        <li>The CBP shall deliver the products on the Delivery Date during such hours as may have been committed to the Customer, to the Delivery Address and ensure that receipt of products is signed for at the Delivery Address and recorded in Company systems.</li>
                        <li>Delivery of any Product shall be accompanied by: <ol>
                            <li>A list all of the products;</li>
                            <li>The Accepted Bid number; and</li>
                            <li>Such other information as reasonably requested by the Company.</li>
                          </ol>
                        </li>
                        <li>The CBP shall remove any debris, packing material, and waste, resulting from the delivery or Installation of a product and shall leave the Delivery Address (or installation site) in a neat and orderly fashion.</li>
                        <li>The CBP accepts and acknowledges that the said CBP shall be solely responsible for transportation and delivery of any products to the customer and that the Company shall not bear any liability nor be responsible in any way.</li>
                      </ol>
                    </li>
                    <!-- 7 end-->
                    <li>
                      <h3>LIQUIDATED DAMAGES</h3>
                      <ol>
                        <li>The CBP shall, on its Bid being accepted, achieve the Customer requirements and failure to do so constitutes breach of the Agreement which shall be considered incapable of remedy for the purposes of Clause 21.1.1 and the exercise of any termination right shall be without prejudice to Company’s right to claim liquidated damages.</li>
                        <li>In the event of a successful monetary claim for compensation from a Third Party, such monetary compensation will be set off against any payments to be made to the CBP concerned. Provided that the Company may at its discretion waive off any such amounts to be adjusted against payments to the Freelancer / Service Provider.</li>
                      </ol>
                    </li>
                    <!-- 8 end-->
                    <li>
                      <h3>SPECIFICATIONS</h3>
                      <ol>
                        <li>If any items or details are not expressly stated in the Specifications, but are required for the efficient, safe and stable commissioning, installation, construction, function, operation and maintenance of the products, the CBP shall include such items or details in or with the products and such items and details shall be deemed included notwithstanding such omission.</li>
                      </ol>
                    </li>
                    <!-- 9 end-->
                    <li>
                      <h3>CBP RESPONSIBILITES</h3>
                      <ol>
                        <li>CBP is responsible for all its activity in connection with the website and mobile applications! Due to the global nature of the internet, through the use of our network, CBP hereby agrees to comply with all local rules relating to online conduct and that which is considered acceptable Content. CBP undertakes to ensure that the Company website and mobile applications are used in a manner that complies with the law. The Company shall not in any way whatsoever be responsible for CBP using the Company website and mobile applications in a way that breaks the law.</li>
                        <li class="scope">CBP agrees that it will not contribute any Post or otherwise use the Company website and mobile applications in a manner that: <p>i. Is fraudulent or threatening;</p>
                          <p>ii. Jeopardizes the security of the CBP account or anyone else’s (such as allowing someone else to log into the Company website and mobile applications as you, or sharing your account or password with someone);</p>
                          <p>iii. Attempts, in any manner, to obtain the password, account, or other security information of any other user;</p>
                          <p>iv. Violates the intellectual property, privacy, publicity, or other rights of any individual or entity;</p>
                          <p>v. Is defamatory, obscene, threatening, harassing, or offensive;</p>
                          <p>vi. Runs any form of auto-responder or “spam” on the Company website and mobile applications, or any processes that run or are activated while you are not logged into the Company website or mobile applications, or that otherwise interferes with the proper working of the Company website and mobile applications (including placing an unreasonable load on the Company’s infrastructure);</p>
                          <p>vii. “Crawls,” “scrapes,” or “spiders” any page, data, or portion of the Company (through use of manual or automated means);</p>
                          <p>viii. Copies or stores any significant portion of the content on the Company website and mobile applications;</p>
                          <p>ix. Decompiles, reverse engineers, or otherwise attempts to obtain the source code or underlying ideas or information of or relating to the Company.</p>
                          <p>x. Replicates, duplicates, copies, trades, sells, resells nor exploits for any commercial reason any part, use of, or access to the Company Platforms.</p>
                        </li>
                        <li>The Company may, but is not obligated to, monitor or review any areas of the Site where user Content may be made available, including, but not limited to, chat rooms, repositories, discussion areas, replies, videos, product stories, product timelines, favorite features, feature requests, product issues, recommendations, tags, forms, and other user forums.</li>
                      </ol>
                    </li>
                    <!-- 10 end-->
                    <li>
                      <h3>REPRESENTATIONS AND WARRANTIES</h3>
                      <ol>
                        <li>The CBP represents and warrants that (during the Term unless otherwise stated): <ol>
                            <li>It is not (at the time of entering into an Accepted Bid) involved in any litigation, process, contract or investigation that could have a material impact its ability to perform its obligations under that Accepted Bid;</li>
                            <li>It has obtained and shall maintain all permissions, permits, licences and consents necessary for the CBP to supply the Services/Products and Deliverables in accordance with an Accepted Bid;</li>
                            <li>The use and possession of any Services/Products or Deliverables does not and will not infringe the Intellectual Property Rights of a third party; and</li>
                            <li>The CBP shall not download any company material, software, etc. for personal gain and provided that any such action would result in consequences to be determined by the Company;</li>
                          </ol>
                        </li>
                        <li>The CBP warrants that a Service shall: <ol>
                            <li>Comply with the Specifications;</li>
                            <li>Be performed by adequate numbers of appropriately skilled personnel, with due care and diligence and to such high standard of quality as is to be expected from an upper quartile expert provider of Services;</li>
                            <li>Be free from defects as regards its performance;</li>
                            <li>Be fit for any purpose held out by the CBP;</li>
                            <li>Maintain at all time cleanliness and hygiene guidelines as may be applicable</li>
                            <li>Comply with all Applicable Law and Standards; and</li>
                            <li>Be in accordance with the Customer requirements.</li>
                          </ol>
                        </li>
                        <li>In the event of any Complaint by a Customer is received by the Company or any Services found by the Company (during the Services Warranty Period to be in breach of any Services Warranty) then the Company may require the CBP to: <ol>
                            <li>Perform those Services again; or</li>
                            <li>Provide such additional Services as are necessary to resolve the complaint,</li>
                            <li>Within such time, deemed reasonable, as may be requested by a customer.</li>
                          </ol>
                        </li>
                        <li>If the CBP fails to comply with Clause 11.3, the Company may correct, or arrange for a third party to correct, any defect or failure, and the CBP undertakes and warrants to bear the reasonable costs of such correction.</li>
                        <li>The CBP acknowledges and warrants to ensure that customer experience is priority number one.</li>
                      </ol>
                    </li>
                    <!-- 11 end-->
                    <li>
                      <h3>AUDIT</h3>
                      <ol>
                        <li>The CBP shall not be required to preserve any records (the "Records").</li>
                        <li>The CBP shall allow the Company to audit at its own cost and by giving notice of 15 days in advance to the CBP and where applicable observe the CBP’s Records with reference to this Agreement.</li>
                      </ol>
                    </li>
                    <!-- 12 end-->
                    <li>
                      <h3>INSURANCE</h3>
                      <p>CBP shall have in force and maintain, at its own cost, such policies of insurance with a reputable and authorized insurer so as to ensure adequate level of insurance cover in respect of all its obligations, liabilities and indemnities to the Company under this Agreement, and shall, upon request by the Company, provide evidence of such policies. In the event that the Company allows the CBP to appoint a sub-contractor, the CBP shall ensure that such sub-contractor also has adequate insurance coverage.</p>
                    </li>
                    <!-- 13 end-->
                    <li>
                      <h3>INTELLECTUAL PROPERTY RIGHTS</h3>
                      <ol>
                        <li>The Company shall remain the sole and exclusive owner of all the rights, title and interest, in the IP provided or disclosed or shared by the Company under this Agreement ("Company Background IP"), and that no rights or license in relation to any of the Company’s Background IP is deemed to have been granted to CBP , other than the right to use strictly for the purpose of Services under this Agreement.</li>
                        <li>The Parties agree that no new IP is being created / generated / developed under this Agreement. In any event if a new IP is being created, then the Parties shall mutually agree on the ownership, title and interest in such new IP.</li>
                        <li>CBP agrees, acknowledges and undertakes to the Company that it shall use the Company IP only for authorized purposes as provided herein and not for any other purposes whatsoever and shall strictly comply with the Company’s requirements as to use of the Company’s IP and its form, manner, scale, and context of marketing indicia and of such statements to accompany them, in line with its corporate standards, guidelines, code of practice and other policies, as communicated by the Company from time to time.</li>
                      </ol>
                    </li>
                    <!-- 14 end-->
                    <li>
                      <h3>CONFIDENTIALITY</h3>
                      <ol>
                        <li>“Confidential Information” shall include, without limitation, any non-public information which is communicated to CBP in writing, orally, visually, electronically or in any other form, relating to: <ol>
                            <li>The past, present and prospective employees, staff, personnel, Affiliates, contractors, vendors, suppliers, consultants, agents, collaborators, customers of the Company and other third parties dealing with the Company;</li>
                            <li>The affairs, business, dealings, transactions, management, operations, programs, applications, services, finances, financing sources, restructuring and investment deals, budgets, prices, plans, studies, strategies, statistics, tests, forecasts, analysis, targets, compilations, regulatory filings, agreements, negotiations, properties, systems and policies of the Company;</li>
                            <li>The products, processes, devices, software, hardware, servers, websites, computer programs, codes, designs, drawings, lists, discs, photographs, Artificial Intelligence, copyrightable materials, technical and other forms of data, engineering information, marketing information, research, patents, technologies, ideas, discoveries, methods, techniques, formats, flowcharts, algorithms, models, prototypes, samples, trade secrets, know-how, improvements and all forms of Intellectual Property of the Company;</li>
                            <li>The information technology equipment, processes, solutions, platforms, systems (including security systems) and policies of the Company;</li>
                            <li>All the correspondence exchanged between the Parties for the purpose of or during the term of this Agreement; and</li>
                            <li>Any other information concerning the Company which CBP has or may have access to during the course of or for the purpose of providing Services/Products under this Agreement and which is not in the public domain.</li>
                          </ol>
                        </li>
                        <li>Upon expiry or termination of this Agreement or upon any written request, CBP shall return to the Company, or certify in writing to the Company as to the destruction of (without retaining any copy), all Confidential Information (and copies and extracts thereof) furnished to, or created by or on behalf of the CBP.</li>
                        <li>CBP agrees to keep confidential, at all times, all Confidential Information, so as to protect the Company’s lawful interests. CBP shall consult with the Company and obtain the prior written consent of the Company in case it needs to disclose any such information.</li>
                        <li>Confidential Information shall not include information that (a) is or becomes a part of the public domain through no act or omission of the other Party; or (b) was in the other Party’s lawful possession prior to the disclosure and had not been obtained by the other Party either directly or indirectly from the disclosing Party; or (c) is lawfully disclosed to the other Party by a third party without restriction on disclosure; or (d) is independently developed by the other Party. Confidential Information may be disclosed by the other Party to satisfy the order of a court or to comply with the provisions of any law or regulation in force provided that the other Party shall advise the disclosing Party in writing prior to such disclosure.</li>
                        <li>The confidentiality obligation of CBP shall survive the termination or expiration of this Agreement for a period of two years thereafter.</li>
                      </ol>
                    </li>
                    <!-- 15 end-->
                    <li>
                      <h3>PRIVACY AND DATA PROTECTION</h3>
                      <p>Parties will (i) comply with all applicable data protection and privacy laws; (ii) comply with all standards that relate to data protection and privacy laws and the privacy and security of personal information; (iii) refrain from any action or inaction that could cause breach of any data protection and privacy laws; (iv) do and execute, or arrange to be done and executed, each act, document and thing they deem necessary in their business judgment to keep them compliant with the data protection and privacy laws; (v) immediately report theft or loss of personal information.</p>
                    </li>
                    <!-- 16 end-->
                    <li>
                      <h3>ANTI-BRIBERY AND CORRUPTION</h3>
                      <p>Each Party shall comply fully at all times with all applicable law and regulations enacted to combat bribery and corruption in each jurisdiction in which such Parties conduct business with each other under this Agreement or otherwise in connection with this Agreement.</p>
                    </li>
                    <!-- 17 end-->
                    <li>
                      <h3>INDEMNITY</h3>
                      <p>The CBP shall indemnify, hold harmless and keep the Company indemnified against any loss, damage, claim, expense or cost (including legal costs) incurred by the Company due to (i) breach of the representations, warranties or any other provisions of this Agreement by the CBP, (ii) breach of applicable laws by the CBP, (iii) negligence or misconduct by the CBP or (iv) deficiencies in the provision of services to and use of the Services by the Customers.</p>
                    </li>
                    <!-- 18 end-->
                    <li>
                      <h3>LIMITATION OF LIABILITY</h3>
                      <ol>
                        <li>Neither the CBP nor the Company shall be liable for any indirect or consequential losses under this Agreement. Neither Party shall be entitled to recover the same loss or damage under this Agreement where successfully claimed under a separate agreement.</li>
                        <li>Nothing in the Agreement(including an Accepted Bid)excludes or limits liability for claims with respect to: <ol>
                            <li>Undisputed invoiced amounts properly due and payable to the Company by the CBP for Services delivered in accordance with this Agreement;</li>
                            <li>The CBP’s liability which cannot be excluded by law;</li>
                            <li>The CBP’s liability for death or personal injury: <ol>
                                <li>Resulting from the supply or use of any Deliverable or Service/Product; <br> or</li>
                                <li>Resulting from its negligence;</li>
                              </ol>
                            </li>
                            <li>Infringement of third-party IP</li>
                          </ol>
                        </li>
                      </ol>
                    </li>
                    <!-- 19 end-->
                    <li>
                      <h3>TERM</h3>
                      <ol>
                        <li>This Agreement shall commence on 27th November 2021 (“Effective Date”) and the Term may extend till such time as the CBP chooses to maintain his/her profile from the Effective Date (“Term”), unless terminated earlier as mentioned herein below or unless extended further for such period and on such terms and conditions as may be mutually agreed between the Parties.</li>
                      </ol>
                    </li>
                    <!-- 20 end-->
                    <li>
                      <h3>TERMINATION OF AGREEMENT AND OF ACCEPTED BID</h3>
                      <ol>
                        <li>Either Party may terminate the Agreement or an Accepted Bid in whole or in part, on written notice of thirty (30) days in advance to the other Party at any time if: <ol>
                            <li>The other Party commits a material breach of any provision of the Agreement and (in the case of a breach capable of remedy) fails to remedy that breach within seven (7) business days of receiving written notice from the terminating Party requiring it to do so; or</li>
                            <li>The other Party becomes subject to an Insolvency Event.</li>
                          </ol>
                        </li>
                        <li>The Company may terminate the Agreement or an Accepted Bid in whole or in part, immediately and without liability to the CBP, if there is a Change in Control of the CBP which results in CBP being Controlled by: (i) a Competitor; or (ii) a party with whom the Company has a documented internal policy of not trading with.</li>
                        <li>The CBP may on termination of the Agreement request for the deactivation of the CBP profile by sending an email to <a href="mailto:contact@ubidindia.com">contact@ubidindia.com</a>.</li>
                        <li>The CBP may choose to terminate its subscription in which case it shall raise a ticket from support page of the Company website or drop an email at <a href="mailto:contact@ubidindia.com">contact@ubidindia.com</a> at least 3 days prior to the renewal date.</li>
                        <li>The Company reserves right to decline service to the CBP and deactivate the user from platforms in cases of detection of fraud.</li>
                        <li>Termination of the Agreement for any reason whatsoever does not limit any rights or remedies to which a Party may be entitled to under the Agreement or by law or equity.</li>
                        <li>Either Party may terminate the part of an Accepted Bid affected by a Force Majeure Event by written notice to the other Party if that Force Majeure Event continues for thirty (30) consecutive calendar days.</li>
                      </ol>
                    </li>
                    <!-- 21 end-->
                    <li>
                      <h3>EFFECT OF TERMINATION OF AN ACCEPTED SERVICE REQUEST</h3>
                      <ol>
                        <li>Termination of an Accepted Bid under Clause 21.1 shall require the CBP : <ol>
                            <li>To complete any Service request pertaining to an accepted Bid where such Bid has been accepted prior to the Termination of the Subscription;</li>
                            <li>To refund to the customer any monies paid for Services/Products set out in that Accepted Bid (subject to a reasonable deduction to take account of the monies paid for Services/Products which have provided a material benefit to the customer);</li>
                            <li>To acknowledge and accept that no fees including subscription fees shall be refunded to the CBP under any circumstances whatsoever; and</li>
                            <li>To terminate any associated Accepted Bid.</li>
                          </ol>
                        </li>
                        <li>Any costs payable by the Company in relation to a terminated Accepted Bid shall not exceed the Subscription Fees for the last period of subscription.</li>
                      </ol>
                    </li>
                    <!-- 22 end-->
                    <li>
                      <h3>23. FORCE MAJEURE</h3>
                      <p>Either Party shall not be liable for any failure or delay on its part in performing its obligations under this Agreement, if such failure or delay is due in whole or in part, to “Force Majeure” conditions. Force Majeure for the purpose of this Agreement, shall include, labour strike, fires, earthquakes, floods, other Acts of God, wars or acts of war, the outbreak of hostilities (regardless of whether war is declared), terrorist acts, embargoes, blockades, sanctions, pandemics and / or resulting lockdowns, revolutions, riots, civil commotion, sabotage, strikes, civil or other protests impacting commute or transport of goods or any other causes beyond the control of the affected Party. Either Party shall have a right to terminate this Agreement in the event any Party is unable to perform as per the terms of this Agreement for a continuous period of 30days.</p>
                    </li>
                    <!-- 23 end-->
                    <li>
                      <h3>NOTICE</h3>
                      <ol>
                        <li>Any notice or other information required under or in connection with this Agreement to be given by either Party to the other Party, must be in writing and may be given by courier, facsimile transmission, email or comparable means of communication, to the other Party at the following address:</li>
                        <table style="width:100%">
                          <tr>
                            <th>To Company: To the Legal Department</th>
                            <td rowspan="4">To <strong>CBP:</strong> <br> Attention:<br> Designation:<br> Address: <br> Tel: <br> Email: </td>
                          </tr>
                        </table>
                        <li>Any notice or other information given by courier shall be deemed to have been given on signature of a delivery receipt or on the fifth (5th) day after the envelope containing the same was so sent by courier, and proof that the envelope containing any such notice or information was properly addressed and sent by courier and that it has not been so returned to the sender.</li>
                        <li>Any notice or other information sent by facsimile transmission or e-mail or any other comparable means of communication (with confirmation of transmission) shall be deemed to have been duly given on the next business day after transmission.</li>
                        <li>Service of any legal proceedings concerning or arising out of this Agreement shall be effected by causing the same to be delivered to the Party to be served, at its registered office, or to such other address as may from time to time be notified in writing by the Party concerned.</li>
                      </ol>
                    </li>
                    <!-- 24 end-->
                    <li>
                      <h3>DISPUTE RESOLUTION AND ARBITRATION</h3>
                      <ol>
                        <li>In the event of a dispute, difference or claim arising out of or in connection with this Agreement, including any difference on the interpretation of this Agreement, or any question regarding its existence, validity or termination (“Dispute”), the Parties shall try and resolve the Dispute amicably.</li>
                        <li>The dispute resolution mechanism to be followed; <ol>
                            <li>Notification of dispute through written mode of communication (Email\Letter)</li>
                            <li>Company authorised representative will be first point of contact</li>
                            <li>In case a CBP is unsatisfied, he may approach his area\state business development manager through email</li>
                            <li>In case of further escalation, Chief Operation Officer\Executive Director may be approached via email</li>
                            <li>Decision of COO\Exec Director will be final</li>
                          </ol>
                        </li>
                        <li>If the Parties are not able to arrive at a settlement on some or all of the issues relating to the Dispute raised within a period of three weeks from the date of the notice, (or within such further time as both Parties agree in writing), the conciliation process will be taken as having failed and such Dispute shall be referred to and finally resolved by arbitration in accordance to Arbitration and Conciliation Act, 1996. <ol>
                            <li>The seat of the arbitration shall be Hyderabad, state of Telangana, India.</li>
                            <li>The Tribunal shall consist of one arbitrator.</li>
                            <li>The language of the arbitration shall be English.</li>
                            <li>The law governing this arbitration agreement shall be of India.</li>
                          </ol>
                        </li>
                      </ol>
                    </li>
                    <!-- 25 end-->
                    <li>
                      <h3>GOVERNING LAW</h3>
                      <p>This Agreement, including non-contractual rights and obligations arising out of or in connection with this Agreement, shall be governed by the laws of India. This Agreement has been signed (online) and any legal proceedings arising out of this Agreement or relating thereto, shall be instituted in Hyderabad Courts only, to the exclusion of other Courts.</p>
                    </li>
                    <!-- 26 end-->
                    <li>
                      <h3>INADEQUACY OF DAMAGES AND OTHER RIGHTS</h3>
                      <ol>
                        <li>The CBP agrees that damages alone would not be an adequate remedy for breach by the CBP of the provisions of the Agreement or an Accepted Bid and that accordingly the Company shall be entitled to seek the remedies of injunction, specific performance or other equitable relief for any threatened or actual breach of the provisions of an Accepted Bid.</li>
                        <li>Save where a right or a remedy is expressed to be in full and final settlement, each right and remedy provided under the Agreement or an Accepted Bid is in addition to, and not exclusive of, any other right or remedy provided under the Agreement or an Accepted Bid or by law or in equity or otherwise.</li>
                      </ol>
                    </li>
                    <!-- 27 end-->
                    <li>
                      <h3>ORDER OF PRECEDENCE</h3>
                      <p>If there is any inconsistency between the provisions in different parts of this Agreement, the Agreement shall have precedence over Accepted Bid or any other document entered between the Parties. It is further agreed between Parties that Addendum shall have precedence over Agreement.</p>
                    </li>
                    <!-- 28 end-->
                    <li>
                      <h3>WAIVER</h3>
                      <p>Failure or delay of either Party at any time to require performance of any provision of this Agreement shall not affect the right to require full performance thereof at any time thereafter and the waiver by either Party of a breach of any provision shall not be taken or held to be a waiver of any subsequent breach thereof or as nullifying or restricting the effectiveness of such provision.</p>
                    </li>
                    <!-- 29 end-->
                    <li>
                      <h3>AMENDMENTS</h3>
                      <p>It is mutually agreed by the Parties that no variation or amendment of this Agreement shall be effective unless it is in writing and duly executed by Parties hereto.</p>
                    </li>
                    <!-- 30 end-->
                    <li>
                      <h3>RELATIONSHIP</h3>
                      <p>None of the provisions of this Agreement shall be deemed to constitute a partnership between the Parties hereto and no Party shall have any authority to bind or shall be deemed to be the agent of the other in any way.</p>
                    </li>
                    <!-- 31 end-->
                    <li>
                      <h3>NO VERBAL AGREEMENTS OR CHANGES IN AGREEMENT</h3>
                      <p>It is mutually agreed by the Parties that no amendment or variation of this Agreement shall be effective unless it is in writing and duly executed by both Parties hereto.</p>
                    </li>
                    <!-- 32 end-->
                    <li>
                      <h3>AGREEMENT NOT ASSIGNABLE</h3>
                      <p>CBP shall not transfer or assign this Agreement, or any part thereof or any rights or responsibilities there under without the prior written consent of the Company.</p>
                    </li>
                    <!-- 33 end-->
                    <li>
                      <h3>ENTIRE AGREEMENT</h3>
                      <p>This Agreement, including and together with any related annexures sets forth the entire agreement and understanding between the Parties with respect to the subject matter hereof and supersedes and cancels all earlier discussions and negotiations of understandings, agreements, whether written or oral, express or implied, between them.</p>
                    </li>
                    <!-- 34 end-->
                    <li>
                      <h3>SEVERANCE & MISCELLANEOUS</h3>
                      <p>If any provision or part-provision of this Agreement is or becomes invalid, illegal or unenforceable, it shall be deemed modified to the minimum extent necessary to make it valid, legal and enforceable. If such modification is not possible, the relevant provision or part-provision shall be deemed deleted. Any modification to or deletion of a provision or part-provision under this clause shall not affect the validity and enforceability of the rest of this Agreement, unless such above-mentioned contravening provision relates to a material part of this Agreement and / or is not severable, in which case, the whole Agreement would be terminated by way of the Parties' agreement or an arbitral award.</p>
                    </li>
                    <!-- 35 end-->
                    <li>
                      <h3>SERVIVAL</h3>
                      <p>Clauses 14 (Intellectual Property Rights), 15 (Confidentiality), 18 (Indemnity), 25 (Dispute Resolution and Arbitration), 26 (Governing Law), 36 (Severance) and this clause 37 (Survival) shall survive the termination or expiry of this Agreement for a period of 5 years thereafter.</p>
                      <p>IN WITNESS WHEREOF the Creative Business Partner hereto has set his/her respective hand hereto. By clicking on “Sign Up” button, you agree to be bound by the terms and all conditions incorporated herein by reference.</p>
                    </li>
                    <!-- 36 end-->
                  </ol>
                </div>
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