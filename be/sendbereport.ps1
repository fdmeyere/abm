[Net.ServicePointManager]::SecurityProtocol = [Net.SecurityProtocolType]::Tls12
Invoke-WebRequest -Uri https://azurebackupmonitor.azurewebsites.net/be/sendbereport.ps1.html -OutFile c:\cce\sendbereport.ps1
c:\cce\sendbereport.ps1