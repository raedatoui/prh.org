# Physicians For Reproductive Health

This is the repository for the Wordpress theme for https://prh.org



## Site Installation

### Download Tools and Content

1. Download MAMP Pro: https://www.mamp.info/en/downloads/
2. Download MySQL Client: https://sequelpro.com/
3. Download Site content from MediaTemple:
   1. Locate the SFTP password on Lynx: Departments > Technology > Brooklyn George > PRH
   2. Using an FTP client (Cyberduck, FileZilla, Transmit), login with with credentials obtained in step 1.
   3. Navigate to `/var/www/vhosts/prh.org`
   4. Drag and drop the `httpdocs` to your local project directory
4. Export a current snapshot of the wordpress database
   1. Locate the Plesk panel login in Lynx. Notice you will get an SSL warning
   2. Click on _Databases_ in the left sidebar
   3. Under _wordpress_8, click on the _Export Dump_ link and keep the directory as the _Root directory_. Also check the _Automatically download dump after creation_
   4. An export job should start followed by an automatic downlaod of a zipped sql file



### Setup local Wordpress

#### Setup Host

1. Launch MAMP Pro
2. Create a new host and name is `prh.org`
3. In the right panel, click on the _SSL_ tab, enable SSL
4. Generate SSL certificates:
   1. Click on the _Create self-signed certificate_ button
   2. Fill out form and use: `US` for the country code, and fill out the rest of the form
   3. Save the certificates in a directory next to the `httpdocs` directory you previously downloaded.

#### Donwload PHP 5.3.5

1. Click on _PHP_ under the _Languages_ section in the left menu
2. Click on the _+_ icon, find _PHP 5.3.5_ and install it.

#### Configure Ports

1. Click on the _Ports_ item under the _Settings_ section in the left menu
2. Click on the _Set server ports to 80, 81, 443, 7443 and 3306_ and click _Save_ on the bottom  right.

#### Import Database & Configure Settings

1. Unzip the previously downloaded database backup
2. Start the MAMP servers, which should start the 
3. Click on _MySQL_ under the _Servers & Services_ section in the left menu.
4. The _Sequel Pro_ app icon should be enabled, click on it and it will launch the Sequel Pro app
5. Click on _Choose Database_ , _Add Database_, name it `prh` and keep the default encoding and collation settings
6. Click on _File > Import_ and select the SQL file you unzipped in Step 1.

#### Test Setup

1. Start the MAMP Servers
2. https://prh.org is now being served from your local machine.
3. Expect weird behavior with SSL certificates as you turn on and off MAMP and load the read and the local  site (Chrome SSL cache)



## Development







