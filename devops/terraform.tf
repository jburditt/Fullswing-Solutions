terraform {
  required_providers {
    azurerm = {
      source  = "hashicorp/azurerm"
      version = "=4.1.0"
    }
  }
  required_version = "~> 1.7"
  # cloud {
  #   organization = "fullswing"
  #   workspaces {
  #     name = "consultation-website"
  #   }
  # }
}

provider "azurerm" {
  features {}
  subscription_id = "ca62117d-82a8-4604-be26-46e1c3025e8b"
}
