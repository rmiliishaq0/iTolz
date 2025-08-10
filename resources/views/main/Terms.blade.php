@extends("main.head")
@section("title") home Page @endsection
@section("description")@endsection
@section("root")
    <x-Nav></x-Nav>
    <div style="margin-top: 130px" class=" bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700 mx-6 my-10" id="features">
        <div class="mt-6 flex justify-center"><h1 class="dark:text-gray-600 font-sans text-lg font-semibold bg-gray-100 rounded-full h-fit p-2 w-fit px-4">
                Itolz - Terms and Conditions
            </h1></div>
        <div class="font-[Karla] text-2xl font-semibold m-6 mx-12 leading-relaxed">
            <p><strong>Last Updated:</strong> June 18, 2025</p>

            <h3>1. Agreement to Terms</h3>
            <p>By creating an account, purchasing a subscription, or using the services provided by Itolz ("Service"), you agree to be bound by these Terms and Conditions ("Terms"). <strong>If you do not agree to these Terms, you may not use the Service.</strong></p>

            <h3>2. Description of Service</h3>
            <p>Itolz provides users with shared access to various third-party online tools and software ("Third-Party Tools") through a subscription-based model. Access is facilitated by a proprietary browser extension ("Extension").</p>
            <ul>
                <li><strong>Subscription Plans:</strong> We offer various subscription "packs" and durations as detailed on our website.</li>
                <li><strong>Free Tier:</strong> We offer a free, ad-supported service tier that provides temporary access (e.g., 20-minute sessions) to select tools, after which the user may be required to log in again.</li>
            </ul>

            <h3>3. User Accounts</h3>
            <p>To use most features of the Service, you must register for an account. You agree to:<br>
                - Provide accurate, current, and complete information.<br>
                - Maintain the security of your password and accept all risks of unauthorized access to your account.<br>
                - Promptly notify us if you discover any security breaches related to the Service.</p>

            <h3>4. The Itolz Browser Extension</h3>
            <p>The core of our Service is the Extension. To use the Service, you must download and install it. You understand and agree that:<br>
                - The Extension works by <strong>manipulating cookies and local storage data</strong> to grant you access to Third-Party Tools.<br>
                - You grant the Extension permission to perform these actions to deliver the Service.<br>
                - You will not attempt to reverse-engineer, decompile, or otherwise misuse the Extension.</p>

            <h3>5. Important Disclaimers & Acknowledgement of Risk</h3>
            <p>You acknowledge and agree to the following:</p>
            <ul>
                <li><strong>No Affiliation:</strong> Itolz is an independent service and is not affiliated with, endorsed by, or sponsored by the providers of the Third-Party Tools.</li>
                <li><strong>Violation of Third-Party Terms:</strong> The act of sharing subscriptions via our Service <strong>may violate the Terms of Service</strong> of the Third-Party Tool providers.</li>
                <li><strong>Risk of Service Disruption:</strong> The providers of the Third-Party Tools may, at any time, take measures that could block our access, leading to temporary or permanent disruption of service. Itolz does not guarantee uninterrupted service.</li>
                <li><strong>"AS-IS" Service:</strong> The Service and access to the Third-Party Tools are provided on an <strong>"AS IS" and "AS AVAILABLE"</strong> basis. We do not warrant that the service will be uninterrupted or error-free.</li>
            </ul>

            <h3>6. Prohibited Activities</h3>
            <p>You agree not to use the Service for any unlawful purpose or to:<br>
                - Share your Itolz account credentials with others.<br>
                - Attempt to access the master account credentials for the Third-Party Tools.<br>
                - Use the Third-Party Tools for any illegal or abusive activity.</p>

            <h3>7. Payments, Cancellations, and Refunds</h3>
            <p><strong>Payments:</strong> You agree to pay all fees for subscriptions you purchase. All payments are handled through a third-party payment processor.<br>
                <strong>Subscription Renewal:</strong> Subscriptions may automatically renew unless you cancel before the end of the current billing period.<br>
                <strong>Refunds:</strong> Refund policies are outlined on our website and are generally handled on a case-by-case basis.</p>

            <h3>8. Termination</h3>
            <p>We may terminate or suspend your access to the Service immediately, without prior notice or liability, for any reason, including if you breach these Terms. Upon termination, your right to use the Service will cease immediately.</p>

            <h3>9. Limitation of Liability</h3>
            <p>To the fullest extent permitted by law, in no event shall Itolz be liable for any indirect, incidental, special, consequential, or punitive damages, including without limitation, loss of profits, data, or other intangibles, arising out of or in connection with your use of the Service or the interruption or failure of the Service.</p>

            <h3>11. Changes to Terms</h3>
            <p>We reserve the right to modify these Terms at any time. Your continued use of the Service after such changes constitutes your acceptance of the new Terms.</p>

            <h3>12. Contact Us</h3>
            <p>If you have any questions about these Terms, please contact us at:<br>
                <strong>Email:</strong> <a href="mailto:support@itolz.com">support@itolz.com</a></p>
        </div>
    </div>
    <x-foter></x-foter>
@endsection
