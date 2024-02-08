<?php echo  $this->extend('user/templates/about_template'); ?>

<?php echo  $this->section('content'); ?>
<?php
$public_url=base_url()."/public/frontend/";
$baseurl=base_url()."/";
?>

<main>
 <button class="icon-button e-dark-mode-button u-animation-click" id="darkMode" aria-label="Dark Mode"><span class="icon" aria-hidden="true">🌜</span></button>
 <div class="common-structure">
    <?php 
	if(isset($_SESSION['nameUserH'])){
	echo  $this->include('user/templates/comman_header_profile');
    }else{
	echo  $this->include('user/templates/comman_header_pages');	
	}
	?>
  </div>
  <section class="middle_wraper">
<div class="privacy_page">
    <div class="container"> 
    <style>
    
.privacy_page p {
	width: 100%;
	float: left;
	margin: 0;
	font-size: 14px;
	line-height: 25px;
	font-weight: bold;
	padding: 10px 0;
	height: auto;
	-webkit-line-clamp: none;
}
    </style>
        <div class=" ">
  <p>At Hello-Vegans, we collect and manage user data according to the following Privacy Policy, with the goal of incorporating our company values: transparency, accessibility, sanity, usability.</p>
  <p>This document is part of Hello-Vegans's&nbsp;Terms of Service, and by using&nbsp;<a href="https://hello-vegans.com/">Hello-Vegans.com</a>&nbsp;(the "Website"), you agree to the terms of this Privacy Policy and the Terms of Service. Please read the Terms of Service in their entirety, and refer to those for definitions and contacts.</p>
  <p><b> (a)&nbsp;Data Collected </b></p>
  <p>We collect anonymous data from every visitor of the Website to monitor traffic and fix bugs. For example, we collect information like web requests, the data sent in response to such requests, the Internet Protocol address, the browser type, the browser language, and a timestamp for the request.</p>
  <p>We ask you to log in and provide certain personal information (such as your name and email address) in order to be able to save your profile and the documents and comments associated with it. In order to enable these or any other login based features, we use cookies to store session information for your convenience. You can block or delete cookies and still be able to use our website, although if you do you will then be asked for your username and password every time you log in to the&nbsp;Website. In order to take advantage of certain features of the Website, you may also choose to provide us with other personal information, such as your picture or personal&nbsp;Website, but your decision to utilize these features and provide such data will always be voluntary.</p>
  <p>You are able to view, change and remove your data associated with your profile. Should you choose to delete your account, please contact us at&nbsp;<a href="mailto:privacy@hello-vegans.com">privacy@Hello-Vegans.com </a>, and we will follow up with such request as soon as possible.</p>
  <p>Minors and children should not use our Website. By using the&nbsp;Website, you represent that you have the legal capacity to enter into a binding agreement.</p>
  <p><b> (b)&nbsp;Use of the Data </b></p>
  <p>We only use your personal information to provide you our services or to communicate with you about the services or the Website.</p>
  <p>With respect to any documents you may choose to upload to our website/web platform, we take the privacy and confidentiality of such documents seriously. We encrypt all documents, and permanently delete any redacted edits you make to documents. If you choose to make a document public, we recommend you redact any and all references to people and addresses, as we can't protect public data and we are not responsible for any violation of privacy law you may be liable for.</p>
  <p>We employ industry standard techniques to protect against unauthorized access of data about you that we store, including personal information.</p>
  <p><b> We do not share personal information you have provided to us without your consent, unless </b></p>
  <p>– doing so is appropriate to carry out your own request;</p>
  <p>– we believe it's needed to enforce our Terms of Service, or that is legally required;<br>
    – we believe it's needed to detect, prevent or address fraud, security or technical issues;<br>
    – otherwise protect our property, legal rights, or that of others.</p>
  <p>Hello-Vegans is operated from the India. If you are visiting the Website from outside the India, you agree to any processing of any personal information you provide us according to this policy.</p>
  <p>We may contact you, by email or other means. For example, Hello-Vegans may send you promotional emails relating to Hello-Vegans or other third parties which we may feels you would be interested in, or communicate with you about your use of our website. We may also use technology to alert us via a confirmation email when you open an email from us. You can modify your email notification preferences by clicking the appropriate link included in the footer of email notifications. If you do not want to receive email from Hello-Vegans, please opt out of receiving emails at the bottom of any our emails.</p>
  <p><b> (c)&nbsp;&nbsp;Sharing of Data </b></p>
  <p>We don't share your personal information with third parties. Only aggregated, anonymized data is periodically transmitted to external services to help us improve the Hello-Vegans Website and service.</p>
  <p>We may also use social buttons provided by services like Twitter, Google+, LinkedIn and Facebook. Your use of these third party services is entirely optional. We are not responsible for the privacy policies and/or practices of these third party services, and you are responsible for reading and understanding those third party services' privacy policies.</p>
  <p>We employ and contract with people and other entities that perform certain tasks on our behalf and who are under our control (our "Agents"). We may need to share personal information with our Agents in order to provide products or services to you. Unless we tell you differently, our Agents do not have any right to use Personal Information or other information we share with them beyond what is necessary to assist us. You hereby consent to our sharing of Personal Information with our Agents.</p>
  <p>We may choose to buy or sell assets. In these types of transactions, user information is typically one of the transferred business assets. Moreover, if we, or substantially all of our assets, were acquired, or if we go out of business or enter bankruptcy, user information would be one of the assets that is transferred or acquired by a third party. You acknowledge that such transfers may occur, and that any acquirer of us or our assets may continue to use your personal information as set forth in this policy.</p>
  <p><b> GDPR Privacy Notice </b></p>
  <p>If you are located in the European Union ("EU"), United Kingdom, Lichtenstein, Norway, or Iceland, you may have additional rights under the EU General Data Protection Regulation (the "GDPR") with respect to your Personal Data, as outlined below.</p>
  <p>For this GDPR Privacy Notice, we use the terms "Personal Data" and "processing" as they are defined in the GDPR, but "Personal Data" generally means information that can be used to individually identify a person, and "processing" generally covers actions that can be performed in connection with data, such as collection, use, storage and disclosure.&nbsp; Hello-Vegans, Inc. ("Hello-Vegans") will be the controller of your Personal Data processed in connection with the Services, except that we may also process Personal Data of our customers' end users or employees in connection with our provision of services to such customers, in which case we are the processor of Personal Data and the customer is the controller. &nbsp;For more information about your data rights and processing activities where we are the controller, please contact us at&nbsp;<a href="mailto:privacy@hello-vegans.com">privacy@Hello-Vegans.com</a>. For more information about your data rights and processing activities where we are the processor, please contact the controller party in the first instance.</p>
  <p>Where applicable, this GDPR Privacy Notice is intended to supplement, and not replace, our existing privacy policy).&nbsp; If there are any conflicts between this GDPR Privacy Notice and our Privacy Policy, the policy or portion that is more protective of Personal Data shall control to the extent of such conflict.&nbsp; If you have any questions about this notice or whether any of the following applies to you, please contact us at&nbsp;<a href="mailto:privacy@hello-vegans.com"><u>privacy@hello-vegans.com</u></a>.</p>
  <p><b> How We Process Personal Data: </b></p>
  <p>We will only process your Personal Data if we have a lawful basis for doing so. Lawful bases for processing include consent, contractual necessity and our "legitimate interests" or the legitimate interest of others, as further described below. In some cases, we process Personal Data based on the consent you expressly grant to us at the time we collect such Personal Data.&nbsp; When we process Personal Data based on your consent, it will be expressly indicated to you at the point and time of collection. From time to time, we may also need to process Personal Data to comply with a legal obligation, if it is necessary to protect the vital interests of you or other data subjects, or if it is necessary for a task carried out in the public interest.</p>
  <p><b> What Personal Data Do We Collect From You and How Do We Use Your Personal Data? </b></p>
  <p>We collect Personal Data about you when you provide such Personal Data directly to us, when third parties such as our business partners or service providers provide us with Personal Data about you, or when Personal Data about you is automatically collected in connection with your use of our Services.</p>
  <p><b> Information we collect directly from you </b></p>
  <p>We receive certain Personal Data directly from you when you provide us with such Personal Data, including without limitation the following:</p>
  <p>– First name<br>
    – Last name<br>
    – Email address<br>
    – Mailing address<br>
    – Telephone number<br>
    – Country<br>
    – Job Title</p>
  <p>We collect and process these categories of Personal Data as a matter of contractual necessity so that we can provide the Services to you in accordance with our&nbsp;Terms of Service.&nbsp; For example, we cannot open an account for you if you do not provide us with your first and last name.&nbsp; When we process Personal Data due to contractual necessity, failure to provide such Personal Data will result in your inability to use some or all portions of the Services that require such Personal Data.</p>
  <p>We may also collect user content from you when you provide it to us.&nbsp; For example, the Services allow you to provide us with comments, posts, and user writing samples that you submit, and you may choose to provide Personal Data (such as your name) in such content. By sharing this user content in a public forum, you are choosing to disclose any Personal Data included in such content, and we do not have control over your decision.&nbsp; We process user content, including any Personal Data included in any such user content, on the basis of our legitimate business interest in providing you with the Services.</p>
  <p>We also use the Personal Data we collect directly from you to operate, improve, understand and personalize our Services based on our legitimate business interest in operating our Services in a way that benefits us and our users.&nbsp; For example, we use the Personal Data to:</p>
  <p>– Create and manage user profiles<br>
    – Communicate with you about the Services<br>
    – Contact you about Service announcements, updates or offers<br>
    – Provide support and assistance for the Services<br>
    – Personalize website content and communications based on your preferences<br>
    – Meet contract or legal obligations<br>
    – Respond to user inquiries<br>
    – Fulfill user requests<br>
    – Comply with our legal or contractual obligations<br>
    – Resolve disputes<br>
    – Protect against or deter fraudulent, illegal or harmful actions<br>
    – Enforce our&nbsp;Terms of Service</p>
  <p><b> Information we receive from third party sources:</u><strong><b>&nbsp;&nbsp;</b></strong>Some third parties provide us with Personal Data about you, such as the following:</b></p>
  <p><strong><b>– Account information for third party services:</b></strong>&nbsp;If you interact with a third party service when using our Services, such as if you use a third party service to log-in to our Services (e.g., Facebook Connect), or if you share content from our Services through such third party service, the applicable third party service will send us certain Personal Data (specifically your first name, ID, token and profile picture URL) if the third party service and your account settings allow such sharing. Specifically, this Personal Data permits us to create and manage user profiles and sync your progress when you connect to Facebook through the Services. The Personal Data we receive will depend on the policies and your account settings with the applicable third party service.&nbsp; We process this Personal Data based on our legitimate business interest of personalizing and optimizing the Services to improve user experience.</p>
  <p><strong><b>– Information from our advertising partners:</b></strong>&nbsp;We receive information about you from some of our service providers (e.g., LinkedIn, Facebook etc.) who assist us with marketing or promotional services related to how you interact with our websites, applications, products, services, advertisements or communications. We process this Personal Data based on our legitimate business interest in providing direct marketing about our products and services.</p>
  <p><b> Information we automatically collect when you use our Services</b></p> <p>Some Personal Data is automatically collected when you use our Services, such as the following:</p>
  <p>– IP address<br>
    – Device identifiers<br>
    – Web browser information<br>
    – Page view statistics<br>
    – Browsing history<br>
    – Usage information<br>
    – Cookies and other tracking technologies (e.g. web beacons, pixel tags, SDKs, etc.)<br>
    – Location information (e.g. IP address, zip code)<br>
    – Log data (e.g. access times, hardware and software information)</p>
  <p>We process this Personal Data based on the following legitimate business interests:</p>
  <p>– Network security<br>
    – Personalization of web content<br>
    – Evaluation of quality of writing to consider engagement<br>
    – Web analytics<br>
    – Provision of rewards<br>
    – Administrative matters</p>
  <p>In collecting the Personal Data, we sometimes use "cookies" and other tracking technologies (e.g., web beacons and pixel tags). Cookies allow us to recognize your browser or device and "remember" your browser during subsequent visits for purposes of functionality, preferences, and website performance, and they also tell us how and when pages and features in our Services are visited and by how many people. The Services use the following cookies:</p>
  <p><strong><b>– Essential Cookies.</b></strong>&nbsp;Essential cookies are required for providing you features or services that you have requested. For example, certain cookies enable you to log into secure areas of our Site. Disabling these cookies may make certain features and services unavailable.</p>
  <p><strong><b>– Functionality Cookies.</b></strong>&nbsp;Functional cookies are used to record your choices and settings regarding our Services, maintain your preferences over time, and recognize you when you return to our Services. These cookies help us to personalize our content for you, greet you by name and remember your preferences (for example, your choice of language or region).</p>
  <p><strong><b>– Performance/Analytical Cookies.</b></strong>&nbsp;Performance/analytical cookies allow us to understand how visitors use our Site and Services such as by collecting information about the number of visitors to the Site, what pages visitors view on our Site, and how long visitors are viewing pages on the Site. Performance/analytical cookies also help us measure the performance of our advertising campaigns in order to help us improve our campaigns and the Services' content for those who engage with our advertising.</p>
  <p><strong><b>– Retargeting/Advertising Cookies.</b></strong>&nbsp;Retargeting/advertising cookies collect data about your online activity and identify your interests so that we can provide advertising that we believe is relevant to you.</p>
  <p>Most browsers automatically accept cookies but have an option for blocking or deleting cookies, which will prevent your browser from accepting new cookies, as well as (depending on the sophistication of your browser software) allow you to decide on acceptance of each new cookie in a variety of ways. You can usually access these options through the "Settings" or similar menu in your browser.&nbsp; For more information about cookies, including how to see what cookies have been set and how to manage and delete cookies, visit www.aboutcookies.org or www.allaboutcookies.org.&nbsp; Please note that if you block or delete cookies, some portions of the Services may not work properly. In some cases, cookies may enable us to aggregate certain information with other Personal Data we collect and hold about you.</p>
  <p><u><b>Other uses of Personal Data:</b></u>&nbsp; In addition to the uses set forth above, we may also process the Personal Data we collect on the basis of the following legitimate business interests.</p>
  <p>– Operation and improvement of our business, products and services<br>
    – Marketing of our products and services<br>
    – Provision of customer support<br>
    – Protection from fraud or security threats<br>
    – Compliance with legal obligations<br>
    – Completion of corporate transactions</p>
  <p><b> How and With Whom Do We Share Your Data? </b></p>
  <p>We share Personal Data with vendors, third party service providers and agents who work on our behalf and provide us with services related to the purposes described in this Privacy Policy or our&nbsp;Terms of Service. These parties include:</p>
  <p>– Analytics service providers<br>
    – Staff augmentation and contract personnel<br>
    – Hosting service providers</p>
  <p>We also share Personal Data when necessary to complete a transaction initiated or authorized by you or provide you with a product or service you have requested.&nbsp; In addition to those set forth above, these parties also include:</p>
  <p>– Other users (where you post information publicly or as otherwise necessary to effect a transaction initiated or authorized by you through the Services)<br>
    – Social media services (if you interact with them through your use of the Services)<br>
    – Third party business partners who you access through the Services<br>
    – Other parties authorized by you</p>
  <p>We also share Personal Data when we believe it is necessary to:</p>
  <p>– Comply with applicable law or respond to valid legal process, including from law enforcement or other government agencies<br>
    – Protect us, our business or our users, for example to enforce our terms of service, prevent spam or other unwanted communications and investigate or protect against fraud<br>
    – Maintain the security of our products and services</p>
  <p>We also share Personal Data with third parties when you give us consent to do so.</p>
  <p>Furthermore, if we choose to buy or sell assets, user information is typically one of the transferred business assets. Moreover, if we, or substantially all of our assets, were acquired, or if we go out of business or enter bankruptcy, user information would be one of the assets that is transferred or acquired by a third party, and we would share Personal Data with the party that is acquiring our assets based on our legitimate business interest of being able to provide you with continued services. You acknowledge that such transfers may occur, and that any acquirer of us or our assets may continue to use your Personal Information as set forth in this policy.</p>
  <p><b> How Long Do We Retain Your Personal Data? </b></p>
  <p>We retain Personal Data about you for as long as you have an open account with us or as otherwise necessary to provide the Services to you and improve the Services for all users generally. &nbsp;In some cases we retain Personal Data for longer, if doing so is necessary to comply with our legal obligations, resolve disputes or collect fees owed, or is otherwise permitted or required by applicable law, rule or regulation. Afterwards, we retain some information in a depersonalized or aggregated form but not in a way that would identify you personally.</p>
  <p><b> What Security Measures Do We Use? </b></p>
  <p>We seek to protect Personal Data using appropriate technical and organizational measures based on the type of Personal Data and applicable processing activity.</p>
  <p><b> Personal Data of Children </b></p>
  <p><b></b>We do not knowingly collect or solicit Personal Data from anyone in the EU, United Kingdom, Lichtenstein, Norway, or Iceland under the age of 16.&nbsp; If you are under 16, please do not attempt to register for the Services or send any Personal Data about yourself to us.&nbsp; If we learn that we have collected Personal Data from a child under age 16, we will delete that information as quickly as possible. If you believe that a child under 16 may have provided us Personal Data, please contact us at&nbsp;<a href="mailto:privacy@hello-vegans.com">privacy@Hello-Vegans.com</a>.</p>
  <p><b> What Rights Do You Have Regarding Your Personal Data? </b></p>
  <p>You have certain rights with respect to your Personal Data, including those set forth below.&nbsp; For more information for these rights, or to submit a request please email <a href="mailto:privacy@hello-vegans.com">privacy@hello-hegans.com</a>. Please note that in some circumstances, we may not be able to fully comply with your request, such as if it is frivolous or extremely impractical, if it jeopardizes the rights of others, or if it is not required by law, but in those circumstances, we will still respond to notify you of such a decision.&nbsp; In some cases, we may also need to you to provide us with additional information, which may include</p>
  <p>Personal Data, if necessary to verify your identity and the nature of your request.</p>
  <p><strong><b>Access</b></strong>: You can request more information about the Personal Data we hold about you and request a copy of such Personal Data. You can also access certain of your Personal Data by emailing us at <a href="mailto:privacy@hello-vegans.com">privacy@hello-hegans.com </a>.</p>
  <p><b></b><strong><b>Rectification</b></strong>: If you believe that any Personal Data we are holding about you is incorrect or incomplete, you can request that we correct or supplement Personal Data by emailing us at&nbsp;<a href="mailto:privacy@hello-vegans.com">privacy@hello-hegans.com.</a></p>
  <p>– <strong><b>Erasure</b></strong>: You can request that we erase some or all of your Personal Data from our systems.</p>
  <p><strong><b>– Withdrawal of Consent</b></strong>: If we are processing your Personal Data based on your consent (as indicated at the time of collection of such data), you have the right to withdraw your consent at any time. Please note, however, that if you exercise this right, you may have to then provide express consent on a case-by-case basis for the use or disclosure of certain of your Personal Data, if such use or disclosure is necessary to enable you to utilize some or all of our Services.</p>
  <p><strong><b>– Portability</b></strong>: You can ask for a copy of your Personal Data in a machine-readable format.&nbsp; You can also request that we transmit the data to another controller where technically feasible.</p>
  <p><strong><b>– Objection</b></strong>: You can contact us to let us know that you object to the further use or disclosure of your Personal Data for certain purposes, such as for direct marketing purposes.</p>
  <p><strong><b>– Restriction of Processing</b></strong>: You can ask us to restrict further processing of your Personal Data.</p>
  <p><strong><b>– Right to File Complaint</b></strong>: You have the right to lodge a complaint about our practices with respect to your Personal Data with the supervisory authority of your country or EU Member State.</p>
  <p><b> What if You Have Questions Regarding your Personal Data?</b></p>
    <p>If you have any questions about this GDPR Privacy Notice or our data practices generally, please contact us using the following information:</p>
  <p>Email:&nbsp;<a href="mailto:privacy@hello-vegans.com">privacy@hello-hegans.com</a></p>
  <p><b>DISPUTE RESOLUTION OR FILING A COMPLAINT </b></p>
  <p>If you have any complaints regarding our compliance with this Privacy Policy, please contact us first. We will investigate and attempt to resolve complaints and disputes regarding use and disclosure of personal information in accordance with this Privacy Policy and in accordance with applicable law.</p>
  <p>If you have an unresolved privacy or data use concern that you believe we have not addressed satisfactorily, please contact :</p>
 </div>
    
    </div>
    </div>
	</section>
</main>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
<script src="js/jquery.min.js"></script> 
<!-- Include all compiled plugins (below), or include individual files as needed --> 
<script src="js/bootstrap.min.js"></script> 
<?php echo  $this->endSection(); ?>