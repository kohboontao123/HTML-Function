
#  PHP Social Media Login

In the ever-evolving landscape of web development, integrating social media login functionalities has become a pivotal aspect of creating user-friendly and accessible applications. Among the myriad of options available, Facebook and Google stand out as prominent choices for streamlining the authentication process. Leveraging their authentication APIs in PHP not only enhances user convenience but also extends the reach of your application by tapping into the vast user bases of these social media giants. In this discussion, we will explore the intricacies of incorporating Facebook and Google login mechanisms into a PHP-based web application, unraveling the steps to seamlessly integrate these widely-used authentication services.


## Screenshot

![Demo](https://github.com/kohboontao123/PHP-Social-Media-Login/blob/main/loginpage.jpg?raw=true)



##  

To enhance the authentication capabilities of your Go application, you can integrate both Facebook and Google login functionalities. Begin by creating a Facebook App on the [Facebook Developers platform](https://developers.facebook.com/). After creating the app, navigate to the App Dashboard to retrieve your App ID and App Secret—essential credentials for authenticating your application with Facebook. Replace the placeholder values in the example Go code below with the actual App ID and App Secret obtained from the App Dashboard. This ensures secure communication with Facebook's Graph API, allowing your Go application to seamlessly handle user authentication via Facebook credentials.

```bash
  $fb = new Facebook\Facebook([
    'app_id' => 'YourAppID',
    'app_secret' => 'YourAppSecret',
    'default_graph_version'=>'v2.10'
]);
$helper = $fb->getRedirectLoginHelper();
$fb_login_url = $helper->getLoginUrl('YourLoginUrl');
```
Next, enable Google login functionality by creating a project on the [Google Developers Console](https://console.cloud.google.com/apis/dashboard?pli=1&project=airy-generator-341007) and configuring OAuth 2.0 credentials. Navigate to the Credentials page in your project, where you'll obtain your Google Client ID and Client Secret. Set the correct Redirect URI to match the endpoint where your application will handle the authentication callback. In the Go code example below, replace 'YourClientID,' 'YourClientSecret,' and 'YourRedirectUri' with the actual values obtained from the Google Developers Console. Ensure that the Redirect URI matches the callback URI specified during the configuration. Adding the necessary scopes, such as 'email,' defines the permissions your application requests from the user's Google account.

```bash
$google_client = new Google_Client();
$google_client->setClientId('YourClientID');
$google_client->setClientSecret('YourClientSecret');
$google_client->setRedirectUri('YourRedirectUri');
$google_client->addScope('email');
```

Make sure to replace "YourClientID" and "YourClientSecret" with your actual Google Client ID and Client Secret. This configuration will enable your Go application to authenticate users through Google's OAuth 2.0 service.


## Reference
-   [Composor](https://getcomposer.org/)

-   [W3schools](https://www.w3schools.com/howto/tryit.asp?filename=tryhow_css_social_login)

-   [How To Add Facebook Login to PHP Website](https://www.cloudways.com/blog/add-facebook-login-in-php/)

-   [Create a Google Login Page in PHP](https://code.tutsplus.com/create-a-google-login-page-in-php--cms-33214t)

