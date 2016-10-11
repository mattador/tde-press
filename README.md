TDE Press module
================

last update - 2016-11-10

I created this module to assist the TDE team with their press release updates. The main features include:

- A custom admin grid and form layouts for press release entities
- Actions for deleting, updating and creating press release entities 
- A custom table and associated resource/collection classes
- A a custom frontend layout which invokes Magento_Ui/js/modal/modal and Slick (a carousel library). I decided not to create a custom frontend router, and leverage a CMS page with a tag reference {{block class="Tde\Press\Block\Press" block_id="tde_press_block_press"}} to a simple block: Tde\Press\Block\Press. This way the URL is adjustable from the frontend, and can also be disabled on command.
- A link in the admin content menu. 
 
Todo
====

- I did not have enough time to add file uploading capabilities to the admin. I've noted in a tool tip in the admin form that press thumbnail and modal images need to be updated manually (via SFTP?) to a subdirectory of the public WYSIWYG directory.
- Create a data API and collection factory for accessing data as per best practice in Magento 2
- Clean up any irrelevant DI overhead
- Add proper form validation to admin