# Fullswing Solutions Consultation Website

Welcome to the Fullswing Solutions consultation website, a website for information on consulting and website, mobile, and app development services.

This website was originally developed on Wordpress many years ago and has been updated to be deployed using docker containers, for cheaper MySQL database hosting. Azure SQL Database was going to cost $13.50 USD per month and a virtual machine running MySQL was going to cost $1.69 USD per month. This is partially an experiment to compare cost and also to learn how to deploy docker to Azure kubernetes or container services.

## Deploy to Azure
```bash
az containerapp compose create --environment cae-fullswing-prod --resource-group Fullswing-Solutions --compose-file-path ./docker-compose.yml 
# az containerapp job update --name caj-fullswing-prod --resource-group Fullswing-Solutions --set-env-vars $(grep -v '^#' .env | xargs)
```

## TODO
- Add the following environment variables to Azure deployment script:
  - WORDPRESS_DB_USER
  - WORDPRESS_DB_PASSWORD
- Add wordpress container ingress to deployment for public access to http and https
- See certbot.log for Azure logs
