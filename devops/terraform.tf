terraform {
  required_providers {
    docker = {
      source  = "kreuzwerker/docker"
      version = "~> 3.0.2"
    }
  }
  required_version = "~> 1.7"
}

provider "azurerm" {
  features {}
}

#resource "azurerm_resource_group" "rg" {
#  name     = "rg-fullswing"
#  location = "canadacentral"
#}