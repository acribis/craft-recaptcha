# Google reCaptcha for Craft CMS
Craft plugin to display Google's reCaptcha form widget and validate responses.

## Installation

1. Download & unzip the file and place the `craft-recaptcha` directory into your `craft/plugins` directory
2.  -OR- do a `git clone https://github.com/acribis/craft-recaptcha.git` directly into your `craft/plugins` folder.  You can then update it with `git pull`
3. Install plugin in the Craft Control Panel under Settings > Plugins
4. The plugin folder should be named `recaptcha` for Craft to see it.  GitHub recently started appending `-master` (the branch name) to the name of the folder for zip file downloads.

reCaptcha works on Craft 2.4.x and Craft 2.5.x.

## Configuring reCaptcha

Get your site key and secret key from [Google reCaptcha console](https://www.google.com/recaptcha/admin#list).

## Using reCaptcha

### Templates
To display a reCAPTCHA widget in any template, use `{{ craft.recaptcha.render() }}`.

### Server side verification
To verify a user's input, call the plugin's verify service from your own plugin:

    $captcha = craft()->request->getPost('g-recaptcha-response');
    $verified = craft()->recaptcha_verify->verify($captcha);
    
    if($verified) {
        // User is a person, not a robot. Go on and process the form!
    } else {
        // Uh oh...its a robot. Don't process this form!
    }

## reCaptcha Roadmap

Some things to do, and ideas for potential features:

* Release it

Brought to you by [acribis AG](acribis.ch) (Forked from [aberkie/craft-recaptcha](https://github.com/aberkie/craft-recaptcha))
