resource "azurerm_resource_group" "rg" {
  name     = var.resource_group_name
  location = var.location
}

resource "azurerm_static_web_app" "static_web_app" {
  name                = "stapp-fs-consultation"
  location            = azurerm_resource_group.rg.location
  resource_group_name = azurerm_resource_group.rg.name
}

resource "azurerm_dns_zone" "fullsweb" {
  name = "fullsweb.com"
  resource_group_name = azurerm_resource_group.rg.name
}

resource "azurerm_dns_cname_record" "fullsweb" {
  name                = "www"
  zone_name           = azurerm_dns_zone.fullsweb.name
  resource_group_name = azurerm_resource_group.rg.name
  ttl                 = 300
  record              = azurerm_static_web_app.static_web_app.default_host_name
}

# NOTE currently does not work for me, theory is because my domain is hosted on AWS and required validation
# manually add the CNAME record to AWS Route53 to verify domain ownership and add custom domain to Static Web App on Azure
# TODO move AWS Route53 domains to Azure
resource "azurerm_static_web_app_custom_domain" "fullsweb" {
  static_web_app_id = azurerm_static_web_app.static_web_app.id
  domain_name       = "${azurerm_dns_cname_record.fullsweb.name}.${azurerm_dns_cname_record.fullsweb.zone_name}"
  validation_type   = "cname-delegation"
}