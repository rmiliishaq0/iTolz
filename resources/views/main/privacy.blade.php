@extends("main.head")
@section("title") home Page @endsection
@section("description")@endsection
@section("root")
    <x-Nav></x-Nav>
    <div style="margin-top: 130px" class=" bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700 mx-6 my-10" id="features">
        <div class="mt-6 flex justify-center"><h1 class="dark:text-gray-600 font-sans text-lg font-semibold bg-gray-100 rounded-full h-fit p-2 w-fit px-4">
                Itolz - Privacy Policy
            </h1></div>
        <div class="font-[Karla] text-2xl font-semibold m-6 mx-12 leading-relaxed">
            <p><strong>Last Updated:</strong> June 18, 2025</p>

            <h3>1. Introduction</h3>
            <p>Welcome to Itolz ("we," "us," or "our"). We are committed to protecting your privacy. This Privacy Policy explains how we collect, use, disclose, and safeguard your information when you visit our website (www.itolz.com), use our browser extension, and access our services. Please read this privacy policy carefully. <strong>If you do not agree with the terms of this privacy policy, please do not access the site or use our services.</strong></p>

            <h3>2. Information We Collect</h3>
            <p>We may collect information about you in a variety of ways. The information we may collect includes:</p>
            <ul>
                <li><strong>Personal Data:</strong> Personally identifiable information, such as your name, email address, and payment information that you voluntarily give to us when you register for an account or purchase a subscription.</li>
                <li><strong>Derivative Data:</strong> Information our servers automatically collect when you access the site, such as your IP address, browser type, operating system, and access times.</li>
                <li><strong>Data Collected by the Browser Extension:</strong>
                    <ul>
                        <li><strong>Usage Data:</strong> We collect data on which tools you access through our service and the duration of your sessions. This is essential for service functionality, such as enforcing the 20-minute time limit on our free tier.</li>
                        <li><strong>Anonymized Browse Data:</strong> The extension needs to interact with website cookies and local storage to provide access to third-party tools. We do not track your Browse history outside of the specific interactions required for our service.</li>
                    </ul>
                </li>
                <li><strong>Financial Data:</strong> Data related to your payment method. We store very little, if any, financial information. Instead, all financial information is routed to our third-party payment processors.</li>
            </ul>

            <h3>3. How We Use Your Information</h3>
            <p>We may use information collected about you to:</p>
            <ul>
                <li>Create and manage your account.</li>
                <li>Process your payments and subscriptions.</li>
                <li>Provide you with access to our free and paid subscription tools.</li>
                <li>Deliver advertisements on the free tier of our service.</li>
                <li>Monitor and analyze usage and trends to improve your experience.</li>
                <li>Notify you of updates to our services and policies.</li>
                <li>Prevent fraudulent transactions and monitor against theft.</li>
                <li>Respond to your customer service requests.</li>
            </ul>

            <h3>4. Data Sharing and Disclosure</h3>
            <p><strong>We do not sell or rent your personal information.</strong> We may share information we have collected about you in certain situations:</p>
            <ul>
                <li><strong>With Your Consent:</strong> We may share your information with third parties for any other purpose with your consent.</li>
                <li><strong>With Third-Party Service Providers:</strong> For services like payment processing, data analysis, and advertising.</li>
                <li><strong>For Legal Protection:</strong> If we believe the release of information is necessary to respond to legal process or to protect the rights, property, and safety of others.</li>
            </ul>

            <h3>5. Data Security</h3>
            <p>We use administrative, technical, and physical security measures to help protect your personal information. However, no security measures are perfect or impenetrable, and no method of data transmission can be guaranteed against any interception or misuse.</p>

            <h3>6. Your Rights and Choices</h3>
            <p>You have rights regarding your personal information, including:</p>
            <ul>
                <li><strong>Right to Access:</strong> You can request access to the personal information we hold about you.</li>
                <li><strong>Right to Rectification:</strong> You can request that we correct any inaccurate personal information.</li>
                <li><strong>Right to Erasure:</strong> You can request that we delete your personal information, subject to certain legal limitations.</li>
                <li><strong>Opt-Out:</strong> You may opt-out of receiving future email communications from us by following the unsubscribe link in our emails.</li>
            </ul>

            <h3>7. Cookie Policy</h3>
            <p>Our website uses cookies to enhance your experience. Our browser extension manipulates cookies and local storage on third-party sites as a core function of our service. This is done to provide you with access to the subscribed tools. The extension only interacts with the cookies necessary for this purpose.</p>

            <h3>8. Changes to This Privacy Policy</h3>
            <p>We may update this Privacy Policy from time to time. We will notify you of any changes by posting the new Privacy Policy on this page and updating the <strong>"Last Updated"</strong> date.</p>

            <h3>9. Contact Us</h3>
            <p>If you have questions or comments about this Privacy Policy, please contact us at:<br>
                <strong>Email:</strong> <a href="mailto:support@itolz.com">support@itolz.com</a><br>
        </div>
    </div>
    <x-foter></x-foter>
@endsection
