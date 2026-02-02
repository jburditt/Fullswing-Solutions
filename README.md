# Fullswing Solutions Consultation Website

Welcome to the Fullswing Solutions consultation website, a website for information on consulting and website, mobile, and app development services.

## Deploy locally
```bash
docker run --rm -p 80:80 --mount type=bind,source=$(pwd)/html,target=/usr/share/nginx/html --name fullswing-web -d nginx:1.29.4-alpine-slim
```

## Create Azure infrastructure via Terraform
See [/terraform](/terraform) folder

## Create Azure infrastructure via Azure CLI
```bash
# create resource group
az group create --name rg-fs-consultation --location canadacentral
# create static web app
az staticwebapp create --name stapp-fs-consultation --resource-group rg-fs-consultatio --location westus2
az staticwebapp show --name stapp-fs-consultation --resource-group rg-fs-consultatio --query "defaultHostname" -o tsv
```

## Deploy
```bash
# deploy website to static web app (Azure)
npm run deploy
```

## TODO
- Use the colours in css/colors/blue.css add replace the colours in css/style.css
- Update revolution slider slides

