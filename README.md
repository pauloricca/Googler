# Googler
Gets the first results from the first X pages on Google for a given expression, saves in html and json format. Also able to merge results from different queries into one list with unique entries.

## Running
Open the directory in the terminal (you can drag it to the terminal icon on Mac) and type:

*php serve*

## Configuration
You can change the port or the number of search result pages requested on the config.php file (can be opened using a text editor).

## Being blocked by Google?
After running a few queries, Google might start blocking you. To unblock yourself you need to visit https://www.google.com and solve a robot challenge.

## Location
Google search results will target your location based on your IP. To get results from different locations you'll have to either:
1. Run this on a server located elsewhere;
1. Ask a friend that lives elsewhere to run it for you;
1. Use a VPN. 