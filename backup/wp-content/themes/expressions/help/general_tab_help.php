<?php
/**
 * Contextual help file for general tab
 *
 * @package		Expressions WordPress Theme
 * @copyright	Copyright (c) 2013, Kevin Archibald
 * @license		http://www.gnu.org/licenses/quick-guide-gplv3.html  GNU Public License
 * @author		Kevin Archibald <www.kevinsspace.ca/contact/>
 */
 
 $html = '';
 $html .= '<h1>'.__('Expressions WordPress Theme','ka_express').'</h1>';
 $html .= '<p>'.__('Author Site : ','ka_express').'<a href="http://www.kevinsspace.ca/expressions-wordpress-theme/" target="_blank" >www.kevinsspace.ca/expressions-wordpress-theme/</a></p>';
 $html .= '<p>'.__('Theme Demo Site : ','ka_express').'<a href="http://demo2.kevinsspace.ca/" target="_blank" >demo2.kevinsspace.ca/</a></p>';
 $html .= '<p>'.__('If you try the theme and end up using it, visit the author or demo site to show your appreciation and make a donation.','ka_express').'</p>';
 $html .= '<p>'.__('Detailed documentation is available at the demo site','ka_express').'</p>';
 $html .= '<h2>'.__('General Options','ka_express').'</h2>';
 $html .= '<p><strong>'.__('Email','ka_express').'</strong>'; 
 $html .= ' - '.__('"Settings" => "General" email is used if left blank.','ka_express').'</p>';
 $html .= '<p><strong>'.__('Favicon','ka_express').'</strong>';
 $html .= ' - '.__('You will need to create a favicon.png 16px x 16px image and place it in the theme root folder.','ka_express').'</p>';
 $html .= '<p><strong>'.__('Captcha','ka_express').'</strong>';
 $html .= ' - '.__('You can disable the captcha\'s here if you do not wish to use them, or if you are using a plugin.','ka_express');
 $html .= __('You can also use a color captcha option, if the black and white captcha is giving you problems try his one.','ka_express').'</p>';
 $html .= '<p><strong>'.__('Post Options','ka_express').'</strong>';
 $html .= ' - '.__('You can choose to include post icons, exclude author, date, category and tags from the posts','ka_express').'</p>';
 $html .= '<p><strong>'.__('jQuery Plugins','ka_express').'</strong>';
 $html .= ' - '.__('You can disable audio.js, colorbox.js, fitvids.js, and Responsive post images which may come in handy if you are trouble shooting website problems or if you have alternative plugins.','ka_express').'</p>';
 $html .= '<p><strong>'.__('Mobile Friendly Design','ka_express').'</strong>';
 $html .= ' - '.__('You can choose to disable mobile friendly design, not recommended, but some folks want this option.','ka_express').'</p>';
 $html .= '<h2>'.__('Sidebar Options','ka_express').'</h2>';
 $html .= '<p><strong>'.__('WordPress Pages','ka_express').'</strong>'; 
 $html .= ' - '.__('All standard WordPress page sidebars can be set on the left or right side.','ka_express').'</p>';
 $html .= '<p><strong>'.__('Custom Pages','ka_express').'</strong>'; 
 $html .= ' - '.__('All custom page sidebars can be set on the left or right side in the page set up admin panel.','ka_express').'</p>';
 $html .= '<h2>'.__('Header Options','ka_express').'</h2>';
 $html .= '<p><strong>'.__('Logo','ka_express').'</strong>';
 $html .= ' - '.__('For a centered logo click "Show Logo" and "Center Logo", for left side logo select "Show Logo" and unselect "Center Logo"','ka_express').'</p>';
 $html .= '<p><strong>'.__('Blog Title and Description','ka_express').'</strong>';
 $html .= ' - '.__('Both are centered in the header and come from "Settings" => "General" => "Title" and "Tagline"','ka_express').'</p>';
 $html .= '<p><strong>'.__('Menu','ka_express').'</strong>';
 $html .= ' - '.__('Place it left center or right, and with no border, full border or just a border for the menu (center option only)','ka_express').'</p>';
 $html .= '<h2>'.__('Footer Options','ka_express').'</h2>';
 $html .= '<p><strong>'.__('Footer','ka_express').'</strong>';
 $html .= ' - '.__('You can choose to exclude the footer, and you can choose 3 or 4 columns.','ka_express').'</p>';
 $html .= '<p><strong>'.__('Copyright','ka_express').'</strong>';
 $html .= ' - '.__('The copyright section is a strip at the bottom of the footer that accepts html. Important - use single quotes for the html properties or funny things happen!','ka_express').' ';
 $html .= __('Typically the copyright notice is on the left, a developer credit in the middle, and a siteplan link is on the right.','ka_express').'</p>';
 $html .= '<h2>'.__('Social Options','ka_express').'</h2>';
 $html .= '<p><strong>'.__('Social Links','ka_express').'</strong>';
 $html .= ' - '.__('Input your social links here. Make sure you test the link to ensure it works.','ka_express');
 $html .= 'Social links can be added to any widgetized area by using the "Expressions Social Links Widget"'.'</p>';
 
 return $html;
 
?>