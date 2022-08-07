@extends('layouts.general')

@section('title', 'Authwiki | Documetation')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/documentation.css') }}">
@endpush

@section('content')
    <!-- HEADER & SEARCH -->
    <div class="container showcase">
        <div class="page_header">
            <h1>WELCOME  TO AUTHWIKI DOCUMENTATION</h1>
            <p>Explore our guides and articles on how to use the codes.</p>
        </div>
        <div class="search_bar" >
            <img src="{{ asset('images/search_icon.svg') }}" alt="search icon" class="search_icon">
            <form id="search_form" method="GET" action="#">
                <input id="search_field" placeholder="Search glossary">
                <button id="search_button" type="submit">Search</button>
            </form>
        </div>
    </div>
    
    <main class="container">
        <aside>
            <div class="side-bar">
                <div class="side-bar-body">
                    <div class="side-bar-content">
                        <a href="#library_description"><p>Library description</p></a>
                    </div>
                    <div class="side-bar-content">
                        <a href="#authentication"><p>Authentication</p></a>
                    </div>
                    <div class="side-bar-content">
                        <a href="#features"><p>Features</p></a>
                    </div>
                    <div class="side-bar-content">
                        <a href="#usage"><p>Usage</p></a>
                    </div>
                    <div class="side-bar-content">
                        <a href="#glossary"><p>Glossary</p></a>
                    </div>
                    <div class="side-bar-content">
                        <a href="#faqs"><p>FAQ</p></a>
                    </div>
                    <div class="side-bar-content">
                        <a href="#feedback"><p>Feedback</p></a>
                    </div>
                </div>
                
                <div class="side-bar-text">
                    <p>Authwiki: experience a library of Auth codes. Download in seconds</p>
                    @guest
                    <div>
                        <a href="{{ route('register') }}"> Sign Up Now!</a>
                    </div>
                    @endguest
                </div>
            </div>
        </aside>

        <article>
            <a id="library_description"></a>
            <!-- LIBRARY DESCRIPTION -->
            <section class="section">
                <div class="section-header">
                    <h1>Library Description</h1>
                </div>
                <div class="section-content">
                    <p>
                        Building of Authentication codes might be a long process for developers . Authwiki takes that away by providing already built authentication codes, 
                        all you need to do is create an account and get on to download the secure codes of your preference.    
                    </p>
                </div>
            </section>

            <a id="authentication"></a>
            <!-- AUTHENTICATION -->
            <section class="section">
                <div class="section-header">
                    <h1>Authentication</h1>
                </div>
                <div class="section-content">
                    <p>
                        Authenticating  the user involves obtaining an ID token and validating it. ID tokens area standardized feature designed for use in sharing identity assertions on the internet.
                        <br>
                        <br>
                        The most comonly used  approaches for authenticating a user and obtaining an ID tok-en are called the “server” flow and the “implicit” flow. The server flow allows the back-
                        end server of an application to verify the identity of the person using a browser or mobile device. The implicit flow is used when a client-side application (typically a java-script app running in the browser) needs to access APIS directly instead of via its back-
                        end server.
                        <br>
                        <br>
                        This document describes how to perfrom the server flow for authenticating the user. The implicit flow is significally more complicated because of security risks in handling and using tokens on the client side. If you need to impliment an implicit flow, we highly
                        recommend using Authwiki.    
                    </p>
                </div>
            </section>

            <a id="features"></a>
            <!-- FEATURES -->
            <section class="section">
                <div class="section-header">
                    <h1>Features</h1>
                </div>
                <div class="section-content">
                    <p>
                        Authwiki handles protocol level details for you and stays up to date with latest security standards.
                        <br>
                        <br>
                        <strong>Unauthenticated Users :</strong>
                        <br>
                        Visit the platform to view basic information about it, view and interact with the documentation. Browse through library with limited informantion and download and con-
                        tribute cant be accessed till user has registered.
                        <br>
                        <br>
                        <strong>Authenticated Users :</strong>
                        <br>
                        Full access to the platform, can contribute, comment and react. Also able to view examples, code usage and also download code samples. 
                    </p>
                </div>
            </section>

            <a id="usage"></a>
            <!-- USAGE -->
            <section class="section">
                <div class="section-header">
                    <h1>Usage</h1>
                </div>
                <div class="section-content">
                    <p>
                        To use Authwiki authentication library, the user must first Sign Up or Log In, if the user already has an account then he'd have full access.
                         An unauthorized user is welcomed with a brief information showing the various programming languages on Authwiki.
                        <br>
                        <br>
                        <strong>Are you a user?</strong><br>
                        you can sign up with your Github account or using your Google account and receive a confirmation email right after.
                        <br>
                        <br>
                        Welcome, you are now an authorized Authwiki user. Browse through the library page for authentication codes in different programming languages (well categorized)  pick a code
                        of your choice by using the search bar. Lastly, you can like, comment or download the document.  
                    </p>
                </div>
            </section>

            <!-- GLOSSARY-->
            <a id="glossary"></a>
            <section class="section">
                <div class="section-header">
                    <h1>Glossary</h1>
                </div>
                <div class="section-content">
                    <p class="head">APIs</p>
                    <p>
                        API stands for Application Programming Interface. In the context of APIs, the word Application refers to any software with a distinct function. Interface can be thought of as a contract of service between two applications. This contract defines how the two communicate with each other using requests and responses. 
                        Their API documentation contains information on how developers are to structure those requests and responses. It is a software code that helps two different software's to communicate and exchange data with each other
                    </p>
                </div>
                <div class="section-content">
                    <p class="head">Application</p>
                    <p>
                        Your software that relies on Authwiki for authentication and identity management. Auth0 supports single-page, regular web, native, and machine-to-machine applications.
                    </p>
                </div>
                <div class="section-content">
                    <p class="head">Assertions</p>
                    <p>
                        A verifiable statement from an Identity Provider to a Relying Party that contains information about an end user.
                        Assertions may also contain information about the end user's authentication event at the Identity Provider.
                        It is a statement from a verifier to a Relying Party that contains information about a subscriber. Assertions may also contain verified attributes.
                    </p>
                </div>
                <div class="section-content">
                    <p class="head">Authentication</p>
                    <p>
                        Authentication is the process of determining whether someone or something is, in fact, who or what it says it is. 
                        Authentication technology provides access control for systems by checking to see if a user's credentials match the credentials in a database of authorised users or in a data authentication server.
                        In doing this, authentication assures secure systems, secure processes and enterprise information security.
                    </p>
                </div>
                <div class="section-content">
                    <p class="head">Authwiki</p>
                    <p>
                        Your go-to authentication codes platform.
                    </p>
                </div>
                <div class="section-content">
                    <p class="head">Backend</p>
                    <p>
                        Back end development refers to the server side of an application and everything that communicates between the database and the browser.
                    </p>
                </div>
                <div class="section-content">
                    <p class="head">Blog</p>
                    <p>
                        a regularly updated website or web page, typically one run by an individual or small group, that is written in an informal or conversational style.
                        The blog keeps you updated about Authwiki.
                    </p>
                </div>
                <div class="section-content">
                    <p class="head">Client</p>
                    <p>
                        A Web client typically refers to the Web browser in the user's machine or mobile device. An Authwiki User.
                    </p>
                </div>
                <div class="section-content">
                    <p class="head">Codes</p>
                    <p>
                        A keyed cryptographic checksum based on an approved security function
                    </p>
                </div> 
                
                <!-- OTHER GLOSSARY CONTENTS GO HERE -->
            </section>

            <a id="faqs"></a>
            <!-- FAQs -->
            <section class="section">
                <div class="section-header">
                    <h1>FAQs</h1>
                </div>
                <div class="section-content-faq">
                    <p class="faq" >
                        <strong>How can I Create an account?</strong><br>
                        You can create an account on Authwiki either by signing up with your Gmail or Google account. You can also use the Github toggle to conveniently sign up as a Programmer.
                    </p>
                    <br>
                    <p class="faq">
                        <strong>How can I Log In?</strong><br>
                        You can Log In on Authwiki either by signing up with your Gmail or Google account. You can also use the Github toggle to conveniently sign up as a Programmer.
                    </p>
                    <br>
                    <p class="faq">
                        <strong>Forgot your Authwiki login Password?</strong><br>
                        Click on 'Forgot Password' on the login page. Follow all necessary steps after to reset your password.
                    </p>
                    <br>
                    <p class="faq">
                        <strong>How can I search for Authentication Codes?</strong><br>
                        Navigate to the Library Page and pick a programming Language code of your choice.
                    </p>
                    <br>
                    <p class="faq">
                        <strong>How can I download authentication codes?</strong><br>
                        Go to the download page, go through the requirements until the examples. The Download button is right under.
                    </p>
                    <br>
                    <p class="faq">
                        <strong>I can't place a comment?</strong><br>
                        Register to contribute
                    </p>
                    <br>
                    <p class="faq">
                        <strong>Need the latest update?</strong><br>
                        Subscribe to our newsletter to get the most recent feeds and news about Authwiki.
                    </p>
                    <br>
                    <p class="faq">
                        <strong>I have limited access to the Platform?</strong><br>
                        To gain full access you have to become an authenticated user.                    
                    </p>
                    <br>
                    <p class="faq">
                        <strong>Need Help?</strong><br>
                        You can contact us via the contact button or help Centre at the bottom of this page.
                    </p>
                    <br>
                    <p class="faq">
                        <strong>Are you new to using this site?</strong><br>
                        Leverage on the benefit of joining our community of developers.
                    </p>
                    <br>   
                </div>
            </section>

            <a  id="feedback"></a>
            <!-- FEEDBACK -->
            <section class="section">
                <div class="section-header">
                    <h1>Feedback</h1>
                </div>
                <div class="section-content">
                    <p>
                        Feedback is very welcome on Authwiki. we need to know your thoughts and ideas on how to make this
                        project better. so do leave comments in the comment section or send an email to team4@authwiki.net
                    </p>
                </div>
            </section>
        </article>
    </main>
@endsection
