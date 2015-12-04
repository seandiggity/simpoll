SimPoll
=======
This polling system grabs a $_GET string from a URL and adds it to a Comma Separated Values (CSV) text file.  This script is useful if you need to ask one question (e.g. via a link in an e-mail) and record the response.

For something more complex and pretty, try Pollovoto [https://github.com/seandiggity/pollovoto](https://github.com/seandiggity/pollovoto)

Installation
-----------
1. Copy SimPoll to a Web server with PHP 5+ running
2. Edit conf.php appropriately. SSL is on by default; change $forceSSL if you want to turn it off.  [About SSL](http://en.wikipedia.org/wiki/Https).

3. There are sample .htaccess, .htpasswd, and robots.txt files in the root... it's wise to learn about these to maintain privacy.  Be wary of search engines and don't rely upon security by obscurity.  More Info: [.htaccess](http://en.wikipedia.org/wiki/.htaccess), [.htpasswd](http://en.wikipedia.org/wiki/.htpasswd), [robots.txt](http://en.wikipedia.org/wiki/Robots.txt)

Use Cases
-----------
* Pretty much any Yes/No question that doesn't require any follow-up.

Source
-----------
[https://github.com/seandiggity/simpoll](https://github.com/seandiggity/simpoll)

Author
-----------
Sean "Diggity" O'Brien, [sean@webio.me](mailto:sean@webio.me) [sean.obrien@yale.edu](mailto:sean.obrien@yale.edu)

License
-----------
[GNU AGPL v3](https://www.gnu.org/licenses/agpl.html)

Requirements
-----------
PHP 5+

