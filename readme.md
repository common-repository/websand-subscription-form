=== Websand Subscription Form ===
Contributors: jay-snee
Tags: websand, marketing, email, newsletter, subscribe, widget
Requires at least: 4.1
Tested up to: 4.7
Stable tag: trunk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Websand Subscription Form. Add Websand Subscriber forms to any post, page, or sidebar. 

== Description ==

#### Websand Subscription Form
This plugin enables a simple widget that can be used to capture and send subscriber information to the fabulous and easy to use Email Marketing and Marketing Automation platform [Websand](http://www.websand.co.uk). 
The widget collects your site visitors' first name and email address and enforces an opt-in when they subscribe - keeping you in line with best practices. 
Behind the scenes you can configure the plugin to add a 'source code' for the signup. This allows you to monitor where your subscribers are coming from and allow you to assign the most appropriate welcome message for them when they subscribe. 
Unfortunately, this plugin isn't much use if you aren't a Websand user. Not to worry though, you can sign up and add some superpowers to your email marketing at https://beta.websandhq.com/

#### What is Websand?
Websand is email marketing designed for businesses that want to get closer to their customers.  We've got 15+ years building loyalty programmes so we understand the value of your customer data.  It's about quality not quantity so our platform helps you create marketing around the value of your customers rather than the size of your list.
Websand is designed to make it easy for you to identify new revenue opportunities and build email marketing around the behaviour of your customers.  Send less email.  Sell more stuff.

== Installation ==

#### Installing the plugin
1. In your WordPress admin panel, go to *Plugins > New Plugin*, search for **Websand Subscription Form** and click "*Install now*"
2. Alternatively, download the plugin and upload the contents of `websand-for-wordpress.zip` to your plugins directory, which usually is `/wp-content/plugins/`.
3. Activate the plugin
4. In your WordPress admin panel, go to *Settings > Websand Subscription Form*. On this page you need to enter a your Websand domain, your Websand API Token and a full URL to a page on your site which out lines your terms and conditions surrouding your email marketing. You can also configure a default `source_code` for the site and add a default link to a 'thank you for subscribing' page. 
5.a. In your WordPress admin panel, go to *Appearance > Widgets* and drag the `Websand Subscription Form` widget into one of your theme's available widget areas. You can give your widget a title, you can set a custom thank your URL (where would you like your visitors to be redirected after they sign up) and a custom source code you'd like to give that subscribe from this specific widget.
5.b You can also add Websand subscriber forms to posts, pages and anywhere else in WordPress where you can use shortcodes.

#### Shortcodes
In addition to the widget, the Websand Subscription Form plugin enables shortcodes you can use in your posts and pages to embed signup forms directly in your content. You can read more about shortcodes [here](https://codex.wordpress.org/Shortcode). Examples of shortcodes using the available options are below:
`[websand] \\ A simple signup form using the default options`
`[websand source_code="my-lovely-source-code"] \\ A signup form which will both tag your subscribers with my-lovely-source-code`
`[websand thank_you="http://www.example.com/thanks.html"] \\ A signup form which will open a page that directs to http://www.example.com/thanks.html after subscribing`
`[websand source_code="my-lovely-source-code" thank_you="http://www.example.com/thanks.html"] \\ A signup form which will both tag your subscribers with my-lovely-source-code and open a page that directs to http://www.example.com/thanks.html after subscribing`

#### Looking for help?
Please take a look at the [Websand knowledge base](http://websand.helpscoutdocs.com/) first. If you can't find your answer there, please look through the [Websand Subscription Form plugin support forums](https://wordpress.org/support/plugin/websand-subscription-form) or start your own topic.

== Frequently Asked Questions == 

#### Can I style the widget?
The Websand Subscription Form widget comes with minimal default styling so it should blend straight in to your existing theme. If you would like to customise it however, the following CSS classes will be helpful: 

`
.websand-for-wordpress-widget { ... } /* the widget form */
.websand-form-group { ... } /* form input groups */
.websand-for-wordpress-widget p { ... } /* form paragraphs */
.websand-for-wordpress-widget label { ... } /* labels */
.websand-for-wordpress-widget input { ... } /* input fields */
.websand-for-wordpress-widget input[type="checkbox"] { ... } /* checkboxes */
.websand-for-wordpress-widget input[type="submit"] { ... } /* submit button */
`

You can either customise your theme's stylesheets or use a plugin like [Simple Custom CSS](https://wordpress.org/plugins/simple-custom-css/) to use these classes and style your widget. 

#### Can I use multiple widgets with different source codes on my site?
Yes indeed! You can have multiple widgets with different source codes - just drag new widgets from the left column of the *Appearance > Widgets* page and add them to the theme areas on the right - each widget has it's own settings.  

#### My question is not listed
Please head over to the [Websand knowledge base](http://websand.helpscoutdocs.com/) for more detailed documentation.

== Other Notes ==

#### Support
Use the [WordPress.org plugin forums](https://wordpress.org/support/plugin/websand-subscription-form) for community support where we try to help everyone. If you find a bug or would like to collaborate/add features, please create an issue at [websandHQ/websand-subscription-form](https://github.com/WebsandHQ/websand-subscription-form) (GitHub) where we can act upon them more efficiently.
