#########################################
#
# Root script.
#
#########################################


# Download eerst het echte script
#TLS 1.2 gebruiken
[Net.ServicePointManager]::SecurityProtocol = [Net.SecurityProtocolType]::Tls -bor [Net.SecurityProtocolType]::Tls11 -bor [Net.SecurityProtocolType]::Tls12

Invoke-WebRequest -Uri https://azurebackupmonitor.azurewebsites.net/system/sendhpereport.ps1.html -OutFile c:\cce\sendhpereport.ps1

# Zet derdencode juist en draai het.

$derdencode="VARA001"
Invoke-Expression c:\cce\sendhpereport.ps1