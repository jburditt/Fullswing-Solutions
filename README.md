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


## Azure Resource Naming Convention

*NOTE* move this to Github profile

A well-defined Azure naming scheme ensures consistency, clarity, and compliance with Azure’s naming rules. Since most Azure resource names cannot be changed after creation, it’s critical to design a convention that is scalable and easy to interpret across teams.

*Core principles* include:
- *Name permanence* – only include details that remain constant; use tags for dynamic metadata.
- *Azure naming rules* – each resource type has specific length limits, allowed characters, and uniqueness scope (global, resource group, or parent resource level) .
- *Component order* – standardize the sequence of elements like resource type, workload, environment, region, and instance number.
- *Delimiters* – hyphens improve readability but may not be allowed for all resources.
- *Abbreviations* – [use short codes](https://learn.microsoft.com/en-us/azure/cloud-adoption-framework/ready/azure-best-practices/resource-abbreviations) (e.g., vm, rg, st) to stay within length limits .

*Typical naming components*:
- *Resource type* – short prefix (e.g., vm, rg, vnet, st).
- *Workload/Application* – project or service name.
- *Environment* – prod, dev, qa, stage.
- *Region* – Azure region short code (eastus2, westeu).

Instance number – sequential identifier (001, 01).

Example format: <type>-<workload>-<environment>-<region>-<###>

Sample conventions:

Resource Group: rg-webapp-prod

Virtual Machine: vm-sql-prod-eastus2-001

Storage Account: stwebappdata001 (lowercase, no hyphens)

Public IP: pip-sharepoint-prod-centralus-005

Virtual Network: vnet-prod-eastus2-001

Function App: func-navigator-prod-001.azurewebsites.net

Best practices:

Avoid ambiguity – use consistent prefixes/suffixes for quick identification.

Plan for scale – include instance numbers for resources that may have multiple deployments.

Use tags – complement names with metadata like environment=prod, owner=teamA, costCenter=1234.

Check Azure rules – e.g., storage accounts require lowercase letters/numbers, 3–24 characters; VM names have OS-specific limits .

By following a structured, rule-compliant naming scheme, you ensure Azure resources are easily identifiable, manageable, and automation-friendly across environments.