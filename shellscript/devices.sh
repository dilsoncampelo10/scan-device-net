#!/bin/bash

NETWORK=$(ip route | grep -E '^192\.168\.' | head -n 1 | awk '{print $1}')


if [ -z "$NETWORK" ]; then
  echo "Não foi possível detectar a rede. Defina manualmente a variável NETWORK."
  exit 1
fi

API_URL="http://localhost:80/api/devices"

echo "Escaneando rede: $NETWORK..."

DATA=$(sudo nmap -sn $NETWORK | awk '
  /^Nmap scan report/ { ip=$NF }
  /MAC Address/ {
    mac=$3
    manufacturer=substr($0, index($0,$4))
    print "{\"ip\":\"" ip "\", \"mac\":\"" mac "\", \"manufacturer\":\"" manufacturer "\"}"
  }' | jq -s '.')


curl -X POST $API_URL -H "Content-Type: application/json" -d "{\"devices\": $DATA}"
