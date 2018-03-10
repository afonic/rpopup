## rPopup for Joomla 3.8.x

This module allows you to open a simple image popup at the bottom right corner of your website, using a Joomla banner item.

Conditions:

* Keep it simple, stupid. The options are what we need. Feel free to adjust to your needs if needed.
* May or may not work for Joomla versions other than 3.8.x. Probably will.
* Use at your own risk, this is made to fill our needs, yours may vary.

Options:

* Select a banner: The banner to display. Must be published. You can add a date to unpublish in the banner itself and the module will respect it.
* Enable cookie: Will add a cookie that will keep the popup closed for 3 days if the user closes it or clicks the banner.
* Disable on mobile: Will not load in mobile devices. Uses [Mobile-Detect](https://github.com/serbanghita/Mobile-Detect/)
* Inline CSS / JS: Loads the needed CSS and JS inline. Enable this if you want the module to work. You can then copy the styles / script and add it to your template file, and safely disable this.
* Fire Google Analytics Event: Will fire an event using ga.js, the event is named Popup and the options are Click or Close.

## Install

Download the module [rPopup](https://github.com/afonic/rpopup/archive/master.zip) and install it. Publish it in any position and it will work.
