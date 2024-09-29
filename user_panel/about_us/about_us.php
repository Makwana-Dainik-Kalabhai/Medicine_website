<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About US</title>
    <?php include("C:/xampp/htdocs/php/medicine_website/user_panel/links.php"); ?>
</head>
<style>
    <?php include("about_us.css"); ?>
</style>

<body>
    <header>
        <?php include("C:/xampp/htdocs/php/medicine_website/user_panel/header/header.php"); ?>
    </header>

    <main>
        <div id="intro">
            <img src="about_us.png" alt="">
        </div>

        <div id="policies">
            <h1>Our Policies...</h1>
            <hr/>
            <div>
                <a href="http://localhost/php/medicine_website/user_panel/policies/terms_conditions.php"><img src="tc.png" alt=""></a>
                <a href="http://localhost/php/medicine_website/user_panel/policies/return.php"><img src="returnp.png" alt=""></a>
                <a href="http://localhost/php/medicine_website/user_panel/policies/payment.php"><img src="paymentp.png" alt=""></a>
                <a href="http://localhost/php/medicine_website/user_panel/policies/shipping_delivery.php"><img src="shipping.png" alt=""></a>
            </div>
        </div>

        <div id="about_us">
            <h1>About US...</h1>
            <hr>
            <p id="company">Welcome to www.healthGroup.com ("healthGroup.com", "healthGroup pvt. ltd.", "Website", "Pharmacy", or "We").
                <br />This Website is managed and operated by healthGroup pvt. ltd. Whose main store is located in 34, Kameshwar park, opp. Swaminarayan Mandir, Hirawadi road, Saidpur bogha, Ahmedabad, Gujarat India-382 345.
            </p><br />
            <div>
                <p>At healthGroup pvt. ltd., our team of experienced healthcare professionals is committed to delivering high-quality medical services. Our physicians, nurses, and support staff work collaboratively to ensure that each patient receives the attention and care they deserve. We offer a wide range of services, including [medicine purchasing, medical device purchasing, customer support etc.], tailored to meet the unique needs of every individual.</p>
                <p>Our state-of-the-art facility is equipped with the latest technology and resources, allowing us to provide effective diagnoses and treatments in a comfortable environment. We believe in empowering our patients through education, encouraging them to take an active role in their health journey.</p>
                <p>As a community-focused practice, we are proud to participate in local health initiatives and outreach programs. We strive to make healthcare accessible and promote wellness for all.</p>
                
                <p>
                    <h2>Featured Categories: -</h2>
                    <li>Prescription Medications</li>
                    <li>Over-the-Counter Remedies</li>
                    <li>Vitamins & Supplements</li>
                    <li>Personal Care Products</li>
                    <li>Health Monitoring Devices</li>
                </p><br/>
                <p>
                    <h2>Our Values: -</h2>
                    <li><h3>Integrity:</h3>&ensp;We operate with transparency and honesty, ensuring that you receive only authentic and safe products.</li>
                    <li><h3>Compassion:</h3>&ensp;Your health concerns matter to us. Our team is dedicated to providing personalized support and guidance.</li>
                    <li><h3>Innovation:</h3>&ensp;We continuously strive to improve our services and offerings, leveraging technology to enhance your shopping experience.</li>
                </p><br/>
                <p>
                    <span>Our Team</span><hr />
                    <p>Our team comprises experienced pharmacists and healthcare professionals who are passionate about helping you manage your health. Whether you have questions about a prescription or need advice on over-the-counter medications, we're here for you.</p><br/>
                    <h2>What We Offer: -</h2>
                    <li><h3>Comprehensive Product Range:</h3>&ensp;From prescription medications to health supplements, we have everything you need to support your well-being.</li>
                    <li><h3>Educational Resources:</h3>&ensp;Our blog and health guides provide valuable information to help you make informed decisions about your health.</li>
                    <li><h3>Convenient Online Shopping:</h3>&ensp;Enjoy a user-friendly shopping experience with secure payment options and fast delivery right to your door.</li>
                </p><br/>
                <p>
                    <h2>Why Choose Us?</h2>
                    <li><h3>Quality Assurance:</h3>&ensp;All our products are sourced from trusted manufacturers, ensuring you receive only the best.</li>
                    <li><h3>Expert Guidance:</h3>&ensp;Our knowledgeable pharmacists are here to answer your questions and help you choose the right products for your needs.</li>
                    <li><h3>Convenient Ordering:</h3>&ensp;Browse our extensive catalog and enjoy hassle-free online ordering with fast delivery to your doorstep.</li>
                    <li><h3>Health Resources:</h3>&ensp;Explore our informative articles and guides to help you stay informed about your health and wellness.</li>
                </p><br/>
                <p>
                    <h2>Need Help?</h2>
                    <p>Our customer service team is available to assist you. Contact us via email or phone, and we'll be happy to help!</p>
                </p>
                <p id="thank">Thank you for choosing healthGroup.com. Together, let's take steps towards a healthier tomorrow!</p>
            </div>
        </div>
    </main>
    <footer>
        <?php include("C:/xampp/htdocs/php/medicine_website/user_panel/footer/footer.php"); ?>
    </footer>
</body>
</html>