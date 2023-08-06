#!/bin/bash -l

# download script
wget -q https://azurebackupmonitor.azurewebsites.net/system/azurefunctie.html -O /usr2/cce/bin/azurefunctie
dos2unix /usr2/cce/bin/azurefunctie
chmod  +x /usr2/cce/bin/azurefunctie

#enkele variabelen instellen
AI_BACKUP_DIR=/mnt/backup/ai
CUSTOMER_CODE=NANU001
APPL_SRC_NAME=applprod
export AI_BACKUP_DIR CUSTOMER_CODE APPL_SRC_NAME

#het script uitvoeren
/usr2/cce/bin/azurefunctie