Twitter Profile List Widget
======================
Add a list of twitter users with photos to the widget column on a Wordpress blog.

NOTE: although this code is production ready, it does not work consistently with multisite.

Requirements
------------
1. Wordpress 3+
2. libcurl

Documentation
-------------

### Installation
1. Move the "twitter-profile-list-widget" to the wp-content/plugins/ directory
2. Enable the widget in the WP-Admin panel

### Configuration
The widget requires a public Twitter user name and list name. List displays in alphabetical order by "name".

### Example
Example: http://twitter.com/nickdenardis#/wayne-state-web-staff
User name: nickdenardis
List name: wayne-state-web-staff

### Display
    <li id="twitter_profile_list_widget" class="widget widget_twitter_profile_list_widget">
        <h2 class="widgettitle">[TITLE]</h2>
        <ul>
            <li><a href="[TWITTER USER URL]" class="profile-pic"><img src="[TWITTER PROFILE PIC]" height="48" width="48" alt="Profile photo of [TWITTER USER NAME]"></a> <a href="[TWITTER USER URL]">[TWITTER NAME]</a></li>
            <li>…</li>
        </ul>
    </li>

Contributing
---------
We are a firm believer of social coding, if you find a bug please fork the code on [GitHub](https://github.com/waynestate/twitter-profile-list-widget) and we will be happy to merge it back in to the master and add credit in the "Thanks to" section. Alternatively you can [open a new issue](https://github.com/waynestate/twitter-profile-list-widget/issues/new) and we will look in to it. 

Thanks to
---------
* [Nick DeNardis](http://nickdenardis.com/), for the initial codebase.
* [Nick West](http://nickwest.me/), for setting up a rock solid WP Multisite installation at Wayne State to test on.

Author
---------
[Wayne State University Web Team](http://blogs.wayne.edu/web/)