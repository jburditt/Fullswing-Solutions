output "api_key" {
  value = azurerm_static_web_app.static_web_app.default_host_name
}

output "fqdn" {
  value = azurerm_dns_cname_record.fullsweb.fqdn
}

output "record" {
  value = azurerm_dns_cname_record.fullsweb.record
}

output "soa_record" {
  value = azurerm_dns_zone.fullsweb.soa_record
}