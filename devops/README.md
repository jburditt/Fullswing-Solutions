## Initialize
```bash
terraform init
az ad sp create-for-rbac --name sp-fullswing-contributer --role="Contributor" --scopes="subscriptions/ca62117d-82a8-4604-be26-46e1c3025e8b"
terraform import azurerm_resource_group.rg subscriptions/ca62117d-82a8-4604-be26-46e1c3025e8b/resourceGroups/rg-fullswing
```

Replace the response from the above command here:
```json
{
  "appId": "3973fb33-59e2-4136-9c1e-5738379c626c",
  "displayName": "sp-fullswing-contributer",
  "password": "*******",
  "tenant": "a3b56f32-a9ff-4f58-bbd1-1433edc18671"
}
```

Update your environment variables:
```bash
export ARM_CLIENT_ID="3973fb33-59e2-4136-9c1e-5738379c626c"
export ARM_CLIENT_SECRET="********"
export ARM_SUBSCRIPTION_ID="ca62117d-82a8-4604-be26-46e1c3025e8b"
export ARM_TENANT_ID="a3b56f32-a9ff-4f58-bbd1-1433edc18671"
```

## Deploy
```bash
terraform apply -auto-approve
```
