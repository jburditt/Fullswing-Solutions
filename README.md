# Fullswing Solutions Consultation Website

Welcome to the Fullswing Solutions consultation website, a website for information on consulting and website, mobile, and app development services.

## Deploy locally
```bash
docker build -t fullswing-web .
docker run --rm -p 80:80 --name fullswing-web -d fullswing-web
```

## Deploy to Azure
```bash

```

## TODO


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