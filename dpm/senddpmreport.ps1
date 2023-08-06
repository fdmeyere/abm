#########################################
#                                       #
# Root script.                          #
#                                       #
#########################################

# Download eerst het echte script

[Net.ServicePointManager]::SecurityProtocol = [Net.SecurityProtocolType]::Tls -bor [Net.SecurityProtocolType]::Tls11 -bor [Net.SecurityProtocolType]::Tls12
Invoke-WebRequest -Uri https://azurebackupmonitor.azurewebsites.net/dpm/senddpmreport.ps1.html -OutFile c:\cce\senddpmreport.ps1

# Zet derdencode juist en haal de laatste regel uit commentaar.

$derdencode="<intevullen>"
#Invoke-Expression c:\cce\senddpmreport.ps1