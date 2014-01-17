FOr API you need to setup virtual host or localhost folder,

1. $ composer install

2. $ php artisan migrate

3. http://<APIservername>/locator/api/service/v1/store

FOr front you need to setup virtual host or localhost folder,

1. just copy the front folder at your virtualhost or localhost folder

2. change virtualhost or localhost folder in index.html javascript code at bootom,

<script>
        
	$(function() {
          
		$('#map-container').storeLocator(
			{ 'dataType': 'jsonp', 
			 'dataLocation':'http://book.hd/locator/api/service/v1/store','jsonpCallback':'stores'});
        
	});
      
</script>

change book.ht with your API virtualhost or localhost folder name, i.e. if your virtualhost name is test.localhost
http://test.localhost/locator/api/service/v1/store


2.run http://<frontservername>/