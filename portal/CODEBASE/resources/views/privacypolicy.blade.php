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
}
.terms-body p {
  font-size: 18px;
  line-height: 30px;
  margin-bottom: 15px;
  color: #666;
  padding: 4px 0;
  letter-spacing:1px;
}
.terms-body ul{
  padding: 0;
}
.terms-body ul li,ol li{
  font-size: 18px;
  color: #666;
  padding: 4px 0;
  letter-spacing: 1px;
}

@media (max-width:768px){
  .terms-container{
    margin: 0;
    width: 100%;
  }
}

@media (max-width:600px){
  .terms-body p,.terms-body ul li,ol li {
    font-size:16px;
  }
}

</style>
</head>

<body style="background-color: #fff;">
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                <img src="{{url('app-assets\images\logo\UBID-Logo-1X.png')}}" alt="" height="60" /> &nbsp;
          <img src="{{url('app-assets\images\logo\ubid-text-logo.png')}}" alt="" height="50" />
                </a>
                <button class="navbar-toggler menu" type="button" data-toggle="collapse" data-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation" data-menu="2">
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
                            <h1>Privacy &amp; Policy</h1>
                            <hr>
                        </section>
                        <div class="terms-body">
                          <div class="content">
                                <p>UbidIndia.com is a website owned by UBID INDIA PRIVATE LIMITED, a company incorporated under the Indian
                                    Companies Act, 1956. Wherever the term "UbidIndia" or “UbidIndia Interiors” or "UbidIndia.com" is used
                                    it refers to UBID INDIA PRIVATE LIMITED. UbidIndia provides the services through www.UbidIndia.com
                                    ('Website' or 'Site'). At UbidIndia, we are highly committed to the privacy of your data and information
                                    and in providing excellent service to all of our customers and visitors of the Website. We have prepared
                                    this Data Protection and Privacy Policy ("Policy") to inform you of the privacy principles that govern
                                    this Website.</p>
                                <p>Unless restricted by applicable law, you agree that all your personal information collected by UbidIndia
                                    through the Website may be used and disclosed as set out in this Policy. </p>
                                <p>You are advised to read this Policy carefully. By accessing the services provided by UbidIndia.com you
                                    agree to the collection and use of your data by UbidIndia.com and certain authorized third party service
                                    providers in the manner provided in this Policy. If you do not agree with this Policy, please do not use
                                    the Website.</p>
                                <div>
                                    <h3>What is covered in this Policy? </h3>
                                    <p>This Policy covers how UbidIndia treats personal information that UbidIndia collects and receives,
                                        including information related to your past use of the Website products and services. </p>
                                    <p>When you register for our service, we would require your personal information that is personally
                                        identifiable like your name, address, email address, or phone number, and other information that is
                                        not otherwise publicly available and is essentially required for registering and receiving services
                                        from us.</p>
                                    <p>UbidIndia is not responsible for any acts, deeds or things done or committed by any person not being
                                        directly employed by UbidIndia. In addition, certain UbidIndia.com associated/partner companies have
                                        their own privacy statements which can be viewed by clicking on their respective links.</p>
                                </div>
                                <div>
                                    <h3>Privacy – Our Commitment </h3>
                                    <p>At UbidIndia, we are extremely committed to protect your privacy. We would like you to feel confident
                                        about us, use our services freely and recommend our services to your friends and family. </p>
                                    <p>We guarantee that we will not rent and sell your personal information to third parties (except as
                                        stated in this Policy) without your consent. In the day to day operations, we will provide your
                                        information to our partners who will assist in providing our services. Your comfort, trust and
                                        confidence are of paramount importance to us.</p>
                                </div>
                                <div>
                                    <h3>What Information is collected from you?</h3>
                                    <h5>Profile Information</h5>
                                    <p>UbidIndia collects the details provided by you on registration (email address, name, password, phone
                                        number, address and some profile details and interests) together with information we learn about you
                                        from your use of our service and your visits to our Site. We also collect information about the
                                        transactions you undertake including details of payments and type of cards used. We will not collect
                                        and store information related to your credit cards such as number, expiry date and CVV number. </p>
                                    <p>We may collect additional information in connection with your participation in any promotions or
                                        competitions offered by us and information you provide when giving us feedback or completing profile
                                        forms. We also monitor customer traffic patterns and Site use, which enables us to improve the
                                        service we provide. We will collect only such information as is necessary and relevant to us to
                                        provide you with the services available on the Site. </p>
                                    <p>You can terminate your account at any time. However, your information may remain stored in archive on
                                        our servers even after the deletion or the termination of your account.</p>
                                    <h5>Anonymous Information</h5>
                                    <p>In addition to the information that you explicitly provide during your interactions on the Site, we
                                        will automatically receive and collect certain anonymous information in standard usage logs through
                                        our Web server, including computer-identification information obtained from "cookies" sent to your
                                        browser from: </p>
                                    <ol type="a">
                                        <li>Web server cookie stored on your hard drive </li>
                                        <li>An IP address, assigned to the computer which you use</li>
                                        <li>The domain server through which you access our service </li>
                                        <li>The type of computer you're using </li>
                                        <li>The type of web browser you're using</li>
                                    </ol>
                                </div>
                                <div>
                                    <h3>Who collects the information?</h3>
                                    <p>We collect personal information about you as part of the registration process, which is voluntary.
                                        Other means of collecting personal information is through some contests, online events, surveys etc.
                                    </p>
                                    <p>We collect anonymous information like traffic information and hardware information when you visit our
                                        Site. </p>
                                    <p>Our advertisers and partners may collect their own anonymous information through their own cookies
                                        for which we are not responsible for. </p>
                                    <p>UbidIndia understands the importance of protecting children's privacy, especially in an online
                                        environment. Our sites are not intentionally designed for or directed at children 18 years of age or
                                        younger. It is our policy never to knowingly collect or maintain information about anyone under the
                                        age of 18. </p>
                                </div>
                                <div>
                                    <h3>Information Usage </h3>
                                    <p>We use your personal information to allow it to process your registration, to process any orders that
                                        you may make for any products or services displayed on the Website, provide you with improved
                                        services, contact you when it is needed by telephone, facsimile and e-mail, and to advise you of
                                        products and services which may be of interest to you, inviting you to be a participant or a
                                        respondent to an online event that is hosted on UbidIndia.com. Further, the relevant information is
                                        used by UbidIndia to (i) provide you with statements of your account; (ii) to communicate with you
                                        on any matter relating to the conduct of your account; and (iii) to communicate the details of any
                                        orders / processing of any orders placed by you relating to products displayed on the Website.</p>
                                    <p>UbidIndia may also use aggregate information and statistics for the purposes of monitoring website
                                        usage in order to help us develop the Website, our products and services and may provide such
                                        Aggregate information to third parties on an aggregate basis. These statistics will not include
                                        information that can be used to identify any individual customer. </p>
                                    <p>UbidIndia may organize contests and surveys and the information collected during these events may be
                                        used by UbidIndia to improve your overall customer experience. The information will only be shared
                                        with third parties on an aggregate basis. </p>
                                    <p>[For the purposes of this Policy, "Aggregate information" shall mean and include information that is
                                        recorded about users and collected into groups so that it no longer reflects or references an
                                        individually identifiable user. Such information does not identify you individually.] </p>
                                    <p>Personal data collected by the Website may be transferred to other sites of UbidIndia where it is
                                        necessary to meet the purpose for which you have submitted the information. By submitting data on
                                        this Website, you are providing explicit consent to transmission of data collected on the Website.
                                    </p>
                                    <p>We use anonymous information like traffic and other data to provide us with information to recognize
                                        the access privileges to our Site, track your participation in any of the events, providing you with
                                        better content and advertisements, help diagnose the problems with our Site and for the purposes
                                        detailed in the Policy. </p>
                                </div>
                                <div>
                                    <h3>Information Sharing and Disclosures </h3>
                                    <h5>Profile Information</h5>
                                    <p>We do not rent, sell or share your personal information to third parties - </p>
                                    <ul>
                                        <li>Unless we have permission from you</li>
                                        <li>Unless we have to provide products and services that are requested by you</li>
                                        <li>Unless we have to help investigate, prevent or take action regarding unlawful and illegal
                                            activities, suspected fraud, potential threat to the safety or security of any person or
                                            organization or property or asset or rights of the Website from unauthorized use or misuse of
                                            the Website, violations of UbidIndia.com terms and conditions or to defend against legal
                                            claims/proceedings</li>
                                        <li>Unless upon occurrence of special circumstances detailed hereunder -</li>
                                        <ol type="i">
                                            <li>to respond to subpoenas, court orders, judicial proceedings, or other legal processes;</li>
                                            <li>to enforce the terms of the Website User Terms and Conditions or the terms of this Policy;
                                            </li>
                                            <li>to respond to claims that any photo, text, or other material violates the rights of third
                                                parties; or</li>
                                            <li>to protect the rights, property, or personal safety of UbidIndia, its users, or the general
                                                public.</li>
                                        </ol>
                                    </ul>
                                    <p>We provide certain required personal and contact information to our subsidiaries, affiliated
                                        companies or other trusted business partners for the purpose of providing the required service on
                                        our behalf. We require that these parties agree to process such information based on our
                                        instructions and in compliance with this Policy and any other appropriate confidentiality and
                                        security measures. </p>
                                    <p>If UbidIndia becomes involved in a merger, acquisition, or any form of sale of some or all of its
                                        assets, we will inform you through e-mail before personal information is transferred and that may
                                        become subject to a different privacy policy. </p>
                                    <p>We may share with third parties certain pieces of Aggregate information. </p>
                                </div>
                                <div>
                                    <h3>Information Security </h3>
                                    <p>We take appropriate security measures to protect against unauthorized access to or unauthorized
                                        alteration, disclosure or destruction of data. These include internal reviews of our data
                                        collection, storage and processing practices and security measures, as well as physical security
                                        measures to guard against unauthorized access to systems where we store personal data. We restrict
                                        access to personal information to UbidIndia employees, contractors and agents who need to know that
                                        information in order to operate, develop or improve our services. These individuals are bound by
                                        confidentiality obligations and may be subject to discipline, including termination and criminal
                                        prosecution, if they fail to meet these obligations. </p>
                                    <p>Although we endeavour to safeguard the confidentiality of your personally identifiable information,
                                        transmissions made by means of the Internet cannot be made absolutely secure. By using this Site,
                                        you agree that we will have no liability for disclosure of your information due to errors in
                                        transmission or unauthorized acts of third parties.</p>
                                    <p>You further agree that you are solely responsible and liable for, and shall indemnify UbidIndia
                                        against any and all costs, expenses, damages, fees, etc. that UbidIndia may incur or suffer due to
                                        any personal information or other materials that you post, upload, submit, and otherwise make
                                        available on the Website, including areas of the Website that are available to the public. We have
                                        no control over and cannot protect personal information that you disclose in public areas of the
                                        Website. If you disclose your personal information in public areas, it may be collected and used by
                                        third parties, without our or your knowledge. You should also understand that by displaying your
                                        information or photographs on the Website and the internet, for the intention of showing the
                                        information / those photographs to your friends, family, acquaintances, clients, business partners,
                                        and others, that you directly intended to see the photographs, you are relinquishing certain
                                        traditional privacy rights, wherein anyone with access to the internet has the potential ability to
                                        view your information / photographs. If you do not wish to relinquish these traditional privacy
                                        rights, do not share your information / photographs.</p>
                                </div>
                                <div>
                                    <h3>Policy Compliance </h3>
                                    <p>UbidIndia.com regularly reviews its compliance with this Policy. Please feel free to direct any
                                        questions or concerns regarding this Policy or UbidIndia.com's treatment of personal information by
                                        contacting us through this Website or by e-mailing to us at hello@UbidIndia.com. When we receive
                                        complaints at this address, it is UbidIndia.com's policy to contact the complaining user regarding
                                        his or her concerns. We will cooperate with the appropriate regulatory authorities to resolve any
                                        complaints regarding the transfer of personal data that cannot be resolved between UbidIndia.com and
                                        an individual. </p>
                                </div>
                                <div>
                                    <h3>Disputes</h3>
                                    <p>Any dispute, controversy or claim directly or indirectly caused by, arising out of or relating to
                                        this Policy will be governed by the laws of India and will be referred to confidential, mandatory
                                        and binding arbitration in Hyderabad, India. The arbitration will be conducted on an expedited basis
                                        before a single arbitrator appointed by UbidIndia in accordance with the provisions of the Indian
                                        Arbitration and Conciliation Act, 1996. The arbitrator's award shall be substantiated in writing and
                                        will be final and binding on you and UbidIndia. Subject to the above, you agree to submit yourself
                                        to the exclusive jurisdiction of the Courts in Hyderabad, India. </p>
                                </div>
                                <div>
                                    <h3>Your Choices </h3>
                                    <p>By submitting your information, you consent to the use of that information as set out in this Policy.
                                        We welcome your views on this Website and the Policy. However, submitting personally identifiable
                                        information is entirely voluntary. You are not required to register with us in order to browse our
                                        Site. Please note that we offer some services only to visitors who do register. </p>
                                    <p>At any point in time, you can correct and make changes to your personal information by accessing your
                                        information in My Account section of the Site. </p>
                                    <p>You may change your interests at any time and may opt-in or opt-out of any marketing / promotional /
                                        newsletters mailings. UbidIndia.com reserves the right to send you certain service related
                                        communication, considered to be a part of your UbidIndia.com account without offering you the
                                        facility to opt-out. You may update your information and change your account settings at any time.
                                    </p>
                                    <p>If we plan to use your personally identifiable information for any commercial purposes, we will
                                        notify you at the time we collect that information and allow you to opt-out of having your
                                        information used for those purposes.</p>
                                </div>
                                  <div>
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