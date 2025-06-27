@extends('layouts.app')

@section('title', 'Privacy Policy')

@section('content')
<!-- Privacy Policy Content - Wider container and no hero section -->
<section class="pb-24 pt-44 bg-gradient-to-r from-gray-800 via-gray-900 to-black">
    <div class="container mx-auto px-4 max-w-6xl">
        <div class="bg-gray-800 rounded-xl shadow-lg p-10 border border-gray-700">
            <!-- Header -->
            <div class="mb-10 pb-6 border-b border-gray-700">
                <h1 class="text-4xl font-bold text-white mb-3">Privacy Policy</h1>
                <p class="text-xl text-gray-300 mb-4">How we collect, use, and protect your information</p>
                <p class="text-gray-400">Last Updated: {{ date('F d, Y') }}</p>
            </div>
            
            <!-- Introduction -->
            <div class="mb-10">
                <h2 class="text-2xl font-bold text-white mb-4">Introduction</h2>
                <p class="text-gray-300 mb-4">
                    Welcome to the Privacy Policy of Tishk International University. This Privacy Policy explains how we collect, use, disclose, and safeguard your information when you visit our website or use our services.
                </p>
                <p class="text-gray-300">
                    We respect your privacy and are committed to protecting your personal data. Please read this Privacy Policy carefully to understand our policies and practices regarding your information.
                </p>
            </div>
            
            <!-- Information We Collect -->
            <div class="mb-10">
                <h2 class="text-2xl font-bold text-white mb-4">Information We Collect</h2>
                
                <h3 class="text-xl font-semibold text-yellow-500 mb-3">Personal Data</h3>
                <p class="text-gray-300 mb-4">
                    We may collect personal identification information from you, including but not limited to:
                </p>
                <ul class="list-disc list-inside text-gray-300 mb-6 space-y-2">
                    <li>Name, email address, and contact details</li>
                    <li>Academic information and qualifications</li>
                    <li>Demographic information</li>
                    <li>Payment information when making donations</li>
                    <li>Information provided when filling forms on our website</li>
                </ul>
                
                <h3 class="text-xl font-semibold text-yellow-500 mb-3">Automatically Collected Data</h3>
                <p class="text-gray-300 mb-4">
                    When you visit our website, we may automatically collect certain information about your device, including:
                </p>
                <ul class="list-disc list-inside text-gray-300 space-y-2">
                    <li>IP address and browser type</li>
                    <li>Pages you visit and time spent on those pages</li>
                    <li>Referring website addresses</li>
                    <li>Device information</li>
                </ul>
            </div>
            
            <!-- How We Use Your Information -->
            <div class="mb-10">
                <h2 class="text-2xl font-bold text-white mb-4">How We Use Your Information</h2>
                <p class="text-gray-300 mb-4">
                    We may use the information we collect for various purposes, including:
                </p>
                <ul class="list-disc list-inside text-gray-300 space-y-2">
                    <li>To provide and maintain our services</li>
                    <li>To process donations and volunteering applications</li>
                    <li>To send you information about our programs and activities</li>
                    <li>To respond to your inquiries and provide support</li>
                    <li>To improve our website and services</li>
                    <li>To comply with legal obligations</li>
                </ul>
            </div>
            
            <!-- Information Sharing and Disclosure -->
            <div class="mb-10">
                <h2 class="text-2xl font-bold text-white mb-4">Information Sharing and Disclosure</h2>
                <p class="text-gray-300 mb-4">
                    We may share your information in the following situations:
                </p>
                <ul class="list-disc list-inside text-gray-300 space-y-2">
                    <li><span class="font-medium">With Service Providers:</span> We may share your information with third-party vendors and service providers that perform services for us.</li>
                    <li><span class="font-medium">Legal Requirements:</span> We may disclose your information where required by law or to protect our rights.</li>
                    <li><span class="font-medium">With Your Consent:</span> We may share your information with your consent or at your direction.</li>
                </ul>
                <p class="text-gray-300 mt-4">
                    We do not sell, trade, or otherwise transfer your personal information to outside parties except as described above.
                </p>
            </div>
            
            <!-- Data Security -->
            <div class="mb-10">
                <h2 class="text-2xl font-bold text-white mb-4">Data Security</h2>
                <p class="text-gray-300 mb-4">
                    We implement appropriate security measures to protect your personal information from unauthorized access, alteration, disclosure, or destruction. These measures include:
                </p>
                <ul class="list-disc list-inside text-gray-300 space-y-2">
                    <li>Using secure, encrypted connections</li>
                    <li>Regular security assessments</li>
                    <li>Access controls and authentication procedures</li>
                    <li>Data minimization practices</li>
                </ul>
                <p class="text-gray-300 mt-4">
                    However, please understand that no method of transmission over the internet or electronic storage is 100% secure. While we strive to use commercially acceptable means to protect your personal information, we cannot guarantee its absolute security.
                </p>
            </div>
            
            <!-- Cookies and Tracking Technologies -->
            <div class="mb-10">
                <h2 class="text-2xl font-bold text-white mb-4">Cookies and Tracking Technologies</h2>
                <p class="text-gray-300 mb-4">
                    We use cookies and similar tracking technologies to collect information about your browsing activities. Cookies are small files placed on your device that enable us to provide certain features and functionality.
                </p>
                <p class="text-gray-300">
                    You can set your browser to refuse all or some cookies or to alert you when cookies are being sent. However, if you disable cookies, some parts of our website may not function properly.
                </p>
            </div>
            
            <!-- Your Rights -->
            <div class="mb-10">
                <h2 class="text-2xl font-bold text-white mb-4">Your Rights</h2>
                <p class="text-gray-300 mb-4">
                    Depending on your location, you may have certain rights regarding your personal information, including:
                </p>
                <ul class="list-disc list-inside text-gray-300 space-y-2">
                    <li>The right to access your personal information</li>
                    <li>The right to correct inaccurate or incomplete information</li>
                    <li>The right to request deletion of your personal information</li>
                    <li>The right to restrict or object to processing of your information</li>
                    <li>The right to data portability</li>
                </ul>
                <p class="text-gray-300 mt-4">
                    To exercise any of these rights, please contact us using the information provided below.
                </p>
            </div>
            
            <!-- Children's Privacy -->
            <div class="mb-10">
                <h2 class="text-2xl font-bold text-white mb-4">Children's Privacy</h2>
                <p class="text-gray-300">
                    Our website is not intended for children under 16 years of age. We do not knowingly collect personal information from children under 16. If you are a parent or guardian and believe your child has provided us with personal information, please contact us so we can take appropriate action.
                </p>
            </div>
            
            <!-- Changes to this Privacy Policy -->
            <div class="mb-10">
                <h2 class="text-2xl font-bold text-white mb-4">Changes to This Privacy Policy</h2>
                <p class="text-gray-300">
                    We may update our Privacy Policy from time to time. We will notify you of any changes by posting the new Privacy Policy on this page and updating the "Last Updated" date. We encourage you to review this Privacy Policy periodically for any changes.
                </p>
            </div>
            
            <!-- Contact Us -->
            <div>
                <h2 class="text-2xl font-bold text-white mb-4">Contact Us</h2>
                <p class="text-gray-300 mb-4">
                    If you have any questions or concerns about this Privacy Policy or our data practices, please contact us at:
                </p>
                <div class="bg-gray-900 p-6 rounded-lg">
                    <p class="text-xl font-medium text-white mb-2">Tishk International University</p>
                    <p class="text-gray-400">Erbil, Iraqi Kurdistan</p>
                    <p class="text-gray-400">Email: privacy@tiu.edu.iq</p>
                    <p class="text-gray-400">Phone: +964 750 000 0000</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection