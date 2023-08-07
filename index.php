<html><body>
<head>
    <link rel="stylesheet" href="css/test.css">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP&display=swap" rel="stylesheet">
    </head>
<h3>Welkom bij de CCE backup, replicatie en HPE server disk status monitor.</h3>
<p><span style="text-decoration: underline;">
    <strong>PBU monitor</strong></span><br /><a href="https://webapp-test-abm.azurewebsites.net/pbuerror.php">Lijst van alle backup fouten.</a>&nbsp;Deze pagina wordt door Nagios gecheckt.<br /><a href="https://webapp-test-abm.azurewebsites.net/pbu/pbushowall.php">Lijst van alle Progress online backups (lange lijst!).</a><br /><a href="https://webapp-test-abm.azurewebsites.net/pbu/pbushow24.php">Dezelfde lijst maar dan beperkt tot de afgelopen 24u.</a><br /><a href="https://azurebackupmonitor.azurewebsites.net/pbu/pbushowlisa24.php">Dezelfde lijst maar dan beperkt tot de LISA databases van de afgelopen 24u. Hier kan je ook nagaan voor welke Linux databases AfterImages geactiveerd zijn.</a><br /><a href="https://azurebackupmonitor.azurewebsites.net/pbu/showpbunames.php">Welke Progress online backups worden hier gemonitored?</a><br /><a href="https://azurebackupmonitor.azurewebsites.net/pbu/showhistory.php">Hoe evolueert de size van elke Progress online backup.</a><br /><a href="https://azurebackupmonitor.azurewebsites.net/pbu/insertpbu.php">Voeg hier een nieuwe database toe.</a><br /><br />
    <span style="text-decoration: underline;">
    <strong>MABS monitor</strong></span><br /><a href="https://webapp-test-abm.azurewebsites.net/dpmerror.php">Lijst van de Azure cloudbackup DPM fouten.</a>&nbsp;Deze pagina wordt door Nagios gecheckt.<br /><a href="https://webapp-test-abm.azurewebsites.net/dpm/dpmlist.php">Welke cloudbackup DPM servers worden gemonitored verspreid over alle subscripties?</a><br /><a href="https://webapp-test-abm.azurewebsites.net/dpm/dpmlist_items.php">Welke cloudbackup DPM items worden gemonitored verspreid over alle subscripties?</a><br /><a href="https://azurebackupmonitor.azurewebsites.net/dpm/dpmshow24.php">Hier vind je de cloudbackup DPM items van de afgelopen 24u.</a><br><a href=http://download.windowsupdate.com/c/msdownload/update/software/updt/2021/07/microsoftazurebackup-kb5004579_ddeb7607e2f94542c9afcb1f7c409f538d5c1490.exe>Hier vind je het MABS v3 Update 2 pakket.</a>  Update na installatie zeker ook alle Agents.<br /><br />
    <span style="text-decoration: underline;">
    <strong>MARS monitor</strong></span><br /><a href="https://webapp-test-abm.azurewebsites.net/marserror.php">Hier vind je de cloudbackup MARS fouten van de afgelopen 24u.</a><br /><a href="https://webapp-test-abm.azurewebsites.net/marsreport/marsreportshow24.php">Hier vind je de cloudbackup MARS items van de afgelopen 24u.</a><br /><a href=https://aka.ms/azurebackup_agent>Hier vind je de laatste MARS agent.</a><br /><br>
    <span style="text-decoration: underline;">
    <strong>Hyper-V replicatie monitor</strong></span><br />
    <a href="https://webapp-test-abm.azurewebsites.net/replerror.php">Hier vind je de actuele replicatiestatus.</a>&nbsp;Deze pagina wordt door Nagios gecheckt.<br />
    <a href="https://webapp-test-abm.azurewebsites.net/repl/showreplication.php">Hier vind je de  replicatiestatistieken van de afgelopen dag.</a><br /><br>
    <span style="text-decoration: underline;">
    <strong>Veritas statistieken</strong></span><br />
    <a href="https://webapp-test-abm.azurewebsites.net/beerror.php">Hier vind je de Veritas backup fouten en exceptions.</a>Deze pagina wordt door Nagios gecheckt.<br />
    <a href="https://webapp-test-abm.azurewebsites.net/be/beshow.php">Hier vind je alle Veritas backup jobs.</a><br />
    <a href="https://webapp-test-abm.azurewebsites.net/be/bestatus.php">Hier vind je alle Veritas backup fouten en exceptions.</a><br />
    <br>
    <strong>Systeem statistieken</strong></span><br />
    <a href="https://webapp-test-abm.azurewebsites.net/system/sysshow.php">Hier vind je de systeem statistieken.</a><br />
    <br>
    <strong>HPE disk status</strong></span><br />
    <a href="https://webapp-test-abm.azurewebsites.net/system/show.php">Hier vind je de disk status statistieken.</a><br />
</p></p>
<iframe width="450" height="260" style="border: 1px solid #cccccc;" src="https://thingspeak.com/channels/2018579/charts/1?bgcolor=%23ffffff&color=%23d62020&dynamic=true&results=10080&title=Swap+gebruik+%28%25%29&type=line"></iframe>
<iframe width="450" height="260" style="border: 1px solid #cccccc;" src="https://thingspeak.com/channels/2018579/charts/2?bgcolor=%23ffffff&color=%23d62020&dynamic=true&results=10080&title=Memory+gebruik+%28%25%29&type=line"></iframe>
<iframe width="450" height="260" style="border: 1px solid #cccccc;" src="https://thingspeak.com/channels/2018579/charts/3?bgcolor=%23ffffff&color=%23d62020&dynamic=true&results=10080&title=Shared+gebruik+%28%25%29&type=line"></iframe>



</body></html>
