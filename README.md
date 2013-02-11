willwebberley.net
=================

The source for the site at willwebberley.net. The site heavily uses JavaScript to handle the pages and blog, and uses PHP as a backend to help with routing and for autocorrecting requested pages.

The code includes the blog, routing and page requesting functionality.

[See the site in action](http://www.willwebberley.net)

**FILES/DIRECTORIES OF INTEREST:**
* *includes/router.php*
    * Responsible for interpreting a user's request and serving the appropriate page.
    * Able to strip out slashes to provide the correct file at the given path.
    * Modified to do certain tasks with certain requests, but otherwise loads the appropriate file in the /pages directory.

* *index.php*
    * Main webpage file.
    * This page is the only one actually loaded by the browser.
    * Requests to other pages are made to includes/router.php via AJAX and are then loaded into an element in this page.
    * This document contains the includes for necessary scripts and files, including the detection of mobile devices and out-of-date browsers.

* *includes/javascript/navigation.js*
    * Listens for changes to the address in the address bar (i.e. an internal link is clicked) and makes an AJAX request to includes/router.php if there is an update.
    * Loads listeners and bindings for page events.
    * Handles animations in the header (e.g. the arrow, etc.)

* */pages*
    * Put the pages for the site in here with a .php extension.
    * Use a directory hierarchy as you would normally.
    * Example: willwebberley.net/contact loads willwebberley.net/#contact, which loads the file /pages/contact.php.

* */pages/home.php*
    * The blog handler. Uses JavaScript to handle the display of the correct blogs and navigation controls.
    * Makes AJAX requests to /includes/api/blog.php to retrieve blogs from file.

* */includes/api/blog.php*
    * Responsible for loading the requested post (or page of posts) and returning via JSON.
    * Uses a directory (/pages/posts) to hold blog posts (so does not need a database - though could easily be modified to work with one).