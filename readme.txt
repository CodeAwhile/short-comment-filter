=== Short Comment Filter ===
Contributors: itsananderson
Requires at least: 2.7
Tested up to: 4.0
Stable tag: 2.2

Description: Automatically Spams or Deletes comments that don't meet a specified length requirement.

== Description ==

Most short comments add little or nothing to a conversation.
Having to delete these spammy comments can become a pain for blog administrators.
The Short Comment Filter Plugin automatically filters comments that are too short.
You can specify whether filtered comments should be deleted or flagged as spam.

= Features =

Short Comment Filter Plugin is pretty flexible. Here are some things you can customize.

* Filter Type - This determines whether to apply a minimum word or minimum character filter
* Minimum Count - Sets the minimum number of words/characters (depending on Filter Type) that comments can contain.
* Default Filter Action - This determines whether filtered comments are deleted, or simply flagged as spam
* Filter Registered Users - If turned off, registered users will not be filtered. They can create comments of any length.
* Check Client Side - If turned on, JavaScript will be used on the client side to make sure comments aren't too short.

== Installation ==

1. Upload the complete `short-comment-filter` folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Navigate to Settings > Short Comment Filter to customize the plugin settings.
4. If you wish to enable client side JavaScript, make sure your comment form has ID "commentform" and your comment textbox has ID "comment"
